<?php
include('includes/head.php');

include('includes/config.php');
include('includes/time_function.php');
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
                        <h1 class="h3 mb-0 text-gray-800">Career Opportunities</h1>
                        <a href="add-job.php" class="btn btn-primary">Add Job</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                       
                    <div class="col-lg-12">
                    <table class="myTable table table-bordered table-hover dt-responsive" style="background-color:white">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Job Title</th>
            <th>Location</th>
            <th>Category</th>
            <th>Job Type</th>
            <th>Employment Type</th>
            <th>Posted</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $a = 1;
        $sql = "SELECT * FROM jobs ORDER BY created_at DESC";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
    ?>
        <tr>
            <td><?php echo $a; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['employment_type']; ?></td>
            <td><?php echo time_ago($row['created_at']); // Custom function to format time ?></td>
            <td>
                <a href="delete_job.php?id=<?= $row['id'] ?>" class="delete-btn"><i class="fas fa-trash-alt gray-icon"></i></a>
                <a href="edit_job.php?id=<?= $row['id'] ?>" class="edit-btn"><i class="fas fa-edit gray-icon"></i></a>
            </td>
        </tr>
    <?php
                $a++;
            }
        } else {
            echo "<tr><td colspan='8'>No jobs found.</td></tr>";
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