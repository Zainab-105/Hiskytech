
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp-Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup-login.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
     <!-- login modal -->
 <div id="loginModal" class="modal" style="display: none;">
        <div class="modal-content model-body ">
            <span class="close">&times;</span>
            <img src="image/signup-img1.png" alt="">
            <h2 class="model-heading">Hello Dear!</h2>
            <p class="model-text1" style="display: inline;">
                Login into the
                <span style="display: inline; font-size: 1em;">
                    <span class="color-hi-tech" style="display: inline-block;">Hi</span><span class="color-sky" style="display: inline-block;">Sky</span><span class="color-hi-tech" style="display: inline-block;">Tech</span>
                </span>:
            </p>
            <p class="model-text">To access your HiSkyTech account, please enter your email and password.</p>
            <form>
                <input type="email" class="form-control custom-input" placeholder="&#xf0e0;   Your Email" required>
                <input type="password" class="form-control custom-input" placeholder="&#xf023;   Your Password" required>
                <a href="#" class="forgot-password" style="color:  #AAAAAA;">Forgot Password?</a>
                <button type="submit" class="btn-login" style="margin-top: 19px;">Login</button>
            </form>
            <p class="acoount-p">Don’t have an account yet? <a href="#" class="acoount-a registerHereLink">Register here</a></p>
        </div>
    </div>
    <!-- register modal -->
    <div id="registerModal" class="modal" style="display: none;">
        <div class="modal-content model-body ">
            <span class="close">&times;</span>
            <img src="image/grinning.png" alt="">
            <p class="model-heading" style="display: inline;">Join <span style="display: inline; font-size: 1em;">
                <span class="color-hi-tech" style="display: inline-block;">Hi</span><span class="color-sky" style="display: inline-block;">Sky</span><span class="color-hi-tech" style="display: inline-block;">Tech</span>
            </span></p>
            <p class="model-text1" >
                Register your account
            </p>
            <p class="model-text">In order to create your account, please fill the information below:</p>
            <form>
                <input type="email" class="form-control custom-input" placeholder="&#xf0e0;   Your Email" required>
                <input type="password" class="form-control custom-input" placeholder="&#xf023;   Your Password" required>
                <input type="password" class="form-control custom-input" placeholder="&#xf023;   Repeat Password" required>
                <button type="submit" class="btn-login"  id="registered" style="margin-top: 19px;">Register</button>
            </form>
            <p class="acoount-p">Already have an account? <a href="#" class="acoount-a openModalBtn" id="switch-login">Switch to login</a></p>
            <p class="acoount-p forgot-password">Forgot Password? <a href="#" class=" acoount-a ">Click here</a></p>
        </div>
    </div>
    <!-- Registered successfully -->
    <div id="registerion-success" class="modal" style="display: none;">
        <div class="modal-content model-body ">
            <span class="close">&times;</span>
            <img src="image/grinning.png" alt="">
            <p class="model-heading" style="display: inline;">Join <span style="display: inline; font-size: 1em;">
                <span class="color-hi-tech" style="display: inline-block;">Hi</span><span class="color-sky" style="display: inline-block;">Sky</span><span class="color-hi-tech" style="display: inline-block;">Tech</span>
            </span></p>
            <p class="model-text1" >
                Register your account
            </p>
            <p class="model-text" style="color: #666;">Registered successfully!</p>
           
            <p class="account-verify">Check your email to verify your account</p>
           
        </div>
    </div>
    <!-- forgot password -->
    <div id="forgotModal" class="modal" style="display: none;">
        <div class="modal-content model-body ">
            <span class="close">&times;</span>
            <p class="model-text1" >
               Forgot Password
            </p>
           
            <form>
                <input type="email" class="form-control custom-input" placeholder="&#xf0e0;   Your Email" required>
                <button type="submit" class="forgot-link btn-login"  id="forgot-link" style="margin-top: 19px;">Send Password reset link</button>
            </form>
            <p class="acoount-p">Already have an account? <a href="#" class="openModalBtn acoount-a " id="switch-login">Switch to login</a></p>
            <p class="acoount-p">Don’t have an account yet? <a href="#" class="acoount-a registerHereLink" >Register here</a></p>
        </div>
    </div>
    <div id="forgotModalsuccess" class="modal" style="display: none;">
        <div class="modal-content model-body ">
            <span class="close">&times;</span>
            <p class="model-text1" >
               Forgot Password
            </p>
           
            <p class="acoount-p">Mail sent! Check your mailbox!</p>
      
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
    const loginModal = document.getElementById("loginModal");
    const openModalBtns = document.getElementsByClassName("openModalBtn"); 
    const closeLoginModalBtn = document.querySelector("#loginModal .close");
    
    const registerModal = document.getElementById("registerModal");
    const closeRegisterModalBtn = document.querySelector("#registerModal .close");
    const registerHereLink = document.getElementsByClassName("registerHereLink");

    const registrationsuccess = document.getElementById("registration-success");
    const registrationsuccessbtn = document.getElementById("registered");
    const closeRegistersucessBtn = document.querySelector("#registration-success .close");

    const forgotModal = document.getElementById("forgotModal");
    const forgotBtns = document.getElementsByClassName("forgot-password"); 
    const closeforgotModalBtn = document.querySelector("#forgotModal .close");

    const forgotModalsucess = document.getElementById("forgotModalsuccess");
    const forgotBtnsclick = document.getElementsByClassName("forgot-link"); 
    const closeforgotBtnsuccess = document.querySelector("#forgotModalsuccess .close");

    Array.from(openModalBtns).forEach((btn) => {
        btn.addEventListener("click", (event) => {
            event.preventDefault();
            loginModal.style.display = "block";
            if (registerModal && registerModal.style.display === "block") {
                registerModal.style.display = "none";
            }
            if (forgotModal.style.display === "block") {
                forgotModal.style.display = "none";
            }
        });
    });

    closeLoginModalBtn.addEventListener("click", () => {
        loginModal.style.display = "none";
    });

    Array.from(forgotBtns).forEach((btn) => {
        btn.addEventListener("click", (event) => {
            event.preventDefault();
            forgotModal.style.display = "block";
            if (registerModal && registerModal.style.display === "block") {
                registerModal.style.display = "none";
            }
            if (loginModal.style.display === "block") {
                loginModal.style.display = "none";
            }
        });
    });

    closeforgotModalBtn.addEventListener("click", () => {
        forgotModal.style.display = "none";
    });

    Array.from(registerHereLink).forEach((btn) => {
        btn.addEventListener("click", (event) => {
            event.preventDefault();
            registerModal.style.display = "block";
            if (forgotModal.style.display === "block") {
                forgotModal.style.display = "none";
            }
            if (loginModal.style.display === "block") {
                loginModal.style.display = "none";
            }
        });
    });

    closeRegisterModalBtn.addEventListener("click", () => {
        registerModal.style.display = "none";
    });

    registrationsuccessbtn.addEventListener("click", (event) => {
        event.preventDefault(); 
        registerModal.style.display = "none";
        registrationsuccess.style.display = "block";
    });

    closeRegistersucessBtn.addEventListener("click", () => {
        registrationsuccess.style.display = "none";
    });

    forgotBtnsclick.addEventListener("click", (event) => {
        event.preventDefault(); 
        forgotModalsucess.style.display = "block"; 
        forgotModal.style.display = "none";
    });

    closeforgotBtnsuccess.addEventListener("click", () => {
        forgotModalsucess.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target == loginModal) {
            loginModal.style.display = "none";
        }
        if (event.target == registerModal) {
            registerModal.style.display = "none";
        }
        if (event.target == registrationsuccess) {
            registrationsuccess.style.display = "none";
        }
        if (event.target == forgotModal) {
            forgotModal.style.display = "none";
        }
        if (event.target == forgotModalsucess) {
            forgotModalsucess.style.display = "none";
        }
    });
});

 </script>
  <!-- Optional Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>