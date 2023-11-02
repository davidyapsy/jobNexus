<!DOCTYPE html>
<html>
    <head>
        <title>Schedule</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="Booking.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="Schedule.css">
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
    <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_SESSION["trip"] = $_POST["trip"];
                $_SESSION["guests"] = $_POST["guests"];
                $_SESSION["from"] = $_POST["departure"];
                $_SESSION["to"] = $_POST["destination"];
                $_SESSION["departure_date"] = date('Y-m-d', strtotime($_POST["depart_date"]));
                
        if(isset($_POST['trip']) && $_POST['trip'] =="One"){
            $_SESSION["return_date"] = "";
        }else{
             $_SESSION["return_date"] = date('Y-m-d', strtotime($_POST["return_date"]));
        }
        }
       

        $trip = $_SESSION["trip"];
        $guests = $_SESSION["guests"];
        $origin = $_SESSION["from"];
        $destination = $_SESSION["to"];
        $depart_date = $_SESSION["departure_date"];
        $day = date('l', strtotime($depart_date));
        $return_date =  $_SESSION["return_date"];
        // Set the start and end date
        $start_date = '2023-05-09';
        $end_date = '2023-06-30';

        // Get an array of dates between the start and end date
        $dates = array();
        $date = strtotime($start_date);
        while ($date <= strtotime($end_date)) {
            $dates[] = date('Y-m-d', $date);
            $date = strtotime('+1 day', $date);
        }

        // Set the number of buttons to show per page
        $buttons_per_page = 7;

        // Get the current page from the query string, default to 1 if not set
        $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

        // Calculate the start and end indexes for the buttons to show on the current page
        $start_index = ($current_page - 1) * $buttons_per_page;
        $end_index = $start_index + $buttons_per_page;

        // Get the buttons to show on the current page
        $buttons = array_slice($dates, $start_index, $buttons_per_page);

        // Get the selected date from the query string, default to the first date if not set
        $selected_date = isset($_GET['date']) ? $_GET['date'] : $depart_date;

       // Check if a date button was clicked and update the selected date accordingly
        if (isset($_GET['clicked_date'])) {
            $selected_date = $_GET['clicked_date'];
            $depart_date = $selected_date;
        }
        // Calculate the number of pages
        $num_pages = ceil(count($dates) / $buttons_per_page);
        ?>

       <div class="date-block">
            <?php if ($current_page > 1): ?>
                <a href="?page=<?php echo $current_page - 1; ?>&date=<?php echo urlencode($selected_date); ?>" class="previous-button">&lt;</a>
            <?php endif; ?>

            <?php foreach ($buttons as $date): ?>
                <?php $class = ($selected_date == $date) ? 'selected' : ''; ?>
                <a href="?page=<?php echo $current_page; ?>&date=<?php echo urlencode($date); ?>&clicked_date=<?php echo urlencode($date); ?>">
                    <button class="<?php echo $class; ?>"><?php echo $date; ?></button>
                </a>
            <?php endforeach; ?>

            <?php if ($current_page < $num_pages): ?>
                <a href="?page=<?php echo $current_page + 1; ?>&date=<?php echo urlencode($selected_date); ?>" class="next-button">&gt;</a>
            <?php endif; ?>
        </div>

        <script>
            function setSelectedDate(date) {
                var urlParams = new URLSearchParams(window.location.search);
                urlParams.set('clicked_date', date);
                window.location.search = urlParams.toString();
            }
        </script>
          
        
       <?php    
        // Connect to the database
         include "../conn.php";
        if(isset($_GET['clicked_date'])){
            $sql = "SELECT fs.flight_schedule_id, fs.route_id, fs.airplane_id, fs.departure_time, fs.arrival_time, fs.departure_day, fs.price, r.origin, r.destination, r.time_taken_hour, r.time_taken_min, ap.name 
                FROM flight_schedule fs 
                JOIN route r ON fs.route_id = r.route_id 
                JOIN airplane ap ON fs.airplane_id = ap.airplane_id 
                JOIN seat_detail sd ON ap.airplane_id = sd.airplane_id 
                WHERE fs.departure_day = DAYNAME('$selected_date')
                  AND r.origin = '$origin' 
                  AND r.destination = '$destination' 
                   AND starting_date >= '2000-01-01'
                GROUP BY fs.flight_schedule_id;";
                $day = date('l', strtotime($selected_date));
        }
        else{
         $sql = "SELECT fs.flight_schedule_id, fs.route_id, fs.airplane_id, fs.departure_time, fs.arrival_time, fs.departure_day, fs.price, r.origin, r.destination, r.time_taken_hour, r.time_taken_min, ap.name 
                FROM flight_schedule fs 
                JOIN route r ON fs.route_id = r.route_id 
                JOIN airplane ap ON fs.airplane_id = ap.airplane_id 
                JOIN seat_detail sd ON ap.airplane_id = sd.airplane_id 
                WHERE fs.departure_day = DAYNAME('$depart_date')
                  AND r.origin = '$origin' 
                  AND r.destination = '$destination' 
                   AND starting_date >= '2000-01-01'
                GROUP BY fs.flight_schedule_id;";  
        }

            $result = $conn->query($sql);
       echo'<h2 class="departure" style="margin:20px 20px 20px 700px;">Departure</h2>';
      if ($result->num_rows > 0) {
          // output data of each row
           while($row = $result->fetch_assoc()) {
               //if round trip> return schedule, else > add on
               if($trip == "Round"){
                    echo'<form action="returnSchedule.php" method="post">';
               }else{
                   echo'<form action="../addOns.php" method="post">';
               }
                echo '<fieldset class="schedule">';
                echo '<div>';
                echo '<img src="logo.jpeg" alt="Logo" style="width:70px;height:70px;">';
                echo '<span class="firstRow">' . $row["departure_time"] . '</span>';
                echo '<span class="firstRow">' . $row["arrival_time"] . '</span>';
                echo '<span class="firstRow">'. $row["time_taken_hour"].' hours '.$row["time_taken_min"].'min</span>';
                echo '</div>';
                echo '<span class="secondRow">--------------></span>';
                echo '<span class="luggage">20kg</span>';
                echo '<span class="price">RM '.$row["price"].'/pax</span>';
                echo '<div>';
                echo '<span>Gogo Flight</span>';
                echo '<span class="thirdRow">'.$row["origin"] .'</span>';
                echo '<span class="thirdRow">'.$row["destination"] .'</span>';
                echo '<span class="thirdRow">Direct</span>';
                echo '</div>';
                echo '<div class="dropdown">';   
                echo'<button type = "submit" class="submit-btn">Choose Flight</button>';
                echo '<div class="dropdown-content">';
                echo '<div class="line"></div>';
                echo '<div>';
                echo '<span class = "details">Flight : '.$row["name"] .'</span>';
                echo '<span class = "details">Duration : '.$row["time_taken_hour"].' hours '.$row["time_taken_min"].'min</span>';
                echo '</div>';
                echo '<div>';
                echo '<span class = "departure">Departs:</span><br>';
                echo '<span class = "departure">'.$day.'  '.$row["departure_time"].'</span><br>';
                echo '<span class = "departure">'.$row["origin"].'</span>';
                echo '</div>';
                echo '<span class = "basicLuggage">Complimentary baggage allowance</span><br>';
                echo '<span class = "basicLuggage">This price you are paying includes the following for each person</span><br>';
                echo '<span class = "basicLuggage">7kg x 1</span>';
                echo '<div>';
                echo '<span class = "arrives">Arrives:</span><br>';
                echo '<span class = "arrives">'.$day.'  '.$row["arrival_time"].'</span><br>';
                echo '<span class = "arrives">'.$row["destination"].'</span>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</fieldset>';
                echo '<input type="hidden" name="departure_time" value="'.$row["departure_time"].'">';
                echo '<input type="hidden" name="airplane_id" value="'.$row["airplane_id"].'">';
                echo '<input type="hidden" name="arrival_time" value="'.$row["arrival_time"].'">';
                echo '<input type="hidden" name="time_taken_hour" value="'.$row["time_taken_hour"].'">';
                echo '<input type="hidden" name="time_taken_min" value="'.$row["time_taken_min"].'">';
//                echo '<input type="hidden" name="origin" value="'.$row["origin"].'">';
//                echo '<input type="hidden" name="destination" value="'.$row["destination"].'">';
                echo '<input type="hidden" name="flightScheduleID" value="'.$row["flight_schedule_id"].'">';
                echo '<input type="hidden" name="flight_name" value="'.$row["name"].'">';
//                echo '<input type="hidden" name="guests" value="'.$guests.'">';
                echo '<input type="hidden" name="depart_date" value="'.$depart_date.'">';
//                echo '<input type="hidden" name="return_date" value="'.$return_date.'">';
                echo'</form>';
            }
        } else {
            echo '<p class = "NotFound" style="margin:200px 500px 200px 700px;">No flight schedule found</p>';
        }  
        ?>
    </body>
</html>
