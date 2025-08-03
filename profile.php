<?php
include "header.php";
include "connection.php";

$email = $_SESSION["u"]["email"];
$image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");
$image_details = $image_rs->fetch_assoc();


if (!isset($_SESSION["u"])) {
    ?>
    <script>window.location = "index.php";</script>
    <?php
}
?>
<div class="container">
    <div class="main-body">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" style="color: rgba(250,115,93,255);">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)" style="color: rgba(250,115,93,255);">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <!-- to display a error massage -->
                        <div class="col-12 d-none" id="msgdiv1">
                            <div class="alert alert-danger" role="alert" id="msg1">

                            </div>
                        </div>
                        <!-- end in here -->
                        <div class="d-flex flex-column align-items-center text-center">
                            <?php
                            if (empty($image_details["img_path"])) {
                            ?>
                                <img id="loadImg" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                            <?php
                            } else {
                            ?>
                                <img id="loadImg" src="<?php echo $image_details["img_path"]; ?>" alt="Admin" class="rounded-circle" width="150">
                            <?php
                            }

                            ?>
                            <div class="mt-3">
                                <?php
                                $data = $_SESSION["u"]["email"];
                                $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $data . "' ");
                                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                                user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                city.district_district_id=district.district_id INNER JOIN `province` ON 
                                district.province_province_id=province.province_id WHERE `user_email`='" . $data . "'");
                                $user = $rs->fetch_assoc();
                                $address = $address_rs->fetch_assoc();

                                ?>
                                <h4><?php echo $user["fname"] . " " . $user["lname"]; ?></h4>
                                <p class="text-secondary mb-1"><?php if (empty($user["mobile_no"])) {
                                                                ?>077-xxx-xxxx<?php
                                                                            } else {
                                                                                echo $user["mobile_no"];
                                                                            } ?></p>
                                <p class="text-muted font-size-sm"><?php if (empty($address["line1"])) {
                                                                    ?>123 road,Western<?php
                                                                                    } else {
                                                                                        echo $address["line1"];
                                                                                    } ?></p>
                                <input type="file" class="d-none" id="profileimage" />
                                <label for="profileimage" class="btn text-light mt-2" style="background-color: rgba(250,115,93,255);" onclick="changeProfileImg();">Edit Image</label>
                                <button class="btn btn-outline his" style="color: rgba(250,115,93,255); border-color:rgba(250,115,93,255);"><a href="orderHistory.php" style="color: rgba(250,115,93,255);">History</a></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user["fname"] . " " . $user["lname"]; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user["email"]; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Mobile</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php if (empty($user["mobile_no"])) {
                                ?>077-xxx-xxxx<?php
                                            } else {
                                                echo $user["mobile_no"];
                                            } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php
                                if (empty($address["line1"])) {
                                ?>123 Road,colombo<?php
                                                } else {
                                                    echo $address["line1"] . "," . $address["city"] . "," . $address["district"] . "," . $address["province"];
                                                }
                                                    ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Postal Code</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php if (empty($address["postal_code"])) {
                                ?>-<?php
                                } else {
                                    echo $address["postal_code"];
                                } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info text-light" style="background-color:rgba(250,115,93,255); border-color:rgba(250,115,93,255);" data-toggle="modal" data-target="#exampleModalCenter">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters-md">
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <?php
                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `status_id` IN (3, 5, 6) AND `user_email` = '".$email."' ORDER BY `date` DESC;");
                                $invoice_num = $invoice_rs->num_rows;
                                ?>
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">User</i>Pending Orders(<?php echo $invoice_num; ?>) <a class="ms-5 ps-0" href="orderHistory.php">View All</a></h6>
                                <?php
                                   if($invoice_num > 0){
                                    for ($x = 0; $x < 1; $x++) {
                                        $invoice_data = $invoice_rs->fetch_assoc();
                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $invoice_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>
                                        <div class="card col-11 col-lg-9 mt-2 mb-2 align-content-center justify-content-center d-flex ms-lg-5" style="width: 18rem;" onclick="addToCart(<?php echo $product_data['id']; ?>);">
    
                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                            $img_data = $img_rs->fetch_assoc();
                                            ?>
    
                                            <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                            <div class="card-body ms-0 m-0 text-center">
                                                <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                                                <span class="badge rounded-pill text-bg-info">New</span><br />
                                                <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
    
                                                <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                                <a href="orderView.php?id=<?php echo $invoice_data["order_id"] ?>&p=<?php echo $invoice_data['product_id'];?>" class="col-12 btn btn-success">Details</a>
                                                <?php
                                                $status_rs = Database::search("SELECT * FROM `status` WHERE `id` = '" . $invoice_data["status_id"] . "'");
                                                $status_data = $status_rs->fetch_assoc();
                                                $status = $status_data["status"];
    
                                                if ($invoice_data["status_id"] == 3) {
                                                ?>
                                                    <button class="col-12 btn btn-danger mt-2 disabled" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="This top tooltip is themed via CSS variables.">
                                                        <a class="text-light" href='#'><?php echo $status; ?></a>
                                                    </button>
                                                <?php
                                                }
                                                if ($invoice_data["status_id"] == 4) {
                                                ?>
                                                    <button class="col-12 btn btn-danger mt-2 disabled" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="This top tooltip is themed via CSS variables.">
                                                        <a class="text-light" href='#'><?php echo $status; ?></a>
                                                    </button>
                                                <?php
                                                }
                                                if ($invoice_data["status_id"] == 5) {
                                                ?>
                                                    <button class="col-12 btn btn-danger mt-2 disabled" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="This top tooltip is themed via CSS variables.">
                                                        <a class="text-light" href='#'><?php echo $status; ?></a>
                                                    </button>
                                                <?php
                                                }
                                                if ($invoice_data["status_id"] == 6) {
                                                ?>
                                                    <button class="col-12 btn btn-danger mt-2 disabled" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="This top tooltip is themed via CSS variables.">
                                                        <a class="text-light" href='#'><?php echo $status; ?></a>
                                                    </button>
                                                <?php
                                                }
                                                ?>
    
                                            </div>
                                        </div>
                                    <?php
                                    }
                                   }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <?php
                                $invoice_rs1 = Database::search("SELECT * FROM `invoice` WHERE `status_id` = 4 AND `user_email` = '".$email."' ORDER BY `date` DESC;");
                                $invoice_num1 = $invoice_rs1->num_rows;
                                ?>
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">User</i>Completed Orders(<?php echo $invoice_num1; ?>)<a class="ms-5 ps-0" href="orderHistory.php">View All</a></h6>
                                <?php
                                  if($invoice_num1 > 0){
                                    for ($x = 0; $x < 1; $x++) {
                                        $invoice_data1 = $invoice_rs1->fetch_assoc();
                                        $product_rs1 = Database::search("SELECT * FROM `product` WHERE `id` = '" . $invoice_data1["product_id"] . "'");
                                        $product_data1 = $product_rs1->fetch_assoc();
                                    ?>
                                        <div class="card col-11 col-lg-9 mt-2 mb-2 align-content-center justify-content-center d-flex ms-lg-5" style="width: 18rem;" onclick="addToCart(<?php echo $product_data['id']; ?>);">
    
                                            <?php
                                            $img_rs1 = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data1["id"] . "'");
                                            $img_data1 = $img_rs1->fetch_assoc();
                                            ?>
    
                                            <img src="<?php echo $img_data1["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                            <div class="card-body ms-0 m-0 text-center">
                                                <h5 class="card-title fw-bold fs-6"><?php echo $product_data1["title"]; ?></h5>
                                                <span class="badge rounded-pill text-bg-info">New</span><br />
                                                <span class="card-text text-primary">Rs. <?php echo $product_data1["price"]; ?> .00</span><br />
    
                                                <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                <span class="card-text text-success fw-bold"><?php echo $product_data1["qty"]; ?> Items Available</span><br /><br />
                                                <a href='<?php echo "orderView.php?id=" . ($product_data1["id"]); ?>' class="col-12 btn btn-success">Feedback</a>
                                                <?php
                                                $status_rs = Database::search("SELECT * FROM `status` WHERE `id` = '" . $invoice_data1["status_id"] . "'");
                                                $status_data = $status_rs->fetch_assoc();
                                                $status = $status_data["status"];
    
                                                if ($invoice_data1["status_id"] == 3) {
                                                ?>
                                                    <button class="col-12 btn btn-danger mt-2 disabled">
                                                        <a class="text-light" href='#'><?php echo $status; ?></a>
                                                    </button>
                                                <?php
                                                }
                                                if ($invoice_data1["status_id"] == 4) {
                                                ?>
                                                    <button class="col-12 btn btn-success mt-2 disabled">
                                                        <a class="text-light" href='#'><?php echo $status; ?></a>
                                                    </button>
                                                <?php
                                                }
                                                if ($invoice_data1["status_id"] == 5) {
                                                ?>
                                                    <button class="col-12 btn btn-primary mt-2 disabled">
                                                        <a class="text-light" href='#'><?php echo $status; ?></a>
                                                    </button>
                                                <?php
                                                }
                                                if ($invoice_data1["status_id"] == 6) {
                                                ?>
                                                    <button class="col-12 btn btn-warning mt-2 disabled">
                                                        <a class="text-light" href='#'><?php echo $status; ?></a>
                                                    </button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                  }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>
</div>
<!-- modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update User Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                        <?php 
                           $rs = Database::search("SELECT * FROM `user` INNER JOIN `user_has_address` ON user.email=user_has_address.user_email INNER JOIN `city` ON user_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id INNER JOIN `province` ON district.province_province_id=province.province_id
                           WHERE `email` = '".$email."'");
                           $mdata = $rs->fetch_assoc();
                        ?>
                            <div class="input-group mb-1">
                                <!-- to display an error message -->
                                <div class="col-12 d-none" id="msgdiv">
                                    <div class="alert alert-danger" role="alert" id="msg"></div>
                                </div>
                                <!-- end here -->
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label class="form-label" for="fname">First Name</label>
                                        <input type="text" id="fname" class="form-control" value="<?php echo (!empty($mdata["fname"])) ? $mdata["fname"] : ""; ?>">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2">
                                        <label class="form-label" for="lname">Last Name</label>
                                        <input type="text" id="lname" class="form-control" value="<?php echo (!empty($mdata["lname"])) ? $mdata["lname"] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="mobile" class="mt-1 form-label">Mobile Number</label>
                                    <input type="text" id="mobile" class="form-control" value="<?php echo (!empty($mdata["mobile_no"])) ? $mdata["mobile_no"] : ""; ?>">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="city" class="mt-1 form-label">City</label>
                                    <input type="text" id="city" class="form-control" value="<?php echo (!empty($mdata["city"])) ? $mdata["city"] : ""; ?>">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="dis" class="form-label">District</label>
                                    <select id="dis" class="form-control">
                                        <option value="0">Select District</option>
                                        <?php
                                        $district_rs = Database::search("SELECT * FROM `district`");
                                        $d_num = $district_rs->num_rows;

                                        for ($x = 0; $x < $d_num; $x++) {
                                            $d_data = $district_rs->fetch_assoc();
                                            $selected = ($d_data["district_id"] == $mdata["district_district_id"] ? "selected" : "");
                                        ?>
                                            <option value="<?php echo $d_data["district_id"]; ?>" <?php echo $selected; ?>>
                                                <?php echo $d_data["district"]; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="pro" class="form-label">Province</label>
                                    <select id="pro" class="form-control">
                                        <option value="0">Select Province</option>
                                        <?php
                                        $province_rs = Database::search("SELECT * FROM `province`");
                                        $p_num = $province_rs->num_rows;

                                        for ($x = 0; $x < $p_num; $x++) {
                                            $p_data = $province_rs->fetch_assoc();
                                            $selected = ($p_data["province_id"] == $mdata["province_province_id"] ? "selected" : "");
                                        ?>
                                            <option value="<?php echo $p_data["province_id"]; ?>" <?php echo $selected ?>>
                                                <?php echo $p_data["province"]; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="line1" class="mt-1 form-label">Address Line1</label>
                                    <input type="text" id="line1" class="form-control" value="<?php echo (!empty($mdata["line1"])) ? $mdata["line1"] : ""; ?>">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="pcode" class="mt-1 form-label">Postal Code</label>
                                    <input type="text" id="pcode" class="form-control" value="<?php echo (!empty($mdata["postal_code"])) ? $mdata["postal_code"] : ""; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn text-light" style="background-color: rgba(250,115,93,255);" onclick="updateInfo();">Update Profile</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="orderview">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order View Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 justify-content-center align-content-center d-flex">
                    <img src="<?php echo $img_data["img_path"]; ?>" class="w-50 col-sm-5">
                </div>
                <p class="ms-4 mt-4 text-dark">Title:- <?php echo $product_data["title"]; ?></p>
                <p class="ms-4 mt-2 text-dark">Price:- <?php echo $invoice_data["total"]; ?></p>
                <p class="ms-4 mt-2 text-dark">Delivery Fee:- <?php echo $invoice_data["total"] - $product_data["price"]; ?></p>
                <p class="ms-4 mt-2 text-dark">Quantity:- <?php echo $invoice_data["quantity"]; ?></p>
                <p class="ms-4 mt-2 text-dark">Date & Time:- <?php echo $invoice_data["date"]; ?></p>
                <?php
                $size_rs = Database::search("SELECT * FROM `sizes` WHERE `id` = '" . $invoice_data["sizes_id"] . "'");
                $size_data = $size_rs->fetch_assoc();
                $size = $size_data["size"];
                $clr_rs = Database::search("SELECT * FROM `colour` WHERE `color_id`= '" . $invoice_data["colour_color_id"] . "'");
                $clr_data = $clr_rs->fetch_assoc();
                $color = $clr_data["color_name"];
                ?>
                <p class="ms-4 mt-2 text-dark">Size :- <?php echo $size; ?></p>
                <p class="ms-4 mt-2 text-dark">Colour :- <?php echo $color; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary"><a class="text-light" href="invoice.php?id=<?php echo $invoice_data['order_id']; ?>">invoice</a></button>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>