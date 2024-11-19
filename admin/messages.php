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
                        <h1 class="h3 mb-0 text-gray-800">Messages</h1>
                        
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
            <th>Phone</th>
            <th>Message</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $a = 1;
        $sql = "SELECT * FROM messages ORDER BY created_at DESC";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $statusClass = ($row['status'] == 'unread') ? 'unread' : 'read';
                $statusText = ucfirst($row['status']); 
    ?>
        <tr class="<?php echo $statusClass; ?>"> 
            <td><?php echo $a; ?></td>
            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td>
                <span class="badge <?php echo ($row['status'] == 'unread') ? 'badge-warning' : 'badge-success'; ?>">
                    <?php echo $statusText; ?>
                </span>
            </td>
            <td>
                <?php if ($row['status'] == 'unread') { ?>
                    <a href="message-status.php?mark_as_read=<?php echo $row['id']; ?>" class="mark-as-read-btn">
                        <i class="fas fa-eye gray-icon"></i> Mark as Read
                    </a>
                <?php } else { ?>
                    <span>Read</span>
                <?php } ?>
                <a href="delete_message.php?id=<?= $row['id'] ?>" class="delete-btn">
                    <i class="fas fa-trash-alt gray-icon"></i>
                </a>
            </td>
        </tr>
    <?php
                $a++;
            }
        } else {
            echo "<tr><td colspan='7'>No messages found.</td></tr>";
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