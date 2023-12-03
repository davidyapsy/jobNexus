<?php
session_start(); // Start the session
include '..\db_conn.php';

function removeChar($data) {
    $data = trim($data);
    return $data;
}

if (isset($_SESSION['last_refresh']) && (time() - $_SESSION['last_refresh'] < 5)) {
    $_SESSION['jobSearch'] = null;
    $_SESSION['jobtype'] = null;
    $_SESSION['salary'] = null;
    $_SESSION['industry'] = null;
}

$_SESSION['last_refresh'] = time();
$filter = isset($_SESSION['jobSearch']) ? $_SESSION['jobSearch'] : '';

if (isset($_POST['search'])) {
    $jobSearch = removeChar($_POST['jobSearch']);

    if (!empty($jobSearch)) {
        $_SESSION['jobSearch'] = $jobSearch;
        $filter = $jobSearch;
    } else {
        $_SESSION['jobSearch'] = null;
        $filter = '';
    }
}

// Filter box
if (isset($_POST['filter'])) {
    $conditions = array();

    if (!empty($_POST['jobType'])) {
        $jobType = removeChar($_POST['jobType']);
        $conditions[] = "job_posting.employmentType = '$jobType'";
        $_SESSION['jobtype'] = $jobType;
    }

    if (!empty($_POST['salary'])) {
        $salary = removeChar($_POST['salary']);
        if($salary == "7001"){
            $conditions[] = "job_posting.salary >= $salary";
        } else{
            $conditions[] = "job_posting.salary <= $salary";
        }
        $_SESSION['salary'] = $salary;
    }

    if (!empty($_POST['industry'])) {
        $industry = removeChar($_POST['industry']);
        $conditions[] = "job_category.categoryName LIKE '%$industry%'";
        $_SESSION['industry'] = $industry;
    }

    // Build the WHERE clause based on the selected filters
    $whereClause = implode(' AND ', $conditions);
}

if(!empty($_SESSION['jobSearch']) && !empty($whereClause)){
    
    $sql = "SELECT DISTINCT `job_posting`.*, `job_category`.`keywords`, `job_category`.`categoryName`, `employer`.`companyName`
        FROM `job_posting`
        LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
        LEFT JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
        WHERE (UPPER(job_category.keywords) LIKE UPPER('%$filter%') OR UPPER(job_posting.jobTitle) LIKE UPPER('%$filter%')) AND $whereClause AND job_posting.isPublish = 'Published' AND job_posting.isDeleted=0
        ORDER BY isFeatured DESC;";
} elseif(!empty($_SESSION['jobSearch'])){
    $sql = "SELECT DISTINCT `job_posting`.*, `job_category`.`keywords`, `job_category`.`categoryName`, `employer`.`companyName`
        FROM `job_posting`
        LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
        LEFT JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
        WHERE (job_category.keywords LIKE '%$filter%' OR job_posting.jobTitle LIKE '%$filter%') AND job_posting.isPublish = 'Published' AND job_posting.isDeleted=0
        ORDER BY isFeatured DESC;";
} elseif(!empty($whereClause)){
    $sql = "SELECT DISTINCT `job_posting`.*, `job_category`.`keywords`, `job_category`.`categoryName`, `employer`.`companyName`
        FROM `job_posting`
        LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
        LEFT JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
        WHERE $whereClause AND job_posting.isPublish = 'Published' AND job_posting.isDeleted=0
        ORDER BY isFeatured DESC;";
}else{
    $sql = "SELECT DISTINCT `job_posting`.*, `job_category`.`keywords`, `job_category`.`categoryName`, `employer`.`companyName`
        FROM `job_posting`
        LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
        LEFT JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
        WHERE job_posting.isPublish = 'Published' AND job_posting.isDeleted=0
        ORDER BY isFeatured DESC;";
}
$result = mysqli_query($conn, $sql);

