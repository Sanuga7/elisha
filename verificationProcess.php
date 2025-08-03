<?php

include("connection.php");
session_start();

if (isset($_POST["c"])) {

  $v = $_POST["c"];

  $admin_rs = Database::search("SELECT * FROM `admin` WHERE `vcode`='" . $v . "' ");
  $admin_num = $admin_rs->num_rows;

  if ($admin_num == 1) {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("y-m-d H:i:s");

    Database::iud("UPDATE `admin` SET `logged_time`= '".$date."' WHERE `vcode` = '".$v."'");

    $admin_data = $admin_rs->fetch_assoc();
    $_SESSION["au"] = $admin_data;
    echo ("Success");

  } else {
    echo "Invalid Verification code";
  }
} else {
  echo "Enter Your Code here";
}
