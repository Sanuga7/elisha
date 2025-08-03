<?php

include "connection.php";
session_start();

$email = $_POST["e"];
$pwd = $_POST["p"];
$rememberme = $_POST["r"];

if (empty($email)) {
  echo ("Please enter an Email address");
} else if (strlen($email) > 100) {
  echo ("Email must be less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo ("Invalid Email Address");
} else if (empty($pwd)) {
  echo ("Please Enter Your Password");
} else if (strlen($pwd) < 5 || strlen($pwd) > 20) {
  echo ("Password must be between 5 and 20 characters");
} else {

  $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' ");
  $n = $rs->num_rows;

  if ($n == 1) {

    $d = $rs->fetch_assoc();
    $hashedPwd = $d['password'];

    if (password_verify($pwd, $hashedPwd)) {

      $status = Database::search("SELECT `status_id` FROM `user` INNER JOIN `status` ON `user`.status_id = `status`.id WHERE `status`.`status` = 'Inactive' AND `user`.email = '" . $email . "'");
      $fetch = $status->num_rows;

      if ($fetch == 0) {
        echo ("success");
        $_SESSION["u"] = $d;

        if ($rememberme == "true") {
          setcookie("email", $email, time() + (60 * 60 * 24 * 365)); // 1 year
          setcookie("password", $pwd, time() + (60 * 60 * 24 * 365)); // 1 year
        } else {
          setcookie("email", "", -1);
          setcookie("password", "", -1);
        }

      } else {
        echo ("Your account is inactive. Please contact the administrator to activate it.");
      }

    } else {
      echo ("Invalid Username or Password");
    }

  } else {
    echo ("Invalid Username or Password");
  }
}
?>
