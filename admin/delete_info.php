<?php
include('includes/connection.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM contact_info WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: info.php"); 
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
