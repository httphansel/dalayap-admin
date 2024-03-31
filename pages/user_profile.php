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
    <title>ADMIN PROFILE</title>
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

        <div id="content" class="p-5 align-items-center justify-content-center">

            <div class="row text-center align-items-center justify-content-center">
                <div class="col align-items-center justify-content-center">
                    <h1 class="">Admin Profile</h1>

                    <img src="../assets/images/logo.png" class="align-self-center" alt="...">

                    <?php
                    $admin_id = $_SESSION['admin_id'];
                    $adminQuery = "SELECT * FROM admin_account WHERE admin_id = '$admin_id' ";
                    $adminResult = mysqli_query($conn, $adminQuery);
                    if ($adminResult->num_rows > 0) {
                        $admin = $adminResult->fetch_assoc();
                    ?>
                        <h5>Username: <?= $admin['admin_username'] ?></h5>
                        <h5>Phone Number: <?= $admin['admin_phone'] ?></h5>
                        <h5>Email: <?= $admin['admin_email'] ?></h5>
                        <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#resetPasswordModal<?= $admin['admin_id'] ?>">Change Password</button>

                        <div class="modal fade" id="resetPasswordModal<?= $admin['admin_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <h5 class="text-danger  mb-3">You are about to reset your password.</h5>
                                        <h5>Do you allow us to send you a link to reset your password to your registered Email?</h5>
                                        <form action="../function/reset_password.php" method="post">
                                            <input type="text" name="admin_email" value="<?= $admin['admin_email'] ?>" hidden>
                                            <input type="text" name="verification_code" value="<?= $admin['verification_code'] ?>" hidden>
                                            <button class="btn btn-outline-primary mt-3 float-end" name="resetBtn">Allow</button>
                                        </form>
                                        <button class="btn btn-secondary me-1 mt-3 float-end" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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