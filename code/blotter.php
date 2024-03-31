<?php
    require '../config/conn.php';
    session_start(); 
    
    $blotter_id = $_GET['id'];

    $blotterQuery = "UPDATE blotter_report SET `bStatus` = 'Resolved' WHERE blotter_id = '$blotter_id' ";
    $blotterResult = mysqli_query($conn, $blotterQuery);

    if($blotterResult){
        $_SESSION['message'] = "Blotter Recorded Successfully!";
        $_SESSION['icon'] = "success";
        header('Location: ../pages/blotter.php');
        exit();
    }else{
        $_SESSION['message'] = "Blotter Recording Failed!";
        $_SESSION['icon'] = "error";
        header('Location: ../pages/blotter.php');
        exit();
    }
?>