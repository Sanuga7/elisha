<?php
session_start();

if (isset($_SESSION["au"])) {
    include "adminheader.php";
    include "connection.php";
    $query = "SELECT * FROM `chat` ORDER BY `id` DESC";
    $result = database::search($query);
    $no = $result->num_rows;

    $pageno;

    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $results_per_page = 6;
    $number_of_pages = ceil($no / $results_per_page);

    $page_results = ($pageno - 1) * $results_per_page;
    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
    $selected_num = $selected_rs->num_rows;
?>

<!-- Main Content -->
<div class="main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        
    </div>
    <div class="container-fluid mt-5">
        <div class="row">
            <?php
            for ($i = 0; $i < $selected_num; $i++) {
                $data = $selected_rs->fetch_assoc();
            ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data["name"]; ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $data["user_email"]; ?></h6>
                            <p class="card-text"><?php echo $data["message"]; ?></p>
                            <a href="replyMessage.php?id=<?php echo $data["id"]; ?>" class="card-link text-end">Reply</a>
                        </div>
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
<?php
} else {
?>

<script>
    window.location = "index.php";
</script>
<?php
}
?>
