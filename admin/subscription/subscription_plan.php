<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    //employerID
    $sql = "SELECT *
            FROM subscription_plan
            WHERE isActive=1";

    $result = $connection->query($sql);

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
            .border-purple{
                border: solid 3px #D1BAFF;
            }
            .panel-body{
                height: 80%;
            }
            .bi-check-circle-fill{
                color: #D1BAFF;
            }
            table{
                font-size:20px;
            }

        </style>
    </head>

    <body>
        <?php require('../../admin/topBar.php') ?>
        <?php require('../../admin/sideNav.php') ?>

        <div class="main">
            <div class="panel panel-bordered p-2">
                <div class="panel-heading pt-2">
                    <div class="row">
                        <div class="col-12">
                            <h3>Subscription Plan</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row g-4 h-100">
                        <?php while(($row = $result->fetch_assoc())==TRUE){ ?>
                            <div class="col-4">
                                <div class="subscriptionPlanBox p-2 h-100 rounded bg-white text-center" onclick="location.href='subscription_order_summary.php?id=<?=base64_encode($row['subscriptionPlanID'])?>';">        
                                    <label class="p-1"><?= $row['planName']?></label><br/>
                                    <h2 class="pb-2">RM <?= number_format($row['price'])?></h2>
                                    <label class="p-1"></i><?= $row['description']?></label><br/><br/>
                                    <table class="table table-borderless w-100 text-center align-middle">
                                        <tbody>
                                            <tr>
                                                <td><i class="bi bi-check-circle-fill"></td>
                                                <td>Flexible to post, report & edit <?= $row['maxJobPosting']?> jobs for <?= $row['validityPeriod']?></td>
                                            </tr>
                                            <tr>
                                                <td><i class="bi bi-check-circle-fill"></td>
                                                <td>Flexible to manage <?= $row['maxJobApplication']?> applications for each job</td>
                                            </tr>
                                            <?php if($row['applicationRankingAvailability']==1){ ?>
                                                <tr>
                                                    <td><i class="bi bi-check-circle-fill"></td>
                                                    <td>Job application ranking availability</td>
                                                </tr>
                                            <?php } ?>
                                            <?php if($row['maxFeatureJobListing']>=1){ ?>
                                                <tr>
                                                    <td><i class="bi bi-check-circle-fill"></td>
                                                    <td>Total <?=$row['maxFeatureJobListing']?> modifiable feature job listing</td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>

        </div>
        <?php require('../../admin/footer.php') ?>

    </body>

    <script>
        $(".subscriptionPlanBox").hover(function(){
            $(this).addClass("border-purple");
            $(this).css('cursor', 'pointer');
        }, function(){
            $(this).removeClass("border-purple");
            $(this).css('cursor', 'auto');
        });
    </script>
</html>