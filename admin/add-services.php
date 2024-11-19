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
                  

        <form action="submit_service.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Service Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="icon">Service Icon (Image Path):</label>
                <input type="file" id="icon" name="icon" class="form-control" required placeholder="Path to service icon image">
            </div>

            <div class="form-group">
                <label for="description">Service Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="heading">Service Heading:</label>
                <input type="text" id="heading" name="heading" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="language_icons">Language Icons (Upload multiple images):</label>
                <input type="file" id="language_icons" name="language_icons[]" class="form-control-file" accept="image/*" multiple required>
            </div>

            <button type="submit" class="btn" style="background-color:#0a3a8f; color:white;">Create Service</button>
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