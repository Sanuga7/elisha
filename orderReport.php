<?php

include "connection.php";
session_start();

if (isset($_SESSION["au"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Order Report</title>
        <link rel="favicon" href="assets/images/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container-fluid" id="body">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary mb-3 mt-2" id="btn" onclick="printReport();">Print</button>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order_id</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $u = Database::search("SELECT * FROM `invoice` INNER JOIN `status` ON invoice.status_id=status.id ORDER BY `date` DESC");
                            $n = $u->num_rows;

                            for ($y = 0; $y < $n; $y++) {
                                $udata = $u->fetch_assoc();
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $y + 1; ?></th>
                                    <td><?php echo $udata["order_id"]; ?></td>
                                    <td><?php echo $udata["total"]; ?></td>
                                    <td><?php echo $udata["quantity"]; ?></td>
                                    <td><?php echo $udata["date"]; ?></td>
                                    <td><?php echo $udata["status"]; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            function printReport() {
                var restorePage = document.body.innerHTML;
                var btn = document.getElementById("btn");
                btn.classList.toggle("d-none");
                var page = document.getElementById("body").innerHTML;
                document.body.innerHTML = page;
                window.print();
                document.body.innerHTML = restorePage;
            }
        </script>
    </body>

    </html>
<?php
}
