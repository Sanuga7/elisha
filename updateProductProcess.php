<?php
include "connection.php";

if (isset($_SESSION["au"]) || (isset($_POST["id"]) && isset($_POST["d"]) && isset($_POST["df"]) && isset($_POST["q"]))) {

    $id = $_POST["id"];
    $desc = $_POST["d"];
    $dfee = $_POST["df"];
    $qty = $_POST["q"];
    $colors = isset($_POST['colors']) ? explode(",", $_POST['colors']) : [];

    $update_result = Database::iud("UPDATE `product` SET `description` = '".$desc."', `delivery_fee` = '".$dfee."', `qty` = '".$qty."' WHERE `id` = '".$id."'");
    Database::iud("DELETE FROM `colour_has_product` WHERE `product_id` = '".$id."' ");
    foreach ($colors as $color_id) {
        if (!empty($color_id)) {
            $insert_color_query = "INSERT INTO `colour_has_product` (`colour_color_id`, `product_id`) VALUES ('$color_id', '$id')";
            $insert_color_result = Database::iud($insert_color_query);
            if ($insert_color_result !== true) {
                http_response_code(500);
                echo "Error inserting color: " . $insert_color_result;
                exit();
            }
        }
    }
    if ($update_result !== true) {
        http_response_code(500);
        echo "Error updating product details: " . $update_result;
        exit();
    }

    if (!empty($_FILES)) {
        $length = count($_FILES);

        if ($length <= 3) {
            $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

            $delete_query = "DELETE FROM `product_img` WHERE `product_id` = '".$id."'";
            $delete_result = Database::iud($delete_query);
            if ($delete_result !== true) {
                http_response_code(500);
                echo "Error deleting previous images: " . $delete_result;
                exit();
            }

            for ($x = 0; $x < $length; $x++) {
                if (isset($_FILES["img" . $x])) {

                    $image_file = $_FILES["img" . $x];
                    $file_extension = $image_file["type"];

                    if (in_array($file_extension, $allowed_image_extensions)) {

                        $new_img_extension;

                        if ($file_extension == "image/jpeg") {
                            $new_img_extension = ".jpeg";
                        } else if ($file_extension == "image/png") {
                            $new_img_extension = ".png";
                        } else if ($file_extension == "image/svg+xml") {
                            $new_img_extension = ".svg";
                        }

                        $file_name = "assets/products/" . uniqid() . $new_img_extension;
                        if (move_uploaded_file($image_file["tmp_name"], $file_name)) {
                            $insert_query = "INSERT INTO `product_img` (`img_path`, `product_id`) VALUES ('$file_name', '$id')";
                            $insert_result = Database::iud($insert_query);
                            if ($insert_result !== true) {
                                http_response_code(500);
                                echo "Error inserting image: " . $insert_result;
                                exit();
                            }
                        } else {
                            http_response_code(500);
                            echo "Failed to move uploaded file.";
                            exit();
                        }
                    } else {
                        http_response_code(400);
                        echo "Invalid image type.";
                        exit();
                    }
                }
            }
        } else {
            http_response_code(400);
            echo "Invalid image count.";
            exit();
        }
    }    

    echo "updated";
} else {
    http_response_code(400);
    echo "Invalid request.";
    exit();
}
?>
