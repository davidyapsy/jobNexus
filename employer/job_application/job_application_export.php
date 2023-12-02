<?php
    session_start();
    if($_SESSION['login']){
    error_reporting(0);
    $connection = new mysqli("localhost", "root", "", "db_jobnexus");

    $employerID = base64_decode($_SESSION['employerID']);
    $jobSeekerName = $_GET['jobSeekerName'];
    $address = $_GET['address'];
    $workingExperiece = $_GET['workingExperience'];
    $skills = $_GET['skills'];
    $salaryExpectation = $_GET['salaryExpectation'];
    $status = $_GET['status'];

    $sql = "SELECT A.applicationID, CONCAT(B.firstName,' ',B.lastName) AS jobSeekerName, B.address, B.working_experience, B.skills, A.salaryExpectation, A.status, C.jobPostingID
    FROM job_application A 
    JOIN job_seeker B ON A.jobSeekerID = B.jobSeekerID
    JOIN job_posting C ON A.jobPostingID = C.jobPostingID
    JOIN job_category D ON C.jobCategoryID = D.jobCategoryID
    WHERE A.jobPostingID = '$jobPostingID' AND C.employerID = '$employerID'";

    $filter_option = "";
    if($jobSeekerName!=""){
        $filter_option.=" AND CONCAT(B.firstName,' ',B.lastName) LIKE '%$jobSeekerName%'";
    }
    if($emailAddress!=""){
        $filter_option.=" AND B.emailAddress LIKE '%$emailAddress%'";
    }
    if($workingExperience!=""){
        $filter_option.=" AND B.working_experience >= $workingExperience";
    }
    if($status!=""){
        $filter_option.=" AND A.status = '$status'";
    }
    if($availableDateFrom!=""){
        $filter_option.=" AND A.availableDate >= '$availableDateFrom'";
    }
    if($availableDateTo!=""){
        $filter_option.=" AND A.availableDate <= '$availableDateTo'";
    }
    //ranking (order by working_experience, education level, field of study, skills, salaryexpectation)
    $filter_option.=" ORDER BY B.working_experience";

    $sql.=$filter_option;

    
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
        
    // Excel file name for download 
    $fileName = "job_application-data_" . date('Y-m-d') . ".xls"; 
        
    // Column names 
    $fields = array('NO.', 'JOB SEEKER NAME', 'ADDRESS', 'WORKING YEAR(S)','SKILLS', 'SALARY EXPECTATION' ,'STATUS'); 
        
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
        
    // Fetch records from database 
    $query = $connection->query($sql); 
    if($query->num_rows > 0){ 
        // Output each row of the data 
        $count=1;
        while($row = $query->fetch_assoc()){ 
            $lineData = array($count, $row['jobSeekerName'], $row['address'], $row['working_experience'], $row['skills'], $row['salaryExpectation'], $row['status']); 
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
}else{
    header("location: /jobnexus/employer/login.php");
}