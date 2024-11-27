<?php
include('includes/config.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $course_id = intval($_GET['id']); 


    $conn->begin_transaction();

    try {
   
        $delete_videos_query = "DELETE FROM videos WHERE course_id = ?";
        $stmt_videos = $conn->prepare($delete_videos_query);
        $stmt_videos->bind_param("i", $course_id);
        $stmt_videos->execute();

        $delete_course_query = "DELETE FROM courses WHERE id = ?";
        $stmt_course = $conn->prepare($delete_course_query);
        $stmt_course->bind_param("i", $course_id);
        $stmt_course->execute();

     
        $conn->commit();

        header("Location: courses.php?message=Course+and+associated+videos+deleted+successfully");
        exit;

    } catch (Exception $e) {
      
        $conn->rollback();
        echo "Error deleting course and videos: " . $e->getMessage();
    }
} else {
    echo "Invalid course ID.";
}
?>
