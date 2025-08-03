<?php

include "connection.php";
session_start();

header('Content-Type: application/json');

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];
     if(isset($_POST["total"])){
        $ntotal = $_POST["total"];
    }

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $email . "'");
    $cart_num = $cart_rs->num_rows;

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $email . "'");
    $address_num = $address_rs->num_rows;

    if ($address_num != 0) {

        if ($cart_num > 0) {
            $order_id = uniqid();
            $cart_details = [];

            require __DIR__ . "/vendor/autoload.php";

            $stripe_secret_key = "";

            \Stripe\Stripe::setApiKey($stripe_secret_key);

            $line_items = [];
            for ($i = 0; $i < $cart_num; $i++) {

                $cart_data = $cart_rs->fetch_assoc();
                $c = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cart_data["product_id"] . "'");
                $product = $c->fetch_assoc();
                $c_qty = $cart_data["c_qty"];
                $total = isset($_POST["total"]) ? $_POST["total"] : ($product["price"] * $c_qty) + $product["delivery_fee"];
                $item = $product["title"];
                $size = $cart_data["sizes_id"];
                $colour = $cart_data["colour_color_id"];
                $id = $product["id"];
                $array = [];
                $array["id"] = $order_id;
                $array["pid"] = $id;
                $array["amount"] = $total;
                $array["umail"] = $email;
                $array["color"] = $colour;
                $array["size"] = $size;
                $array["qty"] = $c_qty;

                $cart_details[] = $array;

                $line_items[] = [
                    "quantity" => $c_qty,
                    "price_data" => [
                        "currency" => "lkr",
                        "unit_amount" => $total * 100,
                        "product_data" => [
                            "name" => $item,
                            "metadata" => [
                                "size" => $size,
                                "color" => $colour,
                                "delivery_fee" => $product["delivery_fee"],
                            ]
                        ]
                    ]
                ];
            }

            $_SESSION["cb"] = $cart_details;

            try {
                $checkout_session = \Stripe\Checkout\Session::create([
                    "mode" => "payment",
                    "success_url" => "http://localhost/elisha2/saveInvoiceProcess.php",
                    "cancel_url" => "http://localhost/elisha2/productView.php?id=" . $id,
                    "locale" => "auto",
                    "line_items" => $line_items,
                ]);

                echo json_encode(['status' => 'success', 'url' => $checkout_session->url]);
                exit();
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
                exit();
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Cart is empty.']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Address not found.']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Please log in first.']);
    exit();
}
