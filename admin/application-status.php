<?php
include('includes/connection.php');
if (isset($_GET['mark_as_read'])) {
    $application_id = $_GET['mark_as_read'];
    
  
    $sql = "UPDATE applications SET status = 'reviewd' WHERE id = $application_id";
    if (mysqli_query($conn, $sql)) {
        // Redirect or display success message
        header("Location: job-applications.php"); 
    } else {
        echo "Error updating application status: " . mysqli_error($conn);
    }
}
