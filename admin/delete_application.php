<?php
include('includes/connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to fetch the file paths of photo and education document
    $query = "SELECT photo_path, education_file_path FROM applications WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $photo_path = $row['photo_path'];
        $education_file_path = $row['education_file_path'];

        // Unlink (delete) the photo if it exists
        if (file_exists($photo_path)) {
            unlink($photo_path);  // Deletes the photo file
        }

        // Unlink (delete) the education file if it exists
        if (file_exists($education_file_path)) {
            unlink($education_file_path);  // Deletes the education document
        }

        // Delete the record from the database
        $delete_query = "DELETE FROM applications WHERE id = $id";
        if (mysqli_query($conn, $delete_query)) {
            header("Location: job-applications.php");  // Redirect to messages or another page
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching file paths: " . mysqli_error($conn);
    }
}
?>
