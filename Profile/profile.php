<?php
session_start();

//for profile edit success
$valid = isset($_GET['valid']) ? $_GET['valid'] : false;
$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Nexus | Profile Overview</title>
    <link rel="icon" type="image/x-icon" href="..\Pic/JobNexus_Logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
    <link href="https://cdn.jsdelivr.net/npm/sweetalert@11.1.9/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
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
        .uploadProfile {
            background-color: #dfe2e6;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }
        .uploadProfile img {
            transition: filter 0.3s ease;
        }
        .uploadProfile:hover img {
            filter: brightness(50%);
        }
        .hover-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0; 
            transition: opacity 0.3s ease;
            color: white;
            font-size: 12px;
        }
        .uploadProfile:hover .hover-text {
            color: white;
            font-size: 12px;
            opacity: 1;
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
            margin-left: 90%;
        }
        .submit:hover{
            text-decoration: none; 
            background: #b0b1d1;
        }
        .profileDisplay label{
            font-family: sans-serif;
        }
        .profileDisplay p{
            border: 2px solid;
            border-radius: 8px;
            border-color: #dbdbdb;
            padding: 5px;
        }
        .profileDisplay a{
            border: none;
            color: black;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            outline: none;
            height: 40px;
            width: 15%;
            background: #BABBDE;
            border-radius: 5px;
            transition: .4s;
        }
        .profileDisplay a:hover{
            text-decoration: none; 
            background: #b0b1d1;
        }
    </style>
</head>

<body style="background-color:#dfe2e6;">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
    function success(msg){
        Swal.fire({
              title: "Yay!",
              text: msg,
              icon: "success"
        });
    }

    // Reset the data parameter in the URL when the page is loaded
    $(document).ready(function() {
        var url = new URL(window.location.href);
        url.searchParams.delete('valid');
        var newUrl = url.toString();
        history.replaceState({}, '', newUrl);

        // Trigger the alert if password changed 
        <?php if($valid): ?>
            success('<?php echo $msg; ?>');
        <?php endif; ?>
    });
    </script>
        
    <div class="topnav">
        <a href="..\index.php"><h5>Job Nexus</h5></a>
        <a href="..\JobSearch/job.php">Jobs</a>
        <a href="..\JobSearch/companies.php">Companies</a>
    </div>

    <div class="sidenav">
        <a class="active" href="profile.php">Profile Overview</a>
        <a href="applicationStatus.php">Application status</a>
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

    <div class="container">
        <div class="row justify-content-center w-100" style="padding-left: 0px; padding-top: 60px;">
            <div class="d-flex align-items-center mt-2">
                <h2 style="padding-left: 160px; padding-top: 5px;">Profile</h2>                
                <?php
                // user profile? display : defaultPic
                if($_SESSION['profilePic']){
                    $profilePicPath = "../" . $_SESSION['profilePic'];
                } else{
                    $profilePicPath = "../Pic/user.png";
                }
                ?>
                <img style="margin-left: 10px; border-radius: 50%;" src="<?php echo $profilePicPath; ?>" alt="Profile" height="70" width="70">
            </div>
        </div>
        
        <div class="col-md-12 mt-2" style="padding-left: 150px;">
            <div class="card text-black" style="border-radius: 30px;">
                <div class="card-body">
                    <h3><b>Welcome, <?php echo $_SESSION['fName']; ?>!</b></h3>
                    
                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="profileDisplay flex-fill w-100">
                            <label>First Name</label>
                            <p><?php echo $_SESSION['fName']; ?></p>
                        </div>

                        <div class="profileDisplay flex-fill m-1 w-100">
                            <label>Last Name</label>
                            <p><?php echo $_SESSION['lName']; ?></p>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="profileDisplay flex-fill w-100">
                            <label>Email</label>
                            <p><?php echo $_SESSION['emailAddress']; ?></p>
                        </div>

                        <div class="profileDisplay flex-fill m-1 w-100">
                            <label>Phone No</label>
                            <p><?php echo $_SESSION['phoneNumber']; ?></p>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="profileDisplay flex-fill w-100">
                            <label>Address</label>
                            <p><?php echo $_SESSION['address']; ?></p>
                        </div>
                    </div>

                    <label class="h5 fw-bold">Education</label>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <div class="profileDisplay flex-fill w-100">
                            <label>Institution</label>
                            <p><?php echo $_SESSION['institution']; ?></p>
                        </div>

                        <div class="profileDisplay flex-fill m-1 w-100">
                            <label>Field Of Study</label>
                            <p><?php echo $_SESSION['fieldStudy']; ?></p>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-row align-items-center mb-4">
                        <div class="profileDisplay flex-fill w-100">
                            <label>Level</label>
                            <p><?php echo $_SESSION['educationLevel']; ?></p>
                        </div>

                        <div class="profileDisplay flex-fill m-1 w-100">
                            <label>Graduate Year</label>
                            <p><?php echo $_SESSION['graduateYear']; ?></p>
                        </div>
                    </div>
                    
                    <label class="h5 fw-bold">Resume</label>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <div class="profileDisplay flex-fill w-100">
                            <?php        
                            $resumePath = "../" . $_SESSION['resume'];
                            if (!empty($_SESSION['resume']) && file_exists($resumePath)) { ?>                            
                                <a href="..\viewResume.php" target="_blank">View Resume</a>
                                <small><?php echo $_SESSION['resume']; ?></small>
                            <?php } else { ?>
                                <small>No resume available</small>
                            <?php } ?>                
                        </div>
                    </div>

                    <label class="h5 fw-bold">Skills</label>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <div class="profileDisplay flex-fill w-100">
                            <p><?php echo $_SESSION['skills']; ?></p>
                        </div>
                    </div>

                    <label class="h5 fw-bold">Working Years</label>
                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="profileDisplay flex-fill">
                            <p><?php echo $_SESSION['workingExp']; ?></p>
                        </div>
                    </div>
                    
                    <div class="input-field d-flex">                        
                        <a href="profileEdit.php" class="submit">Edit</a>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
