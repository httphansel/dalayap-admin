<?php
    require '../config/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include '../includes/links.php';
    ?>
    <title>DASHBOARD</title>
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
        border-bottom: 2px solid #000;
        /* Example border color */
    }

    .notification-dot {
        position: absolute;
        top: 50%;
        right: -10px;
        transform: translateY(-50%);
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
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
            <div class="container container-fluid p-2">
                <div class="row">
                    <?php
                    $admin_id = $_SESSION['admin_id'];

                    $adminQuery = "SELECT * FROM admin_account WHERE admin_id = '$admin_id' ";
                    $adminResult = mysqli_query($conn, $adminQuery);

                    if ($adminResult->num_rows > 0) {
                        $admin = $adminResult->fetch_assoc();
                    ?>
                        <p class="fw-bold align-self-end float-end me-3 h2">Welcome, <?= $admin['admin_username'] ?></p>
                    <?php
                    }
                    ?>
                    <?php
                    // set the default timezone
                    date_default_timezone_set('Asia/Manila');

                    // get the current date and day
                    $currentDate = date('F d, Y');
                    $currentDay = date('l');
                    $currentTime = date('h:i A');
                    ?>
                    <h3 class="mb-0 text-end"><?php echo $currentDate ?></h3>
                    <h5 class="mb-0 text-end"> <?php echo $currentDay ?></h5>
                    <h5 class="text-end"><?php echo $currentTime ?></h5>
                    <div class="border-bottom mb-3"></div>
                    <div class="col">
                        <div class="shadow-lg">
                            <div class="card p-3" style="background-color: #FEF5EF;">
                                <div class="card-body">
                                    <?php
                                    $allResident = "SELECT * FROM resident_data WHERE archive_data = 'No' ";
                                    if ($allResult = mysqli_query($conn, $allResident)) {
                                        $totalResident = mysqli_num_rows($allResult);

                                        $maleResident = "SELECT * FROM resident_data WHERE residentGender = 'Male' AND archive_data = 'No' ";
                                        if ($maleResident = mysqli_query($conn, $maleResident)) {
                                            $totalMale = mysqli_num_rows($maleResident);
                                            $malePercent = $totalMale / $totalResident * 100;
                                            $male = number_format($malePercent, 2);

                                            $femaleResident = "SELECT * FROM resident_data WHERE residentGender = 'Female' AND archive_data = 'No' ";
                                            if ($femaleResident = mysqli_query($conn, $femaleResident)) {
                                                $totalFemale = mysqli_num_rows($femaleResident);
                                                $femalePercent = $totalFemale / $totalResident * 100;
                                                $female = number_format($femalePercent, 2);

                                                $voterResident = "SELECT * FROM resident_data WHERE voterStatus = 'Registered' AND archive_data = 'No' ";
                                                if ($voterResident = mysqli_query($conn, $voterResident)) {
                                                    $totalVoter = mysqli_num_rows($voterResident);
                                                    $voterPercent = $totalVoter / $totalResident * 100;
                                                    $voter = number_format($voterPercent, 2);

                                                    $nonvoterResident = "SELECT * FROM resident_data WHERE voterStatus = 'Not Registered' AND archive_data = 'No' ";
                                                    if ($nonvoterResident = mysqli_query($conn, $nonvoterResident)) {
                                                        $totalnonVoter = mysqli_num_rows($nonvoterResident);
                                                        $nonvoterPercent = $totalnonVoter / $totalResident * 100;
                                                        $nonvoter = number_format($nonvoterPercent, 2);

                                    ?>
                                                        <h3 class="text-center mb-3">ANALYTICS</h3>
                                                        <p class="strong fw-bold mb-0">Total Population: <?= $totalResident ?></p>
                                                        <div class="progress mb-5" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $totalResident ?>" aria-valuemin="0" aria-valuemax="<?= $totalResident ?>">
                                                            <div class="progress-bar bg-secondary" style="width: 100%"><?= $totalResident ?>%</div>
                                                        </div>

                                                        <p class="strong fw-bold mb-0">Male: <?= $totalMale ?></p>
                                                        <div class="progress mb-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $male ?>" aria-valuemin="0" aria-valuemax="<?= $totalResident ?>">
                                                            <div class="progress-bar bg-info" style="width: <?= $male ?>%"><?= $male ?>%</div>
                                                        </div>
                                                        <p class="strong fw-bold mb-0">Female: <?= $totalFemale ?></p>
                                                        <div class="progress mb-5" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $female ?>" aria-valuemin="0" aria-valuemax="<?= $totalFemale ?>">
                                                            <div class="progress-bar bg-success" style="width: <?= $female ?>%"><?= $female ?>%</div>
                                                        </div>

                                                        <p class="strong fw-bold mb-0">Voters: <?= $totalVoter ?></p>
                                                        <div class="progress mb-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $voter ?>" aria-valuemin="0" aria-valuemax="<?= $totalVoter ?>">
                                                            <div class="progress-bar bg-warning" style="width: <?= $voter ?>%"><?= $voter ?>%</div>
                                                        </div>
                                                        <p class="strong fw-bold mb-0">Non-Voter: <?= $totalnonVoter ?></p>
                                                        <div class="progress mb-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $nonVoter ?>" aria-valuemin="0" aria-valuemax="<?= $totalnonVoter ?>">
                                                            <div class="progress-bar bg-danger" style="width: <?= $nonvoter ?>%"><?= $nonvoter ?>%</div>
                                                        </div>
                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- row for transaction and blotter -->
                        <div class="row">
                            <?php 
                                $admin_id = $_SESSION['admin_id'];
                                $adminQuery = "SELECT * FROM admin_account WHERE admin_id = '$admin_id' ";
                                $adminResult = mysqli_query($conn, $adminQuery);

                                if($adminResult->num_rows>0){
                                    $admin = $adminResult->fetch_assoc();

                                    if($admin['admin_role'] === "ADMIN" ){
                            ?>
                            <!-- transaction column -->
                            <div class="col">
                                <div class="shadow-lg">
                                    <div class="card p-3" style="background-color: #FEF5EF;">
                                        <a href="transaction.php" class="nav-link text-dark">
                                            <div class="card-body">
                                                <h5 class="card-title">Document Req.</h5>
                                                <?php 
                                                $documentQuery = "SELECT * FROM transaction_data WHERE request_status = 'Request' ";
                                                

                                                if($documentResult = mysqli_query($conn, $documentQuery)){
                                                    $totalRequest = mysqli_num_rows($documentResult);
                                                ?>
                                                <p class="card-text"><?= $totalRequest ?> Document Request/s</p>
                                                <?php 
                                                    
                                                }
                                                ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                    }
                                }
                            ?>
                            <!-- blotter column -->
                            <div class="col">
                                <div class="shadow-lg">
                                    <div class="card p-3" style="background-color: #FEF5EF;">
                                        <a href="blotter.php" class="nav-link text-dark">
                                            <div class="card-body">
                                                <h5 class="card-title">Blotter</h5>
                                                <?php
                                                
                                                $allBlotter = "SELECT * FROM blotter_report WHERE bArchive = 'No' AND bStatus = 'Sent' ";
                                                if ($allResult = mysqli_query($conn, $allBlotter)) {
                                                    $totalBlotter = mysqli_num_rows($allResult);
                                                ?>
                                                    <p class="card-text"><?= $totalBlotter ?> Blotter Report/s</p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p class="card-text">No Blotter Reports</p>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
    include '../includes/scripts.php';
    ?>
</body>

</html>