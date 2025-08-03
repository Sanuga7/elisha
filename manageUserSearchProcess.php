<?php

include "connection.php";

$query = "SELECT * FROM `user`";

if (isset($_POST["s"])) {

    $txt = $_POST["s"];
    $query .= "WHERE `fname` LIKE '%" . $txt . "%' OR `lname` LIKE '%" . $txt . "%'";

?>

    <div class="col-lg-12 col-sm-3 col-xs-3 col-md-12">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $rs = Database::search($query);
                $num = $rs->num_rows;

                $results_per_page = 6;
                $number_of_pages = ceil($num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs = Database::search($query."LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $data = $selected_rs->fetch_assoc();

                ?>
                    <tr>

                        <td><?php echo $x+1; ?></td>
                        <td><?php echo $data["fname"] . " " . $data["lname"]; ?></td>
                        <td><?php echo $data["email"]; ?></td>
                        <?php
                        $status = $data["status_id"];
                        if ($status == 1) {
                        ?>
                            <td width="70" class="trash" onclick="userstatus('<?php echo $data['email']; ?>');">
                                <button class="btn btn-success" onclick="user('<?php echo $data['email']; ?>');">Active</button>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td width="70" class="trash" onclick="userstatus2('<?php echo $data['email']; ?>');">
                                <button class="btn btn-danger" onclick="userstatus2('<?php echo $data['email']; ?>');">Inactive</button>
                            </td>
                        <?php
                        }
                        ?>

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

<?php
}
