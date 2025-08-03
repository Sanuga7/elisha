<?php
include "header.php";
include "connection.php";
 
unset($_SESSION["in"]);
unset($_SESSION["cb"]);

if (isset($_SESSION["u"])) {
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $user_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `user` ON invoice.user_email=user.email INNER JOIN `user_has_address` ON user.email=user_has_address.user_email WHERE `order_id` = '" . $id . "'");
    $user_data = $user_rs->fetch_assoc();
    ?>
    <div id="body">
    <style>
      body {
        font-size: 16px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      table tr td {
        padding: 0;
      }

      table tr td:last-child {
        text-align: right;
      }

      .bold {
        font-weight: bold;
      }

      .right {
        text-align: right;
      }

      .large {
        font-size: 1.75em;
      }

      .total {
        font-weight: bold;
        color: #fb7578;
      }

      .logo-container {
        margin: 20px 0 70px 0;
      }

      .invoice-info-container {
        font-size: 0.875em;
      }

      .invoice-info-container td {
        padding: 4px 0;
      }

      .client-name {
        font-size: 1.5em;
        vertical-align: top;
      }

      .line-items-container {
        margin: 70px 0;
        font-size: 0.875em;
      }

      .line-items-container th {
        text-align: left;
        color: #999;
        border-bottom: 2px solid #ddd;
        padding: 10px 0 15px 0;
        font-size: 0.75em;
        text-transform: uppercase;
      }

      .line-items-container th:last-child {
        text-align: right;
      }

      .line-items-container td {
        padding: 15px 0;
      }

      .line-items-container tbody tr:first-child td {
        padding-top: 25px;
      }

      .line-items-container.has-bottom-border tbody tr:last-child td {
        padding-bottom: 25px;
        border-bottom: 2px solid #ddd;
      }

      .line-items-container.has-bottom-border {
        margin-bottom: 0;
      }

      .line-items-container th.heading-quantity {
        width: 50px;
      }

      .line-items-container th.heading-price {
        text-align: right;
        width: 100px;
      }

      .line-items-container th.heading-subtotal {
        width: 100px;
      }

      .payment-info {
        width: 38%;
        font-size: 0.75em;
        line-height: 1.5;
      }

      .footer {
        margin-top: 100px;
      }

      .footer-thanks {
        font-size: 1.125em;
      }

      .footer-thanks img {
        display: inline-block;
        position: relative;
        top: 1px;
        width: 16px;
        margin-right: 4px;
      }

      .footer-info {
        float: right;
        margin-top: 5px;
        font-size: 0.75em;
        color: #ccc;
      }

      .footer-info span {
        padding: 0 5px;
        color: black;
      }

      .footer-info span:last-child {
        padding-right: 0;
      }

      .page-container {
        display: none;
      }
    </style>
    <div class="page-container ms-4 me-4 " id="page">
      Page
      <span class="page"></span>
      of
      <span class="pages"></span>
    </div>

    <div class="col-12 mt-5">
      <button class="btn btn-wish text-light" style="background-color: #f76838;" type="submit" id="btn" onclick="printInvoice();">Print PDF</button>
    </div>

    <table class="invoice-info-container">
      <tr>
        <td rowspan="2" class="client-name">
          <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?>
        </td>
        <td>
          <?php echo $user_data["line1"]; ?>
        </td>
      </tr>
      <tr>
        <td>
          <?php
          $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id` = '" . $user_data["city_city_id"] . "'");
          $city_data = $city_rs->fetch_assoc();
          $district_rs = Database::search("SELECT * FROM `district` INNER JOIN `province` ON district.province_province_id=province.province_id WHERE `district_id` = '" . $city_data["district_district_id"] . "'");
          $district_data = $district_rs->fetch_assoc();
          ?>
          <?php echo $city_data["city"] . ", " . $district_data["district"] ?>
        </td>
      </tr>
      <tr>
        <td>
          Invoice Date: <strong><?php echo $user_data["date"]; ?></strong>
        </td>
        <td>
          <?php echo $district_data["province"] . ", Sri Lanka" ?>
        </td>
      </tr>
      <tr>
        <td>
          Invoice No: <strong><?php echo $user_data["order_id"]; ?></strong>
        </td>
        <td>
          <?php echo $user_data["email"]; ?>
        </td>
      </tr>
    </table>


    <table class="line-items-container">
      <thead>
        <tr>
          <th class="heading-quantity">Qty</th>
          <th class="heading-description">Description</th>
          <th class="heading-price">Price</th>
          <th class="heading-subtotal">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $product_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id=product.id WHERE `order_id` = '" . $id . "'");
        $product_num = $product_rs->num_rows;

        for ($x = 0; $x < $product_num; $x++) {
          $product_data = $product_rs->fetch_assoc();
          $clr_rs = Database::search("SELECT * FROM `colour` WHERE `color_id`= '".$product_data["colour_color_id"]."'");
          $clr_data = $clr_rs->fetch_assoc();
          $color = $clr_data["color_name"];
        ?>
          <tr>
            <td><?php echo $product_data["quantity"]; ?></td>
            <td><?php echo $product_data["title"]."-".$color; ?></td>
            <td class="right">Rs.<?php echo $product_data["price"]; ?>.00</td>
            <td class="bold">Rs.<?php echo $product_data["price"] + $product_data["delivery_fee"]; ?>.00</td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>


    <table class="line-items-container has-bottom-border">
      <thead>
        <tr>
          <th>Payment Info</th>
          <th>Due By</th>
          <th>Total Due</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="payment-info">
            <div>
              order No: <strong><?php echo $user_data["order_id"]; ?></strong>
            </div>
            <div>
              order No: <strong><?php echo $user_data["order_id"]; ?></strong>
            </div>
          </td>
          <td class="large"><?php echo $user_data["date"]; ?></td>
          <td class="large total">Rs.<?php echo $product_data["total"]; ?>.00</td>
        </tr>
      </tbody>
    </table>

    <div class="footer">
      <div class="footer-info">
        <span>sanugakusalwin@icloud.com</span> |
        <span>elishacreation.com</span>
      </div>
      <div class="footer-thanks">
        <img src="https://github.com/anvilco/html-pdf-invoice-template/raw/main/img/heart.png" alt="heart">
        <span>Thank you!</span>
      </div>
    </div>
    </div>
    <script src="assets/js/script.js"></script>
  <?php
  } else {
  ?>
    <script>
      window.location = "index.php";
    </script>
  <?php
  }
} else {
  ?>
  <script>
    window.location = "index.php";
  </script>
<?php
}
?>