<?php
    require '../config/conn.php';
    session_start(); 
    
    
    /* this is for email authentication */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    function summon_user($user_fullname, $user_email){
        $mail = new PHPMailer(true);

        $mail -> isSMTP();
        $mail -> SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->Username = "aikocastro025@gmail.com";
        $mail->Password = "vjdq gwqp wgpp clnj";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->setFrom("aikocastro025@gmail.com", "BRMS Summon Letter");
        $mail->addAddress($user_email);

        $mail->isHTML(true);
        $mail->Subject = "BIMS Summon Letter";

        $email_template = "
            <h3>Kayo po ay inaanyayahan sa aming tanggapan sa Barangay Dalayap</h3>
            <h5>Upang ating pag-usapan ang nakahaing usapin sa ating Barangay</h5>
            <h5>Para kay, $user_fullname</h5>
        ";

        $mail->Body = $email_template;
        $mail->send();
    }
    if(isset($_POST['summonBtn'])){

        $blotter_id = mysqli_real_escape_string($conn, $_POST['blotter_id']);
        $user_fullname = mysqli_real_escape_string($conn, $_POST['user_fullname']);
        $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);

        $blotterQuery = "UPDATE blotter_report SET `bStatus` = 'Resolved' WHERE blotter_id = '$blotter_id' ";
        $blotterResult = mysqli_query($conn, $blotterQuery);
    
        if($blotterResult){
            summon_user($user_fullname, $user_email);
            
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
    }
?>