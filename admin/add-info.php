<?php
include('includes/head.php');

include('includes/config.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['email'];
    $number=$_POST['number'];
    $courses_email=$_POST['courses_email'];
      $deleteSql = "DELETE FROM contact_info";
      mysqli_query($conn, $deleteSql);
    $sql="INSERT INTO contact_info (email,number,courses_email) VALUES ('$email','$number','$courses_email')";
    $result=mysqli_query ($conn,$sql);
    if($result){
        $msg="<div class='alert alert-success'>Contact added successfully! <a href='info.php'>View Contact_Info</a></div>";
    }
    else{
        $msg="<div class='alert alert-danger'>Error in Insertion.</div>".mysqli_error($conn);
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
                        <h1 class="h3 mb-0 text-gray-800">Contact Info</h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                       
                    <div class="col-lg-12">
                    <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Number:</label>
                <input type="text" id="number" name="number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="courses_email" class="form-label">Courses Email:</label>
                <input type="email" id="courses_email" name="courses_email" class="form-control">
            </div>
        
            <button type="submit" class="btn btn-primary">Submit</button>
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