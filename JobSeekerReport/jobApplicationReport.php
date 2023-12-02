<?php
session_start();
include '..\db_conn.php';

function removeChar($data) {
    $data = trim($data);
    return $data;
}

$isFilter = false;

// Filter box
if (isset($_POST['filter'])) {
    $conditions = array();

    if (!empty($_POST['jobType'])) {
        $jobType = removeChar($_POST['jobType']);
        $conditions[] = "job_posting.employmentType = '$jobType'";
        $_SESSION['rJobType'] = $jobType;
    }else{
        $_SESSION['rJobType'] = null;
    }

    if (!empty($_POST['industry'])) {
        $industry = removeChar($_POST['industry']);
        $conditions[] = "job_category.categoryName LIKE '%$industry%'";
        $_SESSION['rIndustry'] = $industry;
    }else{
        $_SESSION['rIndustry'] = null;
    }
    
    if (!empty($_POST['sDate']) && !empty($_POST['eDate'])) {
        $sDate = removeChar($_POST['sDate']);
        $eDate = removeChar($_POST['eDate']);
        
        $conditions[] = "job_application.applicationDate BETWEEN '$sDate' AND '$eDate'";
        $_SESSION['rsDate'] = $sDate;
        $_SESSION['reDate'] = $eDate;
    }else{
        $_SESSION['rsDate'] = null;
        $_SESSION['reDate'] = null;
    }

    // Build the WHERE clause based on the selected filters
    $whereClause = implode(' AND ', $conditions);
}

$jsID = $_SESSION['jobSeekerID'];

if(!empty($whereClause)){
    $sql = "SELECT `job_application`.*, `employer`.*, `job_posting`.*, `job_category`.*
    FROM `job_application`
    JOIN `job_posting` ON `job_application`.`jobPostingID` = `job_posting`.`jobPostingID`
    JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
    LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
    WHERE `job_application`.`jobSeekerID` = '$jsID' AND $whereClause;";
    $isFilter = true;
    
}else{
    $sql = "SELECT `job_application`.*, `employer`.*, `job_posting`.*, `job_category`.*
    FROM `job_application`
    JOIN `job_posting` ON `job_application`.`jobPostingID` = `job_posting`.`jobPostingID`
    JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
    LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
    WHERE `job_application`.`jobSeekerID` = '$jsID';";
}

$result = mysqli_query($conn, $sql);
$count = 0;

if($isFilter){
    $sql1 = "SELECT COUNT(*) AS appCount, DATE(`job_application`.`applicationDate`) AS appDate, `job_application`.*, `employer`.*, `job_posting`.*, `job_category`.*
        FROM `job_application`
        JOIN `job_posting` ON `job_application`.`jobPostingID` = `job_posting`.`jobPostingID`
        JOIN `employer` ON `job_posting`.`employerID` = `employer`.`employerID`
        LEFT JOIN `job_category` ON `job_posting`.`jobCategoryID` = `job_category`.`jobCategoryID`
        WHERE `job_application`.`jobSeekerID` = '$jsID' AND $whereClause
        GROUP BY appDate;";
}else{
    $sql1 = "SELECT COUNT(*) AS appCount, DATE(`job_application`.`applicationDate`) AS appDate
        FROM `job_application`
        WHERE `job_application`.`jobSeekerID` = '$jsID'
        GROUP BY appDate;";
}
 
$result1 = mysqli_query($conn, $sql1);
$dataPoints = array();

