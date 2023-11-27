<?php
    error_reporting(0);
    $connection = new mysqli("localhost", "root", "", "db_jobnexus");

    $subscriptionPlanID = $_GET['subscriptionPlanID'];
    $startDateFrom = $_GET['startDateFrom'];
    $startDateTo = $_GET['startDateTo'];
    $endDateFrom = $_GET['endDateFrom'];
    $endDateTo = $_GET['endDateTo'];
    $isActive = $_GET['isActive'];

    $sql = "SELECT subscriptionID, planName, startDate, endDate, isActive
        FROM subscription A
        JOIN subscription_plan B ON A.subscriptionPlanID = B.subscriptionPlanID";

    if($subscriptionPlanID!=""){
        $sql.=" AND A.subscriptionPlanID = '$subscriptionPlanID'";
    }
    if($startDateFrom!= NULL){
        $sql.=" AND A.startDate >= $startDateFrom";
    }
    if($startDateTo!= NULL){
        $sql.=" AND A.startDate <= $startDateTo";
    }
    if($endDateFrom!= NULL){
        $sql.=" AND A.endDate >= $endDateFrom";
    }
    if($endDateTo!= NULL){
        $sql.=" AND A.endDate <= $endDateTo";
    }
    if($isActive!=2){
        $sql.=" AND A.isActive = '$isActive'";
    }

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
        
    // Excel file name for download 
    $fileName = "suscription-data_" . date('Y-m-d') . ".xls"; 
        
    // Column names 
    $fields = array('NO.', 'SUBSCRIPTION PLAN', 'START DATE', 'END DATE', 'IS ACTIVE'); 
        
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
        
    // Fetch records from database 
    $query = $connection->query($sql); 
    if($query->num_rows > 0){ 
        // Output each row of the data 
        $count=1;
        while($row = $query->fetch_assoc()){ 
            $lineData = array($count, $row['planName'], $row['startDate'], $row['endDate'], ($row['isActive']=='1'?"Yes":"No")); 
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