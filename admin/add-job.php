<?php
include('includes/connection.php');
include('includes/head.php');

$msg = '';

// Debug: Check if form is submitted and print the POST data
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     var_dump($_POST);
//     exit;
// }

// Handle form submission for inserting a new job
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $employment_type = $_POST['employment_type'];
    $job_description = $_POST['content'];

    // Validate if all fields are filled
    if (empty($title) || empty($location) || empty($category) || empty($type) || empty($employment_type) || empty($job_description)) {
        $msg = "<div class='alert alert-danger'>Please fill in all the fields.</div>";
    } else {
        // Insert query to add a new job
        $insert_query = "INSERT INTO jobs (title, location, category, type, employment_type, job_description) 
                         VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssssss", $title, $location, $category, $type, $employment_type, $job_description);

        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Job added successfully. <a href='jobs.php'>View All Jobs</a></div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error inserting job: " . $stmt->error . "</div>";
        }
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
                <h1 class="h3 mb-0 text-gray-800">Add New Job</h1>
                <?php if (!empty($msg)) {
                        echo $msg;
                    }
                ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Job Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" name="category" id="category" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Job Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="On-Site">On-Site</option>
                            <option value="Remote">Remote</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="employment_type" class="form-label">Employment Type</label>
                        <select name="employment_type" id="employment_type" class="form-control" required>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Contract">Contract</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="shortDescription" class="form-label">Job Description:</label>
                        <textarea name="content" rows="8" class="form-control editor" required></textarea>
                    </div>
                    <button type="submit" name="insert_job" class="btn btn-primary">Add Job</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script>
ClassicEditor.create(document.querySelector('.editor'))
    .then(editor => {
   
        document.querySelector('form').addEventListener('submit', function() {
            document.querySelector('textarea[name="content"]').value = editor.getData();
        });
    })
    .catch(error => {
        console.error(error);
    });

</script> -->
<?php include('includes/footer.php') ?>
