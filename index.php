<?php

include "header.php";
include "connection.php";


?>
	
<style>
    .line {
        border-style: solid;
  border-color: #f76838; 
}
.c1:hover {
    transform: scale(1.05); 
    
}

.carousel-inner .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }
/*.c-img:hover {
    transform: scale(1.05);
}
*/
.badge-new {
      background-color: green;
      color: white;
    }
    .wishlist-icon {
      color: #f76838;
    }
    .btn-buy-now {
      background-color: #f76838;
      color: white;
    }
    .btn-buy-now:hover {
      background-color: #e65a30;
    }
</style>
<!-- Carousel Start -->
<div class="container-fluid d-none d-xl-block carousel-header px-0" id="myDiv" onload="myFunction();">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="assets/images/img(3).png" class="img-fluid" alt="Image">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-uppercase mb-3" style="color:#f76838;">Elisha Creation</h4>
                        <h1 class="display-1 text-capitalize text-light mb-3">Buy Anything You Need</h1>
                        <p class="mx-md-5 fs-4 px-4 mb-5 text-light slider">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4 whover fw-bold" style="color:#f76838;" href="login.php">Login</a>
                            <a class="btn btn-primary-outline-0 rounded-pill py-3 px-5 bhover text-light fw-bold" style="background-color:#f76838;" href="product.php">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/img(2).png" class="img-thumbnail" alt="Image">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-uppercase mb-3" style="letter-spacing: 3px; color:#f76838;">Elisha Creation</h4>
                        <h1 class="display-1 text-capitalize text-light mb-3">Experiance The Daily Deals</h1>
                        <p class="mx-md-5 fs-4 px-5 mb-5 text-light">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4 fw-bold" style="color:#f76838;" href="#wd">Explore</a>
                            <a class="btn btn-primary-outline-0 rounded-pill py-3 px-5 text-light fw-bold" style="background-color:#f76838;" href="contact.php">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/img(1).png" class="img-fluid" alt="Image">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-uppercase mb-3" style="letter-spacing: 3px; color:#f76838;">Elisha Creation</h4>
                        <h1 class="display-1 text-capitalize text-light">5% Discount on First Purchase</h1>
                        <p class="mx-md-5 fs-4 px-5 mb-5 text-light">Lorem rebum magna dolore amet lorem eirmod magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4 fw-bold" style="color:#f76838;" href="about.php">Aboout Us</a>
                            <a class="btn btn-primary-outline-0 rounded-pill py-3 px-5 text-light fw-bold" style="background-color:#f76838;" href="product.php">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<h1 class="d-none d-bock-lg d-bock-md d-bock-sm text-primary">Wecome to Eisha</h1>
<!-- Carousel End -->
<?php
$category_rs2 = Database::search("SELECT * FROM `category`");
$category_num2 = $category_rs2->num_rows;

for ($y = 0; $y < $category_num2; $y++) {
    $category_data2 = $category_rs2->fetch_assoc();
?>
    <!-- Category Name -->

    <div class="col-12 mt-3 mb-3" id="myDiv">
        <a href="product.php?category=<?php echo $category_data2["cat_id"]; ?>" class="text-decoration-none text-dark fs-5 fw-bold <?php echo $category_data2["category_name"] ?>" id="<?php echo $category_data2["category_name"] ?>">
            <?php echo $category_data2["category_name"]; ?>
        </a> &nbsp;&nbsp;
        <a class="text-decoration-none text-dark fs-5"><i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <!-- Category Name -->
    <!-- products -->

    <div class="col-12 mb-3">
        <div class="row border">

            <div class="col-12">
                <div class="row justify-content-center gap-3">

                    <?php

                    $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $category_data2["cat_id"] . "' 
                                    AND `status_id`='1' ORDER BY `added_time` DESC LIMIT 5 OFFSET 0");

                    $product_num = $product_rs->num_rows;

                    for ($z = 0; $z < $product_num; $z++) {
                        $product_data = $product_rs->fetch_assoc();
                    ?>

                        <div class="card col-8 col-xs-7 col-sm-4 col-md-3 col-lg-2 mt-2 rounded-4 my-3 mb-2 c1" style="width: 18rem;">
                            <a class="text-decoration-none text-dark" href="productView.php?id=<?php echo $product_data["id"];  ?>">

                            <?php
                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                            $img_data = $img_rs->fetch_assoc();
                            ?>
                          
                            <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top rounded-4 mt-2 c-img" style="height: 180px;" />
                            <div class="card-body ms-0 m-0 text-center">
                                <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                                
                                <span class="card-text text-success">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                <?php
                                if ($product_data["qty"] > 0) {

                                ?>
                                    <span class="card-text text-success fw-bold">In Stock</span><br /><br>
                                    <!--<span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />-->
                                    <a href='<?php echo "productView.php?id=" . ($product_data["id"]); ?>' class="col-12 btn text-light buy" style="background-color: #f76838;">Buy Now</a>
                                    <button class="col-12 btn btn-dark mt-2">
                                        <a class="text-light" href='<?php echo "productView.php?id=" . ($product_data["id"]); ?>'><i class="fa-solid fa-cart-shopping"></i></a>
                                    </button>
                                <?php

                                } else {
                                ?>
                                    <span class="card-text text-danger fw-bold">Out Of Stock</span><br />
                                    <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
                                    <a href='#' class="col-12 btn btn-success disabled buy">Buy Now</a>
                                    <button class="col-12 btn btn-dark mt-2 disabled">
                                        <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                    </button>
                                <?php
                                }
                                ?>
                            </div>
                            </a>
                        </div>

                    <?php
                    }

                    ?>



                </div>
            </div>

        </div>
    </div>
    
    <!-- products -->
<?php
}

?>

<?php

include "footer.php";

?>
</body>

</html>