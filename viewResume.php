<?php
session_start();
include "db_conn.php";

// Retrieve the resume file content from the database based on user ID
$jsID = $_SESSION['jobSeekerID'];
$sql = "SELECT resume FROM job_seeker WHERE jobSeekerID ='$jsID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $resumePath = $row['resume'];

    // Check if the file exists
    if (file_exists($resumePath)) {
        // Set the appropriate headers for PDF rendering
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $resumePath . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Output the PDF content
        readfile($resumePath);
    } else {
        echo $resumePath;
        echo "File not found";
    }
} else {
    echo "User not found";
}