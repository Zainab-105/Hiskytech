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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Services</h1>
                        <a href="services.php" class="btn btn-primary">Add Services</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
    <div class="col-lg-12">
        <table class="myTable table table-bordered table-hover dt-responsive" style="background-color:white">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Service Name</th>
                    <th>Service Icon</th>
                    <th>Service Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $a = 1;
                    $sql = "SELECT * FROM services ORDER BY id DESC";
                    $query = mysqli_query($conn, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_array($query)) {
                            $service_id = $row['id'];
                ?>
                            <tr>
                                <!-- Sr. No. -->
                                <td><?php echo $a; ?></td>

                                <!-- Service Name Column -->
                                <td><?php echo $row['name']; ?></td>

                                <!-- Service Icon Column -->
                                <td>
                                    <?php if (!empty($row['icon'])) { ?>
                                        <img src="<?php echo $row['icon']; ?>" alt="Service Icon" width="50" height="50">
                                    <?php } else { ?>
                                        No Icon
                                    <?php } ?>
                                </td>

                                <!-- Service Details Column -->
                                <td>
                                    <strong>Heading:</strong> <?php echo $row['heading']; ?><br>
                                    <strong>Description:</strong> <?php echo $row['description']; ?><br>
                                    <strong>Language Icons:</strong><br>
                                    <?php
                                        // Fetch associated language icons for this service
                                        $icon_sql = "SELECT image_path FROM language_icons WHERE service_id = $service_id";
                                        $icon_query = mysqli_query($conn, $icon_sql);
                                        if ($icon_query && mysqli_num_rows($icon_query) > 0) {
                                            while ($icon_row = mysqli_fetch_array($icon_query)) {
                                                echo '<img src="' . $icon_row['image_path'] . '" alt="Language Icon" width="30" height="30" style="margin-right: 5px;">';
                                            }
                                        } else {
                                            echo "No language icons available.";
                                        }
                                    ?>
                                </td>

                                <!-- Action Column -->
                                <td>
                                    <a href="action.php?id=<?= $service_id ?>" class="delete-btn"><i class="fas fa-trash-alt gray-icon"></i></a>
                                    <a href="action.php?id=<?= $service_id ?>" class="edit-btn"><i class="fas fa-edit gray-icon"></i></a>
                                </td>
                            </tr>
                <?php
                            $a++;
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
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