<?php

 include "connection.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

 if(isset($_POST["e"])){

    $email = $_POST["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' ");
    $d = $rs->num_rows;

    if($d == 1){

      $code = uniqid();
      Database::iud("UPDATE `user` SET `verification_code` = '".$code."' WHERE `email` = '".$email."' ");

      $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sanugakusalwin578@gmail.com';
        $mail->Password = 'fkyt jtwi ccda cfab ';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('sanugakusalwin578@gmail.com', 'Reset Password');
        $mail->addReplyTo('sanugakusalwin578@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Elisha Creation Forgot password Verification Code';
        $bodyContent = '<h1 style="color:green;">Your Verification Code is '.$code.'</h1>';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo 'Verification code sending failed.';
        }else{
            echo 'success';
        }

    }else {
        echo("Invalid Email Address");
    }

 }else {
    echo("Please Enter Your Email Address");
 }