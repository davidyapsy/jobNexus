
<html>
    <head >
        <title>Pre-book Bundles And Add-Ons</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <?php
        session_start();
        ?>
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
            .addonIcon{

                width: 120px;
                height: 100%;
                vertical-align: middle;
            }
            .panelHeader{
                display: table-cell;
                padding: 0 0 0 20px;
                font-size: 1.2rem;
                font-weight: 500;
                box-sizing: border-box;

            }

            .bottomNav{
                padding-top: 5px;
                color: #1d1d1d;
                min-height: 78px;
                z-index: 1;
            }
            .totalAmount{

                display: inline-table;
                vertical-align: top;
                align-items: baseline;
                cursor: pointer;
                margin: 0;
                font-size: 1.5rem;
                font-weight: 500;
            }
            .continuePayment{
                cursor: pointer;
                background-color: blue;
                color: #fff;
                border-radius: 4px;
                font-weight: 500;
                font-size: 1.2rem;
                font-family: Roboto;
                padding: 14px 0;
                line-height: 22px;
                box-sizing: border-box;
                border: none;
                width: 25%;
                text-align: center;
                text-decoration: none;
                display:block;

                outline: 0;
            }
            .continuePayment:hover{
                text-decoration: none;
                color: #fff;
            }
            .sidebar {
                height: 100%;
                width: 0;
                position: fixed;
                top: 0;
                right: 0;
                overflow-x: hidden;
                transition: 0.5s;
                background-color: #fff;
                z-index: 1020;
            }
            .topPanelHeader{
                position: relative;
                background-color: #1d1d1d;
                color: #fff;
                overflow-x: auto;

            }
            .tabsContainer{
                display: table-cell;
                margin: 0;
                padding: 0;
                width:400px;
                padding: 20px 15px;
                color: #fff;
                list-style: none;
                text-align: Center;
            }
            .closebtn{
                position: absolute;
                top: 5px;
                right: 5px;
                padding: 0;
                margin: 0;
                border: 0;
                background: 0 0;
                color: #fff;
                cursor: pointer;
            }
            .panelDescription{
                font-size: 0.95rem;
                font-weight: 200;
            }
            .divBottomDesc{
                padding: 16px 32px 16px 16px;
                border-radius: 4px;
                background-color: rgb(248, 248, 248);

            }
            .divBottomArrivalBaggage{
                display: table-cell;
                padding: 0 0 0 20px;
                font-size: 1.2rem;
                font-weight: 500;
                box-sizing: border-box;
                width:234px;
            }
            .bagageOption{
                margin:30px;
                background-color: #fff;
                display: block;
                border: 1px solid #bfc5cf;
                border-radius: 4px;
                height: calc(100% - 215px);
            }
            .BagOptHeader{
                display: inline-block;
                color: #212124;
                margin-left: 8px;
                font-weight: 500;
                font-size: 20px;
                line-height: 24px;
                padding: 16px;
                cursor: pointer;

            }

            .panel-tittle{
                width:100%;
                padding: 0;
                border-style:none;
                background-color: #b1b1b1;
                text-align:left;
            }
            /* delete*/
            .SidebarSidenav {

                width: 18%;
                background-color: #111;
                display: table-cell;

            }

            /* delete*/
            /* Side navigation links */
            .SidebarSidenav a {
                color: white;
                padding: 16px;
                text-decoration: none;
                display: block;
            }

            /* Change color on hover */
            .SidebarSidenav a:hover {
                background-color: #ddd;
                color: black;
            }

            /* delete*/
            .sideNavContent2{
                position:relative;
                display: table;
                height: 785px;
            }
            /* delete*/
            .sideNavContent{
                background-color: #fff;
                display: block;
                height: 785px;
            }

            .baggageSelection{
                background-color: #fff;
                display: block;
                border: 1px solid #bfc5cf;
                border-radius: 4px;
                width: 97%;
                margin-top: 10px;
                margin-left: 10px;
                padding-left: 20px;

            }
            .arrivalbaggageSelection{
                background-color: #fff;
                display: block;
                border: 1px solid #bfc5cf;
                border-radius: 4px;
                width: 97%;
                margin-top: 10px;
                margin-left: 10px;
                padding-left: 20px;
            }

            .panelFooter{
                position: fixed;
                width:800px;
                bottom: 0;
                background-color: #fff;
                color: #1d1d1d;
                border-top: 1px solid #bfc5cf;
                padding: 12px 15px 18px;
                box-sizing: border-box;

            }
            .panelfooterP{
                width: 55%;
                float: left;
                font-size: 1.2rem;
                overflow: hidden;
            }
            .baggageChoice{
                display: table;
                border-collapse: separate;
                border-spacing: 5px;
                width: 100%;

            }
            .package{
                position: relative;
                display: table-cell;
                border: 2px solid #bfc5cf;
                border-radius: 4px;
                cursor: pointer;
                text-align: center;

                padding: 15px 0;
            }

        </style>     
        <script>
            //Java - to open the side navigation when the panel is clicked 
            function openNav() {
                document.getElementById("mySidebar").style.width = "800px";
            }

            function closeNav() {
                document.getElementById("mySidebar").style.width = "0";

            }

            function openBaggagePanel() {
                document.getElementById("baggagePanel").style.display = "block";
                document.getElementById("seatPanel").style.display = "none";
            }

            function openSeatPanel() {
                document.getElementById("seatPanel").style.display = "block";
                document.getElementById("baggagePanel").style.display = "none";
            }

            function departureBaggageSel(numOfPassenger) {

                document.getElementById("departureBaggage").style.display = "block";
                document.getElementById("arrivalBaggage").style.display = "none";

                document.getElementById("a1").style.display = "none";
                document.getElementById("a2").style.display = "none";
                document.getElementById("a3").style.display = "none";
                document.getElementById("a4").style.display = "none";
                document.getElementById("a5").style.display = "none";

                for (var i = 1; i <= numOfPassenger; i++) {
                    document.getElementById("a" + i).style.display = "block";
                }


            }

            function arrivalBaggageSel(numOfPassenger) {
                numOfPassenger = numOfPassenger + 5;
                document.getElementById("arrivalBaggage").style.display = "block";
                document.getElementById("departureBaggage").style.display = "none";

                document.getElementById("a6").style.display = "none";
                document.getElementById("a7").style.display = "none";
                document.getElementById("a8").style.display = "none";
                document.getElementById("a9").style.display = "none";
                document.getElementById("a10").style.display = "none";

                for (var i = 6; i <= numOfPassenger; i++) {
                    document.getElementById("a" + i).style.display = "block";
                }

            }

            function departureSeatPanel() {

                document.getElementById("departureSeat").style.display = "block";
                document.getElementById("arrivalSeat").style.display = "none";


            }

            function arrivalSeatPanel() {
                document.getElementById("arrivalSeat").style.display = "block";
                document.getElementById("departureSeat").style.display = "none";
            }

            function topPanelselection(no) {
                if (no === 1) {
                    document.getElementById("T1").style.backgroundColor = "#bfc5cf";
                    document.getElementById("T1").style.color = "black";
                    document.getElementById("T2").style.backgroundColor = "black";
                    document.getElementById("T2").style.color = "white";


                } else if (no === 2) {
                    document.getElementById("T2").style.backgroundColor = "#bfc5cf";
                    document.getElementById("T2").style.color = "black";
                    document.getElementById("T1").style.backgroundColor = "black";
                    document.getElementById("T1").style.color = "white";
                } else if (no === 3) {
                    document.getElementById("T3").style.backgroundColor = "#bfc5cf";
                    document.getElementById("T3").style.color = "black";
                    document.getElementById("T4").style.backgroundColor = "black";
                    document.getElementById("T4").style.color = "white";


                } else if (no === 4) {
                    document.getElementById("T4").style.backgroundColor = "#bfc5cf";
                    document.getElementById("T4").style.color = "black";
                    document.getElementById("T3").style.backgroundColor = "black";
                    document.getElementById("T3").style.color = "white";
                }
            }

            baggage = [10];
            baggage = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
            dpassenger1 = "";
            dpassenger2 = "";
            dpassenger3 = "";
            dpassenger4 = "";
            dpassenger5 = "";
            apassenger1 = "";
            apassenger2 = "";
            apassenger3 = "";
            apassenger4 = "";
            apassenger5 = "";

            function selectedBaggage(id) {
                if (id >= 1 && id <= 5) {
                    for (i = 1; i < 6; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 1) {
                                baggage[1] = 1;
                                dpassenger1 = "";


                            } else if (i === 2) {
                                baggage[1] = 2;
                                dpassenger1 = "";
                                dpassenger1 = "20";

                            } else if (i === 3) {

                                baggage[1] = 3;
                                dpassenger1 = "";
                                dpassenger1 = "25";

                            } else if (i === 4) {

                                baggage[1] = 4;
                                dpassenger1 = "";
                                dpassenger1 = "30";

                            } else if (i === 5) {
                                baggage[1] = 5;
                                dpassenger1 = "";
                                dpassenger1 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 6 && id <= 10) {
                    for (i = 6; i <= 10; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 6) {
                                baggage[2] = 1;
                                dpassenger2 = "";


                            } else if (i === 7) {
                                baggage[2] = 2;
                                dpassenger2 = "";
                                dpassenger2 = "20";

                            } else if (i === 8) {

                                baggage[2] = 3;
                                dpassenger2 = "";
                                dpassenger2 = "25";

                            } else if (i === 9) {

                                baggage[2] = 4;
                                dpassenger2 = "";
                                dpassenger2 = "30";

                            } else if (i === 10) {
                                baggage[2] = 5;
                                dpassenger2 = "";
                                dpassenger2 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 11 && id <= 15) {
                    for (i = 11; i <= 15; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 11) {
                                baggage[3] = 1;
                                dpassenger3 = "";


                            } else if (i === 12) {
                                baggage[3] = 2;
                                dpassenger3 = "";
                                dpassenger3 = "20";

                            } else if (i === 13) {

                                baggage[3] = 3;
                                dpassenger3 = "";
                                dpassenger3 = "25";

                            } else if (i === 14) {

                                baggage[3] = 4;
                                dpassenger3 = "";
                                dpassenger3 = "30";

                            } else if (i === 15) {
                                baggage[3] = 5;
                                dpassenger3 = "";
                                dpassenger3 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 16 && id <= 20) {
                    for (i = 16; i <= 20; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 16) {
                                baggage[4] = 1;
                                dpassenger4 = "";


                            } else if (i === 17) {
                                baggage[4] = 2;
                                dpassenger4 = "";
                                dpassenger4 = "20";

                            } else if (i === 18) {

                                baggage[4] = 3;
                                dpassenger4 = "";
                                dpassenger4 = "25";

                            } else if (i === 19) {

                                baggage[4] = 4;
                                dpassenger4 = "";
                                dpassenger4 = "30";

                            } else if (i === 20) {
                                baggage[4] = 5;
                                dpassenger4 = "";
                                dpassenger4 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 21 && id <= 25) {
                    for (i = 21; i <= 25; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 21) {
                                baggage[5] = 1;
                                dpassenger5 = "";


                            } else if (i === 22) {
                                baggage[5] = 2;
                                dpassenger5 = "";
                                dpassenger5 = "20";


                            } else if (i === 23) {

                                baggage[5] = 3;
                                dpassenger5 = "";
                                dpassenger5 = "25";

                            } else if (i === 24) {

                                baggage[5] = 4;
                                dpassenger5 = "";
                                dpassenger5 = "30";

                            } else if (i === 25) {
                                baggage[5] = 5;
                                dpassenger5 = "";
                                dpassenger5 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 26 && id <= 30) {
                    for (i = 26; i <= 30; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 26) {
                                baggage[6] = 1;
                                apassenger1 = "";

                            } else if (i === 27) {
                                baggage[6] = 2;
                                apassenger1 = "";
                                apassenger1 = "20";


                            } else if (i === 28) {

                                baggage[6] = 3;
                                apassenger1 = "";
                                apassenger1 = "25";

                            } else if (i === 29) {

                                baggage[6] = 4;
                                apassenger1 = "";
                                apassenger1 = "30";

                            } else if (i === 30) {
                                baggage[6] = 5;
                                apassenger1 = "";
                                apassenger1 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 31 && id <= 35) {
                    for (i = 31; i <= 35; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 31) {
                                baggage[7] = 1;
                                apassenger2 = "";

                            } else if (i === 32) {
                                baggage[7] = 2;
                                apassenger2 = "";
                                apassenger2 = "20";

                            } else if (i === 33) {

                                baggage[7] = 3;
                                apassenger2 = "";
                                apassenger2 = "25";

                            } else if (i === 34) {

                                baggage[7] = 4;
                                apassenger2 = "";
                                apassenger2 = "30";

                            } else if (i === 35) {
                                baggage[7] = 5;
                                apassenger2 = "";
                                apassenger2 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 36 && id <= 40) {
                    for (i = 36; i <= 40; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 36) {
                                baggage[8] = 1;
                                apassenger3 = "";

                            } else if (i === 37) {
                                baggage[8] = 2;
                                apassenger3 = "";
                                apassenger3 = "20";

                            } else if (i === 38) {

                                baggage[8] = 3;
                                apassenger3 = "";
                                apassenger3 = "25";

                            } else if (i === 39) {

                                baggage[8] = 4;
                                apassenger3 = "";
                                apassenger3 = "30";

                            } else if (i === 40) {
                                baggage[8] = 5;
                                apassenger3 = "";
                                apassenger3 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 41 && id <= 45) {
                    for (i = 41; i <= 45; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 41) {
                                baggage[9] = 1;
                                apassenger4 = "";

                            } else if (i === 42) {
                                baggage[9] = 2;
                                apassenger4 = "";
                                apassenger4 = "20";

                            } else if (i === 43) {

                                baggage[9] = 3;
                                apassenger4 = "";
                                apassenger4 = "25";

                            } else if (i === 44) {

                                baggage[9] = 4;
                                apassenger4 = "";
                                apassenger4 = "30";

                            } else if (i === 45) {
                                baggage[9] = 5;
                                apassenger4 = "";
                                apassenger4 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                } else if (id >= 46 && id <= 50) {
                    for (i = 46; i <= 50; i++) {

                        if (i === id) {
                            document.getElementById(i).style.borderColor = "#067e41";
                            if (i === 46) {
                                baggage[10] = 1;
                                apassenger5 = "";

                            } else if (i === 47) {
                                baggage[10] = 2;
                                apassenger5 = "";
                                apassenger5 = "20";


                            } else if (i === 48) {

                                baggage[10] = 3;
                                apassenger5 = "";
                                apassenger5 = "25";

                            } else if (i === 49) {

                                baggage[10] = 4;
                                apassenger5 = "";
                                apassenger5 = "30";

                            } else if (i === 50) {
                                baggage[10] = 5;
                                apassenger5 = "";
                                apassenger5 = "40";
                            }
                        } else {
                            document.getElementById(i).style.borderColor = "#bfc5cf";
                        }
                    }
                }



                document.cookie = "dp1 = " + dpassenger1;
                document.cookie = "dp2 = " + dpassenger2;
                document.cookie = "dp3 = " + dpassenger3;
                document.cookie = "dp4 = " + dpassenger4;
                document.cookie = "dp5 = " + dpassenger5;
                document.cookie = "ap1 = " + apassenger1;
                document.cookie = "ap2 = " + apassenger2;
                document.cookie = "ap3 = " + apassenger3;
                document.cookie = "ap4 = " + apassenger4;
                document.cookie = "ap5 = " + apassenger5;



                total20kgDepart = 0;
                total25kgDepart = 0;
                total30kgDepart = 0;
                total40kgDepart = 0;

                //to set the display for the departure baggage
                for (i = 1; i <= 5; i++) {
                    if (baggage[i] === 2) {
                        total20kgDepart = total20kgDepart + 1;
                    } else if (baggage[i] === 3) {
                        total25kgDepart = total25kgDepart + 1;
                    } else if (baggage[i] === 4) {
                        total30kgDepart = total30kgDepart + 1;
                    } else if (baggage[i] === 5) {
                        total40kgDepart = total40kgDepart + 1;
                    }
                }
                sentence = "Extra Baggage [";
                document.getElementById("ExtraBaggageDepartureNone").style.display = "None";
                if (total20kgDepart >= 1) {
                    document.getElementById("ExtraBaggageDeparture20").style.display = "block";
                    document.getElementById("ExtraBaggageDeparture20").innerHTML = '20kg Baggage x ' + total20kgDepart;

                    sentence += "20kg,";
                } else {
                    document.getElementById("ExtraBaggageDeparture20").style.display = "None";
                }
                if (total25kgDepart >= 1) {
                    document.getElementById("ExtraBaggageDeparture25").style.display = "block";
                    document.getElementById("ExtraBaggageDeparture25").innerHTML = '25kg Baggage x ' + total25kgDepart;
                    sentence += "25kg,";
                } else {
                    document.getElementById("ExtraBaggageDeparture25").style.display = "None";
                }

                if (total30kgDepart >= 1) {
                    document.getElementById("ExtraBaggageDeparture30").style.display = "block";
                    document.getElementById("ExtraBaggageDeparture30").innerHTML = '30kg Baggage x ' + total30kgDepart;
                    sentence += "30kg,";
                } else {
                    document.getElementById("ExtraBaggageDeparture30").style.display = "None";
                }
                if (total40kgDepart >= 1) {
                    document.getElementById("ExtraBaggageDeparture40").style.display = "block";
                    document.getElementById("ExtraBaggageDeparture40").innerHTML = '40kg Baggage x ' + total40kgDepart;
                    sentence += "40kg,";
                } else {
                    document.getElementById("ExtraBaggageDeparture40").style.display = "None";
                }
                sentence += "]";
                if (total20kgDepart === 0 && total25kgDepart === 0 && total30kgDepart === 0 && total40kgDepart === 0) {
                    document.getElementById("ExtraBaggageDepartureNone").style.display = "block";
                    document.getElementById("ExtraBaggageDepartureNone").innerHTML = 'None';
                    sentence = "";
                }
                localStorage.setItem("baggageDepartureDescription", sentence);
                //to set the display for the arrival baggage

                total20kgArrival = 0;
                total25kgArrival = 0;
                total30kgArrival = 0;
                total40kgArrival = 0;
                for (i = 6; i <= 10; i++) {
                    if (baggage[i] === 2) {
                        total20kgArrival = total20kgArrival + 1;
                    } else if (baggage[i] === 3) {
                        total25kgArrival = total25kgArrival + 1;
                    } else if (baggage[i] === 4) {
                        total30kgArrival = total30kgArrival + 1;
                    } else if (baggage[i] === 5) {
                        total40kgArrival = total40kgArrival + 1;
                    }
                }

                sentence2 = "Extra Baggage [";
                document.getElementById("ExtraBaggageArrivalNone").style.display = "None";
                if (total20kgArrival >= 1) {
                    document.getElementById("ExtraBaggageArrival20").style.display = "block";
                    document.getElementById("ExtraBaggageArrival20").innerHTML = '20kg Baggage x ' + total20kgArrival;
                    sentence2 += "20kg,";
                } else {
                    document.getElementById("ExtraBaggageArrival20").style.display = "None";
                }
                if (total25kgArrival >= 1) {
                    document.getElementById("ExtraBaggageArrival25").style.display = "block";
                    document.getElementById("ExtraBaggageArrival25").innerHTML = '25kg Baggage x ' + total25kgArrival;
                    sentence2 += "25kg,";
                } else {
                    document.getElementById("ExtraBaggageArrival25").style.display = "None";
                }

                if (total30kgArrival >= 1) {
                    document.getElementById("ExtraBaggageArrival30").style.display = "block";
                    document.getElementById("ExtraBaggageArrival30").innerHTML = '30kg Baggage x ' + total30kgArrival;
                    sentence2 += "30kg,";
                } else {
                    document.getElementById("ExtraBaggageArrival30").style.display = "None";
                }
                if (total40kgArrival >= 1) {
                    document.getElementById("ExtraBaggageArrival40").style.display = "block";
                    document.getElementById("ExtraBaggageArrival40").innerHTML = '40kg Baggage x ' + total40kgArrival;
                    sentence2 += "40kg,";
                } else {
                    document.getElementById("ExtraBaggageArrival40").style.display = "None";
                }
                sentence2 += "]";
                if (total20kgArrival === 0 && total25kgArrival === 0 && total30kgArrival === 0 && total40kgArrival === 0) {
                    document.getElementById("ExtraBaggageArrivalNone").style.display = "block";
                    document.getElementById("ExtraBaggageArrivalNone").innerHTML = 'None';
                    sentence2 = "";
                }
                localStorage.setItem("baggageArrivalDescription", sentence2);


            }
            //to calculate the total payment for the selected seat
            totalPassenger = 1;
            PREMIUMSEAT = 35.9;
            NORMALSEAT = 15.0;
            totalSeatPayment = 0;
            function setTotalPassenger(totalAmountPassenger) {
                totalPassenger = totalAmountPassenger;

            }

            //for validation to ensure that the customer don't choose more seat than they are supposed to 
            selectedSeatForDeparture = 0;
            selectedSeatForArrival = 0;

            // to store the customer choosen seat 
            choosenDepartureSeat = [];
            choosenArrivalSeat = [];


            departureSeat = [6];
            d = 0;
            function departSelectSeat(id, seatType) {

                seat = document.getElementById(id).src;

                if (selectedSeatForDeparture !== totalPassenger) {
                    if (seat === "http://localhost/flight_ticketing_system/image/businessSeat.png") {
                        document.getElementById(id).src = "image/userSeat.PNG";
                        selectedSeatForDeparture = selectedSeatForDeparture + 1;
                        totalSeatPayment += PREMIUMSEAT;
                        totalDepartureSeatPrice += PREMIUMSEAT;
                        departureSeat[d] = id;
                        d++;
                    } else if (seat === "http://localhost/flight_ticketing_system/image/Seat.png") {
                        document.getElementById(id).src = "image/userSeat.PNG";
                        selectedSeatForDeparture = selectedSeatForDeparture + 1;
                        totalSeatPayment += NORMALSEAT;
                        totalDepartureSeatPrice += NORMALSEAT;
                        departureSeat[d] = id;
                        d++;
                    } else if (seatType === 'P' && seat !== "http://localhost/flight_ticketing_system/image/SeatTaken.PNG") {

                        document.getElementById(id).src = "image/businessSeat.png";
                        selectedSeatForDeparture = selectedSeatForDeparture - 1;
                        totalSeatPayment -= PREMIUMSEAT;
                        totalDepartureSeatPrice -= PREMIUMSEAT;
                        for (k = 0; k <= 5; k++) {
                            if (departureSeat[k] === id) {
                                for (k; k <= 5; k++) {
                                    departureSeat[k] = departureSeat[k + 1];
                                }

                            }
                        }
                        d--;
                    } else if (seatType === 'N' && seat !== "http://localhost/flight_ticketing_system/image/SeatTaken.PNG") {

                        document.getElementById(id).src = "image/Seat.png";
                        selectedSeatForDeparture = selectedSeatForDeparture - 1;
                        totalSeatPayment -= NORMALSEAT;
                        totalDepartureSeatPrice -= NORMALSEAT;
                        for (k = 0; k <= 5; k++) {
                            if (departureSeat[k] === id) {
                                for (k; k <= 5; k++) {
                                    departureSeat[k] = departureSeat[k + 1];
                                }
                            }
                        }
                        d--;
                    }
                } else if (seat !== "http://localhost/flight_ticketing_system/image/businessSeat.png" && seat !== "http://localhost/flight_ticketing_system/image/Seat.png") {
                    if (seatType === 'P' && seat !== "http://localhost/flight_ticketing_system/image/SeatTaken.PNG") {

                        document.getElementById(id).src = "image/businessSeat.png";
                        selectedSeatForDeparture = selectedSeatForDeparture - 1;
                        totalSeatPayment -= PREMIUMSEAT;
                        totalDepartureSeatPrice -= PREMIUMSEAT;
                        for (k = 0; k <= 5; k++) {
                            if (departureSeat[k] === id) {
                                for (k; k <= 5; k++) {
                                    departureSeat[k] = departureSeat[k + 1];
                                }
                            }
                        }
                        d--;
                    } else if (seatType === 'N' && seat !== "http://localhost/flight_ticketing_system/image/SeatTaken.PNG") {

                        document.getElementById(id).src = "image/Seat.png";
                        selectedSeatForDeparture = selectedSeatForDeparture - 1;
                        totalSeatPayment -= NORMALSEAT;
                        totalDepartureSeatPrice -= NORMALSEAT;
                        for (k = 0; k <= 5; k++) {
                            if (departureSeat[k] === id) {
                                for (k; k <= 5; k++) {
                                    departureSeat[k] = departureSeat[k + 1];
                                }
                            }
                        }
                        d--;
                    }
                } else {
                    alert("Error. You have reached the maximum amount of seat already. If you would like to change your seat position. Please deselect on of the seat and re-click again on the desired seat placement");
                }
                document.getElementById("ExtraSeatDeparture").innerHTML = "";
                departureSeatDescription = "Seat [";

                for (k = 0; k < 5; k++) {
                    if (departureSeat[k] !== undefined) {
                        document.getElementById("ExtraSeatDeparture").innerHTML += departureSeat[k] + "<br>";
                        departureSeatDescription += departureSeat[k] + ",";
                    }
                }

                departureSeatDescription += "]";

                if (d === 0) {
                    document.getElementById("ExtraSeatDeparture").innerHTML = "None";
                    departureSeatDescription = "";
                }
                document.getElementById("seatTotal").innerHTML = 'RM' + Math.round(totalSeatPayment.valueOf() * 100) / 100;
                document.getElementById("displayTotalPaymentSeat").innerHTML = 'Total: MYR ' + Math.round(totalSeatPayment.valueOf() * 100) / 100;
                document.getElementById("displayTotalPaymentDepartureSeat").innerHTML = 'Total: MYR ' + Math.round(totalDepartureSeatPrice.valueOf() * 100) / 100;
                localStorage.setItem("departureSeatDescription", departureSeatDescription);
                calculateTotalDepartureArrivalPayment();
                
                getSeatRowAndColumnDepart();
            }


            // arrival seat
            arrivalSeat = [6];
            a = 0;
            function arrivalSelectSeat(id, seatType) {

                seat = document.getElementById(id).src;
                
                if (selectedSeatForArrival !== totalPassenger) {
                    if (seat === "http://localhost/flight_ticketing_system/image/businessSeat.png") {
                        document.getElementById(id).src = "image/userSeat.PNG";
                        selectedSeatForArrival = selectedSeatForArrival + 1;
                        totalSeatPayment += PREMIUMSEAT;
                        totalArrivalSeatPrice = totalArrivalSeatPrice + PREMIUMSEAT;
                        arrivalSeat[a] = id;
                        a++;
                    } else if (seat === "http://localhost/flight_ticketing_system/image/Seat.png") {
                        document.getElementById(id).src = "image/userSeat.PNG";
                        selectedSeatForArrival = selectedSeatForArrival + 1;
                        totalSeatPayment += NORMALSEAT;
                        totalArrivalSeatPrice = totalArrivalSeatPrice + NORMALSEAT;
                        arrivalSeat[a] = id;
                        a++;
                    } else if (seatType === 'P' && seat !== "http://localhost/flight_ticketing_system/image/SeatTaken.PNG") {

                        document.getElementById(id).src = "image/businessSeat.png";
                        selectedSeatForArrival = selectedSeatForArrival - 1;
                        totalSeatPayment -= PREMIUMSEAT;
                        totalArrivalSeatPrice -= PREMIUMSEAT;
                        for (k = 0; k < 5; k++) {
                            if (arrivalSeat[k] >= id) {
                                for (k; k <= 5; k++) {
                                    arrivalSeat[k] = arrivalSeat[k + 1];
                                }

                            }
                        }
                        a--;
                    } else if (seatType === 'N' && seat !== "http://localhost/flight_ticketing_system/image/SeatTaken.PNG") {

                        document.getElementById(id).src = "image/Seat.png";
                        selectedSeatForArrival = selectedSeatForArrival - 1;
                        totalSeatPayment -= NORMALSEAT;
                        totalArrivalSeatPrice -= NORMALSEAT;
                        for (k = 0; k < 5; k++) {
                            if (arrivalSeat[k] >= id) {
                                for (k; k <= 5; k++) {
                                    arrivalSeat[k] = arrivalSeat[k + 1];
                                }
                            }
                        }
                        a--;
                    }
                } else if (seat !== "http://localhost/flight_ticketing_system/image/businessSeat.png" && seat !== "http://localhost/flight_ticketing_system/image/Seat.png") {
                    if (seatType === 'P' && seat !== "http://localhost/flight_ticketing_system/image/SeatTaken.PNG") {

                        document.getElementById(id).src = "image/businessSeat.png";
                        selectedSeatForArrival = selectedSeatForArrival - 1;
                        totalSeatPayment -= PREMIUMSEAT;
                        totalArrivalSeatPrice -= PREMIUMSEAT;
                        for (k = 0; k < 5; k++) {
                            if (arrivalSeat[k] >= id) {
                                for (k; k <= 5; k++) {
                                    arrivalSeat[k] = arrivalSeat[k + 1];
                                }
                            }
                        }
                        a--;
                    } else if (seatType === 'N' && seat !== "http://localhost/flight_ticketing_system/image/SeatTaken.PNG") {

                        document.getElementById(id).src = "image/Seat.png";
                        selectedSeatForArrival = selectedSeatForArrival - 1;
                        totalSeatPayment -= NORMALSEAT;
                        totalArrivalSeatPrice -= NORMALSEAT;
                        for (k = 0; k < 5; k++) {
                            if (arrivalSeat[k] >= id) {
                                for (k; k <= 5; k++) {
                                    arrivalSeat[k] = arrivalSeat[k + 1];
                                }
                            }
                        }
                        a--;
                    }
                } else {
                    alert("Error. You have reached the maximum amount of seat already. If you would like to change your seat position. Please deselect on of the seat and re-click again on the desired seat placement");
                }
                document.getElementById("ExtraSeatArrival").innerHTML = "";
                arrivalSeatDescription = "Seat [";
                for (k = 0; k < 5; k++) {
                    if (arrivalSeat[k] !== undefined) {
                        document.getElementById("ExtraSeatArrival").innerHTML += arrivalSeat[k] + "<br>";
                        arrivalSeatDescription += arrivalSeat[k] + ",";
                    }
                }
                arrivalSeatDescription += "]";
                if (a === 0) {
                    document.getElementById("ExtraSeatArrival").innerHTML = "None";
                    arrivalSeatDescription = "";
                }
                document.getElementById("seatTotal").innerHTML = 'RM' + Math.round(totalSeatPayment.valueOf() * 100) / 100;
                document.getElementById("displayTotalPaymentSeat").innerHTML = 'Total: MYR ' + Math.round(totalSeatPayment.valueOf() * 100) / 100;
                document.getElementById("displayTotalPaymentReturningSeat").innerHTML = 'Total: MYR ' + Math.round(totalArrivalSeatPrice.valueOf() * 100) / 100;
                localStorage.setItem("arrivalSeatDescription", arrivalSeatDescription);

                calculateTotalDepartureArrivalPayment();
                getSeatRowAndColumnReturning();
            }
            
            
            function getSeatRowAndColumnDepart() {
                seat_column = 0;
                seat_row = 0;
                document.cookie = "pasdc1 = ";
                document.cookie = "pasdr1 = ";
                document.cookie = "pasdc2 = ";
                document.cookie = "pasdr2 = ";
                document.cookie = "pasdc3 = ";
                document.cookie = "pasdr3 = ";
                document.cookie = "pasdc4 = ";
                document.cookie = "pasdr4 = ";
                document.cookie = "pasdc5 = ";
                document.cookie = "pasdr5 = ";

                for (k = 0; k < totalPassenger; k++) {
                    
                    if (departureSeat[k].substr(1, 1) === "A") {
                        seat_column = 1;
                    } else if (departureSeat[k].substr(1, 1) === "B") {
                        seat_column = 2;
                    } else if (departureSeat[k].substr(1, 1) === "C") {
                        seat_column = 3;
                    } else if (departureSeat[k].substr(1, 1) === "D") {
                        seat_column = 4;
                    } else if (departureSeat[k].substr(1, 1) === "E") {
                        seat_column = 5;
                    } else if (departureSeat[k].substr(1, 1) === "F") {
                        seat_column = 6;
                    }

                    seat_row = departureSeat[k].substr(2, 3);
                    if (k === 0) {
                        document.cookie = "pasdc1 = " + seat_column;
                        document.cookie = "pasdr1 = " + seat_row;
                    } else if (k === 1) {
                        document.cookie = "pasdc2 = " + seat_column;
                        document.cookie = "pasdr2 = " + seat_row;
                    } else if (k === 2) {
                        document.cookie = "pasdc3 = " + seat_column;
                        document.cookie = "pasdr3 = " + seat_row;
                    } else if (k === 3) {
                        document.cookie = "pasdc4 = " + seat_column;
                        document.cookie = "pasdr4 = " + seat_row;
                    } else if (k === 4) {
                        document.cookie = "pasdc5 = " + seat_column;
                        document.cookie = "pasdr5 = " + seat_row;
                    }
                }


            }
            
            function getSeatRowAndColumnReturning() {
                seat_column2 = 0;
                seat_row2 = 0;
                document.cookie = "pasac1 = ";
                document.cookie = "pasar1 = ";
                document.cookie = "pasac2 = ";
                document.cookie = "pasar2 = ";
                document.cookie = "pasac3 = ";
                document.cookie = "pasar3 = ";
                document.cookie = "pasac4 = ";
                document.cookie = "pasar4 = ";
                document.cookie = "pasac5 = ";
                document.cookie = "pasar5 = ";
                
                for (k = 0; k < totalPassenger; k++) {
 
                    if (arrivalSeat[k].substring(2, 3) === "A") {
                        seat_column2 = 1;
                    } else if (arrivalSeat[k].substring(2, 3) === "B") {
                        seat_column2 = 2;
                    } else if (arrivalSeat[k].substring(2, 3) === "C") {
                        seat_column2 = 3;
                    } else if (arrivalSeat[k].substring(2, 3) === "D") {
                        seat_column2 = 4;
                    } else if (arrivalSeat[k].substring(2, 3) === "E") {
                        seat_column2 = 5;
                    } else if (arrivalSeat[k].substring(2, 3) === "F") {
                        seat_column2 = 6;
                    }
                    
                    seat_row2 = arrivalSeat[k].substr(3, 4);
                    
                    if (k === 0) {
                        document.cookie = "pasac1 = " + seat_column2;
                        document.cookie = "pasar1 = " + seat_row2;
                    } else if (k === 1) {
                        document.cookie = "pasac2 = " + seat_column2;
                        document.cookie = "pasar2 = " + seat_row2;
                    } else if (k === 2) {
                        document.cookie = "pasac3 = " + seat_column2;
                        document.cookie = "pasar3 = " + seat_row2;
                    } else if (k === 3) {
                        document.cookie = "pasac4 = " + seat_column2;
                        document.cookie = "pasar4 = " + seat_row2;
                    } else if (k === 4) {
                        document.cookie = "pasac5 = " + seat_column2;
                        document.cookie = "pasar5 = " + seat_row2;
                    }

                }
                
                
            }

            totalBaggagePayment = [10];
            totalBaggagePayment = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            function totalBaggage(arrayNo, price) {

                total = 0.00;
                totalBaggagePayment[arrayNo] = price;
                totalDepartureBaggagePrice = 0.0;
                totalArrivalBaggagePrice = 0.0;
                for (var i = 0; i < 5; i++) {
                    totalDepartureBaggagePrice = totalDepartureBaggagePrice + totalBaggagePayment[i];
                }
                for (var i = 5; i < 10; i++) {
                    totalArrivalBaggagePrice = totalArrivalBaggagePrice + totalBaggagePayment[i];
                }
                for (var i = 0; i < 10; i++) {
                    total = total + totalBaggagePayment[i];
                }
                document.getElementById("totalbaggagePayment").innerHTML = 'MYR' + Math.round(total.valueOf() * 100) / 100;
                document.getElementById("displayTotalPaymentBaggage").innerHTML = 'Total: MYR ' + Math.round(total.valueOf() * 100) / 100;
                document.getElementById("displayTotalPaymentDepartureBaggage").innerHTML = 'Total: MYR ' + Math.round(totalDepartureBaggagePrice.valueOf() * 100) / 100;
                document.getElementById("displayTotalPaymentReturningBaggage").innerHTML = 'Total: MYR ' + Math.round(totalArrivalBaggagePrice.valueOf() * 100) / 100;
                calculateTotalDepartureArrivalPayment();
            }

            totalDepartureTicketPrice = 0.0;
            totalArrivalTicketPrice = 0.0;
            totalDepartureBaggagePrice = 0.0;
            totalArrivalBaggagePrice = 0.0;
            totalDepartureSeatPrice = 0.0;
            totalArrivalSeatPrice = 0.0;

            function setTotalTicketPrice(departureTicket, departurePassenger, ArrivalTicket, ArrivalPassenger) {
                totalDepartureTicketPrice = departureTicket * departurePassenger;
                totalArrivalTicketPrice = ArrivalTicket * ArrivalPassenger;
                localStorage.setItem("totalDepartureTicketPrice", totalDepartureTicketPrice);
                localStorage.setItem("totalDeparturePassenger", departurePassenger);
                localStorage.setItem("totalArrivalTicketPrice", totalArrivalTicketPrice);
                localStorage.setItem("totalArrivalPassenger", ArrivalPassenger);
            }

            function calculateDepartureTotalPayment() {
                totalDeparturePayment = totalDepartureTicketPrice + totalDepartureBaggagePrice + totalDepartureSeatPrice;
                localStorage.setItem("finalTotalDepartureAmount", totalDeparturePayment);
                return totalDeparturePayment;
            }

            function calculateArrivalTotalPayment() {
                totalArrivalPayment = totalArrivalTicketPrice + totalArrivalBaggagePrice + totalArrivalSeatPrice;
                localStorage.setItem("finalTotalArrivalAmount", totalArrivalPayment);
                return totalArrivalPayment;
            }

            function calculateTotalDepartureArrivalPayment() {
                totalDepartureArrivalPayment = 0.0;
                totalDepartureArrivalPayment = calculateDepartureTotalPayment() + calculateArrivalTotalPayment();
                document.getElementById("FinalTotalAmount").innerHTML = Math.round(totalDepartureArrivalPayment.valueOf() * 100) / 100;

                if (totalDepartureBaggagePrice !== 0) {
                    localStorage.setItem("totalBaggageDeparturePayment", 'MYR ' + totalDepartureBaggagePrice);
                } else {
                    localStorage.setItem("totalBaggageDeparturePayment", '');
                }
                if (totalArrivalBaggagePrice !== 0) {
                    localStorage.setItem("totalBaggageArrivalPayment", 'MYR ' + totalArrivalBaggagePrice);
                } else {
                    localStorage.setItem("totalBaggageArrivalPayment", '');
                }
                if (totalDepartureSeatPrice !== 0) {
                    localStorage.setItem("totalSeatDeparturePayment", 'MYR ' + totalDepartureSeatPrice);
                } else {
                    localStorage.setItem("totalSeatDeparturePayment", '');
                }
                if (totalArrivalSeatPrice !== 0) {
                    localStorage.setItem("totalSeatArrivalPayment", 'MYR ' + totalArrivalSeatPrice);
                } else {
                    localStorage.setItem("totalSeatArrivalPayment", '');
                }

                localStorage.setItem("finalTotalAmount", totalDepartureArrivalPayment);
                //return totalDepartureArrivalPayment;

            }

            function resetLocalStorageData() {
                localStorage.setItem("baggageDepartureDescription", '');
                localStorage.setItem("baggageArrivalDescription", '');
                localStorage.setItem("departureSeatDescription", '');
                localStorage.setItem("arrivalSeatDescription", '');
                localStorage.setItem("totalDepartureTicketPrice", '');
                localStorage.setItem("totalDeparturePassenger", '');
                localStorage.setItem("totalArrivalTicketPrice", '');
                localStorage.setItem("totalArrivalPassenger", '');
                localStorage.setItem("finalTotalDepartureAmount", '');
                localStorage.setItem("finalTotalArrivalAmount", '');
                localStorage.setItem("totalBaggageDeparturePayment", '');
                localStorage.setItem("totalBaggageArrivalPayment", '');
                localStorage.setItem("totalSeatDeparturePayment", '');
                localStorage.setItem("totalSeatArrivalPayment", '');
                localStorage.setItem("finalTotalAmount", '');

                for (var i = 1; i < localStorage.getItem("totalseatDepartureTaken"); i++) {
                    localStorage.setItem(i, "");
                }
                localStorage.setItem('totalseatDepartureTaken', "");

                for (var k = 101; k < localStorage.getItem("totalseatArrivalTaken"); k++) {
                    localStorage.setItem(k, "");
                }
                localStorage.setItem('totalseatArrivalTaken', "");
            }

            function setSeatAvailability() {


                for (var i = 1; i < localStorage.getItem("totalseatDepartureTaken"); i++) {
                    //if the local storage itm is more than 1

                    var x = localStorage.getItem(i);

                    if (x === "1") {
                        document.getElementById("PA1").src = "image/SeatTaken.PNG";
                    } else if (x === "2") {
                        document.getElementById("PB1").src = "image/SeatTaken.PNG";
                    } else if (x === "3") {
                        document.getElementById("PC1").src = "image/SeatTaken.PNG";
                    } else if (x === "4") {
                        document.getElementById("PD1").src = "image/SeatTaken.PNG";
                    } else if (x === "5") {
                        document.getElementById("PE1").src = "image/SeatTaken.PNG";
                    } else if (x === "6") {
                        document.getElementById("PF1").src = "image/SeatTaken.PNG";
                    } else if (x === "7") {
                        document.getElementById("PA2").src = "image/SeatTaken.PNG";
                    } else if (x === "8") {
                        document.getElementById("PB2").src = "image/SeatTaken.PNG";
                    } else if (x === "9") {
                        document.getElementById("PC2").src = "image/SeatTaken.PNG";
                    } else if (x === "10") {
                        document.getElementById("PD2").src = "image/SeatTaken.PNG";
                    } else if (x === "11") {
                        document.getElementById("PE2").src = "image/SeatTaken.PNG";
                    } else if (x === "12") {
                        document.getElementById("PF2").src = "image/SeatTaken.PNG";
                    } else if (x === "13") {
                        document.getElementById("PA3").src = "image/SeatTaken.PNG";
                    } else if (x === "14") {
                        document.getElementById("PB3").src = "image/SeatTaken.PNG";
                    } else if (x === "15") {
                        document.getElementById("PC3").src = "image/SeatTaken.PNG";
                    } else if (x === "16") {
                        document.getElementById("PD3").src = "image/SeatTaken.PNG";
                    } else if (x === "17") {
                        document.getElementById("PE3").src = "image/SeatTaken.PNG";
                    } else if (x === "18") {
                        document.getElementById("PF3").src = "image/SeatTaken.PNG";
                    } else if (x === "19") {
                        document.getElementById("PA4").src = "image/SeatTaken.PNG";
                    } else if (x === "20") {
                        document.getElementById("PB4").src = "image/SeatTaken.PNG";
                    } else if (x === "21") {
                        document.getElementById("PC4").src = "image/SeatTaken.PNG";
                    } else if (x === "22") {
                        document.getElementById("PD4").src = "image/SeatTaken.PNG";
                    } else if (x === "23") {
                        document.getElementById("PE4").src = "image/SeatTaken.PNG";
                    } else if (x === "24") {
                        document.getElementById("PF4").src = "image/SeatTaken.PNG";
                    } else if (x === "25") {
                        document.getElementById("PA5").src = "image/SeatTaken.PNG";
                    } else if (x === "26") {
                        document.getElementById("PB5").src = "image/SeatTaken.PNG";
                    } else if (x === "27") {
                        document.getElementById("PC5").src = "image/SeatTaken.PNG";
                    } else if (x === "28") {
                        document.getElementById("PD5").src = "image/SeatTaken.PNG";
                    } else if (x === "29") {
                        document.getElementById("PE5").src = "image/SeatTaken.PNG";
                    } else if (x === "30") {
                        document.getElementById("PF5").src = "image/SeatTaken.PNG";
                    } else if (x === "31") {
                        document.getElementById("PA6").src = "image/SeatTaken.PNG";
                    } else if (x === "32") {
                        document.getElementById("PB6").src = "image/SeatTaken.PNG";
                    } else if (x === "33") {
                        document.getElementById("PC6").src = "image/SeatTaken.PNG";
                    } else if (x === "34") {
                        document.getElementById("PD6").src = "image/SeatTaken.PNG";
                    } else if (x === "35") {
                        document.getElementById("PE6").src = "image/SeatTaken.PNG";
                    } else if (x === "36") {
                        document.getElementById("PF6").src = "image/SeatTaken.PNG";
                    } else if (x === "37") {
                        document.getElementById("PA7").src = "image/SeatTaken.PNG";
                    } else if (x === "38") {
                        document.getElementById("PB7").src = "image/SeatTaken.PNG";
                    } else if (x === "39") {
                        document.getElementById("PC7").src = "image/SeatTaken.PNG";
                    } else if (x === "40") {
                        document.getElementById("PD7").src = "image/SeatTaken.PNG";
                    } else if (x === "41") {
                        document.getElementById("PE7").src = "image/SeatTaken.PNG";
                    } else if (x === "42") {
                        document.getElementById("PF7").src = "image/SeatTaken.PNG";
                    } else if (x === "43") {
                        document.getElementById("PA8").src = "image/SeatTaken.PNG";
                    } else if (x === "44") {
                        document.getElementById("PB8").src = "image/SeatTaken.PNG";
                    } else if (x === "45") {
                        document.getElementById("PC8").src = "image/SeatTaken.PNG";
                    } else if (x === "46") {
                        document.getElementById("PD8").src = "image/SeatTaken.PNG";
                    } else if (x === "47") {
                        document.getElementById("PE8").src = "image/SeatTaken.PNG";
                    } else if (x === "48") {
                        document.getElementById("PF8").src = "image/SeatTaken.PNG";
                    } else if (x === "49") {
                        document.getElementById("PA9").src = "image/SeatTaken.PNG";
                    } else if (x === "50") {
                        document.getElementById("PB9").src = "image/SeatTaken.PNG";
                    } else if (x === "51") {
                        document.getElementById("PC9").src = "image/SeatTaken.PNG";
                    } else if (x === "52") {
                        document.getElementById("PD9").src = "image/SeatTaken.PNG";
                    } else if (x === "53") {
                        document.getElementById("PE9").src = "image/SeatTaken.PNG";
                    } else if (x === "54") {
                        document.getElementById("PF9").src = "image/SeatTaken.PNG";
                    } else if (x === "55") {
                        document.getElementById("PA10").src = "image/SeatTaken.PNG";
                    } else if (x === "56") {
                        document.getElementById("PB10").src = "image/SeatTaken.PNG";
                    } else if (x === "57") {
                        document.getElementById("PC10").src = "image/SeatTaken.PNG";
                    } else if (x === "58") {
                        document.getElementById("PD10").src = "image/SeatTaken.PNG";
                    } else if (x === "59") {
                        document.getElementById("PE10").src = "image/SeatTaken.PNG";
                    } else if (x === "60") {
                        document.getElementById("PF10").src = "image/SeatTaken.PNG";
                    } else if (x === "61") {
                        document.getElementById("PA11").src = "image/SeatTaken.PNG";
                    } else if (x === "62") {
                        document.getElementById("PB11").src = "image/SeatTaken.PNG";
                    } else if (x === "63") {
                        document.getElementById("PC11").src = "image/SeatTaken.PNG";
                    } else if (x === "64") {
                        document.getElementById("PD11").src = "image/SeatTaken.PNG";
                    } else if (x === "65") {
                        document.getElementById("PE11").src = "image/SeatTaken.PNG";
                    } else if (x === "66") {
                        document.getElementById("PF11").src = "image/SeatTaken.PNG";
                    } else if (x === "67") {
                        document.getElementById("PA12").src = "image/SeatTaken.PNG";
                    } else if (x === "68") {
                        document.getElementById("PB12").src = "image/SeatTaken.PNG";
                    } else if (x === "69") {
                        document.getElementById("PC12").src = "image/SeatTaken.PNG";
                    } else if (x === "70") {
                        document.getElementById("PD12").src = "image/SeatTaken.PNG";
                    } else if (x === "71") {
                        document.getElementById("PE12").src = "image/SeatTaken.PNG";
                    } else if (x === "72") {
                        document.getElementById("PF12").src = "image/SeatTaken.PNG";
                    } else if (x === "73") {
                        document.getElementById("PA13").src = "image/SeatTaken.PNG";
                    } else if (x === "74") {
                        document.getElementById("PB13").src = "image/SeatTaken.PNG";
                    } else if (x === "75") {
                        document.getElementById("PC13").src = "image/SeatTaken.PNG";
                    } else if (x === "76") {
                        document.getElementById("PD13").src = "image/SeatTaken.PNG";
                    } else if (x === "77") {
                        document.getElementById("PE13").src = "image/SeatTaken.PNG";
                    } else if (x === "78") {
                        document.getElementById("PF13").src = "image/SeatTaken.PNG";
                    } else if (x === "79") {
                        document.getElementById("PA14").src = "image/SeatTaken.PNG";
                    } else if (x === "80") {
                        document.getElementById("PB14").src = "image/SeatTaken.PNG";
                    } else if (x === "81") {
                        document.getElementById("PC14").src = "image/SeatTaken.PNG";
                    } else if (x === "82") {
                        document.getElementById("PD14").src = "image/SeatTaken.PNG";
                    } else if (x === "83") {
                        document.getElementById("PE14").src = "image/SeatTaken.PNG";
                    } else if (x === "84") {
                        document.getElementById("PF14").src = "image/SeatTaken.PNG";
                    } else if (x === "85") {
                        document.getElementById("PA15").src = "image/SeatTaken.PNG";
                    } else if (x === "86") {
                        document.getElementById("PB15").src = "image/SeatTaken.PNG";
                    } else if (x === "87") {
                        document.getElementById("PC15").src = "image/SeatTaken.PNG";
                    } else if (x === "88") {
                        document.getElementById("PD15").src = "image/SeatTaken.PNG";
                    } else if (x === "89") {
                        document.getElementById("PE15").src = "image/SeatTaken.PNG";
                    } else if (x === "90") {
                        document.getElementById("PF15").src = "image/SeatTaken.PNG";
                    }


                }

                for (var i = 101; i < localStorage.getItem("totalseatArrivalTaken"); i++) {
                    //if the local storage itm is more than 1

                    var y = localStorage.getItem(i);

                    if (y === "1") {
                        document.getElementById("PA1").src = "image/SeatTaken.PNG";
                    } else if (y === "2") {
                        document.getElementById("RPB1").src = "image/SeatTaken.PNG";
                    } else if (y === "3") {
                        document.getElementById("RPC1").src = "image/SeatTaken.PNG";
                    } else if (y === "4") {
                        document.getElementById("RPD1").src = "image/SeatTaken.PNG";
                    } else if (y === "5") {
                        document.getElementById("RPE1").src = "image/SeatTaken.PNG";
                    } else if (y === "6") {
                        document.getElementById("RPF1").src = "image/SeatTaken.PNG";
                    } else if (y === "7") {
                        document.getElementById("RPA2").src = "image/SeatTaken.PNG";
                    } else if (y === "8") {
                        document.getElementById("RPB2").src = "image/SeatTaken.PNG";
                    } else if (y === "9") {
                        document.getElementById("RPC2").src = "image/SeatTaken.PNG";
                    } else if (y === "10") {
                        document.getElementById("RPD2").src = "image/SeatTaken.PNG";
                    } else if (y === "11") {
                        document.getElementById("RPE2").src = "image/SeatTaken.PNG";
                    } else if (y === "12") {
                        document.getElementById("RPF2").src = "image/SeatTaken.PNG";
                    } else if (y === "13") {
                        document.getElementById("RPA3").src = "image/SeatTaken.PNG";
                    } else if (y === "14") {
                        document.getElementById("RPB3").src = "image/SeatTaken.PNG";
                    } else if (y === "15") {
                        document.getElementById("RPC3").src = "image/SeatTaken.PNG";
                    } else if (y === "16") {
                        document.getElementById("RPD3").src = "image/SeatTaken.PNG";
                    } else if (y === "17") {
                        document.getElementById("RPE3").src = "image/SeatTaken.PNG";
                    } else if (y === "18") {
                        document.getElementById("RPF3").src = "image/SeatTaken.PNG";
                    } else if (y === "19") {
                        document.getElementById("RPA4").src = "image/SeatTaken.PNG";
                    } else if (y === "20") {
                        document.getElementById("RPB4").src = "image/SeatTaken.PNG";
                    } else if (y === "21") {
                        document.getElementById("RPC4").src = "image/SeatTaken.PNG";
                    } else if (y === "22") {
                        document.getElementById("RPD4").src = "image/SeatTaken.PNG";
                    } else if (y === "23") {
                        document.getElementById("RPE4").src = "image/SeatTaken.PNG";
                    } else if (y === "24") {
                        document.getElementById("RPF4").src = "image/SeatTaken.PNG";
                    } else if (y === "25") {
                        document.getElementById("RPA5").src = "image/SeatTaken.PNG";
                    } else if (y === "26") {
                        document.getElementById("RPB5").src = "image/SeatTaken.PNG";
                    } else if (y === "27") {
                        document.getElementById("RPC5").src = "image/SeatTaken.PNG";
                    } else if (y === "28") {
                        document.getElementById("RPD5").src = "image/SeatTaken.PNG";
                    } else if (y === "29") {
                        document.getElementById("RPE5").src = "image/SeatTaken.PNG";
                    } else if (y === "30") {
                        document.getElementById("RPF5").src = "image/SeatTaken.PNG";
                    } else if (y === "31") {
                        document.getElementById("RPA6").src = "image/SeatTaken.PNG";
                    } else if (y === "32") {
                        document.getElementById("RPB6").src = "image/SeatTaken.PNG";
                    } else if (y === "33") {
                        document.getElementById("RPC6").src = "image/SeatTaken.PNG";
                    } else if (y === "34") {
                        document.getElementById("RPD6").src = "image/SeatTaken.PNG";
                    } else if (y === "35") {
                        document.getElementById("RPE6").src = "image/SeatTaken.PNG";
                    } else if (y === "36") {
                        document.getElementById("RPF6").src = "image/SeatTaken.PNG";
                    } else if (y === "37") {
                        document.getElementById("RPA7").src = "image/SeatTaken.PNG";
                    } else if (y === "38") {
                        document.getElementById("RPB7").src = "image/SeatTaken.PNG";
                    } else if (y === "39") {
                        document.getElementById("RPC7").src = "image/SeatTaken.PNG";
                    } else if (y === "40") {
                        document.getElementById("RPD7").src = "image/SeatTaken.PNG";
                    } else if (y === "41") {
                        document.getElementById("RPE7").src = "image/SeatTaken.PNG";
                    } else if (y === "42") {
                        document.getElementById("RPF7").src = "image/SeatTaken.PNG";
                    } else if (y === "43") {
                        document.getElementById("RPA8").src = "image/SeatTaken.PNG";
                    } else if (y === "44") {
                        document.getElementById("RPB8").src = "image/SeatTaken.PNG";
                    } else if (y === "45") {
                        document.getElementById("RPC8").src = "image/SeatTaken.PNG";
                    } else if (y === "46") {
                        document.getElementById("RPD8").src = "image/SeatTaken.PNG";
                    } else if (y === "47") {
                        document.getElementById("RPE8").src = "image/SeatTaken.PNG";
                    } else if (y === "48") {
                        document.getElementById("RPF8").src = "image/SeatTaken.PNG";
                    } else if (y === "49") {
                        document.getElementById("RPA9").src = "image/SeatTaken.PNG";
                    } else if (y === "50") {
                        document.getElementById("RPB9").src = "image/SeatTaken.PNG";
                    } else if (y === "51") {
                        document.getElementById("RPC9").src = "image/SeatTaken.PNG";
                    } else if (y === "52") {
                        document.getElementById("RPD9").src = "image/SeatTaken.PNG";
                    } else if (y === "53") {
                        document.getElementById("RPE9").src = "image/SeatTaken.PNG";
                    } else if (y === "54") {
                        document.getElementById("RPF9").src = "image/SeatTaken.PNG";
                    } else if (y === "55") {
                        document.getElementById("RPA10").src = "image/SeatTaken.PNG";
                    } else if (y === "56") {
                        document.getElementById("RPB10").src = "image/SeatTaken.PNG";
                    } else if (y === "57") {
                        document.getElementById("RPC10").src = "image/SeatTaken.PNG";
                    } else if (y === "58") {
                        document.getElementById("RPD10").src = "image/SeatTaken.PNG";
                    } else if (y === "59") {
                        document.getElementById("RPE10").src = "image/SeatTaken.PNG";
                    } else if (y === "60") {
                        document.getElementById("RPF10").src = "image/SeatTaken.PNG";
                    } else if (y === "61") {
                        document.getElementById("RPA11").src = "image/SeatTaken.PNG";
                    } else if (y === "62") {
                        document.getElementById("RPB11").src = "image/SeatTaken.PNG";
                    } else if (y === "63") {
                        document.getElementById("RPC11").src = "image/SeatTaken.PNG";
                    } else if (y === "64") {
                        document.getElementById("RPD11").src = "image/SeatTaken.PNG";
                    } else if (y === "65") {
                        document.getElementById("RPE11").src = "image/SeatTaken.PNG";
                    } else if (y === "66") {
                        document.getElementById("RPF11").src = "image/SeatTaken.PNG";
                    } else if (y === "67") {
                        document.getElementById("RPA12").src = "image/SeatTaken.PNG";
                    } else if (y === "68") {
                        document.getElementById("RPB12").src = "image/SeatTaken.PNG";
                    } else if (y === "69") {
                        document.getElementById("RPC12").src = "image/SeatTaken.PNG";
                    } else if (y === "70") {
                        document.getElementById("RPD12").src = "image/SeatTaken.PNG";
                    } else if (y === "71") {
                        document.getElementById("RPE12").src = "image/SeatTaken.PNG";
                    } else if (y === "72") {
                        document.getElementById("RPF12").src = "image/SeatTaken.PNG";
                    } else if (y === "73") {
                        document.getElementById("RPA13").src = "image/SeatTaken.PNG";
                    } else if (y === "74") {
                        document.getElementById("RPB13").src = "image/SeatTaken.PNG";
                    } else if (y === "75") {
                        document.getElementById("RPC13").src = "image/SeatTaken.PNG";
                    } else if (y === "76") {
                        document.getElementById("RPD13").src = "image/SeatTaken.PNG";
                    } else if (y === "77") {
                        document.getElementById("RPE13").src = "image/SeatTaken.PNG";
                    } else if (y === "78") {
                        document.getElementById("RPF13").src = "image/SeatTaken.PNG";
                    } else if (y === "79") {
                        document.getElementById("RPA14").src = "image/SeatTaken.PNG";
                    } else if (y === "80") {
                        document.getElementById("RPB14").src = "image/SeatTaken.PNG";
                    } else if (y === "81") {
                        document.getElementById("RPC14").src = "image/SeatTaken.PNG";
                    } else if (y === "82") {
                        document.getElementById("RPD14").src = "image/SeatTaken.PNG";
                    } else if (y === "83") {
                        document.getElementById("RPE14").src = "image/SeatTaken.PNG";
                    } else if (y === "84") {
                        document.getElementById("RPF14").src = "image/SeatTaken.PNG";
                    } else if (y === "85") {
                        document.getElementById("RPA15").src = "image/SeatTaken.PNG";
                    } else if (y === "86") {
                        document.getElementById("RPB15").src = "image/SeatTaken.PNG";
                    } else if (y === "87") {
                        document.getElementById("RPC15").src = "image/SeatTaken.PNG";
                    } else if (y === "88") {
                        document.getElementById("RPD15").src = "image/SeatTaken.PNG";
                    } else if (y === "89") {
                        document.getElementById("RPE15").src = "image/SeatTaken.PNG";
                    } else if (y === "90") {
                        document.getElementById("RPF15").src = "image/SeatTaken.PNG";
                    }


                }


            }



            function oneWay(oneWay) {

                if (oneWay === 1) {

                    document.getElementById("dissapear1").style.display = "none";
                    document.getElementById("dissapear2").style.display = "none";
                    document.getElementById("T2").style.display = "none";
                    document.getElementById("dissapear3").style.display = "none";
                    document.getElementById("T4").style.display = "none";
                    document.getElementById("dissapear4").style.display = "none";
                    ;

                }

            }



        </script>
        <?php
        //reset the localStorage data
        echo "<script>resetLocalStorageData();</script>";

        //connection
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'flight_ticketing';
        $PAYPAL_URL = "https://www.paypal.com/sdk/js?client-id=AY73ky6y89NgWv1dA6mwZxCeou8UTRMiTlkfvJo3slDqeHsMpqin8Zi69pFvaGI_d7VRD5e7PDHIMwsc";
        // Create connection
        $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //to set the price for the depart flight ticket
        $sqldepart = "SELECT fs.flight_schedule_id, fs.price, r.origin, r.destination 
                FROM flight_schedule fs 
                JOIN route r ON fs.route_id = r.route_id 
                JOIN airplane ap ON fs.airplane_id = ap.airplane_id 
                JOIN seat_detail sd ON ap.airplane_id = sd.airplane_id 
                WHERE fs.flight_schedule_id =" . $_SESSION["departureScheduleID"];
        $resultDepart = $conn->query($sqldepart);

        $departScheduleId;
        $departPrice;
        $departOrigin;
        $departDestination;

        if ($resultDepart->num_rows > 0) {
            $rowdepart = $resultDepart->fetch_assoc();
            $departScheduleId = $rowdepart['flight_schedule_id'];
            $departPrice = $rowdepart['price'];
            $departOrigin = $rowdepart['origin'];
            $departDestination = $rowdepart['destination'];
        }

        //to set the price for the arrival flight ticket
        $arrivalScheduleId;
        $arrivalPrice = 0;
        $arrivalOrigin;
        $arrivalDestination;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_SESSION["return_date"])) {
                $_SESSION["returnScheduleID"] = $_POST["flightScheduleID"];
                $_SESSION["return_departure_time"] = $_POST["departure_time"];
                $_SESSION["return_departure_arrival_time"] = $_POST["arrival_time"];
                $_SESSION["return_departure_time_taken_hour"] = $_POST["time_taken_hour"];
                $_SESSION["return_departure_time_taken_min"] = $_POST["time_taken_min"];
                $_SESSION["return_departure_flight_name"] = $_POST["flight_name"];
                $sqlReturn = "SELECT fs.flight_schedule_id, fs.price, r.origin, r.destination 
                FROM flight_schedule fs 
                JOIN route r ON fs.route_id = r.route_id 
                WHERE fs.flight_schedule_id =" . $_SESSION["returnScheduleID"];
                $resultReturn = $conn->query($sqlReturn);

                if ($resultReturn->num_rows > 0) {
                    $rowReturn = $resultReturn->fetch_assoc();
                    $arrivalScheduleId = $rowReturn['flight_schedule_id'];
                    $arrivalPrice = $rowReturn['price'];
                    $_SESSION["arrivalOrigin"] = $rowReturn['origin'];
                    $_SESSION["departOrigin"] = $rowReturn['destination'];
                    $arrivalOrigin = $rowReturn['origin'];
                    $arrivalDestination = $rowReturn['destination'];
                }
                //arrival
                $sql4 = "SELECT D.seat_id FROM flight_schedule A  JOIN airplane B ON A.airplane_id = B.airplane_id JOIN seat_detail C ON B.airplane_id = C.airplane_id JOIN seat D ON C.seat_id = D.seat_id WHERE C.availability = 'N' AND flight_schedule_id =" . $arrivalScheduleId;

                $result4 = mysqli_query($conn, $sql4);

                $k = 101;
                if ($result4->num_rows > 0) {
                    while ($row4 = $result4->fetch_assoc()) {
                        $value = $row4['seat_id'];

                        echo "<script>localStorage.setItem('$k', '$value');</script>";

                        $k++;
                    }
                    echo "<script>localStorage.setItem('totalseatArrivalTaken', '$k');</script>";
                }
            }
        }



        //for departure 

        $sql2 = "SELECT D.seat_id FROM flight_schedule A  JOIN airplane B ON A.airplane_id = B.airplane_id JOIN seat_detail C ON B.airplane_id = C.airplane_id JOIN seat D ON C.seat_id = D.seat_id WHERE C.availability = 'N' AND flight_schedule_id =" . $departScheduleId;

        $result2 = mysqli_query($conn, $sql2);

        $i = 1;
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $value = $row2['seat_id'];
                echo "<script>localStorage.setItem('$i', '$value');</script>";
                $i++;
            }
            echo "<script>localStorage.setItem('totalseatDepartureTaken', '$i');</script>";
        }


        //test this 
        $totalguest = $_SESSION["guests"];

        echo "<script>setTotalTicketPrice($departPrice,$totalguest,$arrivalPrice,$totalguest);</script>";

        if ($_SESSION["trip"] === "One") {
            $_SESSION["num"] = 1;
        } else {
            $_SESSION["num"] = 2;
        }
        ?>

    </head>
    <body onload=" calculateTotalDepartureArrivalPayment(), setSeatAvailability(), setTotalPassenger(<?php echo $_SESSION["guests"]; ?>), oneWay(<?php echo $_SESSION["num"]; ?>)">

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
        <div class="content">
            <h3>Add-ons</h3>
            <div class="info-container" onclick="openNav(), openSeatPanel(), departureSeatPanel(), topPanelselection(1)"> 

                <img class="addonIcon" src="image/seat_icon.png" alt="alt"/>
                <div class="panelHeader">
                    <p>Seat Selection</p>
                    <p class="panelDescription">Pre-book seat for the lowest price. Price shown are for all flight in your trip.</p>

                    <div class="divBottomDesc">
                        <p id="displayTotalPaymentSeat"> Total: MYR 0.00</p>
                        <div >
                            <div class="divBottomArrivalBaggage">
                                <p class="panelDescription" id="departDescription">Departure Flight <br><b><?php echo $_SESSION["from"] . "-" . $_SESSION["to"] ?></b></p>
                                <p class="panelDescription">Selected Seat</p>
                                <p class="panelDescription" id="displayTotalPaymentDepartureSeat"> Total: MYR 0.00</p>
                                <p class="panelDescription" id="ExtraSeatDeparture"><b>None</b></p>
                            </div>
                            <div class="divBottomArrivalBaggage" id="dissapear1">
                                <p class="panelDescription" id="arrivalDescription">Returning Flight <br><b><?php echo $_SESSION["arrivalOrigin"] . "-" . $_SESSION["departOrigin"] ?></b></p>
                                <p class="panelDescription">Selected Seat</p>
                                <p class="panelDescription" id="displayTotalPaymentReturningSeat"> Total: MYR 0.00</p>
                                <p class="panelDescription" id="ExtraSeatArrival"><b>None</b></p>

                            </div>
                        </div>   
                    </div>  
                </div>
                <div class="infoItemArrow">
                    <img src="image/arrow.png" height="24" width="24" alt="alt"/>
                </div>
            </div>

            <div class="info-container" style="margin-bottom: 100px;"> 

                <img class="addonIcon" src="image/baggage.svg" alt="alt"/>
                <div class="panelHeader">
                    <p>Baggage</p>
                    <p class="panelDescription">Pre-book baggage for the lowest price. Price shown are for all flight in your trip.</p>

                    <div class="divBottomDesc">
                        <p id="displayTotalPaymentBaggage"> Total: MYR 0.00</p>
                        <div >
                            <div class="divBottomArrivalBaggage">
                                <p class="panelDescription" id="departBaggageDescription"><b><?php echo $_SESSION["from"] . "-" . $_SESSION["to"] ?></b></p>
                                <p class="panelDescription">7kg Carry-on baggage per passenger</p>
                                <p class="panelDescription"><b>Extra baggage: </b></p>
                                <p class="panelDescription" id="displayTotalPaymentDepartureBaggage"> Total: MYR 0.00</p>
                                <p class="panelDescription" id="ExtraBaggageDepartureNone"><b>None</b></p>
                                <p class="panelDescription" id="ExtraBaggageDeparture20" style="display: none;"><b>20kg Baggage x </b></p>
                                <p class="panelDescription" id="ExtraBaggageDeparture25" style="display: none;"><b>25kg Baggage x </b></p>
                                <p class="panelDescription" id="ExtraBaggageDeparture30" style="display: none;"><b>30kg Baggage x </b></p>
                                <p class="panelDescription" id="ExtraBaggageDeparture40" style="display: none;"><b>40kg Baggage x </b></p>
                            </div>
                            <div class="divBottomArrivalBaggage" id="dissapear2">
                                <p class="panelDescription" id="arrivalBaggageDescription"><b><?php echo $_SESSION["arrivalOrigin"] . "-" . $_SESSION["departOrigin"] ?></b></p>
                                <p class="panelDescription">7kg Carry-on baggage per passenger</p>
                                <p class="panelDescription"><b>Extra baggage: </b></p>
                                <p class="panelDescription" id="displayTotalPaymentReturningBaggage"> Total: MYR 0.00</p>
                                <p class="panelDescription" id="ExtraBaggageArrivalNone"><b>None</b></p>
                                <p class="panelDescription" id="ExtraBaggageArrival20" style="display: none;"><b>20kg Baggage x </b></p>
                                <p class="panelDescription" id="ExtraBaggageArrival25" style="display: none;"><b>25kg Baggage x </b></p>
                                <p class="panelDescription" id="ExtraBaggageArrival30" style="display: none;"><b>30kg Baggage x </b></p>
                                <p class="panelDescription" id="ExtraBaggageArrival40" style="display: none;"><b>40kg Baggage x </b></p>
                            </div>
                            <div class="divBottomArrivalBaggage"  onclick="openNav(), openBaggagePanel(), topPanelselection(3), departureBaggageSel(<?php echo $_SESSION["guests"]; ?>)" >
                                <ul>                                                                        <!-- n-1 -->
                                    <li style="text-align: right; list-style: none;" >Modify</li>
                                </ul> 
                            </div>
                        </div>   
                    </div>  
                </div>
            </div>
        </div>

        <!-- Side panel -->
        <div id="mySidebar" class="sidebar">

            <!-- seat Side panel  -->
            <div id ="seatPanel">
                <!-- side panel header -->
                <div class="topPanelHeader">
                    <ul class="tabsContainer" id="T1" style="background-color :#bfc5cf; color: black;" onclick="departureSeatPanel(), topPanelselection(1)">
                        <li>
                            <p>Depart</p>
                        </li>
                    </ul>
                    <ul class="tabsContainer" id="T2" style="background-color :black; color : white;" onclick="arrivalSeatPanel(), topPanelselection(2)">
                        <li>
                            <p>Arrival</p>
                        </li>
                    </ul>
                    <ul style="color:white; list-style: none; margin: 0px;">
                        <li>
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                        </li>
                    </ul>
                </div>

                <!-- side panel content for departure-->
                <div id="departureSeat" style="display: block; ">
                    <div style="margin-left:10%;">

                        <p style="margin-bottom:0px;">Premium Seat   <img  src="image/businessSeat.png" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Standard Seat   <img  src="image/Seat.png" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Your seat   <img  src="image/userSeat.png" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Seat taken   <img  src="image/seatTaken.png" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Galley   <img  src="image/Galley.PNG" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Lavatory   <img  src="image/lavatory.PNG" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Closet   <img  src="image/Closet.PNG" height="34" width="34" alt="alt"/></p>

                    </div>  


                    <div style="margin-left: 30%; margin-bottom: 175px; background-image: url(image/airplane_design.PNG); background-repeat: no-repeat; background-size: 71% 100%; height: 1025px;">
                        <div style="height: 217px;"><p></p></div>


                        <div style="margin-left: 112px; display: inline-table;  ">
                            <p style="display: inline-table; margin-right: 20px; "> A </p>
                            <p style="display: inline-table; margin-right: 18px; "> B </p>
                            <p style="display: inline-table; margin-right: 30px;"> C </p>
                            <p style="display: inline-table; margin-right: 20px;"> D </p>
                            <p style="display: inline-table; margin-right: 20px;"> E </p>
                            <p style="display: inline-table; margin-right: 20px;"> F </p>

                        </div>
                        <p style="margin-left: 107px; ">
                            <img  src="image/businessSeat.png" id="PA1" onclick="departSelectSeat('PA1', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PB1" onclick="departSelectSeat('PB1', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PC1" onclick="departSelectSeat('PC1', 'P')" height="24" width="24" alt="alt"/>
                            1
                            <img  src="image/businessSeat.png" id="PD1" onclick="departSelectSeat('PD1', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PE1" onclick="departSelectSeat('PE1', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PF1" onclick="departSelectSeat('PF1', 'P')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/businessSeat.png" id="PA2" onclick="departSelectSeat('PA2', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PB2" onclick="departSelectSeat('PB2', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PC2" onclick="departSelectSeat('PC2', 'P')" height="24" width="24" alt="alt"/>
                            2
                            <img  src="image/businessSeat.png" id="PD2" onclick="departSelectSeat('PD2', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PE2" onclick="departSelectSeat('PE2', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PF2" onclick="departSelectSeat('PF2', 'P')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/businessSeat.png" id="PA3" onclick="departSelectSeat('PA3', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PB3" onclick="departSelectSeat('PB3', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PC3" onclick="departSelectSeat('PC3', 'P')" height="24" width="24" alt="alt"/>
                            3
                            <img  src="image/businessSeat.png" id="PD3" onclick="departSelectSeat('PD3', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PE3" onclick="departSelectSeat('PE3', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PF3" onclick="departSelectSeat('PF3', 'P')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/businessSeat.png" id="PA4" onclick="departSelectSeat('PA4', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PB4" onclick="departSelectSeat('PB4', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PC4" onclick="departSelectSeat('PC4', 'P')" height="24" width="24" alt="alt"/>
                            4
                            <img  src="image/businessSeat.png" id="PD4" onclick="departSelectSeat('PD4', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PE4" onclick="departSelectSeat('PE4', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PF4" onclick="departSelectSeat('PF4', 'P')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/businessSeat.png" id="PA5" onclick="departSelectSeat('PA5', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PB5" onclick="departSelectSeat('PB5', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PC5" onclick="departSelectSeat('PC5', 'P')" height="24" width="24" alt="alt"/>
                            5
                            <img  src="image/businessSeat.png" id="PD5" onclick="departSelectSeat('PD5', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PE5" onclick="departSelectSeat('PE5', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PF5" onclick="departSelectSeat('PF5', 'P')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/businessSeat.png" id="PA6" onclick="departSelectSeat('PA6', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PB6" onclick="departSelectSeat('PB6', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PC6" onclick="departSelectSeat('PC6', 'P')" height="24" width="24" alt="alt"/>
                            6
                            <img  src="image/businessSeat.png" id="PD6" onclick="departSelectSeat('PD6', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PE6" onclick="departSelectSeat('PE6', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PF6" onclick="departSelectSeat('PF6', 'P')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/businessSeat.png" id="PA7" onclick="departSelectSeat('PA7', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PB7" onclick="departSelectSeat('PB7', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PC7" onclick="departSelectSeat('PC7', 'P')" height="24" width="24" alt="alt"/>
                            7
                            <img  src="image/businessSeat.png" id="PD7" onclick="departSelectSeat('PD7', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PE7" onclick="departSelectSeat('PE7', 'P')" height="24" width="24" alt="alt"/>
                            <img  src="image/businessSeat.png" id="PF7" onclick="departSelectSeat('PF7', 'P')" height="24" width="24" alt="alt"/>
                        </p>

                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/Seat.png" id="SA8" onclick="departSelectSeat('SA8', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SB8" onclick="departSelectSeat('SB8', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SC8" onclick="departSelectSeat('SC8', 'N')" height="24" width="24" alt="alt"/>
                            8
                            <img  src="image/Seat.png" id="SD8" onclick="departSelectSeat('SD8', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SE8" onclick="departSelectSeat('SE8', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SF8" onclick="departSelectSeat('SF8', 'N')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/Seat.png" id="SA9" onclick="departSelectSeat('SA9', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SB9" onclick="departSelectSeat('SB9', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SC9" onclick="departSelectSeat('SC9', 'N')" height="24" width="24" alt="alt"/>
                            9
                            <img  src="image/Seat.png" id="SD9" onclick="departSelectSeat('SD9', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SE9" onclick="departSelectSeat('SE9', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SF9" onclick="departSelectSeat('SF9', 'N')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/Seat.png" id="SA10" onclick="departSelectSeat('SA10', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SB10" onclick="departSelectSeat('SB10', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SC10" onclick="departSelectSeat('SC10', 'N')" height="24" width="24" alt="alt"/>
                            10
                            <img  src="image/Seat.png" id="SD10" onclick="departSelectSeat('SD10', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SE10" onclick="departSelectSeat('SE10', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SF10" onclick="departSelectSeat('SF10', 'N')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/Seat.png" id="SA11" onclick="departSelectSeat('SA11', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SB11" onclick="departSelectSeat('SB11', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SC11" onclick="departSelectSeat('SC11', 'N')" height="24" width="24" alt="alt"/>
                            11
                            <img  src="image/Seat.png" id="SD11" onclick="departSelectSeat('SD11', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SE11" onclick="departSelectSeat('SE11', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SF11" onclick="departSelectSeat('SF11', 'N')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/Seat.png" id="SA12" onclick="departSelectSeat('SA12', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SB12" onclick="departSelectSeat('SB12', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SC12" onclick="departSelectSeat('SC12', 'N')" height="24" width="24" alt="alt"/>
                            12
                            <img  src="image/Seat.png" id="SD12" onclick="departSelectSeat('SD12', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SE12" onclick="departSelectSeat('SE12', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SF12" onclick="departSelectSeat('SF12', 'N')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/Seat.png" id="SA13" onclick="departSelectSeat('SA13', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SB13" onclick="departSelectSeat('SB13', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SC13" onclick="departSelectSeat('SC13', 'N')" height="24" width="24" alt="alt"/>
                            13
                            <img  src="image/Seat.png" id="SD13" onclick="departSelectSeat('SD13', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SE13" onclick="departSelectSeat('SE13', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SF13" onclick="departSelectSeat('SF13', 'N')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-left: 107px;">
                            <img  src="image/Seat.png" id="SA14" onclick="departSelectSeat('SA14', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SB14" onclick="departSelectSeat('SB14', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SC14" onclick="departSelectSeat('SC14', 'N')" height="24" width="24" alt="alt"/>
                            14
                            <img  src="image/Seat.png" id="SD14" onclick="departSelectSeat('SD14', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SE14" onclick="departSelectSeat('SE14', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SF14" onclick="departSelectSeat('SF14', 'N')" height="24" width="24" alt="alt"/>
                        </p>
                        <p style="margin-top:10px; margin-bottom:200px; margin-left: 107px;">
                            <img  src="image/Seat.png" id="SA15" onclick="departSelectSeat('SA15', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SB15" onclick="departSelectSeat('SB15', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SC15" onclick="departSelectSeat('SC15', 'N')" height="24" width="24" alt="alt"/>
                            15
                            <img  src="image/Seat.png" id="SD15" onclick="departSelectSeat('SD15', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SE15" onclick="departSelectSeat('SE15', 'N')" height="24" width="24" alt="alt"/>
                            <img  src="image/Seat.png" id="SF15" onclick="departSelectSeat('SF15', 'N')" height="24" width="24" alt="alt"/>
                        </p>

                    </div>

                </div>

                <div id="arrivalSeat" style="display: none;">
                    <div style="margin-left:10%;">

                        <p style="margin-bottom:0px;">Premium Seat   <img  src="image/businessSeat.png" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Standard Seat   <img  src="image/Seat.png" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Your seat   <img  src="image/userSeat.png" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Seat taken   <img  src="image/seatTaken.png" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Galley   <img  src="image/Galley.PNG" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Lavatory   <img  src="image/lavatory.PNG" height="24" width="24" alt="alt"/></p>
                        <p style="margin-bottom:0px;">Closet   <img  src="image/Closet.PNG" height="34" width="34" alt="alt"/></p>

                    </div>  
                    <div style="margin-left: 30%; margin-bottom: 175px; background-image: url(image/airplane_design.PNG); background-repeat: no-repeat; background-size: 71% 100%; height: 1025px;">
                        <div style="height: 217px;"><p></p></div>


                        <div style="margin-left: 112px; display: inline-table;  ">
                            <p style="display: inline-table; margin-right: 20px; "> A </p>
                            <p style="display: inline-table; margin-right: 18px; "> B </p>
                            <p style="display: inline-table; margin-right: 30px;"> C </p>
                            <p style="display: inline-table; margin-right: 20px;"> D </p>
                            <p style="display: inline-table; margin-right: 20px;"> E </p>
                            <p style="display: inline-table; margin-right: 20px;"> F </p>

                        </div> 

                        <div style="margin-left: 107px; ">
                            <p >
                                <img  src="image/businessSeat.png" id="RPA1" onclick="arrivalSelectSeat('RPA1', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPB1" onclick="arrivalSelectSeat('RPB1', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPC1" onclick="arrivalSelectSeat('RPC1', 'P')" height="24" width="24" alt="alt"/>
                                1
                                <img  src="image/businessSeat.png" id="RPD1" onclick="arrivalSelectSeat('RPD1', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPE1" onclick="arrivalSelectSeat('RPE1', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPF1" onclick="arrivalSelectSeat('RPF1', 'P')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px;">
                                <img  src="image/businessSeat.png" id="RPA2" onclick="arrivalSelectSeat('RPA2', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPB2" onclick="arrivalSelectSeat('RPB2', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPC2" onclick="arrivalSelectSeat('RPC2', 'P')" height="24" width="24" alt="alt"/>
                                2
                                <img  src="image/businessSeat.png" id="RPD2" onclick="arrivalSelectSeat('RPD2', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPE2" onclick="arrivalSelectSeat('RPE2', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPF2" onclick="arrivalSelectSeat('RPF2', 'P')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px; ">
                                <img  src="image/businessSeat.png" id="RPA3" onclick="arrivalSelectSeat('RPA3', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPB3" onclick="arrivalSelectSeat('RPB3', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPC3" onclick="arrivalSelectSeat('RPC3', 'P')" height="24" width="24" alt="alt"/>
                                3
                                <img  src="image/businessSeat.png" id="RPD3" onclick="arrivalSelectSeat('RPD3', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPE3" onclick="arrivalSelectSeat('RPE3', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPF3" onclick="arrivalSelectSeat('RPF3', 'P')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px;">
                                <img  src="image/businessSeat.png" id="RPA4" onclick="arrivalSelectSeat('RPA4', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPB4" onclick="arrivalSelectSeat('RPB4', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPC4" onclick="arrivalSelectSeat('RPC4', 'P')" height="24" width="24" alt="alt"/>
                                4
                                <img  src="image/businessSeat.png" id="RPD4" onclick="arrivalSelectSeat('RPD4', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPE4" onclick="arrivalSelectSeat('RPE4', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPF4" onclick="arrivalSelectSeat('RPF4', 'P')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px;">
                                <img  src="image/businessSeat.png" id="RPA5" onclick="arrivalSelectSeat('RPA5', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPB5" onclick="arrivalSelectSeat('RPB5', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPC5" onclick="arrivalSelectSeat('RPC5', 'P')" height="24" width="24" alt="alt"/>
                                5
                                <img  src="image/businessSeat.png" id="RPD5" onclick="arrivalSelectSeat('RPD5', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPE5" onclick="arrivalSelectSeat('RPE5', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPF5" onclick="arrivalSelectSeat('RPF5', 'P')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px;">
                                <img  src="image/businessSeat.png" id="RPA6" onclick="arrivalSelectSeat('RPA6', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPB6" onclick="arrivalSelectSeat('RPB6', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPC6" onclick="arrivalSelectSeat('RPC6', 'P')" height="24" width="24" alt="alt"/>
                                6
                                <img  src="image/businessSeat.png" id="RPD6" onclick="arrivalSelectSeat('RPD6', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPE6" onclick="arrivalSelectSeat('RPE6', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPF6" onclick="arrivalSelectSeat('RPF6', 'P')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px;">
                                <img  src="image/businessSeat.png" id="RPA7" onclick="arrivalSelectSeat('RPA7', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPB7" onclick="arrivalSelectSeat('RPB7', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPC7" onclick="arrivalSelectSeat('RPC7', 'P')" height="24" width="24" alt="alt"/>
                                7
                                <img  src="image/businessSeat.png" id="RPD7" onclick="arrivalSelectSeat('RPD7', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPE7" onclick="arrivalSelectSeat('RPE7', 'P')" height="24" width="24" alt="alt"/>
                                <img  src="image/businessSeat.png" id="RPF7" onclick="arrivalSelectSeat('RPF7', 'P')" height="24" width="24" alt="alt"/>
                            </p>

                            <p style="margin-top:10px;  ">
                                <img  src="image/Seat.png" id="RSA8" onclick="arrivalSelectSeat('RSA8', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSB8" onclick="arrivalSelectSeat('RSB8', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSC8" onclick="arrivalSelectSeat('RSC8', 'N')" height="24" width="24" alt="alt"/>
                                8
                                <img  src="image/Seat.png" id="RSD8" onclick="arrivalSelectSeat('RSD8', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSE8" onclick="arrivalSelectSeat('RSE8', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSF8" onclick="arrivalSelectSeat('RSF8', 'N')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px; ">
                                <img  src="image/Seat.png" id="RSA9" onclick="arrivalSelectSeat('RSA9', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSB9" onclick="arrivalSelectSeat('RSB9', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSC9" onclick="arrivalSelectSeat('RSC9', 'N')" height="24" width="24" alt="alt"/>
                                9
                                <img  src="image/Seat.png" id="RSD9" onclick="arrivalSelectSeat('RSD9', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSE9" onclick="arrivalSelectSeat('RSE9', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSF9" onclick="arrivalSelectSeat('RSF9', 'N')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px; ">
                                <img  src="image/Seat.png" id="RSA10" onclick="arrivalSelectSeat('RSA10', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSB10" onclick="arrivalSelectSeat('RSB10', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSC10" onclick="arrivalSelectSeat('RSC10', 'N')" height="24" width="24" alt="alt"/>
                                10
                                <img  src="image/Seat.png" id="RSD10" onclick="arrivalSelectSeat('RSD10', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSE10" onclick="arrivalSelectSeat('RSE10', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSF10" onclick="arrivalSelectSeat('RSF10', 'N')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px; ">
                                <img  src="image/Seat.png" id="RSA11" onclick="arrivalSelectSeat('RSA11', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSB11" onclick="arrivalSelectSeat('RSB11', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSC11" onclick="arrivalSelectSeat('RSC11', 'N')" height="24" width="24" alt="alt"/>
                                11
                                <img  src="image/Seat.png" id="RSD11" onclick="arrivalSelectSeat('RSD11', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSE11" onclick="arrivalSelectSeat('RSE11', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSF11" onclick="arrivalSelectSeat('RSF11', 'N')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px; ">
                                <img  src="image/Seat.png" id="RSA12" onclick="arrivalSelectSeat('RSA12', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSB12" onclick="arrivalSelectSeat('RSB12', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSC12" onclick="arrivalSelectSeat('RSC12', 'N')" height="24" width="24" alt="alt"/>
                                12
                                <img  src="image/Seat.png" id="RSD12" onclick="arrivalSelectSeat('RSD12', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSE12" onclick="arrivalSelectSeat('RSE12', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSF12" onclick="arrivalSelectSeat('RSF12', 'N')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px;">
                                <img  src="image/Seat.png" id="RSA13" onclick="arrivalSelectSeat('RSA13', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSB13" onclick="arrivalSelectSeat('RSB13', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSC13" onclick="arrivalSelectSeat('RSC13', 'N')" height="24" width="24" alt="alt"/>
                                13
                                <img  src="image/Seat.png" id="RSD13" onclick="arrivalSelectSeat('RSD13', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSE13" onclick="arrivalSelectSeat('RSE13', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSF13" onclick="arrivalSelectSeat('RSF13', 'N')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px; ">
                                <img  src="image/Seat.png" id="RSA14" onclick="arrivalSelectSeat('RSA14', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSB14" onclick="arrivalSelectSeat('RSB14', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSC14" onclick="arrivalSelectSeat('RSC14', 'N')" height="24" width="24" alt="alt"/>
                                14
                                <img  src="image/Seat.png" id="RSD14" onclick="arrivalSelectSeat('RSD14', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSE14" onclick="arrivalSelectSeat('RSE14', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSF14" onclick="arrivalSelectSeat('RSF14', 'N')" height="24" width="24" alt="alt"/>
                            </p>
                            <p style="margin-top:10px; margin-bottom:200px;  ">
                                <img  src="image/Seat.png" id="RSA15" onclick="arrivalSelectSeat('RSA15', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSB15" onclick="arrivalSelectSeat('RSB15', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSC15" onclick="arrivalSelectSeat('RSC15', 'N')" height="24" width="24" alt="alt"/>
                                15
                                <img  src="image/Seat.png" id="RSD15" onclick="arrivalSelectSeat('RSD15', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSE15" onclick="arrivalSelectSeat('RSE15', 'N')" height="24" width="24" alt="alt"/>
                                <img  src="image/Seat.png" id="RSF15" onclick="arrivalSelectSeat('RSF15', 'N')" height="24" width="24" alt="alt"/>
                            </p>

                        </div>
                    </div>
                </div>

                <!-- side panel footer -->
                <div class="panelFooter">
                    <div class="container-fluid content">
                        <p class="panelfooterP">
                            Subtotal
                        </p>
                        <p class="panelfooterP" id="seatTotal">RM0.00

                        </p>
                        <button class="continuePayment" id="dissapear3" style="float:right;" onclick="arrivalSeatPanel(), topPanelselection(2), getSeatRowAndColumngetSeatRowAndColumnDepart(),getSeatRowAndColumngetSeatRowAndColumnReturning()" >Next</button>
                    </div>
                </div> 
            </div>

            <!-- Baggage Side panel  -->
            <div id="baggagePanel">
                <!-- side panel header -->
                <div class="topPanelHeader">
                    <ul class="tabsContainer" id="T3" style="background-color :#bfc5cf; color: black;" onclick="departureBaggageSel(<?php echo $_SESSION["guests"]; ?>), topPanelselection(3)">
                        <li>
                            <p>Depart</p>
                        </li>
                    </ul>
                    <ul class="tabsContainer" id="T4" style="background-color :black; color : white;" onclick="arrivalBaggageSel(<?php echo $_SESSION["guests"]; ?>), topPanelselection(4)">
                        <li>
                            <p>Arrival</p>
                        </li>
                    </ul>
                    <ul style="color:white; list-style: none; margin: 0px;">
                        <li>
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                        </li>
                    </ul>

                </div>

                <!-- 1st side panel content -->
                <div id="departureBaggage" style="display: block;">
                    <div class="baggageSelection" id="a1">
                        <h2>Passenger 1 </h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="1" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(1), totalBaggage(0, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="2" onclick="selectedBaggage(2), totalBaggage(0, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="3" onclick="selectedBaggage(3), totalBaggage(0, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="4" onclick="selectedBaggage(4), totalBaggage(0, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="5" onclick="selectedBaggage(5), totalBaggage(0, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 
                    <div class="baggageSelection" id="a2">
                        <h2>Passenger 2</h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="6" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(6), totalBaggage(1, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="7" onclick="selectedBaggage(7), totalBaggage(1, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="8" onclick="selectedBaggage(8), totalBaggage(1, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="9" onclick="selectedBaggage(9), totalBaggage(1, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="10" onclick="selectedBaggage(10), totalBaggage(1, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 

                    <div class="baggageSelection" id="a3">
                        <h2>Passenger 3</h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="11" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(11), totalBaggage(2, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="12" onclick="selectedBaggage(12), totalBaggage(2, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="13" onclick="selectedBaggage(13), totalBaggage(2, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="14" onclick="selectedBaggage(14), totalBaggage(2, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="15" onclick="selectedBaggage(15), totalBaggage(2, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 
                    <div class="baggageSelection" id="a4">
                        <h2>Passenger 4</h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="16" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(16), totalBaggage(3, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="17" onclick="selectedBaggage(17), totalBaggage(3, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="18" onclick="selectedBaggage(18), totalBaggage(3, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="19" onclick="selectedBaggage(19), totalBaggage(3, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="20" onclick="selectedBaggage(20), totalBaggage(3, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 
                    <div class="baggageSelection" id="a5" style="margin-bottom: 20%;">
                        <h2>Passenger 5</h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="21" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(21), totalBaggage(4, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="22" onclick="selectedBaggage(22), totalBaggage(4, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="23" onclick="selectedBaggage(23), totalBaggage(4, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="24" onclick="selectedBaggage(24), totalBaggage(4, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="25" onclick="selectedBaggage(25), totalBaggage(4, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 
                </div>

                <!-- 2nd side panel footer -->
                <div id="arrivalBaggage" style="display: none;">
                    <div class="arrivalbaggageSelection" id="a6">
                        <h2>Passenger 1</h2>
                        <p>Checked baggage</p>
                        <div class="baggageChoice">

                            <div class="package" id="26" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(26), totalBaggage(5, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="27" onclick="selectedBaggage(27), totalBaggage(5, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="28" onclick="selectedBaggage(28), totalBaggage(5, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="29" onclick="selectedBaggage(29), totalBaggage(5, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="30" onclick="selectedBaggage(30), totalBaggage(5, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 
                    <div class="arrivalbaggageSelection" id="a7">
                        <h2>Passenger 2</h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="31" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(31), totalBaggage(6, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="32" onclick="selectedBaggage(32), totalBaggage(6, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="33" onclick="selectedBaggage(33), totalBaggage(6, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="34" onclick="selectedBaggage(34), totalBaggage(6, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="35" onclick="selectedBaggage(35), totalBaggage(6, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 

                    <div class="arrivalbaggageSelection" id="a8">
                        <h2>Passenger 3</h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="36" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(36), totalBaggage(7, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="37" onclick="selectedBaggage(37), totalBaggage(7, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="38" onclick="selectedBaggage(38), totalBaggage(7, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="39" onclick="selectedBaggage(39), totalBaggage(7, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="40" onclick="selectedBaggage(40), totalBaggage(7, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 
                    <div class="arrivalbaggageSelection" id="a9">
                        <h2>Passenger 4</h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="41" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(41), totalBaggage(8, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="42" onclick="selectedBaggage(42), totalBaggage(8, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="43" onclick="selectedBaggage(43), totalBaggage(8, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="44" onclick="selectedBaggage(44), totalBaggage(8, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="45" onclick="selectedBaggage(45), totalBaggage(8, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 
                    <div class="arrivalbaggageSelection" id="a10" style="margin-bottom: 20%;">
                        <h2>Passenger 5</h2>
                        <p>Checked baggage.</p>
                        <div class="baggageChoice">

                            <div class="package" id="46" style="border-color: rgb(6, 126, 65);" onclick="selectedBaggage(46), totalBaggage(9, 0)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>No checked<br> baggage</p>
                            </div>

                            <div class="package" id="47" onclick="selectedBaggage(47), totalBaggage(9, 100.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>20kg<br> MYR100.60</p>
                            </div>

                            <div class="package" id="48" onclick="selectedBaggage(48), totalBaggage(9, 125.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>25kg<br> MYR125.60</p>
                            </div>

                            <div class="package" id="49" onclick="selectedBaggage(49), totalBaggage(9, 150.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>30kg<br> MYR150.60</p>
                            </div>

                            <div class="package" id="50" onclick="selectedBaggage(50), totalBaggage(9, 175.60)">
                                <img src="image/extraLuggage.png" height="24" width="24" alt="alt"/>
                                <p>40kg<br> MYR175.60</p>
                            </div>
                        </div>
                    </div> 
                </div> 

                <!-- side panel footer -->
                <div class="panelFooter">
                    <div class="container-fluid content">
                        <p class="panelfooterP">
                            Subtotal
                        </p>
                        <p class="panelfooterP" id="totalbaggagePayment">RM0.00

                        </p>
                        <button class="continuePayment" id="dissapear4" style="float:right;" onclick="arrivalBaggageSel(<?php echo $_SESSION["guests"]; ?>), topPanelselection(4)" >Next</button>
                    </div>
                </div> 
            </div>

        </div>

        <!-- Bottom Navigation  -->
        <nav class="navbar fixed-bottom navbar-expand-sm bg-white navbar-light bottomNav">
            <div class="container-fluid content">
                <div >
                    <p class="totalAmount">MYR</p>

                    <p class="totalAmount" id="FinalTotalAmount">0.00</p>


                </div>

                <a class="continuePayment" onclick="calculateTotalDepartureArrivalPayment(), getSeatRowAndColumn()" href="http://localhost/flight_ticketing_system/Passenger_Details/PassengerDetails.php">Continue</a>
            </div>
        </nav>

    </body>
</html>





