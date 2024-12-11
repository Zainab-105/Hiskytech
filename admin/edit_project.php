<?php
include('includes/head.php');
include('includes/config.php');
$msg = '';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM projects WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $project = mysqli_fetch_assoc($query);

    if (!$project) {
        echo "No project found with ID $id";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $project_heading = mysqli_real_escape_string($conn, $_POST['project_heading']);
    $field = mysqli_real_escape_string($conn, $_POST['field']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);


    $project_logo = $project['project_logo'];
    if (!empty($_FILES['project_logo']['name'])) {
        $logo_name = time() . '_' . $_FILES['project_logo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($logo_name);

     
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit;
        }


        if (move_uploaded_file($_FILES['project_logo']['tmp_name'], $target_file)) {
            $project_logo = $target_file;
        } else {
            echo "Failed to upload logo. Error: " . $_FILES['project_logo']['error'];
            exit;
        }
    }

 
    $update_sql = "UPDATE projects SET project_name='$project_name', project_heading='$project_heading', field='$field', description='$description', project_logo='$project_logo' WHERE id=$id";

    if (mysqli_query($conn, $update_sql)) {
        $msg = '<div class="alert alert-success">Project updated successfully. <a href="index.php">View Updated Project</a></div>';
        echo $msg;
        header('Location: projects.php');
        exit;
    } else {
        echo "Error updating project: " . mysqli_error($conn);
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

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="project_name">Project Name</label>
                            <input type="text" name="project_name" id="project_name" class="form-control" value="<?php echo $project['project_name']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="project_heading">Project Heading</label>
                            <input type="text" name="project_heading" id="project_heading" class="form-control" value="<?php echo $project['project_heading']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="field">Field</label>
                            <input type="text" name="field" id="field" class="form-control" value="<?php echo $project['field']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required><?php echo $project['description']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="project_logo">Project Logo</label><br>
                            <img src="<?php echo $project['project_logo']; ?>" alt="Project Logo" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;">
                            <input type="file" name="project_logo" id="project_logo" class="form-control-file">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Project</button>
                        <a href="projects_list.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
