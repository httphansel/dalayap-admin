<?php 
    require '../config/conn.php';
    session_start();

    $admin_id = $_GET['admin_id'];

    $deleteAdminQuery = "UPDATE admin_account SET `archive_status` = 'Yes' WHERE admin_id = '$admin_id' ";
    $deleteAdminResult = mysqli_query($conn, $deleteAdminQuery);

    if($deleteAdminResult){
        $_SESSION['message'] = "Admin Deleted!";
        $_SESSION['icon'] = "success";
        header('Location: ../pages/manage_admin.php');
        exit();
    }
?>