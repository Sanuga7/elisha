<?php

session_start();
include "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["au"]) && isset($_POST["id"]) && isset($_POST["m"])) {

    $id = $_POST["id"];
    $msg = $_POST["m"];
    $adminEmail = $_SESSION["au"]["email"]; // Renamed to avoid confusion

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("y-m-d H:i:s");

    $rs = Database::search("SELECT * FROM `chat` WHERE `id` = '" . $id . "' ");
    $num = $rs->num_rows;

    if ($num > 0) {

        $rs1 = Database::search("SELECT * FROM `reply` WHERE `chat_id` = '" . $id . "' ");
        $num1 = $rs1->num_rows;

        if($num1 == 0){

           
        $data = $rs->fetch_assoc();
        $userEmail = $data["user_email"];

        $subject = "Elisha Creation";
        $content = $msg;

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
        $mail->addAddress($userEmail);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $content;

        // Insert reply into database
        Database::iud("INSERT INTO `reply` (`reply`,`name`,`user_email`,`date`,`admin_email`,`chat_id`) VALUES('" . $msg . "','" . $data["name"] . "','" . $userEmail . "','" . $date . "','" . $adminEmail . "','" . $id . "')");

        if (!$mail->send()) {
            echo ("Something Went Wrong. Refresh and Try again");
        } else {
            echo ("success");
        }

        }else {
            echo "Already Replied to this";
        }
    }
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
?>