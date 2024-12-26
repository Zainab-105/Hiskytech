<?php include('includes/connection.php');
$developer_id='';
$developer_id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiSkyTech</title>
    <!-- <link rel="icon" href="image/Group 6.png"> -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Remove Bootstrap CSS link that conflicts with the CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
  
    <link rel="stylesheet" href="css/hiredeveloper.css">
</head>

<body>
    <?php include('includes/nav.php')?>
    <?php
                                $a = 1;
                                $sql = "
                                SELECT 
                                    d.id AS developer_id,
                                    d.name AS developer_name,
                                    d.description AS developer_description,
                                    d.type AS development_type,
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
                                WHERE d.id = $developer_id
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
                                            'development_type' => $row['development_type'],
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
$service_icons = explode(',', $row['service_icons']);
$service_headings = explode(',', $row['service_headings']);
$service_descriptions = explode(',', $row['service_descriptions']);
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
    <section id="container1">

        <div class="sec1">
            <h1>Hire <?php echo $developer['developer_name']; ?></h1>
            <p><?php echo $developer['developer_description']; ?></p>
               
            <button class="app-store-button">Recruit <?php echo $developer['developer_name']; ?></button>
        </div>
        <div class="sec2">
            <img src="image/carrer.png">
        </div>
    </section>

 <section id="container3">
    <div class="container">
        <div class="hiring-heading">
            <h2>Partner with  <span class="color-hi-tech">Hi</span><span class="color-sky">Sky</span><span
                class="color-hi-tech">Tech</span> <?php echo $developer['developer_name']; ?>s For A Fly Business. </h2>
            <p>Amplify your business' ROI with our progress-assessed flutter developer community</p>
        </div>
    </div>
  

    </section> 
    <section id="container2" class="row">
    <?php 
    $index = 1; 
    if (!empty($developer['features'])) {
        foreach ($developer['features'] as $feature) {
            // Start a new row after every 3 items
            if ($index % 3 == 1 && $index != 1) {
                echo '</div><div class="row">';  // Close the previous row and start a new one
            }
            ?>
            <div class="col-md-4"> <!-- Create a column for each feature -->
                <?php if ($index % 2 != 0) { ?>
                    <div class="part1">
                        <h1><?php echo $feature['heading']; ?></h1>
                        <p><?php echo $feature['description']; ?></p>
                    </div>
                <?php } else { ?>
                    <div class="sec2">
                        <img src="admin/<?=$developer['feature_image']?>" alt="">
                    </div>
                    <div class="sec3">
                        <h1><?php echo $feature['heading']; ?></h1>
                        <p><?php echo $feature['description']; ?></p>
                    </div>
                <?php } ?>
            </div>
            <?php 
            $index++; // Increment the counter
        }
    } else {
        echo "No features available.";
    }
    ?>
</section>


     <section id="container3">
        <div class="container">
            <div class="hiring-heading">
                <h2>Unlock Success with our <?php echo isset($developer['development_type']) ? $developer['development_type'] : 'Developer'; ?> Development Services </h2>
                <p>Amplify your business' ROI with our progress-assessed flutter developer community</p>
            </div>
        </div>
       

     </section>
     <section id="container4">
    <?php 
    $index = 1;
    if (!empty($developer['services'])) {
        foreach ($developer['services'] as $service) {
            if ($index % 2 == 0) { 
                // Even-indexed service
                ?>
                <div class="container4_data1">
                    <div class="secs">
                        <div class="sec1">
                            <img src="image/hiring1.png" alt="Service Image">
                        </div>
                        <div class="sec2">
                            <h2><?php echo $service['heading']; ?></h2>
                            <p><?php echo $service['description']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                // Odd-indexed service
                ?>
                <div class="container4_data2">
                    <div class="secs">
                        <div class="sec1">
                            <img src="image/hiring4.png" alt="Service Image">
                        </div>
                        <div class="sec2">
                            <h2><?php echo $service['heading']; ?></h2>
                            <p><?php echo $service['description']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            $index++; // Increment the index counter
        }
    } else {
        echo "No services available.";
    }
    ?>
</section>

     <section id="container1" class="ready">

        <div class="sec1">
            <h1>Are you ready to Develop 
                your Online existance</h1><p>Reach Out to us for Hiring Best <?php echo $developer['developer_name']; ?> Today!</p>

            <button class="app-store-button">Recruit <?php echo $developer['developer_name']; ?></button>
        </div>
        <div class="sec2">
            <img src="image/cont5img.png">
        </div>
    </section>
     <section id="container3">
        <div class="container">
            <div class="hiring-heading">
                <h2>Features offered by our <?php echo $developer['developer_name']; ?> to build your project.</h2>
                <p>Jumpstart development of your project for meeting your high-valued business goals.</p>
            </div>
        </div>
  
 
    </section>
    <section id="container2" >
        <div class="row">
    <?php 
    $index = 1; 
    if (!empty($developer['benefits'])) {
        foreach ($developer['benefits'] as $benefit) {
            // Start a new column for each benefit
            ?>
            <div class="col-md-4">
                <?php 
                if ($index % 2 != 0) { 
                    // Odd-indexed benefits
                    ?>
                    <div class="part1">
                        <h1><?php echo $benefit['heading']; ?></h1>
                        <p><?php echo $benefit['description']; ?></p>
                    </div>
                    <?php 
                } else {
                    // Even-indexed benefits
                    ?>
                    <div class="sec2 text-center">
                        <img src="admin/<?=$developer['benefit_image']?>" alt="Benefit Image" class="img-fluid">
                    </div>
                    <div class="sec3">
                        <h1><?php echo $benefit['heading']; ?></h1>
                        <p><?php echo $benefit['description']; ?></p>
                    </div>
                    <?php 
                }
                ?>
            </div>
            <?php 
            $index++; // Increment the counter
        }
    } else {
        echo "No benefits available.";
    }
    ?>
    </div>
</section>

        <section id="container7">
            <div class="container">
                <div class="hiring-heading">
                    <h2>A Road map to Hire Flutter Developers In 5 Easy Steps </h2>
                    <p>Looking to hire full-stack Flutter develoers? Get on board with us!</p>
                </div>
            </div>
       
           
        </section>
     <section id="container6">
        <div class="cont6parts">
            <img src="image/Group 714.png">
            <p>Get in Touch</p>
        </div>
        <div class="cont6parts">
            <img src="image/Group 713.png">
            <p>Convey us your specifications </p>
        </div>
        <div class="cont6parts">
            <img src="image/Group 712.png">
            <p>Hire a champ</p>
        </div>
        <div class="cont6parts">
            <img src="image/Group 711.png">
            <p>Choose business modle</p>
        </div>
        <div class="cont6parts">
            <img src="image/Group 710.png">
            <p>Kick start your project</p>
        </div>
    </section>
    <?php
                                }
                                ?>
    <?php include('index/contact-us.php') ?>

<?php include('index/location.php') ?>

<?php include('index/faq-section.php') ?>

    <?php include('includes/footer.php') ?>
    <?php include('signup-login.php');?>   
</body>
</html>