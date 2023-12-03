<?php
    session_start();
    if($_SESSION['login']){
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $database = "db_jobnexus";

        $connection = new mysqli($serverName, $userName, $password, $database);
        $jobSeekerID = base64_decode($_GET['jsID']);
        $jobPostingID = $_GET['jpID'];

        $sql = "SELECT CONCAT(firstName, ' ', lastName) as jobSeekerName, emailAddress, phoneNumber, address, profilePic, resume, working_experience, education_level, field_of_study, institution, graduate_year, skills
                FROM job_seeker
                WHERE jobSeekerId = '$jobSeekerID'";

        $result = $connection->query($sql);
        $data =[];
        while(($row = $result->fetch_assoc())==TRUE){
            $data = $row;
        }
        
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Job Nexus</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- Sweet Alert CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
        <!-- Bootstrap icon CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
        <!-- Summernote CSS -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <link href="../assets/css/content.css" type="text/css" rel="stylesheet">

        <style>
            .required{
                color:red;
            }
        </style>
    </head>

    <body>
        <?php require('../topBar.php') ?>
        <?php require('../sideNav.php') ?>

         <div class="main">
            <div class="panel panel-bordered p-2">
                <div class="panel-heading p-2">
                    <div class="row">
                        <div class="col-12">
                            <h3>Potential Candidate</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Potential Candidate Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post" >
                        <input type="hidden" id="jobSeekerID" name="jobSeekerID" value=" <?= base64_encode($jobSeekerID);?>">
                        <div class="form-group row">
                            <label for="jobSeekerName" class="col-sm-3 col-form-label">Job Seeker Name: </label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="jobSeekerName" id="jobSeekerName" value="<?= $data['jobSeekerName']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emailAddress" class="col-sm-3 col-form-label">Email Address: </label>
                            <div class="col-sm-9">
                            <input type="input" class="form-control" name="emailAddress" id="emailAddress" value="<?= $data['emailAddress']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone Number: </label>
                            <div class="col-sm-9">
                            <input type="input" class="form-control" name="phoneNumber" id="phoneNumber" value="<?= $data['phoneNumber']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address: </label>
                            <div class="col-sm-9">
                            <input type="input" class="form-control" name="address" id="address" value="<?= $data['address']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profilePicture" class="col-sm-3 col-form-label">Profile Picture: </label>
                            <div class="col-sm-9">
                                <?php if($data['profilePic']!="") { ?>
                                    <div class="body-background">
                                        <a href="/jobnexus/<?= $data['profilePic']; ?>">
                                            <img src="/jobnexus/<?= $data['profilePic']; ?>"
                                                style="width:250px;">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <input type="file" class="form-control" name="profilePic" id="profilePic" value="" disabled/>
                                <?php } ?>  
                            </div>
                        </div>
                        <!-- Resume -->
                        <div class="form-group row">
                            <label for="resume" class="col-sm-3 col-form-label">Resume: </label>
                            <div class="col-sm-9">
                                <?php if (!empty($data['resume'])) { ?>                            
                                    <a href="../../<?=$data['resume']?>" class="form-control border border-0 text-primary" target="_blank">View Resume</a>
                                <?php } else { ?>
                                <input type="file" class="form-control" name="resume" id="resume" value="" disabled/>
                            <?php } ?>      
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="workingExperience" class="col-sm-3 col-form-label">Working Experience: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="workingExperience" id="workingExperience" value="<?= $data['working_experience']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="educationLevel" class="col-sm-3 col-form-label">Education Level: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="educationLevel" id="educationLevel" value="<?= $data['education_level']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fieldOfStudy" class="col-sm-3 col-form-label">Field Of Study: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fieldOfStudy" id="fieldOfStudy" value="<?= $data['field_of_study']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="institution" class="col-sm-3 col-form-label">Institution: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="institution" id="institution" value="<?= $data['institution']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="graduateYear" class="col-sm-3 col-form-label">Graduate Year: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="graduateYear" id="graduateYear" value="<?= $data['graduate_year']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="skills" class="col-sm-3 col-form-label">Skills: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="skills" id="skills" value="<?= $data['skills']?>" disabled/>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick="backConfirmation()" class="btn btn-danger btn-outline">Back</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <!-- Summernote JS -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

    </body>

    <script>
        function backConfirmation(){
            window.location.href = "job_application_db_access.php?id="+"<?=$jobPostingID?>";
        }

    </script>
</html>

<?php
    } else {
        header("location: /jobnexus/employer/login.php");
    }
?>