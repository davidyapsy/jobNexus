<?php
session_start(); // Start the session
// Set $_SESSION['ulogin'] to false if not already set
if (!isset($_SESSION['ulogin'])) {
    $_SESSION['ulogin'] = false;
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
        <link rel="icon" type="image/x-icon" href="Pic/JobNexus_Logo.png">
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
        </style>
    </head>
    
    <body style="background-color:#dfe2e6;">
        <div class="topnav">
            <a class="active" href="index.php"><h5>Job Nexus</h5></a>
            <a href="JobSearch/job.php">Jobs</a>
            <a href="JobSearch/companies.php">Companies</a>
                <div class="topnavright">
                   <?php
                   if(isset($_SESSION["jobSeekerID"]))
                   {
                   ?>
                   <a href="Profile/profile.php"><?php echo $_SESSION["fName"]; ?></a>
                   <a href="logout.php">Logout</a>
                   <?php
                   }
                   else
                   {
                   ?>
                   <a href="/jobnexus/employer/login.php">For Employer</a>
                   <a href="LoginRegister/register.php">Register</a>
                   <a href="LoginRegister/login.php">Login</a>
                   <?php
                   }
                   ?>
            </div>
        </div>
        
        <div class="row justify-content-center w-100 fadeIn">
        <div class="col-md-10 col-lg-6 col-xl-5 d-flex align-items-center order-2 order-lg-1">
            <form class="mx-md-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="d-flex mt-2">
                    <div class="profileDisplay me-2 mt-2">
                        <h2>Unlock Your Future: Find Your Dream Job Here</h2>
                        <input type="text" id="jobSearch" class="form-control" name="jobSearch" placeholder="Search Jobs" size="25">
                        <input type="submit" name="search" class="btn mt-3" value="Search">
                    </div>
                        
                </div>
            </form>
        </div>
        
        <div class="col-md-5 col-lg-4 col-xl-4 mt-5 d-flex align-items-center order-1 order-lg-2">
            <img src="Pic/index.jpg" class="img-fluid rounded-4" alt="Illustration">
        </div>
        </div>
        
        <?php
        //remove space in user input
        function removeChar($data) {
            $data = trim($data);
            return $data;
        }
        
        if (isset($_POST['search'])) {
            $jobSearch = removeChar($_POST['jobSearch']);

            if (!empty($jobSearch)) {
                $_SESSION['jobSearch'] = $jobSearch;
            }

            header("Location: JobSearch/job.php");
            exit();
        }
        
        ?>
        
        <div class="position-absolute bottom-0 end-0 bg-white w-100" style="height:4%;">
            <p class="px-2">@ 2023 Copyright</p>
        </div>
    </body>
</html>
