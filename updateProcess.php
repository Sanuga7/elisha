<?php
session_start();
include "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$city = $_POST["c"];
$district = $_POST["d"];
$province = $_POST["p"];
$line1 = $_POST["l1"];
$pcode = $_POST["pc"];

$email = $_SESSION["u"]["email"];

if (strlen($fname) > 20) {
    echo "First Name Must Be Less Than 20 Characters";
} else if (strlen($lname) > 20) {
    echo "Last Name Must Be Less Than 20 Characters";
} else if (empty($mobile)) {
    echo "Mobile Number Is Required";
} else if (strlen($mobile) != 10) {
    echo "Mobile Number Must Be 10 Digits";
} else if (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo "Invalid Mobile Number";
} else if (empty($city)) {
    echo "City Is Required";
} else if (strlen($city) > 40) {
    echo "City Name Must Be Less Than 40 Characters";
} else if (empty($line1)) {
    echo "Line 1 Is Required";
} else if (strlen($line1) > 120) {
    echo "Line 1 Must Be Less Than 120 Characters";
} else if (empty($pcode)) {
    echo "Postal Code Is Required";
} else if (strlen($pcode) > 10) {
    echo "Postal Code Must Be Less Than 10 Characters";
} else {
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");

    if ($user_rs->num_rows == 1) {
        Database::iud("UPDATE `user` SET `fname`='" . $fname . "', `lname`='" . $lname . "', `mobile_no`='" . $mobile . "' WHERE `email`='" . $email . "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");
        $city_rs = Database::search("SELECT * FROM `city` WHERE `city`='" . $city . "'");

        if ($city_rs->num_rows == 1) {
            $city_data = $city_rs->fetch_assoc();
            $cid = $city_data["city_id"];
        } else {
            Database::iud("INSERT INTO `city` (`city`, `district_district_id`) VALUES ('" . $city . "', '" . $district . "')");
            $city_rs = Database::search("SELECT * FROM `city` WHERE `city`='" . $city . "'");
            if ($city_rs->num_rows == 1) {
                $city_data = $city_rs->fetch_assoc();
                $cid = $city_data["city_id"];
            } else {
                echo "Error: City could not be found or created.";
                exit();
            }
        }

        if ($address_rs->num_rows == 1) {
            Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "', `postal_code`='" . $pcode . "', `city_city_id`='" . $cid . "' WHERE `user_email`='" . $email . "'");
            echo "success";
        } else {
            Database::iud("INSERT INTO `user_has_address` (`line1`, `postal_code`, `city_city_id`, `user_email`) VALUES ('" . $line1 . "', '" . $pcode . "', '" . $cid . "', '" . $email . "')");
            echo "success";
        }
    } else {
        echo "User not found.";
    }
}
