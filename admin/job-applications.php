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
                <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Job Applications</h1>
              
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                       
                    <div class="col-lg-12">
                    <table class="myTable table table-bordered table-hover dt-responsive" style="background-color:white">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Profile Photo</th>
            <th>Applied For</th>
            <th>Applied At</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $a = 1;
        $sql = "SELECT * FROM applications ORDER BY id DESC"; // Modify query as per your table
        $query = mysqli_query($conn, $sql);

        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $statusClass = ($row['status'] == 'unreviewed') ? 'unreviewed' : 'reviewed';
                $statusText = ucfirst($row['status']); 
    ?>
        <tr>
            <td><?php echo $a; ?></td>
            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
                <img src="../<?php echo $row['photo_path']; ?>" alt="Profile Photo" style="width: 50px; height: 50px; object-fit: cover;">
            </td>
            <td>
    <?php
    $job_id = $row['job_id'];
    $sql = "SELECT title FROM jobs WHERE id=$job_id";
    $query = mysqli_query($conn, $sql);

    while ($job_name = mysqli_fetch_assoc($query)) {
        echo $job_name['title'];
    }
    ?>
</td>

            <td><?php echo $row['created_at']; ?></td>
  <td>
                <span class="badge <?php echo ($row['status'] == 'unreviewed') ? 'badge-warning' : 'badge-success'; ?>">
                    <?php echo $statusText; ?>
                </span>
            </td>
            <td>
            <?php if ($row['status'] == 'unreviewed') { ?>
                    <a href="application-status.php?mark_as_read=<?php echo $row['id']; ?>" class="mark-as-read-btn">
                        <i class="fas fa-eye gray-icon"></i> Mark as Reviewd
                    </a>
                <?php } else { ?>
                    <span>Reviewed</span>
                <?php } ?>
                <a href="delete_application.php?id=<?= $row['id'] ?>" class="delete-btn"><i class="fas fa-trash-alt gray-icon"></i></a>
            </td>
        </tr>
    <?php
                $a++;
            }
        } else {
            echo "<tr><td colspan='9'>No records found.</td></tr>";
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