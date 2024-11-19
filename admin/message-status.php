<?php
include('includes/connection.php');
if (isset($_GET['mark_as_read'])) {
    $message_id = $_GET['mark_as_read'];
    
  
    $sql = "UPDATE messages SET status = 'read' WHERE id = $message_id";
    if (mysqli_query($conn, $sql)) {
        // Redirect or display success message
        header("Location: messages.php"); 
    } else {
        echo "Error updating message status: " . mysqli_error($conn);
    }
}
