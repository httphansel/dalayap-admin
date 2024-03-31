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
    <title>MANAGE ADMIN</title>
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

            <div class="container p-3">
                <h1>Manage Admin Accounts</h1>
                <div class="border-bottom mb-3"></div>

                <table class="table table-warning table-hover table-bordered">
                    <thead class="bg-danger">
                        <tr>
                            <th>Admin ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <?php
                    $adminQuery = "SELECT * FROM admin_account WHERE verification_status = '1' AND archive_status = 'No' ";
                    $adminQueryResult = mysqli_query($conn, $adminQuery);

                    if ($adminQueryResult->num_rows > 0) {
                        while ($admin = $adminQueryResult->fetch_assoc()) {
                    ?>
                            <tbody>
                                <tr>
                                    <td><?= $admin['admin_id'] ?></td>
                                    <td><?= $admin['admin_username'] ?></td>
                                    <td><?= $admin['admin_email'] ?></td>
                                    <td><?= $admin['admin_phone'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#deleteAdmin<?= $admin['admin_id'] ?>">
                                            <i class="fa-solid fa-user-xmark"></i>
                                        </button>

                                        <!-- delete admin modal -->
                                        <div class="modal fade" id="deleteAdmin<?= $admin['admin_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <div class="modal-body text-center p-3">
                                                        <h5>Are you sure you want to delete this admin?</h5>
                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <a href="../code/delete_admin.php?admin_id=<?= $admin['admin_id'] ?>" class="btn btn-outline-danger fw-bold">Delete</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
            </div>
            </td>
            </tr>
            </tbody>
    <?php
                        }
                    }
    ?>
    </table>
    <button class="btn btn-outline-primary float-end fw-bold" data-bs-toggle="modal" data-bs-target="#addAdminAccount">Add Admin</button>
    <div class="modal fade" id="addAdminAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body p-3">
                    <h5>Add an admin account <span class="lead">(NOTE: Only Super Admin / Lead Admin can access this page.)</span></h5>
                    <div class="row p-4">
                        <form action="../code/admin_code.php" method="post">
                            <div class="col">
                                <label for="admin_username" class="form-label fw-bold">Username:</label>
                                <input type="text" class="form-control mb-3" name="admin_username" autocomplete="off" required>
                                <label for="admin_password" class="form-label fw-bold">Password:</label>
                                <input type="password" class="form-control mb-3" name="admin_password" autocomplete="off" required>
                                <label for="admin_email" class="form-label fw-bold">Email:</label>
                                <input type="email" class="form-control mb-3" name="admin_email" autocomplete="off" required>
                                <label for="admin_phone" class="form-label fw-bold">Phone no.:</label>
                                <input type="number" class="form-control mb-3" name="admin_phone" autocomplete="off" required>
                                <button class="btn btn-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-outline-primary" name="addBtn">Register</button>
                            </div>
                        </form>
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