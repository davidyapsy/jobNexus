<?php

session_start();
//include the php files that will be used in one form
include "db_conn.php";
include './sendEmail.php';

//remove space in user input
function removeChar($data) {
    $data = trim($data);
    return $data;
}

function custLogin($uemail, $pwd, $conn) {
    $sql = "SELECT * FROM customer WHERE email_address='$uemail' AND password='$pwd'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['email_address'] === $uemail && $row['password'] === $pwd) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['customerLoggedIn'] = true;
            header("Location: /flight_ticketing_system/Home_Page/index.php"); //change here - home screen
            exit();
        } else {
            $_SESSION['customerLoggedIn'] = false;

            echo "<script>alert('Incorrect Email or Password!'); window.location.href = 'login.html';</script>";
        }
    } else {
        $_SESSION['customerLoggedIn'] = false;

        echo "<script>alert('Incorrect Email or Password!'); window.location.href = 'login.html';</script>";
    }
}

//staff login
function staffLogin($uemail, $pwd, $conn) {
    $sql = "SELECT * FROM staff WHERE email_address='$uemail' AND password='$pwd' AND is_deleted =0";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['status'] === "available") {
            if ($row['email_address'] === $uemail && $row['password'] === $pwd) {
                $_SESSION['position'] = $row['position'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['staff_id'] = $row['staff_id'];
                $_SESSION['staffLoggedIn'] =true;
                header("Location: /flight_ticketing_system/employer"); //change here
                // exit();
            } else {
                echo "<script>alert('Incorrect Email or Password!'); window.location.href = 'staffLogin.html';</script>";
            }
        } else {
            $_SESSION['staffLoggedIn'] =false;
            echo "<script>alert('Account Unavailable! You are not allowed to login!'); window.location.href = 'staffLogin.html';</script>";
        }
    } else {

        echo "<script>alert('Incorrect Email or Password!'); window.location.href = 'staffLogin.html';</script>";
    }
}

//check if the email in the database and send the email [for password recovery]
function checkEmailPwdRecovery($uemail, $conn) {
    $sql = "SELECT * FROM customer WHERE email_address='$uemail'";
    $result = mysqli_query($conn, $sql);

    //generate a random code
    $code = (rand(100000, 999999));
    $_SESSION['code'] = $code;

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['email_address'] === $uemail) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['customer_id'] = $row['customer_id'];
            pwdRecovery($uemail, $code);
        } else {
            echo "<script>alert('Invalid Email!'); window.location.href = 'pwdRecovery.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid Email!'); window.location.href = 'pwdRecovery.html';</script>";
    }

    return $code;
}

//check if the passcode entered is same with the code generate by the system
function checkPasscode($ucode) {
    $code = $_SESSION['code']; // get the code from the session variable

    if ($ucode == $code) {
        echo "<script>alert('Code matched! Please change your password and login again'); window.location.href = 'changePwd.html';</script>";
    } else {
        echo "<script>alert('Invalid code! Please make sure you have enter the correct pass code'); window.location.href = 'checkPasscode.html';</script>";
    }
}

//check if there is same email used to create account, else a new account will be create
function checkDuplicateEmail($uemail, $conn, $name, $upwd, $dob, $phone) {
    $sql = "SELECT * FROM customer WHERE email_address='$uemail'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        echo "<script>alert('This email has been used! Please try with another email'); window.location.href = 'createAcc.html';</script>";
    } else { //no record, can create account
        $upwd = md5($upwd);
        $sql1 = "INSERT INTO customer(name, date_of_birth, password, email_address, phone_number) VALUES('$name', '$dob', '$upwd', '$uemail', '$phone')";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            createAcc($uemail, $name);
        } else {
            echo "<script>alert('Account created unsuccessfully, please try again'); window.location.href = 'createAcc.html';</script>";
        }
    }
}

//change user password
function changePwd($conn, $upwd) {
    $id = $_SESSION['customer_id'];
    $sql = "UPDATE customer SET password ='$upwd' WHERE customer_id ='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Password changed! Please login with the new password'); window.location.href = 'login.html';</script>";
    } else {
        echo "<script>alert('Update failed! Please try again'); window.location.href = 'changePwd.html';</script>";
    }
}

