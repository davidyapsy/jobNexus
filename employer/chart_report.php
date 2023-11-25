<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $subscriptionID = base64_decode($_GET['id']);

    //employerID
    $sql = "SELECT A.saleID, B.companyName, B.addressLineOne, B.addressLineTwo, B.addressLineThree, B.postcode, B.city, B.state, B.phoneNumber, C.planName, C.price, 
            C.validityPeriod, C.maxJobPosting, C.maxJobApplication, C.applicationRankingAvailability, C.maxFeatureJobListing, A.startDate, A.endDate
            FROM subscription A
            JOIN employer B ON A.employerID = B.employerID
            JOIN subscription_plan C ON A.subscriptionPlanID = C.subscriptionPlanID
            WHERE subscriptionID = '$subscriptionID'";
    $result = $connection->query($sql);
    $data =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $data = $row;
    }
?>
<html>
    <head>
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

        <style>
            
        </style>
    </head>
    <body>
    <div class="main">
            <div class="panel panel-bordered p-2">
                <div class="panel-heading p-2">
                    <div class="data">
                        <div class="col-12">
                            <h3><b>Invoice Info</b><br> <?=$data['saleID']?></h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded" id="printable">
                    <div class="row">
                        <div class="table-responsive col-md-6">
                            <table class="table text-start table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Authorized by:  <b>Job Nexus</b></td>
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
                            <table class="table text-start table-bordered">
                                <tbody>
                                    <tr>
                                        <td>To: <b><?=$data['companyName']?></b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?=$data['addressLineOne']==""?"":$data['addressLineOne'].", <br>"?>
                                            <?=$data['addressLineTwo']==""?"":$data['addressLineTwo'].", <br>"?>
                                            <?=$data['addressLineThree']==""?"":$data['addressLineThree'].", <br>"?>
                                            <?=$data['postcode']?>  <?=$data['city']?><br>
                                            <?=$data['state']?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Phone : +60<?=$data['phoneNumber']?>
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
</html>
