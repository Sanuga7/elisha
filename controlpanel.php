<?php 
  session_start();
  if (isset($_SESSION["au"])) {
    include("adminheader.php");
    ?>
     <script>
      window.location = "dashboard.php";
     </script>
    <?php
  }else {
    ?>
    <script>window.location = "admin.php"; </script>
    <?php
  }
?>
