<?php
include('includes/connection.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Perform deletion query
    $sql = "DELETE FROM users WHERE uid='$userId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Deletion successful
        echo 'Product deleted successfully';
        header('location:users.php');
    } else {
        // Error occurred during deletion
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    // Invalid request
    echo 'Invalid request';
}



?>
