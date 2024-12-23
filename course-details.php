<?php include('includes/connection.php')?>;
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/course-details.css">
</head>

<body>
    <?php include('includes/nav.php') ?>
    <section class="custom-section">
        <div class="container">
            <div class="row">
                <!-- First Div with Text and Button -->
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM courses where id =$id";
              $query=mysqli_query($conn,$sql);
             while($row=mysqli_fetch_assoc($query)){

           
                ?>
                <div class="col-md-7">
                    <div class="text-content">
                        <h4><?= $row['name']?></h4>
                        <p><?= $row['description']?></p>
                        <p>Created by <?= $row['instructor']?></p>

                        <div class="icon-text-group">
                            <img src="image/Vector.png" alt="" class="icon-image"><span>Last update <?=$row['updated_at']?></span>
                            <img src="image/Vector (1).png" alt="" class="icon-image"><span>Urdu</span>
                        </div>
                        <!-- Buy Button -->
                        <button class="custom-button" onclick="showPopup('popup1')">Buy For Rs. <?=$row['price']?></button>
                    </div>
                </div>



                <!-- Second Div with Image -->
                <div class="col-md-5 image-content">

                    <img src="admin/<?=$row['thumbnail']?>" alt="" />

                </div>

            </div>
        </div>
    </section>

    <!-- section2 -->


    <section class="custom-layout-section">
        <div class="custom-layout-container">
            <h4>What you’ll learn</h4>
            <div class="custom-layout-row">
                <!-- First Column with Title and Icon Texts -->
                <!-- Section Heading Outside of the Columns -->

                <div class="custom-column-1">
<?php
$sql="SELECT * FROM course_outline Where course_id=$id";
$query=mysqli_query($conn,$sql);
if(!$query){
    echo "error".mysqli_error($conn);
}
while($row=mysqli_fetch_assoc($query)){
    ?>
 

                    <!-- Repeat this icon-text group 7 times as required -->
                    <div class="custom-icon-text">
                        <img src="image/tick.png" alt="Checkmark Icon" class="checkmark-icon">
                        <span><?=$row['outline']?></span>
                    </div>
                    <?php
}
 ?>    

                </div>

                <!-- Second Column with Image -->
                <div class="custom-column-2">
                    <img src="image/Video.png" alt="">
                </div>
            </div>
        </div>
    </section>


    <!-- section 3 -->

    <section class="main-section">
        <div class="content-container">

            <div class="content-row">
                <h4 class="title-text">Course Content</h4>
                <div class="icon-text-group">
                    <div class="icon-text-item">
                        <img src="image/abc1.png" alt="" class="small-icon">
                        <p class="text-regular">sections</p>
                    </div>
                    <div class="icon-text-item">
                        <img src="image/ri_video-fill.png" alt="Icon 2" class="small-icon">
                        <p class="text-regular">10 Lectures</p>
                    </div>
                    <div class="icon-text-item">
                        <img src="image/abc.png" alt="Icon 3" class="small-icon">
                        <p class="text-regular">2h 21m total length</p>
                    </div>
                </div>
                <div class="content-box">

                    <div class="table-box">
                        <div class="table-item">
                            <img src="image/mingcute_book-5-fill.png" alt="" class="table-icon-image">
                            <div class="text-group">
                                <p class="table-main-text">Chapter 1 Introduction to UI Designing</p>
                                <p class="table-secondary-text">Lectures 2 | Time : 18 min 20 sec</p>
                            </div>

                            <img src="image/errow down.png" alt="" class="table-arrow-icon">
                        </div>
                    </div>

                    <div class="table-box">
                        <div class="table-item">
                            <img src="image/mingcute_book-5-fill.png" alt="" class="table-icon-image">
                            <div class="text-group">
                                <p class="table-main-text">Chapter 2 User Research & Persona Creation</p>
                                <p class="table-secondary-text">Lectures 2 | Time : 18 min 20 sec</p>
                            </div>

                            <img src="image/errow down.png" alt="" class="table-arrow-icon">
                        </div>
                    </div>

                    <div class="table-box">
                        <div class="table-item">
                            <img src="image/mingcute_book-5-fill.png" alt="" class="table-icon-image">
                            <div class="text-group">
                                <p class="table-main-text">Chapter 3 Wireframing & Prototyping</p>
                                <p class="table-secondary-text">Lectures 2 | Time : 18 min 20 sec</p>
                            </div>

                            <img src="image/errow down.png" alt="" class="table-arrow-icon">
                        </div>
                    </div>
                    <div class="table-box">
                        <div class="table-item">
                            <img src="image/mingcute_book-5-fill.png" alt="" class="table-icon-image">
                            <div class="text-group">
                                <p class="table-main-text">Chapter 4 Visual Design Principles</p>
                                <p class="table-secondary-text">Lectures 2 | Time : 18 min 20 sec</p>
                            </div>

                            <img src="image/errow down.png" alt="" class="table-arrow-icon">
                        </div>
                    </div>

                    <div class="table-box">
                        <div class="table-item">
                            <img src="image/mingcute_book-5-fill.png" alt="" class="table-icon-image">
                            <div class="text-group">
                                <p class="table-main-text">Chapter 5 Usability Testing & Iteration</p>
                                <p class="table-secondary-text">Lectures 2 | Time : 18 min 20 sec</p>
                            </div>

                            <img src="image/errow down.png" alt="" class="table-arrow-icon">
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?php
 }
}?>
    <!-- section 4 -->


    <!-- Popup Section (Initially hidden) -->
    <section class="popup-section" id="popup1" style="display: none;;">
        <div class="popup-container">
            <div class="close-button" onclick="closePopup()">×</div>
            <div class="container">

                <div class="row-row1">

                    <!-- Left div -->
                    <div class="left-div">
                        <p class="text-regular">Order summary</p>
                        <h5 class="heading-h5">Rs10,000 <br>
                            <span class="text-regular">For life time</span>
                        </h5>


                        <div class="course-layout">
                            <p class="course-title">Course</p>

                            <div class="course-details">
                                <img src="image/Image.png" alt="Course Image" class="course-thumbnail">
                                <p class="course-name">The Complete UI/UX Design Course - Build User-Centric Products
                                </p>
                            </div>

                            <div class="price-info">
                                <p class="price-label">Subtotal</p>
                                <p class="price-amount">10,000</p>
                            </div>

                            <p class="course-title1">Add discount</p>
                            <div class="price-info">
                                <p class="price-label">Total</p>
                                <p class="price-amount">10,000</p>
                            </div>
                        </div>

                    </div>

                    <!-- Right div -->
                    <div class="right-div">
                        <div class="details-section">
                            <div class="row-container">
                                <p class="section-heading1">Your Details</p>
                                <img src="image/errow left.png" alt="" class="arrow-icon">
                                <p class="section-heading1" style="color: black;">Payment</p>
                            </div>

                            <p class="info-text">
                                We collect this information to help combat fraud <br>
                                and to keep your payment secure.
                            </p>
                        </div>

                        <div class="form-section">
                            <!-- <div class="input-container">
                            <i class="fas fa-envelope icon">
                            <input type="text" class="input-field" placeholder="Your email">
                        </div> -->
                            <div class="input-container">
                                <img src="image/sms.png" alt="Email Icon" class="input-icon3"> <!-- Email Icon -->
                                <input type="email" class="form-control input-field" placeholder="Your Email" required>
                            </div>


                            <label class="checkbox-container">
                                <input type="checkbox" class="checkbox">
                                <p class="checkbox-text">HiSkyTech may send me product updates <br>
                                    and offers via email.</p>
                            </label>
                        </div>

                        <div class="medium-text-section">
                            <p class="section-heading">Select payment method</p>
                            <div class="box-row">
                                <button class="box-button" onclick="showPopup('popup2')">
                                    <img src="image/3dae7998e4ddfb250b1646b3bf6290c6.png" alt="Payment Icon"
                                        class="box-image">
                                </button>
                            </div>
                            <div class="box-row">
                                <button class="box-button">
                                    <img src="image/0e536d95a022ebaf15ea9babf628ba36.png" alt="" class="box-image">
                                </button>
                            </div>

                            <button class="submit-button">Submit</button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section 5 -->

    <section class="popup-section " id="popup2" style="display: none; ">
        <div class="popup-container">
            <div class="close-button" onclick="closePopup()">×</div>
            <div class="row-row1">
                <!-- Left div -->
                <div class="left-div">
                    <p class="text-regular">Order summary</p>
                    <h5 class="heading-h5">Rs10,000 <br>
                        <span class="text-regular">For life time</span>
                    </h5>


                    <div class="course-layout">
                        <p class="course-title">Course</p>

                        <div class="course-details">
                            <img src="image/Image.png" alt="Course Image" class="course-thumbnail">
                            <p class="course-name">The Complete UI/UX Design Course - Build User-Centric Products</p>
                        </div>

                        <div class="price-info">
                            <p class="price-label">Subtotal</p>
                            <p class="price-amount">10,000</p>
                        </div>

                        <p class="course-title">Add discount</p>
                        <div class="price-info">
                            <p class="price-label">Total</p>
                            <p class="price-amount">10,000</p>
                        </div>
                    </div>

                </div>

                <!-- Right div -->
                <div class="right-div">
                    <div class="details-section">
                        <div class="row-container">
                            <p class="section-heading1">Your Details</p>
                            <img src="image/errow left.png" alt="" class="arrow-icon">
                            <p class="section-heading1" style="color: black;">Payment</p>
                        </div>

                        <!-- New Text and Image Added -->
                        <div class="additional-info">
                            <div style="display: flex; align-items: center; margin-top: 32px;">
                                <p style="
                                font-family: 'Roboto', sans-serif; 
                                font-size: 16px; 
                                font-weight: 400; 
                                line-height: 24px; 
                                text-align: left; 
                                margin-right: 10px;">
                                    Payment method
                                </p>
                                <img src="image/3dae7998e4ddfb250b1646b3bf6290c6.png" alt="" style="
                                width: 50px; 
                                height: 25.17px;  
                                opacity: 1; margin-left: 201px;"> <!-- Changed opacity to 1 for visibility -->
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px;">
                                <p style="
                                font-family: 'Roboto', sans-serif; 
                                font-size: 16px; 
                                font-weight: 400; 
                                line-height: 24px; 
                                text-align: left; 
                                margin-right: auto;">
                                    Account holder name
                                </p>
                                <p style="
                                font-family: 'Roboto', sans-serif; 
                                font-size: 16px; 
                                font-weight: 400; 
                                line-height: 24px; 
                                text-align: right;">
                                    Ali Hamza
                                </p>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px;">
                                <p style="
                                font-family: 'Roboto', sans-serif; 
                                font-size: 16px; 
                                font-weight: 400; 
                                line-height: 24px; 
                                text-align: left; 
                                margin-right: auto;">
                                    Account number
                                </p>
                                <p style="
                                font-family: 'Roboto', sans-serif; 
                                font-size: 16px; 
                                font-weight: 400; 
                                line-height: 24px; 
                                text-align: right;">
                                    0300-000000
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="input-container" style="margin-top: 32px;">
                            <img src="image/ic_round-person.png" alt="" class="input-icon3"> <!-- Email Icon -->
                            <input type="email" class="form-control input-field" placeholder="Your Account" required>
                        </div>
                        <div class="input-container">
                            <img src="image/lrft & right.png" alt="" class="input-icon3"> <!-- Email Icon -->
                            <input type="email" class="form-control input-field" placeholder="Transaction ID" required>
                        </div>

                        <div class="upload-section">
                            <p class="upload-header">Upload Receipt</p> <!-- Header text -->
                            <label for="upload-file" class="upload-label" style="margin-top: 16px;">
                                <span>Upload</span>
                                <img src="image/material-symbols_receipt.png" alt="Upload Icon" class="upload-icon">
                                <!-- Image in front of Upload -->
                            </label>
                            <input type="file" id="upload-file" class="upload-input">
                        </div>

                        <div class="medium-text-section">
                            <button class="submit-button" id="submitBtn">Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="popup-section3" id="popup3" style="display: none; ">
        <div class="popup-container-single3">
            <div class="close-button3" onclick="closePopup()">×</div>

            <!-- Single content div -->
            <div class="single-div3">
                <img src="image/Group 676.png" alt="Popup Image" class="popup-image3">
                <h3 class="popup3-heading">Thank you for your purchase</h3>
                <p class="popup3-text">Payment verification takes up to 24 hours</p>
            </div>
        </div>
    </section>
    <?php include('index/faq-section.php') ?>
    <?php include('includes/footer.php') ?>
    <?php include('signup-login.php');?>     
    <!-- jQuery 3.x Slim Version CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        // Function to show the specific pop-up
        function showPopup(popupId) {

            document.querySelectorAll('.popup-section').forEach(popup => popup.style.display = 'none');

            // Show the selected pop-up
            document.getElementById(popupId).style.display = 'block';
        }

        // Function to close pop-ups
        function closePopup() {
            document.querySelectorAll('.popup-section').forEach(popup => popup.style.display = 'none');
        }
        document.getElementById('submitBtn').addEventListener('click', function () {
            // Hide popup2
            document.getElementById('popup2').style.display = 'none';

            // Show popup3
            document.getElementById('popup3').style.display = 'flex';
        });

        function closePopup() {
            // Hide all popups
            document.getElementById('popup2').style.display = 'none';
            document.getElementById('popup3').style.display = 'none';
        }

    </script>
</body>

</html>