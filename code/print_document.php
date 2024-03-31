

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include '../includes/links.php';
    ?>
    <title>GENERATE DOCUMENT</title>
</head>
<body>
    <?php
    include '../includes/navbar.php';
    ?>
    
    <div class="container container-fluid p-5">
        <div class="card p-3">
            <div class="card-title">
                <h1>Generate Document</h1>
            </div>
            <div class="card-body text-center">
                <?php 
                    $transaction_id = $_GET['transaction_id'];
                    $transactionQuery = "SELECT * FROM transaction_data WHERE transaction_id = '$transaction_id' ";
                    $transactionResult = mysqli_query($conn, $transactionQuery);

                    if($transactionResult->num_rows>0){
                        while($transaction=$transactionResult->fetch_assoc()){
                ?>
                    <h3>Print <?= $transaction['document_type'] ?> for <?= $transaction['user_fullname'] ?> <br> for His/Her <?= $transaction['user_purpose'] ?> <br> <span class="text-warning">Transaction ID: <?= $transaction['transaction_id'] ?></span></h3>
                    <form action="" method="post">
                        <input type="text" value="<?= $transaction['transaction_id'] ?>" name="transaction_id" hidden>
                        <input type="text" value="<?= $transaction['user_fullname'] ?>" name="user_fullname" hidden>
                        <input type="text" value="<?= $transaction['user_email'] ?>" name="user_email" hidden>
                        <input type="text" value="<?= $transaction['user_purpose'] ?>" name="user_purpose" hidden>
                        <input type="text" value="<?= $transaction['document_type'] ?>" name="document_type" hidden>
                        <button type="submit" class="btn btn-outline-success mt-3" name="printBtn">Print Document</button>
                        <a href="../pages/transaction.php" class="btn btn-secondary mt-3">Back</a>
                    </form>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <?php
    include '../includes/scripts.php';
    ?>
</body>

</html>

<?php 
    require '../config/conn.php';
    
    /* this is for email authentication */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    function email_notification($user_email, $document_type){
        $mail = new PHPMailer(true);

        $mail -> isSMTP();
        $mail -> SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->Username = "aikocastro025@gmail.com";
        $mail->Password = "vjdq gwqp wgpp clnj";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->setFrom("aikocastro025@gmail.com", "BRMS Notification");
        $mail->addAddress($user_email);

        $mail->isHTML(true);
        $mail->Subject = "BRMS Email Verification";

        $email_template = "
            <h3>This is a notification from Dalayap BRMS</h3>
            <h5>Your Request for $document_type has been processed. Claim your document at the Barangay Hall.</h5>
        ";

        $mail->Body = $email_template;
        $mail->send();
    }

    if(isset($_POST['printBtn'])){
        $admin_username = $_SESSION['admin_username'];
        // Ensure transaction_id is set
        if(isset($_POST['transaction_id'])) {
            $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
            
            // Get other form data
            $user_fullname = mysqli_real_escape_string($conn, $_POST['user_fullname']);
            $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
            $user_purpose = mysqli_real_escape_string($conn, $_POST['user_purpose']);
            $document_type = mysqli_real_escape_string($conn, $_POST['document_type']);
            $completion_date = date('Y-m-d');
            
            
            require '../vendor/autoload.php'; // Include PHPWord library

            // Load the template
            $templatePath = realpath('../assets/templates/' . $document_type . '_template.docx');
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
    
            // Replace placeholders with dynamic content
            $fullname = $user_fullname;
            $document = $document_type;
            $purpose = $user_purpose;
    
            $templateProcessor->setValue('{FULLNAME}', $fullname);
            $templateProcessor->setValue('{DOCUMENT}', $document);
            $templateProcessor->setValue('{PURPOSE}', $purpose);
    
            // Save the modified document on the server
            $outputFilePath = $fullname . '_' . $document . '.docx';
            $templateProcessor->saveAs($outputFilePath);

            // Update transaction_data table
            $saveTransaction = "UPDATE transaction_data SET `admin_username` = '$admin_username', `request_status` = 'Processed', `completion_date` = '$completion_date' WHERE transaction_id = '$transaction_id' ";
            $transactionResult = mysqli_query($conn, $saveTransaction);

            if($transactionResult){
            email_notification($user_email, $document_type); //send email notification
            // Download the generated document
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($outputFilePath) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($outputFilePath));

            readfile($outputFilePath);

            // Remove the generated file from the server
            unlink($outputFilePath);

            
            header('Location: ../pages/transaction.php');
            exit();
            } else {
                $_SESSION['message'] = "Error Generating Document";
                $_SESSION['icon'] = "warning";
                header('Location: ../pages/transaction.php');
                exit();
            }
        } else {
            $_SESSION['message'] = "Transaction ID not found";
            $_SESSION['icon'] = "warning";
            header('Location: ../pages/transaction.php');
            exit();
        }
    }
?>