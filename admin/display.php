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
                       
                        <h1 class="h3 mb-0 text-gray-800">Products</h1>
                        <a href="products.php" class='btn btn-primary'>Add Product</a>
                     
                    </div>
                    <div class="row ">
                    <div class="col-lg-12 ">
                     

                        <table class="myTable" class="table table-bordered table-hover dt-responsive">

                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Product_Image</th>
                                    <th>product_name</th>
                                    <th>Selling Price</th>
                                    <th>Category</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $a = 1;
                                // Fetch data from descending order by id
                                $sql = "SELECT * FROM products ORDER BY product_id DESC";
                                $query = mysqli_query($conn, $sql);
                                if ($query) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        $id = $row['product_id'];
                                ?>
                                        <tr>
                                            <td><?php echo $a ?></td>
                                            <td><img src="<?php echo $row['product_image_path']; ?>"></td>
                                            <td><?php echo $row['product_name']; ?></td>
                                            <td><?php echo $row['selling_price']; ?></td>
                                            <td><?php echo $row['catagorey']; ?></td>
                                            

                                            <td>
                                                <a href="delete.php?id=<?= $row['product_id'] ?>" class="delete-btn"><i class="fas fa-trash-alt gray-icon"></i></a>
                                                <a href="edit.php?id=<?= $row['product_id'] ?>" class="edit-btn"><i class="fas fa-edit gray-icon"></i></a>
                                            
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
      

<?php include('includes/footer.php')?>