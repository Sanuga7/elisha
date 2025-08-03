<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"]) && isset($_SESSION["cb"])) {
    $cart_details = $_SESSION["cb"];
    $order_id = $cart_details[0]["id"];
    $amount = $cart_details[0]["amount"] + $cart_details[1]["amount"]; 
    $email = $_SESSION["u"]["email"];


    foreach ($cart_details as $item) {
        $pid = $item["pid"];
        $qty = $item["qty"]; 
        $color = $item["color"]; 
        $size = $item["size"]; 

        
        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();
        $current_qty = intval($product_data["qty"]);
        $new_qty = $current_qty - $qty; 
        Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $pid . "'");

        
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
        
        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`quantity`,`product_id`,`user_email`,`status_id`,`sizes_id`,`colour_color_id`)
        VALUES ('" . $order_id . "','" . $date . "','" . $amount . "','" . $qty . "','" . $pid . "','" . $email . "','3','" . $size . "','" . $color . "')");

        Database::iud("DELETE FROM `cart` WHERE `user_email` = '" . $email . "'");

        ?>
        <script>
            window.location = "invoice.php?id=<?php echo $order_id; ?>";
        </script>
        <?php

    }
}
