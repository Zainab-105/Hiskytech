<?php
include('includes/config.php');


if (isset($_GET['id'])) {
    $project_id = intval($_GET['id']);

    try {

        $conn->begin_transaction();


        $conn->query("DELETE FROM problem_statements WHERE project_id = $project_id");
        $conn->query("DELETE FROM solutions WHERE project_id = $project_id");
        $technology_imgs_result = $conn->query("SELECT image_path FROM technology_images WHERE project_id = $project_id");
        while($images=$technology_imgs_result->fetch_assoc()){
         $technology_img = $images['image_path'];
         if(file_exists($technology_img )){
             unlink($technology_img);
         }
        }
        $conn->query("DELETE FROM technology_images WHERE project_id = $project_id");


        $feature_ids_result = $conn->query("SELECT id FROM features WHERE project_id = $project_id");
        while ($feature = $feature_ids_result->fetch_assoc()) {
           
            $feature_id = $feature['id'];
            $feature_imgs_result = $conn->query("SELECT image_path FROM feature_images WHERE feature_id = $feature_id");
           while($images=$feature_imgs_result->fetch_assoc()){
            $feature_img = $images['image_path'];
            if(file_exists($feature_img )){
                unlink($feature_img);
            }
           }
            $conn->query("DELETE FROM feature_images WHERE feature_id = $feature_id");
        }
        $conn->query("DELETE FROM features WHERE project_id = $project_id");


        $conn->query("DELETE FROM projects WHERE id = $project_id");

        $conn->commit();

        header('location:projects.php');
    } catch (Exception $e) {

        $conn->rollback();
        echo "Error deleting project: " . $e->getMessage();
    }
}
?>
