<?php

include 'includes/config.php'; 

if (isset($_GET['id'])) {
    $developer_id = intval($_GET['id']); 


    mysqli_begin_transaction($conn);

    try {

        $fetchImages = "SELECT feature_image, benefit_image FROM developers WHERE id = ?";
        $stmt = mysqli_prepare($conn, $fetchImages);
        mysqli_stmt_bind_param($stmt, 'i', $developer_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $images = mysqli_fetch_assoc($result);

          
            if (!empty($images['feature_image']) && file_exists($images['feature_image'])) {
                unlink($images['feature_image']);
            }

      
            if (!empty($images['benefit_image']) && file_exists($images['benefit_image'])) {
                unlink($images['benefit_image']);
            }
        }

        $deleteFeatures = "DELETE FROM app_features WHERE developer_id = ?";
        $stmt = mysqli_prepare($conn, $deleteFeatures);
        mysqli_stmt_bind_param($stmt, 'i', $developer_id);
        mysqli_stmt_execute($stmt);

        $deleteBenefits = "DELETE FROM developers_benefits WHERE developer_id = ?";
        $stmt = mysqli_prepare($conn, $deleteBenefits);
        mysqli_stmt_bind_param($stmt, 'i', $developer_id);
        mysqli_stmt_execute($stmt);

        $deleteServices = "DELETE FROM developer_services WHERE developer_id = ?";
        $stmt = mysqli_prepare($conn, $deleteServices);
        mysqli_stmt_bind_param($stmt, 'i', $developer_id);
        mysqli_stmt_execute($stmt);

        $deleteDeveloper = "DELETE FROM developers WHERE id = ?";
        $stmt = mysqli_prepare($conn, $deleteDeveloper);
        mysqli_stmt_bind_param($stmt, 'i', $developer_id);
        mysqli_stmt_execute($stmt);


        mysqli_commit($conn);

        header("Location: developers.php?message=Developer deleted successfully");
        exit();
    } catch (Exception $e) {
  
        mysqli_rollback($conn);
        echo "Error deleting developer: " . $e->getMessage();
    }
} else {
    echo "No developer ID specified.";
}
?>
