<?php

include('includes/connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);

    if (isset($_FILES['icon']) && $_FILES['icon']['error'] == 0) {
        $icon_tmp = $_FILES['icon']['tmp_name'];
        $icon_name = $_FILES['icon']['name'];
        $icon_ext = pathinfo($icon_name, PATHINFO_EXTENSION);
        $icon_path = "uploads/" . uniqid() . "." . $icon_ext;


        if (move_uploaded_file($icon_tmp, $icon_path)) {

            $stmt = $conn->prepare("INSERT INTO services (name, icon, description, heading) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $icon_path, $description, $heading);
            $stmt->execute();
            $service_id = $stmt->insert_id; // Get the service ID
            $stmt->close();

            // Process the multiple language icons upload
            if (isset($_FILES['language_icons']) && $_FILES['language_icons']['error'][0] == 0) {
                foreach ($_FILES['language_icons']['name'] as $key => $image_name) {
                    $image_tmp = $_FILES['language_icons']['tmp_name'][$key];
                    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_path = "uploads/" . uniqid() . "." . $image_ext;

                    // Move the uploaded language icon to the desired directory
                    if (move_uploaded_file($image_tmp, $image_path)) {
                        // Insert language icons into the database
                        $stmt = $conn->prepare("INSERT INTO language_icons (service_id, image_path) VALUES (?, ?)");
                        $stmt->bind_param("is", $service_id, $image_path);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            }
            header("location:services.php");
 $msg = '<div class="alert alert-success">Service created successfully!<a href="services.php">View Sevices</a></div>';
  
        } else {
            $msg = '<div class="alert alert-danger">Error uploading service icon.';

        }
    } else {
        $msg = '<div class="alert alert-danger">Error uploading service icon.';
       
    }
} else {
    $msg = '<div class="alert alert-danger">Invalid request.';
}

$conn->close();
?>
