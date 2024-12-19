<?php
include('includes/head.php');
include('includes/config.php');

$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {
    $conn->begin_transaction();
    try {
        $name = $_POST['name'];
        $instructor = $_POST['instructor'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        // Handle thumbnail upload
        $upload_dir = 'uploads/';
        $image_file = $upload_dir . basename($_FILES['thumbnail']['name']);
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        if (!move_uploaded_file($_FILES['thumbnail']['tmp_name'], $image_file)) {
            throw new Exception("Thumbnail upload failed.");
        }

        // Insert course details into `courses` table
        $stmt = $conn->prepare("INSERT INTO courses (thumbnail, name, instructor, price, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $image_file, $name, $instructor, $price, $description);
        if (!$stmt->execute()) {
            throw new Exception("Failed to add course.");
        }
        $course_id = $stmt->insert_id;

        if (!empty($_POST['outline'])) {
            $stmt_outline = $conn->prepare("INSERT INTO course_outline (course_id, outline) VALUES (?, ?)");
            foreach ($_POST['outline'] as $outline) {
                $stmt_outline->bind_param('is', $course_id, $outline);
                if (!$stmt_outline->execute()) {
                    throw new Exception("Failed to add course outline.");
                }
            }
        }

        $conn->commit();
        $msg = "<div class='alert alert-success'>Course added successfully! <a href='courses.php'>View Courses</a></div>";
    } catch (Exception $e) {
        $conn->rollback();
        $msg = "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<!-- HTML Code -->
<body id="page-top">
    <div id="wrapper">
        <?php include('includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('includes/nav.php'); ?>
                <div class="container-fluid">
                    <?php if (!empty($msg)) echo $msg; ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Course</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="mb-3" method="POST" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label for="thumbnail" class="form-label">Upload Thumbnail Image</label>
                                    <input class="form-control" type="file" name="thumbnail" id="thumbnail" accept="image/*" required>
                                </div>
                                <div class="mb-2">
                                    <input class="form-control" type="text" name="name" placeholder="Course Name" required>
                                </div>
                                <div class="mb-2">
                                    <input class="form-control" type="text" name="instructor" placeholder="Instructor" required>
                                </div>
                                <div class="mb-2">
                                    <input class="form-control" type="number" name="price" placeholder="Price" step="0.01" required>
                                </div>
                                <div class="mb-2">
                                    <label for="description" class="form-label">Course Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter course description" required></textarea>
                                </div>
                                <div id="outline" class="mb-2">
                                    <label class="form-label">Course Outline:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="outline[]" class="form-control" placeholder="Course Outline" required>
                                        <button type="button" class="btn btn-secondary" onclick="addOutline()">Add More</button>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="add_course">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script>
        function addOutline() {
            const container = document.getElementById('outline');
            const newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-3');
            newInput.innerHTML = `
                <input type="text" name="outline[]" class="form-control" placeholder="Course Outline" required>
                <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
            `;
            container.appendChild(newInput);
        }
    </script>
</body>
