<?php
include 'includes/connection.php';

if (isset($_GET['video_id'])) {
    $video_id = intval($_GET['video_id']); // Get the video ID from the URL

    // Fetch the video details from the database
    $query = "SELECT * FROM videos WHERE id = $video_id";
    $result = mysqli_query($conn, $query);
    $video = mysqli_fetch_assoc($result);

    if ($video) {
        // Check if the video file exists, then delete it
        if (file_exists($video['video'])) {
            unlink($video['video']); // Delete the file from the server
        }

        // Delete the video record from the database
        $deleteQuery = "DELETE FROM videos WHERE id = $video_id";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Video deleted successfully.";
        } else {
            echo "Error deleting video: " . mysqli_error($conn);
        }
    } else {
        echo "Video not found.";
    }
} else {
    echo "Invalid request.";
}

// Redirect to the video list page after deletion
header("Location: view-course-video.php");
exit;
?>
