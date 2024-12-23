<?php
include('includes/connection.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';  
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    

    $status = 'unread';


    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }


    $stmt = $conn->prepare("INSERT INTO messages (first_name, last_name, email, phone, message, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phone, $message, $status);  // Bind the parameters

    if ($stmt->execute()) {

        echo json_encode(['status' => 'success', 'message' => 'Thank you for reaching out! We will get back to you soon.']);
    } else {

        echo json_encode(['status' => 'error', 'message' => 'There was an error saving your message. Please try again later.']);
    }


    $stmt->close();
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}
?>
