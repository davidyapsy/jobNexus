<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Booking</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="PassengerDetails.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="PassengerDetails.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>  

        <nav class="navbar navbar-expand-sm bg-white navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/flight_ticketing_system/Home_Page/index.php">GOGO AIRPLANE</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto d-flex">
                    <li class="nav-item ms-auto">
                        <a class="ms-auto nav-link active" href="/flight_ticketing_system/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        </nav>
        <form action="DetailsCheck.php" method="post">
            <?php
   
            session_start();
            ob_start();
            require_once('../Schedule/departureSchedule.php');
            ob_end_clean();
             $_SESSION['passengers'] = array();
           echo'<h3 class = "title">Guest Details </h3>';
//                    for ($x = 1; $x <= $GLOBALS['guests']; $x++){
            for ($x = 1; $x <= $_SESSION["guests"]; $x++) {
                  if ($x == 1) {
                    echo '
                    <fieldset class="details">
                    <h5>Passenger ' . $x . '</h5>
                    <div class="form-row">  
                    <div class="row g-2">
                        <div class="col-lg-5">
                           <div class="form-floating">';
                    if (isset($_GET['passengerName1'])) {
                        echo '<input type="text" class="form-control" id="passengerName1" name="passengerName1" placeholder="NAME" value="' . $_GET['passengerName1'] . '"><br>';
                    } else {
                        echo '<input type="text" class="form-control" id="passengerName1" name="passengerName1" placeholder="NAME"><br>';
                    }
                    if (isset($_GET['passengerNameErr1'])) {
                        echo '<p class="error">' . $_GET['passengerNameErr1'] . '</p>';
                    }
                    echo'<label for="passengerName1">Name</label>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-floating">';
                    if (isset($_GET['icNum1'])) {
                        echo '<input type="text" class="form-control" id="icNum1" name="icNum1" placeholder="IC NUMBER" value="' . $_GET['icNum1'] . '"><br>';
                    } else {
                        echo '<input type="text" class="form-control" id="icNum1" name="icNum1" placeholder="IC NUMBER"><br>';
                    }
                    if (isset($_GET['icNumErr1'])) {
                        echo '<p class="error">' . $_GET['icNumErr1'] . '</p>';
                    }
                    echo'<label for="icNum1">IC Number</label>
                                
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="form-row">  
                    <div class="row g-2">
                        <div class="col-lg-5">
                           <div class="form-floating">';
                    $dateBirth = isset($_GET['dateBirth1']) ? $_GET['dateBirth1'] : '';
                    echo '<input type="date" class="form-control" id="dateBirth1" name="dateBirth1" placeholder="DD/MM/YYYY" min="1900-01-01" max="' . date('Y-m-d') . '" required value="' . $dateBirth . '">';
                    echo'<label for="dateBirth1">Date Of Birth </label>
                          </div>
                        </div>
                         <div class="col-lg-3">
                            <div class="form-check">';
                            $gender = isset($_GET['gender1']) ? $_GET['gender1'] : '';
                             echo '<input type="radio" class="form-check-input" id="male1" name="gender1" value="male" ' . (($gender == 'male') ? 'checked' : '') . ' checked>';
                             echo' <label class="form-check-label" for="male1">Male</label>
 
                            </div>
                            <div class="form-check">';
                                   echo '<input type="radio" class="form-check-input" id="male1" name="gender1" value="male" ' . (($gender == 'male') ? 'checked' : '') . '>';
                                echo'<label class="form-check-label" for="female1">Female</label>
                            </div>
                        </div>
                    </div>                  
                </div>
                
                </div>
            </fieldset>';
                } else {
                    echo '
            <fieldset class="details">
                <h5>Passenger ' . $x . '</h5>
                <div class="form-row">  
                    <div class="row g-2">
                        <div class="col-lg-5">
                            <div class="form-floating">';
                    if (isset($_GET['passengerName' . $x])) {
                        echo '<input type="text" class="form-control" id="passengerName' . $x . '" name="passengerName' . $x . '" placeholder="NAME" value="' . $_GET['passengerName' . $x] . '"><br>';
                    } else {
                        echo '<input type="text" class="form-control" id="passengerName' . $x . '" name="passengerName' . $x . '" placeholder="NAME"><br>';
                    }
                    if (isset($_GET['passengerNameErr' . $x])) {
                        echo '<p class="error">' . $_GET['passengerNameErr' . $x] . '</p>';
                    }
                    echo'<label for="passengerName' . $x . '">Name</label>
            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-floating">';
                    if (isset($_GET['icNum' . $x])) {
                        echo '<input type="text" class="form-control" id="icNum' . $x . '" name="icNum' . $x . '" placeholder="IC NUMBER" value="' . $_GET['icNum' . $x] . '"><br>';
                    } else {
                        echo '<input type="text" class="form-control" id="icNum' . $x . '" name="icNum' . $x . '" placeholder="IC NUMBER"><br>';
                    }
                    if (isset($_GET['icNumErr' . $x])) {
                        echo '<p class="error">' . $_GET['icNumErr' . $x] . '</p>';
                    }
                    echo'<label for="icNum' . $x . '">IC Number</label>

            </div>
                        </div>
                    </div>                  
                </div>
                <div class="form-row">  
                    <div class="row g-2">
                        <div class="col-lg-5">
                            <div class="form-floating">';
                    $dateBirth = isset($_GET['dateBirth' . $x]) ? $_GET['dateBirth' . $x] : '';
                    echo '<input type="date" class="form-control" id="dateBirth' . $x . '" name="dateBirth' . $x . '" placeholder="DD/MM/YYYY" min="1900-01-01" max="' . date('Y-m-d') . '" required value="' . $dateBirth . '">';
                    echo'<label for="dateBirth' . $x . '">Date Of Birth </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-check">';
                            $gender = isset($_GET['gender' . $x]) ? $_GET['gender' . $x] : '';
                             echo '<input type="radio" class="form-check-input" id="male' . $x . '" name="gender' . $x . '" value="male" ' . (($gender == 'male') ? 'checked' : '') . ' checked>';
                               echo' <label class="form-check-label" for="male' . $x . '">Male</label>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="form-check">';
                           echo '<input type="radio" class="form-check-input" id="female' . $x . '" name="gender' . $x . '" value="female" ' . (($gender == 'female') ? 'checked' : '') . '>';
                    echo' <label class="form-check-label" for="female' . $x . '">Female</label>
                    </div>
                    </div>
                    </div>
                    </div>
      
                    </fieldset>';
                }
                $_SESSION['passengers'][$x]  = array(
                      
                        'name' => isset($_GET['passengerName' . $x]) ? $_GET['passengerName' . $x] : '',
                        'icNum' => isset($_GET['icNum' . $x]) ? $_GET['icNum' . $x] : '',
                        'dateOfBirth' => isset($_GET['dateBirth' . $x]) ? $_GET['dateBirth' . $x] : '',
                        'gender' => isset($_GET['gender' . $x]) ? $_GET['gender' . $x] : '',
              
                    );
//                
                }
