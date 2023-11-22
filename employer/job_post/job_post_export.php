<?php
    error_reporting(0);
    $connection = new mysqli("localhost", "root", "", "db_jobnexus");

    $jobCategoryID = $_GET['jobCategoryID'];
    $jobTitle = $_GET['jobTitle'];
    $locationState = $_GET['locationState'];
    $employmentType = $_GET['employmentType'];
    $salary = $_GET['salary'];
    $isPublish = $_GET['isPublish'];

    //employerID
    $sql = "SELECT jobPostingID, B.categoryName, jobTitle, locationState, employmentType, salary, isPublish
    FROM job_posting A
    JOIN job_category B ON A.jobCategoryID = B.jobCategoryID
    WHERE employerID = 'E2300000' AND isDeleted=0 ";

    if($jobCategoryID!=""){
        $sql.=" AND B.jobCategoryID = '$jobCategoryID'";
    }
    if($jobTitle!=""){
        $sql.=" AND jobTitle LIKE '%$jobTitle%'";
    }
    if($locationState!=""){
        $sql.=" AND locationState = '$locationState'";
    }
    if($employmentType!=""){
        $sql.=" AND A.employmentType = '$employmentType'";
    }
    if($salary!= NULL){
        $sql.=" AND A.salary >= $salary";
    }
    if($isPublish!=""){
        $sql.=" AND A.isPublish = '$isPublish'";
    }
    $sql.=" ORDER BY publishDate";

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
        
    // Excel file name for download 
    $fileName = "job_post-data_" . date('Y-m-d') . ".xls"; 
        
    // Column names 
    $fields = array('NO.', 'JOB CATEGORY', 'JOB TITLE', 'LOCATION (STATE)','EMPLOYMENT TYPE' ,'SALARY', 'PUBLISHMENT'); 
        
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
        
    // Fetch records from database 
    $query = $connection->query($sql); 
    if($query->num_rows > 0){ 
        // Output each row of the data 
        $count=1;
        while($row = $query->fetch_assoc()){ 
            $lineData = array($count, $row['categoryName'], $row['jobTitle'], $row['locationState'], $row['employmentType'], $row['salary'], $row['isPublish']); 
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