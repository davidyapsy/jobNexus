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
    $mail->Username = 'goflight25@gmail.com';
    $mail->Password = 'hgenqnmjjmqqtlvu';
    $mail->SMTPSecure = 'tsl';
    $mail->Port = 587;

    // Set up the email content
    $mail->setFrom('goflight25@gmail.com');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = "Temporary Code";
    $mail->Body = "Hello, this is your temporary pass code: " . $code;

    // Send the email
    if ($mail->send()) {
        echo "<script>alert('Email Sent! Please check your email inbox'); window.location.href = 'checkPasscode.html';</script>";
    } else {
        echo "<script>alert('Email sending failed, Please try again'); window.location.href = 'pwdRecovery.html';</script>";
    }
}

function createAcc($to, $name) {
    // Create a new PHPMailer object
    $mail = new PHPMailer(true);

    // Set up the SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'goflight25@gmail.com';
    $mail->Password = 'hgenqnmjjmqqtlvu';
    $mail->SMTPSecure = 'tsl';
    $mail->Port = 587;

    // Set up the email content
    $mail->setFrom('goflight25@gmail.com');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = "Welcome! Thanks for chosing GOGO Flight";
    $mail->Body = "Dear " . $name . ", thanks for using GOGO Flight! Have a safe flight! ";

    // Send the email
    if ($mail->send()) {
        echo "<script>alert('Account created successfully! Please proceed to login'); window.location.href = 'login.html';</script>";
    }
}
