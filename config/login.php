<?php 
    require 'conn.php';
    session_start();

    if(isset($_POST['loginBtn'])){

        $adminUsername = mysqli_real_escape_string($conn, $_POST['adminUsername']);
        $adminPassword = mysqli_real_escape_string($conn, $_POST['adminPassword']);

        $adminQuery = "SELECT *  FROM admin_account WHERE admin_username = '$adminUsername' AND admin_password = '$adminPassword'";
        $queryRun = mysqli_query($conn, $adminQuery);

        if($queryRun->num_rows > 0){
            $admin = $queryRun->fetch_assoc();

            if($admin['verification_status'] === "0"){
                $_SESSION['message'] = "Verify Email first!";
                $_SESSION['icon'] = "error";
                header('Location: ../index.php');
                exit();
            }else{
                $_SESSION['message'] = "Log In Successful!";
                $_SESSION['icon'] = "success";
                $_SESSION['admin_username'] = $admin['admin_username'];
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_role'] = $admin['admin_role'];
                header('Location: ../pages/dashboard.php');
                exit();
            }
        }else{
            $_SESSION['message'] = "Invalid Username or Password";
            $_SESSION['icon'] = "error";
            header('Location: ../index.php');
            exit();
        }
    }
?>