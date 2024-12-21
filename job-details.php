<?php
include('includes/connection.php');
$id='';
$id=$_GET['id'];
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiSkyTech</title>
    <link rel="icon" href="image/Group 6.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/job-details.css">
    <!-- Remove Bootstrap CSS link that conflicts with the CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />

</head>


<body>
<?php $sql="SELECT * FROM jobs Where id=$id";
            $query=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($query)){
                ?>
    <div class="job-details">
        <section class="job-heading">
         
          
            <div class="heading-container row">
                <div class="col-md-7"> <div class="detail">
                    <div><img src="image/HiSkyTech Png_LOGO-Horizantal-02 4.png" alt=""></div>
                    <h4><?php echo $row['title'];?></h4>
                    <p><span class="job-type"><?php echo $row['type'];?> •</span>  <?php echo $row['category'];?> • <?php echo $row['employment_type'];?></p>
                    <p>Sargodha, Punjab, Pakistan</p>
                </div></div>
                <div class="col-md-5">  <div class="button">
                    <button class="aply-btn">Apply for this job</button>
                </div></div>
               
              
            </div>
        </section>
        <div class="btn-container">
        <div class="tab-header">
                        <button class="tab-button active" data-tab="overview">Overview</button>
                        <button class="tab-button" data-tab="application">Application</button>
                    </div>
        </div>
     
        <section class="job-description">
            <div class="container">
          
                <div class="container1">
                    <!-- Tab Header -->
                  

                    <!-- Overview Section -->
                    <div class="tab-content overview-section active" id="overview">
                  <?php echo $row['job_description']; ?>
                        <!-- <ul>
                            <li class="li-heading"><strong>Description</strong></li>
                            <li> Devsinc is looking for Senior iOS engineers with 3+ years
                                of experience to join its Lahore office.</li>
                            <li class="li-heading"><strong>Requirements:</strong></li>
                            <ul class="detail-li">
                                <li>Proficiency in Swift and Objective-C programming languages.</li>
                                <li>Knowledge of Apple Pay integration and other payment processing tools (a plus).</li>
                                <li>Strong understanding of iOS frameworks such as UIKit, Core Data, Core Animation, and
                                    Core Graphics.</li>
                                <li>Experience with RESTful APIs, JSON, and mobile databases.</li>
                            </ul>
                            <li class="li-heading"><strong>Problem-Solving Abilities:</strong></li>
                            <ul class="detail-li">
                                <li>Proficiency in Swift and Objective-C programming languages.</li>
                                <li>Knowledge of Apple Pay integration and other payment processing tools (a plus).</li>
                                <li>Strong understanding of iOS frameworks such as UIKit, Core Data, Core Animation, and
                                    Core Graphics.</li>
                                <li>Experience with RESTful APIs, JSON, and mobile databases.</li>
                            </ul>
                        </ul> -->
                    </div>

                    <!-- Application Section -->
                    <div class="tab-content application-section" id="application">
                        <h2>Personal Information</h2>
                        <div class="row form-group">
    <div class="col">
      <input type="text" class="form-control" placeholder="First name">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Last name">
    </div>
  </div>
                        <div class="form-group">
               
                            <input type="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                    
                            <input type="text" id="headline" placeholder="Headline (optional)">
                        </div>
                        <div class="form-group">
                    
                            <input type="tel" id="phone-number" placeholder="Phone number">
                            <small>With this number we will contact you.</small>
                        </div>
                        <div class="form-group">
                         
                            <input type="text" id="address" placeholder="Address">
                            <small>Include your city, region, and country, so that employers can easily manage your
                                application.</small>
                        </div>
                        <div class="upload-photo">
                            <div class="upload-area">
                            <label for="fileInput"> 
  <img id="icon" src="image/upload.png">
</label>
<input id="fileInput" type="file">
                                

                                <p>
                                    <span class="upload-span">Upload a Photo</span> or drag and drop here</p>
                            </div>
                        </div>
                        <h2>Profile</h2>
                        <div class="form-group d-flex justify-content-between">
                            <label for="education" style="color:black;">Education (optional)</label>
                            <div>
                            <label for="add-btn" class="add-btn" style="color:#0A3A8F;">+ Add</label>
                            <input type="file" id="add-btn">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
<?php
            }
 ?>


    <script>
        // JavaScript for Tab Switching
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                // Remove active class from all tab content
                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

                // Add active class to clicked button and corresponding content
                button.classList.add('active');
                document.getElementById(button.getAttribute('data-tab')).classList.add('active');
            });
        });
    </script>



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