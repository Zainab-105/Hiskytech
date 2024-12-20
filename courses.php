<?php include('includes/connection.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Projects</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/courses.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
</head>

<body>
    <?php include('includes/nav.php'); ?>
    <div class="section-container">
        <!-- Top Row: Category, Search Bar, and Cart Icon -->
        <div class="top-row">
            <div class="category-box">
                <select>
                    <option value="category1">Category 1</option>
                    <option value="category2">Category 2</option>
                    <option value="category3">Category 3</option>
                </select>
            </div>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="container p-3">
            <div class="heading-section card-heading">
                <h4>Most Popular</h4>
            </div>
        </div>

        <!-- Card Section 1 -->
        <div class="card-section">
            <!-- Heading Section -->
           
            <?php 
$sql="SELECT * FROM courses";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($query)){ ?>

<div class="col-md-3"> <!-- Card 1 -->
<a href="course-details.php?id=<?=$row['id']?>" class="cards-anchor">
                <div class="cards">
                    <div> <img src="admin/<?=$row['thumbnail']?>" alt=""></div>

                    <div class="cards-content">
                        <h3><?=$row['name'] ?></h3>
                        <p>By <?=$row['instructor']?></p>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <div class="card-price">Rs <?=$row['price']?></div>
                    </div>
                </div>
                </a>
            </div>

    
            <?php
}
?>
         
           
        </div>

        <!-- Read More Button Section -->
        <div class="read-more-section">
            <a href="#" class="read-more-btn">Show More</a>
        </div>
        <!-- Heading Section -->
        <div class="container p-3">
            <div class="heading-section card-heading">
                <h4>Recently Added</h4>
            </div>
        </div>

        <!-- Card Section 2 -->
        <div class="card-section">
            <!-- Heading Section -->
<?php 
$sql="SELECT * FROM courses ORDER BY id DESC LIMIT 4";
$query=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($query)){ ?>

<div class="col-md-3"> <!-- Card 1 -->
<a href="course-details.php?id=<?=$row['id']?>" class="cards-anchor">
                <div class="cards">
                    <div> <img src="admin/<?=$row['thumbnail']?>" alt=""></div>

                    <div class="cards-content">
                        <h3><?=$row['name'] ?></h3>
                        <p>By <?=$row['instructor']?></p>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <div class="card-price">Rs <?=$row['price']?></div>
                    </div>
                </div>
                </a>
            </div>

            <?php
}
?>
        
  
            </div>





        <!-- Read More Button Section -->
        <div class="read-more-section">
            <a href="#" class="read-more-btn">Show More</a>
        </div>

        </div>


    </div>
    <?php include('index/feedback-section.php'); ?>
    <?php include('includes/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="js/script.js"></script>
    <script>
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
        $('.card-section').slick({
            centerMode: true,
            centerPadding: '10px',
    
            slidesToShow: 4,
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
</body>

</html>