<?php
    session_start();
    if($_SESSION['login']){
    error_reporting(0);
    $connection = new mysqli("localhost", "root", "", "db_jobnexus");

    $employerID = base64_decode($_SESSION['employerID']);
    $jobPostingID = base64_decode($_GET['id']);
    $jobSeekerName = $_GET['jobSeekerName'];
    $address = $_GET['address'];
    $workingExperiece = $_GET['workingExperience'];
    $educationLevel = $_GET['educationLevel'];
    $fieldOfStudy = $_GET['fieldOfStudy'];
    $institution = $_GET['institution'];

    //job category details
    $sql = "SELECT keywords
            FROM job_category A
            JOIN job_posting B ON A.jobCategoryID = B.jobCategoryID
            WHERE B.jobPostingID = '$jobPostingID' AND B.employerID = '$employerID'";
    $result = $connection->query($sql);
    $jobCategoryData =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $jobCategoryData = $row;
    }

    $keywordsArr = explode(',', $jobCategoryData['keywords']);

    $sql = "SELECT A.applicationID, CONCAT(B.firstName,' ',B.lastName) AS jobSeekerName, B.address, B.working_experience, B.educationLevel, A.fieldOfStudy, A.institution, C.jobPostingID
    FROM job_application A 
    JOIN job_seeker B ON A.jobSeekerID = B.jobSeekerID
    JOIN job_posting C ON A.jobPostingID = C.jobPostingID
    JOIN job_category D ON C.jobCategoryID = D.jobCategoryID
    WHERE A.jobPostingID = '$jobPostingID' AND C.employerID = '$employerID'";

    $filter_option = "";
    if($jobSeekerName!=""){
        $filter_option.=" AND CONCAT(firstName,' ',lastName) LIKE '%$jobSeekerName%'";
    }
    if($address!=""){
        $filter_option.=" AND address LIKE '%$address%'";
    }
    if($workingExperience!=0){
        $filter_option.=" AND working_experience >= $workingExperience";
    }
    if($educationLevel!=""){
        $filter_option.=" AND education_level LIKE '%$educationLevel%'";
    }
    if($fieldOfStudy!=""){
        $filter_option.=" AND field_of_study LIKE '%$fieldOfStudy%'";
    }
    if($institution!=""){
        $filter_option.=" AND institution LIKE '%$institution%'";
    }
    $jobSeekerData =[];
    foreach($keywordsArr as $keyword){
        //job seeker details
        $sql = "SELECT CONCAT(firstName, ' ', lastName) as jobSeekerName, address, working_experience, education_level, field_of_study, institution
                FROM job_seeker 
                WHERE isOpenForJobs = 1 AND (UPPER(field_of_study) LIKE UPPER('%$keyword%') OR UPPER(skills) LIKE UPPER('%$keyword%'))";
        $sql.=$filter_option;
        $result = $connection->query($sql);
        while(($row = $result->fetch_assoc())==TRUE){
            $jobSeekerData[] = $row;
        }
    }
    $jobSeekerData  = (array_unique($jobSeekerData, SORT_REGULAR));

    
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
        
    // Excel file name for download 
    $fileName = "job_application_potential_candidate_export-data_" . date('Y-m-d') . ".xls"; 
        
    // Column names 
    $fields = array('NO.', 'JOB SEEKER NAME', 'ADDRESS', 'WORKING YEAR(S)','EDUCATION LEVEL', 'FIELD OF STUDY' ,'INSTITUTION'); 
        
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
    // Fetch records from database 
    if(sizeof($jobSeekerData) > 0){ 
        // Output each row of the data 
        $count=1;
        foreach($jobSeekerData as $row){
            $lineData = array($count, $row['jobSeekerName'], $row['address'], $row['working_experience'], $row['education_level'], $row['field_of_study'], $row['institution']); 
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