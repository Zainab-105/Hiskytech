<?php
include('includes/connection.php');
include('includes/head.php');

ini_set('display_errors', 1);

// Get project_id from the URL
$project_id = $_GET['id'];

// Fetch project data from the database
$sql = "SELECT * FROM projects WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $project_id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

// Fetch related data (problem statements, solutions, features, technology images)
$problem_statements_sql = "SELECT * FROM problem_statements WHERE project_id = ?";
$stmt_problem_statements = $conn->prepare($problem_statements_sql);
$stmt_problem_statements->bind_param('i', $project_id);
$stmt_problem_statements->execute();
$problem_statements_result = $stmt_problem_statements->get_result();
$problem_statements = $problem_statements_result->fetch_all(MYSQLI_ASSOC);

$solutions_sql = "SELECT * FROM solutions WHERE project_id = ?";
$stmt_solutions = $conn->prepare($solutions_sql);
$stmt_solutions->bind_param('i', $project_id);
$stmt_solutions->execute();
$solutions_result = $stmt_solutions->get_result();
$solutions = $solutions_result->fetch_all(MYSQLI_ASSOC);

$features_sql = "SELECT * FROM features WHERE project_id = ?";
$stmt_features = $conn->prepare($features_sql);
$stmt_features->bind_param('i', $project_id);
$stmt_features->execute();
$features_result = $stmt_features->get_result();
$features = $features_result->fetch_all(MYSQLI_ASSOC);

// Fetch and append images directly into the features array
foreach ($features as $index => &$feature) { // Use reference to modify the $features array
    $feature_id = $feature['id'];

    $feature_images_sql = "SELECT id AS image_id, feature_id, image_path FROM feature_images WHERE feature_id = ?";
    $stmt_feature_images = $conn->prepare($feature_images_sql);
    $stmt_feature_images->bind_param('i', $feature_id);
    $stmt_feature_images->execute();
    $feature_images_result = $stmt_feature_images->get_result();

    // Append each image data directly into the feature
    while ($image = $feature_images_result->fetch_assoc()) {
        foreach ($image as $key => $value) {
            $feature["image_$key"] = $value; // Prefix image keys with "image_"
        }
    }
}

$technology_images_sql = "SELECT * FROM technology_images WHERE project_id = ?";
$stmt_technology_images = $conn->prepare($technology_images_sql);
$stmt_technology_images->bind_param('i', $project_id);
$stmt_technology_images->execute();
$technology_images_result = $stmt_technology_images->get_result();
$technology_images = $technology_images_result->fetch_all(MYSQLI_ASSOC);

