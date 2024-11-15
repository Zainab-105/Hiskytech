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
                        <h1 class="h3 mb-0 text-gray-800">Users</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                       
                    <div class="col-lg-12">
                     

                     <table class='myTable' class="table table-bordered table-hover dt-responsive" style="backgroung_colr:white">

                         <thead>
                             <tr>
                                 <th>Sr.</th>
                                 <th>Username</th>
                                 <th>Email</th>
                               <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                         <?php
                                $a = 1;
                                $sql = "SELECT * FROM users ORDER BY uid DESC";
                                $query = mysqli_query($conn, $sql);
                                if ($query) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        $id = $row['uid'];
                                ?>
                                     <tr>
                                         <td><?php echo $a ?></td>
                                         <td><?php echo $row['username']; ?></td>
                                        
                                         <th><?php echo $row['email']; ?></th>
                                         <td>
                                             <a href="action.php?id=<?= $row['uid'] ?>" class="delete-btn"><i class="fas fa-trash-alt gray-icon"></i></a>
                                            
                                           
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