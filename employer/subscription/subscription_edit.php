<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $subscriptionID = base64_decode($_GET['id']);

    //employerID
    $sql = "SELECT *
            FROM subscription A
            JOIN subscription_plan B ON A.subscriptionPlanID = B.subscriptionPlanID 
            WHERE subscriptionID = '$subscriptionID'";

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
                            <h3>Subscription</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Subscription Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post" >
                        <input type="hidden" id="subscriptionID" name="subscriptionID" value=" <?= base64_encode($subscriptionID);?>">
                        <div class="form-group row">
                            <label for="subscriptionPlan" class="col-sm-3 col-form-label">Subscription Plan Name: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="subscriptionPlan" name="subscriptionPlan" disabled>
                                    <option value=""> -- Please select a job category. -- </option>
                                    <?php $subscriptionPlan_sql = "SELECT subscriptionPlanID, planName
                                                                FROM subscription_plan 
                                                                WHERE isActive = 1";
                                        $subscriptionPlan_result = $connection->query($subscriptionPlan_sql);
                                        while (($row = $subscriptionPlan_result->fetch_assoc()) == TRUE) { ?>
                                                    <option value="<?= base64_encode($row['subscriptionPlanID']); ?>"><?= $row['planName'] ?></option>
                                        <?php } ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Plan Description: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" disabled><?= $data['description']?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Price: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="price" id="price" value="<?=$data['price']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="validityPeriod" class="col-sm-3 col-form-label">Validity Period: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="validityPeriod" id="validityPeriod" value="<?=$data['validityPeriod']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="maxJobPosting" class="col-sm-3 col-form-label">Maximum Job Posting: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="maxJobPosting" id="maxJobPosting" value="<?=$data['maxJobPosting']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="maxJobApplication" class="col-sm-3 col-form-label">Maximum Job Application: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="maxJobApplication" id="maxJobApplication" value="<?= $data['maxJobApplication']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="applicationRankingAvailability" class="col-sm-3 col-form-label">Application Ranking Availability: </label>
                            <div class="col-sm-9">
                                <div class="form-control form-check form-switch border-0">
                                    <input class="form-check-input" type="checkbox" id="chkApplicationRankingAvailability" name="chkApplicationRankingAvailability"
                                    value="<?=$data['applicationRankingAvailability']==1?"checked":""?>" disabled>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="maxFeatureJobListing" class="col-sm-3 col-form-label">Maximum Feature Job Listing: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="maxFeatureJobListing" id="maxFeatureJobListing" value="<?= $data['maxFeatureJobListing']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="startDate" class="col-sm-3 col-form-label">Start Date: </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="startDate" id="startDate" value="<?= $data['startDate']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endDate" class="col-sm-3 col-form-label">End Date: </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="endDate" id="endDate" value="<?= $data['endDate']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="autoRenewal" class="col-sm-3 col-form-label">Auto Renewal: </label>
                            <div class="col-sm-9">
                                <div class="form-control form-check form-switch border-0">
                                    <input class="form-check-input" type="checkbox" id="chkAutoRenewal" name="chkAutoRenewal" <?=$data['autoRenewal']==1?"checked":""?>>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <hr>
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
        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

    </body>

    <script>
        let url = "subscription_controller.php";

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
                    window.location.href = "subscription_index.php"
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
                    updateRecord();
                }
            });
        }

        function updateRecord() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "update",
                    subscriptionID: $("#subscriptionID").val(),
                    autoRenewal: ($("#chkAutoRenewal").is(':checked') ? 1 : 0)
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record successfully updated! ',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "subscription_index.php"
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

    </script>
</html>