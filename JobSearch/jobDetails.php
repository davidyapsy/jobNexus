<?php
session_start(); // Start the session
include '..\db_conn.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Decode the base64-encoded job posting ID
    $encodedJobPostingID = $_GET['id'];
    $jobPostingID = base64_decode($encodedJobPostingID);

    $sql="SELECT `job_posting`.*, `employer`.*, `benefit`.*
        FROM `job_posting`
        JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
        LEFT JOIN `benefit` ON `benefit`.`employerID` = `employer`.`employerID`
        WHERE jobPostingID = '$jobPostingID';";
    $result = mysqli_query($conn, $sql);

    $row=[];
    $benefits = [];
    if ($result->num_rows === 0) {
        echo "<script>alert('Job not found. Please go back and try again.'); window.location.href = 'job.php';</script>";
    }
    while(($rowX = $result->fetch_assoc())==TRUE){
        $benefits[] = array("benefitTitle"=>$rowX['benefitTitle'], "benefitDescription"=>$rowX['benefitDescription'], "icon"=>$rowX['icon']);
        $row=$rowX;
    }
    

} else {
    // if 'id' parameter is missing
    echo "<script>alert('Invalid URL. Please go back and try again.'); window.location.href = 'job.php';</script>";
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <title>Job Nexus</title>
        <link rel="icon" type="image/x-icon" href="..\Pic/JobNexus_Logo.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
        <link href="https://cdn.jsdelivr.net/npm/sweetalert@11.1.9/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">

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
            .topnavright button{
                border: none;
                background-color: white;
            }
            .btn, .applybtn{
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
            .jobDetails{
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s ease;
            }
            .cmpLink p {
                color: black;
                text-decoration: underline;
                font-size: 17px;
            }
            .cmpLink p:hover {
               color: #BABBDE;
               cursor: pointer;
            }
            .applyBox{
                background-color: white;
                border: 1.5px solid black;
                border-radius: 7px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s ease;
                position: fixed;
                top: 230px;
                right: 15%;
                height: 220px;
                width: 250px;
            }
            .applyBox:hover{
                border: 3px solid #BABBDE;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }
            .description hr{
                border-top: 1.5px solid black;
            }
            .applybtn{
                border: 2px solid black;
                border-radius: 15px;
                width: 200px;
                height: 45px;
            }
            .applybtn:hover{
                background-color: #DEC2BA;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }
            .extraInfo p{
                padding-left: 10px;
            }
        </style>
    </head>
    
    <body style="background-color:#dfe2e6;">
        <div class="topnav">
            <a class="active" href="../index.php"><h5>Job Nexus</h5></a>
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
        <div class="container">
        <div class="d-flex justify-content-center d-flex m-2 fadeIn">
            <div class="jobDetails col-12 p-3 pt-2 rounded border bg-white">
                <div class="d-flex align-items-center">
                    <?php if (!empty($row['logo']) && file_exists($row['logo'])) { // need to get from the employer pic folder?> 
                        <img src="<?php echo $row['logo'] ?>" alt="Company Logo" height="100" width="100">
                    <?php } else { ?>
                        <img src="..\Pic/company.png" alt="Company Logo" height="100" width="100">
                    <?php } ?>
                        <div class="p-2">
                            <h3 class="d-flex pt-4 "><?= $row['jobTitle']?></h3>
                            <div class="cmpLink d-flex">
                                <p onclick="location.href='cmpDetails.php?id=<?=base64_encode($row['employerID'])?>';"><?= $row['companyName']?></p>
                            </div>
                        </div>      
                </div>
                             
                
                    <div class="row">
                        <div class="description">
                            <hr>         
                            <div class="mt-4 col-9">
                                <h3 class="fw-bold">Job Description</h3>
                                <?php if($row['jobDescription'] == null){ ?>
                                    <p class="p-3">Not available.</p>
                                <?php } else{?>
                                    <p class="p-3"><?= $row['jobDescription']?></p>
                                <?php } ?>
                                <hr>
                                
                                <h3 class="fw-bold">Job Requirement</h3>
                                <?php if($row['jobRequirement'] == null){ ?>
                                    <p class="p-3">Not available.</p>
                                <?php } else{?>
                                    <p class="p-3"><?= $row['jobRequirement']?></p>
                                <?php } ?>                                
                                <hr>
                                
                                <h3 class="fw-bold">Benefit</h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <th style="width:20%">Icon</th>
                                        <th style="width:70%">Title</th>
                                        <th style="width:10%">Description</th>
                                    </thead>
                                    <tbody>

                                        <?php for ($i=0;$i<sizeof($benefits);$i++){ ?>
                                            <tr>
                                                <td><?=$benefits[$i]['benefitTitle']?></td>
                                                <td><?=$benefits[$i]['benefitDescription']?></td>
                                                <td class="text-center"><span class='badge bg-primary'><i class='bi <?=$benefits[$i]['icon']?>'></i></td>
                                            </tr>
                                            
                                        <?php }?>
                                    </tbody>

                                </table>
                                       
                                <hr>
                                
                                <div class="extraInfo">
                                    <h5 class="fw-bold">Additional Info</h5>
                                    <?php if($row['experienceLevel'] == null){ ?>
                                        <p>Required Experience Level: Not available.</p>
                                    <?php } else{?>
                                        <p>Required Experience Level: <?= $row['experienceLevel']?> year(s)</p>
                                    <?php } ?>
                                    
                                    <?php if($row['publishDate'] == null){ ?>
                                        <p>Post Date: Not available.</p>
                                    <?php } else{?>
                                        <p> Post Date: <?= $row['publishDate']?></p>
                                    <?php } ?>
                                        
                                    <hr>
                                </div>
                            </div>
                            
                            
                        </div>

                        <div class="applyBox justify-content-center d-flex col-3 p-3">
                            <form action="..\jobApplyFunctions.php" method="post" onsubmit="return submitApplication();" id="apply-form">
                                <!-- Hidden input for jobPostingID and pop up window, to pass the id to php file -->
                                <input type="hidden" name="jobPostingID" value="<?= $row['jobPostingID'] ?>">
                                <input type="hidden" name="coverLetterSummary" id="hidden-coverLetter" value="">
                                <input type="hidden" name="salaryExpectation" id="hidden-salaryExpectation" value="">
                                <input type="hidden" name="availableDate" id="hidden-availableDate" value="">
                                <div>
                                    <img src="..\Pic/salary.png" alt="Salary" height="35" width="35">
                                    <label class="p-2 fw-bold">RM <?= $row['salary']?></label>
                                </div>
                                <div>
                                    <img src="..\Pic/location.png" alt="Location" height="35" width="35">
                                    <label class="p-2 fw-bold"><?= $row['locationState']?></label>
                                </div>
                                <div>
                                    <img src="..\Pic/jobType.png" alt="Employment Type" height="35" width="35">
                                    <label class="p-2 fw-bold"><?= $row['employmentType']?></label>
                                </div>
                                
                                <input type="submit" name="applyJob" class="applybtn mt-3 fw-bold" value="Apply Now">
                            </form>
                        </div>
                       
                    </div>
                </div>
                
            </div>
        </div>
        <script type="text/javascript">
            function submitApplication() {
            // Check if the user is logged in
            if (!<?php echo json_encode($_SESSION['ulogin']); ?>) {
                Swal.fire({
                    title: "You haven't logged in!",
                    text: "Please log in to apply for the job.",
                    icon: "warning"
                }).then(() => {
                    // Redirect to the login page
                    window.location.href = '../LoginRegister/login.php';
                });
                return false; // Prevent the form submission
            }

            // Collect existing form data
            const formData = new FormData(document.getElementById('apply-form'));

            Swal.fire({
                title: "Almost there!",
                html: `
                    <p>Please enter the details below to submit the application.</p>
                    <div style="display: flex; flex-direction: column;">
                        <label for="coverLetter">Cover Letter: </label>
                        <textarea id="coverLetter" class="swal2-input" required style="font-size: 14px;"></textarea>
                    </div>

                    <div style="display: flex; flex-direction: column;">
                        <label for="salaryExpectation">Salary Expectation(RM): </label>
                        <input id="salaryExpectation" type="number" class="swal2-input" required style="font-size: 14px;">
                    </div>

                    <div style="display: flex; flex-direction: column;">
                        <label for="availableDate">Availability Date: </label>
                        <input id="availableDate" type="date" class="swal2-input" required style="font-size: 14px;">
                    </div>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    // Validate the inputs
                    const coverLetter = document.getElementById("coverLetter").value;
                    const salaryExpectation = document.getElementById("salaryExpectation").value;
                    const availableDate = document.getElementById("availableDate").value;

                    if (!coverLetter || !salaryExpectation || !availableDate) {
                        Swal.showValidationMessage(`Please fill in all fields.`);
                        return false;
                    }

                    // Update form fields with new values
                    formData.set("coverLetterSummary", coverLetter);
                    formData.set("salaryExpectation", salaryExpectation);
                    formData.set("availableDate", availableDate);

                    return [coverLetter, salaryExpectation, availableDate];
                }
            }).then((result) => {
                // Check if the formValues are available and not empty
                if (result.value && result.value.length > 0) {
                    // Update the hidden inputs with new values
                    document.getElementById("hidden-coverLetter").value = result.value[0];
                    document.getElementById("hidden-salaryExpectation").value = result.value[1];
                    document.getElementById("hidden-availableDate").value = result.value[2];

                    // Submit the form using fetch
                    fetch('../jobApplyFunctions.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response from jobApplication.php
                        Swal.fire({
                            title: data.success ? "Application Submitted!" : "Application failed!",
                            text: data.success ? "You may check the status in your profile." : "Please try again.",
                            icon: data.success ? "success" : "error"
                        }).then(() => {
                            // Redirect to the job.php page or another page as needed
                            if (data.success) {
                                window.location.href = 'JobSearch/job.php';
                            } else {
                                // Handle the case where the application failed
                                // You can add additional logic or show another message if needed
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error)
                    });
                }
            });

            // Prevent the default form submission
            return false;
        }

        </script>
    </body>
    
</html>
