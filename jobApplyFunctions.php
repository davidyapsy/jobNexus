<?php
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
        $valid = true;
        $msg = "Application Submitted! You may check the status at your profile";
        header("Location: JobSearch/jobDetails.php?id=" . base64_encode($jobPostID) . "&valid=" . urlencode($valid) . "&msg=" . urlencode($msg));
        exit();
    } else {
        echo "<script>alert('Application Failed! Please try again.'); window.location.href = 'JobSearch/jobDetails.php?id=" . base64_encode($jobPostID) . "';</script>";
        $dataToSend = true;
        $errorMsg = "Application Failed! Please try again.";
        header("Location: JobSearch/jobDetails.php?id=" . base64_encode($jobPostID)."&data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }
}

if (isset($_POST['apply'])) {
    $applyID =  $_SESSION['jobSeekerID'];
    $jobPostID = $_POST['jobPostingID'];
    $summaryLetter = $_POST['summaryLetter'];
    $salaryExpectation = $_POST['salaryExpectation'];
    $availableDate = $_POST['availableDate'];

    // Validate salary
    if (!is_numeric($salaryExpectation) || $salaryExpectation <= 0) {
        $dataToSend = true;
        $errorMsg = "Please enter a valid positive numeric value for salary.";
        header("Location: JobSearch/jobDetails.php?id=" . base64_encode($jobPostID)."&data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }

    $dateObj = DateTime::createFromFormat('Y-m-d', $availableDate);
if (!$dateObj || $dateObj->format('Y-m-d') !== $availableDate) {
    $dataToSend = true;
    $errorMsg = "Please enter a valid date in the format yyyy-mm-dd.";
    header("Location: JobSearch/jobDetails.php?id=" . base64_encode($jobPostID)."&data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
    exit();
}

    // Validate other fields (summary letter, etc.)
    if (empty($summaryLetter)) {
        $dataToSend = true;
        $errorMsg = "Please don't submit a blank summary letter.";
        header("Location: JobSearch/jobDetails.php?id=" . base64_encode($jobPostID)."&data=" . urlencode($dataToSend) . "&errorMsg=" . urlencode($errorMsg));
        exit();
    }

    // If all validations pass, proceed to addJobApplication
    addJobApplication($conn, $applyID, $jobPostID, $summaryLetter, $salaryExpectation, $availableDate);
}
