<?php
session_start();
include "connection.php";

if(isset($_SESSION["u"])){
    if(isset($_POST["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_POST["id"];
        $qty = $_POST["qty"];
        $size = $_POST["size"];


        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' AND 
        `product_id`='".$pid."'");
        $cart_num = $cart_rs->num_rows;

        if($cart_num == 1){

            $cart_data = $cart_rs->fetch_assoc();
            $cart_id = $cart_data["id"];

            Database::iud("DELETE FROM `cart` WHERE `id`='".$cart_id."'");
            echo ("success");

        }else{
        
            
            $y = Database::search("SELECT * FROM `product` WHERE `id` = '".$pid."'");
            $d = $y->fetch_assoc();
            $d_qty = $d["qty"];
            $color = $_POST["c"];

            if ($qty > $d_qty) {
               echo "something went wrong";
            }else {
                
            if ($size != 0) {

            if(isset($_POST["c"])){       
                Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`c_qty`,`sizes_id`,`colour_color_id`) VALUES ('".$pid."','".$email."','".$qty."','".$size."','".$color."')");
                echo ("success");
            }else{
                echo ("select a colour first");
              } 
                                
            }else {
                
                echo "please select a size first";

            }
            }
        
            
        }

    }else{
        echo ("Something went wrong. Please try again later.");
    }
}else{
    echo ("Please Login First.");
}
