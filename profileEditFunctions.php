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

function updateProfile($conn, $fname, $lname, $phoneNo, $address, $profileUploadPath, $resumeUploadPath, $wYears, $level, $fieldStudy, $institution, $year, $skills, $jsID){
    $sql = " UPDATE job_seeker SET `firstName`='$fname',`lastName`='$lname',`phoneNumber`='$phoneNo',`address`='$address',`profilePic`='$profileUploadPath',`resume`='$resumeUploadPath',`working_experience`='$wYears',`education_level`='$level',`field_of_study`='$fieldStudy',`institution`='$institution',`graduate_year`='$year',`skills`='$skills' WHERE jobSeekerID ='$jsID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['fName'] = $fname;
        $_SESSION['lName'] = $lname;
        $_SESSION['phoneNumber'] = $phoneNo;
        $_SESSION['address'] = $address;
        $_SESSION['profilePic'] = $profileUploadPath;
        $_SESSION['resume'] = $resumeUploadPath;
        $_SESSION['workingExp'] = $wYears;
        $_SESSION['educationLevel'] = $level;
        $_SESSION['fieldStudy'] = $fieldStudy;
        $_SESSION['institution'] = $institution;
        $_SESSION['graduateYear'] = $year;
        $_SESSION['skills'] = $skills;
        $updated = true;
        $msg = "Account Updated!";
        header("Location: Profile/profile.php?valid=" . urlencode($updated) . "&msg=" . urlencode($msg));
        exit();
    } else {       
        $dataToSend = true;
        $errorMsg = "Update failed! Please try again";
        header("Location: Profile/profileEdit.php?data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }

}

if(isset($_POST['save'])){
    $jsID = $_SESSION['jobSeekerID'];
    
    $fname = removeChar($_POST['efname']);
    $lname = removeChar($_POST['elname']);
    $address = removeChar($_POST['eaddress']);
    $phoneNo = removeChar($_POST['ephoneNo']);
    $institution = removeChar($_POST['einstitution']);
    $fieldStudy = removeChar($_POST['efieldStudy']);
    $level = removeChar($_POST['elevel']);
    $year = removeChar($_POST['eyear']);
    $skills = $_POST['hiddenSkills'];
    $wYears = removeChar($_POST['ewYears']);
   
    //handle for resume
    if (isset($_FILES['eresume']) && $_FILES['eresume']['error'] === UPLOAD_ERR_OK) {
        //directory of the uploaded resumes
        $uploadDirectory = "userResume/";
        
        // Get the file information
        $file = $_FILES['eresume'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        
        // Create a unique filename to avoid overwriting existing files
        $uniqueFileName = uniqid('resume_') . '_' . $fileName;
        
        // Move the uploaded file to the specified directory with the unique filename
        $resumeUploadPath = $uploadDirectory . $uniqueFileName;
        move_uploaded_file($fileTmpName, $resumeUploadPath);
    } else {
        $resumeUploadPath = $_SESSION['resume'];
    }
    
    //handle for profile pic
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
         // Specify the directory where you want to store the uploaded profile pictures
        $uploadDirectory = "userProfile/";  
        // Get the file extension
        $fileExtension = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);

        // Generate a unique filename for the uploaded picture
        $newFileName = $jsID . '_profile_' . time() . '.' . $fileExtension;
        
        // Move the uploaded file to the specified directory
        $profileUploadPath = $uploadDirectory . $newFileName;
        move_uploaded_file($_FILES['profilePicture']['tmp_name'], $profileUploadPath);
    } else {
        $profileUploadPath = $_SESSION['profilePic'];
    }

    updateProfile($conn, $fname, $lname, $phoneNo, $address, $profileUploadPath, $resumeUploadPath, $wYears, $level, $fieldStudy, $institution, $year, $skills, $jsID);
    
}