if ($result->num_rows === 0) {
    $_SESSION['jobSearch'] = null;
    $_SESSION['jobtype'] = null;
    $_SESSION['salary'] = null;
    $_SESSION['industry'] = null;
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <title>Job Nexus | Jobs</title>
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
                float: right; 
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
            .jobPost, .filterBox{
                cursor: pointer;
            }
            .jobPostBox {
                border: 2px solid transparent;
                background-color: white;
                border-radius: 7px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s ease;
            }
            .jobPostBox:hover{
                border: 4px solid #BABBDE;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }
            .filterBox{
                border: 2px solid;
                background-color: white;
                border-radius: 5px;
                width: 100%;
            }
            .form-label, .form-select {
                display: inline-block;
                margin-bottom: 5px;
            }
            .form-select {
                border: 2px solid;
                border-color: #BABBDE;
                width: 170px;
                margin-left: 5px; 
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
            .jobDisplay {
                animation: 1.0s fadeInUp;
            }
        </style>
    </head>
    
    <body style="background-color:#dfe2e6;">
        <div class="topnav">
            <a href="..\index.php"><h5>Job Nexus</h5></a>
            <a class="active" href="job.php">Jobs</a>
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
                   <a href="..\LoginRegister/register.php">Register</a>
                   <a href="..\LoginRegister/login.php">Login</a>
                   <?php
                   }
                   ?>
            </div>
            
            <form class="mx-md-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="d-flex mt-2">
                    <div class="me-2">
                        <input type="text" id="jobSearch" class="form-control" name="jobSearch" placeholder="Search Jobs" size="25" value="<?php echo isset($_SESSION['jobSearch']) ? htmlspecialchars($_SESSION['jobSearch']) : ''; ?>">
                    </div>
                    <input type="submit" name="search" class="btn" value="Search">                  
                </div>
            </form>
        </div>
            
       <div class="row m-1 justify-content-center">
            <div class="filterBox col-12 d-flex flex-column">
                <form class="p-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="d-flex">
                        <div class="flex-fill col-3">
                            <label for="jobType" class="form-label">Job Type:</label>
                            <select id="jobType" name="jobType" class="form-select">
                                <option value="<?php echo isset($_SESSION['jobtype']) ? htmlspecialchars($_SESSION['jobtype']) : ''; ?>"><?php echo isset($_SESSION['jobtype']) ? htmlspecialchars($_SESSION['jobtype']) : ''; ?></option>
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Temporary">Temporary</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                            </select>
                            <button type="button" class='btn' onclick="resetFilter('jobType')">Cancel</button>
                        </div>

                        <div class="flex-fill col-3">
                            <label for="salary" class="form-label">Salary:</label>
                            <select id="salary" name="salary" class="form-select">
                                <option value="<?php echo isset($_SESSION['salary']) ? htmlspecialchars($_SESSION['salary']) : ''; ?>"><?php echo isset($_SESSION['salary']) ? htmlspecialchars($_SESSION['salary']) : ''; ?></option>
                                <option value="1000"> <= RM 1000</option>
                                <option value="3000"> <= RM 3000</option>
                                <option value="5000"> <= RM 5000</option>
                                <option value="7000"> <= RM 7000</option>
                                <option value="7001"> > RM 7000</option>
                            </select>
                            <button type="button" class='btn' onclick="resetFilter('salary')">Cancel</button>
                        </div>

                        <div class="flex-fill col-3 ml-auto">
                            <label for="industry" class="form-label">Industry:</label>
                            <select id="industry" name="industry" class="form-select">
                                <option value="<?php echo isset($_SESSION['industry']) ? htmlspecialchars($_SESSION['industry']) : ''; ?>"><?php echo isset($_SESSION['industry']) ? htmlspecialchars($_SESSION['industry']) : ''; ?></option>
                                <option value='Software Development'>Software Development</option>
                                <option value='Marketing'>Marketing</option>
                                <option value='Customer Support'>Customer Support</option>
                                <option value='Human Resources'>Human Resources</option>
                                <option value='Sales'>Sales</option>
                                <option value='Design'>Design</option>
                            </select>
                            <button type="button" class='btn' onclick="resetFilter('industry')">Cancel</button>
                        </div>
                        <input type="submit" name="filter" class="btn" value="Apply">
                    </div>

                    <script>
                        function resetFilter(filterName) {
                            document.getElementById(filterName).value = '';
                        }
                    </script>
                </form>
            </div>

               
    <?php while(($row = $result->fetch_assoc())==TRUE){ ?>
        <div class="jobDisplay col-10 mt-3">
            <div class="jobPostBox" onclick="location.href='jobDetails.php?id=<?=base64_encode($row['jobPostingID'])?>';">
                <table class="table table-borderless">
                    <thead class="jobPostTitle">
                        <tr>
                            <th><h3 class="d-flex"><?= $row['jobTitle']?></h3></th>
                        </tr>
                    </thead>
                    <tbody class="jobPost">
                        <tr>
                            <td><b>Company: </b><?= $row['companyName']?></td>
                            <td class="text-start"><b>Salary: </b>RM <?= $row['salary']?></td>
                        </tr>
                        <tr>
                            <td><b>Job Category: </b><?= $row['categoryName']?></td>
                            <td class="text-start"><b>Employment Type: </b><?= $row['employmentType']?></td>
                        </tr>
                        <tr>
                            <td><b>State: </b><?= $row['locationState']?></td>
                            <td class="text-start"><b>Post Date: </b><?= $row['publishDate']?></td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
    <?php } ?>
</div>
        
    </body>
</html>
