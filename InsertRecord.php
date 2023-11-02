<?php

session_start();
include "conn.php";

$emergency_name = $_SESSION['emergency_name'];
$emergency_phone = $_SESSION['emergencyPhone'];
$relationship = $_SESSION['relationship'];
$departureScheduleID = $_SESSION["departureScheduleID"];
$returnScheduleID = $_SESSION["returnScheduleID"];
$passengers = array();
$passenger = $_SESSION['passengers'];
$bookingDate = date("Y-m-d");
$departure_date = $_SESSION["departure_date"];
if (!empty($_SESSION["return_date"])) {
    $return_date = $_SESSION["return_date"];
}
date_default_timezone_set('Asia/Kuala_Lumpur');
$bookingTime = date('H:i:s');
$guest = $_SESSION["guests"];
$passengerID = array();

//done
//Insert Emergency Contact //1
//emergency id auto_increment
$sql = "INSERT INTO `emergency_contact`(`contact_name`, `relationship`, `contact_phone_num`) "
        . "VALUES ('$emergency_name', '$relationship', '$emergency_phone')";

if ($conn->query($sql) === TRUE) {
    $emergencyContactID = mysqli_insert_id($conn);
} else {
    echo "Error creating table: " . $conn->error;
}

//DONE
//Insert Passenger //2
//passengerid auto increment
for ($i = 1; $i <= $guest; $i++) {
    $name = $passenger[$i]['name'];
    $icNum = $passenger[$i]['icNum'];
    $dob = $passenger[$i]['dateOfBirth'];
    $gender = $passenger[$i]['gender'];

    $sql = "INSERT INTO `passenger`(`passenger_name`, `ic_number`, `date_of_birth`, `gender`) "
            . "VALUES ('" . $name . "', '" . $icNum . "', '" . $dob . "', '" . $gender . "')";

    if ($conn->query($sql) === TRUE) {
        $passengerID[$i] = array(
            'id' => mysqli_insert_id($conn),
        );
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

//}
// print_r($passengerID);
//for ($i = 0; $i <=$guest; $i++) {
//    echo "Passenger ID: " . $passengerID[$i] . "<br>";
//}
//display the passenger details
//      for ($i = 1; $i <= 3; $i++) {
//                echo "Name: " . $passenger[$i]['name'] . "<br>";
//                echo "IC Number: " . $passenger[$i]['icNum'] . "<br>";
//                echo "Date of Birth: " . $passenger[$i]['dateOfBirth'] . "<br>";
//                echo "Gender: " . $passenger[$i]['gender'] . "<br>";
//                echo "<br>";
//            }
////Insert Booking
////booking id auto_increment
//change salesID, customerID,totalAmount

$amount = $_COOKIE['js_var_value'];
$currency = "MYR";
$txn_id = rand(0000000000, 9999999999);

$status = "Successful";

$paymentSql = "INSERT INTO payment(`payment_status`, `amount_paid`, `currency`, `txn_id`) VALUES "
        . "('$status','$amount','$currency','$txn_id');";

$paymentResult = $conn->query($paymentSql);

if ($paymentResult === true) {
    $paymentID = mysqli_insert_id($conn);
    $_SESSION["payment_Id"] = $paymentID;
} else {
    echo "ERROR: problem with the payment part! "
    . mysqli_error($conn);
}

//Update the depart seat details 
$seatRow = $_COOKIE['pasdr1'];
$seatColumn = $_COOKIE['pasdc1'];
if ($seatColumn != 0) {
    for ($i = 1; $i <= $_SESSION["guests"]; $i++) {

        if ($i == 2) {
            $seatRow = $_COOKIE['pasdr2'];
            $seatColumn = $_COOKIE['pasdc2'];
        } else if ($i == 3) {
            $seatRow = $_COOKIE['pasdr3'];
            $seatColumn = $_COOKIE['pasdc3'];
        } else if ($i == 4) {
            $seatRow = $_COOKIE['pasdr4'];
            $seatColumn = $_COOKIE['pasdc4'];
        } else if ($i == 5) {
            $seatRow = $_COOKIE['pasdr5'];
            $seatColumn = $_COOKIE['pasdc5'];
        }

        $updateSql = "SELECT seat_id FROM seat WHERE seat_row =" . $seatRow . " AND seat_column = " . $seatColumn;

        $updateResult = $conn->query($updateSql);
        $rowReturn = $updateResult->fetch_assoc();

        $update2Sql = "UPDATE seat_detail SET availability = 'N' WHERE seat_id =" . $rowReturn['seat_id'] . " AND airplane_id = " . $_SESSION["departure_airplane_id"];

        $update2Result = $conn->query($update2Sql);
        if ($update2Result === true) {
            
        } else {
            echo "ERROR: Problem with the updating part "
            . mysqli_error($conn);
        }
    }
}

////Update the arrival seat details 
if ($_SESSION["trip"] != "One") {
    $seatRow2 = $_COOKIE['pasar1'];
    $seatColumn2 = $_COOKIE['pasac1'];
    if ($seatRow2 != 0) {
        for ($i = 1; $i <= $_SESSION["guests"]; $i++) {

            if ($i == 2) {
                $seatRow2 = $_COOKIE['pasar2'];
                $seatColumn2 = $_COOKIE['pasac2'];
            } else if ($i == 3) {
                $seatRow2 = $_COOKIE['pasar3'];
                $seatColumn2 = $_COOKIE['pasac3'];
            } else if ($i == 4) {
                $seatRow2 = $_COOKIE['pasar4'];
                $seatColumn2 = $_COOKIE['pasac4'];
            } else if ($i == 5) {
                $seatRow2 = $_COOKIE['pasar5'];
                $seatColumn2 = $_COOKIE['pasac5'];
            }

            $updateSql = "SELECT seat_id FROM seat WHERE seat_row =" . $seatRow2 . " AND seat_column = " . $seatColumn2;

            $updateResult3 = $conn->query($updateSql);
            $rowReturn2 = $updateResult3->fetch_assoc();

            $update2Sql = "UPDATE seat_detail SET availability = 'N' WHERE seat_id =" . $rowReturn2['seat_id'] . " AND airplane_id = " . $_SESSION["returnairplaneID"];

            $update2Result = $conn->query($update2Sql);
        }
    }
}



if (empty($_SESSION["return_date"])) {
    $return_date = "";
}
$amount = $_COOKIE['js_var_value'];
$paymentID = $_SESSION["payment_Id"];
$sql = "INSERT INTO `booking`(`payment_id`, `emergency_contact_id`, `customer_id`, `booking_date`, `booking_time`, `total_passenger`, `total_amount`, `departure_date`, `return_date`) VALUES "
        . "($paymentID, '$emergencyContactID', 2, '$bookingDate', '$bookingTime', '$guest', '$amount', '$departure_date', '$return_date')";

if ($conn->query($sql) === TRUE) {
    $bookingID = mysqli_insert_id($conn);
} else {
    echo "Error creating table: " . $conn->error;
}
// for ($i = 1; $i <= $guest; $i++) {
// 
// }
////Insert Ticket
// //ticket id auto_increment
//departure ticket
for ($i = 1; $i <= $guest; $i++) {
    $passID = $passengerID[$i]['id'];
    $sql = "INSERT INTO `ticket`(`flight_schedule_id`, `booking_id`, `passenger_id`) "
            . "VALUES ('$departureScheduleID','$bookingID','$passID')";

    if ($conn->query($sql) === TRUE) {
        
    } else {
        echo "Error inserting record " . $conn->error;
    }
}

if (!empty($_SESSION["return_date"])) {
//return ticket
    for ($i = 1; $i <= $guest; $i++) {
        $passID = $passengerID[$i]['id'];
        $sql = "INSERT INTO `ticket`(`flight_schedule_id`, `booking_id`, `passenger_id`) "
                . "VALUES ('$returnScheduleID','$bookingID','$passID')";

        if ($conn->query($sql) === TRUE) {
            
        } else {
            echo "Error inserting record " . $conn->error;
        }
    }
}

//insert luggage 
for ($i = 1; $i <= $guest; $i++) {
    $passID = $passengerID[$i]['id'];
    $value = "dp" . $i;
    $weight = $_COOKIE[$value];
    $price = 0;
    if ($weight == "20") {
        $price = 100.60;
    } else if ($weight == "25") {
        $price = 125.60;
    } else if ($weight == "30") {
        $price = 150.60;
    } else if ($weight == "40") {
        $price = 175.60;
    }

    if ($weight != "") {
        $sql = "INSERT INTO `luggage`(`passenger_id`, `weight`, `price`) "
                . "VALUES ('$passID','$weight','$price')";

        if ($conn->query($sql) === TRUE) {
            
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }

    $value2 = "ap" . $i;
    $weight2 = $_COOKIE[$value2];
    if ($weight2 == "20") {
        $price = 100.60;
    } else if ($weight2 == "25") {
        $price = 125.60;
    } else if ($weight2 == "30") {
        $price = 150.60;
    } else if ($weight2 == "40") {
        $price = 175.60;
    }
    if ($weight2 != "") {
        $sql = "INSERT INTO `luggage`(`passenger_id`, `weight`, `price`) "
                . "VALUES ('$passID','$weight2','$price')";

        if ($conn->query($sql) === TRUE) {
            
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
}





