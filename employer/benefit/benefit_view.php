<?php
    session_start();
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";
    $employerID = base64_decode($_SESSION['employerID']);
    $benefitID = base64_decode($_GET['id']);

    $connection = new mysqli($serverName, $userName, $password, $database);
    $sql = "SELECT *
            FROM benefit 
            WHERE employerID = '$employerID' AND benefitID = '$benefitID'";

    $result = $connection->query($sql);
    $data =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $data = $row;
    }
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
                        <input type="hidden" class="form-control" name="benefitID" id="benefitID" value="<?=base64_encode($data['benefitID'])?>"/>
                        <div class="form-group row">
                            <label for="benefitTitle" class="col-sm-3 col-form-label">Benefit Title: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="benefitTitle" id="benefitTitle" value="<?=$data['benefitTitle']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="benefitDescription" class="col-sm-3 col-form-label">Benefit Description: </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="benefitDescription" id="benefitDescription" rows="4" placeholder="Max 200 characters" maxlength="200" disabled><?=$data['benefitDescription']?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="col-sm-3 col-form-label">Icon:</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="icon" name="icon" disabled>
                                    <option value=""> -- Please select an icon. -- </option>
                                    <option value="bi-heart-pulse" <?=$data['icon']=='bi-heart-pulse'?"selected":""?>> Health </option>
                                    <option value="bi-wifi" <?=$data['icon']=='bi-wifi'?"selected":""?>>Internet<i class="bi bi-wifi"></i></option>
                                    <option value="bi-suitcase2" <?=$data['icon']=='bi-suitcase2'?"selected":""?>>Travel<i class="bi bi-suitcase2"></i></option>
                                    <option value="bi-house-door" <?=$data['icon']=='bi-house-door'?"selected":""?>>House<i class="bi bi-house-door"></i></option>
                                    <option value="bi-p-circle" <?=$data['icon']=='bi-p-circle'?"selected":""?>>Circle<i class="bi bi-p-circle"></i></option>
                                    <option value="bi-car-front" <?=$data['icon']=='bi-car-front'?"selected":""?>>Car<i class="bi bi-car-front"></i></option>
                                    <option value="bi-people" <?=$data['icon']=='bi-people'?"selected":""?>>People<i class="bi bi-people"></i></option>
                                    <option value="bi-diagram-2" <?=$data['icon']=='bi-diagram-2'?"selected":""?>>Diagram<i class="bi bi-diagram-2"></i></option>
                                    <option value="bi-hospital" <?=$data['icon']=='bi-hospital'?"selected":""?>>Hospital<i class="bi bi-hospital"></i></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div> 
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-12">
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
        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
        <!-- Multi-Select -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </body>

    <script>        
        function backConfirmation(){
            window.location.href = "benefit_index.php";
        }

    </script>
</html>