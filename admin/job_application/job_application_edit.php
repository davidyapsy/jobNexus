<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $jobApplicationID = base64_decode($_GET['jaID']);
    $jobPostingID = base64_decode($_GET['jpID']);

    //employerID
    $sql = "SELECT C.jobTitle, B.firstName, B.lastName, B.emailAddress, B.phoneNumber, B.address, B.working_experience, B.resume, B.skills, A.salaryExpectation, A.availableDate, A.status, A.replies
            FROM job_application A 
            JOIN job_seeker B ON A.jobSeekerID = B.jobSeekerID
            JOIN job_posting C ON A.jobPostingID = C.jobPostingID
            JOIN job_category D ON C.jobCategoryID = D.jobCategoryID
            WHERE A.applicationID = '$jobApplicationID'";

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
                            <h3>Job Application / <?=$data['jobTitle']?></h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Job Application Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post" >
                        <input type="hidden" id="jobApplicationID" name="jobApplicationID" value=" <?= base64_encode($jobApplicationID);?>">
                        <div class="form-group row">
                            <label for="jobSeekerName" class="col-sm-3 col-form-label">Job Seeker Name: </label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="jobSeekerName" id="jobSeekerName" value="<?= $data['firstName'].' '.$data['lastName']?>" disabled/>
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
                            <label for="workingExperience" class="col-sm-3 col-form-label">Working Experience: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="workingExperience" id="workingExperience" value="<?= $data['working_experience']?>" disabled/>
                            </div>
                        </div>
                        <!-- Resume -->
                        <div class="form-group row">
                            <label for="resume" class="col-sm-3 col-form-label">Resume: </label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="resume" id="resume" value="" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="availableDate" class="col-sm-3 col-form-label">Available Date: </label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" name="availableDate" id="availableDate" value="<?= $data['availableDate']?>" disabled/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status:</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="status" name="status">
                                    <option value=""> -- Please select a status. -- </option>
                                    <option value="Under Review" <?=$data['status']=="Under Review"? "selected":""?>>Under Review</option>
                                    <option value="Shortlisted" <?=$data['status']=="Shortlisted"? "selected":""?>>Shortlisted</option>
                                    <option value="Interview Scheduled" <?=$data['status']=="Interview Scheduled"? "selected":""?>>Interview Scheduled</option>
                                    <option value="Interviewed" <?=$data['status']=="Interviewed"? "selected":""?>>Interviewed</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="replies" class="col-sm-3 col-form-label">Replies: </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="replies" id="replies" rows="4"><?= $data['replies']?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick ="submitConfirmation()" class="btn btn-primary" style="float:right;">Save</button>
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
        let url = "job_application_controller.php";

        function backConfirmation(){
            Swal.fire({
                title: "Are you sure to leave this page?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                confirmButtonText: 'Discard',
                cancelButtonText: "Stay",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "job_application_index.php?id=<?=base64_encode($jobPostingID)?>"
                }
                
            });
        }

        function submitConfirmation(){
            Swal.fire({
                title: "Are you sure to save it?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    updateRecord();
                }
            });
        }

        function updateRecord() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "update",
                    applicationID: $("#jobApplicationID").val(),
                    status: $("#status").val(),
                    replies: $('#replies').val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record successfully updated! ',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "job_application_index.php?id=<?=base64_encode($jobPostingID)?>"
                            }
                        });
                    } else {
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }

    </script>
</html>