// Handle form submission for updating project details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $project_name = $_POST['project_name'];
    $project_heading = $_POST['project_heading'];
    $field = $_POST['field'];
    $description = $_POST['description'];
    $url = $_POST['url'];
    $project_logo = $_FILES['project_logo']['name'];
    $project_overview = $_FILES['project_overview']['name'];

    // Handle file uploads for project logo and overview image
    if ($project_logo) {
        $logo_path = 'uploads/' . basename($project_logo);
        move_uploaded_file($_FILES['project_logo']['tmp_name'], $logo_path);
    } else {
        $logo_path = $project['project_logo']; // Keep the existing logo if not updated
    }

    if ($project_overview) {
        $overview_path = 'uploads/' . basename($project_overview);
        move_uploaded_file($_FILES['project_overview']['tmp_name'], $overview_path);
    } else {
        $overview_path = $project['project_overview_image']; // Keep the existing overview image if not updated
    }

    // Update project details in the database
    $update_sql = "UPDATE projects SET project_name = ?, project_heading = ?, field = ?, description = ?, url = ?, project_logo = ?, project_overview_image = ? WHERE id = ?";
    $stmt_update = $conn->prepare($update_sql);
    $stmt_update->bind_param('sssssssi', $project_name, $project_heading, $field, $description, $url, $logo_path, $overview_path, $project_id);
    $stmt_update->execute();

    // Update related data (problem statements, solutions, features, etc.)
    if (isset($_POST['problem_statements'])) {
        $problem_statements = $_POST['problem_statements'];
        foreach ($problem_statements as $problem_statement_id => $problem_statement) {
            $update_problem_sql = "UPDATE problem_statements SET problem_statement = ? WHERE id = ?";
            $stmt_problem_update = $conn->prepare($update_problem_sql);
            $stmt_problem_update->bind_param('si', $problem_statement, $problem_statement_id);
            $stmt_problem_update->execute();
        }
    }

    if (isset($_POST['solutions'])) {
        $solutions = $_POST['solutions'];
        foreach ($solutions as $solution_id => $solution) {
            $update_solution_sql = "UPDATE solutions SET solution = ? WHERE id = ?";
            $stmt_solution_update = $conn->prepare($update_solution_sql);
            $stmt_solution_update->bind_param('si', $solution, $solution_id);
            $stmt_solution_update->execute();
        }
    }



    if (isset($_POST['features'])) { 
        foreach ($_POST['features'] as $index => $feature) {
            $feature_id = $feature['id'];
            $feature_description = $feature['description'] ?? '';
            $feature_image_id = $feature['image_id'] ?? null;
    
            // Debugging: Log feature details
            echo "<pre>";
            echo "Feature Description: " . htmlspecialchars($feature_description) . "\n";
            echo "Feature ID: " . $feature_id . "\n";
            echo "Feature Image ID: " . $feature_image_id . "\n";
            echo "Uploaded File: " . ($_FILES['feature_images']['name'][$index] ?? 'No file uploaded') . "\n";
            echo "</pre>";
    
            // Check and handle feature description
            if (!empty($feature_description)) {
                $check_description_query = "SELECT feature_description FROM features WHERE id = ?";
                $stmt_check_desc = $conn->prepare($check_description_query);
                $stmt_check_desc->bind_param('i', $feature_id);
                $stmt_check_desc->execute();
                $stmt_check_desc->store_result();
    
                if ($stmt_check_desc->num_rows > 0) {
                    // Update existing feature description
                    $update_description_query = "UPDATE features SET feature_description = ? WHERE id = ?";
                    $stmt_update_desc = $conn->prepare($update_description_query);
                    $stmt_update_desc->bind_param('si', $feature_description, $feature_id);
                    $stmt_update_desc->execute();
                } else {
                    // Insert new feature description
                    $insert_description_query = "INSERT INTO features (id, feature_description) VALUES (?, ?)";
                    $stmt_insert_desc = $conn->prepare($insert_description_query);
                    $stmt_insert_desc->bind_param('is', $feature_id, $feature_description);
                    $stmt_insert_desc->execute();
                }
            }
    
            // Handle file upload
            if (isset($_FILES['feature_images']['name'][$index]) && $_FILES['feature_images']['name'][$index] !== '') {
                $new_image_name = basename($_FILES['feature_images']['name'][$index]);
                $image_path = 'uploads/' . $new_image_name;
    
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['feature_images']['tmp_name'][$index], $image_path)) {
                    if ($feature_image_id) {
                        // Update the existing image
                        $update_image_query = "UPDATE feature_images SET image_path = ? WHERE id = ?";
                        $stmt_update_image = $conn->prepare($update_image_query);
                        $stmt_update_image->bind_param('si', $image_path, $feature_image_id);
                        $stmt_update_image->execute();
                    } else {
                        // Insert a new image record
                        $insert_image_query = "INSERT INTO feature_images (feature_id, image_path) VALUES (?, ?)";
                        $stmt_insert_image = $conn->prepare($insert_image_query);
                        $stmt_insert_image->bind_param('is', $feature_id, $image_path);
                        $stmt_insert_image->execute();
                    }
                } else {
                    echo "Error moving uploaded file for feature ID: $feature_id.";
                }
            }
        }
    } 

    
    
    

    if (isset($_FILES['technology_images']) && isset($_POST['technology_id'])) {
        foreach ($_FILES['technology_images']['name'] as $index => $image_name) {
            $technology_id = $_POST['technology_id'][$index]; // Get the corresponding ID
    
            if ($image_name) { // Check if a file was uploaded for this ID
                $image_path = 'uploads/' . basename($image_name);
    
                // Move the uploaded file to the uploads directory
                if (move_uploaded_file($_FILES['technology_images']['tmp_name'][$index], $image_path)) {
                    // Update the database with the new image path
                    $update_image_sql = "UPDATE technology_images SET image_path = ? WHERE id = ?";
                    $stmt_image_update = $conn->prepare($update_image_sql);
                    $stmt_image_update->bind_param('si', $image_path, $technology_id);
    
                    if (!$stmt_image_update->execute()) {
                        // Handle query failure (optional logging or error message)
                        echo "Error updating image for ID: $technology_id";
                    }
                } else {
                    // Handle file move failure
                    echo "Failed to upload image for ID: $technology_id";
                }
            }
        }
    }
    

    header('Location:projects.php');
}
?>

