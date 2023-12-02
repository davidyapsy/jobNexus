<?php
session_start(); // Start the session
include '..\db_conn.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Decode the base64-encoded job posting ID
    $encodedJobPostingID = $_GET['id'];
    $employerID = base64_decode($encodedJobPostingID);

    $sql="SELECT `employer`.*, COUNT(job_posting.employerID) AS jobCount FROM `employer` JOIN `job_posting` ON `employer`.`employerID` = `job_posting`.`employerID`
    WHERE employer.employerID = '$employerID';";
    
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows === 0) {
        echo "<script>alert('Company not found. Please go back and try again.'); window.location.href = 'companies.php';</script>";
    }else{
        //get result
        $row = mysqli_fetch_assoc($result);
        $sql1="SELECT `job_posting`.* FROM `job_posting` JOIN `employer` ON `employer`.`employerID` = `job_posting`.`employerID`
        WHERE employer.employerID = '$employerID';";
        $result1 = mysqli_query($conn, $sql1);
        if (!$result1->num_rows === 0) {
            $row1 = mysqli_fetch_assoc($result1);
        }
    }

} else {
    // if 'id' parameter is missing
    echo "<script>alert('Invalid URL. Please go back and try again.'); window.location.href = 'companies.php';</script>";
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
            .contact{
                border: 1.5px solid black;
                border-radius: 7px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s ease;
            }
            .contact label{
                padding-left: 15px;
            }
            .description hr, .cmpDetails hr{
                border-top: 1.5px solid black;
            }
            .jobPostBox {
                border: 2px solid black;
                background-color: white;
                border-radius: 7px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s ease;
                cursor: pointer;
            }
            .jobPostBox:hover{
                border: 2px solid #BABBDE;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }
            .contact a{
                color: black;
            }
            .contact a:hover{
                text-decoration: underline;
                color: #BABBDE;
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
        
        <div class="d-flex justify-content-center d-flex m-2 fadeIn">
            <div class="cmpDetails col-11 p-3 pt-2 rounded border bg-white">
                <div class="d-flex align-items-center">
                    <?php if (!empty($row['logo']) && file_exists($row['logo'])) { // need to get from the employer pic folder?> 
                        <img src="<?php echo $row['logo'] ?>" alt="Company Logo" height="100" width="100">
                    <?php } else { ?>
                        <img src="..\Pic/company.png" alt="Company Logo" height="100" width="100">
                    <?php } ?>
                        <div class="p-2">
                            <h2 class="d-flex pt-3 "><?= $row['companyName']?></h2>
                            <p class="fw-bold"><?= $row['industry']?><br>
                            Jobs Available: <?= $row['jobCount']?></p>
                        </div>      
                </div>
                <hr> 
                
                <div class="row">
                    <div class="contact p-3 col-7">
                        <div>
                            <img src="..\Pic/noEmp.png" alt="No. of Employee" height="35" width="35">
                            <label class="fw-bold">Number of Employees: <?= $row['numberOfEmployees']?></label>
                        </div>
                        <div>
                            <img src="..\Pic/contact.png" alt="Contact Person" height="35" width="35">
                            <label class="fw-bold">Contact Person: <?= $row['contactPersonName']?></label>
                        </div>
                        <div>
                            <img src="..\Pic/email.png" alt="emailAddress" height="35" width="35">
                            <label class="fw-bold"><a href="mailto:<?= $row['emailAddress']?>">Email: <?= $row['emailAddress']?></a></label>
                        </div>
                        <div>
                            <img src="..\Pic/phone.png" alt="phoneNumber" height="35" width="35">
                            <label class="fw-bold">Phone: <?= $row['phoneNumber']?></label>
                        </div>
                        <div>
                            <img src="..\Pic/location.png" alt="phoneNumber" height="35" width="35">
                            <label class="fw-bold">Address: <?= $row['addressLineOne'].", ".$row['addressLineTwo'].", ".$row['addressLineThree'].","
                                                                .$row['postcode']." ".$row['city'].", ".$row['state']?></label>
                        </div>
                    </div>

                    <div class="map col-5 justify-content-center d-flex">                        
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7967.075624321421!2d101.71831735390624!3d3.2152552000000023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc3843bfb6a031%3A0x2dc5e067aae3ab84!2sTunku%20Abdul%20Rahman%20University%20of%20Management%20and%20Technology%20(TAR%20UMT)!5e0!3m2!1sen!2smy!4v1701006225471!5m2!1sen!2smy" width="300" height="210" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>   
                    </div>                    
                </div>
                
                <hr>
                             
                <div class="description">        
                    <div class="mt-4">
                        <h3 class="fw-bold">About Us</h3>
                        <?php if($row['aboutUs'] == null){ ?>
                            <p class="p-3">Not available.</p>
                        <?php } else{?>
                            <p class="p-3"><?= $row['aboutUs']?></p>
                        <?php } ?>                
                    </div>
                    <small>Date Joined:
                    <?php if($row['dateJoined'] == null){ ?>
                        Not available.
                    <?php } else{?>
                        <?= $row['dateJoined']?>
                    <?php } ?>                               
                    </small><hr>                   
                </div>
                
                <h3 class="fw-bold">Jobs Available</h3>
                <div class="row">
                    <?php while ($row1 = $result1->fetch_assoc()) { ?>
                        <div class="cmpJobDisplay col-4 mt-3">
                            <div class="jobPostBox" onclick="location.href='jobDetails.php?id=<?= base64_encode($row1['jobPostingID']) ?>';">
                                <h4 class="d-flex p-2"><?= $row1['jobTitle'] ?></h4>
                                <p class="p-2"><b>Salary: </b>RM <?= $row1['salary'] ?><br>
                                <b>Employment Type: </b><?= $row1['employmentType'] ?><br>
                                <b>State: </b><?= $row1['locationState'] ?><br>
                                <b>Post Date: </b><?= $row1['publishDate'] ?></p> 
                            </div>
                        </div>
                    <?php } ?>
                </div>     
            </div>
        </div>
    </body>
</html>
