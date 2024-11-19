<?php
include('includes/connection.php');

if (isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $serviceId = $_GET['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    
    // Update service icon if a new file is uploaded
    if (isset($_FILES['icon']) && $_FILES['icon']['error'] == 0) {
        $icon_tmp = $_FILES['icon']['tmp_name'];
        $icon_name = $_FILES['icon']['name'];
        $icon_ext = pathinfo($icon_name, PATHINFO_EXTENSION);
        $icon_path = "uploads/" . uniqid() . "." . $icon_ext;
        
        if (move_uploaded_file($icon_tmp, $icon_path)) {
            $updateService = "UPDATE services SET name = ?, icon = ?, description = ?, heading = ? WHERE id = ?";
            $stmt = $conn->prepare($updateService);
            $stmt->bind_param("ssssi", $name, $icon_path, $description, $heading, $serviceId);
        } else {
            echo "Error uploading new icon.";
            exit;
        }
    } else {
        // Update without changing the icon
        $updateService = "UPDATE services SET name = ?, description = ?, heading = ? WHERE id = ?";
        $stmt = $conn->prepare($updateService);
        $stmt->bind_param("sssi", $name, $description, $heading, $serviceId);
    }
    
    $stmt->execute();
    $stmt->close();

    // Update or add language icons
    if (isset($_FILES['language_icons']) && $_FILES['language_icons']['error'][0] == 0) {
        foreach ($_FILES['language_icons']['name'] as $key => $image_name) {
            $image_tmp = $_FILES['language_icons']['tmp_name'][$key];
            $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_path = "uploads/" . uniqid() . "." . $image_ext;

            if (move_uploaded_file($image_tmp, $image_path)) {
                $stmt = $conn->prepare("INSERT INTO language_icons (service_id, image_path) VALUES (?, ?) ON DUPLICATE KEY UPDATE image_path = ?");
                $stmt->bind_param("iss", $serviceId, $image_path, $image_path);
                $stmt->execute();
            }
        }
        $stmt->close();
    }

    $_SESSION['msg'] = '<div class="alert alert-success">Service updated successfully.</div>';
    header("Location: services.php");
    exit;
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger">Invalid request.</div>';
    header("Location: services.php");
    exit;
}
?>
