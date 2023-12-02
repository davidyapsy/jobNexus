<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $employerID = base64_decode($_GET['id']);

    //employerID
    $sql = "SELECT companyName
            FROM employer 
            WHERE employerID = '$employerID'";

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

    </head>
    <body>
        <!-- Top Bar -->
        <nav class="navbar navbar-expand-sm bg-white navbar-white fixed-top w-100 shadow-sm">
            <div class="container-fluid w-100">
                <a class="navbar-brand pt-2 px-3" style="color: black;" href="/jobnexus/employer/login.php"><h3>Job Nexus</h3></a>
                <a href="/jobnexus/employer/login.php" class="btn btn-primary"><i class="bi bi-box-arrow-in-right text-white"> Login</i></a>
            </div>
        </nav>
        <!--End Top Bar-->

        <div class="container position-absolute top-50 start-50 translate-middle w-50 text-center">
            <div class="p-3 border bg-white rounded">
                <div class="row pb-2 text-center">
                    <div class="w-100">
                        <img class="rounded" width="70" height="70" src="/jobnexus/employer/assets/pictures/logo.jpg" alt="">
                    </div>
                </div>
                <div class="row">
                    <h1>Welcome to JobNexus, <?=$data['companyName']?></h1>
                </div>
                <div class="row">
                    <p>Please submit your company's Borang 9 / Borang 13 with contact person's name <br>
                    and phone number through any method below to finish your registration.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="mailto:jobnexus2@gmail.com" class="btn btn-primary w-100"><i class="bi bi-envelope text-white"> Email Us</i></a>
                    </div>
                    <div class="col-sm-6">
                        <a href="https://wa.me/0162462609" class="btn btn-primary w-100"><i class="bi bi-whatsapp text-white"> Whatsapp</i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-absolute bottom-0 start-50 translate-middle-x text-center pb-5">
            <p>WEBSITE BY JobNexus</p>
            <p class="pb-2">© 2023. ALL RIGHT RESERVED.</p>
            <p>
                <h4>
                    <a href="https://www.instagram.com/tarumt.official/" target="_blank"><i class="bi bi-instagram px-3"></a></i> 
                    <a href="https://www.facebook.com/tarumtkl" target="_blank"><i class="bi bi-facebook px-3"></a></i> 
                    <a href="https://wa.me/0162462609" target="_blank"><i class="bi bi-whatsapp px-3"></a></i>
                </h4>
            </p>
        </div>
        <div class="position-absolute bottom-0 end-0 bg-white w-100" style="height:4%;">
            <p class="px-2">© 2023 Copyright
                <span class="float-end px-2"><a href="https://tarc.edu.my/">Need help?</a></span>
            </p>
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