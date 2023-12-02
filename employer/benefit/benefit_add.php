<?php
    session_start();
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
        <!-- Summernote CSS -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <!-- Bootstrap multi-select CSS  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"/>
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
                            <h3>Benefit</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Benefit Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post">
                        <div class="form-group row">
                            <label for="benefitTitle" class="col-sm-3 col-form-label">Benefit Title: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="benefitTitle" id="benefitTitle"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="benefitDescription" class="col-sm-3 col-form-label">Benefit Description: </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="benefitDescription" id="benefitDescription" rows="4" placeholder="Max 200 characters" maxlength="200"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="col-sm-3 col-form-label">Icon:</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="icon" name="icon">
                                    <option value=""> -- Please select an icon. -- </option>
                                    <option value="bi-heart-pulse"> Health </option>
                                    <option value="bi-wifi">Internet<i class="bi bi-wifi"></i></option>
                                    <option value="bi-suitcase2">Travel<i class="bi bi-suitcase2"></i></option>
                                    <option value="bi-house-door">House<i class="bi bi-house-door"></i></option>
                                    <option value="bi-p-circle">Circle<i class="bi bi-p-circle"></i></option>
                                    <option value="bi-car-front">Car<i class="bi bi-car-front"></i></option>
                                    <option value="bi-people">People<i class="bi bi-people"></i></option>
                                    <option value="bi-diagram-2">Diagram<i class="bi bi-diagram-2"></i></option>
                                    <option value="bi-hospital">Hospital<i class="bi bi-hospital"></i></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div> 
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick ="submitConfirmation()" class="btn btn-primary" style="float:right;">Submit</button>
                                <button type="button" onclick="backConfirmation()" class="btn btn-danger btn-outline">Back</button>
                                <button type="reset" id="btnReset" class="btn btn-light btn-outline">Reset</button>
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
        <!-- Multi-Select -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </body>

    <script>
        let url = "benefit_controller.php";

        window.addEventListener("keypress", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                submitConfirmation();
            }
        });

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
                    window.location.href = "benefit_index.php"
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
                    benefitTitle : $("#benefitTitle").val()
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
                        createRecord();
                    }
                }, failure: function (xhr) {
                    console.log(xhr.icon);
                }
            })
        }

        function createRecord() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "create",
                    benefitTitle : $("#benefitTitle").val(),
                    benefitDescription: $("#benefitDescription").val(),
                    icon: $("#icon").val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record successfully created! ',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#btnReset").trigger("click"); 
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
                    console.log(xhr.icon);
                }
            })
        }

    </script>
</html>