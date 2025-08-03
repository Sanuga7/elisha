<?php
session_start();
if (isset($_SESSION["au"])) {
    include("adminheader.php");
    include("connection.php");

    $query = "SELECT * FROM `product`";

    if (isset($_GET["search"])) {

        $txt = $_GET["search"];
        $query .= "WHERE `title` LIKE '%" . $txt . "%'";
    }
?>
    <style>
        * {
            overflow-x: hidden;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-img {
            width: 100%;
            height: 250px;
            object-fit: contain;
        }

        .product-body {
            padding: 15px;
        }

        .product-title {
            color: #333;
            font-weight: bold;
            font-size: 1.2em;
        }

        .product-price {
            color: #e91e63;
            font-weight: bold;
            margin: 10px 0;
        }

        .product-qty {
            color: #4caf50;
            margin-bottom: 10px;
        }

        .product-status {
            color: #00bcd4;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .product-update-btn {
            background-color: #ff9800;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .product-update-btn:hover {
            background-color: #fb8c00;
        }

        .form-check-label {
            display: block;
            margin-bottom: 10px;
            color: #9c27b0;
            font-weight: bold;
        }
    </style>
    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
            <p class="fw-bold fs-4 ms-2 text-primary">Manage Products</p>
            <input type="text" id="msearch" class="text-end input rounded-3 fs-4 border-1 border-info-subtle" onchange="manageSearchProducts(1);">
        </div>

        <div class="col-11 content" id="mcontent">

            <!-- product -->
            <div class="col-12 col-lg-12 mt-3 mb-3 bg-white">
                <div class="row" id="sort">

                    <div class="offset-1 col-10 text-center">
                        <div class="row justify-content-center">

                            <?php

                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $product_rs = Database::search($query);
                            $product_num = $product_rs->num_rows;

                            $results_per_page = 6;
                            $number_of_pages = ceil($product_num / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;
                            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);

                            $selected_num = $selected_rs->num_rows;
                            for ($x = 0; $x < $selected_num; $x++) {
                                $selected_data = $selected_rs->fetch_assoc();
                            ?>

                                <!-- card -->
                                <div class="card mb-3 mt-3 col-12 col-lg-6 product-card">
                                    <?php
                                    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                    $product_img_data = $product_img_rs->fetch_assoc();
                                    ?>
                                    <img src="<?php echo $product_img_data["img_path"]; ?>" class="product-img" alt="Product Image">
                                    <div class="product-body">
                                        <h5 class="product-title" style="overflow-y: hidden;"><?php echo $selected_data["title"]; ?></h5>
                                        <p class="product-price">Rs. <?php echo $selected_data["price"]; ?>.00</p>
                                        <p class="product-qty"><?php echo $selected_data["qty"]; ?> Items left</p>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="toggle<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_id"] == 2) { ?> checked <?php } ?> />
                                            <label class="form-check-label" for="toggle<?php echo $selected_data["id"]; ?>">
                                                <?php echo ($selected_data["status_id"] == 1) ? "Product Deactive" : "Product Active"; ?>
                                            </label>
                                        </div>
                                        <button class="btn product-update-btn">
                                            <a class="text-decoration-none text-light" href="updateProduct.php?id=<?php echo $selected_data["id"]; ?>">Update</a>
                                        </button>
                                    </div>
                                </div>
                                <!-- card -->

                            <?php
                            }

                            ?>


                        </div>
                    </div>

                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    $e = "?page=".$pageno-1;
                                                    if(!empty($txt)){
                                                        $e.= "&search=".$txt;
                                                    }
                                                    echo $e;
                                                } ?>
                                                " aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                <?php
                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                    if ($x == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" href="<?php
                                            $e = "?page=" . ($x);
                                            if(!empty($txt)){
                                                $e.= "&search=".$txt;
                                            }
                                            echo $e;?>"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php 
                                              $e = "?page=" . ($x);
                                              if(!empty($txt)){
                                                  $e.= "&search=".$txt;
                                              }
                                              echo $e;?>
                                            "><?php echo $x; ?></a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>

                                <li class="page-item">
                                    <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    $e = "?page=" . ($pageno + 1);
                                                    if(!empty($txt)){
                                                        $e.= "&search=".$txt;
                                                    }
                                                    echo $e;
                                                } ?>
                                                " aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- product -->
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
