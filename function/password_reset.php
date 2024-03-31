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
    <title>RESET PASSWORD</title>
</head>
<style>
    body,
    html {
        overflow: hidden;
        /* disable scrolling */
        height: 100dvh;
    }
</style>

<body>
    <?php
    include '../includes/navbar.php';
    ?>
    <div id="wrapper">
        <div id="content">
            <div class="container container-fluid p-5 justify-content-center align-items-center text-center">
                <h1>Reset Your Password</h1>
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col-4 text-center p-5">
                        <form action="" method="post">
                            <label for="admin_password" class="form-label fw-bold">Enter New Password</label>
                            <input type="password" class="form-control mb-3 text-center" name="admin_password" required>
                            
                            <a href="../pages/user_profile.php" class="btn btn-secondary ms-2 float-end">Back</a href="../pages/user_profile.php">
                            <button type="submit" class="btn btn-outline-primary float-end fw-bold" name="passwordBtn">Reset Password</button>
                        </form>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include '../includes/scripts.php';
    ?>
</body>
</html>
<?php 
    if(isset($_GET['verification_code'])){
        $verification_code = $_GET['verification_code'];
        
        if(isset($_POST['passwordBtn'])){
            $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);
    
            $updatePassword = "UPDATE admin_account SET `admin_password` = '$admin_password' WHERE verification_code = '$verification_code' ";
            $updatePasswordResult = mysqli_query($conn, $updatePassword);
            
            if($updatePasswordResult){
                $_SESSION['message'] = "Password Updated Successfully!";
                $_SESSION['icon'] = "success";
            }else{
                $_SESSION['message'] = "Error Updating Password. Please Try Again Later.";
                $_SESSION['icon'] = "error";
            }
        }
    }
?>