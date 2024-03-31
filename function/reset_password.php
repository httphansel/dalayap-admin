<?php 
    require '../config/conn.php';
    session_start();

    /* this is for email authentication */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    function resetPasswordLink($admin_email, $verification_code){
        $mail = new PHPMailer(true);

        $mail -> isSMTP();
        $mail -> SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->Username = "aikocastro025@gmail.com";
        $mail->Password = "vjdq gwqp wgpp clnj";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->setFrom("aikocastro025@gmail.com", "BIMS Password Reset");
        $mail->addAddress($admin_email);

        $mail->isHTML(true);
        $mail->Subject = "BIMS Reset Password";

        $email_template = "
            <h3>This is your reset password link for BIMS</h3>
            <h5>Please click the link below to reset your password.</h5>
            <a href='http://localhost/bims/function/password_reset.php?verification_code=$verification_code'> Reset Password ! </a>
        ";

        $mail->Body = $email_template;
        $mail->send();
    }

    if(isset($_POST['resetBtn'])){

        $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
        $verification_code = mysqli_real_escape_string($conn, $_POST['verification_code']);

        resetPasswordLink("$admin_email", "$verification_code");

        $_SESSION['message'] = "Password Reset link sent to your Email.";
        $_SESSION['icon'] = "warning";
        header('Location: ../pages/user_profile.php');
        exit();
    }
?>