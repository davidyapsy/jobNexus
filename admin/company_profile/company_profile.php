<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    // $employerID = base64_decode($_GET['id']);

    $sql = "SELECT *
            FROM employer
            WHERE employerID = 'E2300000'";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    $data =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $data = $row;
    }

    $officePictures = $data['officePictures'];
    $officePicture_arr = explode(",", $officePictures);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Job Nexus</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- Sweet Alert CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
        <!-- Bootstrap icon CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
        <!-- Summernote CSS -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <link href="../assets/css/content.css" type="text/css" rel="stylesheet">

        <style>
            .required{
                color:red;
            }
        </style>
    </head>

    <body>
        <?php require('../topBar.php') ?>
        <?php require('../sideNav.php') ?>

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
                    <form id="form_details" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="employerID" name="employerID" value="<?= base64_encode('E2300000');?>">
                        <div class="form-group row">
                            <label for="companyName" class="col-sm-3 col-form-label">Company Name: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="companyName" id="companyName" value="<?= $data['companyName'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contactPersonName" class="col-sm-3 col-form-label">Contact Person Name: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contactPersonName" id="contactPersonName" value="<?= $data['contactPersonName'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emailAddress" class="col-sm-3 col-form-label">Email Address: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="emailAddress" id="emailAddress" value="<?= $data['emailAddress'];?>" placeholder="jobnexus@jobnexus.com"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password: </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" 
                                        title="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character"> 
                                    <span class="input-group-text" onclick="toggleVisibility('password', 'passwordVisibility')">
                                        <i id="passwordVisibility" class='bi bi-eye-slash'></i>
                                    </span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password: </label>
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
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone Number: </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        +60
                                    </span>
                                    <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" value="<?= $data['phoneNumber'];?>"/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address Line 1: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="addressLineOne" id="addressLineOne" value="<?= $data['addressLineOne'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address Line 2: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="addressLineTwo" id="addressLineTwo" value="<?= $data['addressLineTwo'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address Line 3: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="addressLineThree" id="addressLineThree" value="<?= $data['addressLineThree'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Postcode: <span class="required">*</span></label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="postcode" id="postcode" value="<?= $data['postcode'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">City: <span class="required">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="city" id="city" value="<?= $data['city'];?>"/>
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
                            <label for="price" class="col-sm-3 col-form-label">Industry: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="industry" name="industry">
                                    <option value=""> -- Please select an industry. -- </option>
                                    <option value="Technology" <?= $data['industry']=='Technology'? 'selected':'';?>>Technology</option>
                                    <option value="Healthcare" <?= $data['industry']=='Healthcare'? 'selected':'';?>>Healthcare</option>
                                    <option value="Finance" <?= $data['industry']=='Finance'? 'selected':'';?>>Finance</option>
                                    <option value="Manufacturing" <?= $data['industry']=='Manufacturing'? 'selected':'';?>>Manufacturing</option>
                                    <option value="Retail" <?= $data['industry']=='Retail'? 'selected':'';?>>Retail</option>
                                    <option value="Agriculture" <?= $data['industry']=='Agriculture'? 'selected':'';?>>Agriculture</option>
                                    <option value="Energy" <?= $data['industry']=='Energy'? 'selected':'';?>>Energy</option>
                                    <option value="Entertainment" <?= $data['industry']=='Entertainment'? 'selected':'';?>>Entertainment</option>
                                    <option value="Transportation" <?= $data['industry']=='Transportation'? 'selected':'';?>>Transportation</option>
                                    <option value="Hospitality and Tourism" <?= $data['industry']=='Hospitality and Tourism'? 'selected':'';?>>Hospitality and Tourism</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">About Us: </label>
                            <div class="col-sm-9">
                                <div id="aboutUs"><?= $data['aboutUs']?></div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label">Logo: </label>
                            <div class="col-sm-9">
                                <?php if($data['logo']!="") { ?>
                                    <div class="body-background">
                                        <a href="uploads/<?= $data['logo']; ?>">
                                            <img src="uploads/<?= $data['logo']; ?>"
                                                style="width:250px;">
                                        </a>
                                        <button type="button" data-name="deleteLogo" class="btn btn-danger"
                                            onclick="removeImage(this)"><i class="bi bi-trash"></i></button>
                                    </div>
                                <?php } ?>
                                <input type="file" class="form-control" id="logo" name="logo" value=""/>
                                <input type="hidden" id="deleteLogo" name="deleteLogo" value="">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="backgroundPicture" class="col-sm-3 col-form-label">Background Picture: </label>
                            <div class="col-sm-9">
                                <?php if($data['backgroundPicture']!="") { ?>
                                    <div class="body-background">
                                        <a href="uploads/<?= $data['backgroundPicture']; ?>">
                                            <img src="uploads/<?= $data['backgroundPicture']; ?>"
                                                style="width:250px;">
                                        </a>
                                        <button type="button" data-name="deleteBackgroundPicture" class="btn btn-danger"
                                            onclick="removeImage(this)"><i class="bi bi-trash"></i></button>
                                    </div>
                                <?php } ?>
                                <input type="file" class="form-control" id="backgroundPicture" name="backgroundPicture" value=""/>
                                <input type="hidden" id="deleteBackgroundPicture" name="deleteBackgroundPicture" value="">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="officePicture" class="col-sm-3 col-form-label custom-file-label">Office Pictures: </label>
                            <div class="col-sm-9">
                                <?php if($data['officePictures']!="") { ?>
                                    <?php foreach($officePicture_arr as $officePicture) { ?>
                                        <div class="body-background">
                                            <a href="uploads/<?= $officePicture ?>">
                                                <img src="uploads/<?= $officePicture ?>"
                                                    style="width:250px;">
                                            </a>
                                            <button type="button" data-name="deleteOfficePicture" class="btn btn-danger"
                                                onclick="removeImage(this)"><i class="bi bi-trash"></i></button>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <input type="file" class="form-control custom-file-input" id="officePictures" name="officePictures" value="" multiple=multiple/>
                                <input type="hidden" id="deleteOfficePicture" name="deleteOfficePicture" value=""> 
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="websiteUrl" class="col-sm-3 col-form-label">Website Url: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="websiteUrl" id="websiteUrl"  value="<?= $data['websiteUrl'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="facebookUrl" class="col-sm-3 col-form-label">Facebook Url: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="facebookUrl" id="facebookUrl"  value="<?= $data['facebookUrl'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="linkedinUrl" class="col-sm-3 col-form-label">LinkedIn Url: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="linkedinUrl" id="linkedinUrl"  value="<?= $data['linkedinUrl'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="whatsappUrl" class="col-sm-3 col-form-label">Whatsapp Url: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="whatsappUrl" id="whatsappUrl"  value="<?= $data['whatsappUrl'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status: </label>
                            <div class="col-sm-3">
                                <select class="form-select" id="status" name="status" disabled>
                                    <option value=""> -- Please select status. -- </option>
                                    <option value="Approved" <?= $data['status']=='Approved'? 'selected':'';?>>Approved</option>
                                    <option value="Pending" <?= $data['status']=='Pending'? 'selected':'';?>>Pending</option>
                                    <option value="Rejected" <?= $data['status']=='Rejected'? 'selected':'';?>>Rejected</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dateJoined" class="col-sm-3 col-form-label">Date Joined: </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="dateJoined" id="dateJoined" value="<?= $data['dateJoined'];?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick ="submitConfirmation()" class="btn btn-primary" style="float:right;">Save</button>
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
        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

    </body>

    <script>
        let url = "company_profile_controller.php";

        $('#aboutUs').summernote({
            tabsize: 2,
            height: 400
        });

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

        // function submitValidate(){
        //     var form = $("#form_details");
        //     // you can't pass Jquery form it has to be javascript form object
        //     var formData = new FormData(form[0]);
        //     formData.append('mode', 'check_validation');
        //     $.ajax({
        //         url: url,
        //         type: "POST",
        //         data: formData,
        //         contentType: false, 
        //         processData: false,
        //         success: function(result) {
        //             if (result.status) {
        //                 $("#form_details").submit();
        //             } else {
        //                 card_el.close();
        //                 var errors = result.errors;
        //                 $.each(errors, function(i, item) {
        //                     // Add class for invalid field
        //                     var el = $('[name="' + i + '"]');
        //                     if (i == "logo" || i == "bodyBackground" || i == "shopImage") {
        //                         el.next().addClass("is-invalid");
        //                     } else {
        //                         el.addClass("is-invalid");
        //                     }

        //                     // Distribute message
        //                     el.parent().closest('div').find('.invalid-feedback').text(item);
        //                 });
        //                 window.scrollTo(0, 0);
        //             }
        //         },
        //     });
        // }

        function getFileNames(inputName){
            var files = $('#'+inputName)[0].files;
            var filesArr = "";
            for (j=0; j < files.length; j++) {
                if(j>0){
                    filesArr+=","+files[j].name;

                }else{
                    filesArr+=files[j].name;
                }
            }  
            return filesArr;
        }

        function submitValidate(){
            $('.is-invalid').removeClass('is-invalid');
            var officePicturesArr = getFileNames('officePictures');
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "check_validation",
                    companyName: $("#companyName").val(),
                    contactPersonName: $("#contactPersonName").val(),
                    emailAddress: $("#emailAddress").val(),
                    password: $("#password").val(),
                    confirmPassword: $("#confirmPassword").val(),
                    phoneNumber: $("#phoneNumber").val(),
                    addressLineOne: $("#addressLineOne").val(),
                    addressLineTwo: $("#addressLineTwo").val(),
                    postcode: $("#postcode").val(),
                    city: $("#city").val(),
                    state: $("#state").val(),
                    numberOfEmployees: $("#numberOfEmployees").val(),
                    industry: $("#industry").val(),
                    logo: $('#logo').val().split('\\').pop() =="" ? "" : $('#logo').val().split('\\').pop(),
                    backgroundPicture: $('#backgroundPicture').val().split('\\').pop() =="" ? "" : $('#backgroundPicture').val().split('\\').pop(),
                    officePictures: officePicturesArr
                }, success: function (response) {
                    window.scrollTo(0, 0);

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
            var officePicturesArr = getFileNames('officePictures');
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "update",
                    employerID : $("#employerID").val(),
                    companyName: $("#companyName").val(),
                    contactPersonName: $("#contactPersonName").val(),
                    emailAddress: $("#emailAddress").val(),
                    password: $("#password").val(),
                    phoneNumber: $("#phoneNumber").val(),
                    addressLineOne: $("#addressLineOne").val(),
                    addressLineTwo: $("#addressLineTwo").val(),
                    addressLineThree: $("#addressLineThree").val(),
                    postcode: $("#postcode").val(),
                    city: $("#city").val(),
                    state: $("#state").val(),
                    numberOfEmployees: $("#numberOfEmployees").val(),
                    industry: $("#industry").val(),
                    state: $("#state").val(),
                    aboutUs: $('#aboutUs').summernote('code'),
                    logo: $('#logo').val().split('\\').pop() =="" ? "" : $('#logo').val().split('\\').pop(),
                    backgroundPicture: $('#backgroundPicture').val().split('\\').pop() =="" ? "" : $('#backgroundPicture').val().split('\\').pop(),
                    officePictures: officePicturesArr,
                    websiteUrl: $("#websiteUrl").val(),
                    facebookUrl: $("#facebookUrl").val(),
                    linkedinUrl: $("#linkedinUrl").val(),
                    whatsappUrl: $("#whatsappUrl").val(),
                    status: $("#status").val(),
                    dateJoined: $("#dateJoined").val()
                }, success: function (response) {
                    const data = response;
                    uploadFiles();
                    if (data.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record successfully updated! ',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href="company_profile.php";
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please contact technical staff! ',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }
        
        function uploadFiles() {
            var i=0;
            var form_data = new FormData();   
            var file_data1 = $('#logo').prop('files')[0];   
            var file_data2 = $('#backgroundPicture').prop('files')[0];   
            
            if(file_data1){
                form_data.append('file'+i, file_data1);
                i++;
            }
            if(file_data2){
                form_data.append('file'+i, file_data2);
                i++;
            }

            var officePictures = $('#officePictures').prop('files');
            if(officePictures.length>0){
                for (j=0; j < officePictures.length; j++) {
                    form_data.append('file' + (i++), officePictures[j]);
                }   
            }

            $.ajax({
                url: "company_profile_filesUpload.php", // <-- point to server-side PHP script 
                dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                    
                type: 'post',
                success: function(php_script_response){
                }
            });
        };

        function removeImage(e) {
            var cSelect = $(e).data("name");
            document.getElementById(cSelect).value = "1";
            $(e).parent().hide();
        }

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
    </script>
</html>

<?php
