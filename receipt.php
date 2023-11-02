
<html>
    <head>
        <title>Payment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <?php include 'InsertRecord.php';?>
        <style>
            body{
                background-color:#e6e8e6;
            }
            div.content{
                box-sizing: border-box;
                max-width: 1000px;
                display: block;
                padding: 0px 10px;
                margin: 0px auto;
            }
            .panel{
                position: relative;
                background-color: rgb(255, 255, 255);
                cursor: pointer;
                border-width: 1px;
                border-style: solid;
                border-color: rgb(191, 197, 207);
                border-image: initial;
                border-radius: 4px;

            }
            .info-container{
                display: table;

                width: 100%;
                padding: 15px 25px;
                box-sizing: border-box;
                background-color: white;
                margin-bottom: 15px;
            }


            .payment--options {
                width: calc(100% - 40px);
                display: grid;
                grid-template-columns: 33% 34% 33%;
                gap: 20px;
                padding: 10px;
            }

            .payment--options button {
                height: 55px;
                background: #F2F2F2;
                border-radius: 11px;
                padding: 0;
                border: 0;
                outline: none;
            }

            .payment--options button svg {
                height: 18px;
            }

            .payment--options button:last-child svg {
                height: 22px;
            }

            .purchase--btn {
                height: 55px;
                background: #F2F2F2;
                border-radius: 11px;
                border: 0;
                outline: none;
                color: #ffffff;
                font-size: 13px;
                font-weight: 700;
                background: linear-gradient(180deg, #363636 0%, #1B1B1B 50%, #000000 100%);
                box-shadow: 0px 0px 0px 0px #FFFFFF, 0px 0px 0px 0px #000000;
                transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
            }

            .airplaneIcon{

                width: 50px;
                height: 50px;
                vertical-align: middle;
            }
            .panelHeader{
                display: table-cell;
                padding: 0 0 0 20px;
                font-size: 0.9rem;
                box-sizing: border-box;

            }
            .divBottomDesc{
                padding: 16px 32px 16px 16px;
                border-radius: 4px;
                background-color: #f8f9fa75;

            }
            .divBottomArrivalBaggage{
                display: table-cell;
                padding: 0 0 0 20px;
                font-size: 1.2rem;
                font-weight: 500;
                box-sizing: border-box;
                width:234px;
            }
            .leftDescription{
                width:50%;
            }
            .totalTicketPrice{
                float:right;
            }
            .totalTicketDescription{
                width:50%;
            }
            .ticketDescTotal{
                width: 100%;
                border-collapse: collapse;
            }

            /*for the payment card design*/
            .card {
                width: 240px;
                height: 254px;
                padding: 0 15px;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                gap: 12px;
                background: #fff;
                border-radius: 20px;
            }

            .card > * {
                margin: 0;
            }

            .card__title {
                font-size: 23px;
                font-weight: 900;
                color: #333;
            }

            .card__content {
                font-size: 13px;
                line-height: 18px;
                color: #333;
            }

            .card__form {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .card__form input {
                margin-top: 10px;
                outline: 0;
                background: rgb(255, 255, 255);
                box-shadow: transparent 0px 0px 0px 1px inset;
                padding: 0.6em;
                border-radius: 14px;
                border: 1px solid #333;
                color: black;
            }

            .card__form button {
                border: 0;
                background: #111;
                color: #fff;
                padding: 0.68em;
                border-radius: 14px;
                font-weight: bold;
            }

            .sign-up:hover {
                opacity: 0.8;
            }
            .pay{
                text-transform: uppercase;
                background: #F68B1E;
                border: 1px solid #F68B1E;
                cursor: pointer;
                color: #fff;
                padding: 8px 40px;
                margin-top: 10px;
            }
            .printReceiptButton{

                cursor: pointer;
                background-color: blue;
                color: #fff;
                border-radius: 4px;
                font-weight: 500;
                font-size: 1.2rem;
                font-family: Roboto;
                padding: 14px 0;
                line-height: 22px;
                width: 25%;


            }

        </style>
    </head>
    <body onload="loadPaymentInformation(), oneWay(<?php echo $_SESSION["num"]; ?>)"">

        <!-- top Navigation  -->
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

        <!-- Main content  -->
        <!-- Departure content  -->
        <div class="content">
            <h3></h3>
            <div class="info-container""> 
                <img src="image/paymentSuccessful.PNG" width="500" height="200" alt="successfulPicture" style="display: block; margin-left: auto; margin-right: auto; width: 50%;"/>
            </div>
            <h3>Booking Details</h3>
            <div class="info-container""> 
                <!-- for departure total -->
                <div class="leftDescription">
                    <img class="airplaneIcon" src="image/airplane_icon.avif" alt="alt" width=""/>
                    <p>Depart date </p>
                    <p id="departDate"><b><?php echo $_SESSION["departure_date"] ?></b></p>

                    <p>Depart total </p>
                    <p><b>MYR</b></p>
                    <p id="TotalDepartureAmount"><b></b></p>
                </div>
                <div class="panelHeader">

                    <div class="divBottomDesc">
                        <p><?php echo $_SESSION["from"] . "-" . $_SESSION["to"] ?></p>
                        <p id="planeIdD"><?php echo $_SESSION["departure_flight_name"]; ?></p>
                        <p id="flightTimeD"><?php echo $_SESSION["departure_time"] . '-' . $_SESSION["departure_arrival_time"]; ?></p>
                        <p id="flightdurationD"><?php echo $_SESSION["departure_time_taken_hour"] . 'h' . $_SESSION["departure_time_taken_min"] . 'm'; ?></p>
                        <p style="color:green"><b>Fare and fees</b></p>
                        <table class="ticketDescTotal">
                            <tr>
                                <td class="totalTicketDescription" id="totalDeparturePassenger"></td>

                                <td class="totalTicketPrice" id="totalDepartureTicketPrice"></td>

                            </tr>
                            <tr>
                                <td class="totalTicketDescription" id="departureBaggageDescription"></td>
                                <td class="totalTicketPrice" id="departuretotalBaggageAmount"></td>

                            </tr>
                            <tr>
                                <td class="totalTicketDescription" id="departureSeatDescription"></td>
                                <td class="totalTicketPrice" id="departureTotalSeatAmount"></td>

                            </tr> 
                        </table>
                    </div>
                </div>
            </div>

            <!-- Arrival Content -->
            <div class="info-container" id="dissapear1"> 
                <div class="leftDescription">
                    <img class="airplaneIcon" src="image/airplane_icon.avif" alt="alt" width=""/>
                    <p>Arrival date </p>
                    <p id="departDate"><b><?php echo $_SESSION["return_date"] ?></b></p>

                    <p>Arrival total </p>
                    <p><b>MYR</b></p>
                    <p id="TotalArrivalAmount"><b></b></p>
                </div>
                <div class="panelHeader">

                    <div class="divBottomDesc">
                        <p><?php echo $_SESSION["arrivalOrigin"] . "-" . $_SESSION["departOrigin"] ?></p>
                        <p id="planeIdD"><?php echo $_SESSION["return_departure_flight_name"]; ?></p> 
                        <p id="flightTimeD"><?php echo $_SESSION["return_departure_time"] . '-' . $_SESSION["return_departure_arrival_time"]; ?></p>
                        <p id="flightdurationD"><?php echo $_SESSION["return_departure_time_taken_hour"] . 'h' . $_SESSION["return_departure_time_taken_min"] . 'm'; ?></p>
                        <p style="color:green"><b>Fare and fees</b></p>
                        <table class="ticketDescTotal">
                            <tr>
                                <td class="totalTicketDescription" id="totalArrivalPassenger"></td>

                                <td class="totalTicketPrice" id="totalArrivalTicketPrice"></td>

                            </tr>
                            <tr>
                                <td class="totalTicketDescription" id="ArrivalBaggageDescription"></td>
                                <td class="totalTicketPrice" id="arrivaltotalBaggageAmount"></td>

                            </tr>
                            <tr>
                                <td class="totalTicketDescription" id="arrivalSeatDescription"></td>
                                <td class="totalTicketPrice" id="arrivalTotalSeatAmount"></td>

                            </tr>
                        </table>
                    </div>
                </div> 
            </div>

            <!-- for Payment information -->
            <div class="info-container""> 
                <div class="leftDescription">
                    <img class="airplaneIcon" src="image/airplane_icon.avif" alt="alt" width=""/>


                    <p>Total Payment</p>
                    <p style="display: inline-table;"><b>MYR</b></p>
                    <p id="displayFinalTotalAmount" style="display: inline-table;"><b>100000.10</b></p>
                </div>
                <div class="panelHeader">
                    <button class="printReceiptButton" onclick="window.print()">Print Receipt</button>
                </div>
            </div>

        </div>
        <script>
            function getTotalAmount() {
                x = document.getElementById('displayFinalTotalAmount').textContent;

                return x;
            }
            function loadPaymentInformation() {
                // to set the value for the departure
                document.getElementById("TotalDepartureAmount").innerHTML = localStorage.getItem("finalTotalDepartureAmount");
                document.getElementById("totalDepartureTicketPrice").innerHTML = 'MYR ' + localStorage.getItem("totalDepartureTicketPrice");
                document.getElementById("totalDeparturePassenger").innerHTML = 'Passenger x ' + localStorage.getItem("totalDeparturePassenger");

                document.getElementById("departureBaggageDescription").innerHTML = localStorage.getItem("baggageDepartureDescription");
                document.getElementById("departuretotalBaggageAmount").innerHTML = localStorage.getItem("totalBaggageDeparturePayment");

                document.getElementById("departureSeatDescription").innerHTML = localStorage.getItem("departureSeatDescription");
                document.getElementById("departureTotalSeatAmount").innerHTML = localStorage.getItem("totalSeatDeparturePayment");

                //to set the value for the arrival
                document.getElementById("TotalArrivalAmount").innerHTML = localStorage.getItem("finalTotalArrivalAmount");
                document.getElementById("totalArrivalTicketPrice").innerHTML = localStorage.getItem("totalArrivalTicketPrice");
                document.getElementById("totalArrivalPassenger").innerHTML = localStorage.getItem("totalArrivalPassenger");

                document.getElementById("ArrivalBaggageDescription").innerHTML = localStorage.getItem("baggageArrivalDescription");
                document.getElementById("arrivaltotalBaggageAmount").innerHTML = localStorage.getItem("totalBaggageArrivalPayment");

                document.getElementById("arrivalSeatDescription").innerHTML = localStorage.getItem("arrivalSeatDescription");
                document.getElementById("arrivalTotalSeatAmount").innerHTML = localStorage.getItem("totalSeatArrivalPayment");

                //to display the total amount the customer have to pay
                document.getElementById("displayFinalTotalAmount").innerHTML = localStorage.getItem("finalTotalAmount");
                document.cookie = "js_var_value = " + localStorage.getItem("finalTotalAmount");
            }

            function printRecipt() {

                window.print();
            }
            
            function oneWay(oneWay) {

                if (oneWay === 1) {

                    document.getElementById("dissapear1").style.display = "none";

                }
            }
        </script>
        <?php
        mysqli_close($conn);
        ?>
    </body>
</html>
