<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve jobPostingID from jobDetails.php
    $jobPostingID = $_POST['jobPostingID'];
}

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
        <title>Job Nexus | Apply Job</title>
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
            .topnavright{
                float: right ; 
            }
            .btn{
                background-color: #BABBDE;
            }
            .btn:hover{
                background-color: #b0b1d1;
            }
             @keyframes fadeInUp {
            0% {
                    transform: translateY(100%);
                    opacity: 0;
                }
            100% {
                    transform: translateY(0%);
                    opacity: 1;
                }
            }
            .fadeIn {
                animation: 0.7s fadeInUp;
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
            <a class="active" href="..\index.php"><h5>Job Nexus</h5></a>
            <a href="job.php">Jobs</a>
            <a href="companies.php">Companies</a>
                <div class="topnavright">
                   <?php
                   if(isset($_SESSION["jobSeekerID"]))
                   {
                   ?>
                   <a href="..\Profile/profile.php"><?php echo $_SESSION["fName"]; ?></a>
                   <a href="..\logout.php">Logout</a>
                   <?php
                   }
                   else
                   {
                   ?>
                   <a href="/jobnexus/employer/login.php">For Employer</a>
                   <a href="..\LoginRegister/register.php">Register</a>
                   <a href="..\LoginRegister/login.php">Login</a>
                   <?php
                   }
                   ?>
            </div>
        </div>
        
        <div class="container h-100 fadeIn">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 mt-4">
                    <div class="card text-black" style="border-radius: 30px;">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 order-2 order-lg-1">

                                    <p class="text-center h2 fw-bold mb-1">Almost There!</p>
                                    <p class="text-center">Please enter the details below to submit the application.</p>                                   
                                    <form class="mx-md-1" action="..\jobApplyFunctions.php" method="post">
                                         <!--hidden input field for jobPostingID -->
                                        <input type="hidden" name="jobPostingID" value="<?= $jobPostingID ?>">
                                        
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="flex-fill w-100">
                                                <label for="summaryLetter">Summary Letter:</label>
                                                <textarea id="summaryLetter" class="form-control" name="summaryLetter" placeholder="Hi, my name is..." required></textarea>                                                
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="flex-fill w-100">
                                                <label for="salaryExpectation">Salary Expectation(RM): </label>
                                                <input id="salaryExpectation" name="salaryExpectation" type="number" class="form-control" required>                                                
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="flex-fill w-100">    
                                                <label for="availableDate">Availability Date: </label>
                                                <input id="availableDate" name="availableDate" type="date" class="form-control" required
                                                       min="<?= date('Y-m-d') ?>">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <input type="submit" name="apply" class="submit btn col-4" value="Apply">
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
