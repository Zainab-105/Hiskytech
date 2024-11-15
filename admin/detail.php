<?php
include ('includes/head.php');
include ('includes/config.php');
?>

<!-- Include Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z24UERb8KS92egUuhW+pYl25X8nxw2+jspjc5X" crossorigin="anonymous">

<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include ('includes/sidebar.php') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include ('includes/nav.php'); ?>
                <?php
   if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Perform deletion query
    $sql = "SELECT * FROM products where product_id='$productId'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        while ($row = mysqli_fetch_array($query)) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 card p-5 mx-auto mt-5">
                <h2>Details of Product</h2>
            <ul>
       
        <li><b>Product_Slug: </b><?php echo $row['product_slug']; ?></li>
        <li><b>Shipping_Percentage: </b><?= $row['shipping_percentage'] ?></li>
        <li><b>Selling_Price: </b><?php echo $row['selling_price']; ?></li>
        <li><b>Discount_Price: </b><?php echo $row['discount_price']; ?></li>
        <li><b>Short_Discription: </b><?php echo $row['short_description']; ?></li>
   
      
    </ul>
            </div>
        </div>
    </div>
  
    <?php
      }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
        // Invalid request
        echo 'Invalid request';
    }
    ?>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</script>

</body>
