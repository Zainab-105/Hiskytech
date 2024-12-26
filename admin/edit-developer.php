<?php
include('includes/head.php');
include('includes/config.php');

$developerData = null;
$editMode = false;

// Check if edit_id is set
if (isset($_GET['id'])) {
    $editMode = true;
    $developerId = intval($_GET['id']);

    // Fetch developer data
    $stmt = $conn->prepare("SELECT * FROM developers WHERE id = ?");
    $stmt->bind_param('i', $developerId);
    $stmt->execute();
    $developerData = $stmt->get_result()->fetch_assoc();

    if (!$developerData) {
        die("Error: Developer not found.");
    }

    // Fetch benefits
    $benefitsStmt = $conn->prepare("SELECT * FROM developers_benefits WHERE developer_id = ?");
    $benefitsStmt->bind_param('i', $developerId);
    $benefitsStmt->execute();
    $benefits = $benefitsStmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Fetch features
    $featuresStmt = $conn->prepare("SELECT * FROM app_features WHERE developer_id = ?");
    $featuresStmt->bind_param('i', $developerId);
    $featuresStmt->execute();
    $features = $featuresStmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Fetch services
    $servicesStmt = $conn->prepare("SELECT * FROM developer_services WHERE developer_id = ?");
    $servicesStmt->bind_param('i', $developerId);
    $servicesStmt->execute();
    $services = $servicesStmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $developer = $_POST['developer'] ?? null;
    $description = $_POST['content'] ?? null;

    // Validate inputs
    if (empty($developer) || empty($description)) {
        die("Error: Developer name and description are required.");
    }

    $conn->begin_transaction();

    try {
        if ($editMode) {
            // Update Developer Data
            $stmt = $conn->prepare("UPDATE developers SET name = ?, description = ? WHERE id = ?");
            $stmt->bind_param('ssi', $developer, $description, $developerId);
            $stmt->execute();
        } else {
            // Insert Developer Data
            $stmt = $conn->prepare("INSERT INTO developers (name, description) VALUES (?, ?)");
            $stmt->bind_param('ss', $developer, $description);
            $stmt->execute();
            $developerId = $stmt->insert_id;
        }

        // Handle Benefits (Delete old and add new for simplicity)
        $conn->query("DELETE FROM developers_benefits WHERE developer_id = $developerId");
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

        // Handle Features (Delete old and add new for simplicity)
        $conn->query("DELETE FROM app_features WHERE developer_id = $developerId");
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

        // Handle Services (Delete old and add new for simplicity)
        $conn->query("DELETE FROM developer_services WHERE developer_id = $developerId");
        if (!empty($_POST['services-heading'])) {
            foreach ($_POST['services-heading'] as $index => $heading) {
                $serviceDescription = $_POST['services-description'][$index] ?? null;
                if (!empty($heading) && !empty($serviceDescription)) {
                    $stmt = $conn->prepare("INSERT INTO developer_services (developer_id, heading, description) VALUES (?, ?, ?)");
                    $stmt->bind_param('iss', $developerId, $heading, $serviceDescription);
                    $stmt->execute();
                }
            }
        }

        // Handle Image Uploads

      // Benefit Image
if (isset($_FILES['benefit_image']) && $_FILES['benefit_image']['error'] == 0) {
    $benefitImage = 'uploads/' . $_FILES['benefit_image']['name'];
    if (move_uploaded_file($_FILES['benefit_image']['tmp_name'], $benefitImage)) {
        $stmt = $conn->prepare("UPDATE developers SET benefit_image = ? WHERE id = ?");
        $stmt->bind_param('si', $benefitImage, $developerId);
        $stmt->execute();
    } else {
        die("Error uploading the benefit image.");
    }
}

// Feature Image
if (isset($_FILES['feature_image']) && $_FILES['feature_image']['error'] == 0) {
    $featureImage = 'uploads/' . $_FILES['feature_image']['name'];
    if (move_uploaded_file($_FILES['feature_image']['tmp_name'], $featureImage)) {
        $stmt = $conn->prepare("UPDATE developers SET feature_image = ? WHERE id = ?");
        $stmt->bind_param('si', $featureImage, $developerId);
        $stmt->execute();
    } else {
        die("Error uploading the feature image.");
    }
}

if (isset($_FILES['services-icon']) && !empty($_FILES['services-icon']['name'][0])) {
    foreach ($_FILES['services-icon']['name'] as $index => $iconName) {
        if ($_FILES['services-icon']['error'][$index] == 0) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $serviceIcon = $uploadDir . basename($iconName);

            if (move_uploaded_file($_FILES['services-icon']['tmp_name'][$index], $serviceIcon)) {
                
                $stmt = $conn->prepare("UPDATE developer_services SET icon = ? WHERE developer_id = ? LIMIT 1");
                $stmt->bind_param('si', $serviceIcon,  $developerId);
                $stmt->execute();
            } else {
                die("Error: Failed to upload the service icon.");
            }
        }
    }
}


        $conn->commit(); // Commit transaction
        echo $editMode ? "Developer updated successfully!" : "Developer added successfully!";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on failure
        die("Error: " . $e->getMessage());
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
                    <h1 class="h3 mb-0 text-gray-800"><?= $editMode ? 'Edit Developer' : 'Add New Developer'; ?></h1>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- Developer Name -->
                        <div class="mb-3">
                            <label for="developer" class="form-label">Developer:</label>
                            <input type="text" id="developer" name="developer" class="form-control" value="<?= $developerData['name'] ?? ''; ?>" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Description:</label>
                            <textarea name="content" rows="8" class="form-control editor" required><?= $developerData['description'] ?? ''; ?></textarea>
                        </div>

                        <!-- Key Benefits -->
                        <div class="mb-3">
                            <label class="form-label">Key Benefits:</label>
                            <div id="benefits">
                                <?php if (!empty($benefits)) : ?>
                                    <?php foreach ($benefits as $benefit) : ?>
                                        <div class="input-group mb-3">
                                            <input type="text" name="benefits-heading[]" class="form-control" value="<?= $benefit['heading'] ?>" placeholder="Benefits Heading">
                                            <input type="text" name="benefit-description[]" class="form-control" value="<?= $benefit['description'] ?>" placeholder="Benefits Description" required>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="input-group mb-3">
                                        <input type="text" name="benefits-heading[]" class="form-control" placeholder="Benefits Heading">
                                        <input type="text" name="benefit-description[]" class="form-control" placeholder="Benefits Description" required>
                                    </div>
                                <?php endif; ?>
                                <button type="button" class="btn btn-secondary" onclick="addBenefit()">Add More</button>
                            </div>
                        </div>

                        <!-- Benefit Image -->
                        <div class="mb-3">
                            <label for="benefit_image" class="form-label">Benefit Image:</label>
                            <input type="file" id="benefit_image" name="benefit_image" class="form-control" accept="image/*">
                        </div>

                        <!-- Key Features -->
                        <div class="mb-3">
                            <label class="form-label">Key Features and Functionalities:</label>
                            <div id="features">
                                <?php if (!empty($features)) : ?>
                                    <?php foreach ($features as $feature) : ?>
                                        <div class="input-group mb-3">
                                            <input type="text" name="feature-heading[]" class="form-control" value="<?= $feature['heading'] ?>" placeholder="Feature Heading">
                                            <input type="text" name="feature-description[]" class="form-control" value="<?= $feature['description'] ?>" placeholder="Feature Description" required>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="input-group mb-3">
                                        <input type="text" name="feature-heading[]" class="form-control" placeholder="Feature Heading">
                                        <input type="text" name="feature-description[]" class="form-control" placeholder="Feature Description" required>
                                    </div>
                                <?php endif; ?>
                                <button type="button" class="btn btn-secondary" onclick="addFeature()">Add More</button>
                            </div>
                        </div>

                        <!-- Feature Image -->
                        <div class="mb-3">
                            <label for="feature_image" class="form-label">Feature Image:</label>
                            <input type="file" id="feature_image" name="feature_image" class="form-control" accept="image/*">
                        </div>

                        <!-- Services Provided -->
                        <div class="mb-3">
                            <label class="form-label">Services Provided By Developer:</label>
                            <div id="services">
                                <?php if (!empty($services)) : ?>
                                    <?php foreach ($services as $service) : ?>
                                        <div class="input-group mb-3">
                                            <input type="file" name="services-icon[]" class="form-control" placeholder="Service Icon">
                                            <input type="text" name="services-heading[]" class="form-control" value="<?= $service['heading'] ?>" placeholder="Service Heading">
                                            <input type="text" name="services-description[]" class="form-control" value="<?= $service['description'] ?>" placeholder="Service Description" required>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="input-group mb-3">
                                        <input type="file" name="services-icon[]" class="form-control" placeholder="Service Icon">
                                        <input type="text" name="services-heading[]" class="form-control" placeholder="Service Heading">
                                        <input type="text" name="services-description[]" class="form-control" placeholder="Service Description" required>
                                    </div>
                                <?php endif; ?>
                                <button type="button" class="btn btn-secondary" onclick="addServices()">Add More</button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><?= $editMode ? 'Update Developer' : 'Add Developer'; ?></button>
                    </form>
                </div>
            </div>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
</body>

<script>
function addBenefit() {
    let benefitDiv = document.createElement('div');
    benefitDiv.classList.add('input-group', 'mb-3');
    benefitDiv.innerHTML = `
        <input type="text" name="benefits-heading[]" class="form-control" placeholder="Benefits Heading">
        <input type="text" name="benefit-description[]" class="form-control" placeholder="Benefits Description" required>
    `;
    document.getElementById('benefits').appendChild(benefitDiv);
}

function addFeature() {
    let featureDiv = document.createElement('div');
    featureDiv.classList.add('input-group', 'mb-3');
    featureDiv.innerHTML = `
        <input type="text" name="feature-heading[]" class="form-control" placeholder="Feature Heading">
        <input type="text" name="feature-description[]" class="form-control" placeholder="Feature Description" required>
    `;
    document.getElementById('features').appendChild(featureDiv);
}

function addServices() {
    let servicesDiv = document.createElement('div');
    servicesDiv.classList.add('input-group', 'mb-3');
    servicesDiv.innerHTML = `
        <input type="file" name="services-icon[]" class="form-control" placeholder="Service Icon">
        <input type="text" name="services-heading[]" class="form-control" placeholder="Service Heading">
        <input type="text" name="services-description[]" class="form-control" placeholder="Service Description" required>
    `;
    document.getElementById('services').appendChild(servicesDiv);
}
</script> 