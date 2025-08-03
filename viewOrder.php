<?php
include "adminheader.php";
include "connection.php";

if (!isset($_GET["id"])) {
?>
  <script>
    window.location = "index.php";
  </script>
<?php
} else {
  $oid = $_GET["id"];
?>
  <!-- Main Content -->
  <div class="main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
      <h1 class="h2">View Order</h1>
    </div>

    <?php
    $irs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id=product.id INNER JOIN `sizes` ON invoice.sizes_id=sizes.id INNER JOIN `colour` ON invoice.colour_color_id=colour.color_id INNER JOIN `user` ON invoice.user_email=user.email WHERE `order_id` = '" . $oid . "'");
    $adata = $irs->fetch_assoc();
    ?>
    <div class="row">
      <div class="col-12 col-lg-4 col-md-12">
        <?php

        $productIds = Database::search("SELECT DISTINCT `product_id` FROM `invoice` WHERE `order_id` = '" . $oid . "'");
        
        while ($pid = $productIds->fetch_assoc()) {
          $ig = Database::search("SELECT `img_path` FROM `product_img` WHERE `product_id` = '" . $pid['product_id'] . "' LIMIT 1");
          if ($idata = $ig->fetch_assoc()) {
        ?>
            <img src="<?php echo $idata["img_path"]; ?>" width="100%" alt="Product Image">
        <?php
          }
        }
        ?>
      </div>
      <div class="col-12 col-lg-8 col-md-12">
        <div class="row">
          <div class="col-12 col-lg-6">
            <h4>Order ID: <?php echo $oid; ?></h4>
            <p>Customer Name: <?php echo $adata["fname"] . " " . $adata["lname"]; ?></p>
            <p>Customer Email: <?php echo $adata["user_email"]; ?></p>
            <p>Customer Phone: <?php echo $adata["mobile_no"]; ?></p>
            <p>Ordered Date: <?php echo $adata["date"]; ?></p>
            <?php
            $ars = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id INNER JOIN `province` ON district.province_province_id=province.province_id WHERE `user_email` = '" . $adata["user_email"] . "'");
            $address = $ars->fetch_assoc();
            ?>
            <p>Customer Province: <?php echo $address["province"]; ?></p>
            <p>Customer District: <?php echo $address["district"]; ?></p>
            <p>Customer City: <?php echo $address["city"]; ?></p>
            <p>Customer Address: <?php echo $address["line1"]; ?></p>
            <p>Customer Postal Code: <?php echo $address["postal_code"]; ?></p>
          </div>
          <div class="col-12 col-lg-6">
            <?php

            mysqli_data_seek($irs, 0);
            while ($data = $irs->fetch_assoc()) {
            ?>
              <p>Product Name: <?php echo $data["title"]; ?></p>
              <p>Product Price: Rs. <?php echo $data["price"]; ?>.00</p>
              <p>Product Size: <?php echo $data["size"]; ?></p>
              <p>Product Colour: <?php echo $data["color_name"]; ?></p>
              <p>Product Quantity: <?php echo $data["quantity"]; ?></p>
              <hr>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
