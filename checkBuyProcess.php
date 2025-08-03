<?php

include "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    if (isset($_POST["id"])) {
        if (isset($_POST["size"])) {
            if (isset($_POST["q"])) {
                if (isset($_POST["color_radio"])) {

                    $email = $_SESSION["u"]["email"];
                    $id = $_POST["id"];
                    $size = $_POST["size"];
                    $qty = $_POST["q"];
                    $color = $_POST["color_radio"];
                    $order_id = uniqid();
                    $array;

                    if ($size != 0) {

                        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $email . "'");
                        $address_num = $address_rs->num_rows;

                        if ($address_num != 0) {

                            $address_data = $address_rs->fetch_assoc();
                            $address = $address_data["line1"];
                            $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id` = '" . $address_data["city_city_id"] . "'");
                            $city_data = $city_rs->fetch_assoc();

                            $qty_check = Database::search("SELECT * FROM `product` WHERE `id` = '" . $id . "'");
                            $qty_data = $qty_check->fetch_assoc();
                            $qty_num = $qty_data["qty"];

                            if ($qty < 1 || $qty <= $qty_num) {

                                if ($color != 0) {

                                    if($qty_data["status_id"] == 1) {
                                        $fname = $_SESSION["u"]["fname"];
                                    $lname = $_SESSION["u"]["lname"];
                                    $mobile = $_SESSION["u"]["mobile_no"];
                                    $uaddress = $address;
                                    $city = $city_data["city"];
                                    $item = $qty_data["title"];
                                    $amount = ((int)$qty_data["price"] * (int)$qty);
                                    $total = ((int)$amount + (int)$qty_data["delivery_fee"]);
                                    $c_rs = Database::search("SELECT * FROM `colour` WHERE `color_id` = '" . $color . "'");
                                    $c = $c_rs->fetch_assoc();
                                    $colour = $c["color_name"];

                                    require __DIR__ . "/vendor/autoload.php";

                                    $stripe_secret_key = "";

                                    \Stripe\Stripe::setApiKey($stripe_secret_key);

                                    try {
                                        $checkout_session = \Stripe\Checkout\Session::create([
                                            "mode" => "payment",
                                            "success_url" => "http://localhost/elisha2/saveInvoiceProcess1.php",
                                            "cancel_url" => "http://localhost/productView.php?id=" . $id,
                                            "locale" => "auto",
                                            "line_items" => [
                                                [
                                                    "quantity" => $qty,
                                                    "price_data" => [
                                                        "currency" => "lkr",
                                                        "unit_amount" => $total . "00",
                                                        "product_data" => [
                                                            "name" => "$item",
                                                            "metadata" => [
                                                                "size" => $size,
                                                                "color" => $colour,
                                                                "delivery_fee" => $qty_data["delivery_fee"],
                                                            ]
                                                        ]
                                                    ]
                                                ],
                                            ]
                                        ]);
                                        $array["id"] = $order_id;
                                        $array["pid"] = $id;
                                        $array["amount"] = $total;
                                        $array["fname"] = $fname;
                                        $array["lname"] = $lname;
                                        $array["mobile"] = $mobile;
                                        $array["address"] = $uaddress;
                                        $array["city"] = $city;
                                        $array["umail"] = $email;
                                        $array["color"] = $color;
                                        $array["size"] = $size;
                                        $array["qty"] = $qty;

                                        $_SESSION["in"] = $array;

                                        http_response_code(303);
                                        header("Location: " . $checkout_session->url);
                                    } catch (Exception $e) {
                                        echo 'Error: ' . $e->getMessage();
                                    }
                                    }else {
                                        ?>
                                         <script>
                                            window.location = "index.php";
                                         </script>
                                        <?php
                                    }
                                } else {
                                ?>
                                    <script>
                                        window.location = "productView.php?id=".$id;
                                    </script>
                                <?php
                                }
                            } else {
                                ?>
                                <script>
                                    window.location = "productView.php?id=".$id;
                                </script>
                            <?php
                            }
                        } else {
                            ?>
                            <script>
                                window.location = "profile.php?update_profile_address";
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script>
                            window.location = "productView.php?id=".$id;
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        window.location = "productView.php?id=".$id;
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    window.location = "productView.php?id=".$id;
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                window.location = "productView.php?id=".$id;
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            window.location = "login.php?Product_ID_not_provided";
        </script>
    <?php

    }
} else {
    ?>
    <script>
        window.location = "login.php?User_not_logged_in";
    </script>
<?php
}
