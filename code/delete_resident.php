<?php
    require '../config/conn.php';
    session_start();

    $id = $_GET['id'];

    $archiveDataQuery = "UPDATE resident_data SET `archive_data` = 'Yes' WHERE id = '$id' ";
    $archiveDataResult = mysqli_query($conn, $archiveDataQuery);

    if($archiveDataResult){
        $_SESSION['message'] = "Data Deleted Successfully!";
        $_SESSION['icon'] = "success";
        header('Location: ../pages/resident.php');
        exit();
    }
?>