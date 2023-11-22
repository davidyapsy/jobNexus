<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $subscriptionPlanID = base64_decode($_GET['id']);

    //employerID
    $sql = "SELECT *
            FROM subscription_plan
            WHERE subscriptionPlanID = '$subscriptionPlanID'";

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
                    <div class="data">
                        <div class="col-12">
                            <h3>Subscription / Order Summary</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <form id="form_details" action="" method="post">
                        <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Subscription Details</h4>
                        <hr>
                        <input type="hidden" class="form-control" name="subscriptionPlanID" id="subscriptionPlanID" value="<?=base64_encode($subscriptionPlanID)?>"/>
                        <input type="hidden" class="form-control" name="endDate" id="endDate"  min="<?= date('Y-m-d'); ?>"/>
                        <div class="form-group row">
                            <label for="startDate" class="col-sm-3 col-form-label">Start Date: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="startDate" id="startDate" min="<?= date('Y-m-d'); ?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="autoRenewal" class="col-sm-3 col-form-label">Auto Renewal: </label>
                            <div class="col-sm-9">
                                <div class="form-control form-check form-switch border-0">
                                    <input class="form-check-input" type="checkbox" id="chkAutoRenewal" name="chkAutoRenewal" value="">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </form>

                    <hr class="pb-3">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Package Name</th>
                                <th scope="col">Package Price (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <b><?=$data['planName']?></b></br>
                                    <u>Package Details</u>
                                    <ul>
                                        <li>Flexible to post, report & edit <?= $data['maxJobPosting']?> jobs for <?= $data['validityPeriod']?></li>
                                        <li>Flexible to manage <?= $data['maxJobApplication']?> applications for each job</li>
                                        <?php if($data['applicationRankingAvailability']==1){ ?>
                                            <li>Job application ranking availability</li>
                                        <?php } ?>
                                        <?php if($data['maxFeatureJobListing']>=1){ ?>
                                            <li>Total <?=$data['maxFeatureJobListing']?> modifiable feature job listing</li>
                                        <?php } ?>
                                        <li id="validDateRange">Valid From dd/mm/yyyy To dd/mm/yyyy.</li>
                                    </ul>
                                </td>
                                <td class="align-middle text-center">
                                    <?=number_format($data['price'])?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-end">Subtotal: </td>
                                <td class="align-middle text-center"><?=number_format($data['price'])?></td>
                            </tr>
                            <tr>
                                <td class="text-end">SST: </td>
                                <td class="align-middle text-center"><?=number_format($data['price']*0.1)?></td>
                            </tr>
                            <tr>
                                <td class="text-end"><b>Grant Total: </b></td>
                                <td class="align-middle text-center"><?=number_format($data['price']*1.1)?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" onclick ="submitConfirmation()" class="btn btn-primary float-end">Make Payment</button>
                        </div>
                    </div>
                </div>
            </div>
            <form class="paypal" action="subscription_payment.php" method="post" id="paypal_form">
                <input type="hidden" name="cmd" value="_xclick" />
            </form>
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
        
        $('#startDate').change(function() {
            if($(this).val()){
                var oriStartDate = new Date($(this).val());
                var startDate = new Date($(this).val());
                var oriEndDate = new Date(startDate.setFullYear(startDate.getFullYear() + 1));

                var formattedStartDate = convertDateFormat(oriStartDate);
                var formattedEndDate = convertDateFormat(oriEndDate);

                $("#validDateRange").text('Valid From '+formattedStartDate+' To '+formattedEndDate);
                var endDate = formattedEndDate.split("/").reverse().join("-");
                $("#endDate").val(endDate);
            }else{
                $("#validDateRange").text('Valid From dd/mm/yyyy To dd/mm/yyyy.');
            }
        });

        function convertDateFormat(inputDate){
            var date = inputDate.getDate();
            var month = inputDate.getMonth()+1;
            var year = inputDate.getFullYear();
            outputDate = date+"/"+month+"/"+year;
            return outputDate;
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
                    window.location.href = "subscription_plan.php"
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
                    startDate: $("#startDate").val()
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
                    console.log(xhr.status);
                }
            })
        }

        function makePayment() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "make_payment",
                    subscriptionPlanID: $("#subscriptionPlanID").val(),
                    totalAmount: <?=$data['price']*1.1?>,
                    autoRenewal: ($("#chkAutoRenewal").is(':checked') ? 1 : 0)
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
                                window.location.href = "subscription_sales_invoice.php?id="+encodeURI(btoa(data.subscriptionID));
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

        function createRecord() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "create",
                    subscriptionPlanID: $("#subscriptionPlanID").val(),
                    startDate : $("#startDate").val(),
                    endDate: $("#endDate").val(),
                    subtotalAmount: <?=$data['price']?>,
                    sstAmount: <?=$data['price']*0.1?>,
                    totalAmount: <?=$data['price']*1.1?>,
                    autoRenewal: ($("#chkAutoRenewal").is(':checked') ? 1 : 0)
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
                                window.location.href = "subscription_sales_invoice.php?id="+encodeURI(btoa(data.subscriptionID));
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