<?php
include('includes/config.php'); // Include your database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $project_name = $_POST['project_name'];
    $project_heading = $_POST['project_heading'];
    $field = $_POST['field'];
    $description = $_POST['description'];


    $project_logo = '';
    if (!empty($_FILES['project_logo']['name'])) {
        $project_logo = 'uploads/' . time() . '_' . $_FILES['project_logo']['name'];
        move_uploaded_file($_FILES['project_logo']['tmp_name'], $project_logo);
    }


    $project_overview_image = '';
    if (!empty($_FILES['project_overview']['name'])) {
        $project_overview_image = 'uploads/' . time() . '_' . $_FILES['project_overview']['name'];
        move_uploaded_file($_FILES['project_overview']['tmp_name'], $project_overview_image);
    }

    $conn->begin_transaction();

    try {

        $stmt = $conn->prepare("INSERT INTO projects (project_name, project_heading, project_logo, field, description, project_overview_image) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $project_name, $project_heading, $project_logo, $field, $description, $project_overview_image);
        $stmt->execute();
        $project_id = $stmt->insert_id;


        if (!empty($_POST['problem_statements'])) {
            $stmt = $conn->prepare("INSERT INTO problem_statements (project_id, problem_statement) VALUES (?, ?)");
            foreach ($_POST['problem_statements'] as $problem) {
                $stmt->bind_param('is', $project_id, $problem);
                $stmt->execute();
            }
        }


        if (!empty($_POST['solutions'])) {
            $stmt = $conn->prepare("INSERT INTO solutions (project_id, solution) VALUES (?, ?)");
            foreach ($_POST['solutions'] as $solution) {
                $stmt->bind_param('is', $project_id, $solution);
                $stmt->execute();
            }
        }

        if (!empty($_POST['features'])) {
            $stmt_feature = $conn->prepare("INSERT INTO features (project_id, feature_description) VALUES (?, ?)");
            $stmt_image = $conn->prepare("INSERT INTO feature_images (feature_id, image_path) VALUES (?, ?)");
        
            foreach ($_POST['features'] as $index => $feature) {
               
                $stmt_feature->bind_param('is', $project_id, $feature);
                $stmt_feature->execute();
                $feature_id = $stmt_feature->insert_id;
        
   
                if (!empty($_FILES['feature_images']['name'][$index])) {
                    foreach ($_FILES['feature_images']['tmp_name'][$index] as $img_index => $tmp_name) {
                        $feature_image = 'uploads/' . time() . '_' . $_FILES['feature_images']['name'][$index][$img_index];
                        move_uploaded_file($tmp_name, $feature_image);
        
                        $stmt_image->bind_param('is', $feature_id, $feature_image);
                        $stmt_image->execute();
                    }
                }
            }
        }

        if (!empty($_FILES['technology_images']['name'])) {
            $stmt = $conn->prepare("INSERT INTO technology_images (project_id, image_path) VALUES (?, ?)");
            foreach ($_FILES['technology_images']['tmp_name'] as $index => $tmp_name) {
                $tech_image = 'uploads/' . time() . '_' . $_FILES['technology_images']['name'][$index];
                move_uploaded_file($tmp_name, $tech_image);

                $stmt->bind_param('is', $project_id, $tech_image);
                $stmt->execute();
            }
        }


        $conn->commit();
header('location:projects.php');
    } catch (Exception $e) {

        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>