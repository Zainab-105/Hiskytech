<?php
include('includes/connection.php');

$response = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Set the status to 'unread' for new messages
    $status = 'unread';

    // Insert data into the database, including status
    $sql = "INSERT INTO messages (first_name, last_name, email, phone, message, status) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$message', '$status')";

    if (mysqli_query($conn, $sql)) {
        $response = ['status' => 'success', 'message' => 'Message sent successfully!'];
    } else {
        $response = ['status' => 'error', 'message' => 'Error: ' . mysqli_error($conn)];
    }
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
