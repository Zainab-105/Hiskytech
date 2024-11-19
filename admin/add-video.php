<?php
include('includes/head.php');
include('includes/config.php');
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
               <?php if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Services</h1>
                        
                    </div>
                  

                    <form action="submit_video.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="video">Upload Video:</label>
        <input type="file" id="video" name="video" class="form-control" required accept="video/*">
    </div>
    
    <button type="submit" class="btn" style="background-color:#0a3a8f; color:white;">Upload Video</button>
</form>

    </div>
                 
                    

                   
     

        
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

 

<?php include('includes/footer.php')?>