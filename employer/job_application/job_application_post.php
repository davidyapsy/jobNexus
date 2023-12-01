<?php
    session_start();
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";
    $employerID = base64_decode($_SESSION['employerID']);

    $connection = new mysqli($serverName, $userName, $password, $database);

    //employerID
    $sql = "SELECT A.jobPostingID, A.jobTitle, B.categoryName, A.employmentType, A.locationState, A.isPublish
            FROM job_posting A
            JOIN job_category B ON A.jobCategoryID = B.jobCategoryID
            WHERE A.employerID = '$employerID' AND A.isDeleted = 0
            GROUP BY A.jobPostingID, A.jobTitle, B.categoryName, A.employmentType, A.locationState, A.isPublish";

    $result = $connection->query($sql);
    if($result->num_rows >0){
?>
<!DOCTYPE html>
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
    
        <link href="../../employer/assets/css/content.css" type="text/css" rel="stylesheet">
        <style>
            .required{
                color:red;
            }
        </style>
    </head>

    <body>
        <?php require('../../employer/topBar.php') ?>
        <?php require('../../employer/sideNav.php') ?>

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
                                    <table class="table table-borderless">
                                        <thead class="text-start">
                                            <tr>
                                                <th><h2><?= $row['jobTitle']?></h2></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-start">
                                            <tr>
                                                <td><b>Job Category: </b><?= $row['categoryName']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Employment Type: </b><?= $row['employmentType']?></td>
                                            </tr>
                                            <tr>
                                                <td><b>State: </b><?= $row['locationState']?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="text-end">
                                            <tr>
                                                <td><h4 class="<?= $row['isPublish']=="Published"?"text-success":"text-secondary"?>"><?= $row['isPublish']?></h4></td>
                                            </tr>
                                        </tfoot>
                                    </table>    
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        
    </body>

    <script>
        $(".jobPostingBox").hover(function(){
            $(this).removeClass("shadow");
            $(this).css('cursor', 'pointer');
        }, function(){
            $(this).addClass("shadow");
            $(this).css('cursor', 'auto');
        });
        

    </script>
</html>

<?php } else { ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Job Nexus Employers</title>
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
        <link href="../../employer/assets/css/content.css" type="text/css" rel="stylesheet">

        <style>
            .panel h1{
                right: 50%;
                bottom: 50%;
                transform: translate(50%,50%);
                position: absolute;
                font-size:70px;
            }
            
        </style>
    </head>

    <body>
        <?php require('../../employer/topBar.php') ?>
        <?php require('../../employer/sideNav.php') ?>

        <div class="main h-100">
            <div class="panel p-2">
                <h1>
                    <p>No job post found</p>                    
                </h1>
            </div>
            
        </div>
        <?php include('../../employer/footer.php') ?>


    </body>
</html>
<?php } ?>