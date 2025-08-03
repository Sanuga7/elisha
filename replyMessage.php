<?php
session_start();

if (isset($_SESSION["au"]) && isset($_GET["id"])) {
    include "adminheader.php";
    include "connection.php";
    $id = $_GET["id"];
?>

    <div class="container-fluid main-content py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom pb-2 mb-3">
            <h1 class="h2 text-dark"></h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Reply to Messages</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mt-1">
                                <div class="col-12">
                                    <?php

                                    $rs = Database::search("SELECT * FROM `chat` WHERE `id` = '" . $id . "' ");
                                    $data = $rs->fetch_assoc();

                                    ?>
                                    <h5>Customer Name: <span class="text-secondary"><?php echo $data["name"]; ?></span></h5>
                                    <h5>Customer Email: <span class="text-secondary"><?php echo $data["user_email"]; ?></span></h5>
                                    <h5>Customer Message: <span class="text-secondary"><?php echo $data["message"] ?></span></h5>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <?php

                                $rs1 = Database::search("SELECT * FROM `reply` WHERE `chat_id` = '" . $id . "' ");
                                $num1 = $rs1->num_rows;

                                if ($num1 == 0) {
                                ?>

                                    <div class="col-12">
                                        <label for="msg" class="form-label">Reply Message</label>
                                        <textarea name="msg" id="msg" class="form-control" placeholder="Enter your Reply Here" cols="30" rows="8"></textarea>
                                    </div>

                                <?php
                                } else {
                                    $data = $rs1->fetch_assoc();
                                ?>

                                    <div class="col-12">
                                        <label for="msg" class="form-label">Reply Message</label>
                                        <textarea name="msg" disabled id="msg" class="form-control" placeholder="Enter your Reply Here" cols="30" rows="8"><?php echo $data["reply"]; ?></textarea>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success" onclick="replyMsg(<?php echo $data['id']; ?>);">Send Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
} else {
?>

    <script>
        window.location = "index.php";
    </script>
<?php
}
?>