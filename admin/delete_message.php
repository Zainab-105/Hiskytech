<?php
include('includes/connection.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM messages WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: messages.php"); 
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>