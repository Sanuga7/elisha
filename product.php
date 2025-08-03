<?php
include "header.php";
include "connection.php";

if (isset($_GET["page"])) {
    $pageno = $_GET["page"];
} else {
    $pageno = 1;
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : 0;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : 0;
$minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : 0;
$maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : 0;
$color = isset($_GET['color']) ? $_GET['color'] : 0;

$query = "SELECT * FROM `product` ";

if ($color > 0) {
    $query .= "INNER JOIN `colour_has_product`  ON product.id=colour_has_product.product_id  ";
}

$query.= "WHERE `status_id`='1'";

if ($search !== '') {
    $query .= " AND `title` LIKE '%$search%'";
}

if ($category > 0) {
    $query .= " AND `category_cat_id` = '$category' ";
}

if ($minPrice > 0) {
    $query .= " AND `price` >= '$minPrice' ";
}

if ($maxPrice > 0) {
    $query .= " AND `price` <= '$maxPrice' ";
}

if ($color > 0) {
    $query .= " AND `colour_color_id` = '$color' ";
}

switch ($sort) {
    case 1:
        $query .= " ORDER BY `price` ASC";
        break;
    case 2:
        $query .= " ORDER BY `price` DESC";
        break;
    case 3:
        $query .= " ORDER BY `added_time` DESC";
        break;
    default:
        $query .= " ORDER BY `added_time` DESC";
        break;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;
$results_per_page = 12;
$number_of_pages = ceil($product_num / $results_per_page);
$page_results = ($pageno - 1) * $results_per_page;
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);
$selected_num = $selected_rs->num_rows;

?>

<link rel="stylesheet" href="assets/css/tezt.css">
<style>
  .card1:hover {
    transform: scale(1.05); 
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="input-group my-3">
                <select name="sort" class="form-select col-md-3 me-3" id="sort">
                    <option value="0">Sort By</option>
                    <option value="1" <?php if ($sort == 1) echo 'selected'; ?>>Price: Low</option>
                    <option value="2" <?php if ($sort == 2) echo 'selected'; ?>>Price: High</option>
                    <option value="3" <?php if ($sort == 3) echo 'selected'; ?>>Newest</option>
                </select>
                <input type="text" id="txt" class="form-control col-md-8" placeholder="Search products" value="<?php echo htmlspecialchars($search); ?>" aria-label="Search products" aria-describedby="button-search">
                <button class="btn btn-wish col-md-1" type="button" id="button-search" onclick="search(1);">Search</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Advanced Search</h5>
                    <hr>
                    <?php 
                    
                     $cat_rs = Database::search("SELECT * FROM `category`");
                     $cnum = $cat_rs->num_rows;

                    ?>
                    <select name="cat" class="form-select mt-4" id="advancedCat">
                        <option value="0">Select Category</option>
                        <?php
                         
                         for ($i=0; $i < $cnum; $i++) { 
                           $cdata = $cat_rs->fetch_assoc();
                           ?><option value="<?php echo $cdata["cat_id"]; ?>" <?php if ($category == $cdata["cat_id"]) echo 'selected'; ?>><?php echo $cdata["category_name"]; ?></option><?php
                         }
                        
                        ?>
                    </select>
                    <div class="mt-4">
                        <label for="minPrice" class="form-label">Min Price</label>
                        <input type="number" class="form-control" id="minPrice" placeholder="" value="<?php if($minPrice > 0){echo $minPrice;} ?>">
                    </div>
                    <div class="mt-4">
                        <label for="maxPrice" class="form-label">Max Price</label>
                        <input type="number" class="form-control" id="maxPrice" placeholder="" value="<?php if($maxPrice > 0){echo $maxPrice;} ?>">
                    </div>
                    <select name="cat" class="form-select mt-4" id="advancedColor">
                       <option value="0">Select Colour</option>
                      <?php
                      
                        $co_rs = Database::search("SELECT * FROM `colour`");
                        $cno = $co_rs->num_rows;

                        for ($x=0; $x < $cno; $x++) { 
                          $colo = $co_rs->fetch_assoc();
                          ?><option value="<?php echo $colo["color_id"]; ?>" <?php if ($color == $colo["color_id"]) echo 'selected'; ?>><?php echo $colo["color_name"]; ?></option><?php
                        }

                      ?>
                    </select>
                    <hr>
                    <button class="btn btn-wish" onclick="advancedSearch(1);">Filter Search</button>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="col-12 mt-3 mb-3">
                <a href="#" class="text-decoration-none text-dark fs-5 fw-bold" id="wd">
                    Products
                </a> &nbsp;&nbsp;
                <a class="text-decoration-none text-dark fs-6"><i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <!-- products -->

            <div class="col-12" id="basicSearchResult">
                <div class="row">
                    <?php

                    for ($z = 0; $z < $selected_num; $z++) {
                        $selected_data = $selected_rs->fetch_assoc();
                    ?>

                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card card1 rounded-4 mt-2 mb-2" style="width: 100%;">
                                <a class="text-decoration-none text-dark" href="productView.php?id=<?php echo $selected_data["id"];  ?>">
                                    <?php
                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();
                                    ?>
                                    <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top rounded-4 mt-2 c-img" style="height: 180px;" />
                                    <div class="card-body text-center">
                                        <h5 class="card-title fw-bold fs-6 stretched-link"><?php echo $selected_data["title"]; ?></h5>
                                        <span class="card-text text-success stretched-link">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                        <?php
                                        if ($selected_data["qty"] > 0) {
                                        ?>
                                            <span class="card-text text-success fw-bold">In Stock</span><br /><br>
                                            <a href='<?php echo "productView.php?id=" . ($selected_data["id"]); ?>' class="col-12 btn hover stretched-link btn-wish">Buy Now</a>
                                            <button class="col-12 btn btn-dark mt-2">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </button>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="card-text text-danger fw-bold">Out of Stock</span><br /><br>
                                            <a href='#' class="col-12 btn btn-success disabled">Buy Now</a>
                                            <button class="col-12 btn btn-dark mt-2 disabled">
                                                <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </a>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    $p = "?page=" . ($pageno - 1);
      
                                                    if($sort > 0){
                                                      $p.= "&sort=$sort";
                                                     }
      
                                                     if(!empty($search)){
                                                      $p.= "&search=$search";
                                                     }
      
                                                     if($category > 0){
                                                      $p .= "&category=$category";
                                                     }
      
                                                     if($minPrice > 0){
                                                      $p.= "&minPrice=$minPrice";
                                                     }
      
                                                     if($maxPrice > 0){
                                                      $p.= "&maxPrice=$maxPrice";
                                                     }
      
                                                     if($color > 0){
                                                      $p.= "&color=$color";
                                                     }
                                                    echo $p;
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
                                            <?php
                                              
                                              $p = "?page=" . ($x);

                                              if($sort > 0){
                                                $p.= "&sort=$sort";
                                               }

                                               if(!empty($search)){
                                                $p.= "&search=$search";
                                               }

                                               if($category > 0){
                                                $p .= "&category=$category";
                                               }

                                               if($minPrice > 0){
                                                $p.= "&minPrice=$minPrice";
                                               }

                                               if($maxPrice > 0){
                                                $p.= "&maxPrice=$maxPrice";
                                               }

                                               if($color > 0){
                                                $p.= "&color=$color";
                                               }
                                            ?>
                                            <a class="page-link" href="<?php echo $p; ?>"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                        <?php
                                              
                                              $p = "?page=" . ($x);

                                              if($sort > 0){
                                                $p.= "&sort=$sort";
                                               }

                                               if(!empty($search)){
                                                $p.= "&search=$search";
                                               }

                                               if($category > 0){
                                                $p .= "&category=$category";
                                               }

                                               if($minPrice > 0){
                                                $p.= "&minPrice=$minPrice";
                                               }

                                               if($maxPrice > 0){
                                                $p.= "&maxPrice=$maxPrice";
                                               }

                                               if($color > 0){
                                                $p.= "&color=$color";
                                               }
                                            ?>
                                            <a class="page-link" href="<?php echo $p; ?>"><?php echo $x; ?></a>
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
                                                    $p = "?page=" . ($pageno + 1);
      
                                                    if($sort > 0){
                                                      $p.= "&sort=$sort";
                                                     }
      
                                                     if(!empty($search)){
                                                      $p.= "&search=$search";
                                                     }
      
                                                     if($category > 0){
                                                      $p .= "&category=$category";
                                                     }
      
                                                     if($minPrice > 0){
                                                      $p.= "&minPrice=$minPrice";
                                                     }
      
                                                     if($maxPrice > 0){
                                                      $p.= "&maxPrice=$maxPrice";
                                                     }
      
                                                     if($color > 0){
                                                      $p.= "&color=$color";
                                                     }
                                                    echo $p;
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
        </div>
    </div>
</div>

<?php
include "footer.php";
?>

