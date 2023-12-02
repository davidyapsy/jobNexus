<?php
session_start();

include "..\db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $openForJob = $_POST['openForJob'];

    // Update the session variable
    $_SESSION['openForJob'] = $openForJob;

    // Update the database record
    $jsID = $_SESSION['jobSeekerID'];
    $updateQuery = "UPDATE job_seeker SET isOpenForJobs = '$openForJob' WHERE jobSeekerID = '$jsID'";
    
    if (mysqli_query($conn, $updateQuery)) {
        if (isset($_POST['redirect'])) {
            // Redirect back to the page that initiated the form submission
            header("Location: " . $_POST['redirect']);
            exit();
        }
    }
}

