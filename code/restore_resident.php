<?php
    require '../config/conn.php';
    session_start();

    $id = $_GET['id'];

    $restoreDataQuery = "UPDATE resident_data SET `archive_data` = 'No' WHERE id = '$id' ";
    $restoreDataResult = mysqli_query($conn, $restoreDataQuery);

    if($restoreDataResult){
        $_SESSION['message'] = "Data Restored Successfully!";
        $_SESSION['icon'] = "success";
        header('Location: ../pages/resident.php');
        exit();
    }
?>