 <?php
include('includes/head.php');
include('includes/config.php');
$msg = '';
$course_id ='';

if (!isset($_GET['course_id']) || empty($_GET['course_id'])) {
    $msg = "<div class='alert alert-danger'>Course ID is missing!</div>";
    $videos = [];
} else {
    $course_id = intval($_GET['course_id']); 


    $query = "SELECT id, title, video, uploaded_at FROM videos WHERE course_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $videos = $result->fetch_all(MYSQLI_ASSOC); 
    } else {
        // $msg = "<div class='alert alert-info'>No videos found for Course ID: $course_id.</div>";
        $videos = [];
    }
}
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('includes/sidebar.php')?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('includes/nav.php');?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Course Videos</h1>
                        <div>
                        <a href="courses.php" class="btn">Return to Courses Page</a>
                        <a href="add-course-video.php?course_id=<?= $course_id ?>" class="btn btn-primary">Add Video</a>
                        </div>
                       
                    </div>
<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($videos)): ?>
            <div class="row">
                <?php foreach ($videos as $video): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card p-2">
                            <h5 class="mb-1"><?php echo htmlspecialchars($video['title']); ?></h5>
                            <video width="100%" controls class="p-3">
                                <source src="<?= htmlspecialchars($video['video']) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="d-flex justify-content-between mt-2">
                                <a class="btn btn-primary btn-sm" href="edit-course-video.php?video_id=<?= $video['id'] ?>&course_id=<?= $course_id ?>">Edit</a>
                                <a class="btn btn-danger btn-sm" href="delete-course-video.php?video_id=<?= $video['id'] ?>&course_id=<?= $course_id ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No videos found for this course.</p>
        <?php endif; ?>
    </div>
</div>


                    

                   
     

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

 

<?php include('includes/footer.php')?>
