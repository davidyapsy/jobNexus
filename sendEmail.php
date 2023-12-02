<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library
require_once './phpMailer/src/Exception.php';
require_once './phpMailer/src/PHPMailer.php';
require_once './phpMailer/src/SMTP.php';

function pwdRecovery($to, $code) {
    // Create a new PHPMailer object
    $mail = new PHPMailer(true);

    // Set up the SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jobnexus2@gmail.com';
    $mail->Password = 'njysranxlvecliqc';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Set up the email content
    $mail->setFrom('jobnexus2@gmail.com');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = "Temporary Code";
    $mail->Body = "<h4>Password Recovery</h4>"
            . "Hello, here's your temporary pass code:"
            . "<h3>" . $code . "</h3>"
            . "Please enter the code when asked for it."
            . "<br><br>Sincerely, <br>The Job Nexus Team";

    // Send the email
    if ($mail->send()) {        
        $tempCode = true;
        $msg = "Email Sent! Please check your email inbox";
        header("Location: PwdRecovery/tempCode.php?tempCode=" . urlencode($tempCode) . "&msg=" . urlencode($msg));
        exit();
    } else {
        $dataToSend = true;
        $errorMsg = "Email sending failed, Please try again";
        header("Location: PwdRecovery/pwdRecovery.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }
}

function createAcc($to, $fname, $lname) {
    // Create a new PHPMailer object
    $mail = new PHPMailer(true);

    // Set up the SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jobnexus2@gmail.com';
    $mail->Password = 'njysranxlvecliqc';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Set up the email content
    $mail->setFrom('jobnexus2@gmail.com');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = "Welcome! Thanks for chosing Job Nexus";
    $mail->Body = "Dear " . $fname . " " .$lname . ", <br>thanks for using Job Nexus! Have a wonderful journey finding your dream job! Please login again to start using with your account "
                  . "<br><br>Sincerely, <br>The Job Nexus Team";

    // Send the email
    if ($mail->send()) {       
        $newAcc = true;
        $msg = "Account created successfully! Please proceed to login";
        header("Location: LoginRegister/login.php?valid=" . urlencode($newAcc) . "&msg=" . urlencode($msg));
        exit();
    }
}
