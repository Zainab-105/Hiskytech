<?php
include('includes/head.php');
include('includes/connection.php');
$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['productName'];
    $selling_price = $_POST['sellingPrice'];
    $short_description = $_POST['content'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $uploadDir = "uploads/"; // Directory where files will be uploaded
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $product_image_path = ""; // Default value if no file is uploaded

    // Check if a new image is uploaded
    if (!empty($_FILES['productImage']['name'])) {
        $productImageName = basename($_FILES["productImage"]["name"]);
        $product_image_path = $uploadDir . $productImageName;
        $productImageTmpName = $_FILES["productImage"]["tmp_name"];
        move_uploaded_file($productImageTmpName, $product_image_path);
    }

    // Fetch existing image path
    $existing_image_path = '';
    if (!empty($_POST['existingImagePath'])) {
        $existing_image_path = $_POST['existingImagePath'];
    }

    // If a new image is uploaded, use it; otherwise, use the existing one
    $image_to_use = !empty($product_image_path) ? $product_image_path : $existing_image_path;
    // Update SQL query
    $sql = "UPDATE products SET 
    product_name='$product_name',  
    selling_price='$selling_price', 
    short_description='$short_description',
    product_image_path='$image_to_use',
    catagorey='$category'
    WHERE product_id='$product_id'";



$result = mysqli_query($conn, $sql);

    if ($result) {
        $msg = '<div class="alert alert-success">Data updated successfully</div>';
        header('location:display.php');
    } else {
        $msg = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
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
                <div class="container">
                <?php
                if(!empty($msg)){
                    echo $msg;
                }
                ?>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    
                    <div>
                        <label for="productName" class="form-label">Product Name:</label>
                        <input type="text" id="productName" name="productName" class="form-control" value="<?php echo $row['product_name']; ?>" required>
                    </div>
            
                    
                    
                    <div class="row">
                        <div class="col">
                            <label for="sellingPrice" class='form-label'>Selling Price:</label>
                            <input type="number" id="sellingPrice" name="sellingPrice" class="form-control" value="<?php echo $row['selling_price']; ?>">
                        </div>
            
                        
                    </div>
                    
                    <label for="shortDescription" class='form-label'>Product Short Description:</label>
                    <textarea name="content" class="editor" rows="8"><?php echo $row['short_description']; ?></textarea><br><br>
                    <label for="brand" class='form-label'>Catagorey</label>
                                <select class="form-control" name="category" aria-label="Default select example" required>
                                <option selected  ><?php echo $row['catagorey']; ?></option>
                                    <?php

                                    $sql_cat = "SELECT * FROM `catagories`";
                                    $result_cat = mysqli_query($conn, $sql_cat);

                                    while ($fetch_cat = mysqli_fetch_assoc($result_cat)){
                                        ?>
                                          <option value="<?=$fetch_cat['name']?>"><?=$fetch_cat['name']?></option>

                                     <?php

                                    }


                                    ?>
 
  
</select>
                    <label for="newProductImage">Upload New Image:</label>
                    <input type="file" id="newProductImage" name="productImage"><br><br>
                    <input type="hidden" name="existingImagePath" value="<?php echo $row['product_image_path']; ?>">
                    <img src="<?php echo $row['product_image_path']; ?>" style="max-width: 200px;" alt="Product Image"><br><br>
                   

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <script>
                ClassicEditor
                    .create(document.querySelector('.editor'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>
                               
                                    </div>
                                </div>

                               
                    

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->
            <?php include('includes/footer.php')?> 
