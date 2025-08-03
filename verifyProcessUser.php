<?php 

include "connection.php";

$code = $_POST["c"];

if(empty($code)){
    echo("Please Enter Your Verification code");
} else if(strlen($code) > 50){
    echo("Length of your Verification code must be less than 50 characters");
} else {

    $dcode = Database::search("SELECT * FROM `user` WHERE `verification_code` = '".$code."'");
    $f = $dcode->num_rows;
    
    if($f == 1){
        $active = Database::iud("UPDATE `user` SET `status_id` = '1' WHERE `verification_code` = '".$code."'");
        if($active == true){
            echo("Success");
        } else {
            echo("Error updating status");
        }
    } else {
        echo("Invalid verification code");
    }
}
?>