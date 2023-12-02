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
                        .showPwd .round {
                position: relative;
            }
            .showPwd .round label {
              background-color: #fff;
              border: 1px solid #ccc;
              border-radius: 50%;
              cursor: pointer;
              height: 25px;
              width: 25px;
              display: block;
            }
            .showPwd .round label:after {
              border: 2px solid #fff;
              border-top: none;
              border-right: none;
              content: "";
              height: 5px;
              left: 6.5px;
              opacity: 0;
              position: absolute;
              top: 9px;
              transform: rotate(-45deg);
              width: 12px;
            }
            .showPwd .round input[type="checkbox"] {
              visibility: hidden;
              display: none;
              opacity: 0;
            }
            .showPwd .round input[type="checkbox"]:checked + label {
              background-color: #BABBDE;
              border-color: #BABBDE;
            }
            .showPwd .round input[type="checkbox"]:checked + label:after {
              opacity: 1;
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
                <div class="col-lg-8 mt-4">
                    <div class="card text-black" style="border-radius: 30px;">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 order-2 order-lg-1">

                                    <p class="text-center h2 fw-bold mb-1">Register</p>
                                    <p class="text-center">Please enter your information</p>

                                    <form class="mx-md-1" action="..\registerFunctions.php" method="post">
                                        <label class="h5 fw-bold">Set Your Password</label><br>
                                        <small>Your password Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.</small>
                                        <div class="d-flex flex-row align-items-center mb-4 mt-2">
                                            <div class="profileDisplay flex-fill">
                                                <input type="password" id="pwd" class="form-control" name="pwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                                <label>Password*</label>
                                            </div>
                                             </div>
                                            
                                            <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="profileDisplay flex-fill">
                                                <input type="password" id="rpwd" class="form-control" name="rpwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Please repeat your password. Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                                <label>Repeat your password*</label>
                                            </div>
                                        </div>  
                                        
                                        <div class="showPwd d-flex flex-row">
                                          <div class="round d-flex">
                                            <input type="checkbox" id="showPwd" onchange="showPassword()"/>
                                            <label for="showPwd"></label>
                                            <small class='m-1'>Show Password</small>
                                          </div>
                                        </div>

                                        <script>
                                            function showPassword() {
                                                var pwdField = document.getElementById("pwd");
                                                var rpwdField = document.getElementById("rpwd");
                                                var showPwdCheckbox = document.getElementById("showPwd");

                                                if (showPwdCheckbox.checked) {
                                                    pwdField.type = "text";
                                                    rpwdField.type = "text";
                                                } else {
                                                    pwdField.type = "password";
                                                    rpwdField.type = "password";
                                                }
                                            }
                                        </script>

                                        <div class="d-flex justify-content-center">
                                            <input type="submit" name="create" class="submit btn col-4" value="Register">
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
        // put your code here
        ?>
    </body>
</html>
