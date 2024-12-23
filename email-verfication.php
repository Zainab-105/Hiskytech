<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup-login.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include('includes/nav.php')?>

   
    
    
    <!-- Additional Sections -->
    <section class="section-B">
        <div class="verification-container">
            <h2>Email Verification</h2>
            <p>Your account has been verified!<br> <br>Now you can login.</p>
            <button class="btn-login" id="registerModalBtn">Login</button>

        </div>
    </section>

<?php include('includes/footer.php');?>
 <?php include('signup-login.php');?>       

    <!-- Optional Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
