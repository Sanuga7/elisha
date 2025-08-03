<?php 

 require "connection.php";
 require "SMTP.php";
 require "PHPMailer.php";
 require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

 session_start();

 if (isset($_POST["e"]) && isset($_POST["p"])) {

    $email = $_POST["e"];
    $password = $_POST["p"];

    if (empty($_POST["e"])) {
        echo "email is required";
    }else if (empty($_POST["p"])) {
        echo "password is required";
    }else if (strlen($email ) > 100) {
        echo "Email must less than 100 characters";
    }else if (strlen($password ) > 20) {
        echo "password must less than 20 characters";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid Email Type";
    }else {
        
       $user_check = Database::search("SELECT * FROM `admin` WHERE `email` = '".$email."' AND `password` = '".$password."' ");
       $user_num = $user_check->num_rows;

       if ($user_num == 1) {

        $subject = "Admin Log Elisha Creation";
        $code = uniqid();
        $con = new mysqli("localhost","root","2006@Sanuga","elisha","3306");
        $query = "UPDATE `admin` SET `vcode` = '".$code."' WHERE `email` = '".$email."' AND `password` = '".$password."' ";
        $code_update = $con->query($query);
        $content = "Admin Login  : <br>" .$code. " Verification Code";
          
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sanugakusalwin578@gmail.com';
        $mail->Password = 'fkyt jtwi ccda cfab ';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('sanugakusalwin578@gmail.com', 'Elisha Creation');
        $mail->addReplyTo('sanugakusalwin578@gmail.com', 'Elisha Creation');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $bodyContent = $content;
        $mail->Body    = $bodyContent;
 
        if (!$mail->send()) {
         echo ("Something Went Wrong Refresh and Try again");
        } else {
         echo ("success");
     }
 
    }else {
        echo "invalid user";
       }

    }

 }else {
    echo "Please Enter Email And Password";
 }