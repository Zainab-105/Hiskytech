<?php
session_start();
include('includes/connection.php');

if (isset($_GET['id'])) {
    $serviceId = $_GET['id'];
    $sql = "DELETE FROM services WHERE id='$serviceId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {

        $imageQuery = "SELECT image_path FROM language_icons WHERE service_id='$serviceId'";
        $imageResult = mysqli_query($conn, $imageQuery);


        while ($row = mysqli_fetch_assoc($imageResult)) {
            $imagePath = 'uploads/' . $row['image_path'];

            if (file_exists($imagePath)) {
                unlink($imagePath); 
            }
        }


        $sql = "DELETE FROM language_icons WHERE service_id='$serviceId'";
        mysqli_query($conn, $sql);


        $_SESSION['$msg'] = '<div class="alert alert-success">Service deleted successfully.</div>';
        header('Location: services.php');
        exit;
    } else {

        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    $_SESSION['$msg'] = '<div class="alert alert-danger">Invalid request.</div>';
}
?>
