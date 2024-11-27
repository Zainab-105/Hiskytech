<?php
include('includes/head.php');
include('includes/config.php');
$msg = '';

// Check if course_id and video_id are set in the URL
if (!isset($_GET['course_id']) || empty($_GET['course_id']) || !isset($_GET['video_id']) || empty($_GET['video_id'])) {
    $msg = "<div class='alert alert-danger'>Course ID or Video ID is missing!</div>";
} else {
    $course_id = intval($_GET['course_id']);
    $video_id = intval($_GET['video_id']);

    // Fetch the video record details from the database
    $query = "SELECT * FROM videos WHERE course_id = ? AND id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $course_id, $video_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $video = $result->fetch_assoc();

    if (!$video) {
        $msg = "<div class='alert alert-danger'>Video not found for this Course!</div>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $upload_dir = 'uploads/';
        $video_file = $video['video'];  

        // Check if a new video is uploaded
        if (!empty($_FILES['video']['name'])) {
            $video_file = $upload_dir . basename($_FILES['video']['name']);
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES['video']['tmp_name'], $video_file)) {
                // Debugging: Output the file upload status
                echo "File uploaded: " . $video_file;
            } else {
                $msg = "<div class='alert alert-danger'>Failed to upload the new video.</div>";
            }
        }

        // Update the video record
        $query = "UPDATE videos SET title = ?, video = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            $msg = "<div class='alert alert-danger'>Error preparing query: " . $conn->error . "</div>";
        }
        $stmt->bind_param("ssi", $title, $video_file, $video_id);

        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Video updated successfully!</div>";
            header('Location: view-course-video.php?course_id=' . $course_id);
            exit;
        } else {
            $msg = "<div class='alert alert-danger'>Error updating video: " . $stmt->error . "</div>";
        }
    }
}
?>

<body>
<div id="wrapper">
    <?php include('includes/sidebar.php') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('includes/nav.php'); ?>
            <div class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">Edit Job</h1>
                <?php if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
            <?php if (isset($video)) { 
    ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Video Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($video['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="current_video" class="form-label">Current Video</label>
            <video width="100" controls>
                <source src="<?= htmlspecialchars($video['video']) ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Upload New Video (Optional)</label>
            <input type="file" name="video" id="video" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update Video</button>
    </form>
    <?php
    }
    ?>
            </div>
        </div>
    </div>
</div>
<script>
        ClassicEditor
            .create(document.querySelector('.editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
<?php include('includes/footer.php') ?>
