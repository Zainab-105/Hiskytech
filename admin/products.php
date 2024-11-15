<?php
include ('includes/head.php');
include ('includes/connection.php');
include ('includes/config.php');
$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['productName'];
    $selected_category = $_POST['category'];
    $selling_price = $_POST['sellingPrice'];
    $short_description = $_POST['content'];
    $uploadDir = "uploads/"; // Directory where files will be uploaded
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $product_image_path = ""; // Default value if no file is uploaded


    if (!empty($_FILES['productImage']['name'])) {
        $productImageName = basename($_FILES["productImage"]["name"]);
        $product_image_path = $uploadDir . $productImageName;
        $productImageTmpName = $_FILES["productImage"]["tmp_name"];
        move_uploaded_file($productImageTmpName, $product_image_path);
    }


    $sql = "INSERT INTO Products (product_name, selling_price, short_description,catagorey, product_image_path ) VALUES ('$product_name','$selling_price','$short_description',(SELECT name FROM catagories WHERE id = '$selected_category'), '$product_image_path')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $msg = '<div class="alert alert-success">Data inserted successfully.<a href="display.php">View Data</a></div>';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include ('includes/sidebar.php') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include ('includes/nav.php'); ?>
                <div class="container">
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <div>
                            <label for="productName" class="form-label">Product Name:</label>
                            <input type="text" id="productName" name="productName" class="form-control" required>
                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="sellingPrice" class='form-label'>Selling Price:</label>
                                <input type="number" id="sellingPrice" name="sellingPrice" class="form-control">
                            </div>

                        </div>
                        <label for="shortDescription" class='form-label'>Product Short Description:</label>
                        <textarea name="content" class="editor" rows="8"></textarea><br><br>
                        <div class="row">
                            <div class="col">
                                <label for="brand" class='form-label'>Catagorey</label>
                                <select class="form-control" name="category" aria-label="Default select example" required>
                                <option selected value="" disabled>Open this select menu</option>
                                    <?php

                                    $sql_cat = "SELECT * FROM `catagories`";
                                    $result_cat = mysqli_query($conn, $sql_cat);

                                    while ($fetch_cat = mysqli_fetch_assoc($result_cat)){
                                        ?>
                                          <option value="<?=$fetch_cat['id']?>"><?=$fetch_cat['name']?></option>
                                           

                                     <?php

                                    }


                                    ?>
 
  
</select>

                            </div>
                        </div>

                        <label for="productImage">Insert Picture:</label>
                        <input type="file" id="productImage" class="form-control" name="productImage"><br><br>


                        <div class="col-12">
                            <button type="submit" class="btn btn-success" name='submit'>Save</button>
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
    <?php include ('includes/footer.php') ?>