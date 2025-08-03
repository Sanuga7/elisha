<?php 

  include "connection.php";

  if(isset($_POST["x"])){
    
     $x = $_POST["x"];

     $rs = Database::search("SELECT * FROM `promo_code` WHERE `id` = '".$x."'");
     $num = $rs->num_rows;

     if($num > 0){

        $data = $rs->fetch_assoc();
        $s = $data["status_id"];

        if($s == 1){
            Database::iud("UPDATE `promo_code` SET `status_id` = '2' WHERE `id` = '".$x."'");
            echo "success";
        }else if($s == 2){
            Database::iud("UPDATE `promo_code` SET `status_id` = '1' WHERE `id` = '".$x."'");
            echo "success";
        }else{
            echo "something went wrong";
        }

     }else{
        echo "something went wrong";
     }

  }else{
    ?>
     <script>
        window.location = "index.php";
     </script>
    <?php
  }