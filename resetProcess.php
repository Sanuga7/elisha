<?php

 include "connection.php";

 $email = $_POST["e"];
 $newpw = $_POST["n"];
 $retypepw = $_POST["r"];
 $vcode = $_POST["v"];

 if(empty($newpw)){
   echo("Please enter your new Password");
 }else if(strlen($newpw) <5 || strlen($newpw) > 20){
   echo("Length of your new Password must need to between 5 and 20");
 }else if(empty($retypepw)){
    echo("Please enter your retype Password");
  }else if(strlen($retypepw) <5 || strlen($retypepw) > 20){
    echo("Length of your retype Password must need to between 5 and 20");
  }else if(empty($vcode)){
    echo("Please enter your Verification code");
  }else if(strlen($vcode) > 50){
    echo("Your verification code is invalid");
  }else if($newpw != $retypepw){
    echo("Password that you entered doesn't match");
  }else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `verification_code` = '".$vcode."' ");
    $num = $rs->num_rows;

    if($num == 1){
        
        $hashedPwd = password_hash($retypepw, PASSWORD_DEFAULT);
        Database::iud("UPDATE `user` SET `password` = '".$hashedPwd."' WHERE `email` = '".$email."' ");
        echo("success");

    }else {
        echo("Invalid Email or verification code");
    }

 }