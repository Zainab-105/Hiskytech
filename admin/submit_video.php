<?php
include('includes/config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['video'])) {
  $video = $_FILES['video']; 
    $upload_dir = 'uploads/videos/';
    $video_name = $video['name'];
    $video_tmp_name = $video['tmp_name'];
    $video_size = $video['size'];
    $video_error = $video['error'];
    if ($video_error === 0) {
        $video_extension = pathinfo($video_name, PATHINFO_EXTENSION);
        $allowed_extensions = array('mp4', 'mov', 'avi'); 
        if (in_array($video_extension, $allowed_extensions)) {
            $new_video_name = uniqid('video_', true) . '.' . $video_extension;
            $video_destination = $upload_dir . $new_video_name;
            $sql = "SELECT video FROM company_video LIMIT 1"; 
            $result = mysqli_query($conn, $sql);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $old_video = mysqli_fetch_assoc($result)['video'];
                $old_video_path = $upload_dir . $old_video;
                if (file_exists($old_video_path)) {
                    unlink($old_video_path);
                }

                $delete_sql = "DELETE FROM company_video";
                mysqli_query($conn, $delete_sql);
            }
            if (move_uploaded_file($video_tmp_name, $video_destination)) {
                $insert_sql = "INSERT INTO company_video (video) VALUES ('$new_video_name')";
                if (mysqli_query($conn, $insert_sql)) {
                    header('location:videos.php');
                    echo "Video uploaded successfully.";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Error uploading the video file.";
            }
        } else {
            echo "Invalid file type. Please upload a video file.";
        }
    } else {
        echo "Error: " . $video_error;
    }
} else {
    echo "No file uploaded.";
}
?>
