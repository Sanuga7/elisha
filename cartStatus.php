<?php 
session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.product_id=product.id WHERE `user_email` = '".$email."'");
    $num = $rs->num_rows;

    if ($num == 0) {
        echo "end";
        exit();
    } else {
        $deleted = false;
        while ($data = $rs->fetch_assoc()) {
            if ($data["status_id"] == 2) {
                Database::iud("DELETE FROM `cart` WHERE `product_id` = '".$data["product_id"]."' AND `user_email` = '".$email."'");
                $deleted = true;
            }
        }
        if ($deleted) {
            echo "end"; 
        } else {
            echo "continue"; 
        }
        exit();
    }
}
?>
