<?php
include('includes/head.php');
include('includes/config.php');
?>

<body id="page-top">
    <div id="wrapper">
        <?php include('includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('includes/nav.php'); ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Add New Project</h1>

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

                        <!-- Project URL -->
                        <div class="mb-3">
                            <label for="url" class="form-label">Project URL:</label>
                            <input type="text" id="url" name="url" class="form-control" required>
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
                        <div id="features">
                            <label class="form-label">Key Features and Functionalities:</label>
                            <div class="input-group mb-3">

                                <textarea name="features[]" rows="8" class="form-control editor" placeholder="Feature Description"></textarea>
                                <input type="file" name="feature_images[0][]" class="form-control" accept="image/*" multiple required>
                                <button type="button" class="btn btn-secondary" onclick="addFeature()">Add More</button>
                            </div>
                        </div>

                        <!-- Project Overview -->
                        <div class="mb-3">
                            <label for="project_overview" class="form-label">Project Overview Image:</label>
                            <input type="file" id="project_overview" name="project_overview" class="form-control" accept="image/*" required>
                        </div>

                        <!-- Technologies -->
                        <div id="technologies">
                            <label class="form-label">Technologies Used:</label>
                            <div class="input-group mb-3">
                                <input type="file" name="technology_images[]" class="form-control" accept="image/*" multiple required>
                                <button type="button" class="btn btn-secondary" onclick="addTechnology()">Add More</button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

// Function to add new feature fields dynamically
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

// Update all CKEditor instances' data to their respective textareas before form submission
document.querySelector('form').addEventListener('submit', function (event) {
    const editors = document.querySelectorAll('.editor');
    for (const editor of editors) {
        const ckEditorInstance = ClassicEditor.instances[editor.name];
        if (ckEditorInstance) {
            editor.value = ckEditorInstance.getData(); 
        }

        // Custom validation to ensure no empty CKEditor content
        if (!editor.value.trim()) {
            alert('Please fill out all feature descriptions.');
            event.preventDefault();
            return false;
        }
    }
});

        function addTechnology() {
            const container = document.getElementById('technologies');
            const newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-3');
            newInput.innerHTML = `
             
                <input type="file" name="technology_images[]" class="form-control" accept="image/*" multiple required>
                <button type="button" class="btn btn-danger" onclick="this.parentNode.remove()">Remove</button>
            `;
            container.appendChild(newInput);
        }
    </script>

</body> 