<?php
session_start();

include "db_conn.php";

//remove space in user input
function removeChar($data) {
    $data = trim($data);
    return $data;
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

//job seeker login
function jsLogin($uemail, $pwd, $conn) {
    $sql = "SELECT * FROM job_seeker WHERE emailAddress='$uemail' AND password='$pwd'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['emailAddress'] === $uemail && $row['password'] === $pwd) {
            //take all the info for display in profile
            $_SESSION['jobSeekerID'] = $row['jobSeekerID'];
            $_SESSION['fName'] = $row['firstName'];
            $_SESSION['lName'] = $row['lastName'];
            $_SESSION['emailAddress'] = $row['emailAddress'];
            $_SESSION['phoneNumber'] = $row['phoneNumber'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['profilePic'] = $row['profilePic'];
            $_SESSION['resume'] = $row['resume'];
            $_SESSION['openForJob'] = $row['isOpenForJobs'];
            $_SESSION['workingExp'] = $row['working_experience'];
            $_SESSION['educationLevel'] = $row['education_level'];
            $_SESSION['fieldStudy'] = $row['field_of_study'];
            $_SESSION['institution'] = $row['institution'];
            $_SESSION['graduateYear'] = $row['graduate_year'];
            $_SESSION['skills'] = $row['skills'];
            //to indicate that user have login
            $_SESSION['ulogin'] = true;
            if ($_SESSION['ulogin']) {
                header("Location: index.php");
                exit();
            }
        } else {
            $dataToSend = true;
            $errorMsg = "Invalid Email or Password! Please try again";
            header("Location: LoginRegister/login.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
            exit();
        }
    } else {
        $dataToSend = true;
        $errorMsg = "Invalid Email or Password! Please try again";
        header("Location: LoginRegister/login.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }
}

if (isset($_POST['login'])) {
    //get value from the form
    $uemail = removeChar($_POST['email']);
    $pwd = removeChar($_POST['pwd']);

    if (empty($uemail) || empty($pwd)) {        
        $dataToSend = true;
        $errorMsg = "Blank input! Please try again";
        header("Location: LoginRegister/login.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } elseif (validateEmail($uemail) == false) {      
        $dataToSend = true;
        $errorMsg = "Please enter a valid email address";
        header("Location: LoginRegister/login.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } elseif(validatePassword($pwd) == false){
        $dataToSend = true;
        $errorMsg = "Password format incorrect! Please make sure your password contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
        header("Location: LoginRegister/login.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }else {
        //hashing password
        $pwd = md5($pwd);
        jsLogin($uemail, $pwd, $conn);
    }
}
