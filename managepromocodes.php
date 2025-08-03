<?php
session_start();

if (isset($_SESSION["au"])) {
    include "adminheader.php";
    include "connection.php";
?>

    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h1 class="text-dark">Order List</h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end mb-3 mt-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-square-plus"></i> ADD</button>
                    </div>
                    <table class="table ms-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Promo Code</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM `promo_code`";
                            $pageno;

                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $rs = Database::search($query);
                            $no = $rs->num_rows;

                            $results_per_page = 8;
                            $number_of_pages = ceil($no / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;
                            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
                            $selected_num = $selected_rs->num_rows;

                            for ($z = 0; $z < $selected_num; $z++) {
                                $pdata = $selected_rs->fetch_assoc();
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $z + 1; ?></th>
                                    <td><?php echo $pdata["code"]; ?></td>
                                    <td><?php echo $pdata["percentage"] ?>%</td>
                                    <td><?php
                                        if ($pdata["status_id"] == 1) {
                                        ?><button class="btn btn-success" onclick="promoStatus(<?php echo $pdata['id']; ?>);">Active</button><?php
                                                                                                                                            } else {
                                                                                                                                                ?><button class="btn btn-danger" onclick="promoStatus(<?php echo $pdata['id']; ?>);">Deactive</button><?php
                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                        ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
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
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add a promo code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="code">Promo Code</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control form form-control-lg bg-light fs-6" id="code" name="code">
                        </div>
                        <label for="per">Percentage</label><br>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control form form-control-lg bg-light fs-6" id="per">
                            <button class="btn btn-outline-secondary" id="ten" type="button">%</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addpromo();">Add promo</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/main.js"></script>
    <?php

} else {
    ?>
        <script>
            window.location = "index.php";
        </script>
    <?php
}
    ?>