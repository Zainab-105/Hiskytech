<?php
include('includes/head.php');
include('includes/config.php');

$msg = '';

// Fetch course details
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM courses WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $course = mysqli_fetch_assoc($result);

        // Fetch course outlines
        $outlineQuery = "SELECT * FROM course_outline WHERE course_id = $id";
        $outlineResult = mysqli_query($conn, $outlineQuery);
        $outlines = [];
        if ($outlineResult && mysqli_num_rows($outlineResult) > 0) {
            while ($row = mysqli_fetch_assoc($outlineResult)) {
                $outlines[] = $row;
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Course not found.</div>";
        exit($msg);
    }
} else {
    $msg = "<div class='alert alert-danger'>Invalid request.</div>";
    exit($msg);
}

// Update course details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_course'])) {
    $conn->begin_transaction();
    try {
        $name = $_POST['name'];
        $instructor = $_POST['instructor'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        // Handle thumbnail upload
        $thumbnailPath = $course['thumbnail'];
        if (!empty($_FILES['thumbnail']['name'])) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $thumbnailPath = $uploadDir . basename($_FILES['thumbnail']['name']);
            if (!move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnailPath)) {
                throw new Exception("Thumbnail upload failed.");
            }
        }

        // Update the `courses` table
        $updateQuery = "UPDATE courses 
        SET thumbnail = ?, 
            name = ?, 
            instructor = ?, 
            price = ?, 
            description = ?, 
            updated_at = NOW() WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('sssssi', $thumbnailPath, $name, $instructor, $price, $description, $id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update course.");
        }


        // Update the `course_outline` table
        $stmtOutlineDelete = $conn->prepare("DELETE FROM course_outline WHERE course_id = ?");
        $stmtOutlineDelete->bind_param('i', $id);
        if (!$stmtOutlineDelete->execute()) {
            throw new Exception(message: "Failed to delete existing course outlines.");
        }

        if (!empty($_POST['outline'])) {
            $stmtOutlineInsert = $conn->prepare("INSERT INTO course_outline (course_id, outline) VALUES (?, ?)");
            foreach ($_POST['outline'] as $outline) {
                $stmtOutlineInsert->bind_param('is', $id, $outline);
                if (!$stmtOutlineInsert->execute()) {
                    throw new Exception("Failed to add new course outline.");
                }
            }
        }

        $conn->commit();
        $msg = "<div class='alert alert-success'>Course updated successfully! <a href='courses.php'>View Courses</a></div>";
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
                    <?php if (!empty($msg))
                        echo $msg; ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Course</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="mb-3" method="POST" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label for="thumbnail" class="form-label">Upload Thumbnail Image</label>
                                    <input class="form-control" type="file" name="thumbnail" id="thumbnail"
                                        accept="image/*">
                                    <img src="<?php echo htmlspecialchars($course['thumbnail']); ?>"
                                        alt="Current Thumbnail" style="width: 100px; margin-top: 10px;">
                                </div>
                                <div class="mb-2">
                                    <input class="form-control" type="text" name="name"
                                        value="<?php echo htmlspecialchars($course['name']); ?>" required>
                                </div>
                                <div class="mb-2">
                                    <input class="form-control" type="text" name="instructor"
                                        value="<?php echo htmlspecialchars($course['instructor']); ?>" required>
                                </div>
                                <div class="mb-2">
                                    <input class="form-control" type="number" name="price"
                                        value="<?php echo htmlspecialchars($course['price']); ?>" step="0.01" required>
                                </div>
                                <div class="mb-2">
                                    <label for="description" class="form-label">Course Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5"
                                        required><?php echo htmlspecialchars($course['description']); ?></textarea>
                                </div>
                                <div id="outline" class="mb-2">
                                    <label class="form-label">Course Outline:</label>
                                    <?php foreach ($outlines as $outline): ?>
                                        <div class="input-group mb-3">
                                            <input type="text" name="outline[]" class="form-control"
                                                value="<?php echo htmlspecialchars($outline['outline']); ?>" required>
                                            <button type="button" class="btn btn-danger"
                                                onclick="this.parentNode.remove()">Remove</button>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="input-group mb-3">
                                        <input type="text" name="outline[]" class="form-control"
                                            placeholder="Course Outline">
                                        <button type="button" class="btn btn-secondary" onclick="addOutline()">Add
                                            More</button>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="update_course">Update
                                    Course</button>
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