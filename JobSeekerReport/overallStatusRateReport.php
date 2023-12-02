<?php
session_start();
include '..\db_conn.php';

$jsID = $_SESSION['jobSeekerID'];

// SQL statements
$sql1 = "SELECT COUNT(*) as totalApplications FROM job_application WHERE `job_application`.`jobSeekerID` = '$jsID';";
$sql2 = "SELECT COUNT(*) as rejectedApplications FROM job_application WHERE status = 'rejected' AND `job_application`.`jobSeekerID` = '$jsID';";
$sql3 = "SELECT COUNT(*) as underReviewApplications FROM job_application WHERE status = 'under review' AND `job_application`.`jobSeekerID` = '$jsID';";
$sql4 = "SELECT COUNT(*) as successfulApplications FROM job_application WHERE status = 'success' AND `job_application`.`jobSeekerID` = '$jsID';";

// Combine the SQL statements
$query = $sql1 . $sql2 . $sql3 . $sql4;
// Initialize variables
$totalApplications = $rejectedApplications = $underReviewApplications = $successfulApplications = 0;

// Execute the combined query
if (mysqli_multi_query($conn, $query)) {
    do {
        // Store the result set
        if ($result = mysqli_store_result($conn)) {
            // Process the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Assign values to variables
                if (isset($row['totalApplications'])) {
                    $totalApplications = $row['totalApplications'];
                }
                if (isset($row['rejectedApplications'])) {
                    $rejectedApplications = $row['rejectedApplications'];
                }
                if (isset($row['underReviewApplications'])) {
                    $underReviewApplications = $row['underReviewApplications'];
                }
                if (isset($row['successfulApplications'])) {
                    $successfulApplications = $row['successfulApplications'];
                }
            }
            // Free the result set
            mysqli_free_result($result);
        }
        // Check for more results
    } while (mysqli_next_result($conn));
} else {
    // Handle the case where the queries failed
    echo "Error executing the queries: " . mysqli_error($conn);
}

// Calculate percentages
$rejectedPercentage = ($totalApplications > 0) ? number_format(($rejectedApplications / $totalApplications) * 100, 2) : 0;
$underReviewPercentage = ($totalApplications > 0) ? number_format(($underReviewApplications / $totalApplications) * 100, 2) : 0;
$successfulPercentage = ($totalApplications > 0) ? number_format(($successfulApplications / $totalApplications) * 100, 2) : 0;

// Create the dataPoints array
$dataPoints = array(
    array("label" => "Under Review", "y" => $underReviewPercentage),
    array("label" => "Successful", "y" => $successfulPercentage),
    array("label" => "Rejected", "y" => $rejectedPercentage)
);
 
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
        .submit{
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
            <a href="jobApplicationReport.php">Job Application Report</a>
            <a class="active" href="overallStatusRateReport.php">Success Rate Report</a>
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
                <h2 style="padding-left: 130px; padding-top: 5px;">Overall Application Status & Statistic Report</h2>
            </div>
        </div>
        
        <div class="col-md-12 mt-2" style="padding-left: 150px;">
            <div class="card text-black" style="border-radius: 30px;">
                <div class="card-body">
                    <p>Here's your overall status and statistic of the job(s) you applied, the status include "under review", "success", and "rejected". You may print out the report by clicking the "Print" button below.</p>
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <table class="table table-borderless table-striped mt-3">
                        <thead class="text-start table-dark">
                            <tr>
                                <th>Total Job Apply</th>                             
                                <th>Under Review Count</th>
                                <th>Under Review Percentage</th>
                                <th>Success Count</th>
                                <th>Success Percentage</th>
                                <th>Rejected Count</th>
                                <th>Rejected Percentage</th>
                            </tr>
                        </thead>
                        <tbody class="text-start">
                            <tr>
                                <td><?php echo $totalApplications; ?></td>                                
                                <td><?php echo $underReviewApplications; ?></td>
                                <td><?php echo $underReviewPercentage; ?></td>
                                <td><?php echo $successfulApplications; ?></td>
                                <td><?php echo $successfulPercentage; ?></td>
                                <td><?php echo $rejectedApplications; ?></td>
                                <td><?php echo $rejectedPercentage; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="suggestion d-flex mt-4">
                    <img src="..\Pic/suggestion.png" alt="Suggestion" height="50" width="50">
                    <p class="p-2">To increase your success rate, you may change your resume or update your skills in your profile, and REMEMBER to turn on the "I'm Open For Jobs" so that employer can notice you!</p>
                    </div>
                    <p>You may print out the report(excel) as you wish.</p>
                    <a href="..\exportStatusReport.php" class="submit mb-3">Print</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                animationEnabled: true,
                title: {
                    text: "Job Seeker Overall Application Status & Statistic"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    showInLegend: true,
                    legendText: "{label}",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
</body>
</html>
