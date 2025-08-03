<?php
session_start();
include "connection.php";

if (!isset($_SESSION["u"]) && !isset($_SESSION["in"])) {

    ?>
    <script>
        window.location = "index.php";
     </script>
     <?php

}else {
    
    $order_id = $_SESSION["in"]["id"];
    $pid = $_SESSION["in"]["pid"];
    $mail = $_SESSION["in"]["umail"];
    $amount = $_SESSION["in"]["amount"];
    $qty = $_SESSION["in"]["qty"];
    $size = $_SESSION["in"]["size"]; 
    $color = $_SESSION["in"]["color"];

        $product_rs=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
        $product_data = $product_rs->fetch_assoc();

        $current_qty = intval($product_data["qty"]);
        $new_qty = $current_qty - $qty; // Update product quantity
        Database::iud("UPDATE `product` SET `qty`='".$new_qty."' WHERE `id`='".$pid."'");

        // Get current datetime
        $d = new DateTime();
        $tz = new DateTimeZone(" Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        // Insert into invoice table
        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`quantity`,`product_id`,`user_email`,`status_id`,`sizes_id`,`colour_color_id`)
        VALUES ('" . $order_id . "','" . $date . "','" . $amount . "','" . $qty . "','" . $pid . "','" . $mail . "','3','".$size."','".$color."')");

    ?>
     <script>
        window.location = "invoice.php?id=<?php echo $order_id; ?>";
     </script>
    <?php
}
