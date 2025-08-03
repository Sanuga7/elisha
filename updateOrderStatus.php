<?php 

 include "connection.php";

 if(isset($_POST["order_id"]) && isset($_POST["status"])){

    $oid = $_POST["order_id"];
    $status = $_POST["status"];

    Database::iud("UPDATE `invoice` SET `status_id` = '".$status."' WHERE `order_id` = '".$oid."' ");
    echo "success";

 }else{
    ?>
     <script>
        window.location = "index.php?something_went_wrong";
     </script>
    <?php
 }