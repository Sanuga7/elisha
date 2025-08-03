<?php

include "connection.php";
session_start();

if (!isset($_POST["f"]) || !isset($_POST["r"]) || !isset($_POST["p"]) || !isset($_SESSION["u"])) {
    echo "Missing parameters or session data";
    exit();
} else {
    $feedback = $_POST["f"];
    $rate = $_POST["r"];
    $pid = $_POST["p"];
    $user_email = $_SESSION["u"]["email"];

    $num = Database::search("SELECT * FROM `feedback` WHERE `user_email` = '" . $user_email . "' AND `product_id` = '" . $pid . "'")->num_rows;
    if ($num > 0) {
        echo "You have already submitted feedback for this product";
    } else {



        $sql = "INSERT INTO `feedback` (`feedback`, `rating_id`, `product_id`, `user_email`) VALUES ('$feedback', '$rate', '$pid', '$user_email')";

        try {
            Database::iud($sql);
            echo "success";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            error_log("Database error: " . $e->getMessage());
        }
    }
}
