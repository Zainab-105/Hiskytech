<?php
include('includes/head.php');
include('includes/config.php');
$msg = '';

// Check if course_id is set in the URL
if (!isset($_GET['course_id']) || empty($_GET['course_id'])) {
    $msg = "<div class='alert alert-danger'>Course ID is missing!</div>";
} else {
    $course_id = intval($_GET['course_id']); // Ensure the course ID is an integer

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $upload_dir = 'uploads/';
        $video_file = $upload_dir . basename($_FILES['video']['name']);

        // Create the uploads directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded video file to the server
        if (move_uploaded_file($_FILES['video']['tmp_name'], $video_file)) {
            // Insert the video record associated with the course ID into the database
            $query = "INSERT INTO videos (course_id, title, video) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iss", $course_id, $title, $video_file);

            if ($stmt->execute()) {
                $msg = "<div class='alert alert-success'>Video uploaded successfully! <a href='courses.php'>View Courses</a></div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error saving video: " . $conn->error . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Failed to upload video.</div>";
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
                <h1 class="h3 mb-0 text-gray-800">Add New Job</h1>
                <?php if (!empty($msg)) {
                        echo $msg;
                    }
                ?>
              <form action="" method="POST" enctype="multipart/form-data">
        <!-- Video Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Video Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter video title" required>
        </div>

        <!-- Video File -->
        <div class="mb-3">
            <label for="video" class="form-label">Upload Video</label>
            <input type="file" class="form-control" id="video" name="video" accept="video/*" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-upload gray-icon"></i> Upload Video
        </button>
    </form>
            </div>
        </div>
    </div>
</div>
<!-- <script>
ClassicEditor.create(document.querySelector('.editor'))
    .then(editor => {
   
        document.querySelector('form').addEventListener('submit', function() {
            document.querySelector('textarea[name="content"]').value = editor.getData();
        });
    })
    .catch(error => {
        console.error(error);
    });

</script> -->
<?php include('includes/footer.php') ?>
