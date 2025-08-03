<?php
include "header.php";
include "connection.php";

if (!isset($_GET["id"]) || !isset($_GET["p"])) {
?>
  <script>
    window.location = "index.php";
  </script>
<?php
} else {
  $oid = $_GET["id"];
  $p = $_GET["p"];
?>
  <?php
  $udata = $_SESSION["u"];
  ?>
  <div class="row mt-lg-5 mt-2 ms-lg-2">
    <div class="col-12 col-lg-4 col-md-12">
      <?php

$irs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id=product.id WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' AND `order_id` = '" . $oid . "' AND `product_id` = '" . $p . "'");
$adata = $irs->fetch_assoc();


      $ig = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id` = '" . $p . "' LIMIT 1");
      $idata = $ig->fetch_assoc();
      ?>
      <img src="<?php echo $idata["img_path"]; ?>" width="100%" alt="Product Image">
    </div>
    <div class="col-12 col-lg-8 col-md-12">
      <div class="row">
        <div class="col-12 col-lg-6">
          <h4>Order ID: <?php echo $oid; ?></h4>
          <p class="text-dark">Customer Name: <?php echo $udata["fname"] . " " . $udata["lname"]; ?></p>
          <p class="text-dark">Customer Email: <?php echo $udata["email"]; ?></p>
          <p class="text-dark">Customer Phone: <?php echo $udata["mobile_no"]; ?></p>
          <p class="text-dark">Ordered Date: <?php echo $adata["date"]; ?></p>
          <?php
          $ars = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id INNER JOIN `province` ON district.province_province_id=province.province_id WHERE `user_email` = '" . $adata["user_email"] . "'");
          $address = $ars->fetch_assoc();
          ?>
          <p class="text-dark">Customer Province: <?php echo $address["province"]; ?></p>
          <p class="text-dark">Customer District: <?php echo $address["district"]; ?></p>
          <p class="text-dark">Customer City: <?php echo $address["city"]; ?></p>
          <p class="text-dark">Customer Address: <?php echo $address["line1"]; ?></p>
          <p class="text-dark">Customer Postal Code: <?php echo $address["postal_code"]; ?></p>
        </div>
        <div class="col-12 col-lg-6">
            <p class="text-dark">Product Name: <?php echo $adata["title"]; ?></p>
            <p class="text-dark">Product Price: Rs. <?php echo $adata["price"]; ?>.00</p>
            <?php
              $sid = $adata["sizes_id"];
              $s = Database::search("SELECT * FROM `sizes` WHERE `id` = '".$sid."'");
              $sdata = $s->fetch_assoc();
            ?>
            <p class="text-dark">Product Size: <?php echo $sdata["size"]; ?></p>
            <?php
              $cid = $adata["colour_color_id"];
              $c = Database::search("SELECT * FROM `colour` WHERE `color_id` = '".$cid."'");
              $cdata = $c->fetch_assoc();
            ?>
            <p class="text-dark">Product Colour: <?php echo $cdata["color_name"]; ?></p>
            <p class="text-dark">Product Quantity: <?php echo $adata["quantity"]; ?></p>
            <hr>
        </div>
      </div>
    </div>
  </div>
<?php
}

include "footer.php";
?>