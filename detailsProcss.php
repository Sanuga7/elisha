<?php

include "connection.php";
session_start();

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id=product.id INNER JOIN `sizes` ON invoice.sizes_id=sizes.id INNER JOIN `colour` ON 
invoice.colour_color_id=colour.color_id WHERE invoice.id = '" . $id . "' AND invoice.status_id IN (3,5,6)");
    $num = $rs->num_rows;

    if ($num > 0) {

        $data = $rs->fetch_assoc();
        echo (json_encode($data));

    }else {
        echo "failed";
    }

}else {

    echo "failed";
}

