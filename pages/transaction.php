<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include '../includes/links.php';
    ?>
    <title>TRANSACTION DATA</title>
</head>
<style>
    body,
    html {
        overflow: hidden;
        /* disable scrolling */
        height: 100dvh;
    }

    #wrapper {
        display: flex;
        height: 100dvh;
    }

    #sidepanel {
        width: 250px;
        background-color: #FFF1D0;
        overflow: hidden;
        border-right: 1px solid #ddd;
    }

    #content {
        flex: 1;
        padding: 20px;
        overflow: hidden;
    }

    .nav-link.active {
        border: 2px solid #000;
        /* Example border color */
        border-radius: 5px;
        /* Rounded corners */
    }
</style>

<body>
    <?php
    include '../includes/navbar.php';
    ?>
    <div id="wrapper">
        <aside id="sidepanel">
            <?php
            include '../includes/sidebar.php';
            ?>
        </aside>

        <div id="content">
            <h2>TRANSACTIONS</h2>
            <div class="shadow-sm m-3">
                <div class="border-top"></div>
                <div class="container p-5">
                    <div class="row">
                        <!-- to process -->
                        <div class="col">
                            <?php
                            $admin_id = $_SESSION['admin_id'];
                            $adminQuery = "SELECT * FROM admin_account WHERE admin_id = '$admin_id' ";
                            $adminResult = mysqli_query($conn, $adminQuery);
                            if ($adminResult->num_rows > 0) {
                                while ($admin = $adminResult->fetch_assoc()) {
                                    if ($admin['admin_role'] === "ADMIN") {
                            ?>
                                        <div class="card mb-3">
                                            <div class="card-header bg-warning fw-bold">
                                                Document Request
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <?php
                                                $requestQuery = "SELECT * FROM transaction_data WHERE request_status = 'Request' ORDER BY request_date ASC";
                                                $requestResult = mysqli_query($conn, $requestQuery);
                                                if ($requestResult->num_rows > 0) {
                                                    while ($request = $requestResult->fetch_assoc()) {
                                                ?>
                                                        <li class="list-group-item py-2 text-start fw-bold"><?= $request['user_fullname'] ?> / <?= $request['document_type'] ?> / <?= $request['user_purpose'] ?>
                                                            <span class="float-end">
                                                                <a href="../code/print_document.php?transaction_id=<?= $request['transaction_id'] ?>" class="btn btn-outline-success ms-1">
                                                                    <i class="fa-solid fa-print"></i>
                                                                </a>
                                                            </span>
                                                            <span class="float-end me-2">Requested on: <?= $request['request_date'] ?></span>
                                                        </li>

                                                <?php
                                                    }
                                                } else {
                                                    echo "<li class='list-group-item py-2 text-start'>No requests found</li>";
                                                }
                                            } elseif ($admin['admin_role'] === "SUPER ADMIN") {
                                                ?>
                                                <div class="card mb-3">
                                                    <div class="card-header bg-success fw-bold  text-light  ">
                                                        Document Request History <div class="border-bottom"></div>
                                                        <span class="text-start">Customer / Document / Purpose</span>
                                                    </div>
                                                    <?php
                                                    $requestQuery = "SELECT * FROM transaction_data WHERE request_status = 'Processed' ORDER BY completion_date ASC";
                                                    $requestResult = mysqli_query($conn, $requestQuery);
                                                    if ($requestResult->num_rows > 0) {
                                                        while ($request = $requestResult->fetch_assoc()) {
                                                    ?>
                                                            <li class="list-group-item py-2 text-start fw-bold mx-2"><?= $request['user_fullname'] ?> / <?= $request['document_type'] ?> / <?= $request['user_purpose'] ?>
                                                                <span class="float-end me-2">Completed on: <?= $request['completion_date'] ?></span>
                                                                <div class="border-bottom"></div>
                                                            </li>
                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                            </ul>

                                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- closing div #content -->
        </div>
        <!-- closing div #wrapper -->
    </div>

    <?php
    include '../includes/scripts.php';
    ?>
</body>

</html>