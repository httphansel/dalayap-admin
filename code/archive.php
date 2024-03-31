<?php
    require '../config/conn.php';

/* blotter deleting query */
        session_start(); 
        
        $blotter_id = $_GET['id'];

        $deleteQuery = "UPDATE blotter_report SET `bArchive` = 'Yes' WHERE  blotter_id = '$blotter_id' ";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if($deleteResult){
            $_SESSION['message'] = "Blotter deleted successfully!";
            $_SESSION['icon'] = "success";
            header('Location: ../pages/blotter.php');
            exit();
        }else{
            $_SESSION['message'] = "Error deleting blotter report";
            $_SESSION['icon'] = "error";
            header('Location: ../pages/blotter.php');
            exit();
        }

?>