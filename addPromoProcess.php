<?php 

  include "connection.php";

  if(isset($_POST["p"]) && isset($_POST["c"])){
     
     $code = $_POST["c"];
     $per = $_POST["p"];

     $num = Database::search("SELECT * FROM `promo_code` WHERE `code` = '".$code."' ")->num_rows;

     if ($num == 0) {
        
       Database::iud("INSERT INTO `promo_code` (`code`, `percentage`, `status_id`) VALUES ('$code', '$per', '1')");
        
        echo "success";

     }else {
        echo "already Exist";
     }

  }else {
    ?>
     <script>
        window.location = "index.php";
     </script>
    <?php
  }