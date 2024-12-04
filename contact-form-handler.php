<?php
include('includes/connection.php');  // Ensure your connection.php is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';  // Changed to 'phone_number' based on your form
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    
    // Set default status as 'pending' for new messages
    $status = 'unread';

    // Simple validation (can be extended)
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Prepare and execute SQL to insert data into the 'messages' table
    $stmt = $conn->prepare("INSERT INTO messages (first_name, last_name, email, phone, message, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phone, $message, $status);  // Bind the parameters

    if ($stmt->execute()) {
        // If data insertion is successful
        echo json_encode(['status' => 'success', 'message' => 'Thank you for reaching out! We will get back to you soon.']);
    } else {
        // If there is an issue inserting the data
        echo json_encode(['status' => 'error', 'message' => 'There was an error saving your message. Please try again later.']);
    }

    // Close the statement
    $stmt->close();
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}
?>