//                for ($i = 0; $i <= 3; $i++) {
//                echo "Name: " . $_SESSION['passengers'][$i]['name'] . "<br>";
//                echo "IC Number: " . $_SESSION['passengers'][$i]['icNum'] . "<br>";
//                echo "Date of Birth: " . $_SESSION['passengers'][$i]['dateOfBirth'] . "<br>";
//                echo "Gender: " . $_SESSION['passengers'][$i]['gender'] . "<br>";
//                echo "<br>";
//                }
            ?>
                 <h3 class = "title">Emergency Contact Person Details </h3>
                <p class="description">Please fill in a person who we can contact in case of an emergency. 
                Make sure this person is not a passenger on this flight.</p>
               <fieldset class="details">
                <div class="form-row">  
                    <div class="row g-2">
                        <div class="col-lg-5">
                            <div class="form-floating">
                     <?php if (isset($_GET['emergencyName'])) { ?>
                                <input type="text" 
                                       class="form-control"
                                       id="emergencyName"
                                       name="emergencyName" 
                                       placeholder="NAME"
                                       value="<?php echo $_GET['emergencyName']; ?>"><br>
                                
                                <?php } else { ?>
                                    <input type="text" 
                                           class="form-control"
                                           id="emergencyName"
                                           name="emergencyName" 
                                           placeholder="NAME"><br>
                                <?php } ?>
                                <label for="emergencyName">Emergency Name</label>    
                               <?php if (isset($_GET['emergencyNameErr'])) {
                        echo '<p class="error">' . $_GET['emergencyNameErr'] . '</p>';
                            }?>
                              </div>
                    </div>   
                       <div class="col-lg-5">
                    <div class="form-floating">
                        <select class="form-select" id="relationship" name="relationship" placeholder="Relationship">
                            <option>----------</option>
                            <option value="child" <?php if (isset($_GET['relationship']) && $_GET['relationship'] == 'child') { echo 'selected'; } ?>>Child</option>
                            <option value="parent" <?php if (isset($_GET['relationship']) && $_GET['relationship'] == 'parent') { echo 'selected'; } ?>>Parent</option>
                            <option value="friend" <?php if (isset($_GET['relationship']) && $_GET['relationship'] == 'friend') { echo 'selected'; } ?>>Friend</option>
                            <option value="relative" <?php if (isset($_GET['relationship']) && $_GET['relationship'] == 'relative') { echo 'selected'; } ?>>Relative</option>
                            <option value="other" <?php if (isset($_GET['relationship']) && $_GET['relationship'] == 'other') { echo 'selected'; } ?>>Other</option>
                        </select>
                        <label for="relationship">Relationship</label>
                    </div>
                </div>

              </div>
                    </div>
                         <div class="form-row">
                    <div class="row g-2">
                        <div class="col-lg-5">
                           <div class="form-floating">

                    <?php if (isset($_GET['emergencyPhone'])) {
                        echo '<input type="text" class="form-control" id="emergencyPhone" name="emergencyPhone" placeholder="MOBILE PHONE NUMBER" value="' . $_GET['emergencyPhone'] . '"><br>';
                        
                    } else {
                        echo '<input type="text" class="form-control" id="emergencyPhone" name="emergencyPhone" placeholder="MOBILE PHONE NUMBER"><br>';
                    }
                    if (isset($_GET['emergencyPhoneErr'])) {
                        echo '<p class="error">' . $_GET['emergencyPhoneErr'] . '</p>';
                    }
           
                        ?>
                            <label for="$emergencyPhone">Phone Number</label>
                        </div>
                        </div>
                    </div>
                    </div>
      
            </fieldset>
                <button type = "submit" class = "continue" style ="float: right">Next</button>   
      </form>
    </body>
</html>
                    