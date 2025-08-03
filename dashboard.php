<?php
session_start();

if (isset($_SESSION["au"])) {
    
    include "adminheader.php";
    include "connection.php";
    function fetchOrderData()
    {
        $query = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(id) AS order_count, SUM(total) AS total_earnings 
                  FROM invoice 
                  GROUP BY DATE_FORMAT(date, '%Y-%m') 
                  ORDER BY month";

        $result = Database::search($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    $orderData = fetchOrderData();
?>
    ?>
    <style>
        .custom-card {
            background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .custom-card1 {
            background: linear-gradient(135deg, #26ff00 0%, #84ff00 100%);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .custom-card2 {
            background: linear-gradient(135deg, #ff9100 0%, #ffdd00 100%);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .custom-card3 {
            background: linear-gradient(135deg, #ff0022 0%, #ff0084 100%);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .custom-card:hover {
            transform: scale(1.05);
        }

        .custom-card1:hover {
            transform: scale(1.05);
        }

        .custom-card2:hover {
            transform: scale(1.05);
        }

        .custom-card3:hover {
            transform: scale(1.05);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: space-between;
            height: 100%;
        }

        .fa-shopping-bag {
            align-self: flex-end;
            opacity: 0.8;
        }

        .fa-user {
            align-self: flex-end;
            opacity: 0.8;
        }

        .fa-dollar-sign {
            align-self: flex-end;
            opacity: 0.8;
        }

        .align-right {
            margin-left: auto;
        }
    </style>

    <body>

        <div class="main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 col-lg-3 col-md-6">
                        <div class="card custom-card mb-2 me-2">
                            <div class="card-body">
                                <?php

                                $month = date('m');
                                $count = 0;

                                $rs = Database::search("SELECT * FROM `user`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                                    $new = new DateTime($d['joined_date']);

                                    $dmonth = $new->format('m');

                                    if ($month == $dmonth) {
                                        $count = $count + 1;
                                    }
                                }

                                ?>
                                <h3 class="card-title text-light fw-bold"><?php echo $count; ?></h3>
                                <p class="text-light fw-bold">New Users</p>
                                <i class="fa-solid fa-user fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 col-md-6">
                        <div class="card custom-card1 bg-success mb-2 me-2">
                            <div class="card-body">
                                <?php

                                $month = date('m');
                                $count = 0;

                                $rs = Database::search("SELECT * FROM `invoice`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                                    $new = new DateTime($d['date']);

                                    $dmonth = $new->format('m');

                                    if ($month == $dmonth) {
                                        $count = $count + 1;
                                    }
                                }

                                ?>
                                <h3 class="card-title text-light fw-bold"><?php echo $count; ?></h3>
                                <p class="text-light fw-bold">New Orders</p>
                                <i class="fa-solid fa-shopping-bag fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-6">
                        <div class="card custom-card2 bg-success mb-2 me-2">
                            <div class="card-body">
                                <?php

                                $e = Database::search("SELECT COUNT(DISTINCT id) AS total_order FROM `invoice`")->fetch_assoc();

                                ?>
                                <h3 class="card-title text-light fw-bold"><?php echo $e["total_order"]; ?></h3>
                                <p class="text-light fw-bold">All Orders</p>
                                <i class="fa-solid fa-shopping-bag fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-6">
                        <div class="card custom-card3 bg-success mb-2 me-2">
                            <div class="card-body">
                                <?php

                                $e = Database::search("SELECT SUM(total) AS earn FROM `invoice`")->fetch_assoc();
                                $total_earnings = $e['earn'] ? number_format($e['earn'], 2) : '0.00';

                                ?>
                                <h3 class="card-title text-light fw-bold">Rs.<?php echo $total_earnings; ?></h3>
                                <p class="text-light fw-bold">Total Earnings</p>
                                <i class="fa-solid fa-dollar-sign fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Orders per Month<a class="fs-6 text-decoration-none" href="orderReport.php">(Report)</a></h5>
                                <canvas id="ordersChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Earnings per Month<a class="fs-6 text-decoration-none" href="earningReport.php">(Report)</a></h5>
                                <canvas id="earningsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-4">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table">
                                <h6 class="d-flex align-items-center mb-3"><a href="userReport.php" class="text-decoration-none text-dark" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Click here to get a user report"><i class="material-icons text-info mr-2">User</i>Report</a></h6>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $u = Database::search("SELECT * FROM `user` ORDER BY `joined_date` DESC LIMIT 4");
                                    $n = $u->num_rows;

                                    for ($y = 0; $y < $n; $y++) {
                                        $udata = $u->fetch_assoc();
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $y + 1; ?></th>
                                            <td><?php echo $udata["fname"]; ?></td>
                                            <td><?php echo $udata["lname"]; ?></td>
                                            <td><?php
                                                if ($udata["status_id"] == '1') {
                                                ?>Active<?php
                                                        } else {
                                                            ?>Inactive<?php
                                                        }
                                                            ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-4">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table">
                                <h6 class="d-flex align-items-center mb-3"><a href="productReport.php" class="text-decoration-none text-dark" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Click here to get a Product report"><i class="material-icons text-info mr-2">Product</i>Report</a></h6>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">price</th>
                                        <th scope="col">qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $p = Database::search("SELECT * FROM `product` WHERE `status_id` = '1' ORDER BY `added_time` DESC LIMIT 4 ");
                                    $n = $p->num_rows;

                                    for ($y = 0; $y < $n; $y++) {
                                        $udata = $p->fetch_assoc();
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $y + 1; ?></th>
                                            <td><?php echo $udata["title"]; ?></td>
                                            <td><?php echo $udata["price"]; ?></td>
                                            <td><?php echo $udata["qty"]; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Orders per Month Chart
            var ordersData = <?php echo json_encode($orderData); ?>;
            var ordersLabels = ordersData.map(item => item.month);
            var ordersCounts = ordersData.map(item => item.order_count);

            var ordersChart = new Chart(document.getElementById('ordersChart'), {
                type: 'bar',
                data: {
                    labels: ordersLabels,
                    datasets: [{
                        label: 'Orders',
                        data: ordersCounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Orders'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });

            // Earnings per Month Chart
            var earningsData = ordersData.map(item => item.total_earnings);
            var earningsChart = new Chart(document.getElementById('earningsChart'), {
                type: 'line',
                data: {
                    labels: ordersLabels,
                    datasets: [{
                        label: 'Earnings',
                        data: earningsData,
                        fill: false,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Earnings'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            });
        </script>

        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="assets/js/dashboard.js"></script>
    </body>

    </html>


<?php
} else {
    // Redirect to login if session is not set
    header("Location: index.php");
    exit();
}
?>