<?php
$nameErr = "";
$phoneErr = "";
   session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $passengerName = array();
    $icNum = array();
    $dateBirth = array();
   $gender = array();
        $numPassengers = $_SESSION["guests"];

    for ($i = 1; $i <= $numPassengers; $i++) {
        $passengerName[$i] = $_POST['passengerName'.$i];
        $icNum[$i] = $_POST['icNum'.$i];
        $dateBirth[$i] = $_POST['dateBirth'.$i];
        $gender[$i] = $_POST['gender'.$i];
    }
 
//    $passengerPhone = $_POST['passengerPhone'];
    $emergencyName = $_POST['emergencyName'];
    $emergencyPhone =$_POST['emergencyPhone'];
    $relationship = $_POST['relationship'];

         
   for ($i = 1; $i <= $numPassengers; $i++) {
        $passengerName[$i] = validate($passengerName[$i]);
        $icNum[$i] = validate($icNum[$i]);
        $dateBirth[$i] = validate($dateBirth[$i]);
        $gender[$i] = validate($gender[$i]);
    }
}
    // validate emergency data
//    $passengerPhone = validate($passengerPhone);
    $emergencyName = validate($emergencyName);
    $emergencyPhone = validate($emergencyPhone);
    $relationship= validate($relationship);
      // add passenger and emergency data to user data string
        for ($i = 1; $i <= $numPassengers; $i++) {
        $user_data .= '&passengerName'.$i.'=' . rawurlencode($passengerName[$i]).
        '&icNum'.$i.'=' . rawurlencode($icNum[$i]).
//        '&passengerPhone=' . rawurlencode($passengerPhone).
        '&dateBirth'.$i.'=' . rawurlencode($dateBirth[$i]).
              '&gender'.$i.'=' . rawurlencode($gender[$i]);
        
            // if this is the last iteration and there is only one emergency contact
            if ($i == $numPassengers && !is_array($emergencyName) && !is_array($emergencyPhone)) {
            $user_data .= '&emergencyName=' . urlencode($emergencyName).
                '&emergencyPhone=' . rawurlencode($emergencyPhone).
                 '&relationship=' . rawurlencode($relationship)   ;
        }
        }

//        
        $passengerNameErr[$i] = '';
        $icNumErr[$i] = '';
        $passengerPhoneErr[$i] = '';
        for ($i = 1; $i <= $numPassengers; $i++) {
            if (empty($passengerName[$i])) {
                $passengerNameErr[$i] = "Passenger Name is required";
            } elseif (!preg_match("/^[a-zA-Z ]*$/",$passengerName[$i])) {
                $passengerNameErr[$i] = "Only alphabet and space is allowed for Passenger Name";
            }

            if (empty($icNum[$i])) {
                $icNumErr[$i] = "IC Number is required";
            } elseif (!preg_match("/^\d{6}-\d{2}-\d{4}$/", $icNum[$i])) {
                $icNumErr[$i] = "Incorrect IC Format. Please use format XXXXXX-XX-XXXX";
            }

             if (!empty($passengerNameErr[$i])) {
            header("Location: PassengerDetails.php?passengerNameErr$i=$passengerNameErr[$i]&$user_data");
            exit();
            }

            if (!empty($icNumErr[$i])) {
            header("Location: PassengerDetails.php?icNumErr$i=$icNumErr[$i]&$user_data");
            exit();
            }
            
        }
       
        $emergencyNameErr = '';
        $emergencyPhoneErr = '';
        if (empty($emergencyName)) {
            $emergencyNameErr = "Emergency Contact Name is required";
        } elseif (!preg_match("/^[a-zA-Z ]*$/",$emergencyName)) {
            $emergencyNameErr = "Only alphabet and space is allowed for Emergency Contact Name";
        }
//
            if (empty($emergencyPhone)) {
            $emergencyPhoneErr = "Emergency Phone number is required";
            } 
            elseif (!preg_match("/^\d{10}$/", $emergencyPhone)) {
        $emergencyPhoneErr = "Incorrect Phone Number. The length of phone number should be 10";
        }
        
   
        

           if (!empty($emergencyNameErr)) {
            header("Location: PassengerDetails.php?emergencyNameErr=$emergencyNameErr&$user_data");
            exit();
            }
//
//
        if (!empty($emergencyPhoneErr)) {
            header("Location: PassengerDetails.php?emergencyPhoneErr=$emergencyPhoneErr&$user_data");
            exit();
        }

        
        
//         // Check if there are any errors before redirecting
    if (empty($passengerNameErr[$i]) && empty($icNumErr[$i]) && empty($passengerPhoneErr[$i]) && 
        empty($emergencyNameErr) && empty($emergencyPhoneErr)) {
        // If there are no errors, redirect to the confirmation page
        header("Location: ../Payment.php?" . $user_data);
         for ($x = 1; $x <= $_SESSION["guests"]; $x++) {
            $_SESSION['passengers'][$x]  = array(

             'name' => $passengerName[$x],
             'icNum' => $icNum[$x],
             'dateOfBirth' => $dateBirth[$x],
             'gender' => $gender[$x],

             );
         }
         
        $_SESSION['emergency_name'] = $emergencyName;
        $_SESSION['relationship'] = $relationship;
        $_SESSION['emergencyPhone'] = $emergencyPhone;
        exit();
        }
    

        
?>