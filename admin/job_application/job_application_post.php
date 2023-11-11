<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    //employerID
    $sql = "SELECT B.jobPostingID, B.jobTitle, C.categoryName, B.employmentType, B.locationState, B.isPublish
            FROM job_application A
            JOIN job_posting B ON A.jobPostingID = B.jobPostingID
            JOIN job_category C ON B.jobCategoryID = C.jobCategoryID
            WHERE B.employerID = 'E2300000' AND B.isDeleted = 0";

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
                            <h3>Job Application</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row g-3">
                        <?php while(($row = $result->fetch_assoc())==TRUE){ ?>
                            <div class="col-4" >
                                <div class="jobPostingBox p-2 border bg-light rounded shadow" onclick="location.href='job_application_index.php?id=<?=base64_encode($row['jobPostingID'])?>';">
                                    <h2 class="pb-2"><?= $row['jobTitle']?></h2>
                                    <label class="p-1"><b>Job Category: </b><?= $row['categoryName']?></label><br/>
                                    <label class="p-1"><b>Employment Type: </b><?= $row['employmentType']?></label><br/>
                                    <label class="p-1"><b>State: </b><?= $row['locationState']?></label><br/>
                                    <h4 class="px-2 pt-2 text-end text-success"><?= $row['isPublish']?></h4>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <div class="col-4">
                            <div class="p-2 border bg-light">Custom column padding</div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 border bg-light">Custom column padding</div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 border bg-light">Custom column padding</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>

    <script>
        $(".jobPostingBox").hover(function(){
            $(".jobPostingBox").removeClass("shadow");
            $('.jobPostingBox').css('cursor', 'pointer');
        }, function(){
            $(".jobPostingBox").addClass("shadow");
            $('.jobPostingBox').css('cursor', 'auto');
        });
        

    </script>
</html>