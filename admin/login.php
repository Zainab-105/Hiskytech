<?php
include('includes/head.php');
include('includes/connection.php');
session_start();
$msg = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form inputs
    if (empty($email) || empty($password)) {
        $msg = '<div class="alert alert-danger">Please enter both email and password.</div>';
    } else {
        // Check if the user exists
        $sql = "SELECT * FROM admin WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Verify the password
            if (password_verify($password, $row['password'])) {
                $_SESSION['adminid'] = $row['aid'];
                header('Location: index.php');
                exit();
            } else {
                $msg = '<div class="alert alert-danger">Incorrect email or password.</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger">User not found.</div>';
        }
    }
}
?>

<!-- Your HTML code goes here -->



<!-- Your HTML code goes here -->



<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                   <?php if (!empty($msg)) {
                        echo $msg;
                    }?>
                                    <form class="user" method='post'>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name='email'>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name='password'>
                                        </div>
                                      
                                        <input type="submit" class="btn btn-primary btn-user btn-block"value='Login' name='submit'>
                                     
                                        <hr>
                                      
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                       
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>


<!-- Mirrored from startbootstrap.github.io/startbootstrap-sb-admin-2/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Apr 2024 06:31:26 GMT -->
</html>