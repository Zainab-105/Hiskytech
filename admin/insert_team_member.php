<?php
include('includes/connection.php'); // Ensure your database connection is included

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $linkedin_url = mysqli_real_escape_string($conn, $_POST['linkedin_url']);
    $facebook_url = mysqli_real_escape_string($conn, $_POST['facebook_url']);
    $instagram_url = mysqli_real_escape_string($conn, $_POST['instagram_url']);
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
        $image_tmp = $_FILES['profile_image']['tmp_name'];
        $image_name = $_FILES['profile_image']['name'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $profile_image_path = "uploads/" . uniqid() . "." . $image_ext;

        if (move_uploaded_file($image_tmp, $profile_image_path)) {
            $query = "INSERT INTO team_members (name, role, profile_image, linkedin_url, facebook_url, instagram_url)
                      VALUES ('$name', '$role', '$profile_image_path', '$linkedin_url', '$facebook_url', '$instagram_url')";

            if (mysqli_query($conn, $query)) {
                echo "<div class='alert alert-success'>Team member added successfully!</div>";
                header('location:index.php');
            } else {
                echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Failed to upload profile image.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Please upload a valid profile image.</div>";
        header('location:index.php');
    }
}
?>
