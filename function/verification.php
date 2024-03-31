<?php 
    require '../config/conn.php';
    session_start();

    if(isset($_GET['verification_code'])){
        
        $verification_code = $_GET['verification_code'];
        $verifyEmailQuery = "SELECT * FROM admin_account WHERE verification_code = '$verification_code' ";
        $verifyEmailResult = mysqli_query($conn, $verifyEmailQuery);

        if(mysqli_num_rows($verifyEmailResult)>0){

            $admin = mysqli_fetch_array($verifyEmailResult);
            if($admin['verification_status'] == "0"){
                $admin_id = $admin['admin_id'];
                $verifyEmail = "UPDATE admin_account SET `verification_status` = '1' WHERE admin_id = '$admin_id' ";
                $verifyResult = mysqli_query($conn, $verifyEmail);

                if($verifyResult){
                    $_SESSION['message'] = "Email verified successfully! Proceed to Log In.";
                    $_SESSION['icon'] = "success";
                    header('Location: ../index.php');
                    exit();
                }else{
                    $_SESSION['message'] = "Verification Failed";
                    $_SESSION['icon'] = "error";
                    header('Location: ../index.php');
                    exit();
                }
            }else{
                $_SESSION['message'] = "Email Already Verified!";
                $_SESSION['icon'] = "warning";
                header('Location: ../index.php');
                exit();
            }
        }
    }
?>