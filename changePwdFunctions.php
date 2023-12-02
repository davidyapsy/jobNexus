<?php
session_start();

include "db_conn.php";

//remove space in user input
function removeChar($data) {
    $data = trim($data);
    return $data;
}

//validate password format
function validatePassword($pwd){
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
    
    //check pattern
    if (preg_match($pattern, $pwd)) {
        return true; // Valid pwd
    } else {
        return false; // Invalid pwd
    }
}

//check password
function checkPwd($conn, $cpwd) {
    $id = $_SESSION['jobSeekerID'];
    $sql = "SELECT password FROM job_seeker WHERE jobSeekerID ='$id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if($row['password']===$cpwd){
            echo "<script>window.location.href = 'PwdRecovery/changePwd.php';</script>";
        } else {
            $dataToSend = true;
            $errorMsg = "Incorrect Password! Please try again";
            header("Location: Profile/changePassword.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
            exit();
        }
    }
}

//change user password
function changePwd($conn, $upwd) {
    $id = $_SESSION['jobSeekerID'];
    $sql = "UPDATE job_seeker SET password ='$upwd' WHERE jobSeekerID ='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['jobSeekerID'] = null;
        $newPwd = true;
        $msg = "Password changed! Please login again with the new password";
        header("Location: LoginRegister/login.php?valid=" . urlencode($newPwd) . "&msg=" . urlencode($msg));
        exit();
    } else {
        $dataToSend = true;
        $errorMsg = "Update failed! Please try again";
        header("Location: PwdRecovery/changePwd.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }
}

//pwd recovery: change password
if (isset($_POST['change'])) {
    $upwd = removeChar($_POST['pwd']);
    $rpwd = removeChar($_POST['rpwd']);

    if (empty($upwd) || empty($rpwd)) {
        $dataToSend = true;
        $errorMsg = "Blank input! Please try again";
        header("Location: PwdRecovery/changePwd.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } elseif(validatePassword($upwd) == false || validatePassword($rpwd) == false){
        $dataToSend = true;
        $errorMsg = "Password format incorrect! Please make sure your password contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
        header("Location: PwdRecovery/changePwd.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }elseif ($upwd == $rpwd) {
        $upwd = md5($upwd);
        changePwd($conn, $upwd);
    } else {     
        $dataToSend = true;
        $errorMsg = "Password Mismatch! Please try again";
        header("Location: PwdRecovery/changePwd.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }
}

//profile: check current password
if (isset($_POST['next'])) {
    $cpwd = removeChar($_POST['cpwd']);

    if (empty($cpwd)) {
        $dataToSend = true;
        $errorMsg = "Blank input! Please try again";
        header("Location: Profile/changePassword.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } else {
        $cpwd = md5($cpwd);
        checkPwd($conn, $cpwd);
    } 
}


