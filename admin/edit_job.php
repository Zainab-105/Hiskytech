<?php
include('includes/connection.php');
include('includes/head.php');

$msg = '';

// Fetch job details if `id` is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Sanitize the ID
    $query = "SELECT * FROM jobs WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $job = mysqli_fetch_assoc($result);
    
    if (!$job) {
        $msg = "<div class='alert alert-danger'>Job not found.</div>";
    }
} else {
    $msg = "<div class='alert alert-danger'>Invalid request.</div>";
}

// Handle form submission for updating the job
if (isset($_POST['update_job'])) {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $employment_type = $_POST['employment_type'];
    $job_description=$_POST['content'];
    // Update query to modify job details
    $update_query = "UPDATE jobs SET title = ?, location = ?, category = ?, type = ?, employment_type = ? ,job_description=? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssssi", $title, $location, $category, $type, $employment_type,$job_description, $id);

    if ($stmt->execute()) {
        $msg = "<div class='alert alert-success'>Job updated successfully. <a href='jobs.php'>View Updated Jobs</a></div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error updating job: " . $conn->error . "</div>";
    }
}
?>

<body>
<div id="wrapper">
    <?php include('includes/sidebar.php') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('includes/nav.php'); ?>
            <div class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">Edit Job</h1>
                <?php if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
                <form method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Job Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($job['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location" class="form-control" value="<?php echo htmlspecialchars($job['location']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" name="category" id="category" class="form-control" value="<?php echo htmlspecialchars($job['category']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Job Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="On-Site" <?php echo $job['type'] == 'On-Site' ? 'selected' : ''; ?>>On-Site</option>
                        <option value="Remote" <?php echo $job['type'] == 'Remote' ? 'selected' : ''; ?>>Remote</option>
                        <option value="Hybrid" <?php echo $job['type'] == 'Hybrid' ? 'selected' : ''; ?>>Hybrid</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="employment_type" class="form-label">Employment Type</label>
                    <select name="employment_type" id="employment_type" class="form-control" required>
                        <option value="Full Time" <?php echo $job['employment_type'] == 'Full Time' ? 'selected' : ''; ?>>Full Time</option>
                        <option value="Part Time" <?php echo $job['employment_type'] == 'Part Time' ? 'selected' : ''; ?>>Part Time</option>
                        <option value="Contract" <?php echo $job['employment_type'] == 'Contract' ? 'selected' : ''; ?>>Contract</option>
                    </select>
                </div>
                <div class="mb-3">
    <label for="shortDescription" class='form-label'>Add Job Description:</label>
    <textarea name="content" class="editor" rows="8" class="form-control" ><?php echo htmlspecialchars($job['job_description']); ?></textarea>
    </div>
                <button type="submit" name="update_job" class="btn btn-primary">Update Job</button>
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
<?php include('includes/footer.php') ?>
