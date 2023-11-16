<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $subscriptionID = base64_decode($_GET['id']);

    //employerID
    $sql = "SELECT A.saleID, B.companyName, B.address, B.phoneNumber, C.planName, C.price, C.validityPeriod, C.maxJobPosting, C.maxJobApplication, C.applicationRankingAvailability, C.maxFeatureJobListing, A.startDate, A.endDate
            FROM subscription A
            JOIN employer B ON A.employerID = B.employerID
            JOIN subscription_plan C ON A.subscriptionPlanID = C.subscriptionPlanID
            WHERE subscriptionID = '$subscriptionID'";
    
    $result = $connection->query($sql);
    $data =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $data = $row;
    }
    $data['startDate']
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
                            <h3>Subscription / Sales Invoice</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <div class="row">
                        <div class="table-responsive col-md-6">
                            <table class="table text-start table-borderless">
                                <tbody>
                                    <tr>
                                        <td>1.png  <b>Job Nexus</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            4, JALAN DA 1/1, <br>
                                            TAMAN DANAU ATAS,<br>
                                            63100 BATU PAQI, <br>
                                            SELANGOR <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            E-mail: example@company.com <br>
                                            Phone : 123-4560000
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive col-md-6">
                            <table class="table text-end table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>Invoice Info</b> <br>
                                            <?=$data['saleID']?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>To:</b> <br>
                                            <?=$data['companyName']?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?=$data['address']?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Phone : <?=$data['phoneNumber']?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

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
                                        <li id="validDateRange">Valid From <?=date('d/m/Y', strtotime($data['startDate']))?> To <?=date('d/m/Y', strtotime($data['endDate']))?></li>
                                    </ul>
                                </td>
                                <td class="align-middle text-center">
                                    <?=number_format($data['price'])?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-end">Subtotal</td>
                                <td class="align-middle text-center"><?=number_format($data['price'])?></td>
                            </tr>
                            <tr>
                                <td class="text-end">SST</td>
                                <td class="align-middle text-center"><?=number_format($data['price']*0.1)?></td>
                            </tr>
                            <tr>
                                <td class="text-end"><b>Grant Total</b></td>
                                <td class="align-middle text-center"><?=number_format($data['price']*1.1)?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" onclick ="submitConfirmation()" class="btn btn-primary w-100">Print</button>
                        </div>
                    </div>
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
        
        $('#startDate').change(function() {
            if($(this).val()){
                var oriStartDate = new Date($(this).val());
                var startDate = new Date($(this).val());
                var oriEndDate = new Date(startDate.setFullYear(startDate.getFullYear() + 1));

                var formattedStartDate = convertDateFormat(oriStartDate);
                var formattedEndDate = convertDateFormat(oriEndDate);
                $("#validDateRange").text('Valid From '+formattedStartDate+' To '+formattedEndDate);
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
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }

    </script>
</html>