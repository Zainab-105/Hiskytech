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
    <link rel="stylesheet" href="css/careers.css">
    <!-- Remove Bootstrap CSS link that conflicts with the CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
</head>


<body>
    <?php include('includes/nav.php') ?>
    <!-- main section -->
    <section class="careers-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="main-left">
                        <h4 style="display: inline-block;">Achieve Your Professional Goals with
                            <span class="color-hi-tech">Hi</span><span class="color-sky">Sky</span><span
                                class="color-hi-tech">Tech</span>.
                        </h4>
                        <p>Value-based upscaling is at the heart of HiSkyTech work environment. From learning to
                            implementation, our developers and tech experts stay ahead in their professional game.</p>
                        <a href="jobs.php" class="main-left-btn">Careers Opportunities</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="main-right">
                        <img src="image/career-left.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- how it work section -->
    <section class="how-work">

        <div class="container">
            <h4>How It works</h4>
            <p>Good developers are hard to find, So are good opportunities.</p>
            <div class="row pb-4">
                <div class="col-md-4 pb-3">
                    <div class="work-card">
                        <div class="work-icon"> <img src="image/Monocle.png" alt=""></div>
                        <h6>Apply for desired job role</h6>
                        <p>Choose the skill and the job description from below and fill the form with required details.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="work-card">
                        <div class="work-icon"> <img src="image/Wave.png" alt=""></div>
                        <h6>Get screened by our recruiter</h6>
                        <p>Our Recruiters will get in touch with you in 24 hours to understand your role better and
                            match you open jobs.</p>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="work-card">
                        <div class="work-icon"> <img src="image/Direct-hit.png" alt=""></div>
                        <h6>Take the short assessment </h6>
                        <p>Our assessments help align you with client needs, remain valid for a year, and allow you to
                            apply for multiple roles during this period.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 pb-3">
                    <div class="work-card">
                        <div class="work-icon"> <img src="image/Clap.png" alt=""></div>
                        <h6>Get hired in just 2 weeks!</h6>
                        <p>The best part with Crewscale is the speedy process! We place you within 2 weeks at top
                            companies!
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="why-work">
        <div class="container">
            <h4>Why work with us</h4>
            <p>Unlock Your Full Potential with Tailored Opportunities and Expert Guidance.</p>
            <div class="row pb-4">
                <div class="col-md-4 pb-3">
                    <div class="green-card"><img src="image/work1.png" alt="">
                        <h4>Flexible work</h4>
                        <p>We focus on adaptable hours for balancing productivity and work life.</p>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="blue-card"><img src="image/work2.png" alt="">
                        <h4>Networking Meetups</h4>
                        <p>Our seminars and meetups cultivate professional connections for growth.</p>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="green-card"><img src="image/work3.png" alt="">
                        <h4>Wellness Programs</h4>
                        <p>These aid in nurturing employee health, vitality, and a thriving culture.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 pb-3">
                    <div class="blue-card"><img src="image/work4.png" alt="">
                        <h4>Skill Development Opportunities</h4>
                        <p>Such opportunities fuel continuous growth, empowering individuals for future success.</p>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="green-card"><img src="image/work5.png" alt="">
                        <h4>Monetary Perks</h4>
                        <p>Benefits like leave encashment, paid time off, and more let you relax without worry.</p>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="blue-card"><img src="image/work6.png" alt="">
                        <h4>Fun-Loving Activities</h4>
                        <p>Our fun and intellectual-based clubs focus on mind-refreshing activities every week.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php') ?>



    <!-- jQuery 3.x Slim Version CDN -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Slick Carousel -->
    <script src="js/script.js"></script> <!-- Your custom JS script -->
    <script>
        $(document).ready(function () {

            $('#contactForm, .mobile-version .contact-form').on('submit', function (e) {
                e.preventDefault();

                var form = $(this);
                var formData = form.serialize();

                // Perform AJAX request
                $.ajax({
                    url: 'contact-form-handler.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 'success') {

                            form.find('.response').html('<div class="alert alert-success">' + response.message + '</div>');
                            form[0].reset();
                        } else {
                            form.find('.response').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function () {
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