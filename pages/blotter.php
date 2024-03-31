<?php
    require '../config/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
    <?php
    include '../includes/links.php';
    ?>
    <title>BLOTTER DATA</title>
</head>

<style>
    body,
    html {
        height: 100%;
        margin: 0;
        overflow: hidden;
    }

    #wrapper {
        display: flex;
        height: 100%;
    }

    #sidepanel {
        width: 250px;
        background-color: #FFF1D0;
        overflow: hidden;
        border-right: 1px solid #ddd;
        position: fixed;
        top: 76px;
        bottom: 0;
        left: 0;
    }

    #content {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        /* Enable vertical scrollbar */
        height: 100%;
        margin-left: 250px;
        /* Adjust margin to accommodate sidebar */
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

            <div class="container" style="height: 200dvh; overflow-y: auto;">
                <?php
                // set the default timezone
                date_default_timezone_set('Asia/Manila');

                // get the current date and day
                $currentDate = date('F d, Y');
                $currentDay = date('l');
                $currentTime = date('h:i A');
                ?>
                <div class="card p-3">
                    <div class="row">
                        <div class="col-8">
                            <h1 class="text-danger ms-3 mt-3">Blotter Reports</h1>
                        </div>
                        <div class="col text-end">
                            <h3 class="mb-0"><?php echo $currentDate ?></h3>
                            <h5 class="mb-0"> <?php echo $currentDay ?></h5>
                            <h5><?php echo $currentTime ?></h5>
                        </div>
                    </div>
                    <div class="border-bottom fw-bolder mb-2"></div>
                    
                    <!-- blotter query start -->
                    <?php
                    $blotterQuery = "SELECT * FROM blotter_report WHERE bStatus = 'Sent' AND bArchive = 'No' ";
                    $blotterQueryRun = mysqli_query($conn, $blotterQuery);

                    if ($blotterQueryRun->num_rows > 0) {
                        while ($blotter = $blotterQueryRun->fetch_assoc()) {
                    ?>
                            <div class="card mx-3 mb-3">
                                <div class="card-header mb-0 p-2 fw-bold bg-">
                                    <?= $blotter['bSender'] ?>
                                    <p class="float-end">Blotter Submitted on: <?= $blotter['bDate'] ?></p>
                                </div>
                                <div class="card-body mt-0 p-3">
                                    <p class="" style="font-size: 14px;"><?= $blotter['bReport'] ?></p>
                                    <button class="btn btn-outline-danger float-end" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $blotter['blotter_id']?>">
                                        <i class="fa-solid fa-square-minus"></i>
                                    </button>

                                    <!-- modal for deleting -->
                                    <div class="modal fade" id="deleteModal<?= $blotter['blotter_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <i class="fa-solid fa-triangle-exclamation" style="font-size: 35px; color: red;"></i>
                                                    <p class="h5 mt-3">Are you sure you want to delete this report?</p>
                                                    <div class="row mt-3 float-end me-4">
                                                        <div class="col">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <a href="../code/archive.php?id=<?= $blotter['blotter_id'] ?>" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a role="button" class="btn btn-outline-success float-end me-1" data-bs-toggle="modal" data-bs-target="#summonModal<?= $blotter['blotter_id'] ?>">
                                        <i class="fa-solid fa-square-check"></i>
                                    </a>

                                    <!-- summon modal -->
                                    <div class="modal fade" id="summonModal<?= $blotter['blotter_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <p class="h5 mt-3">Send a Summon Letter to this User?</p>
                                                    <div class="row mt-3 float-end me-4">
                                                        <div class="col">
                                                            <form action="../code/blotter.php" method="post">
                                                                <input type="text" name="blotter_id" value="<?= $blotter['blotter_id'] ?>" hidden>
                                                                <input type="text" name="user_fullname" value="<?= $blotter['bSender'] ?>" hidden>
                                                                <input type="text" name="user_email" value="<?= $blotter['user_email'] ?>" hidden>
                                                                <button class="btn btn-outline-success ms-1" name="summonBtn">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                    ?>
                    <p class="text-center mt-3 fw-bold">No Blotter Reports at the moment</p>
                    <?php 
                    }
                    ?>
                    <!-- blotter query end -->
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