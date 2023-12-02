<?php
session_start();
include './db_conn.php';

$conditions = array();
$isFilter = false;

if(isset($_SESSION['rJobType'])){
    $rJobType = $_SESSION['rJobType'];
    $conditions[] = "job_posting.employmentType = '$rJobType'";
    $isFilter = true;
}

if(isset($_SESSION['rIndustry'])){
    $rIndustry = $_SESSION['rIndustry'];
    $conditions[] = "job_category.categoryName LIKE '%$rIndustry%'";
    $isFilter = true;
}

if(isset($_SESSION['rsDate']) && isset($_SESSION['reDate'])){
    $rsDate = $_SESSION['rsDate'];
    $reDate = $_SESSION['reDate'];
    $conditions[] = "job_application.applicationDate BETWEEN '$rsDate' AND '$reDate'";
    $isFilter = true;
}

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

$jsID = $_SESSION['jobSeekerID'];
if($isFilter){
    $whereClause = implode(' AND ', $conditions);
    $sql = "SELECT `job_application`.*, `employer`.*, `job_posting`.*, `job_category`.*
    FROM `job_application`
    JOIN `job_posting` ON `job_application`.`jobPostingID` = `job_posting`.`jobPostingID`
    JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
    LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
    WHERE `job_application`.`jobSeekerID` = '$jsID' AND $whereClause;";
}else{
    $sql = "SELECT `job_application`.*, `employer`.*, `job_posting`.*, `job_category`.*
    FROM `job_application`
    JOIN `job_posting` ON `job_application`.`jobPostingID` = `job_posting`.`jobPostingID`
    JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
    LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
    WHERE `job_application`.`jobSeekerID` = '$jsID';";
}

// Excel file name for download 
$fileName = "JobApplicationReport" . $jsID . date('Ymd') . ".xls"; 

// Column names 
$fields = array('NO', 'JOB CATEGORY', 'JOB TYPE', 'JOB TITLE', 'COMPANY' ,'DATE APPLY'); 

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

// Fetch records from database 
$query = $conn->query($sql);
if($query->num_rows > 0){ 
    // Output each row of the data 
    $count=1;
    while($row = $query->fetch_assoc()){ 
        $lineData = array($count, $row['categoryName'], $row['employmentType'], $row['jobTitle'], $row['companyName'], $row['applicationDate']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        $count++;
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 

// Headers for download 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
header("Content-Type: application/vnd.ms-excel"); 
header("Pragma: no-cache");  
header("Expires: 0");  

// Render excel data 
echo $excelData; 