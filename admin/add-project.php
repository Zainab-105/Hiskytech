<?php
include('includes/head.php');
include('includes/config.php');
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('includes/sidebar.php')?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('includes/nav.php');?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
    <?php if (!empty($msg)) {
        echo $msg;
    } ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Project</h1>
    </div>

    <form action="insert_project.php" method="POST" enctype="multipart/form-data">
    <!-- Project Name -->
    <div class="mb-3">
        <label for="project_name" class="form-label">Project Name:</label>
        <input type="text" id="project_name" name="project_name" class="form-control" required>
    </div>

    <!-- Project Heading -->
    <div class="mb-3">
        <label for="project_heading" class="form-label">Project Heading:</label>
        <input type="text" id="project_heading" name="project_heading" class="form-control" required>
    </div>

    <!-- Project Logo -->
    <div class="mb-3">
        <label for="project_logo" class="form-label">Project Logo:</label>
        <input type="file" id="project_logo" name="project_logo" class="form-control" accept="image/*" required>
    </div>

    <!-- Field -->
    <div class="mb-3">
        <label for="field" class="form-label">Field:</label>
        <input type="text" id="field" name="field" class="form-control" required>
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
    </div>

    <!-- Problem Statements -->
    <div id="problem-statements">
        <label class="form-label">Problem Statements:</label>
        <div class="input-group mb-3">
            <input type="text" name="problem_statements[]" class="form-control" placeholder="Problem Statement" required>
            <button type="button" class="btn btn-secondary" onclick="addProblemStatement()">Add More</button>
        </div>
    </div>

    <!-- Solutions -->
    <div id="solutions">
        <label class="form-label">Solutions Provided:</label>
        <div class="input-group mb-3">
            <input type="text" name="solutions[]" class="form-control" placeholder="Solution Provided" required>
            <button type="button" class="btn btn-secondary" onclick="addSolution()">Add More</button>
        </div>
    </div>

    <!-- Features -->
 <!-- Features -->
 <div id="features">
    <label class="form-label">Key Features and Functionalities:</label>
    <div class="input-group mb-3 feature-group">
        <input type="text" name="features[]" class="form-control" placeholder="Feature Description" required>
        <input type="file" name="feature_images[0][]" class="form-control" accept="image/*" multiple required>
        <button type="button" class="btn btn-secondary" onclick="addFeature()">Add More</button>
    </div>
</div>


    <!-- Project Overview -->
    <div class="mb-3">
        <label for="project_overview" class="form-label">Project Overview Image:</label>
        <input type="file" id="project_overview" name="project_overview" class="form-control" accept="image/*" required>
    </div>

    <!-- Technologies Used -->
    <div id="technologies">
        <label class="form-label">Technologies Used:</label>
        <div class="input-group mb-3">
            <input type="file" name="technology_images[]" class="form-control" accept="image/*"  multiple required>
            <button type="button" class="btn btn-secondary" onclick="addTechnology()">Add More</button>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Add Project</button>
</form>


</div>

                 
                    

                   
     

        
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


<?php include('includes/footer.php')?>

<script>
function addProblemStatement() {
    const container = document.getElementById('problem-statements');
    const newInput = document.createElement('div');
    newInput.classList.add('input-group', 'mb-3');
    newInput.innerHTML = `
        <input type="text" name="problem_statements[]" class="form-control" placeholder="Problem Statement" required>
        <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
    `;
    container.appendChild(newInput);
}

function addSolution() {
    const container = document.getElementById('solutions');
    const newInput = document.createElement('div');
    newInput.classList.add('input-group', 'mb-3');
    newInput.innerHTML = `
        <input type="text" name="solutions[]" class="form-control" placeholder="Solution Provided" required>
        <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
    `;
    container.appendChild(newInput);
}

let featureIndex = 0;

function addFeature() {
    featureIndex++;
    const container = document.getElementById('features');
    const newInput = document.createElement('div');
    newInput.classList.add('input-group', 'mb-3', 'feature-group');
    newInput.innerHTML = `
        <input type="text" name="features[]" class="form-control" placeholder="Feature Description" required>
        <input type="file" name="feature_images[${featureIndex}][]" class="form-control" accept="image/*" multiple required>
        <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
    `;
    container.appendChild(newInput);
}

function addTechnology() {
    const container = document.getElementById('technologies');
    const newInput = document.createElement('div');
    newInput.classList.add('input-group', 'mb-3');
    newInput.innerHTML = `
        <input type="file" name="technology_images[]" class="form-control" accept="image/*" required>
        <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
    `;
    container.appendChild(newInput);
}
</script>

