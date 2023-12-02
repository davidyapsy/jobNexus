<?php
$receivedData = isset($_GET['data']) ? $_GET['data'] : false;
$errorMsg = isset($_GET['errorMsg']) ? $_GET['errorMsg'] : "";
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <title>Job Nexus | Register</title>
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

            // Reset the data parameter in the URL when the page is loaded
            $(document).ready(function() {
                var url = new URL(window.location.href);
                url.searchParams.delete('data');
                var newUrl = url.toString();
                history.replaceState({}, '', newUrl);

                // Trigger the alert if data was received
                <?php if($receivedData): ?>
                    showAlert('<?php echo $errorMsg; ?>');
                <?php endif; ?>
            });
        </script>
        
        <div class="topnav">
            <a href="..\index.php"><h5>Job Nexus</h5></a>
        </div>
        
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 mt-2">
                    <div class="card text-black" style="border-radius: 30px;">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 order-2 order-lg-1">

                                    <p class="text-center h2 fw-bold mb-1">Register</p>
                                    <p class="text-center mb-1">Welcome to Job Nexus! Please enter your information to create an account.</p>

                                    <form class="mx-md-1" action="..\registerFunctions.php" method="post">
                                        <label class="h5 fw-bold">Personal Information</label>
                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <div class="profileDisplay flex-fill">
                                                <input type="text" id="efname" class="form-control" name="fname" required title="Please enter your first name">
                                                <label>First Name*</label>
                                            </div>
                                            
                                            <div class="profileDisplay flex-fill m-1">
                                                <input type="text" id="lname" class="form-control" name="lname" required title="Please enter your last name">
                                                <label>Last Name*</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <div class="profileDisplay flex-fill">
                                                <input type="email" id="email" class="form-control" name="email" required title="Please enter your email">
                                                <label>Email*</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <div class="profileDisplay flex-fill">
                                                <input type="text" id="address" class="form-control" name="address" required title="Please enter your address">
                                                <label>Address*</label>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <div class="profileDisplay flex-fill">
                                                <input type="text" id="phoneNo" class="form-control" name="phoneNo" placeholder="01x-xxxxxxx" maxlength="11" pattern="01[0-9]{1}-[0-9]{7}" required title="Please enter your phone number(01x-xxxxxxx)">
                                                <label>Phone Number* <small style="color: grey"> Format: 01x-xxxxxxx</small></label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <input type="submit" name="next" class="submit btn col-4" value="Next">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        
        ?>
    </body>
</html>
