<?php
session_start();

if($_SESSION['staffLoggedIn']){

    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "flight_ticketing";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $staffId = base64_decode($_GET['id']);

    $sql = "SELECT name, phone_number, email_address, status, position
            FROM staff
            WHERE staff_id = $staffId";

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
                            <h3>Staff Maintenance / Update</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;">Staff Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post" >  
                        <input type="hidden" id="staffId" name="staffId" value="<?=base64_encode($staffId)?>">
                        <div class="form-group row">                        
                            <label for="staffName" class="col-sm-3 col-form-label">Staff Name: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="staffName" name="staffName" value="<?= $data['name']?>"> 
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">                        
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone Number: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $data['phone_number']?>"> 
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">                        
                            <label for="emailAddress" class="col-sm-3 col-form-label">Email Address: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="emailAddress" name="emailAddress" value="<?= $data['email_address']?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"> 
                                    <span class="input-group-text" onclick="toggleVisibility('password', 'passwordVisibility')">
                                        <i id="passwordVisibility" class='bi bi-eye-slash'></i>
                                    </span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"> 
                                    <span class="input-group-text" onclick="toggleVisibility('confirmPassword', 'confirmPasswordVisibility')">
                                        <i id="confirmPasswordVisibility" class="bi bi-eye-slash"></i>
                                    </span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="departureTime" class="col-sm-3 col-form-label">Status: <span class="required">*</span></label>
                            <div class="col-sm-3">
                                <select class="form-select" id="status" name="status">
                                    <option value=""> -- Please select a status. -- </option>
                                    <option value="available" <?= $data['status']=='available'? 'selected':'';?>>Available</option>
                                    <option value="unavailable" <?= $data['status']=='unavailable'? 'selected':'';?>>Unavailable</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Position: <span class="required">*</span> </label>
                            <div class="col-sm-3">
                                <select class="form-select" id="position" name="position">
                                    <option value=""> -- Please select a position. -- </option>
                                    <option value="manager" <?= $data['position']=='manager'? 'selected':'';?>>Manager</option>
                                    <option value="pilot" <?= $data['position']=='pilot'? 'selected':'';?>>Pilot</option>
                                    <option value="steward" <?= $data['position']=='steward'? 'selected':'';?>>Steward</option>
                                    <option value="stewardess" <?= $data['position']=='stewardess'? 'selected':'';?>>Stewardess</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick ="submitConfirmation()" class="btn btn-primary" style="float:right;">Submit</button>
                                <?php if($_SESSION['position']=="manager"){ ?><button type="button" onclick="backConfirmation()" class="btn btn-danger btn-outline">Back</button><?php } ?>
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
        let url = "staff_controller.php";
        
        function toggleVisibility(input, e){
            var passInput=$("#"+input);
            if(passInput.attr('type')==='password'){
                passInput.attr('type','text');
                $('#'+e).removeClass('bi bi-eye-slash').addClass('bi bi-eye');
            }else{
                passInput.attr('type','password');
                $('#'+e).removeClass('bi bi-eye').addClass('bi bi-eye-slash');
            }
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
                    window.location.href = "staff_index.php"
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
                    staffName : $("#staffName").val(),
                    phoneNumber : $("#phoneNumber").val(),
                    emailAddress : $("#emailAddress").val(),
                    password : $("#password").val(),
                    confirmPassword : $('#confirmPassword').val(),
                    status : $('#status').val(),
                    position : $('#position').val()
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
                    staffId : $("#staffId").val(),
                    staffName : $("#staffName").val(),
                    phoneNumber : $("#phoneNumber").val(),
                    emailAddress : $("#emailAddress").val(),
                    password : $("#password").val(),
                    status : $('#status').val(),
                    position : $('#position').val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        $("#password").val('');
                        $("#confirmPassword").val('');
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record successfully updated! ',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        });

                    } else {
                
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }
    </script>
</html>

<?php 
} else {
    header("Location: /flight_ticketing_system/staffLogin.html");
}

?>