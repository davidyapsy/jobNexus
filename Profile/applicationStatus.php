<?php
session_start(); // Start the session
include '..\db_conn.php';

$jsID = $_SESSION['jobSeekerID'];
$sql = "SELECT job_application.*, job_posting.*, job_application.status AS 'apply_status', employer.companyName FROM job_application
LEFT JOIN job_posting ON job_application.jobPostingID = job_posting.jobPostingID
LEFT JOIN employer ON job_posting.employerID = employer.employerID
WHERE job_application.jobSeekerID =  '$jsID';";
 
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Nexus | Application Status</title>
    <link rel="icon" type="image/x-icon" href="..\Pic/JobNexus_Logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
        .application {
            border: 2px solid transparent;
            background-color: white;
            border-radius: 7px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .application:hover {
            border: 4px solid #BABBDE;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .applicationBox b{
            padding-left: 20px;
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
        <a href="profile.php">Profile Overview</a>
        <a class="active" href="applicationStatus.php">Application status</a>
        <a href="changePassword.php">Change Password</a>
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
          </button>
          <div class="dropdown-container">
            <a href="..\JobSeekerReport/jobApplicationReport.php">Job Application Report</a>
            <a href="..\JobSeekerReport/overallStatusRateReport.php">Status Rate Report</a>
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

    <div class="container" style="padding-left: 150px;">
        <div class="row justify-content-center w-100" style="padding-left: 0px; padding-top: 60px;">
            <div class="d-flex align-items-center">
                <h2 style="padding-top: 5px;">Application Status</h2>
            </div>
        </div>
        
        <?php if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())==TRUE){ ?>
        <div class="application col-12 mt-3">
            <div class="applicationBox" onclick="location.href='../JobSearch/jobDetails.php?id=<?= base64_encode($row['jobPostingID']) ?>';"">
                <h4 class="d-flex p-2"><?= $row['jobTitle'] ?> [Status: <?= $row['apply_status'] ?>]</h4>
                <p class="p-2">
                    <b>Company: </b><?= $row['companyName'] ?><br>
                    <b>Salary: </b>RM <?= $row['salary'] ?><br>
                    <b>Employment Type: </b><?= $row['employmentType'] ?><br>
                    <b>State: </b><?= $row['locationState'] ?></p>
            </div>
        </div>
    <?php }
        } else{?>
        <p style="font-size: 18px; text-align: center; padding: 20px;">
            No job applications yet! Start your exciting journey to your dream job now!
        </p>
        <?php }?>
        
        
    </div>
</body>
</html>
