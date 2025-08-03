<?php
include "connection.php";

if (!isset($_POST["total"]) || !isset($_POST["promo"])) {
  exit("no");
}

$total = floatval($_POST["total"]);
$promo = $_POST["promo"];

$rs = Database::search("SELECT * FROM `promo_code` WHERE `code` = '".$promo."' AND `status_id` = '1'");
$num = $rs->num_rows;

if ($num > 0) {
  $data = $rs->fetch_assoc();
  $newTotal = $total * (1 - ($data["percentage"] / 100));
  $array = array(
    'new_total' => $newTotal,
    'percentage' => $data["percentage"]
  );
  echo json_encode($array); 
} else {
  echo "no"; 
}

