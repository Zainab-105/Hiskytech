<?php
include('includes/connection.php');
$id = $_GET['id'];

// Fetch project details
$sql = "SELECT * FROM projects WHERE id = $id";
$query = mysqli_query($conn, $sql);
$project = mysqli_fetch_assoc($query); // Store project details separately

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiSkyTech</title>
    <link rel="icon" href="image/Group 6.png">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="css/projctdetail.css">
</head>

<body>
    <?php include('includes/nav.php') ?>

    <section id="container1">
        <div class="sec1">
            <h1><?php echo $project['project_heading']; ?></h1>
            <p><?php echo $project['description']; ?></p>
            <button class="app-store-button"><i class="fa-brands fa-apple"></i> Visit Project</button>
        </div>
        <div class="sec2 d-flex justify-content-start">
            <img src="admin/<?php echo $project['project_overview_image']; ?>">
        </div>
    </section>

    <!-- Problem Statement -->
    <section id="container2">
        <div class="part1">
            <img src="image/sec2img1.gif">
            <h1>Problem Statement</h1>
        </div>
        <?php
        $sql = "SELECT * FROM problem_statements WHERE project_id = $id";
        $query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($query)) { ?>
            <div class="part2">
                <img src="image/v1.png">
                <p><?php echo $row['problem_statement']; ?></p>
            </div>
        <?php } ?>
    </section>

    <!-- Solution Provided -->
    <section id="container2">
        <div class="part1">
            <img src="image/sec2img2.gif">
            <h1>Solution Provided</h1>
        </div>
        <?php
        $sql = "SELECT * FROM solutions WHERE project_id = $id";
        $query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($query)) { ?>
            <div class="part2">
                <img src="image/v2.png">
                <p><?php echo $row['solution']; ?></p>
            </div>
        <?php } ?>
    </section>

    <!-- Technologies Used -->
    <section id="container3">
        <div class="container">
            <h1>Technologies Used</h1>
            <div class="slider">
                <?php
                $sql = "SELECT * FROM technology_images WHERE project_id = $id";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($query)) { ?>
                    <div class="div1">
                        <div class="img11"><img src="admin/<?= $row['image_path']; ?>"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Case Study PDF -->
    <div class="container" >
        <?php
        $file_path = "admin/" . $project['case_study_file'];

       

        if (!empty($project['case_study_file']) && file_exists(__DIR__ . "/" . $file_path)) {
            $encoded_file_path = "admin/" . urlencode($project['case_study_file']);
            echo '<embed id="pdf-embed" type="application/pdf" src="' . $encoded_file_path . '" width="100%" height="600px">';
        } else {
            echo "";
        }
        ?>
    </div>

    <!-- Key Features & Functionality -->
    <section class="container4">
        <div class="container">
            <h1>Key Features & Functionality</h1>
            <?php
            $sql = "
                SELECT 
                    features.id AS feature_id, 
                    features.feature_description AS feature_description, 
                    feature_images.image_path AS feature_image 
                FROM features
                LEFT JOIN feature_images ON features.id = feature_images.feature_id
                WHERE features.project_id = $id
            ";

            $query = mysqli_query($conn, $sql);
            $index = 1;

            while ($row = mysqli_fetch_assoc($query)) {
                $feature_description = $row['feature_description'];
                $feature_image = $row['feature_image'];

                if ($index % 2 != 0) { ?>
                    <div class="sec4">
                        <div class="app1">
                            <img src="admin/<?php echo $feature_image; ?>" alt="Feature Image">
                        </div>
                        <div class="app2">
                            <p><?php echo $feature_description; ?></p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="sec5">
                        <div class="app1">
                            <p><?php echo $feature_description; ?></p>
                        </div>
                        <div class="app2 d-flex justify-content-center">
                            <img src="admin/<?php echo $feature_image; ?>" alt="Feature Image">
                        </div>
                    </div>
                <?php }
                $index++;
            } ?>
        </div>
    </section>

    <?php include('index/contact-us.php'); ?>
    <?php include('index/location.php'); ?>
    <?php include('index/faq-section.php'); ?>
    <?php include('includes/footer.php'); ?>
    <?php include('signup-login.php'); ?>
    <?php
    include('includes/connection.php');
    $id = $_GET['id'];

    // Fetch project details
    $sql = "SELECT * FROM projects WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $project = mysqli_fetch_assoc($query); // Store project details separately
    
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HiSkyTech</title>
        <link rel="icon" href="image/Group 6.png">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="css/projctdetail.css">
    </head>

    <body>
        <?php include('includes/nav.php') ?>

        <section id="container1">
            <div class="sec1">
                <h1><?php echo $project['project_heading']; ?></h1>
                <p><?php echo $project['description']; ?></p>
                <button class="app-store-button"><i class="fa-brands fa-apple"></i> Visit Project</button>
            </div>
            <div class="sec2 d-flex justify-content-start">
                <img src="admin/<?php echo $project['project_overview_image']; ?>">
            </div>
        </section>

        <!-- Problem Statement -->
        <section id="container2">
            <div class="part1">
                <img src="image/sec2img1.gif">
                <h1>Problem Statement</h1>
            </div>
            <?php
            $sql = "SELECT * FROM problem_statements WHERE project_id = $id";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="part2">
                    <img src="image/v1.png">
                    <p><?php echo $row['problem_statement']; ?></p>
                </div>
            <?php } ?>
        </section>

        <!-- Solution Provided -->
        <section id="container2">
            <div class="part1">
                <img src="image/sec2img2.gif">
                <h1>Solution Provided</h1>
            </div>
            <?php
            $sql = "SELECT * FROM solutions WHERE project_id = $id";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="part2">
                    <img src="image/v2.png">
                    <p><?php echo $row['solution']; ?></p>
                </div>
            <?php } ?>
        </section>

        <!-- Technologies Used -->
        <section id="container3">
            <div class="container">
                <h1>Technologies Used</h1>
                <div class="slider">
                    <?php
                    $sql = "SELECT * FROM technology_images WHERE project_id = $id";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <div class="div1">
                            <div class="img11"><img src="admin/<?= $row['image_path']; ?>"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- Case Study PDF -->
        <div class="container" style="width: 100%; height: 600px;">
            <?php
            $file_path = "admin/" . $row['case_study_file'];
            $encoded_file_path = htmlspecialchars($file_path, ENT_QUOTES, 'UTF-8');

            if (!empty($row['case_study_file']) && file_exists($file_path)) {
                echo '<embed id="pdf-embed" type="application/pdf" src="' . $encoded_file_path . '#toolbar=0" width="100%" height="600px">';
            } else {
                echo "<p style='color: red;'>No case study file available or file not found!</p>";
            }
            ?>

        </div>

        <!-- Key Features & Functionality -->
        <section class="container4">
            <div class="container">
                <h1>Key Features & Functionality</h1>
                <?php
                $sql = "
                SELECT 
                    features.id AS feature_id, 
                    features.feature_description AS feature_description, 
                    feature_images.image_path AS feature_image 
                FROM features
                LEFT JOIN feature_images ON features.id = feature_images.feature_id
                WHERE features.project_id = $id
            ";

                $query = mysqli_query($conn, $sql);
                $index = 1;

                while ($row = mysqli_fetch_assoc($query)) {
                    $feature_description = $row['feature_description'];
                    $feature_image = $row['feature_image'];

                    if ($index % 2 != 0) { ?>
                        <div class="sec4">
                            <div class="app1">
                                <img src="admin/<?php echo $feature_image; ?>" alt="Feature Image">
                            </div>
                            <div class="app2">
                                <p><?php echo $feature_description; ?></p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="sec5">
                            <div class="app1">
                                <p><?php echo $feature_description; ?></p>
                            </div>
                            <div class="app2 d-flex justify-content-center">
                                <img src="admin/<?php echo $feature_image; ?>" alt="Feature Image">
                            </div>
                        </div>
                    <?php }
                    $index++;
                } ?>
            </div>
        </section>

        <?php include('index/contact-us.php'); ?>
        <?php include('index/location.php'); ?>
        <?php include('index/faq-section.php'); ?>
        <?php include('includes/footer.php'); ?>
        <?php include('signup-login.php'); ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
     
        <script src="js/script.js"></script>

        <script>
$(document).ready(function () {
    console.log("Slider script loaded"); // Debugging
    if ($('.slider .div1').length > 0) { // Ensure there are elements
        $('.slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 1000,
            dots: false,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 2 } },
                { breakpoint: 768, settings: { slidesToShow: 1 } }
            ]
        });
    } else {
        console.log("No images found in slider");
    }
});

              
        </script>
    </body>

    </html>