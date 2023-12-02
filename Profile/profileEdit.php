<?php
session_start();

$receivedData = isset($_GET['data']) ? $_GET['data'] : false;
$errorMsg = isset($_GET['errorMsg']) ? $_GET['errorMsg'] : "";
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
        .profile-container {
            display: inline-block;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            width: 70px;
            height: 70px;
            position: relative;
            border-radius: 50%;
            margin-left: 10px;
        }
        .profile-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            opacity: 0; /* Initially hidden */
            transition: opacity 0.3s ease;
        }
        .uploadProfile:hover .profile-background {
            opacity: 1;
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
        .uploadProfile {
            background-color: white;
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
        .uploadProfile:hover .hover-text {
            color: white;
            font-size: 12px;
            opacity: 1;
        }
        .submit{
            border: none;
            outline: none;
            height: 45px;
            width: 20%;
            background: #BABBDE;
            border-radius: 5px;
            transition: .4s;
            margin-left: 90%;
        }
        .submit:hover{
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
        .resumeLabel {
            background-color: #BABBDE; /* Button color */
            color: #fff; /* Text color */
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        #skillsList {
            margin-top: 10px;
        }
        .skillItem {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        .skillText {
            flex-grow: 1;
            margin-right: 10px;
        }
        .removeSkill {
            background-color: #d9534f;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
        #addSkillButton{
            background-color: #BABBDE;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            cursor: pointer;
            margin-top: 5px;
        }
        #addSkillButton:hover{
            background-color: #b0b1d1;
        }
        
        #previewImage {
            width: 100%;
            height: 100%;
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
          <button class="dropdown-btn">Report</button>
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
        <div class="col-md-12 mt-2" style="padding-left: 150px;">
            <div class="card text-black" style="border-radius: 30px;">
                <form action="..\profileEditFunctions.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <h2 class="pt-3">Edit Profile</h2> 
                            <?php
                            // user profile? display : defaultPic
                            if($_SESSION['profilePic']){
                                $profilePicPath = "../" . $_SESSION['profilePic'];
                            } else{
                                $profilePicPath = "../Pic/user.png";
                            }
                            ?>                
                            <input type="file" name="profilePicture" id="fileInput" accept="image/*" style="display: none;" onchange="displayImagePreview()">

                            <label for="fileInput" class="uploadProfile" id="uploadProfile" name="uploadProfile">
                                <div class="profile-container">
                                    <div class="profile-background"></div>
                                    <img id="previewImage" src="<?php echo $profilePicPath; ?>" alt="Profile" height="70" width="70">
                                    <span class="hover-text">Upload Profile</span>
                                </div>
                            </label>

                            <!-- display image preview -->
                            <script>                                
                                function displayImagePreview() {
                                    const fileInput = document.getElementById('fileInput');
                                    const previewImage = document.getElementById('previewImage');

                                    const selectedFile = fileInput.files[0];

                                    if (selectedFile) {
                                        const reader = new FileReader();

                                        reader.onload = function (e) {
                                            previewImage.src = e.target.result;
                                        };

                                        reader.readAsDataURL(selectedFile);
                                    }
                                }
                            </script>
                        </div>
                    
                        <label class="h5 fw-bold">Personal Information</label>
                        <div class="d-flex flex-row align-items-center mb-3">
                            <div class="profileDisplay flex-fill">
                                <input type="text" id="efname" class="form-control" name="efname" required value="<?php echo $_SESSION['fName']; ?>" autofocus>
                                <label>First Name</label>
                            </div>

                            <div class="profileDisplay flex-fill m-1">
                                <input type="text" id="elname" class="form-control" name="elname" required value="<?php echo $_SESSION['lName']; ?>">
                                <label>Last Name</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-3">
                            <div class="profileDisplay flex-fill">
                                <input type="text" id="eaddress" class="form-control" name="eaddress" required value="<?php echo $_SESSION['address']; ?>">
                                <label>Address</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-3">
                            <div class="profileDisplay flex-fill">
                                <input type="text" id="ephoneNo" class="form-control" name="ephoneNo" required placeholder="01x-xxxxxxx" maxlength="11" pattern="01[0-9]{1}-[0-9]{7}" title="Please enter your phone number(01x-xxxxxxx)" value="<?php echo $_SESSION['phoneNumber']; ?>">
                                <label>Phone Number<small style="color: grey"> Format: 01x-xxxxxxx</small></label>
                            </div>
                        </div>



                        <label class="h5 fw-bold">Education</label>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="profileDisplay flex-fill w-100">
                                <input type="text" id="einstitution" class="form-control" name="einstitution" value="<?php echo $_SESSION['institution']; ?>">
                                <label>Institution</label>
                            </div>

                            <div class="profileDisplay flex-fill m-1 w-100">
                                <select class="form-control" name='efieldStudy' id="efieldStudy">
                                    <option value="<?php echo $_SESSION['fieldStudy']; ?>"><?php echo $_SESSION['fieldStudy']; ?></option>
                                    <option value='Business'>Business</option>
                                    <option value='Finance'>Finance</option>
                                    <option value='Creative Arts, Design, Architecture'>Creative Arts, Design, Architecture</option>
                                    <option value='Engineering'>Engineering</option>
                                    <option value='Health Science'>Health Science</option>
                                    <option value='Hospitality, Tourism and Culinary'>Hospitality, Tourism and Culinary</option>
                                    <option value='Computer Science, IT'>Computer Science, IT</option>
                                    <option value='Law'>Law</option>
                                    <option value='Social Science'>Social Science</option>
                                  </select>
                                <label>Field Of Study</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="profileDisplay flex-fill w-100">
                                <select class="form-control" name='elevel' id="elevel">
                                    <option value="<?php echo $_SESSION['educationLevel']; ?>"><?php echo $_SESSION['educationLevel']; ?></option>
                                    <option value='Secondary School'>Secondary School</option>
                                    <option value='Pre-University'>Pre-University (A-Levels, Foundation, Diploma or equivalent)</option>
                                    <option value='Undergraduate'>Undergraduate (Bachelor's Degree or equivalent)</option>
                                    <option value='Postgraduate'>Postgraduate (Master's Degree or equivalent or higher)</option>
                                  </select>
                                <label>Level</label>
                            </div>

                            <div class="profileDisplay flex-fill m-1 w-100">
                                <select class="form-control" name="eyear" id="eyear">
                                    <?php
                                    $currentYear = date("Y"); // Get the current year
                                    for ($year = ($currentYear- 40); $year <= ($currentYear + 5); $year++) {
                                        $selected = ($year == $_SESSION['graduateYear']) ? 'selected' : ''; // show thw year from database
                                        echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                                    }
                                    ?>
                                </select>
                                <label>Graduation Year</label>
                            </div>
                        </div>



                        <!--to change, upload resume-->
                        <label class="h5 fw-bold">Resume</label>
                        <div class="d-flex flex-row align-items-center mb-3">
                            <div class="form-outline flex-fill">
                                <!-- Hidden default file input -->
                                <input type="file" name="eresume" id="eresume" accept="application/pdf" style="display:none;" onchange="previewFile(this)">
                                <!-- Visible custom file label -->
                                <label class="resumeLabel" for="eresume" id="resumeLabel">Choose file</label>
                            </div>
                        </div>

                        <div id="filePreview" class="mb-2"></div>

                        <script>
                            function previewFile(input) {
                                const filePreview = document.getElementById('filePreview');

                                const file = input.files[0];

                                // Display additional information or handle the file as needed
                                if (file) {
                                    filePreview.textContent = `${file.name}`;
                                } else {
                                    filePreview.textContent = '';
                                }
                            }
                        </script>


                        <label class="h5 fw-bold">Skills</label>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="profileDisplay flex-fill w-100">
                                <input type="text" id="eskills" class="form-control" name="eskills" placeholder="Enter your skills and press the '+' button below">
                                <button id="addSkillButton" type="button">Add Skill</button>
                                <div id="skillsList"></div>

                                <!-- Hidden input to store skills for form submission -->
                                <input type="hidden" id="hiddenSkills" name="hiddenSkills" value="">
                            </div>
                        </div>
                        
                        <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                const skillsInput = document.getElementById("eskills");
                                const hiddenSkillsInput = document.getElementById("hiddenSkills");
                                const addSkillButton = document.getElementById("addSkillButton");
                                const skillsList = document.getElementById("skillsList");
                                const submitButton = document.getElementById("save");
                                const userSkills = <?php echo json_encode(explode(",", $_SESSION['skills'] ?? '')); ?>;

                                function updateSkillsDisplay() {
                                    skillsList.innerHTML = '';

                                    // Remove empty skills and trim each skill
                                    const trimmedSkills = userSkills.filter(skill => skill.trim() !== "").map(skill => skill.trim());

                                    // Join skills array into a string with a custom separator
                                    const skillsString = trimmedSkills.join(', ');

                                    // Update the hidden input value with the trimmed skills string
                                    hiddenSkillsInput.value = skillsString;

                                    // Display each skill separately in the skills list
                                    trimmedSkills.forEach(function (skill, index) {
                                        const skillItem = document.createElement("div");
                                        skillItem.className = "skillItem";
                                        const skillText = document.createElement("div");
                                        skillText.className = "skillText";
                                        skillText.textContent = skill; // Use the trimmed skill
                                        skillItem.appendChild(skillText);
                                        const removeButton = document.createElement("button");
                                        removeButton.className = "removeSkill";
                                        removeButton.setAttribute("data-index", index);
                                        removeButton.textContent = "x";
                                        skillItem.appendChild(removeButton);
                                        skillsList.appendChild(skillItem);
                                    });
                                }

                                // Initial display
                                updateSkillsDisplay();

                                addSkillButton.addEventListener("click", function () {
                                    addSkill();
                                });

                                function addSkill() {
                                    const skill = skillsInput.value.trim();
                                    if (skill) {
                                        userSkills.push(skill);
                                        updateSkillsDisplay();
                                        skillsInput.value = '';
                                    }
                                }

                                skillsList.addEventListener("click", function (event) {
                                    if (event.target.classList.contains("removeSkill")) {
                                        const index = event.target.getAttribute("data-index");
                                        userSkills.splice(index, 1);
                                        updateSkillsDisplay();
                                    }
                                });

                                addSkillButton.textContent = "+";

                                // Prevent "Enter" key from submitting the form
                                document.addEventListener("keydown", function (event) {
                                    if (event.key === "Enter") {
                                        event.preventDefault();
                                    }
                                });
                            });
                        </script>



                        <label class="h5 fw-bold">Working Years</label>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="profileDisplay flex-fill">
                                <input type="number" id="ewYears" class="form-control" name="ewYears" placeholder="eg: 4" min="0" max="60" value="<?php echo $_SESSION['workingExp']; ?>">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <input type="submit" id="save" name="save" class="submit" value="Save">
                        </div>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>
    </div>
    
</body>
</html>
