
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiSkyTech</title>
    <link rel="icon" href="image/Group 6.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
</head>

<body>


    <!-- First Row: Logo, Navigation, and Contact Us Button -->
   <?php include('includes/nav.php')?>
<!-- hero section -->
   <?php include('index/hero-section.php')?>
<!-- services section -->
   <?php include('index/services-section.php')?>

<!-- achievement section -->
<?php include('index/achievement-section.php')?>
<!-- recent-project section -->
<?php include('index/recent-project.php')?>
    <!-- engagment model section -->
    <?php include('index/engagment-model.php')?>


    <!-- our team section -->
    <?php include('index/team.php')?>

<!-- ideas section -->
<?php include('index/ideas-section.php')?>
<!-- contact-us section -->
<?php include('index/contact-us.php')?>
  

    <!-- map -->
    <?php include('index/location.php')?>
<!-- faq-section -->
<?php include('index/faq-section.php')?>



    <!-- feedback-secction -->
    <?php include('index/feedback-section.php')?>
<!-- footer -->
<?php include('includes/footer.php')?>



    <!-- jQuery 3.x Slim Version CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
    const navbarCollapse = document.querySelector('.navbar-collapse');
    navbarCollapse.classList.toggle('show'); // Toggle the display of the navbar
});

        $('.center').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 3,
            autoplay: true,
            arrows: false, // Disable arrows
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3,
                        arrows: false // Ensure arrows are disabled for this breakpoint as well
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1,
                        arrows: false // Ensure arrows are disabled for this breakpoint as well
                    }
                }
            ]
        });

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#contactForm').on('submit', function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            
            $.ajax({
                url: 'contact-us.php', 
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
               
                    if (response.status === 'success') {
                        $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#contactForm')[0].reset();
                    } else {
                        $('#responseMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function () {
                    $('#responseMessage').html('<div class="alert alert-danger">An unexpected error occurred.</div>');
                }
            });
        });
    });
</script>

</body>

</html>