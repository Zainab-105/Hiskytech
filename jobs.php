<?php
include('includes/connection.php');
include('admin/includes/time_function.php');
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiSkyTech</title>
    <link rel="icon" href="image/Group 6.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jobs.css">
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
    <section class="jobs">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="job-left">
                        <div><img src="image/HiSkyTech Png_LOGO-Horizantal-02 4.png" alt="">
                            <h6>Careers at HiSkyTech</h6>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="job-right">
                        <p>We're excited to meet you. Outlined below are the current roles that HiSkyTech is looking to
                            find new individuals to join our team.</p>
                    </div>
                </div>
            </div>
            <div class="job-listings">
    <div class="search-bar">
        <input type="text" placeholder="Search jobs...">
        <button><img src="image/filter.png" alt=""></button>
    </div>

    <!-- First Job Card -->
     <?php
     $sql="SELECT * FROM jobs";
     $query=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_array($query)){   ?>
        <a href="job-details.php?id=<?=$row['id'];?>" class="job-card remote">
        <div class="job-header">
            <h3><?php echo $row['title'];?></h3>
            <span class="job-type"><?php echo $row['type'];?></span>
        </div>
        <div class="job-info">
            <span><?php echo time_ago($row['created_at']);  ?></span>
            <span><?php echo $row['location'];?></span>
            <span><?php echo $row['category'];?></span>
            <span><?php echo $row['employment_type'];?></span>
        </div>
    </a>

   <?php
}
?>
    <!-- Second Job Card -->
    <!-- <a href="job-details.php" class="job-card remote">
        <div class="job-header">
            <h3>Senior Web Developer</h3>
            <span class="job-type">Remote</span>
        </div>
        <div class="job-info">
            <span>Posted 1 day ago</span>
            <span>Sargodha, Punjab, Pakistan</span>
            <span>Development</span>
            <span>Full Time</span>
        </div>
    </a> -->

    <!-- Third Job Card -->
    <!-- <a href="job-details.php" class="job-card">
        <div class="job-header">
            <h3>Senior IOS App Developer</h3>
            <span class="job-type">On-Site</span>
        </div>
        <div class="job-info">
            <span>Posted 1 week ago</span>
            <span>Sargodha, Punjab, Pakistan</span>
            <span>Development</span>
            <span>Full Time</span>
        </div>
    </a> -->
</div>

        </div>
    </section>



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