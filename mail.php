<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../View/PHPMailer/src/Exception.php';
require '../View/PHPMailer/src/PHPMailer.php';
require '../View/PHPMailer/src/SMTP.php';

if(isset($_POST["send"])){
    try {
        // Initialize PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host= 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username ='sehlimouhamedaziz@gmail.com';
        $mail->Password = 'sjptllzryfvqovuh'; // Use your actual password here
        $mail->SMTPSecure ='tls';
        $mail->Port = 587;

        // Set email details
        $mail->setFrom('sehlimouhamedaziz@gmail.com');
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);
        $mail->Subject = htmlspecialchars($_POST["subject"]);
        $mail->Body = htmlspecialchars($_POST["message"]);

        // Send email
        $mail->send();
        
        // Redirect with success message
        header("Location: send.php?status=success");
        exit;
    } catch (Exception $e) {
        // Redirect with error message
        header("Location: send.php?status=error&message={$mail->ErrorInfo}");
        exit;
    }
}
?>
