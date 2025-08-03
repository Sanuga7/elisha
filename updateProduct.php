<?php
session_start();
if (isset($_SESSION["au"]) && isset($_GET["id"])) {
    include("adminheader.php");
    include("connection.php");
    $pid = $_GET["id"];
    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
    $product_data = $product_rs->fetch_assoc();
?>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <div class="container-fluid col-11 d-grid">
            <p class="text-dark fs-5 fw-bold mt-3 mb-0">Update Product</p>
            <hr class="bg-warning mt-0 ">
            <!-- to display a error massage -->
            <div class="col-12 d-none" id="msgdiv1">
                <div class="alert alert-danger" role="alert" id="msg1">

                </div>
            </div>
            <!-- end in here -->
            <div class="col-7 d-grid">
                <label for="title" class="form-label">Title</label>
                <input id="title" disabled type="text" class="form form-control rounded-3" value="<?php echo $product_data["title"]; ?>">
            </div>
            <div class="col-8">
                <label for="price" class="form-label">price</label>
                <div class="input-group mb-2 mt-2">
                    <span class="input-group-text">Rs.</span>
                    <input type="text" class="form-control" disabled id="price" value="<?php echo $product_data["price"]; ?>" />
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            <div class="col-8">
                <label for="desc" class="form-label">Description</label><br>
                <textarea class="form-control" id="desc" cols="30" rows="10"><?php echo $product_data["description"]; ?></textarea>
            </div>
            <div class="col-8">
                <label for="dfee" class="form-label">Delivery Fee</label>
                <div class="input-group mb-2 mt-2">
                    <span class="input-group-text">Rs.</span>
                    <input type="text" class="form-control" id="dfee" value="<?php echo $product_data["delivery_fee"]; ?>" />
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            <div class="col-7">
                <label for="cat" class="form-label">Category</label><br>
                <select id="cat">

                    <?php
                    $cat_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $product_data["category_cat_id"] . "' ");
                    $cat_data = $cat_rs->fetch_assoc();
                    ?>

                    <option>
                        <?php echo $cat_data["category_name"]; ?>
                    </option>

                </select>
            </div>
            <div class="col-8">
                <label for="qty" class="form-label">Quantity</label>
                <input id="qty" type="number" class="form form-control rounded-3" value="<?php echo $product_data["qty"]; ?>">
            </div>
            <div class="col-8">
                <label class="form-label">Available Colors</label><br>
                <?php

                $color_rs = Database::search("SELECT * FROM `colour`");
                $color_num = $color_rs->num_rows;

                while ($color_data = $color_rs->fetch_assoc()) {
                    $color_id = $color_data["color_id"];
                    $color_name = $color_data["color_name"];
                    $uc = Database::search("SELECT * FROM `colour_has_product` WHERE `product_id` = '".$pid."' ");
                    if($uc->num_rows > 0) {
                        $ud = $uc->fetch_assoc();
                        $checked = ($color_id == $ud["colour_color_id"]) ? 'checked' : "";
                    }
                ?>
                    <div class="form-check">
                        <input class="form-check-input" <?php echo isset($checked) ? $checked : ""; ?> type="checkbox" value="<?php echo $color_id; ?>" id="color<?php echo $color_id; ?>">
                        <label class="form-check-label" for="color<?php echo $color_id; ?>">
                            <?php echo $color_name; ?>
                        </label>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6">

                        <?php

                        $img = array();

                        $img[0] = "assets/images/addproductimg.svg";
                        $img[1] = "assets/images/addproductimg.svg";
                        $img[2] = "assets/images/addproductimg.svg";

                        $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                        $product_img_num = $product_img_rs->num_rows;

                        for ($x = 0; $x < $product_img_num; $x++) {
                            $product_img_data = $product_img_rs->fetch_assoc();

                            $img[$x] = $product_img_data["img_path"];
                        }

                        ?>

                        <div class="row">
                            <div class="col-4 border border-primary rounded">
                                <img id="i0" src="<?php echo $img[0]; ?>" class="img-fluid" style="width: 250px;" />
                            </div>
                            <div class="col-4 border border-primary rounded">
                                <img id="i1" src="<?php echo $img[1]; ?>" class="img-fluid" style="width: 250px;" />
                            </div>
                            <div class="col-4 border border-primary rounded">
                                <img id="i2" src="<?php echo $img[2]; ?>" class="img-fluid" style="width: 250px;" />
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                        <input type="file" class="d-none" id="imageuploader" multiple />
                        <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage()">Upload Images</label>
                    </div>
                </div>
            </div>
            <hr class="text-dark bg-dark">
            <div class="col-12">
                <button class="btn btn-success" onclick="updateProduct(<?php echo $product_data['id']; ?>);">Save Product</button>
            </div>
            <hr class="text-dark bg-dark">
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
} else {
?>
    <script>
        window.location = "admin.php";
    </script>
<?php
}
?>