<?php
include('includes/head.php');
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $developer = $_POST['developer'] ?? null;
    $description = $_POST['content'] ?? null;
    $type = $_POST['type'] ?? null;
    // Validate inputs
    if (empty($developer) || empty($description)) {
        die("Error: Developer name and description are required.");
    }

    // File Uploads
    $benefitImage = uploadFile($_FILES['benefit_image'], 'uploads/'); 
    $featureImage = uploadFile($_FILES['feature_image'], 'uploads/');

    $conn->begin_transaction();

    try {
        // Insert Developer Data
        $stmt = $conn->prepare("INSERT INTO developers (name, description,type, benefit_image, feature_image) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param('sssss', $developer, $description,$type, $benefitImage, $featureImage);
        $stmt->execute();
        $developerId = $stmt->insert_id;

        // Insert Benefits
        if (!empty($_POST['benefits-heading'])) {
            foreach ($_POST['benefits-heading'] as $index => $heading) {
                $benefitDescription = $_POST['benefit-description'][$index] ?? null;
                if (!empty($heading) && !empty($benefitDescription)) {
                    $stmt = $conn->prepare("INSERT INTO developers_benefits (developer_id, heading, description) VALUES (?, ?, ?)");
                    $stmt->bind_param('iss', $developerId, $heading, $benefitDescription);
                    $stmt->execute();
                }
            }
        }

        // Insert Features
        if (!empty($_POST['feature-heading'])) {
            foreach ($_POST['feature-heading'] as $index => $heading) {
                $featureDescription = $_POST['feature-description'][$index] ?? null;
                if (!empty($heading) && !empty($featureDescription)) {
                    $stmt = $conn->prepare("INSERT INTO app_features (developer_id, heading, description) VALUES (?, ?, ?)");
                    $stmt->bind_param('iss', $developerId, $heading, $featureDescription);
                    $stmt->execute();
                }
            }
        }

        // Insert Services
        if (!empty($_FILES['services-icon']['name'])) {
            foreach ($_FILES['services-icon']['name'] as $index => $name) {
                $icon = uploadFile([
                    'name' => $_FILES['services-icon']['name'][$index],
                    'tmp_name' => $_FILES['services-icon']['tmp_name'][$index],
                    'size' => $_FILES['services-icon']['size'][$index],
                    'error' => $_FILES['services-icon']['error'][$index],
                ], 'uploads/');

                $serviceHeading = $_POST['services-heading'][$index] ?? null;
                $serviceDescription = $_POST['services-description'][$index] ?? null;

                if (!empty($serviceHeading) && !empty($serviceDescription) && $icon !== null) {
                    $stmt = $conn->prepare("INSERT INTO developer_services (developer_id, icon, heading, description) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param('isss', $developerId, $icon, $serviceHeading, $serviceDescription);
                    $stmt->execute();
                }
            }
        }

        $conn->commit(); // Commit transaction
        echo "Developer added successfully!";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on failure
        die("Error: " . $e->getMessage());
    }
}

// File Upload Function
function uploadFile($file, $uploadDir) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $filename = time() . '_' . basename($file['name']);
        $filepath = $uploadDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return $filepath;
        } else {
            throw new Exception("File upload failed for " . $file['name']);
        }
    } else {
        throw new Exception("File upload error: " . $file['error']);
    }
}
?>


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('includes/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('includes/nav.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php if (!empty($msg)) {
                        echo $msg;
                    } ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add New Developer</h1>
                    </div>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- Developer Name -->
                        <div class="mb-3">
                            <label for="developer" class="form-label">Developer:</label>
                            <input type="text" id="developer" name="developer" class="form-control" required>
                        </div>
  <!-- Development type -->
  <div class="mb-3">
                            <label for="type" class="form-label">Development Type:</label>
                            <input type="text" id="type" name="type" class="form-control" required>
                        </div>
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Description:</label>
                            <textarea name="content" rows="8" class="form-control editor" required></textarea>
                        </div>

                        <!-- Key Benefits -->
                        <div class="mb-3">
                            <label class="form-label">Key Benefits:</label>
                            <div id="benefits">
                                <div class="input-group mb-3">
                                    <input type="text" name="benefits-heading[]" class="form-control" placeholder="Benefits Heading"><br>
                                    <input type="text" name="benefit-description[]" class="form-control" placeholder="Benefits Description" required>
                                    <button type="button" class="btn btn-secondary" onclick="addBenefit()">Add More</button>
                                </div>
                            </div>
                        </div>

                        <!-- Benefit Image -->
                        <div class="mb-3">
                            <label for="benefit_image" class="form-label">Benefit Image:</label>
                            <input type="file" id="benefit_image" name="benefit_image" class="form-control" accept="image/*" required>
                        </div>

                        <!-- Key Features -->
                        <div class="mb-3">
                            <label class="form-label">Key Features and Functionalities:</label>
                            <div id="features">
                                <div class="input-group mb-3">
                                    <input type="text" name="feature-heading[]" class="form-control" placeholder="Feature Heading"><br>
                                    <input type="text" name="feature-description[]" class="form-control" placeholder="Feature Description" required>
                                    <button type="button" class="btn btn-secondary" onclick="addFeature()">Add More</button>
                                </div>
                            </div>
                        </div>

                        <!-- Feature Image -->
                        <div class="mb-3">
                            <label for="feature_image" class="form-label">Feature Image:</label>
                            <input type="file" id="feature_image" name="feature_image" class="form-control" accept="image/*" required>
                        </div>

                        <!-- Services Provided -->
                        <div class="mb-3">
                            <label class="form-label">Services Provided By Developer:</label>
                            <div id="services">
                                <div class="input-group mb-3">
                                    <input type="file" name="services-icon[]" class="form-control" placeholder="Service Icon"><br>
                                    <input type="text" name="services-heading[]" class="form-control" placeholder="Service Heading"><br>
                                    <input type="text" name="services-description[]" class="form-control" placeholder="Service Description" required>
                                    <button type="button" class="btn btn-secondary" onclick="addServices()">Add More</button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Developer</button>
                    </form>
                </div>
                <!-- End Page Content -->
            </div>
            <!-- End Main Content -->

            <?php include('includes/footer.php'); ?>

            <!-- Scroll to Top Button -->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Editor Script -->
    <script>
        ClassicEditor.create(document.querySelector('.editor'))
            .then(editor => {
                const textarea = document.querySelector('textarea[name="content"]');
                textarea.removeAttribute('required');

                document.querySelector('form').addEventListener('submit', function() {
                    textarea.value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });

        // Add Benefit
        function addBenefit() {
            const benefitsDiv = document.getElementById('benefits');
            const newBenefit = `
                <div class="input-group mb-3">
                    <input type="text" name="benefits-heading[]" class="form-control" placeholder="Benefits Heading">
                    <input type="text" name="benefit-description[]" class="form-control" required>
                    <button type="button" class="btn btn-danger" onclick="removeField(this)">Remove</button>
                </div>`;
            benefitsDiv.insertAdjacentHTML('beforeend', newBenefit);
        }

        // Add Feature
        function addFeature() {
            const featuresDiv = document.getElementById('features');
            const newFeature = `
                <div class="input-group mb-3">
                    <input type="text" name="feature-heading[]" class="form-control" placeholder="Feature Heading">
                    <input type="text" name="feature-description[]" class="form-control" required>
                    <button type="button" class="btn btn-danger" onclick="removeField(this)">Remove</button>
                </div>`;
            featuresDiv.insertAdjacentHTML('beforeend', newFeature);
        }

        // Add Services
        function addServices() {
            const servicesDiv = document.getElementById('services');
            const newService = `
                <div class="input-group mb-3">
                    <input type="file" name="services-icon[]" class="form-control" placeholder="Service Icon">
                    <input type="text" name="services-heading[]" class="form-control" placeholder="Service Heading">
                    <input type="text" name="services-description[]" class="form-control" required>
                    <button type="button" class="btn btn-danger" onclick="removeField(this)">Remove</button>
                </div>`;
            servicesDiv.insertAdjacentHTML('beforeend', newService);
        }

        // Remove Field
        function removeField(button) {
            button.closest('.input-group').remove();
        }
    </script>
</body>
