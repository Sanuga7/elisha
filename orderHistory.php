<?php
include "header.php";
include "connection.php";
?>

<?php
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $query = "SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id=product.id INNER JOIN `status` ON invoice.status_id = status.id WHERE invoice.user_email = '".$email."' ORDER BY invoice.date DESC";

    $pageno;

    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

?>
    <style>
        .card:hover {
            transform: scale(1.05);

        }
    </style>
    <div class="container-fluid">
        <div class="col-12 mt-3 mb-3" id="myDiv">
            <a class="text-decoration-none text-dark fs-6 fw-bold" id="porder">
                <?php
                $no_rs = Database::search($query);
                $no_num = $no_rs->num_rows;
                ?>
                All Orders(<?php echo $no_num; ?>)
            </a> &nbsp;&nbsp;
        </div>
        <div class="border border-warning"></div>

        <div class="container">
            <div class="row">
                <?php

                $results_per_page = 12;
                $number_of_pages = ceil($no_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
                $selected_num = $selected_rs->num_rows;

                for ($i = 0; $i < $selected_num; $i++) {
                    $data = $selected_rs->fetch_assoc();
                ?>
                    <div class="col-12 col-lg-3 col-md-4 mb-4">
                        <div class="card h-100 rounded-4 mt-3">
                            <?php
                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $data["product_id"] . "'");
                            $img_data = $img_rs->fetch_assoc();
                            ?>
                            <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top" alt="Short Frock">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data["title"] ?></h5>
                                <?php
                                $status = $data["status"];
                                $textClass = $status == 'pending' ? 'warning' : "primary";
                                ?>
                                <span class=" mb-2 text-center badge bg-<?php echo $textClass; ?>"><?php echo ucfirst($status); ?></span><br>

                                <button class="btn btn-success rounded-2"><a class="text-decoration-none text-light stretched-link" href="orderView.php?id=<?php echo $data["order_id"]; ?>&p=<?php echo $data['product_id']; ?>">Details</a></button>
                                <?php 
                                 
                                 if($status == "Completed"){
                                    $r = Database::search("SELECT * FROM `feedback` WHERE `user_email` = '".$_SESSION["u"]["email"]."' AND `product_id` = '".$data["product_id"]."'");
                                    $n = $r->num_rows;
                                     if($n == 0){
                                       ?><button class="btn btn-success rounded-2"><a class="text-decoration-none text-light stretched-link" href="feedback.php?id=<?php echo $data["order_id"]; ?>&p=<?php echo $data['product_id'];?>">FeedBack</a></button><?php
                                     }
                                 }
                                
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
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
                                                    echo "?page=" . ($pageno - 1);
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
                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
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
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

<?php
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
?>

<?php
include "footer.php";
?>