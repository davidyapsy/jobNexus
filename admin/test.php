<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    // $companyId = base64_decode($_GET['id']);

    $sql = "SELECT employerID, companyName, contactPersonName, emailAddress, password, phoneNumber, address, numberOfEmployees, industry, state, aboutUs, logo, backgroundPicture, 
            officePicture, facebookUrl, linkedinUrl, whatsappUrl, status, dateJoined
            FROM employer
            WHERE employerID = 'E2300000'";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    $data =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $data = $row;
    }

?>
<!DOCTYPE html>
<html>
<head>
        <title>Gogo Airline</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
        
        <!-- Summernote CSS -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <link href="assets/css/content.css" type="text/css" rel="stylesheet">

        <style>
            .required{
                color:red;
            }
        </style>
    </head>
    <body>
        <?php require('topBar.php') ?>
        <?php require('sideNav.php') ?>
        <div class="main">
            <div class="panel panel-bordered p-2">
            <div class="panel-heading p-2">
                    <div class="row">
                        <div class="col-12">
                            <h3>Company Profile</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Profile Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post" >
                        <input type="hidden" id="companyId" name="companyId" value=" <?= base64_encode($companyId);?>">
                        <div class="form-group row">
                            <label for="companyName" class="col-sm-3 col-form-label">Company Name: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="companyName" id="companyName" value="<?= $data['companyName'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contactPersonName" class="col-sm-3 col-form-label">Contact Person Name: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="contactPersonName" id="contactPersonName" value="<?= $data['contactPersonName'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emailAddress" class="col-sm-3 col-form-label">Email: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="emailAddress" id="emailAddress" value="<?= $data['emailAddress'];?>"/>
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
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone Number: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        +60
                                    </span>
                                    <input type="input" class="form-control" name="phoneNumber" id="phoneNumber" value="<?= $data['phoneNumber'];?>"/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="address" id="address" rows="3"><?= $data['address'];?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Number Of Employees: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="numberOfEmployees" name="numberOfEmployees">
                                    <option value=""> -- Please select number of employees. -- </option>
                                    <option value="10-50" <?= $data['numberOfEmployees']=='10-50'? 'selected':'';?>>10-50</option>
                                    <option value="50-100" <?= $data['numberOfEmployees']=='50-100'? 'selected':'';?>>50-100</option>
                                    <option value="100-500" <?= $data['numberOfEmployees']=='100-500'? 'selected':'';?>>100-500</option>
                                    <option value="> 500" <?= $data['numberOfEmployees']=='> 500'? 'selected':'';?>>> 500</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Number Of Employees: <span class="required">*</span> </label>
                            <div class="col-sm-3">
                                <select class="form-select" id="numberOfEmployees" name="numberOfEmployees">
                                    <option value=""> -- Please select number of employees. -- </option>
                                    <option value="Accounting/Finance" <?= $data['numberOfEmployees']=='10-50'? 'selected':'';?>>10-50</option>
                                    <option value="Admin/Human Resources" <?= $data['numberOfEmployees']=='50-100'? 'selected':'';?>>50-100</option>
                                    <option value="Sales/Marketing" <?= $data['numberOfEmployees']=='100-500'? 'selected':'';?>>100-500</option>
                                    <option value="> 500" <?= $data['numberOfEmployees']=='> 500'? 'selected':'';?>>> 500</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">State: <span class="required">*</span> </label>
                            <div class="col-sm-3">
                                <select class="form-select" id="state" name="state">
                                    <option value=""> -- Please select a state. -- </option>
                                    <option value="Selangor" <?= $data['state']=='Selangor'? 'selected':'';?>>Selangor</option>
                                    <option value="Kuala Lumpur" <?= $data['state']=='Kuala Lumpur'? 'selected':'';?>>Kuala Lumpur</option>
                                    <option value="Sabah" <?= $data['state']=='Sabah'? 'selected':'';?>>Sabah</option>
                                    <option value="Kelantan" <?= $data['state']=='Kelantan'? 'selected':'';?>>Kelantan</option>
                                    <option value="Sarawak" <?= $data['state']=='Sarawak'? 'selected':'';?>>Sarawak</option>
                                    <option value="Pahang" <?= $data['state']=='Pahang'? 'selected':'';?>>Pahang</option>
                                    <option value="Kedah" <?= $data['state']=='Kedah'? 'selected':'';?>>Kedah</option>
                                    <option value="Terengganu" <?= $data['state']=='Terengganu'? 'selected':'';?>>Terengganu</option>
                                    <option value="Negeri Sembilan" <?= $data['state']=='Negeri Sembilan'? 'selected':'';?>>Negeri Sembilan</option>
                                    <option value="Perak" <?= $data['state']=='Perak'? 'selected':'';?>>Perak</option>
                                    <option value="Johor" <?= $data['state']=='Johor'? 'selected':'';?>>Johor</option>
                                    <option value="Malacca" <?= $data['state']=='Malacca'? 'selected':'';?>>Malacca</option>
                                    <option value="Penang" <?= $data['state']=='Penang'? 'selected':'';?>>Penang</option>
                                    <option value="Perlis" <?= $data['state']=='Perlis'? 'selected':'';?>>Perlis</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">State: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <textarea id="summernote"></textarea>
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
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <!-- Summernote JS -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

    </body>
</html>

<script>
    $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 400
    });
</script>