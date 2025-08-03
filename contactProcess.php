<?php 

 include("connection.php");
 require "SMTP.php";
 require "PHPMailer.php";
 require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
 session_start();

  if (empty($_POST["f"]) || empty($_POST["l"])) {
    echo "name is required";
  }else if (empty($_POST["e"])) {
    echo "email is required";
  }else if (empty($_POST["m"])) {
    echo "message is required";
  }else {
    
    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $email = $_POST["e"];
    $msg = $_POST["m"];
    $name = $fname." ".$lname;
        
       Database::iud("INSERT INTO `chat` (`name`,`message`,`admin_email`,`user_email`) VALUES('".$name."','".$msg."','sanugakusalwin@icloud.com','".$email."');");
       
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sanugakusalwin578@gmail.com';
        $mail->Password = 'wbhk bbyz donb rnwe';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('sanugakusalwin578@gmail.com', 'Elisha Creation');
        $mail->addReplyTo('sanugakusalwin578@gmail.com', 'Elisha Creation');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Message Sent';
        $bodyContent = 'we received your mesage and we will response to you as soon as possible check email later';
        $mail->Body    = $bodyContent;
 
        if (!$mail->send()) {
         echo ("Something Went Wrong Refresh and Try again");
        } else {
         echo ("success");
        }

  }