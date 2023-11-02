<?php
session_start();

if($_SESSION['staffLoggedIn'] && $_SESSION['position']=="manager"){

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
                            <h3>Staff Maintenance / View</h3>
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
                                <input type="text" class="form-control" id="staffName" name="staffName" value="<?= $data['name']?>" readonly> 
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone Number: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $data['phone_number']?>" readonly> 
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">                        
                            <label for="emailAddress" class="col-sm-3 col-form-label">Email Address: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="emailAddress" name="emailAddress" value="<?= $data['email_address']?>" readonly>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" readonly> 
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
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" readonly> 
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
                                <select class="form-select" id="status" name="status" disabled>
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
                                <select class="form-select" id="position" name="position" disabled>
                                    <option value=""> -- Please select a position. -- </option>
                                    <option value="manager" <?= $data['position']=='manager'? 'selected':'';?>>Manager</option>
                                    <option value="pilot" <?= $data['position']=='pilot'? 'selected':'';?>>Pilot</option>
                                    <option value="steward" <?= $data['position']=='steward'? 'selected':'';?>>Steward</option>
                                    <option value="stewardess" <?= $data['position']=='stewardess'? 'selected':'';?>>Stewardess</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
    <!-- Footer -->

    <!-- Footer -->
</html>

<?php 
} else {
    header("Location: /flight_ticketing_system/staffLogin.html");
}

?>