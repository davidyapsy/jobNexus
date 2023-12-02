<?php
session_start(); // Start the session
include '..\db_conn.php';

function removeChar($data) {
    $data = trim($data);
    return $data;
}

if (isset($_SESSION['last_refresh']) && (time() - $_SESSION['last_refresh'] < 5)) {
    // Reset cmpSearch to null
    $_SESSION['cmpSearch'] = null;
}

$_SESSION['last_refresh'] = time();
$filter = isset($_SESSION['cmpSearch']) ? $_SESSION['cmpSearch'] : '';

if (isset($_POST['search'])) {
    $cmpSearch = removeChar($_POST['cmpSearch']);

    if (!empty($cmpSearch)) {
        $_SESSION['cmpSearch'] = $cmpSearch;
        $filter = $cmpSearch;
    } else {
        $_SESSION['cmpSearch'] = null;
        $filter = '';
    }
}

if(!empty($_SESSION['cmpSearch'])){
    $filter = $_SESSION['cmpSearch'];
    
    $sql = "SELECT employer.*, COUNT(job_posting.employerID) AS jobCount
    FROM employer LEFT JOIN job_posting ON employer.employerID = job_posting.employerID
    WHERE employer.companyName LIKE '%$filter%' AND employer.status = 'approved'
    GROUP BY employer.employerID;";
} else{
    $sql = "SELECT employer.*, COUNT(job_posting.employerID) AS jobCount
    FROM employer LEFT JOIN job_posting ON employer.employerID = job_posting.employerID
    WHERE employer.status = 'approved'
    GROUP BY employer.employerID;";
}

$result = mysqli_query($conn, $sql);

if ($result->num_rows === 0 && isset($_SESSION['cmpSearch'])) {
    $_SESSION['cmpSearch'] = null;
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
        <title>Job Nexus | Companies</title>
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
            .cmpPost{
                cursor: pointer;
            }
            .cmpInfoBox {
                border: 2px solid transparent;
                background-color: white;
                border-radius: 7px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s ease;
            }
            .cmpInfoBox:hover {
                border: 4px solid #BABBDE;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
            .cmpDisplay {
                animation: 1.0s fadeInUp;
            }
        </style>
    </head>
    
    <body style="background-color:#dfe2e6;">
        <div class="topnav">
            <a href="../index.php"><h5>Job Nexus</h5></a>
            <a href="job.php">Jobs</a>
            <a class="active" href="companies.php">Companies</a>
            
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
                        <input type="text" id="cmpSearch" class="form-control" name="cmpSearch" placeholder="Search Companies" size="25" value="<?php echo isset($_SESSION['cmpSearch']) ? htmlspecialchars($_SESSION['cmpSearch']) : ''; ?>">
                    </div>
                    <input type="submit" name="search" class="btn" value="Search">
                </div>
            </form>
        </div>
        
        <div class="row m-2">
            <?php while(($row = $result->fetch_assoc())==TRUE){ ?>
                <div class="cmpDisplay col-4 mt-3">
                    <div class="cmpInfoBox" onclick="location.href='cmpDetails.php?id=<?=base64_encode($row['employerID'])?>';">
                        <div class="d-flex justify-content-center align-items-center">
                            <?php if (!empty($row['logo']) && file_exists($row['logo'])) { // need to get from the employer pic folder?> 
                                <img src="<?php echo $row['logo'] ?>" alt="Company Logo" height="100" width="100">
                            <?php } else { ?>
                                <img src="..\Pic/company.png" alt="Company Logo" height="100" width="100">
                            <?php } ?>
                        </div>
                        <table class="table table-borderless">
                            <thead class="cmpTitle">
                                <tr>
                                    <th><h3 class="d-flex"><?= $row['companyName'] ?></h3></th>
                                </tr>
                            </thead>
                            <tbody class="cmpPost">
                                <tr>
                                    <td><b>Industry: </b><?= $row['industry'] ?></td>
                                </tr>
                                <tr>
                                    <td><b>Jobs Available: </b><?= $row['jobCount'] ?> jobs</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php } ?>
        </div>
        <div class="position-absolute bottom-0 end-0 bg-white w-100" style="height:4%;">
            <p class="px-2">@ 2023 Copyright</p>
        </div>
    </body>
</html>
