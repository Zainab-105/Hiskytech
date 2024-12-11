<?php
include('includes/connection.php')
?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
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
<script>
$(document).ready(function() {
    // Handle form submission for both desktop and mobile versions
    $('#contactForm, .mobile-version .contact-form').on('submit', function(e) {
        e.preventDefault();  // Prevent default form submission

        var form = $(this);  // Cache the form reference
        var formData = form.serialize();  // Serialize form data

        // Perform AJAX request
        $.ajax({
            url: 'contact-form-handler.php',  // Path to the PHP handler
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    // Show success message inside the form
                    form.find('.response').html('<div class="alert alert-success">' + response.message + '</div>');
                    form[0].reset();  // Clear form after success
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


// on desktop view
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
// on mobile view
document.addEventListener('DOMContentLoaded', function () {
    const tagContainer = document.querySelector('.tag-container-mobile');
    const engagementSection = document.querySelector('.engagement-mobile');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                console.log('Arranging tags');
                tagContainer.classList.add('arranged');
            } else {
                console.log('Resetting tags');
                tagContainer.classList.remove('arranged');
            }
        });
    }, { threshold: 0.3 }); // Adjusted threshold

    observer.observe(engagementSection); // Observe the correct section
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