<?php include('includes/connection.php');
$id=$_GET['id'];

?>
<!DOCTYPE html>
<html lang="eng">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiSkyTech</title>
    <link rel="icon" href="image/Group 6.png">
    <link rel="stylesheet" href="css/style.css">
    <!-- Remove Bootstrap CSS link that conflicts with the CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
  
    <link rel="stylesheet" href="css/projctdetail.css">
    </head>
    <body>
    <?php include('includes/nav.php') ?>
<?php 
$sql="SELECT * FROM projects Where id=$id";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($query)){
    ?>

        <section id="container1">

            <div class="sec1">
                <h1><?php echo $row['project_heading'] ?></h1>
                <p><?php echo $row['description'] ?></p>
                <button class="app-store-button"><i class="fa-brands fa-apple"></i>Visit Project</button>
            </div>
            <div class="sec2 d-flex justify-content-start">
                <img src="admin/<?php echo $row['project_overview_image'] ?>">
            </div>
        </section>
        <section id="container2">
            <div class="part1">
                <img src="image/sec2img1.gif">
                <h1>Problem Statement</h1>
            </div>
            <?php $sql="SELECT * FROM problem_statements WHERE project_id=$id";
            $query=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($query)){
                ?>
            
            <div class="part2">
                <img src="image/v1.png">
                <p><?php echo $row['problem_statement']; ?></p>
            </div>
            <?php
            }
            ?>
           
        </section>
        <section id="container2">
            <div class="part1">
                <img src="image/sec2img2.gif">
                <h1>Solution Provided</h1>
            </div>
            <?php $sql="SELECT * FROM solutions WHERE project_id=$id";
            $query=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($query)){
                ?>
            <div class="part2">
                <img src="image/v2.png"><p><?php echo $row['solution']; ?></p>
            </div>
            <?php
            }
            ?>
            
        </section>
       
        <section id="container3">
            <div class="container">
            <h1>Technologies Used</h1>
            <div class="slider">
                <?php 
                $sql="SELECT * FROM technology_images where project_id=$id";
                $query=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($query)){
                    ?>
             
            <div class="div1">
                <div class="img11"><img src="admin/<?= $row['image_path']?>"></div>
        
            </div>
            <?php
                }
                ?>
            </div>
           
          
        </div>
    </section>
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
$index = 1; // Initialize a counter to track the record position

while ($row = mysqli_fetch_assoc($query)) {
    $feature_id = $row['feature_id'];
    $feature_description = $row['feature_description'];
    $feature_image = $row['feature_image'];

    // Alternate between sec4 and sec5
    if ($index % 2 != 0) {
        // Odd records - Use sec4 layout
        ?>
        <div class="sec4">
            <div class="app1">
                <img src="admin/<?php echo $feature_image; ?>" alt="Feature Image">
            </div>
            <div class="app2">
                
                <p><?php echo $feature_description; ?></p>
            </div>
        </div>
        <?php
    } else {
        // Even records - Use sec5 layout
        ?>
        <div class="sec5">
            <div class="app1">
               
                <p><?php echo $feature_description; ?></p>
            </div>
            <div class="app2 d-flex justify-content-center">
                <img src="admin/<?php echo $feature_image; ?>" alt="Feature Image">
            </div>
        </div>
        <?php
    }

    $index++;
}
?>

            </div>
            
    </section>
    <?php
}
?>
<?php include('index/contact-us.php') ?>

<!-- map -->

<?php include('index/location.php') ?>

<?php include('index/faq-section.php') ?>
<?php include('includes/footer.php') ?>
<?php include('signup-login.php');?>     
               <!-- jQuery 3.x Slim Version CDN -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> <!-- Slick Carousel -->
<script src="js/script.js"></script> <!-- Your custom JS script -->
<script>
$(document).ready(function() {

    $('#contactForm, .mobile-version .contact-form').on('submit', function(e) {
        e.preventDefault(); 

        var form = $(this);
        var formData = form.serialize();  

        // Perform AJAX request
        $.ajax({
            url: 'contact-form-handler.php',  
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
               
                    form.find('.response').html('<div class="alert alert-success">' + response.message + '</div>');
                    form[0].reset(); 
                } else {
                    form.find('.response').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                form.find('.response').html('<div class="alert alert-danger">An error occurred. Please try again later.</div>');
            }
        });
    });
});

</script>
            <script>
                $(document).ready(function() {
                  $('.slider').slick({
                    slidesToShow: 4, // Default for laptops
                    slidesToScroll: 1,
                    infinite:true,
                    autoplay: true,
                    autoplaySpeed: 1000,
                    dots: false,
                    responsive: [
                      {
                        breakpoint: 1024, // For tablets
                        settings: {
                          slidesToShow: 2
                        }
                      },
                      {
                        breakpoint: 768, // For mobile phones
                        settings: {
                          slidesToShow: 1
                        }
                      }
                    ]
                  });
                });
              </script>
             
    </body>
</html>