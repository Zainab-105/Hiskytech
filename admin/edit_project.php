<?php
include('includes/head.php');
include('includes/config.php');
$msg = '';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);


    $projects = [];
    $query = mysqli_query($conn, "SELECT * FROM projects WHERE id = '$id'");
    if ($query && mysqli_num_rows($query) > 0) {
        $projects = mysqli_fetch_assoc($query);
    }

    $problem_statements = [];
    $problem_statements_id = [];
    $query = mysqli_query($conn, "SELECT id,problem_statement FROM problem_statements WHERE project_id = '$id'");
    while ($row = mysqli_fetch_assoc($query)) {
        $problem_statements_id[] = $row['id'];
        $problem_statements[] = $row['problem_statement'];
    }


    $solutions = [];
    $solutions_id = [];
    $query = mysqli_query($conn, "SELECT id, solution FROM solutions WHERE project_id = '$id'");
    while ($row = mysqli_fetch_assoc($query)) {
        $solutions_id[] = $row['id'];
        $solutions[] = $row['solution'];
    }
    


    $technology_images = [];
    $query = mysqli_query($conn, "SELECT image_path FROM technology_images WHERE project_id = '$id'");
    while ($row = mysqli_fetch_assoc($query)) {
        $technology_images[] = $row['image_path'];
    }


    $features = [];
    $query = mysqli_query($conn, "SELECT id AS feature_id, feature_description FROM features WHERE project_id = '$id'");
    while ($row = mysqli_fetch_assoc($query)) {
        $features[] = $row;
    }

    $feature_images = [];
    $query = mysqli_query($conn, "SELECT feature_id, image_path FROM feature_images WHERE feature_id IN (SELECT id FROM features WHERE project_id = '$id')");
    while ($row = mysqli_fetch_assoc($query)) {
        $feature_images[$row['feature_id']][] = $row['image_path'];
    }
} else {
    echo "Invalid request.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $project_heading = mysqli_real_escape_string($conn, $_POST['project_heading']);
    $field = mysqli_real_escape_string($conn, $_POST['field']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $update_project_query = "UPDATE projects SET project_name = '$project_name', project_heading = '$project_heading', field = '$field', description = '$description' WHERE id = '$id'";
    if (mysqli_query($conn, $update_project_query)) {
        $msg = "<div class='alert alert-success'>Project updated successfully. <a href='projects.php'>View Update Projects</a></div>";
    } else {
        $msg = 'Error updating project: ' . mysqli_error($conn);
    }
    if (isset($_POST['problem_statements']) && is_array($_POST['problem_statements'])) {
        $problem_statements = $_POST['problem_statements'];
        foreach ($problem_statements as $index => $problem_statement) {
            $problem_statement = mysqli_real_escape_string($conn, $problem_statement);
            $problem_statement_id = $problem_statements_id[$index];
            
         
            $check_query = "SELECT COUNT(*) as count FROM problem_statements WHERE project_id = '$id' AND id = '$problem_statement_id'";
            $check_result = mysqli_query($conn, $check_query);
            $row = mysqli_fetch_assoc($check_result);
    
            if ($row['count'] > 0) {
          
                $update_problem_query = "UPDATE problem_statements SET problem_statement = '$problem_statement' WHERE project_id = '$id' AND id = '$problem_statement_id'";
                mysqli_query($conn, $update_problem_query);
            } else {
         
                $insert_problem_query = "INSERT INTO problem_statements (id, project_id, problem_statement) VALUES ('$problem_statement_id', '$id', '$problem_statement')";
                mysqli_query($conn, $insert_problem_query);
            }
        }
    }
    
    
    
    if (isset($_POST['solutions']) && is_array($_POST['solutions'])) {
        $posted_solutions = $_POST['solutions'];
        foreach ($posted_solutions as $solution_id => $solution) {
            $solution = mysqli_real_escape_string($conn, $solution);
            $update_solution_query = "UPDATE solutions SET solution = '$solution' WHERE project_id = '$id' AND id = '$solution_id'";
            mysqli_query($conn, $update_solution_query);
        }
    }
    
    
    if (isset($_POST['features'])) {
        foreach ($_POST['features'] as $index => $feature) {
            $feature_description = mysqli_real_escape_string($conn, $feature);
            $update_feature_query = "UPDATE features SET feature_description = '$feature_description' WHERE id = '{$features[$index]['feature_id']}'";
            mysqli_query($conn, $update_feature_query);
        }
    }

    if (isset($_FILES['feature_images']) && !empty($_FILES['feature_images']['name'][0])) {

        foreach ($features as $feature) {
            $feature_id = $feature['feature_id'];

            $select_images_query = "SELECT id,image_path FROM feature_images WHERE feature_id = '$feature_id'";
            $result = mysqli_query($conn, $select_images_query);

            // while ($row = mysqli_fetch_assoc($result)) {
            //     $image_path = $row['image_path'];
            //     $image_id = $row['id'];
            //     echo $image_id;
            //     if (file_exists($image_path)) {
            //         unlink(filename: $image_path);
            //     }
            // }
    

            // $delete_images_query = "DELETE FROM feature_images WHERE feature_id = '$feature_id'";
            // mysqli_query($conn, $delete_images_query);
        }
    

        foreach ($_FILES['feature_images']['name'] as $feature_index => $images) {
            $feature_id = $features[$feature_index]['feature_id'];
    
            foreach ($images as $image_index => $image_name) {
                if (!empty($image_name)) {
                    $target_dir = "uploads/"; 
                    $target_file = $target_dir . basename($image_name);
                    $tmp_name = $_FILES['feature_images']['tmp_name'][$feature_index][$image_index];
    
                   
                    if (move_uploaded_file($tmp_name, $target_file)) {
                        
                        $insert_image_query = "INSERT INTO feature_images (feature_id, image_path) VALUES ('$feature_id', '$target_file')";
                        mysqli_query($conn, $insert_image_query);
                    }
                }
            }
        }
    }
    
    

    if (isset($_FILES['technology_images']) && !empty($_FILES['technology_images']['name'][0])) {

        $select_technology_images_query = "SELECT * image_path FROM technology_images WHERE project_id = '$id'";
        $result = mysqli_query($conn, $select_technology_images_query);
    
        // while ($row = mysqli_fetch_assoc($result)) {
        //     $image_path = $row['image_path'];
    

        //     if (file_exists($image_path)) {
        //         unlink($image_path); 
        //     }
        // }

        // $delete_technology_images_query = "DELETE FROM technology_images WHERE project_id = '$id'";
        // mysqli_query($conn, $delete_technology_images_query);
    
      
        foreach ($_FILES['technology_images']['name'] as $index => $image_name) {
            if (!empty($image_name)) {
                $target_dir = "uploads/"; 
                $target_file = $target_dir . basename($image_name);
    
                $tmp_name = $_FILES['technology_images']['tmp_name'][$index];
    
              
                if (move_uploaded_file($tmp_name, $target_file)) {
                   
                    $insert_technology_image_query = "INSERT INTO technology_images (project_id, image_path) VALUES ('$id', '$target_file')";
                    mysqli_query($conn, $insert_technology_image_query);
                }
            }
        }
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name:</label>
                            <input type="text" id="project_name" name="project_name" class="form-control"
                                value="<?= $projects['project_name'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="project_heading" class="form-label">Project Heading:</label>
                            <input type="text" id="project_heading" name="project_heading" class="form-control"
                                value="<?= $projects['project_heading'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="project_logo" class="form-label">Project Logo:</label>
                            <input type="file" id="project_logo" name="project_logo" class="form-control"
                                accept="image/*">
                            <?php if ($projects['project_logo']): ?>
                                <img src="<?= $projects['project_logo'] ?>" alt="Current Logo" width="100" class="mt-2">
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="field" class="form-label">Field:</label>
                            <input type="text" id="field" name="field" class="form-control"
                                value="<?= $projects['field'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea id="description" name="description" class="form-control" rows="4"
                                required><?= $projects['description'] ?></textarea>
                        </div>

                        <div id="problem-statements">
                            <label class="form-label">Problem Statements:</label>
                            <?php foreach ($problem_statements as $statement): ?>
                                <div class="input-group mb-3">
                                    <input type="text" name="problem_statements[]" class="form-control"
                                        value="<?= $statement ?>" required>
                         
                                </div>
                            <?php endforeach; ?>
                        </div>
                 

                            <div id="solutions">
    <label class="form-label">Solutions:</label>
    <?php foreach ($solutions as $index => $solution): ?>
        <div class="input-group mb-3">
            <input type="text" name="solutions[<?= $solutions_id[$index] ?>]" class="form-control" value="<?= $solution ?>" required>

        </div>
    <?php endforeach; ?>
</div>


                        <div id="features">
                            <label class="form-label">Features:</label>
                            <?php foreach ($features as $index => $feature):
                                $feature_id = $feature['feature_id'] ?>

                                <div class="input-group mb-3">
                                    <input type="text" name="features[]" class="form-control"
                                        value="<?= $feature['feature_description'] ?>" required>
                                    <input type="file" name="feature_images[<?= $index ?>][]" class="form-control"
                                        accept="image/*" multiple>
                                    <?php $sql = "SELECT * FROM feature_images where feature_id='$feature_id'";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($query)) { ?>

                                        <img src="<?= $row['image_path'] ?>" alt="">

                                        <?php
                                    }
                                    ?>
                          
                                </div>
                            <?php endforeach; ?>
                        </div>


                        <div id="technologies">
                            <label class="form-label">Technologies:</label>

                            <div class="input-group mb-3">
                                <input type="file" name="technology_images[]" class="form-control" multiple
                                    accept="image/*">
                                <?php foreach ($technology_images as $image): ?>
                                    <img src="<?= $image ?>" alt="Technology" width="50" class="mt-2">
                                <?php endforeach; ?>
                          
                            </div>

                        </div>
                        <button type="button" class="btn btn-secondary mb-3" onclick="addTechnology()">Add More</button>
                        <div>
                            <button type="submit" class="btn btn-primary">Update Project</button>
                        </div>

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
            const container = document.getElementById('features');
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-3';
            inputGroup.innerHTML = ` 
                <input type="text" name="features[]" class="form-control" required>
                <input type="file" name="feature_images[]" class="form-control" accept="image/*" multiple>
                <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
            `;
            container.appendChild(inputGroup);
        }

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