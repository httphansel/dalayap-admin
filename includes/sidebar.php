<?php 
    require '../config/conn.php';
?>
<style>
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

    .nav-link.active {
        border: 2px solid #000;
        /* Example border color */
        border-radius: 5px;
        /* Rounded corners */
    }
</style>
<!-- sidepanel.php -->
<aside class="border-end" style="height: 100vh; width: 250px; background-color: #FAF9F9;">
    <div class="p-3">
        <h5 class="mb-3 text-center">Dalayap, Pampanga</h5>
        <div class="border-bottom mb-3"></div>
        <ul class="nav flex-column mt-4">
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center" href="../pages/dashboard.php">
                    Dashboard
                    <span><i class="fa-solid fa-house"></i></span>
                </a>
            </li>
            <?php 
                $admin_id = $_SESSION['admin_id'];
                $adminQuery = "SELECT * FROM admin_account WHERE admin_id = '$admin_id' ";
                $adminResult = mysqli_query($conn, $adminQuery);

                if($adminResult->num_rows>0){
                    $admin = $adminResult->fetch_assoc();


                    if($admin['admin_role'] === "ADMIN"){
            ?>
            
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center" href="../pages/official.php">
                    Manage Official
                    <span><i class="fa-solid fa-user"></i></span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center" href="../pages/resident.php">
                    Resident
                    <span class="float-end"><i class="fa-solid fa-users"></i></span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center position-relative" href="../pages/blotter.php">
                    Blotter
                    <span><i class="fa-solid fa-layer-group"></i></span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center" href="../pages/transaction.php">
                    Document Request <span class="float-end"><i class="fa-solid fa-dollar-sign"></i>
                </a>
            </li>
            <?php
                }else{
            ?>
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center" href="../pages/transaction.php">
                    Transaction History <span class="float-end"><i class="fa-solid fa-dollar-sign"></i>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center" href="../pages/archived_data.php">
                    Archived Data <span class="float-end"><i class="fa-solid fa-folder"></i>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center" href="../pages/manage_admin.php">
                    Manage Admin <span class="float-end"><i class="fa-solid fa-user-tie"></i>
                </a>
            </li>
            <?php 
                }
            }
            ?>
            <li class="nav-item mb-1">
                <a class="nav-link text-secondary px-3 py-2 rounded-3 d-flex justify-content-between align-items-center" href="../pages/user_profile.php">
                    User Management <span class="float-end"><i class="fa-solid fa-user"></i></span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>