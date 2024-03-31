<?php 
    require '../config/conn.php';
    session_start();

    /* this is for email authentication */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    function password_reset($user_email, $verification_code){
        $mail = new PHPMailer(true);

        $mail -> isSMTP();
        $mail -> SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->Username = "aikocastro025@gmail.com";
        $mail->Password = "vjdq gwqp wgpp clnj";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->setFrom("aikocastro025@gmail.com", "BRMS Password Reset");
        $mail->addAddress($user_email);

        $mail->isHTML(true);
        $mail->Subject = "BIMS Password Reset";

        $email_template = "
            <h3>This is your Password Reset link for BRMS</h3>
            <h5>Please Change Your Password on the link below.</h5>
            <a href='http://localhost/bims/function/reset_password.php?verification_code=$verification_code'> Reset Password Here ! </a>
        ";

        $mail->Body = $email_template;
        $mail->send();
    }
    function generateVerificationCode() {
        $numbers = '0123456789';
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        return $randomString;
    }

    if(isset($_POST['passwordBtn'])){
        $verification_code = generateVerificationCode();
        $user_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
        $user_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
    
        $checkQuery = "SELECT * FROM admin_account WHERE admin_email = '$user_email' AND admin_username = '$user_username'";
        $checkResult = mysqli_query($conn, $checkQuery);
    
        if(mysqli_num_rows($checkResult) > 0) {
            $passwordQuery = "UPDATE admin_account SET `verification_code` = '$verification_code' WHERE admin_email = '$user_email' AND admin_username = '$user_username' ";
            $passwordResult = mysqli_query($conn, $passwordQuery);
    
            if($passwordResult){
                password_reset($user_email, $verification_code);
                $_SESSION['message'] = "Password Reset Link Sent to Your Email!";
                $_SESSION['icon'] = "success";
                header('Location: ../index.php');
                exit();
            } else {
                $_SESSION['message'] = "Error: " . mysqli_error($conn);
                $_SESSION['icon'] = "error";
                header('Location: ../index.php');
                exit();
            }
        } else {
            $_SESSION['message'] = "Invalid Email or Username!";
            $_SESSION['icon'] = "warning";
            header('Location: ../index.php');
            exit();
        }
    }
    
?>