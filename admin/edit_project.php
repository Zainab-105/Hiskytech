<?php
include('includes/head.php');
include('includes/config.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $project_id = intval($_GET['id']);

    // Fetch project details
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param('i', $project_id);
    $stmt->execute();
    $project = $stmt->get_result()->fetch_assoc();

    // Fetch associated data
    $stmt = $conn->prepare("SELECT * FROM problem_statements WHERE project_id = ?");
    $stmt->bind_param('i', $project_id);
    $stmt->execute();
    $problem_statements = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM solutions WHERE project_id = ?");
    $stmt->bind_param('i', $project_id);
    $stmt->execute();
    $solutions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM features WHERE project_id = ?");
    $stmt->bind_param('i', $project_id);
    $stmt->execute();
    $features = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM technology_images WHERE project_id = ?");
    $stmt->bind_param('i', $project_id);
    $stmt->execute();
    $technology_images = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Invalid project ID.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input sanitization and validation
    $project_name = $_POST['project_name'];
    $project_heading = $_POST['project_heading'];
    $field = $_POST['field'];
    $description = $_POST['description'];
    $project_url = $_POST['url'];

    // Handle file uploads with fallback
    $project_logo = !empty($_FILES['project_logo']['name']) 
        ? 'uploads/' . time() . '_' . $_FILES['project_logo']['name'] 
        : $project['project_logo'];
    if (!empty($_FILES['project_logo']['tmp_name'])) {
        move_uploaded_file($_FILES['project_logo']['tmp_name'], $project_logo);
    }

    $project_overview_image = !empty($_FILES['project_overview']['name']) 
        ? 'uploads/' . time() . '_' . $_FILES['project_overview']['name'] 
        : $project['project_overview_image'];
    if (!empty($_FILES['project_overview']['tmp_name'])) {
        move_uploaded_file($_FILES['project_overview']['tmp_name'], $project_overview_image);
    }

    // Begin transaction
    $conn->begin_transaction();
    try {
        // Update project details
        $stmt = $conn->prepare(
            "UPDATE projects 
             SET project_name = ?, project_heading = ?, project_logo = ?, field = ?, url = ?, description = ?, project_overview_image = ? 
             WHERE id = ?"
        );
        $stmt->bind_param('sssssssi', $project_name, $project_heading, $project_logo, $field, $project_url, $description, $project_overview_image, $project_id);
        $stmt->execute();

        // Update problem statements
        $stmt = $conn->prepare("DELETE FROM problem_statements WHERE project_id = ?");
        $stmt->bind_param('i', $project_id);
        $stmt->execute();

        if (!empty($_POST['problem_statements'])) {
            $stmt = $conn->prepare("INSERT INTO problem_statements (project_id, problem_statement) VALUES (?, ?)");
            foreach ($_POST['problem_statements'] as $problem) {
                $stmt->bind_param('is', $project_id, $problem);
                $stmt->execute();
            }
        }

        // Handle Features
        if (!empty($_POST['features'])) {
            $stmt = $conn->prepare("DELETE FROM features WHERE project_id = ?");
            $stmt->bind_param('i', $project_id);
            $stmt->execute();

            foreach ($_POST['features'] as $index => $feature_description) {
                // Insert the feature description into the features table
                $stmt = $conn->prepare("INSERT INTO features (project_id, feature_description) VALUES (?, ?)");
                $stmt->bind_param('is', $project_id, $feature_description);
                $stmt->execute();

                $feature_id = $conn->insert_id;

  
                $feature_image = !empty($_FILES['feature_images']['name'][$index]) 
                    ? 'uploads/' . time() . '_' . $_FILES['feature_images']['name'][$index] 
                    : ($_POST['image_path'][$index] ?? '');

                if (!empty($_FILES['feature_images']['tmp_name'][$index])) {
                    move_uploaded_file($_FILES['feature_images']['tmp_name'][$index], $feature_image);
                }

                // Insert the image into the feature_images table with reference to feature_id (only if there's a new image)
                if (!empty($feature_image)) {
                    $stmt = $conn->prepare("INSERT INTO feature_images (feature_id, feature_image) VALUES (?, ?)");
                    $stmt->bind_param('is', $feature_id, $feature_image);
                    $stmt->execute();
                }
            }
        }

        // Handle Technology Images
        if (!empty($_FILES['technology_images']['tmp_name'])) {
            // Delete old technology images if new ones are uploaded
            $stmt = $conn->prepare("DELETE FROM technology_images WHERE project_id = ?");
            $stmt->bind_param('i', $project_id);
            $stmt->execute();

            // Insert new technology images if they exist
            foreach ($_FILES['technology_images']['tmp_name'] as $index => $tmp_name) {
                $tech_image = 'uploads/' . time() . '_' . $_FILES['technology_images']['name'][$index];
                move_uploaded_file($tmp_name, $tech_image);

                // Insert the technology image into the table
                $stmt = $conn->prepare("INSERT INTO technology_images (project_id, image_path) VALUES (?, ?)");
                $stmt->bind_param('is', $project_id, $tech_image);
                $stmt->execute();
            }
        }

        $conn->commit();
        header('Location: projects.php');
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>



<body id="page-top">
    <div id="wrapper">
        <?php include('includes/sidebar.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('includes/nav.php'); ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Project</h1>
                   <?php if (!empty($msg)) {
        echo $msg;
    } ?>
                    <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="project_name" class="form-label">Project Name</label>
                <input type="text" id="project_name" name="project_name" class="form-control" value="<?php echo $project['project_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="project_heading" class="form-label">Project Heading</label>
                <input type="text" id="project_heading" name="project_heading" class="form-control" value="<?php echo $project['project_heading']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="field" class="form-label">Field</label>
                <input type="text" id="field" name="field" class="form-control" value="<?php echo $project['field']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" required><?php echo $project['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Project URL</label>
                <input type="url" id="url" name="url" class="form-control" value="<?php echo $project['url']; ?>">
            </div>
            <div class="mb-3">
                <label for="project_logo" class="form-label">Project Logo</label>
                <input type="file" id="project_logo" name="project_logo" class="form-control">
                <img src="<?php echo $project['project_logo']; ?>" alt="Current Logo" class="img-fluid mt-2">
            </div>
            <div class="mb-3">
                <label for="project_overview" class="form-label">Project Overview Image</label>
                <input type="file" id="project_overview" name="project_overview" class="form-control">
                <img src="<?php echo $project['project_overview_image']; ?>" alt="Current Overview Image" class="img-fluid mt-2">
            </div>

            <h4>Problem Statements</h4>
            <div id="problem-statements">
                <?php foreach ($problem_statements as $problem) : ?>
                    <div class="mb-3">
                        <input type="text" name="problem_statements[]" class="form-control" value="<?php echo $problem['problem_statement']; ?>">
                    </div>
                <?php endforeach; ?>
                <button type="button" class="btn btn-secondary" onclick="addProblemStatement()">Add Problem Statement</button>
            </div>

            <h4>Solutions</h4>
            <div id="solutions">
                <?php foreach ($solutions as $solution) : ?>
                    <div class="mb-3">
                        <input type="text" name="solutions[]" class="form-control" value="<?php echo $solution['solution']; ?>">
                    </div>
                <?php endforeach; ?>
                <button type="button" class="btn btn-secondary" onclick="addSolution()">Add Solution</button>
            </div>

            <h4>Features</h4>
            <div id="features">
                <?php foreach ($features as $feature) : ?>
                    <div class="mb-3">
                    <textarea name="features[]" rows="8" class="form-control editor" placeholder="Feature Description"><?php echo $feature['feature_description']; ?></textarea>
                <?php if (!empty($feature['feature_image'])) : ?>
                    <img src="<?php echo $feature['feature_image']; ?>" alt="Feature Image" class="img-fluid mt-2">
                <?php endif; ?>

          
                <input type="file" name="feature_images[<?php echo $index; ?>]" class="form-control mt-2">
                        <!-- <input type="text" name="features[]" class="form-control" value="<?php echo $feature['feature_description']; ?>"> -->
                    </div>
                <?php endforeach; ?>
                <button type="button" class="btn btn-secondary" onclick="addFeature()">Add Feature</button>
            </div>

            <h4>Technology Images</h4>
            <div id="technology-images">
                <?php foreach ($technology_images as $image) : ?>
                    <div class="mb-3">
                        <input type="file" name="technology_images[]" class="form-control">
                        <img src="<?php echo $image['image_path']; ?>" alt="Tech Image" class="img-fluid mt-2">
                    </div>
                <?php endforeach; ?>
                <button type="button" class="btn btn-secondary" onclick="addTechImage()">Add Technology Image</button>
            </div>

            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addProblemStatement() {
            const container = document.getElementById('problem-statements');
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-3';
            inputGroup.innerHTML = ` 
                <input type="text" name="problem_statements[]" class="form-control" required>
                <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
            `;
            container.appendChild(inputGroup);
        }

        function addSolution() {
            const container = document.getElementById('solutions');
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-3';
            inputGroup.innerHTML = ` 
                <input type="text" name="solutions[]" class="form-control" required>
                <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
            `;
            container.appendChild(inputGroup);
        }

        function addFeature() {
    featureIndex++;
    const container = document.getElementById('features');
    const newInput = document.createElement('div');
    newInput.classList.add('input-group', 'mb-3');
    newInput.innerHTML = `
       
        <textarea name="features[]" rows="8" class="form-control editor" placeholder="Feature Description"></textarea>
        <input type="file" name="feature_images[${featureIndex}][]" class="form-control" accept="image/*" multiple required>
        <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
    `;
    container.appendChild(newInput);

    ClassicEditor.create(newInput.querySelector('.editor')).catch(error => console.error(error));
}

// Initialize CKEditor for the first textarea
document.addEventListener('DOMContentLoaded', () => {
    const editors = document.querySelectorAll('.editor');
    editors.forEach(editor => {
        ClassicEditor.create(editor).catch(error => console.error(error));
    });
});

        function addTechnology() {
            const container = document.getElementById('technologies');
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-3';
            inputGroup.innerHTML = ` 
                <input type="file" name="technology_images[]" class="form-control" multiple accept="image/*">
                <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
            `;
            container.appendChild(inputGroup);
        }
    </script>
</body>