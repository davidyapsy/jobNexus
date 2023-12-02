<?php
session_start();
include './db_conn.php';

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

$jsID = $_SESSION['jobSeekerID'];

// SQL statements
$sql1 = "SELECT COUNT(*) as totalApplications FROM job_application WHERE `job_application`.`jobSeekerID` = '$jsID';";
$sql2 = "SELECT COUNT(*) as rejectedApplications FROM job_application WHERE status = 'rejected' AND `job_application`.`jobSeekerID` = '$jsID';";
$sql3 = "SELECT COUNT(*) as underReviewApplications FROM job_application WHERE status = 'under review' AND `job_application`.`jobSeekerID` = '$jsID';";
$sql4 = "SELECT COUNT(*) as successfulApplications FROM job_application WHERE status = 'success' AND `job_application`.`jobSeekerID` = '$jsID';";

// Combine the SQL statements
$query = $sql1 . $sql2 . $sql3 . $sql4;
// Initialize variables
$totalApplications = $rejectedApplications = $underReviewApplications = $successfulApplications = 0;

// Execute the combined query
if (mysqli_multi_query($conn, $query)) {
    do {
        // Store the result set
        if ($result = mysqli_store_result($conn)) {
            // Process the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Assign values to variables
                if (isset($row['totalApplications'])) {
                    $totalApplications = $row['totalApplications'];
                }
                if (isset($row['rejectedApplications'])) {
                    $rejectedApplications = $row['rejectedApplications'];
                }
                if (isset($row['underReviewApplications'])) {
                    $underReviewApplications = $row['underReviewApplications'];
                }
                if (isset($row['successfulApplications'])) {
                    $successfulApplications = $row['successfulApplications'];
                }
            }
            // Free the result set
            mysqli_free_result($result);
        }
        // Check for more results
    } while (mysqli_next_result($conn));
} else {
    // Handle the case where the queries failed
    echo "Error executing the queries: " . mysqli_error($conn);
}

// Calculate percentages
$rejectedPercentage = ($totalApplications > 0) ? number_format(($rejectedApplications / $totalApplications) * 100, 2) : 0;
$underReviewPercentage = ($totalApplications > 0) ? number_format(($underReviewApplications / $totalApplications) * 100, 2) : 0;
$successfulPercentage = ($totalApplications > 0) ? number_format(($successfulApplications / $totalApplications) * 100, 2) : 0;

// Excel file name for download
$fileName = "JobApplicationStatusandStatistic" . $jsID . date('Ymd') . ".xls";

// Column names
$fields = array('TOTAL JOB APPLY', 'UNDER REVIEW COUNT', 'UNDER REVIEW PERCENTAGE' ,'SUCCESS COUNT' , 'SUCCESS PERCENTAGE','REJECTED COUNT', 'REJECTED PERCENTAGE');

// Display column names as the first row
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database
// Output each row of the data
$lineData = array($totalApplications, $underReviewApplications, $underReviewPercentage, $successfulApplications, $successfulPercentage, $rejectedApplications, $rejectedPercentage);
array_walk($lineData, 'filterData');
$excelData .= implode("\t", array_values($lineData)) . "\n";

// Headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
header("Pragma: no-cache");
header("Expires: 0");

// Render excel data
echo $excelData;
