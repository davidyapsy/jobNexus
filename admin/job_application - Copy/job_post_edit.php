<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "flight_ticketing";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $flightScheduleId = base64_decode($_GET['id']);

    $sql = "SELECT A.route_id, A.airplane_id, departure_time, departure_day, price, starting_date, name, origin, destination
            FROM flight_schedule A
            JOIN airplane B ON A.airplane_id = B.airplane_id
            JOIN route C ON A.route_id = C.route_id
            WHERE flight_schedule_id = $flightScheduleId";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    $data =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $data = $row;
    }

?>
<html>
    <head>
        <title>Gogo Airline</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <!-- icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
    
        <link href="../../admin/assets/css/content.css" type="text/css" rel="stylesheet">
        <style>
            .required{
                color:red;
            }
        </style>
    </head>

    <body>
        <?php require('../../admin/topBar.php') ?>
        <?php require('../../admin/sideNav.php') ?>

        <div class="main">
            <div class="panel panel-bordered p-2">
                <div class="panel-heading p-2">
                    <div class="row">
                        <div class="col-12">
                            <h3>Flight Schedule / Update</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;">Flight Schedule Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post" >
                        <input type="hidden" id="flightScheduleId" name="flightScheduleId" value=" <?= base64_encode($flightScheduleId);?>">
                        <div class="form-group text-center">
                            <h3>Plane</h3>
                        </div>    
                        <div class="form-group row">                        
                            <label for="planeName" class="col-sm-3 col-form-label">Plane Number: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-select" id="planeName" name="planeName">
                                    <option value="0"> -- Please select a plane number. -- </option>
                                    <?php $airplane_sql = "SELECT airplane_id, name, plane_type
                                                            FROM airplane
                                                            WHERE status='active'
                                                            ORDER BY airplane_id ASC";
                                    $airplane_result = $connection->query($airplane_sql);
                                    while (($row = $airplane_result->fetch_assoc()) == TRUE) { ?>
                                        <option value="<?= $row['airplane_id'] ?>" <?php echo ($row['airplane_id'] == $data['airplane_id']) ? 'selected' : '';?>>
                                            <?= $row['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group text-center">
                            <h3>Route</h3>
                        </div>    
                        <div class="form-group row">                        
                            <label for="origin" class="col-sm-3 col-form-label">Origin: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-select" id="origin" name="origin" onchange="generateDestination()">
                                    <option value=""> -- Please select an origin. --</option>
                                    <?php $origin_sql = "SELECT DISTINCT origin
                                                        FROM route
                                                        ORDER BY route_id ASC";
                                    $origin_result = $connection->query($origin_sql);
                                    while (($route = $origin_result->fetch_assoc()) == TRUE) { ?>
                                        <option value="<?= $route['origin'] ?>" <?php echo ($route['origin'] == $data['origin']) ? 'selected' : '';?>>
                                            <?= $route['origin'] ?>
                                        </option>
                                        <?php } ?>
                                </select>
                                <div class="invalid-feedback"></div>

                            </div>
                        </div>
                        <div class="form-group row">                        
                            <label for="destination" class="col-sm-3 col-form-label">Destination: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-select" id="destination" name="destination">
                                    <option value="">-- Please select a destination. --</option>
                                    <?php $destination_sql = "SELECT DISTINCT destination
                                                        FROM route
                                                        ORDER BY route_id ASC";
                                    $destination_result = $connection->query($destination_sql);
                                    while (($route = $destination_result->fetch_assoc()) == TRUE) { ?>
                                        <option value="<?= $route['destination'] ?>" <?php echo ($route['destination'] == $data['destination']) ? 'selected' : '';?>>
                                            <?= $route['destination'] ?>
                                        </option>
                                        <?php } ?>
                                </select>
                                <div class="invalid-feedback"></div>

                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-3">Departure day: <span class="required">*</span></div>
                            <div class="col-sm-9">
                                <div class="form-check form-switch">
                                    <input class="form-check-input departure_day" type="checkbox" id="chkMonday"
                                        name="departureDay" value="Monday">
                                    <label class="form-check-label" for="gridCheck1">
                                        Monday
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input departure_day" type="checkbox" id="chkTuesday"
                                        name="departureDay" value="Tuesday">
                                    <label class="form-check-label" for="gridCheck1">
                                        Tuesday
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input departure_day" type="checkbox" id="chkWednesday" 
                                        name="departureDay" value="Wednesday">
                                    <label class="form-check-label" for="gridCheck1">
                                        Wednesday
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input departure_day" type="checkbox" id="chkThursday" 
                                        name="departureDay" value="Thursday">
                                    <label class="form-check-label" for="gridCheck1">
                                        Thursday
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input departure_day" type="checkbox" id="chkFriday" 
                                        name="departureDay" value="Friday">
                                    <label class="form-check-label" for="gridCheck1">
                                        Friday
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input departure_day" type="checkbox" id="chkSaturday"
                                        name="departureDay" value="Saturday">
                                    <label class="form-check-label" for="gridCheck1">
                                        Saturday
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input departure_day" type="checkbox" id="chkSunday" 
                                        name="departureDay" value="Sunday">
                                    <label class="form-check-label" for="gridCheck1">
                                        Sunday
                                    </label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="departureTime" class="col-sm-3 col-form-label">Departure Time: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control time" name="departureTime" id="departureTime" value="<?= $data['departure_time'];?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Price (RM): <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control time" step="50" name="price" id="price" value="<?= $data['price'];?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scheduleStartDate" class="col-sm-3 col-form-label">Schedule start date: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control date" name="scheduleStartDate" id="scheduleStartDate" value="<?= $data['starting_date'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick ="submitConfirmation()" class="btn btn-primary" style="float:right;">Save</button>
                                <button type="button" onclick="backConfirmation()" class="btn btn-danger btn-outline">Back</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
    <!-- Footer -->

    <!-- Footer -->

    <script>
        let url = "flight_schedule_controller.php";
        let chkedDepartureDay = '<?php echo $data['departure_day'];?>';

        $( window ).on( "load", function() {
            $("#chk"+'<?php echo $data['departure_day'];?>').click();
        } );

        $('.departure_day').click(function(){     
            if(this.checked == true){
                chkedDepartureDay = this.value;
                $('.departure_day').attr('disabled', true);
                $(this).attr('disabled', false);
                $(this).attr('checked', true);      
            }else{
                chkedDepartureDay = "";
                $(this).attr('checked', false);      
                $('.departure_day').attr('disabled', false);
            }    
        });

        function generateDestination(){
            $('#destination')
                .find('option')
                .remove()
                .end()
                .append('<option value="">-- Please select a destination. --</option>');

            $.ajax({
                type: "POST",
                contentType: "application/x-www-form-urlencoded",
                url: url,
                data: { 
                    mode: "generateDestination",
                    origin :  $("#origin").val()
                }, success: function (response) {
                const data = response;
                if (data.status) {
                    let records = data.data;
                    $.each(records, function (i, record) {
                        $('#destination').append($('<option>', { 
                            value: record['destination'],
                            text : record['destination']
                        }));
                    });
                } else {
                    console.log("something wrong");
                }
            }, failure: function (xhr) {
                console.log(xhr.status);
            }

        });
        }

        function backConfirmation(){
            Swal.fire({
                title: "Are you sure to leave this page?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                confirmButtonText: 'Discard',
                cancelButtonText: "Stay",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "flight_schedule_index.php"
                }
                
            });
        }

        function submitConfirmation(){
            Swal.fire({
                title: "Are you sure to save it?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    submitValidate();
                }
            });
        }

        function submitValidate(){
            $('.is-invalid').removeClass('is-invalid');

            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "check_validation",
                    type: "edit",
                    airplaneId : $("#planeName").val(),
                    origin : $("#origin").val(),
                    destination : $("#destination").val(),
                    departureDay : chkedDepartureDay,
                    departureTime : $("#departureTime").val(),
                    price : $('#price').val(),
                    startingDate : $('#scheduleStartDate').val()
                }, success: function (response) {
                    const data = response;
                    if (data.status==false) {
                        for(let i=0;i<data.data.length;i++){
                            let eachData = data.data[i];
                            var el = $('[name="' + eachData['inputName'] + '"]');
                            el.addClass("is-invalid");
                            el.parent().closest('div').find('.invalid-feedback').text(eachData['errorMessage']); 
                        }
                    } else {
                        updateRecord();
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }

        function updateRecord() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "update",
                    flightScheduleId : $('#flightScheduleId').val(),
                    airplaneId : $("#planeName").val(),
                    origin : $("#origin").val(),
                    destination : $("#destination").val(),
                    departureDay : chkedDepartureDay,
                    departureTime : $("#departureTime").val(),
                    price : $('#price').val(),
                    startingDate : $('#scheduleStartDate').val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record successfully updated! ',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                    } else {
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }
    </script>
</html>