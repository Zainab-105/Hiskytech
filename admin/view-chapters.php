<?php
include('includes/head.php');

include('includes/config.php');
include('includes/time_function.php');
$course_id='';
if(isset($_GET['course_id'])){
    $course_id=$_GET['course_id'];
  
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
                        <h1 class="h3 mb-0 text-gray-800">Chapters</h1>
                        <a href="add-course.php" class="btn btn-primary">Add Course</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                       
                    <div class="col-lg-12">
                    <table class="myTable table table-bordered table-hover dt-responsive" style="background-color:white">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Chapter No.</th>
            <th>Chapter Name</th>
            <th>Manage Videos</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $a = 1; // Counter for serial number
        $sql = "SELECT * FROM chapters WHERE course_id=$course_id"; // Fetch courses in descending order
        $query = mysqli_query($conn, $sql);

        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
    ?>
        <tr>
            <td><?php echo $a; ?></td>
            <td><?php echo htmlspecialchars($row['chapter_no']); ?></td>
            <td><?php echo htmlspecialchars($row['chapter_name']); ?></td>
            <td>
                <a href="add-course-video.php?course_id=<?= $course_id ?>&&chapter_id=<?= $id ?>" class="btn btn-primary">Add Videos</a>
                <a href="view-course-video.php?course_id=<?= $course_id ?>&&chapter_id=<?= $id ?>" class="btn btn-success mt-3">View Videos</a>
            </td>
            <td>
                <a href="delete_course.php?id=<?= $id ?>" class="delete-btn"><i class="fas fa-trash-alt gray-icon"></i></a>
                <a href="edit_course.php?id=<?= $id ?>" class="edit-btn"><i class="fas fa-edit gray-icon"></i></a>
            </td>
        </tr>
    <?php
                $a++;
            }
        } else {
            echo "<tr><td colspan='5'>No courses found.</td></tr>";
        }
    ?>
    </tbody>
</table>




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