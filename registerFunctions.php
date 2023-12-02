<?php

session_start();

include "db_conn.php";
include './sendEmail.php';

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

function generateJobSeekerID($conn) {
    // Query to count the number of records in the job_seeker table
    $sqlCount = "SELECT COUNT(*) AS record_count FROM job_seeker";
    $resultCount = mysqli_query($conn, $sqlCount);

    if ($resultCount && $row = mysqli_fetch_assoc($resultCount)) {
        $runningNumber = intval($row['record_count']);
    } else {
        // If no records are present, start from 0
        $runningNumber = 0;
    }

    // Format the running number with leading zeros
    $formattedRunningNumber = sprintf("%05d", $runningNumber);
    // "JS": refers to Job Seeker
    $prefix = "JS";
    // "23": refers to last 2 digits of the current year
    $yearDigits = date("y");
    // Concatenate the components to create the final ID
    $jobSeekerID = $prefix . $yearDigits . $formattedRunningNumber;

    return $jobSeekerID;
}

//check if there is same email used to create account, else a new account will be create
function checkDuplicateEmail($uemail, $conn) {
    $sql = "SELECT * FROM job_seeker WHERE emailAddress='$uemail'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $dataToSend = true;
        $errorMsg = "This email has been used! Please try with another email";
        header("Location: LoginRegister/register.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } else { //no record, can proceed
        echo "<script>window.location.href = 'LoginRegister/register1.php';</script>";
    }
}

//create a new acc
function registerAcc($uemail, $conn, $fname, $lname, $address, $phone, $upwd, $institution, $fieldStudy, $level, $year, $workingYears, $skills) {
    $upwd = md5($upwd);
    $jsID = generateJobSeekerID($conn);
    $createdAt = date("Y-m-d H:i:s");
    $sql = "INSERT INTO job_seeker(`jobSeekerID`, `firstName`, `lastName`, `emailAddress`, `password`, `phoneNumber`, `address`, `isOpenForJobs`, `created_at`, `working_experience`, `education_level`, `field_of_study`, `institution`, `graduate_year`, `skills`) VALUES('$jsID','$fname', '$lname', '$uemail', '$upwd', '$phone', '$address', 1, '$createdAt', '$workingYears', '$level', '$fieldStudy', '$institution', '$year', '$skills')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        createAcc($uemail, $fname, $lname); //send welcome email
    } else {
        $dataToSend = true;
        $errorMsg = "Account created unsuccessfully, please try again";
        header("Location: LoginRegister/register.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }
}

if (isset($_POST['next'])) {
    $_SESSION['rfname'] = removeChar($_POST['fname']);
    $_SESSION['rlname'] = removeChar($_POST['lname']);
    $_SESSION['ruemail'] = removeChar($_POST['email']);
    $_SESSION['raddress'] = removeChar($_POST['address']);
    $_SESSION['rphone'] = removeChar($_POST['phoneNo']);


    if (empty($_SESSION['rfname']) || empty($_SESSION['rlname']) || empty($_SESSION['ruemail']) || empty($_SESSION['raddress']) || empty($_SESSION['rphone'])) {
        $dataToSend = true;
        $errorMsg = "Please don\'t submit blank input";
        header("Location: LoginRegister/register.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } elseif (validateEmail($_SESSION['ruemail']) == false) {
        $dataToSend = true;
        $errorMsg = "Please enter a valid email address";
        header("Location: LoginRegister/register.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } else {
        checkDuplicateEmail($_SESSION['ruemail'], $conn);
    }
}

if (isset($_POST['next1'])) {
    $_SESSION['rinstitution'] = removeChar($_POST['institution']);
    $_SESSION['rfieldStudy'] = removeChar($_POST['fieldStudy']);
    $_SESSION['rlevel'] = removeChar($_POST['level']);
    $_SESSION['ryear'] = removeChar($_POST['year']);
    
    echo "<script>window.location.href = 'LoginRegister/register2.php';</script>";
}

if (isset($_POST['next2'])) {
    $_SESSION['rskills'] = isset($_POST['hiddenSkills']) ? $_POST['hiddenSkills'] : '';
    $_SESSION['rworkingYears'] = isset($_POST['wYears']) ? $_POST['wYears'] : '';
    
    // Check if rskills is not empty before decoding
    if (!empty($_SESSION['rskills'])) {
        // Convert the skills array to a comma-separated string
        $_SESSION['skillsString'] = implode(', ', json_decode($_SESSION['rskills'], true));
    } else {
        $_SESSION['skillsString']; // Set default value if skills are not provided
    }

    echo "<script>window.location.href = 'LoginRegister/register3.php';</script>";
}

if (isset($_POST['create'])) {
    $rupwd = removeChar($_POST['pwd']);
    $rrpwd = removeChar($_POST['rpwd']);

    if ( empty($rupwd) || empty($rrpwd)) {
        $dataToSend = true;
        $errorMsg = "Please don\'t submit blank input";
        header("Location: LoginRegister/register3.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    } elseif ($rupwd != $rrpwd) {
        $dataToSend = true;
        $errorMsg = "Password Mismatch! Please try again";
        header("Location: LoginRegister/register3.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }elseif (validatePassword($rupwd) == false || validatePassword($rrpwd) == false) {     
        $dataToSend = true;
        $errorMsg = "Password format incorrect! Please make sure your password contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
        header("Location: LoginRegister/register3.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }else {
        registerAcc($_SESSION['ruemail'], $conn, $_SESSION['rfname'], $_SESSION['rlname'], $_SESSION['raddress'], $_SESSION['rphone'], $rupwd, $_SESSION['rinstitution'], $_SESSION['rfieldStudy'], $_SESSION['rlevel'], $_SESSION['ryear'], $_SESSION['rworkingYears'], $_SESSION['skillsString']);
    }
}
