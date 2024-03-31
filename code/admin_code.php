<?php 
require '../config/conn.php';
session_start();

/* this is for email authentication */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

function email_verification($admin_username, $admin_email, $verification_code){
    $mail = new PHPMailer(true);

    $mail -> isSMTP();
    $mail -> SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "aikocastro025@gmail.com";
    $mail->Password = "vjdq gwqp wgpp clnj";
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("aikocastro025@gmail.com", "BRMS Verification");
    $mail->addAddress($admin_email);

    $mail->isHTML(true);
    $mail->Subject = "BIMS Email Verification";

    $email_template = "
        <h3>This is your verification link for BRMS</h3>
        <h5>Please Verify Your Email on the link below.</h5>
        <a href='http://localhost/bims/function/verification.php?verification_code=$verification_code'> Verify Here ! </a>
    ";

    $mail->Body = $email_template;
    $mail->send();
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generateVerificationCode() {
    $numbers = '0123456789';
    $randomString = '';
    for ($i = 0; $i < 6; $i++) {
        $randomString .= $numbers[rand(0, strlen($numbers) - 1)];
    }
    return $randomString;
}

if(isset($_POST['addBtn'])){
    $admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $admin_phone = mysqli_real_escape_string($conn, $_POST['admin_phone']);
    $verification_code = generateVerificationCode();

    // Check if email is valid
    if (!isValidEmail($admin_email)) {
        $_SESSION['message'] = "Invalid email address.";
        $_SESSION['icon'] = "error";
        header('Location: ../pages/manage_admin.php');
        exit();
    }

    $checkEmailQuery = "SELECT * FROM admin_account WHERE admin_email = '$admin_email' LIMIT 1 ";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if(mysqli_num_rows($checkEmailResult)>0){
        $_SESSION['message'] = "Email Registered Already. Please use another working Email.";
        $_SESSION['icon'] = "error";
        header('Location: ../pages/manage_admin.php');
        exit();
    } else {
        $addAdminQuery = "INSERT INTO admin_account (admin_username, admin_password, admin_email, admin_phone, verification_code) VALUES ('$admin_username', '$admin_password', '$admin_email', '$admin_phone', '$verification_code')";
        $addAdminResult = mysqli_query($conn, $addAdminQuery);

        if($addAdminResult){
            email_verification("$admin_username", "$admin_email", "$verification_code");
            $_SESSION['message'] = "Account Created. Please check Email for verification.";
            $_SESSION['icon'] = "warning";
            header('Location: ../pages/manage_admin.php');
            exit();
        }
    }
}
?>
