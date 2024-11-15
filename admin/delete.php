<?php
include('includes/connection.php');

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Perform deletion query
    $sql = "DELETE FROM products WHERE product_id='$productId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Deletion successful
        echo 'Product deleted successfully';
        header('location:display.php');
    } else {
        // Error occurred during deletion
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    // Invalid request
    echo 'Invalid request';
}
?>
