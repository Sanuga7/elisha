<?php

include("connection.php");
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $id . "' ");
  $product_data = $product_rs->fetch_assoc();
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_data["title"];  ?> || Elisha Creation</title>
    <?php include("header.php");
    $cat_rs = Database::search("SELECT * FROM `product` INNER JOIN `category` ON product.category_cat_id=category.cat_id WHERE `id` = '" . $id . "' ");
    $cat_data = $cat_rs->fetch_assoc();
    $cat = $cat_data["category_name"];
    ?>

    <!-- <link rel="stylesheet" href="assets/css/tezt.css">-->
    <style>
      .sproduct {
        overflow-x: hidden;
      }

      .mainImg {
        height: 550px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
      }

      .smallImg img {
        width: 200px;
        margin-top: 15px;
      }

      @media screen and (max-width: 480px) {
        .smallImg img {
          width: 100px;
          margin-top: 15px;
          overflow-x: hidden;
        }

        * {
          overflow-x: hidden;
        }
      }

      .small-img-group {
        display: flex;
        justify-content: space-between;
      }

      .small-img-col {
        flex-basis: 32%;
        cursor: pointer;
      }

      .buy-btn {
        background-color: white;
        color: #f76838;
        border: #f76838 solid 1px;
        margin-top: 15px;
      }

      .cart-btn {
        background-color: #f76838;
        color: white;
        margin-top: 15px;
      }

      .cart-btn:hover {
        background-color: white;
        border: #f76838 solid 1px;
        cursor: pointer;
        color: #f76838;
        margin-top: 15px;
      }

      .buy-btn:hover {
        background-color: #f76838;
        color: white;
        cursor: pointer;
        margin-top: 15px;
      }

      .sproduct input {
        width: 50px;
        height: 40px;
        padding-left: 10px;
        font-size: 16px;
        margin-right: 10px;
      }

      .sproduct select {
        width: 160px;
        height: 40px;
        padding-left: 10px;
        font-size: 16px;
        margin-right: 10px;
      }

      .home {
        color: #f76838;
      }

      .home:hover {
        color: #f76838;
      }

      .btn-wish {
        background-color: #f76838;
        color: white;
      }

      .btn-wish:hover {
        background-color: white;
        color: #f76838;
        border: #f76838 solid 1px;
      }

      .ab {
        color: #f76838;
        font-size: 30px;
      }

      .ab::after {
        content: "";
        height: 5px;
        width: 100px;
        background-color: #f76838;
        border-radius: 25px;
        display: block;
        margin: auto;
      }

      .header {
        margin: 0%;
        width: 100%;
        height: 550px;
        background-position: top;
        background-size: cover;
        background: url(../images/hero-image.jpg) 35% no-repeat;
        background-attachment: fixed;
      }

      .con {
        margin-bottom: 0%;
        font-size: 80px;
        font-style: bold;
      }

      .phome {
        font-size: 25px;
      }

      .content {
        height: 100vh;
      }

      .g {
        color: #f76838;
      }

      .d {
        font-size: 30px;
      }

      .de {
        text-decoration: none;
        color: rgb(108, 114, 114);
      }

      .ic {
        font-size: 20px;
        color: rgb(126, 130, 133);
      }

      .ic a {
        text-decoration: none;
        color: rgb(126, 130, 133);
        ;
      }

      .ic a:hover {
        text-decoration: none;
        color: rgb(62, 65, 67);
        ;
      }

      .de:hover {
        text-decoration: none;
        color: rgb(62, 65, 67);
        ;
      }

      .de1 {
        text-decoration: none;
        color: rgb(108, 114, 114);
        overflow-y: hidden;
      }

      .de1:hover {
        text-decoration: none;
        color: rgb(62, 65, 67);
        overflow-y: hidden;
      }

      .small-img:hover {
        transform: scale(1.02);
      }

      .card:hover {
        transform: scale(1.05);
      }

      .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        align-items: center;
        font-size: 2rem;
        color: #d3d3d3;
      }

      .rating input {
        display: none;
      }

      .rating label {
        cursor: pointer;
      }

      .rating input:checked~label {
        color: #ffb600;
      }

      .feedback-form {
        margin-top: 20px;
      }

      .rating-breakdown {
        font-family: Arial, sans-serif;
        margin-top: 20px;
      }

      .rating-item {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
      }

      .star {
        color: #FFD700;
        font-size: 1.5em;
        margin-right: 10px;
      }

      .bar {
        height: 10px;
        background-color: #cccccc;
        border-radius: 5px;
        flex: 1;
        margin-left: 10px;
        position: relative;
        overflow: hidden;
      }

      .bar-fill {
        height: 100%;
        background-color: yellow;
        border-radius: 5px;
        position: absolute;
        top: 0;
        left: 0;
      }

      /* Ensure the carousel takes full width */
      .carousel {
        padding: 0;
        margin: 0;
      }

      .carousel-inner {
        padding: 0;
        margin: 0;
      }

      /* Remove unnecessary margins on carousel items */
      .carousel-item {
        padding: 0;
        margin: 0;
      }

      /* Adjust testimonial card styling */
      .testimonial-card {
        background-color: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 400px;
        margin: 0 auto;
        /* Center the card */
      }

      /* Ensure consistent spacing within testimonial card */
      .testimonial-card .quote {
        font-size: 2rem;
        color: #6c757d;
      }

      .testimonial-card .text {
        font-size: 1.1rem;
        color: #495057;
        margin: 20px 0 10px;
        /* Adjusted margin */
      }

      .testimonial-card .stars {
        color: #ffb600;
      }

      .testimonial-card .author {
        font-weight: bold;
        margin-top: 10px;
        color: #343a40;
      }

      .testimonial-card .position {
        font-size: 0.9rem;
        color: #868e96;
      }

      /* Custom styles for carousel controls */
      .custom-prev,
      .custom-next {
        color: black;
        /* Ensure visibility */
      }

      .custom-prev:hover,
      .custom-prev:focus,
      .custom-next:hover,
      .custom-next:focus {
        color: black;
      }

      .carousel-control-prev-icon,
      .carousel-control-next-icon {
        background-image: none;
      }

      .carousel-control-prev-icon::after,
      .carousel-control-next-icon::after {
        font-size: 30px;
        color: black;
      }

      .carousel-control-prev-icon::after {
        content: '\276E';
        /* Left arrow */
      }

      .carousel-control-next-icon::after {
        content: '\276F';
        /* Right arrow */
      }

      .pro {
        overflow-y: hidden;
      }
    </style>

  </head>

  <body>

    <section class="sproduct container mt-4">
      <div class="row">
        <div class="col-lg-5 col-md-12 col-12">
          <?php
          $image_rs1 = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $id . "' LIMIT 1");
          $img_data = $image_rs1->fetch_assoc();
          ?>
          <img src="<?php echo $img_data["img_path"]; ?>" class="img-fluid w-100 pb-3" id="mainImg">
          <div class="small-img-group">
            <?php
            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $id . "' ");
            $img_num = $image_rs->num_rows;
            if ($img_num != 0) {
              for ($x = 0; $x < $img_num; $x++) {
                $image_data = $image_rs->fetch_assoc();
                $img[$x] = $image_data["img_path"];
            ?>
                <div class="small-img-col pro sproduct">
                  <img src="<?php echo $img[$x]; ?>" class="small-img" width="100%" id="small-img<?php echo $x; ?>" onclick="loadImg('<?php echo $x; ?>');">
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
        <div class="col-lg-5 col-md-12 col-12">
          <h6 style="overflow-y: hidden;" class="text-secondary mt-sm-2 mt-md-2 mt-lg-0"><a href="index.php" class="home">Home</a> / <a href="#" class="home"><?php echo $cat; ?></a> / <span class="text-dark"><?php echo $product_data["title"];  ?></span></h6>
          <h3 class="fw-bold pt-4 pb-2"><?php echo $product_data["title"];  ?></h3>
          <h4 id="price">RS <?php echo $product_data["price"];  ?>.00</h4>
          <h5 class="text-secondary">Description</h4>
            <p class="text-dark pt-2"><?php echo $product_data["description"];  ?></p>
            <h5><?php echo $product_data["qty"];  ?> Items Left</h5>
            <form action="checkBuyProcess.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <select name="size" id="size" class="">
                <option value="0">Select Size</option>
                <?php
                $district_rs = Database::search("SELECT * FROM `sizes` WHERE `category_cat_id` = '" . $product_data["category_cat_id"] . "' ");
                $d_num = $district_rs->num_rows;

                for ($x = 0; $x < $d_num; $x++) {
                  $d_data = $district_rs->fetch_assoc();
                ?>
                  <option value="<?php echo $d_data["id"]; ?>">
                    <?php echo $d_data["size"]; ?>
                  </option>

                <?php

                }

                ?>
              </select>
              <input type="text" pattern="[0-9]" onchange="price(<?php echo $product_data['price'];  ?>);" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' value="1" id="qty_input" name="q" class="mb-3 border border-5 border-dark">
              <span class="text-secondary" data-bs-toggle="1popover" data-bs-placement="right" data-bs-custom-class="custom-popover" data-bs-title="How to select Size" data-bs-content="To See the size charts visit sizechart.php"><i class="fa-solid fa-circle-question"></i>About Sizes</span>
              <br>
              <?php
              $clr_rs = Database::search("SELECT * FROM `colour_has_product` INNER JOIN `colour` ON colour_has_product.colour_color_id=colour.color_id WHERE `product_id` = '" . $id . "'");
              $clr_num = $clr_rs->num_rows;
              $colors = array(
                "blue" => "#0000FF",
                "black" => "#000000",
                "red" => "#FF0000",
                "yellow" => "#FFFF00",
                "green" => "#008000",
                "purple" => "#800080",
                "pink" => "#FFC0CB",
                "white" => "#FFFFFF"
              );
              for ($q = 0; $q < $clr_num; $q++) {
                $clr_data = $clr_rs->fetch_assoc();
                $colour = strtolower($clr_data["color_name"]);
                if (array_key_exists($colour, $colors)) {
                  $color_code = $colors[$colour];
                  $color_id = $clr_data["color_id"];
              ?>
                  <input type="radio" value="<?php echo $color_id; ?>" class="radio" name="color_radio" id="radio_<?php echo $q; ?>" data-color-id="<?php echo $color_id; ?>" style="accent-color: <?php echo $color_code; ?>">
              <?php
                }
              }
              ?>


              <br>
              <?php
              if (isset($_SESSION["u"])) {
                $data = $_SESSION["u"];
                $wish_rs = Database::search("SELECT * FROM `cart` WHERE  `product_id` = '" . $id . "' AND `user_email` = '" . $data['email'] . "' ");
                $wish_num = $wish_rs->num_rows;
                if ($wish_num == 1) {
              ?><button class="btn cart-btn" type="button" onclick="sent('<?php echo $id; ?>');">Remove From Cart</button><?php
                                                                                                                        } else {
                                                                                                                          ?><button class="btn cart-btn" onclick="sent('<?php echo $id; ?>');">Add To Cart</button><?php
                                                                                                                                                                                                                  }
                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                    ?><button class="btn cart-btn" disabled>Add To Cart</button><?php
                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                                ?>
              <?php
              if (isset($_SESSION["u"])) {
                $edata = $_SESSION["u"];
                $check_add = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $edata['email'] . "' ");
                $num = $check_add->num_rows;
                if ($num != 0) {
              ?><button class="btn buy-btn buy-btn " type="submit">Buy Now</button><br><br><?php
                                                                                          } else {
                                                                                            ?><button class="btn buy-btn buy-btn " onclick="checkAdd();">Buy Now</button><br><br><?php
                                                                                                                                                                                }
                                                                                                                                                                              } else {
                                                                                                                                                                                  ?><button class="btn buy-btn buy-btn " onclick="wishlog();">Buy Now</button><br><br><?php
                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                      ?>
            </form>
            <?php
            if (isset($_SESSION["u"])) {
              $data = $_SESSION["u"];
              $wish_rs = Database::search("SELECT * FROM `wishlist` WHERE  `product_id` = '" . $id . "' AND `user_email` = '" . $data['email'] . "' ");
              $wish_num = $wish_rs->num_rows;
              if ($wish_num == 1) {
            ?><span onclick="send('<?php echo $id; ?>');" class="text-secondary p" aria-disabled="true">Add to Wishlist <i class="fa-solid fa-heart text-danger"></i></span><?php
                                                                                                                                                                          } else {
                                                                                                                                                                            ?><span onclick="send('<?php echo $id; ?>');" id="send" class="text-secondary p" aria-disabled="true">Add to Wishlist <i class="fa-regular fa-heart"></i></span><?php
                                                                                                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                                            ?><span class="text-secondary p" onclick="wishlog();" aria-disabled="true">Add to Wishlist <i class="fa-regular fa-heart"></i></span><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ?>

        </div>
      </div>
    </section>
    <section>
      <!-- Category Name -->



      <!-- Category Name -->
      <!-- products -->


      <div class="col-12 sproduct pro mt-3 mb-3">
        <div class="row border">
          <div class="col-12 mt-3 mb-3" id="myDiv">
            <h5 class="text-decoration-none text-dark fs-4 fw-bold text-center">
              <u class="text-warning"><i class="fa-solid fa-shopping-bag text-dark"></i><span class="text-dark">Related Products</span></u>
            </h5>

          </div>

          <div class="col-12 sproduct pro">
            <div class="row justify-content-center gap-2">

              <?php

              $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $cat_data["category_cat_id"] . "' 
                                    AND `status_id`='1' ORDER BY `added_time` DESC LIMIT 6 OFFSET 0");

              $product_num = $product_rs->num_rows;

              for ($z = 0; $z < $product_num; $z++) {
                $product_data = $product_rs->fetch_assoc();
                if ($product_data["id"] != $id) {
              ?>

                  <div class="card pro col-12 col-lg-2 col-md-4 col-sm-12 col-xs-12 mt-2 mb-2" style="width: 18rem;" onclick="addToCart(<?php echo $product_data['id']; ?>);">

                    <?php
                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                    $img_data = $img_rs->fetch_assoc();
                    ?>

                    <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                    <div class="card-body ms-0 m-0 text-center">
                      <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                      <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                      <?php
                      if ($product_data["qty"] > 0) {

                      ?>
                        <span class="card-text text-success fw-bold">In Stock</span><br /><br>
                        <a href='<?php echo "productView.php?id=" . ($product_data["id"]); ?>' class="col-12 btn text-light" style="background-color: #f76838;">Buy Now</a>
                        <button class="col-12 btn btn-dark mt-2">
                          <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                      <?php

                      } else {
                      ?>
                        <span class="card-text text-danger fw-bold">Out Of Stock</span><br />
                        <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
                        <a href='#' class="col-12 btn btn-success disabled">Buy Now</a>
                        <button class="col-12 btn btn-dark mt-2 disabled">
                          <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                        </button>
                      <?php
                      }
                      ?>
                    </div>
                  </div>

              <?php
                }
              }

              ?>



            </div>
          </div>

        </div>
      </div>

      <div class="col-12 pt-3 pb-3 sproduct">
        <div class="row border">
          <div class="col-12 mt-3 mb-3" id="myDiv">
            <h5 class="text-decoration-none text-dark fs-4 fw-bold text-center">
              <u class="text-warning"><i class="fa-solid fa-comments text-dark"></i><span class="text-dark">FeedBack & Reviews</span></u>
            </h5>

          </div>

          <div class="col-12 pb-0">
            <div class="row">
              <div class="col-lg-6 col-12">
                <h4 class="text-center pt-4">Product Rating:</h4>
                <div class="feedback-form">
                  <?php
                  $counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

                  $rate = Database::search("SELECT `rating_id`, COUNT(*) AS count FROM `feedback` WHERE `product_id` = '" . $id . "' GROUP BY `rating_id`");
                  while ($rdata = $rate->fetch_assoc()) {
                    $counts[$rdata["rating_id"]] = $rdata["count"];
                  }

                  $no = array_sum($counts);
                  $total = 0;
                  foreach ($counts as $rating => $count) {
                    $total += $rating * $count;
                  }

                  $ratingValue = $no > 0 ? round($total / $no) : 0;
                  ?>
                  <h4 class="fw-bold text-center text-secondary"><?php echo $ratingValue; ?>/5<span>(<?php echo $no; ?>)</span></h4>
                  <div class="rating">
                    <input type="radio" name="rating" id="star1" value="1" <?php echo ($ratingValue == 5) ? 'checked' : ''; ?> disabled><label for="star1" class="fas fa-star"></label>
                    <input type="radio" name="rating" id="star2" value="2" <?php echo ($ratingValue == 4) ? 'checked' : ''; ?> disabled><label for="star2" class="fas fa-star"></label>
                    <input type="radio" name="rating" id="star3" value="3" <?php echo ($ratingValue == 3) ? 'checked' : ''; ?> disabled><label for="star3" class="fas fa-star"></label>
                    <input type="radio" name="rating" id="star4" value="4" <?php echo ($ratingValue == 2) ? 'checked' : ''; ?> disabled><label for="star4" class="fas fa-star"></label>
                    <input type="radio" name="rating" id="star5" value="5" <?php echo ($ratingValue == 1) ? 'checked' : ''; ?> disabled><label for="star5" class="fas fa-star"></label>
                  </div>
                  <div class="rating-breakdown">
                    <?php foreach ($counts as $rating => $count) : ?>
                      <div class="rating-item">
                        <span class="star">&#9733;</span>
                        <p><?php echo $rating; ?> Star<?php echo ($count > 1) ? 's' : ''; ?>: (<?php echo $count; ?>)</p>
                        <div class="bar">
                          <div class="bar-fill" style="width: <?php echo ($no > 0) ? ($count / $no) * 100 : 0; ?>%;"></div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12 pt-4" id="reviews">
                <h4 class="text-center">Product Reviews:</h4>
                <div class="carousel slide mt-4 ms-lg-5">
                  <div class="carousel-inner ms-5">
                    <?php

                    $query = "SELECT * FROM `feedback` INNER JOIN `user` ON feedback.user_email=user.email WHERE `product_id` = '" . $id . "' ";
                    $pageno;

                    if (isset($_GET["page"])) {
                      $pageno = $_GET["page"];
                    } else {
                      $pageno = 1;
                    }
                    $r = Database::search($query);
                    $no = $r->num_rows;

                    if ($no > 0) {
                      $results_per_page = 2;
                      $number_of_pages = ceil($no / $results_per_page);

                      $page_results = ($pageno - 1) * $results_per_page;
                      $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
                      $selected_num = $selected_rs->num_rows;

                      for ($i = 0; $i < $selected_num; $i++) {

                        $data = $selected_rs->fetch_assoc();

                    ?>

                        <div class="card mt-2 ms-3" style="width: 29rem;">
                          <div class="card-body" id="testimonialCarousel" data-ride="carousel">
                            <h5 class="card-title text-secondary fs-1"><i class="fa-solid fa-quote-left"></i></h5>
                            <p class="card-text text-center"><?php echo $data["feedback"]; ?></p>
                            <div class="d-flex justify-content-center align-content-center">
                              <?php

                              for ($y = 0; $y < $data["rating_id"]; $y++) {
                              ?>
                                <i class="fa-solid fa-star text-warning"></i>
                                <?php
                              }
                              $b = 5 - intval($data["rating_id"]);
                                if ($b > 0) {
                                  for ($z = 0; $z < $b; $z++) {
                                ?>

                                    <i class="fa-solid fa-star text-secondary"></i></i>
                                  <?php
                                  }
                                }

                              ?>
                            </div>
                            <p class="justify-content-center align-content-center d-flex"><?php echo $data["fname"] . " " . $data["lname"] ?></p>
                          </div>
                        </div>

                    <?php
                      }
                    }

                    ?>
                    <nav aria-label="Page navigation example ms-5 ps-5">
                      <ul class="pagination">
                        <li class="page-item">
                          <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                  echo ("#");
                                                } else {
                                                  echo "?id=" . $id . "&page=" . ($pageno - 1) . "&#reviews";
                                                } ?>
                                                " aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <?php
                        for ($x = 1; $x <= $number_of_pages; $x++) {
                          if ($x == $pageno) {
                        ?>
                            <li class="page-item active">
                              <a class="page-link" href="<?php echo "?id=" . $id . "&page=" . ($x) . "&#reviews" ?>"><?php echo $x; ?></a>
                            </li>
                          <?php
                          } else {
                          ?>
                            <li class="page-item">
                              <a class="page-link" href="<?php echo "?id=" . $id . "&page=" . ($x) . "&#reviews" ?>"><?php echo $x; ?></a>
                            </li>
                        <?php
                          }
                        }
                        ?>
                        <li class="page-item">
                          <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                  echo ("#");
                                                } else {
                                                  echo "?id=" . $id . "&page=" . ($pageno + 1) . "&#reviews";
                                                } ?>
                                                " aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>


    </section>
    <div class="modal" tabindex="-1" id="modal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="col-12 justify-content-center align-content-center d-flex">
              <img src="assets/images/smile_icon.svg" class="justify-content-center" width="50%">
            </div><br>
            <h5 class="text-center">Please Log In First</h5>
          </div>
          <div class="modal-footer">
            <button onclick="logwish()" type="button" class="btn btn-wish">Login</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" tabindex="-1" id="addmodal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="col-12 justify-content-center align-content-center d-flex">
              <img src="assets/images/smile_icon.svg" class="justify-content-center" width="50%">
            </div><br>
            <h5 class="text-center">Please Complete Your Shipping Details First</h5>
          </div>
          <div class="modal-footer">
            <button onclick="addu()" type="button" class="btn btn-wish">Continue</button>
          </div>
        </div>
      </div>
    </div>


  </body>
  <script src="assets/js/script.js"></script>
  <script>
    function validateForm() {
      var size = document.getElementById("size").value;
      if (size == "0") {
        alert("Please select a size.");
        return false;
      }
      return true;
    }

    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="1popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
  </script>
  <?php
  include("footer.php");
  ?>

  </html>
<?php
} else {
  header("Location : index.php");
}

?>