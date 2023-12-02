<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "db_conn.php";

function generateJobApplicationID($conn) {
    $sqlCount = "SELECT COUNT(*) AS record_count FROM job_application";
    $resultCount = mysqli_query($conn, $sqlCount);

    if ($resultCount && $row = mysqli_fetch_assoc($resultCount)) {
        $runningNumber = intval($row['record_count']);
    } else {
        // If no records are present, start from 0
        $runningNumber = 0;
    }

    // Format the running number with leading zeros
    $formattedRunningNumber = sprintf("%04d", $runningNumber);
    // "JA": refers to Job Application
    $prefix = "JA";
    // "yy": refers to last 2 digits of the current year
    $yearDigits = date("y");
    // "mm": refers to the current month
    $monthDigits = date("m");
    // "dd": refers to the current day
    $dayDigits = date("d");
    // Concatenate the components to create the final ID
    $jobApplicationID = $prefix . $yearDigits . $monthDigits . $dayDigits . $formattedRunningNumber;

    return $jobApplicationID;
}

function addJobApplication($conn, $applyID, $jobPostID, $coverLetterSummary, $salaryExpectation, $availableDate) {
    $jobAppID = generateJobApplicationID($conn);
    $createdAt = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO `job_application`(`applicationID`, `jobSeekerID`, `jobPostingID`, `applicationDate`, `coverLetterSummary`, `status`, `salaryExpectation`, `availableDate`) VALUES ('$jobAppID','$applyID','$jobPostID','$createdAt','$coverLetterSummary','Under Review','$salaryExpectation','$availableDate')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Application Submitted! You may check the status at your profile'); window.location.href = 'JobSearch/job.php';</script>";
    } else {
        echo "<script>alert('Application Failed! Please try again.'); window.location.href = 'JobSearch/jobDetails.php?id=" . base64_encode($jobPostID) . "';</script>";
    }
}

if (isset($_POST['applyJob'])) {
    $applyID =  $_SESSION['jobSeekerID'];
    $jobPostID = $_POST['jobPostingID'];
    $coverLetterSummary = $_POST['coverLetterSummary'];
    $salaryExpectation = $_POST['salaryExpectation'];
    $availableDate = $_POST['availableDate'];

    if (empty($coverLetterSummary) || empty($salaryExpectation) || empty($availableDate)) {
        echo "<script>alert('Please don\'t submit blank input'); window.location.href = 'JobSearch/jobDetails.php?id=" . base64_encode($jobPostID) . "';</script>";
    } else {
        addJobApplication($conn, $applyID, $jobPostID, $coverLetterSummary, $salaryExpectation, $availableDate);
    }
}



