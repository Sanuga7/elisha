<?php

include "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$pwd = $_POST["p"];
$code = uniqid();
$subject = "Thanks For Registering on Elisha Creation";

$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

$content = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .email-container {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .email-header, .email-footer {
            background-color: #343a40;
            color: white;
            padding: 10px;
        }
        .email-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .verification-code {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container email-container">
        <div class="row">
            <div class="col-12 email-header text-center">
                <h2>Elisha Creation</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 email-content">
                <p>You have successfully registered for Elisha Creation and you can continue with your shopping.</p>
                <p class="verification-code">' . $code . ' - Your Verification Code</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 email-footer text-center">
                <p>&copy; 2024 Elisha Creation. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
';

if (empty($fname)) {
    echo ("Please Enter Your First Name");
} else if (strlen($fname) > 20) {
    echo ("Length of First Name Must be less than 20 characters");
} else if (empty($lname)) {
    echo ("Please Enter Your Last Name");
} else if (strlen($lname) > 20) {
    echo ("Length of Last Name Must be less than 20 characters");
} else if (empty($email)) {
    echo ("Please Enter Your Email Address");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address");
} else if (strlen($email) > 100) {
    echo ("Length of your Email address Must be less than 100 characters");
} else if (empty($pwd)) {
    echo ("Please Enter Your Password");
} else if (strlen($pwd) < 5 || strlen($pwd) > 20) {
    echo ("Password must be between 5 and 20 characters");
} else if ($pwd == $fname) {
    echo ("Your Password is too vulnerable");
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' ");
    $n = $rs->num_rows;

    if ($n > 0) {
        echo ("User Already exist with email Address");
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`password`,`joined_date`,`status_id`,`verification_code`) VALUES ('" . $fname . "','" . $lname . "','" . $email . "','" . $hashedPwd . "','" . $date . "','2','" . $code . "') ");

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
    }
}
?>
