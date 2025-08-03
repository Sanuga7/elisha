<?php

include("connection.php");
session_start();

if (isset($_SESSION["au"])) {
    if (!empty($_POST["t"])) {
        if (!empty($_POST["p"])) {
            if (!empty($_POST["d"])) {
                if (!empty($_POST["df"])) {
                    if (!empty($_POST["c"])) {
                        if (!empty($_POST["q"]) && isset($_POST["colors"])) {

                            $title = $_POST["t"];
                            $price = $_POST["p"];
                            $description = $_POST["d"];
                            $delivery_fee = $_POST["df"];
                            $category = $_POST["c"];
                            $qty = $_POST["q"];
                            $colors = isset($_POST['colors']) ? explode(",", $_POST['colors']) : [];

                            $d = new DateTime();
                            $tz = new DateTimeZone("Asia/Colombo");
                            $d->setTimezone($tz);
                            $date = $d->format("Y-m-d H:i:s");

                            $status = 1;

                            Database::iud("INSERT INTO `product` (`title`,`price`,`description`,`added_time`,`delivery_fee`,`status_id`,`category_cat_id`,`qty`)
                            VALUES('" . $title . "','" . $price . "','" . $description . "','" . $date . "','" . $delivery_fee . "','" . $status . "','" . $category . "','" . $qty . "')");

                            $product_id = Database::$connection->insert_id;

                            $length = sizeof($_FILES);

                            if ($length <= 3 && $length > 0) {

                                $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

                                for ($x = 0; $x < $length; $x++) {
                                    if (isset($_FILES["image" . $x])) {

                                        $image_file = $_FILES["image" . $x];
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

                                            $file_name = "assets//products//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                                            move_uploaded_file($image_file["tmp_name"], $file_name);

                                            Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES 
                                            ('" . $file_name . "','" . $product_id . "')");
                                        } else {
                                            echo ("Inavid image type.");
                                        }
                                    }
                                }
                                
                                foreach ($colors as $color_id) {
                                    if (!empty($color_id)) {
                                        Database::iud("INSERT INTO `colour_has_product` (`colour_color_id`, `product_id`) VALUES ('$color_id', '$product_id')");
                                    }
                                }

                                echo ("success");
                            } else {
                                echo ("Invalid Image Count.");
                            }
                        } else {
                            echo "quantity is required";
                        }
                    } else {
                        echo "category is required";
                    }
                } else {
                    echo "delivery fee is required";
                }
            } else {
                echo "description is required";
            }
        } else {
            echo "price is required";
        }
    } else {
        echo "title is required";
    }
} else {
    header("Location : index.php");
}
