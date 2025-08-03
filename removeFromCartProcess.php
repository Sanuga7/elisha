<?php 

 include "connection.php";
 session_start();

 if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {
        
        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        Database::iud("DELETE FROM `cart` WHERE `product_id` = '".$pid."' AND `user_email` = '".$email."'");
        echo ("success");

    }else {
        echo "Something Went Wrong";
    }
 }else {
    echo "nuser";
 }