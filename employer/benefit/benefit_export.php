<?php
    session_start();
    error_reporting(0);
    $connection = new mysqli("localhost", "root", "", "db_jobnexus");

    $employerID = base64_decode($_SESSION['employerID']);
    $benefitTitle = $_GET['benefitTitle'];
    $benefitDescription = $_GET['benefitDescription'];

    $sql = "SELECT benefitID, benefitTitle, benefitDescription, icon
        FROM benefit
        WHERE employerID = '$employerID' AND isDeleted=0 ";

    $filter_options ="";
    if($benefitTitle!=""){
        $filter_options.=" AND benefitTitle LIKE '%$benefitTitle%'";
    }
    if($benefitDescription!=""){
        $filter_options.=" AND benefitDescription LIKE '%$benefitDescription%'";
    }
    $filter_options.=" ORDER BY benefitID";
    $sql.=$filter_options;

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
        
    // Excel file name for download 
    $fileName = "benefit-data_" . date('Y-m-d') . ".xls"; 
        
    // Column names 
    $fields = array('NO.', 'TITLE', 'DESCRIPTION', 'ICON'); 
        
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
        
    // Fetch records from database 
    $query = $connection->query($sql); 
    if($query->num_rows > 0){ 
        // Output each row of the data 
        $count=1;
        while($row = $query->fetch_assoc()){ 
            $lineData = array($count, $row['benefitTitle'], $row['benefitDescription'], $row['icon']); 
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