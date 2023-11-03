<?php
    error_reporting(0);
    $connection = new mysqli("localhost", "root", "", "flight_ticketing");

    $origin = $_GET['origin'];
    $destination = $_GET['destination'];
    $airplaneId = $_GET['airplaneId'];
    $departureTimeFrom = $_GET['departureTimeFrom'];
    $departureTimeTo = $_GET['departureTimeTo'];
    $departureDay = $_GET['departureDay'];

    $sql = "SELECT A.flight_schedule_id, B.origin, B.destination, C.name, A.departure_time, A.arrival_time, A.departure_day
    FROM flight_schedule A
    JOIN route B ON A.route_id = B.route_id
    JOIN airplane C ON A.airplane_id = C.airplane_id
    WHERE starting_date >= '2000-01-01'";

    if($origin!=""){
        $sql.=" AND B.origin = '$origin'";
    }
    if($destination!=""){
        $sql.=" AND B.destination = '$destination'";
    }
    if($airplaneId!=0){
        $sql.=" AND A.airplane_id = $airplaneId";
    }
    if($departureDay!=""){
        $sql.=" AND A.departure_days LIKE '%$departureDay%'";
    }
    if($departureTimeFrom!=""){
        $sql.=" AND A.departure_time >= '$departureTimeFrom'";
    }
    if($departureTimeTo!=""){
        $sql.=" AND A.departure_time <= '$departureTimeTo'";
    }
    $sql.=" ORDER BY flight_schedule_id ASC";

    
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
        
    // Excel file name for download 
    $fileName = "flight_schedule-data_" . date('Y-m-d') . ".xls"; 
        
    // Column names 
    $fields = array('NO.', 'ORIGIN', 'DESTINATION', 'AIRPLANE','DEPARTURE TIME' ,'ARRIVAL TIME', 'DEPARTURE DAYS'); 
        
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
        
    // Fetch records from database 
    $query = $connection->query($sql); 
    if($query->num_rows > 0){ 
        // Output each row of the data 
        $count=1;
        while($row = $query->fetch_assoc()){ 
            $lineData = array($count, $row['origin'], $row['destination'], $row['name'], $row['departure_time'], $row['arrival_time'], $row['departure_day']); 
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