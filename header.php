<?php
session_start();
function getActiveClass($uri) {
  $currentFile = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
  return ($currentFile == $uri) ? 'active1' : '';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elisha Creation || Shop Now</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/font.css">
  <link rel="stylesheet" href="assets/css/tezt.css">
  <link rel="stylesheet" href="/assets/css/ionicons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/js/owl.carousel.min.js">
  <link rel="stylesheet" href="assets/css/animate.min.css">
  <link rel="stylesheet" href="assets/css/lightbox.min.css">
  <link rel="stylesheet" href="assets/css/icomoon.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .active1 {
      color: #f76838;
      text-decoration: underline;
    }

    .dot {
      font-size: 40em;
    }

    .active1:hover {
      color: #f76838;
    }

    .active2:hover {
      color: #e78b6d;
    }

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
      border-left: 3px solid rgb(250, 115, 93);
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
      border-left: 3px solid rgb(250, 115, 93);
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

<body class="hbody" onload="initializeLogoutTimer()">
  <!--PreLoader-->
  <div class="loader col-12 " id="preloader">
    <div class="loader-inner">
      <div class="circle"></div>
    </div>
  </div>
  <!--PreLoader Ends-->

  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light shadow sticky-top" id="myDiv">
    <div class="container-fluid">
      <a class="navbar-brand ms-2 fs-5 fw-bold" href="index.php">Elisha<span class="dot fw-bold fs-5">.</span></a>
      <button class="navbar-toggler dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon dark"><i class="fa-solid fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto me-auto text-center justify-content-center align-content-center">
          <li class="nav-item">
            <a class="nav-link <?php echo getActiveClass('index.php'); ?> fw-bold" aria-current="page" onclick="setActive(this)" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo getActiveClass('product.php'); ?> fw-bold" href="product.php" onclick="setActive(this)">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo getActiveClass('about.php'); ?> fw-bold" href="about.php" onclick="setActive(this)">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo getActiveClass('contact.php'); ?> fw-bold" href="contact.php" onclick="setActive(this)">Contact Us</a>
          </li>
          <li class="nav-item">
            <?php
            if (isset($_SESSION["u"])) {
              $data = $_SESSION["u"];
            ?><a class="nav-link <?php echo getActiveClass('profile.php'); ?> fw-bold" href="profile.php" onclick="setActive(this)"><?php echo $data["fname"]; ?></a><?php
                                                                                                                        } else {
                                                                                                                          ?><a class="nav-link  fw-bold" href="login.php">Login</a><?php
                                                                                                                                                      }
                                                                                                                                                        ?>
          </li>
          <li class="nav-item">
            <?php
            if (isset($_SESSION["u"])) {
            ?><a class="nav-link  fw-bold" href="logout.php">Logout</a><?php
                                                                      }
                                                                        ?>
          </li>
        </ul>
        <div class="d-flex">
          <i class="fa-solid fa-heart pe-2 <?php echo getActiveClass('wishlist.php'); ?> hover" id="heart"></i>
          <i id="cart-icon" class="fa-solid <?php echo getActiveClass('cart.php'); ?> fa-cart-shopping hover" onclick="cartStatus();"></i>
        </div>
      </div>
    </div>
  </nav>
  <script>

    function setActive(element) {

      var link = document.querySelectorAll('.nav-link');
      link.forEach(link => {
        link.classList.remove('active1');
      });
      element.classList.add('active1'); 
    }

  </script>