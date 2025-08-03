<?php
include("header.php");
include("connection.php");

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $total = 0;
    $shipping = 0;

    $check_rs = Database::search("SELECT * FROM `wishlist` WHERE `user_email` = '" . $email . "' ");
    $check_n = $check_rs->num_rows;
    
    if ($check_n != 0) {
        $product_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.product_id=product.id WHERE `user_email`='" . $email . "' AND product.`status_id`='1' ORDER BY `added_time` DESC");

        $product_num = $product_rs->num_rows;
?>
        <link rel="stylesheet" href="assets/css/tezt.css">
        <div class="container-fluid ms-0">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb bg-light mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" style="color: rgba(250,115,93,255);">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
            <div class="row" onload="cartStatus();">
                <div class="col-12 col-lg-7">
                    <h5 style="overflow-y: hidden;"><?php echo $product_num; ?> Items in Cart</h5>
                    <table class="table">
                        <thead style="background-color: #f76838;" class="text-light">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($x = 0; $x < $product_num; $x++) {
                                $product_data = $product_rs->fetch_assoc();
                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $product_data["id"] . "'");
                                $img = $img_rs->fetch_assoc();
                                $total = $total + $product_data["price"] * $product_data["c_qty"];
                                $shipping = $shipping + $product_data["delivery_fee"];
                                $sub = $total + $shipping;
                                $color_rs = Database::search("SELECT * FROM `cart` INNER JOIN `colour` ON cart.colour_color_id=colour.color_id  WHERE `product_id` = '" . $product_data["id"] . "'");
                                $color = $color_rs->fetch_assoc();
                            ?>
                                <tr>
                                    <td width="150">
                                        <div class="img-box"><img class="img-fluid w-50 rounded-circle border border-warning" src="<?php echo $img["img_path"]; ?>"></div>
                                    </td>
                                    <td><?php echo $product_data["title"]; ?> - <?php echo $color["color_name"]; ?></td>
                                    <td>Rs.<?php echo $product_data["price"]; ?>.00</td>
                                    <td width="70" class="trash" onclick="remove(<?php echo $product_data['id']; ?>);"><i class='fa-solid fa-trash'></i></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-lg-4 ms-lg-2">
                    <h5>Summary</h5>

                    <head style="background-color: #f76838;" class="text-light w-100">
                        <p style="background-color: #f76838;" class="text-light w-100 fs-6 fw-bold p-2 pb-2 d-grid text-start"><?php echo $product_num; ?> Items In Cart</p>
                    </head>
                    <section>
                        <div>
                            <div class="row">
                                <div class="col-6">
                                    <span class="fs-6">Items (<?php echo $product_num; ?>)</span>
                                </div>

                                <div class="col-6 text-end">
                                    <span class="fs-6">Rs.<?php echo $total; ?>.00</span>
                                </div>

                                <div class="col-12">
                                    <hr class="text-secondary bg-secondary" />
                                </div>

                                <div class="col-6">
                                    <span class="fs-6">Shipping Cost</span>
                                </div>

                                <div class="col-6 text-end">
                                    <span class="fs-6">Rs.<?php echo $shipping; ?>.00</span>
                                </div>

                                <div class="col-12">
                                    <hr class="text-secondary bg-secondary" />
                                </div>

                                <div class="col-6">
                                    <span class="fs-6">Subtotal</span>
                                </div>

                                <div class="col-6 text-end">
                                    <span class="fs-6" id="total">Rs.<?php echo isset($sub) ? $sub : "0"; ?>.00</span>
                                </div>

                                <div class="col-12 d-none" id="di">
                                    <hr class="text-secondary bg-secondary" />
                                </div>

                                <div class="col-6 d-none" id="di2">
                                    <span class="fs-6">Discount</span>
                                </div>

                                <div class="col-6 text-end" id="di">
                                    <span class="fs-6" id="dis"></span>
                                </div>

                                <div class="col-12">
                                    <hr class="text-secondary bg-secondary" />
                                </div>

                                <div class="col-6">
                                    <span class="fs-6">Promo Code</span>
                                </div>

                                <div class="col-6 text-end">
                                    <input type="text" class="form-control" onchange="prom();" id="promo" name="promo" placeholder="Enter Promo Code">
                                </div>

                                <div class="col-12">
                                    <hr class="text-secondary bg-secondary" />
                                </div>

                                <input type="hidden" name="sub" id="sub" value="<?php echo $sub; ?>"> <!-- Updated sub value -->

                                <div class="col-12 mb-5">
                                    <button class="btn btn-wish" onclick="formSubmit();">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
<?php
    }
    include("footer.php");
} else {
?>
    <script>
        window.location = "login.php";
    </script>
<?php
}
?>
