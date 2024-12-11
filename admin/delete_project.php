<?php
include('includes/config.php');

// Handle delete action
if (isset($_GET['id'])) {
    $project_id = intval($_GET['id']);

    try {
        // Start transaction
        $conn->begin_transaction();

        // Delete associated data from related tables
        $conn->query("DELETE FROM problem_statements WHERE project_id = $project_id");
        $conn->query("DELETE FROM solutions WHERE project_id = $project_id");
        $conn->query("DELETE FROM technology_images WHERE project_id = $project_id");

        // Delete feature images and features
        $feature_ids_result = $conn->query("SELECT id FROM features WHERE project_id = $project_id");
        while ($feature = $feature_ids_result->fetch_assoc()) {
            $feature_id = $feature['id'];
            $conn->query("DELETE FROM feature_images WHERE feature_id = $feature_id");
        }
        $conn->query("DELETE FROM features WHERE project_id = $project_id");

        // Delete the project itself
        $conn->query("DELETE FROM projects WHERE id = $project_id");

        // Commit transaction
        $conn->commit();

        header('location:projects.php');
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        echo "Error deleting project: " . $e->getMessage();
    }
}
?>
