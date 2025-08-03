<?php
session_start();
if (isset($_SESSION["au"])) {
    include("adminheader.php");
    include("connection.php");
?>
<!-- Main Content -->
<div class="main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Product</h1>
    </div>
    <div class="container-fluid col-11 d-grid">
        <p class="text-dark fs-5 fw-bold mt-3 mb-2">New Product</p>
        <hr class="bg-warning mt-0">
        <!-- to display an error message -->
        <div class="col-12 d-none" id="msgdiv1">
            <div class="alert alert-danger" role="alert" id="msg1"></div>
        </div>
        <!-- end here -->
        <div class="col-7 d-grid">
            <label for="title" class="form-label">Title</label>
            <input id="title" type="text" class="form form-control rounded-3">
        </div>
        <div class="col-8">
            <label for="price" class="form-label">Price</label>
            <div class="input-group mb-2 mt-2">
                <span class="input-group-text">Rs.</span>
                <input type="text" class="form-control" id="price">
                <span class="input-group-text">.00</span>
            </div>
        </div>
        <div class="col-8">
            <label for="desc" class="form-label">Description</label><br>
            <textarea class="form-control" id="desc" cols="30" rows="10"></textarea>
        </div>
        <div class="col-8">
            <label for="dfee" class="form-label">Delivery Fee</label>
            <div class="input-group mb-2 mt-2">
                <span class="input-group-text">Rs.</span>
                <input type="text" class="form-control" id="dfee">
                <span class="input-group-text">.00</span>
            </div>
        </div>
        <div class="col-7">
            <label for="cat" class="form-label">Category</label><br>
            <select id="cat">
                <option value="0">Select Category</option>
                <?php
                $category_rs = Database::search("SELECT * FROM `category`");
                $c_num = $category_rs->num_rows;

                for ($x = 0; $x < $c_num; $x++) {
                    $c_data = $category_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $c_data["cat_id"]; ?>">
                        <?php echo $c_data["category_name"]; ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-8">
            <label for="qty" class="form-label">Quantity</label>
            <input id="qty" type="number" class="form form-control rounded-3">
        </div>
        
        <!-- Color Selection Section -->
        <div class="col-8">
            <label class="form-label">Available Colors</label><br>
            <?php
            // Fetch colors from the database
            $color_rs = Database::search("SELECT * FROM `colour`");
            $color_num = $color_rs->num_rows;

            // Generate checkboxes
            while ($color_data = $color_rs->fetch_assoc()) {
                $color_id = $color_data["color_id"];
                $color_name = $color_data["color_name"];
            ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?php echo $color_id; ?>" id="color<?php echo $color_id; ?>">
                    <label class="form-check-label" for="color<?php echo $color_id; ?>">
                        <?php echo $color_name; ?>
                    </label>
                </div>
            <?php
            }
            ?>
        </div>
        
        <!-- Add Product Images -->
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                </div>
                <div class="offset-lg-3 col-12 col-lg-6">
                    <div class="row">
                        <div class="col-4 border border-primary rounded">
                            <img src="assets/images/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                        </div>
                        <div class="col-4 border border-primary rounded">
                            <img src="assets/images/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                        </div>
                        <div class="col-4 border border-primary rounded">
                            <img src="assets/images/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2" />
                        </div>
                    </div>
                </div>
                <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                    <input type="file" class="d-none" multiple id="imageuploader" />
                    <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                </div>
            </div>
        </div>
        <hr class="text-dark bg-dark">
        <div class="col-12">
            <button class="btn btn-success" onclick="saveProduct();">Save Product</button>
        </div>
        <hr class="text-dark bg-dark">
    </div>
</div>
<?php
} else {
?>
    <script>
        window.location = "admin.php";
    </script>
<?php
}
?>
