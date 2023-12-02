<?php
session_start();
include "db_conn.php";
include './sendEmail.php';

function removeChar($data) {
    $data = trim($data);
    return $data;
}

function validateEmail($email) {
    // Regex pattern for email validation
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    // Check if the email matches the pattern
    if (preg_match($pattern, $email)) {
        return true; // Valid email
    } else {
        return false; // Invalid email
    }
}

function checkEmailPwdRecovery($uemail, $conn) {
    $sql = "SELECT * FROM job_seeker WHERE emailAddress='$uemail'";
    $result = mysqli_query($conn, $sql);

    //generate a random code
    $code = (rand(100000, 999999));
    $_SESSION['code'] = $code;

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['emailAddress'] === $uemail) {
            $_SESSION['jobSeekerID'] = $row['jobSeekerID'];
            pwdRecovery($uemail, $code);
        } else { 
            $dataToSend = true;
            $errorMsg = "Invalid Email! Please make sure the email was registered";
            header("Location: PwdRecovery/pwdRecovery.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
            exit();
        }
    } else { //no record
        $dataToSend = true;
        $errorMsg = "Invalid Email! Please make sure the email was registered";
        header("Location: PwdRecovery/pwdRecovery.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }

    return $code;
}

//check if the passcode entered is same with the code generate by the system
function checkPasscode($ucode) {
    $code = $_SESSION['code']; // get the code from the session variable

    if ($ucode == $code) {
        $newPwd = true;
        $msg = "Code matched! Please change your password and login again";
        header("Location: PwdRecovery/changePwd.php?valid=" . urlencode($newPwd) . "&msg=" . urlencode($msg));
        exit();
    } else {
        $dataToSend = true;
        $errorMsg = "Invalid code! Please make sure you have enter the correct pass code";
        header("Location: PwdRecovery/tempCode.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }
}

if (isset($_POST['submitEmail'])) {
    $uemail = removeChar($_POST['email']);
    if (empty($uemail)) {
        $dataToSend = true;
        $errorMsg = "Please don't submit blank input";
        header("Location: PwdRecovery/pwdRecovery.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } elseif (validateEmail($uemail) == false) {
        $dataToSend = true;
        $errorMsg = "Please enter a valid email address";
        header("Location: PwdRecovery/pwdRecovery.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } else {
        checkEmailPwdRecovery($uemail, $conn);
    }
}

//check pass code[from password recovery]
if (isset($_POST['submitCode'])) {
    $ucode = removeChar($_POST['code']);
    if (empty($ucode)) {
        $dataToSend = true;
        $errorMsg = "Blank pass code! Please try again";
        header("Location: PwdRecovery/tempCode.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } else {
        checkPasscode($ucode);
    }
}

