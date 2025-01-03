<?php
include('includes/connection.php');
if (isset($_GET['id'])) {
   $id=$_GET['id'];
   echo $id;
    $query = "DELETE FROM messages WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: messages.php"); 
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>