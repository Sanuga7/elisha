<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Elisha Creation || Login</title>
   <link rel="stylesheet" href="assets/css/login.css">
   <link rel="stylesheet" href="assets/css/bootstrap.css">
   <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
   <link rel="stylesheet" href="/assets/css/font.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
   <style>

.loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #fff;
      z-index: 9999;
      /* Make sure the loader is on top of other content */
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;

    }

    .loader-inner {
      position: absolute;
      left: 50%;
      top: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      height: 50px;
      width: 50px;
    }

    .circle {
      width: 8vmax;
      height: 8vmax;
      border-right: 4px solid #000;
      border-radius: 50%;
      -webkit-animation: spinRight 800ms linear infinite;
      animation: spinRight 800ms linear infinite;
    }

    .circle:before {
      content: '';
      width: 6vmax;
      height: 6vmax;
      display: block;
      position: absolute;
      top: calc(50% - 3vmax);
      left: calc(50% - 3vmax);
      border-left: 3px solid #F28123;
      border-radius: 100%;
      -webkit-animation: spinLeft 800ms linear infinite;
      animation: spinLeft 800ms linear infinite;
    }

    .circle:after {
      content: '';
      width: 6vmax;
      height: 6vmax;
      display: block;
      position: absolute;
      top: calc(50% - 3vmax);
      left: calc(50% - 3vmax);
      border-left: 3px solid #F28123;
      border-radius: 100%;
      -webkit-animation: spinLeft 800ms linear infinite;
      animation: spinLeft 800ms linear infinite;
      width: 4vmax;
      height: 4vmax;
      top: calc(50% - 2vmax);
      left: calc(50% - 2vmax);
      border: 0;
      border-right: 2px solid #000;
      -webkit-animation: none;
      animation: none;
    }

    @-webkit-keyframes spinLeft {
      from {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }

      to {
        -webkit-transform: rotate(720deg);
        transform: rotate(720deg);
      }
    }

    @keyframes spinLeft {
      from {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }

      to {
        -webkit-transform: rotate(720deg);
        transform: rotate(720deg);
      }
    }

    @-webkit-keyframes spinRight {
      from {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }

      to {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
    }

    @keyframes spinRight {
      from {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }

      to {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
    }

    @keyframes spinner-grow {
      0% {
        transform: scale(0);
      }

      50% {
        opacity: 1;
        transform: none;
      }
    }

   </style>
</head>

<body>
   <!--PreLoader-->
  <div class="loader col-12 " id="preloader">
    <div class="loader-inner">
      <div class="circle"></div>
    </div>
  </div>
  <!--PreLoader Ends-->
   <!-- SignIn Box Here -->
   <div class="bg container-fluid align-items-center justify-content-center d-flex min-vh-100" id="signInBox">
      <div class="row border rounded-5 p-3 bg-white shadow box-area">

         <div class="col-md-7 align-items-center justify-content-center d-flex flex-column">
            <div class="featured-image mb-3">
               <img src="assets/images/login-banner.png" class="img-fluid" style="width: 850px;">
            </div>
         </div>

         <div class="col-md-5">
            <div class="row align-items-center">
               <div class="header-text mb-3 ms-lg-1 ms-0 mt-lg-3 mt-5">
                  <h1 class="fs-6">Welcome Back!</h1>
               </div>
               <!-- to display a error massage -->
               <div class="col-12 d-none" id="msgdiv">
                  <div class="alert alert-danger" role="alert" id="msg">

                  </div>
               </div>
               <!-- end in here -->
               <?php
               $email = "";
               $password = "";

               if (isset($_COOKIE["email"])) {
                  $email = $_COOKIE["email"];
               }

               if (isset($_COOKIE["password"])) {
                  $password = $_COOKIE["password"];
               }
               ?>
               <div class="input-group mb-3">
                  <input type="text" class="form-control form form-control-lg bg-light fs-6" id="email" placeholder="Email Address" value="<?php echo $email; ?>">
               </div>

               <div class="input-group mb-2">
                  <input type="password" class="form-control form form-control-lg bg-light fs-6" id="pwd" placeholder="Password" value="<?php echo $password; ?>">
                  <button class="btn btn-outline-secondary" onclick="showLogPassword();" id="npb" type="button">Show</button>
               </div>

               <div class="input-group mb-4 mt-3 d-flex justify-content-between">
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="formCheck">
                     <label for="formCheck" class="form-check-label text-secondary">Remember Me</label>
                  </div>
                  <div class="forgot">
                     <small><a href="#" onclick="forgotPw();">Forgot Password?</a></small>
                  </div>
               </div>

               <div class="login-row btnroo row no-margin col-12">
                  <div class="col-lg-6 d-grid">
                     <button class="btn btn-sm text-light" style="background-color: rgba(250,115,93,255);" onclick="signIn();"> Sign In</button>
                  </div>
                  <div class="col-lg-6 d-grid">
                     <button class="btn btn-light  btn-sm" onclick="changeView();"> Create Account</button>
                  </div>
               </div>
               <hr class="text-secondary mt-4">
               <div class="log-btn justify-content-center align-items-center text-secondary d-flex gap2">
                  <i class="fa-brands fa-google me-4"></i>
                  <i class="fa-brands fa-facebook me-4"></i>
                  <i class="fa-brands fa-twitter me-4"></i>
                  <i class="fa-brands fa-github me-4"></i>
               </div>
            </div>
         </div>

      </div>
   </div>
   </div>
   <!--sign In ends Here-->
   <!-- SignUp Start Here-->
   <div class="bg container-fluid align-items-center justify-content-center d-flex min-vh-100 d-none" id="signUpBox">
      <div class="row border rounded-5 p-3 bg-white shadow box-area">

         <div class="col-md-7 align-items-center justify-content-center d-flex flex-column">
            <div class="featured-image mb-3">
               <img src="assets/images/login-banner.png" class="img-fluid" style="width: 850px;">
            </div>
         </div>

         <div class="col-md-5">
            <div class="row align-items-center">
               <div class="header-text mb-3 ms-lg-1 ms-0 mt-lg-3 mt-5">
                  <h1 class="fs-6">Register Now!</h1>
               </div>
               <!-- to display a error massage -->
               <div class="col-12 d-none" id="msgdiv1">
                  <div class="alert alert-danger" role="alert" id="msg1">

                  </div>
               </div>
               <!-- end in here -->
               <div class="col-12">
                  <div class="input-group mb-3 col-lg-6">
                     <input type="text" class="form-control form form-control-lg bg-light fs-6" id="fname" placeholder="First Name">
                  </div>
                  <div class="input-group mb-3 col-lg-6">
                     <input type="text" class="form-control form form-control-lg bg-light fs-6" id="lname" placeholder="Last Name">
                  </div>
               </div>
               <div class="input-group mb-3">
                  <input type="text" class="form-control form form-control-lg bg-light fs-6" id="Email" placeholder="Email Address">
               </div>

               <div class="input-group mb-4">
                  <input type="text" class="form-control form form-control-lg bg-light fs-6" id="password" placeholder="Password">
               </div>

               <div class="login-row btnroo row no-margin col-12">
                  <div class="col-lg-6 d-grid">
                     <button class="btn btn-sm text-light" style="background-color: rgba(250,115,93,255);" onclick="signUp(); modalcheck();"> Register</button>
                  </div>
                  <div class="col-lg-6 d-grid">
                     <button class="btn btn-light  btn-sm" onclick="changeView();"> Login</button>
                  </div>
               </div>
               <hr class="text-secondary mt-4">
               <div class="log-btn justify-content-center align-items-center text-secondary d-flex gap2 mb-4">
                  <i class="fa-brands fa-google me-4"></i>
                  <i class="fa-brands fa-facebook me-4"></i>
                  <i class="fa-brands fa-twitter me-4"></i>
                  <i class="fa-brands fa-github me-4"></i>
               </div>
            </div>
         </div>

      </div>
   </div>
   </div>
   <!-- SignIn Ends Here-->
   <!-- modal verification -->
   <div class="modal" tabindex="-1" id="verification">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Activate Your Account</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- to display a error massage -->
               <div class="col-12 d-none" id="msgdiv2">
                  <div class="alert alert-danger" role="alert" id="msg2">

                  </div>
               </div>
               <!-- end in here -->
               <p>To Activate your Account Enter the code that we sent to your email</p>
               <div class="col-6">
                  <label class="form-label">Verification Code</label>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" id="code" />
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" onclick="userVerify();">Verify</button>
            </div>
         </div>
      </div>
   </div>
   <!-- modal verification ends here -->
   <!-- forgot password modal start here -->
   <div class="modal" tabindex="-1" id="forgot">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Forgot Password</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

               <div class="row g-3">

                  <div class="col-6">
                     <label class="form-label">New Password</label>
                     <div class="input-group mb-3">
                        <input type="password" class="form-control" id="np" />
                        <button class="btn btn-outline-secondary" onclick="showPassword();" id="npb" type="button">Show</button>
                     </div>
                  </div>

                  <div class="col-6">
                     <label class="form-label">Re-type Password</label>
                     <div class="input-group mb-3">
                        <input type="password" class="form-control" id="np1" />
                        <button class="btn btn-outline-secondary" onclick="showPassword1();" id="npb1" type="button">Show</button>
                     </div>
                  </div>

                  <div class="col-12">
                     <label class="form-label">Verification Code</label>
                     <input type="text" class="form-control" id="vcode" />
                  </div>

               </div>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
            </div>
         </div>
      </div>
   </div>
   <!-- forgot password modal ends here -->

   <script src="assets/js/script.js"></script>
</body>

</html>