<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Elisha Creation || Admin Login</title>
   <link rel="stylesheet" href="assets/css/login.css">
   <link rel="stylesheet" href="assets/css/bootstrap.css">
   <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
   <link rel="stylesheet" href="/assets/css/font.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

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
                  <h1 class="fs-6">Admin Login</h1>
               </div>
               <!-- to display a error massage -->
               <div class="col-12 d-none" id="msgdiv">
                  <div class="alert alert-danger" role="alert" id="msg">

                  </div>
               </div>
               <!-- end in here -->

               <div class="input-group mb-3">
                  <input type="text" class="form-control form form-control-lg bg-light fs-6" id="email" placeholder="Email Address">
               </div>

               <div class="input-group mb-0">
                  <input type="password" class="form-control form form-control-lg bg-light fs-6" id="pwd" placeholder="Password">
                  <button class="btn btn-outline-secondary" onclick="showLogPassword();" id="npb" type="button">Show</button>
               </div>

               <div class="input-group mb-0 mt-3 d-flex justify-content-between">
                  <div class="form-check">

                  </div>

               </div>

               <div class="login-row btnroo row no-margin col-12 mb-5 ms-lg-1">
                  <div class="col-lg-12 d-grid">
                     <button class="btn btn-sm text-light" style="background-color: rgba(250,115,93,255);" onclick="adminSignIn();"> Sign In</button>
                  </div>
               </div>
               <hr class="text-secondary mt-4">

            </div>
         </div>

      </div>
   </div>
   </div>
   <!--sign In ends Here-->

   <!--  -->

   <div class="modal" tabindex="-1" id="verificationModal">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Admin Verification</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <label class="form-label">Enter Your Verification Code</label>
               <input type="text" class="form-control" id="vcode">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
            </div>
         </div>
      </div>
   </div>

   <!--  -->

   <script src="assets/js/script.js"></script>
</body>

</html>