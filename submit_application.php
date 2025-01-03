<?php
include('includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $firstName = htmlspecialchars($_POST['first_name']);
    $job_id = htmlspecialchars($_POST['job_id']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $headline = htmlspecialchars($_POST['headline']);
    $phoneNumber = htmlspecialchars($_POST['phone_number']);
    $address = htmlspecialchars($_POST['address']);
    $status="unreviewd";
    // Initialize error array
    $errors = [];

    // Validate required fields
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }
    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($phoneNumber)) {
        $errors[] = "Phone number is required.";
    }
    if (empty($address)) {
        $errors[] = "Address is required.";
    }

    // Check if there are any validation errors
    if (!empty($errors)) {
        // Display all errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        exit;
    }

    // Handle photo upload (required)
    $photoPath = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo'];
        $photoName = time() . "_" . basename($photo['name']);
        $targetDir = "uploads/photos/";
        $photoPath = $targetDir . $photoName;

        // Create the directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($photo['tmp_name'], $photoPath)) {
            echo "<p style='color: red;'>Error uploading photo.</p>";
            exit;
        }
    } else {
        echo "<p style='color: red;'>Photo is required.</p>";
        exit;
    }

    // Handle education file upload (optional)
    $educationFilePath = null;
    if (isset($_FILES['education_file']) && $_FILES['education_file']['error'] == 0) {
        $educationFile = $_FILES['education_file'];
        $eduFileName = time() . "_" . basename($educationFile['name']);
        $eduTargetDir = "uploads/education/";
        $educationFilePath = $eduTargetDir . $eduFileName;

        // Create the directory if it doesn't exist
        if (!file_exists($eduTargetDir)) {
            mkdir($eduTargetDir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($educationFile['tmp_name'], $educationFilePath)) {
            echo "<p style='color: red;'>Error uploading education file.</p>";
            exit;
        }
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO applications (job_id,first_name, last_name, email, headline, phone_number, address, photo_path, education_file_path,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)");
    $stmt->bind_param("isssssssss",$job_id,$firstName, $lastName, $email, $headline, $phoneNumber, $address, $photoPath, $educationFilePath,$status);

    try {
        $stmt->execute();
        echo "<p style='color: green;'>Application submitted successfully.</p>";
    } catch (mysqli_sql_exception $e) {
        // Handle email duplication error
        if ($e->getCode() === 1062) {
            echo "<p style='color: red;'>The email address is already registered.</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
