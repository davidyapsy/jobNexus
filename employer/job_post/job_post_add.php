<?php
    session_start();
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";
    $employerID = base64_decode($_SESSION['employerID']);

    $connection = new mysqli($serverName, $userName, $password, $database);

    $stat = $connection->query("SELECT jobPostingID
                                        FROM job_posting
                                        WHERE employerID='$employerID' AND isDeleted=0");
    if($stat->num_rows < $_SESSION['maxJobPosting'] && $_SESSION['maxJobPosting']!=0){

        $sql = "SELECT maxFeatureJobListing
                FROM subscription_plan A
                JOIN subscription B ON A.subscriptionPlanID = B.subscriptionPlanID
                WHERE B.employerID = '$employerID' AND B.isActive = 1";

        $result = $connection->query($sql);
        $maxFeatureJobListing =0;
        while(($row = $result->fetch_assoc())==TRUE){
            $maxFeatureJobListing = $row['maxFeatureJobListing'];
        }

        $sql = "SELECT sum(isFeatured) as totalFeatured
                FROM job_posting
                WHERE employerID = '$employerID'";

        $result = $connection->query($sql);
        $totalFeatured =0;
        while(($row = $result->fetch_assoc())==TRUE){
            $totalFeatured = $row['totalFeatured'];
        }

        $availableFeature = $maxFeatureJobListing - $totalFeatured;
    
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
                            <h3>Job Post</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Job Post Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post">
                        <div class="form-group row">
                            <label for="jobCategory" class="col-sm-3 col-form-label">Job Category: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="jobCategory" name="jobCategory">
                                    <option value=""> -- Please select a job category. -- </option>
                                    <?php $jobCategory_sql = "SELECT jobCategoryID, categoryName
                                                            FROM job_category";
                                    $jobCategory_result = $connection->query($jobCategory_sql);
                                    while (($row = $jobCategory_result->fetch_assoc()) == TRUE) { ?>
                                                <option value="<?= base64_encode($row['jobCategoryID']); ?>"><?= $row['categoryName'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobTitle" class="col-sm-3 col-form-label">Job Title: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="jobTitle" id="jobTitle"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobDescription" class="col-sm-3 col-form-label">Job Description: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div id="jobDescription" name="jobDescription"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobRequirement" class="col-sm-3 col-form-label">Job Requirement: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div id="jobRequirement" name="jobRequirement"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobHighlight" class="col-sm-3 col-form-label">Job Highlight: </label>
                            <div class="col-sm-9">
                                <div id="jobHighlight" name="jobHighlight"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="experienceLevel" class="col-sm-3 col-form-label">Experience Level: </label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="experienceLevel" id="experienceLevel"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="locationState" class="col-sm-3 col-form-label">State: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="locationState" name="locationState">
                                    <option value=""> -- Please select a state. -- </option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Terengganu">Terengganu</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Perlis">Perlis</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="salary" class="col-sm-3 col-form-label">Salary: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="salary" id="salary" min="0" max="30000" step="100" value="500"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employmentType" class="col-sm-3 col-form-label">Employment Type: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="employmentType" name="employmentType">
                                    <option value=""> -- Please select an employment type. -- </option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Temporary">Temporary</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Internship">Internship</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="applicationDeadline" class="col-sm-3 col-form-label">Application Deadline: </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="applicationDeadline" name="applicationDeadline"  min="<?= date('Y-m-d'); ?>"> 
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isPublish" class="col-sm-3 col-form-label">Publish Job Post: </label>
                            <div class="col-sm-9">
                                <div class="form-control form-check form-switch border-0">
                                    <input class="form-check-input" type="checkbox" id="chkIsPublish" name="chkIsPublish" value="">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <?php if($availableFeature > 0){ ?>
                            <div class="form-group row">
                                <label for="isFeatured" class="col-sm-3 col-form-label">Feature Job Post: </label>
                                <div class="col-sm-9">
                                    <div class="form-control form-check form-switch border-0">
                                        <input class="form-check-input" type="checkbox" id="chkIsFeatured" name="chkIsFeatured" value="">
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        <?php } ?>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick ="submitConfirmation()" class="btn btn-primary" style="float:right;">Save</button>
                                <button type="button" onclick="backConfirmation()" class="btn btn-danger btn-outline">Back</button>
                                <button type="reset" id="btnReset" class="btn btn-light btn-outline" onclick="clearForm()">Reset</button>
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
        let url = "job_post_controller.php";
        
        $(".custom-file-input").on("change", function() {
            var files = Array.from(this.files)
            var fileName = files.map(f =>{return f.name}).join(",")
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('#jobDescription, #jobRequirement, #jobHighlight').summernote({
            tabsize: 2,
            height: 300
        });

        function clearForm(){
            window.scrollTo(0, 0);
            $('#jobDescription').summernote('code', '');
            $('#jobRequirement').summernote('code', '');
            $('#jobHighlight').summernote('code', '');
        }

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
                    window.location.href = "job_post_index.php"
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
                    submitValidate();
                }
            });
        }

        function submitValidate(){
            $('.is-invalid').removeClass('is-invalid');
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "check_validation",
                    jobCategoryID : $("#jobCategory").val(),
                    jobTitle: $("#jobTitle").val(),
                    jobDescription: $('#jobDescription').summernote('code'),
                    jobRequirement: $('#jobRequirement').summernote('code'),
                    locationState: $("#locationState").val(),
                    employmentType: $("#employmentType").val(),
                    applicationDeadline: $("#applicationDeadline").val(),
                    isPublish: ($("#chkIsPublish").is(':checked') ? "Published" : "Unpublished")
                }, success: function (response) {
                    const data = response;
                    if (data.status==false) {
                        for(let i=0;i<data.data.length;i++){
                            let eachData = data.data[i];
                            var el = $('[name="' + eachData['inputName'] + '"]');
                            el.addClass("is-invalid");
                            el.parent().closest('div').find('.invalid-feedback').text(eachData['errorMessage']); 
                        }
                    } else {
                        createRecord();
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }

        function createRecord() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "create",
                    jobCategoryID : $("#jobCategory").val(),
                    jobTitle: $("#jobTitle").val(),
                    jobDescription: $('#jobDescription').summernote('code'),
                    jobRequirement: $('#jobRequirement').summernote('code'),
                    jobHighlight: $('#jobHighlight').summernote('code'),
                    experienceLevel: $("#experienceLevel").val(),
                    locationState: $("#locationState").val(),
                    salary: $("#salary").val(),
                    employmentType: $("#employmentType").val(),
                    applicationDeadline: $("#applicationDeadline").val(),
                    isPublish: ($("#chkIsPublish").is(':checked') ? "Published" : "Unpublished"),
                    isFeatured: ($("#chkIsFeatured").is(':checked') ? 1 : 0)
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record successfully created! ',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        }).then((result) => {
                            location.reload();
                        });
                        
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please contact technical staff! ',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }

    </script>
</html>

<?php } else { 
    header("location: job_post_index.php");
}?>