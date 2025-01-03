<?php $services = [];  // Array to store all services and their related icons

$sql = "SELECT * FROM services  ";
$query = mysqli_query($conn, $sql);
if ($query) {
    while ($row = mysqli_fetch_array($query)) {
        $service_id = $row['id'];  // Store the service id
        $service = [
            'name' => $row['name'],
            'icon' => $row['icon'],
            'heading' => $row['heading'],
            'description' => $row['description'],
            'language_icons' => []  // Initialize an empty array to hold language icons
        ];

        // Query to get language icons for this service
        $icon_sql = "SELECT image_path FROM language_icons WHERE service_id = $service_id";
        $icon_query = mysqli_query($conn, $icon_sql);
        if ($icon_query && mysqli_num_rows($icon_query) > 0) {
            while ($icon_row = mysqli_fetch_array($icon_query)) {
                // Add each icon to the language_icons array for this service
                $service['language_icons'][] = $icon_row['image_path'];
            }
        } else {
            // If no language icons are found, store a default message
            $service['language_icons'][] = "No language icons available.";
        }

        // Store the service data with its icons in the $services array
        $services[] = $service;
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Now $services array contains all the service data with their language icons
?><section class="services desktop-section ">
<div class="container slide-right">
    <div class="service-heading">
        <h2>Our Comprehensive Digital <span>Solutions for You</span></h2>
        <p>At HiSkyTech, we specialize in transforming your ideas into reality through cutting-edge technology. Our services cater to diverse needs, ensuring your digital presence stands out.</p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row mb-5">
                <?php foreach ($services as $service) { ?>
                    <div class="col-md-4 mb-6">
                        <div class="service-card" data-service="<?= $service['name'] ?>">
                            <img src="admin/<?= $service['icon'] ?>" alt="">
                            <p><?= $service['name'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Different .service-left sections for each service -->
        <div class="col-md-6">
            <?php foreach ($services as $service) { ?>
                <div class="service-left" id="<?= $service['name'] ?>-desktop" style="display: none;">
                    <h2><?= $service['heading'] ?></h2>
                    <p><?= $service['description'] ?></p>
                    <div class="service-icon">
                        <?php foreach ($service['language_icons'] as $icon) { ?>
                            <img src="admin/<?= $icon ?>" alt="Service Icon">
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</section>
<section class="services mobile-section">
    <div class="container">
        <div class="service-heading">
            <h2>Our Comprehensive Digital <span>Solutions for You</span></h2>
            <p>At HiSkyTech, we specialize in transforming your ideas into reality through cutting-edge technology. Our services cater to diverse needs, ensuring your digital presence stands out.</p>
        </div>
        <div class="row">
            <?php foreach ($services as $service) { ?>
                <div class="col-md-4">
                    <div class="service-card-mobile" data-service="<?= $service['name'] ?>">
                        <img src="admin/<?= $service['icon'] ?>" alt="">
                        <p><?= $service['name'] ?></p>
                    </div>
                    <!-- Service section right below each card -->
                    <div class="service-left-mobile" id="<?= $service['name'] ?>-mobile" style="display: none;">
                        <h2><?= $service['heading'] ?></h2>
                        <p><?= $service['description'] ?></p>
                        <div class="service-icon">
                            <?php foreach ($service['language_icons'] as $icon) { ?>
                                <img src="admin/<?= $icon ?>" alt="Service Icon">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

