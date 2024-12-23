<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup-login.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include('includes/nav.php');?>

  

    <!-- Additional Sections -->
    <section class="section-B">
        <div class="verification-container">
            <h2 class="mt-3">Reset Your Password!</h2>
            <form action="">
                <input type="password" class="form-control custom-input mt-3" placeholder="&#xf023;   Your Password" required>
                <input type="password" class="form-control custom-input mt-3" placeholder="&#xf023;   Repeat Password" required>
                <button class="btn-login mt-3">Reset Password</button>
            </form>
        </div>
    </section>

<?php include('includes/footer.php')?>
<?php include('signup-login.php');?>  


    <!-- Optional Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
