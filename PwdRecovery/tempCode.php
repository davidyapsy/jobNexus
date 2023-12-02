<?php
$receivedData = isset($_GET['data']) ? $_GET['data'] : false;
$errorMsg = isset($_GET['errorMsg']) ? $_GET['errorMsg'] : "";

//for temp code sent
$tempCode = isset($_GET['tempCode']) ? $_GET['tempCode'] : false;
$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <title>Job Nexus | Temporary Pass Code</title>
        <link rel="icon" type="image/x-icon" href="..\Pic/JobNexus_Logo.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
        <link href="https://cdn.jsdelivr.net/npm/sweetalert@11.1.9/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <style>
            .topnav{
                background-color: white;
                overflow: hidden;
            }
            .topnav a {
                float: left;
                color: black;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }
            .topnav a:hover {
               color: #BABBDE;
            }
            .btn{
                background-color: #BABBDE;
            }
            .btn:hover{
                background-color: #b0b1d1;
            }
        </style>
    </head>
    
    <body style="background-color:#dfe2e6;">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
        <script type="text/javascript">
            function showAlert(message) {
                Swal.fire({
                    title: "Error!",
                    text: message,
                    icon: "error"
                });
            }
            
            function success(msg){
                Swal.fire({
                      title: "Yay!",
                      text: msg,
                      icon: "success"
                });
            }

            // Reset the data parameter in the URL when the page is loaded
            $(document).ready(function() {
                var url = new URL(window.location.href);
                url.searchParams.delete('data');
                url.searchParams.delete('tempCode');
                var newUrl = url.toString();
                history.replaceState({}, '', newUrl);

            // Trigger the alert if data was received
            <?php if($receivedData): ?>
                showAlert('<?php echo $errorMsg; ?>');
            <?php endif; ?>
                    
            // Trigger the alert if temp code was sent 
            <?php if($tempCode): ?>
                success('<?php echo $msg; ?>');
            <?php endif; ?>
            });
        </script>
    
        <div class="topnav">
            <a href="..\index.php"><h5>Job Nexus</h5></a>
        </div>
        
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-12 col-xl-9">
                    <div class="card text-black mt-3" style="border-radius: 30px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-8 col-xl-7 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-3 mt-3">Password Recovery</p>
                                    <p>Please enter the pass code received in your email to verify it's you.</p>

                                    <form action="..\pwdRecoveryFunctions.php" method="post">

                                        <div class="d-flex flex-row align-items-center mb-5">
                                            <div class="profileDisplay flex-fill mb-0">
                                                <input type="text" id="code" class="form-control" name="code" required title="Please enter the pass code you received">
                                                <label>Pass code</label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" name="submitCode" class="submit btn" value="Submit Code">
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-6 col-lg-5 col-xl-5 d-flex align-items-center order-1 order-lg-2">
                                    <img src="..\Pic/pwdRecovery.jpg" class="img-fluid rounded-4" alt="Illustration">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