while ($row = mysqli_fetch_assoc($result1)) {
    $dataPoints[] = array("y" => $row['appCount'], "label" => $row['appDate']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Nexus | Report</title>
    <link rel="icon" type="image/x-icon" href="..\Pic/JobNexus_Logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js"></script>
    <style>
        .topnav {
            background-color: white;
            overflow: hidden;
            z-index: 2;
            position: fixed;
            width: 100%;
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
        .sidenav {
            height: 100%;
            width: 170px;
            position: fixed;
            z-index: 1;
            top: 60px;
            left: 0;
            background-color: #BABBDE;
            overflow-x: hidden;
        }
        .sidenav a {
            padding: 10px 8px 6px 16px;
            text-decoration: none;
            color: black;
            font-size: 17px;
            display: block;
        }
        .sidenav a:hover, .dropdown-btn:hover {
            color: white;
            background-color: #b0b1d1;
        }
        .dropdown-container {
          display: none;
        }
        .dropdown-container a{
          font-size: 13px;
        }
        .fadeIn {
            animation: 0.7s fadeInUp;
        }
        .reportBtn .dropdown-btn{
            border: none;
            background-color: #BABBDE;
            padding: 10px 8px 6px 16px;
            font-size: 17px;
        }
        a.active {
            background-color: #a5a5d9;
        }
        .sidebar-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 5px;
            font-size: 12px;
            height: 200px;
            overflow: hidden;
        }
        .toggler-wrapper {
            display: block;
            width: 45px;
            height: 25px;
            cursor: pointer;
            position: relative;
        }
        .toggler-wrapper input[type="checkbox"] {
            display: none;
        }
        .toggler-wrapper input[type="checkbox"]:checked+.toggler-slider {
            background-color: #44cc66;
        }
        .toggler-wrapper .toggler-slider {
            background-color: #BABBDE;
            position: absolute;
            border-radius: 100px;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all 300ms ease;
            transition: all 300ms ease;
        }
        .toggler-wrapper .toggler-knob {
            position: absolute;
            -webkit-transition: all 300ms ease;
            transition: all 300ms ease;
        }
        .toggler-wrapper.style-1 input[type="checkbox"]:checked+.toggler-slider .toggler-knob {
            left: calc(100% - 19px - 3px);
        }
        .toggler-wrapper.style-1 .toggler-knob {
            width: calc(25px - 6px);
            height: calc(25px - 6px);
            border-radius: 50%;
            left: 3px;
            top: 3px;
            background-color: #fff;
        }
        .toggler-wrapper.style-1 {
            position: absolute;
            bottom: 10px;
            left: 10px;
        }
        .card{
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .submit {
            border: none;
            color: black;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            outline: none;
            height: 45px;
            width: 20%;
            background: #BABBDE;
            border-radius: 5px;
            transition: .4s;
            margin-left: 80%;
        }
        .submit:hover{
            text-decoration: none; 
            background: #b0b1d1;
        }.btn{
            background-color: #BABBDE;
            margin-left: 7px;
            margin-bottom: 5px;
        }
        .btn:hover, .apply:hover{
            background-color: #b0b1d1;
        }
        .filterBox{
            border: 2px solid;
            background-color: white;
            border-radius: 5px;
            width: 100%;
        }
        .form-label{
            width: 100px;
        }
        .form-label, .form-select, .form-control {
            display: inline-block;
            margin-bottom: 5px;
        }
        .form-select, .form-control {
            border: 1px solid;
            border-color: #BABBDE;
            width: 170px;
            margin-left: 10px; 
            margin-right: 7px;
        }
        .filterBox label{
            margin-top: 5px;
        }
        .apply{
            background-color: #BABBDE;
            border: none;
            border-radius: 5px;
            height: 40px;
            width: 10%;
            margin-left: 5px;
        }
    </style>
</head>

<body style="background-color:#dfe2e6;">
    <div class="topnav">
        <a href="..\index.php"><h5>Job Nexus</h5></a>
        <a href="..\JobSearch/job.php">Jobs</a>
        <a href="..\JobSearch/companies.php">Companies</a>
    </div>

    <div class="sidenav">
        <a href="..\Profile/profile.php">Profile Overview</a>
        <a href="..\Profile/applicationStatus.php">Application status</a>
        <a href="..\Profile/changePassword.php">Change Password</a>
        <div class="sidebar-card card">
            <div class="card-body">
                <form id="openForJobForm" action="updateOpenForJob.php" method="post">
                    <h6 id="openForJobsLabel">
                    <?php
                    if ($_SESSION['openForJob']) {
                        echo "I'm open for jobs";
                    } else {
                        echo "I'm not open for jobs";
                    }
                    ?>
                    </h6>
                    <p id="description">
                        <?php
                        if ($_SESSION['openForJob']) {
                            echo "You are now open for job opportunities and your profile will be seen by employers.";
                        } else {
                            echo "You will not be listed in an exclusive list for employers to discover, but employers can view your applications.";
                        }
                        ?>
                    </p>
                    <label class="toggler-wrapper style-1">
                        <input type="checkbox" id="openForJobs" name="openForJobs" <?php echo ($_SESSION['openForJob']) ? 'checked' : ''; ?> onchange="updateLabel()">
                        <div class="toggler-slider">
                            <div class="toggler-knob"></div>
                        </div>
                    </label>
                    <!-- hidden input to store the checkbox state -->
                    <input type="hidden" name="openForJob" id="hiddenOpenForJob" value="<?php echo ($_SESSION['openForJob']) ? '1' : '0'; ?>">
                    
                    <!-- hidden input for the current page's URL(to redirect back to current page) -->
                    <input type="hidden" name="redirect" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                </form>
            </div>
        </div>
        
        <div class="reportBtn">
          <button class="dropdown-btn">Report
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a class="active" href="jobApplicationReport.php">Job Application Report</a>
            <a href="overallStatusRateReport.php">Status Rate Report</a>
          </div>
        </div>
        <a href="..\logout.php">Logout</a>
    </div>

    <script>
        function updateLabel() {
        var openForJobsCheckbox = document.getElementById('openForJobs');
        var label = document.getElementById('openForJobsLabel');
        var description = document.getElementById('description');
        var isChecked = openForJobsCheckbox.checked;
        var hiddenOpenForJobInput = document.getElementById('hiddenOpenForJob');

        // Update the label and description on the client side
        if (isChecked) {
            label.textContent = "I'm open for jobs";
            description.textContent = "You are now open for job opportunities and your profile will be seen by employers.";
        } else {
            label.textContent = "I'm not open for jobs";
            description.textContent = "You will not be listed in an exclusive list for employers to discover, but employers can view your applications.";
        }

        // Update the hidden input value
        hiddenOpenForJobInput.value = isChecked ? '1' : '0';

        // Submit the form
        document.getElementById('openForJobForm').submit();
    }
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
    </script>

    <div class="container"> 
        <div class="row justify-content-center w-100" style="padding-left: 0px; padding-top: 60px;">
            <div class="d-flex align-items-center">
                <h2 style="padding-left: 130px; padding-top: 5px;">Job Application Report</h2>
            </div>
        </div>
        
        <div class="col-md-12 mt-2" style="padding-left: 150px;">
            <div class="card text-black" style="border-radius: 30px;">
                <div class="card-body">
                    <p>Here's your record of the job(s) you applied. You may print out the report by clicking the "Print" button below.</p>
                    <div class="filterBox col-12 d-flex flex-column mb-3">
                        <form class="p-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <div class="row">
                                <p>You may filter the criteria if you wish.</p>
                               
                                <div class="flex-fill d-flex col-12">
                                    <label for="sDate" class="form-label">Date:</label>
                                    <input type="date" class="form-control" placeholder="Start" id="sDate" name="sDate" value="<?php echo isset($_POST['sDate']) ? $_POST['sDate'] : '' ?>" />
                              
                                    <label for="eDate">To: </label>
                                    <input type="date" class="form-control" placeholder="End" id="eDate" name="eDate" value="<?php echo isset($_POST['eDate']) ? $_POST['eDate'] : '' ?>"/>
                                    <button type="button" class='btn' onclick="resetDate()">Cancel</button>
                                </div>
                                
                                <div class="flex-fill d-flex col-12">            
                                    <label for="industry" class="form-label">Industry:</label>
                                    <select id="industry" name="industry" class="form-select">
                                        <option value="<?php echo isset($_POST['industry']) ? $_POST['industry'] : '' ?>"><?php echo isset($_POST['industry']) ? $_POST['industry'] : '' ?></option>
                                        <option value='Software Development'>Software Development</option>
                                        <option value='Marketing'>Marketing</option>
                                        <option value='Customer Support'>Customer Support</option>
                                        <option value='Human Resources'>Human Resources</option>
                                        <option value='Sales'>Sales</option>
                                        <option value='Design'>Design</option>
                                    </select>
                                    <button type="button" class='btn' onclick="resetFilter('industry')">Cancel</button>
                                </div>

                                <div class="flex-fill d-flex col-12">
                                    <label for="jobType" class="form-label">Job Type:</label>
                                    <select id="jobType" name="jobType" class="form-select">
                                        <option value="<?php echo isset($_POST['jobType']) ? $_POST['jobType'] : '' ?>"><?php echo isset($_POST['jobType']) ? $_POST['jobType'] : '' ?></option>
                                        <option value="full-time">Full time</option>
                                        <option value="part-time">Part time</option>
                                        <option value="internship">Internship</option>
                                        <option value="freelance">Freelance</option>
                                    </select>
                                    <button type="button" class='btn' onclick="resetFilter('jobType')">Cancel</button>
                                </div>
                                
                                <div>
                                    <input type="submit" name="filter" class="apply" value="Apply">
                                </div>
                            </div>

                            <script>
                                function resetFilter(filterName) {
                                    document.getElementById(filterName).value = '';
                                }
                                
                                function resetDate() {
                                    // Reset both input fields
                                    document.getElementsByName('sDate')[0].value = '';
                                    document.getElementsByName('eDate')[0].value = '';
                                }
                            </script>
                        </form>
                    </div>
                    
                    <table class="table table-borderless table-striped">
                        <thead class="text-start table-dark">
                            <tr>
                            <th>No</th>
                            <th>Job Category</th>
                            <th>Job Type</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Date Apply</th>
                            </tr>
                        </thead>
                            
                            <?php if (mysqli_num_rows($result) > 0) {
                                while(($row = $result->fetch_assoc())==TRUE){ ?>
                        <tbody class="text-start">
                            <tr><th>
                            <?php echo $count + 1; ?>
                            </th>
                            <th>
                            <?php echo $row['categoryName']; ?>
                            </th>
                            <td>
                            <?php echo $row['employmentType']; ?>
                            </td>
                            <td>
                            <?php echo $row['jobTitle']; ?>
                            </td>
                            <td>
                            <?php echo $row['companyName']; ?>
                            </td>
                            <td>
                            <?php echo $row['applicationDate']; ?>
                            </td>
                            </tr>
                        
                                    
                        <?php
                            $count++;
                            }
                            } else { ?>
                            <tr><td>No Record found.</td><tr>
                            <?php } ?>
                            </tbody>
                    </table>
                    <p>Total Record(s): <?php echo $count?></p>
                    
                    <p>You may print out the report(excel) as you wish.</p>
                    <a href="..\exportApplicationReport.php" class="submit">Print Excel</a>

                    <div id="chartContainer" style="height: 350px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Job Applications Over Time"
            },
            axisY: {
                title: "Number of Job Applications"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
    </script>
</body>
</html>
