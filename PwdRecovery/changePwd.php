<?php
$receivedData = isset($_GET['data']) ? $_GET['data'] : false;
$errorMsg = isset($_GET['errorMsg']) ? $_GET['errorMsg'] : "";

//for tmp Code 
$valid = isset($_GET['valid']) ? $_GET['valid'] : false;
$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <title>Job Nexus | Change Password</title>
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
            
            function successPwd(msg){
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
                url.searchParams.delete('valid');
                var newUrl = url.toString();
                history.replaceState({}, '', newUrl);

            // Trigger the alert if data was received
            <?php if($receivedData): ?>
                showAlert('<?php echo $errorMsg; ?>');
            <?php endif; ?>
             
             //temp code correct and proceed to change pwd
            <?php if($valid): ?>
            successPwd('<?php echo $msg; ?>');
            <?php endif; ?>
            
            });
        </script>
        
        <div class="topnav">
            <a href="..\index.php"><h5>Job Nexus</h5></a>
        </div>
        
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-7 p-5">
                    <div class="row rounded-4 bg-white justify-content-center align-items-center">
                        <div class="text-center mt-3">
                            <p class="h1 fw-bold mb-3 mx-1 mx-md-4">Change Password</p>
                        </div>
                        
                        <p class="text-center">Please reset your password and login again.</p>
                        <form class="mx-1 mx-md-4" action="..\changePwdFunctions.php" method="post">
                                        
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="profileDisplay flex-fill">
                                    <input type="password" id="pwd" class="form-control" name="pwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                    <label>Password</label>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="profileDisplay flex-fill">
                                    <input type="password" id="rpwd" class="form-control" name="rpwd" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                    <label>Repeat your password</label>
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

                            <div class="d-flex flex-row justify-content-center mx-4 mb-3 mb-lg-4">
                                <input type="submit" name="change" class="submit btn" value="Change Password">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
