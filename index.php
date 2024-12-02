<!DOCTYPE html>
<html lang="en">

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
</head>


<body>
<?php include('includes/nav.php') ?>


<?php include('index/hero-section.php') ?>

<?php include('index/services-section.php') ?>


<?php include('index/achievement-section.php') ?>


<?php include('index/recent-project.php') ?>




<?php include('index/engagment-model.php') ?>

<?php include('index/team.php') ?>

<?php include('index/ideas-section.php') ?>


<?php include('index/contact-us.php') ?>

    <!-- map -->


    <?php include('index/location.php') ?>


    <?php include('index/faq-section.php') ?>









    <!-- feedback-secction -->
    <?php include('index/feedback-section.php') ?>

    <?php include('includes/footer.php') ?>



    <!-- jQuery 3.x Slim Version CDN -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> <!-- Slick Carousel -->
<script src="js/script.js"></script> <!-- Your custom JS script -->

<!-- Custom Scripts for Slick Carousel and Navbar -->
<script>
    $('.responsive').slick({
        centerMode: true,
        centerPadding: '10px',
        slidesToShow: 4,
        autoplay: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3,
                    arrows: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1,
                    arrows: false
                }
            }
        ]
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

        document.addEventListener('DOMContentLoaded', function () {
    const tagContainer = document.querySelector('.tag-container');
    const engagementSection = document.querySelector('.engagment-model');


    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
            
                tagContainer.classList.add('arranged');
            } else {
                
                tagContainer.classList.remove('arranged');
            }
        });
    }, { threshold: 0.6 }); 

    observer.observe(tagContainer);
});

    // Custom Navbar Toggle Function
    function toggleNavbar() {
        const mobileNav = document.getElementById('mobileNav');
        if (mobileNav.classList.contains('d-none')) {
            mobileNav.classList.remove('d-none');
        } else {
            mobileNav.classList.add('d-none');
        }
    }

    function toggleVersion() {
        var mobileVersion = document.querySelector('.mobile-version');
        var desktopVersion = document.querySelector('.desktop-version');

        if (window.innerWidth <= 768) {
            mobileVersion.style.display = 'block';
            desktopVersion.style.display = 'none';
        } else {
            mobileVersion.style.display = 'none';
            desktopVersion.style.display = 'block';
        }
    }

    window.addEventListener('load', toggleVersion);
    window.addEventListener('resize', toggleVersion);
    document.addEventListener("DOMContentLoaded", () => {
    const tagContainer = document.querySelector(".tag-container");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Add 'arranged' class to the container on scroll
                tagContainer.classList.add("arranged");
            }
        });
    }, { threshold: 0.5 }); // Trigger when 50% of the section is visible

    observer.observe(tagContainer);
});
</script>

</body>

</html>