<body>
<div id="wrapper">
    <?php include('includes/sidebar.php') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('includes/nav.php'); ?>
            <div class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">Edit Project</h1>
                <?php if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
             <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="project_name" class="form-label">Project Name</label>
            <input type="text" id="project_name" name="project_name" class="form-control" value="<?php echo htmlspecialchars($project['project_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="project_heading" class="form-label">Project Heading</label>
            <input type="text" id="project_heading" name="project_heading" class="form-control" value="<?php echo htmlspecialchars($project['project_heading']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="field" class="form-label">Field</label>
            <input type="text" id="field" name="field" class="form-control" value="<?php echo htmlspecialchars($project['field']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($project['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">Project URL</label>
            <input type="url" id="url" name="url" class="form-control" value="<?php echo htmlspecialchars($project['url']); ?>">
        </div>
        <div class="mb-3">
            <label for="project_logo" class="form-label">Project Logo</label>
            <input type="file" id="project_logo" name="project_logo" class="form-control">
            <img src="<?php echo htmlspecialchars($project['project_logo']); ?>" alt="Current Logo" class="img-fluid mt-2">
        </div>
        <div class="mb-3">
            <label for="project_overview" class="form-label">Project Overview Image</label>
            <input type="file" id="project_overview" name="project_overview" class="form-control">
            <img src="<?php echo htmlspecialchars($project['project_overview_image']); ?>" alt="Current Overview Image" class="img-fluid mt-2">
        </div>

        <h4>Problem Statements</h4>
        <div id="problem-statements">
            <?php foreach ($problem_statements as $problem) : ?>
                <div class="mb-3">
                    <input type="text" name="problem_statements[]" class="form-control" value="<?php echo htmlspecialchars($problem['problem_statement']); ?>">
                </div>
            <?php endforeach; ?>
           
        </div>

        <h4>Solutions</h4>
        <div id="solutions">
            <?php foreach ($solutions as $solution) : ?>
                <div class="mb-3">
                    <input type="text" name="solutions[]" class="form-control" value="<?php echo htmlspecialchars($solution['solution']); ?>">
                </div>
            <?php endforeach; ?>
           
        </div>

       <h4>Features</h4>
       <div id="features">
    <h4>Existing Features</h4>
    <?php foreach ($features as $feature) : ?>
        <div class="feature-item mb-4">
    <!-- Feature Description -->
    <label>Feature Description</label>
    <textarea 
        name="features[<?php echo $feature['id']; ?>][description]" 
        rows="3" 
        class="form-control" 
        placeholder="Feature Description"><?php echo htmlspecialchars($feature['feature_description'] ?? ''); ?></textarea>
    
    <!-- Hidden Input for Feature ID -->
    <input type="hidden" name="features[<?php echo $feature['id']; ?>][id]" value="<?php echo $feature['id']; ?>">
    
    <!-- Current Image -->
    <?php if (!empty($feature['image_image_path'])) : ?>
        <label>Current Image</label>
        <img 
            src="<?php echo htmlspecialchars($feature['image_image_path']); ?>" 
            alt="Feature Image" 
            class="img-fluid my-2" 
            style="max-width: 200px;">
        <input 
            type="hidden" 
            name="features[<?php echo $feature['id']; ?>][image_id]" 
            value="<?php echo htmlspecialchars($feature['image_image_id']); ?>">
    <?php endif; ?>

    <!-- Replace Image -->
    <label>Replace Image</label>
    <input 
        type="file" 
        name="feature_images[<?php echo $feature['id']; ?>]" 
        class="form-control mt-2">
</div>

    <?php endforeach; ?>


        <h4>Technology Images</h4>
        <div id="technology-images">
            <?php foreach ($technology_images as $image) : ?>
                
                <div class="mb-3">
                <input type="text" name="technology_id[]" class="form-control" value="<?=$image['id']?>" hidden>
                    <input type="file" name="technology_images[]" class="form-control">
                    <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="Tech Image" class="img-fluid mt-2">
                </div>
            <?php endforeach; ?>
           
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
            </div>
        </div>
    </div>
</div>
<script>
        ClassicEditor
            .create(document.querySelector('.editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
