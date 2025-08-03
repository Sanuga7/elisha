<?php
include "adminheader.php";
include "connection.php";
?>
<!-- Main Content -->
<div class="main-content">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
    <h1 class="text-dark">Order List</h1>
  </div>

  <style>
    .table thead th {
      background-color: #f76838;
      color: white;
    }

    .badge {
      font-size: 1em;
    }
  </style>

  <div class="container mt-2">
    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer</th>
                <th scope="col">Date</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
              } else {
                $pageno = 1;
              }

              $rs = Database::search("SELECT * FROM `invoice`");
              $num = $rs->num_rows;

              $results_per_page = 10;
              $number_of_pages = ceil($num / $results_per_page);

              $page_results = ($pageno - 1) * $results_per_page;
              $selected_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `user` ON invoice.user_email = user.email INNER JOIN `status` ON invoice.status_id=status.id 
                                  ORDER BY `date` DESC  LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

              $selected_num = $selected_rs->num_rows;

              if ($num > 0) {
                for ($i = 0; $i < $selected_num; $i++) {
                  $data = $selected_rs->fetch_assoc();
                  $oid = $data["order_id"];
              ?>
                  <tr>
                    <td onclick="vo('<?php echo $data['order_id']; ?>')"><?php echo $data["order_id"]; ?></td>
                    <td onclick="vo('<?php echo $data['order_id']; ?>')"><?php echo $data["fname"] . " " . $data["lname"]; ?></td>
                    <td onclick="vo('<?php echo $data['order_id']; ?>')" class="text-dark"><?php echo $data["date"]; ?></td>
                    <td onclick="vo('<?php echo $data['order_id']; ?>')">Rs.<?php echo $data["total"]; ?>.00</td>
                    <?php
                    if ($data["status"] == "Pending") {
                    ?>
                      <td>
                        <span class="fs-6 p-1 bg-warning text-light"><?php echo $data["status"]; ?></span>
                      </td>
                    <?php
                    } else if ($data["status"] == "Completed") {
                    ?>
                      <td>
                        <span class="fs-6 p-1 bg-success text-light"><?php echo $data["status"]; ?></span>
                      </td>
                    <?php
                    } else if ($data["status"] == "Inactive") {
                    ?>
                      <td>
                        <span class="fs-6 p-1 bg-danger text-light"><?php echo $data["status"]; ?></span>
                      </td>
                    <?php
                    } else {
                    ?>
                      <td>
                        <span class="fs-6 p-1 bg-primary text-light"><?php echo $data["status"]; ?></span>
                      </td>
                    <?php
                    }
                    ?>
                    <td>
                      <select name="status" id="status-<?php echo $data['order_id']; ?>" onchange="check('<?php echo $data['order_id']; ?>');">
                        <option value="0">Update Status</option>
                        <?php
                        $srs = Database::search("SELECT * FROM `status`");
                        $snum = $srs->num_rows;

                        for ($x = 0; $x < $snum; $x++) {
                          $sdata = $srs->fetch_assoc();
                        ?>
                          <option value="<?php echo $sdata["id"]; ?>"><?php echo $sdata["status"]; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
              <!-- Repeat similar rows for other orders -->
            </tbody>
          </table>
        </div>
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

  <script>
    function check(order_id) {

      var status = document.getElementById("status-" + order_id);

      var form = new FormData();
      form.append("order_id", order_id);
      form.append("status", status.value);
      
      var request = new XMLHttpRequest();
      request.onreadystatechange =function() {
        if (request.readyState == 4 && request.status == 200) {
          if(request.responseText == "success") {
            window.location.reload();
          }else{
            alert(request.responseText);
          }
        }
      }
      request.open("POST", "updateOrderStatus.php", true);
      request.send(form);
    }

    function vo(order_id) {
      window.location = "viewOrder.php?id="+order_id;
    }
  </script>
