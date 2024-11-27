<?php
include('includes/head.php');

include('includes/config.php');
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     var_dump($_POST);
//     exit;
// }
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {
    $name = $_POST['name'];
    $instructor = $_POST['instructor'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $upload_dir = 'uploads/';
    $image_file = $upload_dir . basename($_FILES['thumbnail']['name']);
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $image_file)) {
        $sql = "INSERT INTO courses (thumbnail, name, instructor, price, description) 
                VALUES ('$image_file', '$name', '$instructor', '$price', '$description')";
        $query = mysqli_query($conn, $sql);

        $msg = "<div class='alert alert-success'>Course added successfully! <a href='courses.php'>View Courses</a></div>";
    } else {
        $msg = "<div class='alert alert-danger'>Thumbnail upload failed.</div>";
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
                        <h1 class="h3 mb-0 text-gray-800">Add Course</h1>
                      
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                       
                    <div class="col-lg-12">
                    <form class="mb-3" method="POST" enctype="multipart/form-data">
    <!-- Fields -->
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
    <button class="btn btn-primary" type="submit" name="add_course">Add Course</button>
</form>


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