//validate email format
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

//===================================================================================================================================================================
//===================================================================================================================================================================
// Check if the form has been submitted and call the function
//cust login
if (isset($_POST['custLogin'])) {
    //get value from the form
    $uemail = removeChar($_POST['email']);
    $pwd = removeChar($_POST['pwd']);

    if (empty($uemail) || empty($pwd)) {
        echo "<script>alert('Blank input! Please try again'); window.location.href = 'login.html';</script>";
    } elseif (validateEmail($uemail) == false) {
        echo "<script>alert('Please enter a valid email address'); window.location.href = 'login.html';</script>";
    } else {
        //hashing password
        $pwd = md5($pwd);
        custLogin($uemail, $pwd, $conn);
    }
}


//staff login
if (isset($_POST['staffLogin'])) {
    //get value from the form
    $uemail = removeChar($_POST['email']);
    $pwd = removeChar($_POST['pwd']);

    if (empty($uemail) || empty($pwd)) {
        echo "<script>alert('Blank input! Please try again'); window.location.href = 'staffLogin.html';</script>";
    } elseif (validateEmail($uemail)  == false ) {
        echo "<script>alert('Please enter a valid email address'); window.location.href = 'staffLogin.html';</script>";
    } else {
        //hashing password
        $pwd = md5($pwd);
        staffLogin($uemail, $pwd, $conn);
    }
}


//password recovery
if (isset($_POST['submitEmail'])) {
    $uemail = removeChar($_POST['email']);
    if (empty($uemail)) {
        echo "<script>alert('Please don\'t submit blank input'); window.location.href = 'pwdRecovery.html';</script>";
    } elseif (validateEmail($uemail) == false) {
        echo "<script>alert('Please enter a valid email address'); window.location.href = 'pwdRecovery.html';</script>";
    } else {
        checkEmailPwdRecovery($uemail, $conn);
    }
}


//create account->check email, check match password
if (isset($_POST['create'])) {
    $name = removeChar($_POST['name']);
    $uemail = removeChar($_POST['email']);
    $dob = removeChar($_POST['dob']);
    $phone = removeChar($_POST['phoneNo']);
    $upwd = removeChar($_POST['pwd']);
    $rpwd = removeChar($_POST['rpwd']);

    // create a DateTime object with the date value and the expected date format
    $datetime = DateTime::createFromFormat('d/m/Y', $dob);

    if (empty($name) || empty($uemail) || empty($dob) || empty($phone) || empty($upwd) || empty($rpwd)) {
        echo "<script>alert('Please don\'t submit blank input'); window.location.href = 'createAcc.html';</script>";
    } elseif (validateEmail($uemail) == false) {
        echo "<script>alert('Please enter a valid email address'); window.location.href = 'createAcc.html';</script>";
    } elseif ($datetime > new DateTime()) {
        echo "<script>alert('Invalid date of birth!'); window.location.href = 'createAcc.html';</script>";
    } elseif ($upwd != $rpwd) {
        echo "<script>alert('Password Mismatch! Please try again'); window.location.href = 'createAcc.html';</script>";
    } else {
        checkDuplicateEmail($uemail, $conn, $name, $upwd, $dob, $phone);
    }
}


//check pass code[from password recovery]
if (isset($_POST['submitCode'])) {
    $ucode = removeChar($_POST['code']);
    if (empty($ucode)) {
        echo "<script>alert('Blank pass code! Please try again'); window.location.href = 'checkPasscode.html';</script>";
    } else {
        checkPasscode($ucode);
    }
}


//change password
if (isset($_POST['change'])) {
    $upwd = removeChar($_POST['pwd']);
    $rpwd = removeChar($_POST['rpwd']);

    if (empty($upwd) || empty($rpwd)) {
        echo "<script>alert('Blank input! Please try again'); window.location.href = 'changePwd.html';</script>";
    } elseif ($upwd == $rpwd) {
        $upwd = md5($upwd);
        changePwd($conn, $upwd);
    } else {
        echo "<script>alert('Password Mismatch! Please try again'); window.location.href = 'changePwd.html';</script>";
    }
}
