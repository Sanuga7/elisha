<?php 
  
  session_start();
  include "connection.php";

  if (isset($_SESSION["au"]) || isset($_GET["email"])) {

    $email = $_GET["email"];

    Database::iud("UPDATE `user` SET `status_id` = '1' WHERE `email` = '".$email."' ");
    echo "success";

  }else {
    echo "Something Went Wrong";
  }