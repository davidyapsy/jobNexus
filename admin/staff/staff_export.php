<?php
    $connection = new mysqli("localhost", "root", "", "flight_ticketing");
    $name = $_GET['staffName'];
    $phoneNumber = $_GET['phoneNumber'];
    $emailAddress = $_GET['emailAddress'];
    $status = $_GET['status'];
    $position = $_GET['position'];

    $sql = "SELECT name, phone_number, email_address, status, position
    FROM staff
    WHERE is_deleted = 0";

    if($name!=""){
        $sql.=" AND UPPER(name) LIKE '$name%'";
    }
    if($phoneNumber!=""){
        $sql.=" AND phone_number LIKE '$phoneNumber%'";
    }
    if($emailAddress!=""){
        $sql.=" AND email_address LIKE '$emailAddress%'";
    }
    if($status!=""){
        $sql.=" AND status = '$status'";
    }
    if($position!=""){
        $sql.=" AND position = '$position'";
    }
    $sql.=" ORDER BY staff_id ASC";

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
        
    // Excel file name for download 
    $fileName = "staff-data_" . date('Y-m-d') . ".xls"; 
        
    // Column names 
    $fields = array('NO.', 'STAFF NAME', 'PHONE NUMBER', 'EMAIL ADDRESS','STATUS' ,'POSITION'); 
        
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
        
    // Fetch records from database 
    $query = $connection->query($sql); 
    if($query->num_rows > 0){ 
        // Output each row of the data 
        $count=1;
        while($row = $query->fetch_assoc()){ 
            $lineData = array($count, $row['name'], $row['phone_number'], $row['email_address'], $row['status'], $row['position']); 
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