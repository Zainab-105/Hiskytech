<?php
include('includes/head.php');
include('includes/config.php');

$msg = ''; // Message variable to display success or error feedback

// Check if the course_id is passed in the URL
if (isset($_GET['course_id']) && is_numeric($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
} else {
    die("Invalid course ID.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Retrieve form input
        $chapter_no = $_POST['number'];
        $chapter_name = $_POST['chapter_name'];

        // Insert query to add chapter against course_id
        $insertQuery = "INSERT INTO chapters (course_id, chapter_no, chapter_name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iis", $course_id, $chapter_no, $chapter_name);

        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Chapter added successfully!</div>";
        } else {
            throw new Exception("Failed to add chapter.");
        }
    } catch (Exception $e) {
        $msg = "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<body id="page-top">
    <div id="wrapper">
        <?php include('includes/sidebar.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('includes/nav.php'); ?>

                <div class="container-fluid">
                    <?php if (!empty($msg)) echo $msg; ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add New Chapter</h1>
                        <a href="add-course-video.php?course_id=<?=$course_id?>&&chapter_id=<?=$course_id?>" class="btn btn-primary">Add Video</a>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form to Add Chapter -->
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="no" class="form-label">Chapter No:</label>
                                    <input type="text" id="no" name="number" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Chapter Name:</label>
                                    <input type="text" id="name" name="chapter_name" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
