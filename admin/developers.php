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
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                    }
                    ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Developers</h1>
                        <a href="add-developer.php" class="btn btn-primary">Add Developer</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="myTable table table-bordered table-hover dt-responsive" style="background-color:white">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Developer</th>
                                        <th>Features</th>
                                        <th>Benefits</th>
                                        <th>Developer Services</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $a = 1;
                                $sql = "
                                    SELECT 
                                        d.id AS developer_id,
                                        d.name AS developer_name,
                                        d.description AS developer_description,
                                        d.feature_image,
                                        d.benefit_image,
                                        GROUP_CONCAT(DISTINCT af.heading ORDER BY af.heading) AS feature_headings,
                                        GROUP_CONCAT(DISTINCT af.description ORDER BY af.description) AS feature_descriptions,
                                        GROUP_CONCAT(DISTINCT db.heading ORDER BY db.heading) AS benefit_headings,
                                        GROUP_CONCAT(DISTINCT db.description ORDER BY db.description) AS benefit_descriptions,
                                        GROUP_CONCAT(DISTINCT ds.icon ORDER BY ds.icon) AS service_icons,
                                        GROUP_CONCAT(DISTINCT ds.heading ORDER BY ds.heading) AS service_headings,
                                        GROUP_CONCAT(DISTINCT ds.description ORDER BY ds.description) AS service_descriptions
                                    FROM developers d
                                    LEFT JOIN app_features af ON d.id = af.developer_id
                                    LEFT JOIN developers_benefits db ON d.id = db.developer_id
                                    LEFT JOIN developer_services ds ON d.id = ds.developer_id
                                    GROUP BY d.id
                                    ORDER BY d.id DESC;
                                ";

                                $query = mysqli_query($conn, $sql);

                                // Initialize an empty array to group data by developer
                                $developers = [];

                                while ($row = mysqli_fetch_assoc($query)) {
                                    $developer_id = $row['developer_id'];

                                    // Initialize the developer data if it's not already set
                                    if (!isset($developers[$developer_id])) {
                                        $developers[$developer_id] = [
                                            'developer_name' => $row['developer_name'],
                                            'developer_description' => $row['developer_description'],
                                            'feature_image' => $row['feature_image'],
                                            'benefit_image' => $row['benefit_image'],
                                            'features' => [],
                                            'benefits' => [],
                                            'services' => []
                                        ];
                                    }

                                    // Split the concatenated feature data into arrays
                                 // Split the concatenated feature data into arrays
$feature_headings = explode(',', $row['feature_headings']);
$feature_descriptions = explode(',', $row['feature_descriptions']);
foreach ($feature_headings as $index => $heading) {
    // Check if the index exists in the descriptions array
    $description = isset($feature_descriptions[$index]) ? $feature_descriptions[$index] : '';
    $developers[$developer_id]['features'][] = [
        'heading' => $heading,
        'description' => $description
    ];
}

// Split the concatenated benefit data into arrays
$benefit_headings = explode(',', $row['benefit_headings']);
$benefit_descriptions = explode(',', $row['benefit_descriptions']);
foreach ($benefit_headings as $index => $heading) {
    // Check if the index exists in the descriptions array
    $description = isset($benefit_descriptions[$index]) ? $benefit_descriptions[$index] : '';
    $developers[$developer_id]['benefits'][] = [
        'heading' => $heading,
        'description' => $description
    ];
}

// Split the concatenated service data into arrays
$service_icons = isset($row['service_icons']) ? explode(',', $row['service_icons']) : [];
$service_headings = isset($row['service_headings']) ? explode(',', $row['service_headings']) : [];
$service_descriptions = isset($row['service_descriptions']) ? explode(',', $row['service_descriptions']) : [];

foreach ($service_headings as $index => $heading) {
    // Check if the index exists in each array (icon, heading, description)
    $icon = isset($service_icons[$index]) ? $service_icons[$index] : '';
    $description = isset($service_descriptions[$index]) ? $service_descriptions[$index] : '';
    $developers[$developer_id]['services'][] = [
        'icon' => $icon,
        'heading' => $heading,
        'description' => $description
    ];
}
                                }

                                // Loop through grouped data and display
                                foreach ($developers as $developer_id => $developer) {
                                ?>
                                    <tr>
                                        <td><?php echo $a++; ?></td>
                                        <td><b><?php echo $developer['developer_name']; ?></b><br>
                                        <?php echo $developer['developer_description']; ?>
                                    </td>
                                        <td>
                                            <img src="<?=$developer['feature_image']?>" alt=""><br>
                                            <?php 
                                            if (!empty($developer['features'])) {
                                                foreach ($developer['features'] as $feature) {
                                                    echo "<b>" . $feature['heading'] . "</b><br>";
                                                    echo $feature['description'] . "<br><br>";
                                                }
                                            } else {
                                                echo "No features available.";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <img src="<?=$developer['benefit_image']?>" alt="">
                                            <?php 
                                            if (!empty($developer['benefits'])) {
                                                foreach ($developer['benefits'] as $benefit) {
                                                    echo "<b>" . $benefit['heading'] . "</b><br>";
                                                    echo $benefit['description'] . "<br><br>";
                                                }
                                            } else {
                                                echo "No benefits available.";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            if (!empty($developer['services'])) {
                                                foreach ($developer['services'] as $service) {
                                                    echo "<b>" . $service['heading'] . "</b><br>";
                                                    echo $service['description'] . "<br>";
                                                    echo "<img src='" . $service['icon'] . "' alt='Service Icon' style='width: 50px; height: 50px; object-fit: cover;'><br><br>";
                                                }
                                            } else {
                                                echo "No services available.";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="delete_developer.php?id=<?= $developer_id ?>" class="delete-btn"><i class="fas fa-trash-alt gray-icon"></i></a>
                                            <a href="edit-developer.php?id=<?= $developer_id ?>" class="edit-btn"><i class="fas fa-edit gray-icon"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End of Content Wrapper -->

            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<?php include('includes/footer.php')?>
</body>
</html>
