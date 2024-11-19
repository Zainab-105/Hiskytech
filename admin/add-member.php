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
                        <h1 class="h3 mb-0 text-gray-800">Add New Team Member</h1>
                        
                    </div>
                  

                    <form action="insert_team_member.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <input type="text" id="role" name="role" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="linkedin_url" class="form-label">LinkedIn Profile URL:</label>
                <input type="url" id="linkedin_url" name="linkedin_url" class="form-control">
            </div>
            <div class="mb-3">
                <label for="facebook_url" class="form-label">Facebook Profile URL:</label>
                <input type="url" id="facebook_url" name="facebook_url" class="form-control">
            </div>
            <div class="mb-3">
                <label for="instagram_url" class="form-label">Instagram Profile URL:</label>
                <input type="url" id="instagram_url" name="instagram_url" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Team Member</button>
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