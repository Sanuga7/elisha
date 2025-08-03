<?php
include("header.php");
include("connection.php");
if (isset($_SESSION["u"])) {
   $email = $_SESSION["u"]["email"];

?>
   <?php
   $check_rs = Database::search("SELECT * FROM `wishlist` WHERE `user_email` = '" . $email . "' ");
   $check_n = $check_rs->num_rows;
   if ($check_n != 0) {
      $product_rs = Database::search("SELECT * FROM `wishlist` INNER JOIN `product` ON wishlist.product_id=product.id WHERE `user_email`='" . $email . "' 
                       AND product.`status_id`='1' ORDER BY `added_time` DESC");

      $product_num = $product_rs->num_rows;
   ?>
      <div class="col-12" id="basicSearchResult">
         <h5 class="mt-3">Whishlist Products</h5>
         <div class="col-12 mb-3">
            <div class="row border border-warning">
            </div>
         </div>
         <div class="row justify-content-center gap-2">

            <?php

            $query = "SELECT * FROM `wishlist` INNER JOIN `product` ON wishlist.product_id=product.id WHERE `user_email`='" . $email . "' 
                       AND product.`status_id`='1' ORDER BY `added_time` DESC";
            $pageno;

            if (isset($_GET["page"])) {
               $pageno = $_GET["page"];
            } else {
               $pageno = 1;
            }

            $product_rs = Database::search($query);

            $product_num = $product_rs->num_rows;
            $results_per_page = 15;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
            $selected_num = $selected_rs->num_rows;

            for ($z = 0; $z < $selected_num; $z++) {
               $selected_data = $selected_rs->fetch_assoc();
            ?>

               <div class="card rounded-4 col-8 col-xs-7 col-sm-4 col-md-3 col-lg-2 mt-2 mb-2" style="width: 18rem;">
                  <a class="text-decoration-none text-dark" href="productView.php?id=<?php echo $selected_data["id"];  ?>">

                     <?php
                     $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                     $img_data = $img_rs->fetch_assoc();
                     ?>

                     <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top rounded-4 mt-2" style="height: 180px;" />
                     <div class="card-body ms-0 m-0 text-center">
                        <h5 class="card-title fw-bold fs-6 stretched-link"><?php echo $selected_data["title"]; ?></h5>
                        <span class="card-text text-success stretched-link">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />

                        <?php
                        if ($selected_data["qty"] > 0) {

                        ?>
                           <span class="card-text text-success fw-bold">In Stock</span><br /><br>
                           <!--<span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />-->
                           <a href='<?php echo "productView.php?id=" . ($selected_data["id"]); ?>' class="col-12 btn text-light hover stretched-link" style="background-color: #f76838;">Buy Now</a>
                           <button class="col-12 btn btn-dark mt-2">
                              <i class="fa-solid fa-cart-shopping"></i>
                           </button>
                        <?php

                        } else {
                        ?>
                           <span class="card-text text-danger fw-bold">In Stock</span><br /><br>
                           <!--<span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />-->
                           <a href='#' class="col-12 btn btn-success disabled">Buy Now</a>
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
         <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
            <nav aria-label="Page navigation example">
               <ul class="pagination pagination-lg justify-content-center">
                  <li class="page-item">
                     <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                   echo ("#");
                                                } else {
                                                   echo "?page=" . ($pageno - 1);
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
                           <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                        </li>
                     <?php
                     } else {
                     ?>
                        <li class="page-item">
                           <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
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
                                                   echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
      </div>
      </div>
   <?php
   } else {
   ?>
      <div class="container-fluid">
         <div class="row">
            <div class="col-11 mt-4 ms-2">
               <span><a href="index.php" class="home">Home</a> / <span>Wishlist</span></span>
               <div class="row">
                  <div class="col-12 align-content-center justify-content-center d-flex mt-5 pt-5">
                     <img src="assets/images/shopping_icon.svg" width="20%">
                  </div>
                  <div class="col-12 align-content-center justify-content-center d-flex mt-4">
                     <h6 onclick="shop();">Start Shopping Today</h6>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php
   }
   ?>

   <script>
      function shop() {
         window.location = "index.php?start_shopping"
      }
   </script>
<?php
   include("footer.php");
} else {
?><script>
      window.location = "login.php";
   </script><?php
         }
