<?php
    session_start();
    if($_SESSION['login']){
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $database = "db_jobnexus";
        $employerID = base64_decode($_SESSION['employerID']);

        $connection = new mysqli($serverName, $userName, $password, $database);
        $jobPostingID = base64_decode($_GET['id']);
        $maxFeatureJobListing =$_SESSION['maxFeatureJobListing'];

        $sql = "SELECT *
                FROM job_posting 
                WHERE jobPostingID = '$jobPostingID' and employerID = '$employerID'";

        $result = $connection->query($sql);
        $data =[];
        while(($row = $result->fetch_assoc())==TRUE){
            $data = $row;
        }

        $sql = "SELECT sum(isFeatured) as totalFeatured
                    FROM job_posting
                    WHERE employerID = '$employerID' AND isDeleted=0";

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
                    <form id="form_details" action="" method="post" >
                        <input type="hidden" id="jobPostingID" name="jobPostingID" value=" <?= base64_encode($jobPostingID);?>">
                        <div class="form-group row">
                            <label for="jobCategory" class="col-sm-3 col-form-label">Job Category: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="jobCategory" name="jobCategory" disabled>
                                    <option value=""> -- Please select a job category. -- </option>
                                    <?php $jobCategory_sql = "SELECT jobCategoryID, categoryName
                                                            FROM job_category";
                                    $jobCategory_result = $connection->query($jobCategory_sql);
                                    while (($row = $jobCategory_result->fetch_assoc()) == TRUE) { ?>
                                        <option value="<?= base64_encode($row['jobCategoryID']); ?>" <?php echo ($row['jobCategoryID'] == $data['jobCategoryID']) ? 'selected' : '';?>>
                                            <?= $row['categoryName'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobTitle" class="col-sm-3 col-form-label">Job Title: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="jobTitle" id="jobTitle" value="<?= $data['jobTitle']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobDescription" class="col-sm-3 col-form-label">Job Description: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div id="jobDescription" name="jobDescription"><?= $data['jobDescription']?></div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobRequirement" class="col-sm-3 col-form-label">Job Requirement: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div id="jobRequirement" name="jobRequirement"><?= $data['jobRequirement']?></div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobHighlight" class="col-sm-3 col-form-label">Job Highlight: </label>
                            <div class="col-sm-9">
                                <div id="jobHighlight" name="jobHighlight"><?= $data['jobHighlight']?></div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="experienceLevel" class="col-sm-3 col-form-label">Experience Level: <span class="required">*</span></label></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="experienceLevel" id="experienceLevel" value="<?= $data['experienceLevel']?>" min="0" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="locationState" class="col-sm-3 col-form-label">State: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="locationState" name="locationState" disabled>
                                    <option value=""> -- Please select a state. -- </option>
                                    <option value="Selangor" <?= $data['locationState']=='Selangor'?"selected":""?>>Selangor</option>
                                    <option value="Kuala Lumpur" <?= $data['locationState']=='Kuala Lumpur'?"selected":""?>>Kuala Lumpur</option>
                                    <option value="Sabah" <?= $data['locationState']=='Sabah'?"selected":""?>>Sabah</option>
                                    <option value="Kelantan" <?= $data['locationState']=='Kelantan'?"selected":""?>>Kelantan</option>
                                    <option value="Sarawak" <?= $data['locationState']=='Sarawak'?"selected":""?>>Sarawak</option>
                                    <option value="Pahang" <?= $data['locationState']=='Pahang'?"selected":""?>>Pahang</option>
                                    <option value="Kedah" <?= $data['locationState']=='Kedah'?"selected":""?>>Kedah</option>
                                    <option value="Terengganu" <?= $data['locationState']=='Terengganu'?"selected":""?>>Terengganu</option>
                                    <option value="Negeri Sembilan" <?= $data['locationState']=='Negeri Sembilan'?"selected":""?>>Negeri Sembilan</option>
                                    <option value="Perak" <?= $data['locationState']=='Perak'?"selected":""?>>Perak</option>
                                    <option value="Johor" <?= $data['locationState']=='Johor'?"selected":""?>>Johor</option>
                                    <option value="Malacca" <?= $data['locationState']=='Malacca'?"selected":""?>>Malacca</option>
                                    <option value="Penang" <?= $data['locationState']=='Penang'?"selected":""?>>Penang</option>
                                    <option value="Perlis" <?= $data['locationState']=='Perlis'?"selected":""?>>Perlis</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="salary" class="col-sm-3 col-form-label">Salary: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="salary" id="salary" min="0" max="30000" step="100" value="<?= $data['salary']?>" disabled/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employmentType" class="col-sm-3 col-form-label">Employment Type: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="employmentType" name="employmentType" disabled>
                                    <option value=""> -- Please select an employment type. -- </option>
                                    <option value="Full-time" <?= $data['employmentType']=='Full-time'?"selected":""?>>Full-time</option>
                                    <option value="Part-time" <?= $data['employmentType']=='Part-time'?"selected":""?>>Part-time</option>
                                    <option value="Temporary" <?= $data['employmentType']=='Temporary'?"selected":""?>>Temporary</option>
                                    <option value="Contract" <?= $data['employmentType']=='Contract'?"selected":""?>>Contract</option>
                                    <option value="Internship" <?= $data['employmentType']=='Internship'?"selected":""?>>Internship</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="applicationDeadline" class="col-sm-3 col-form-label">Application Deadline: </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="applicationDeadline" name="applicationDeadline" value="<?=$data['applicationDeadline']?>" 
                                     min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+31 days')); ?>" disabled/> 
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="publishDate" name="publishDate" value="<?=$data['publishDate']?>"/> 
                        <div class="form-group row">
                            <label for="isPublish" class="col-sm-3 col-form-label">Publish Job Post: </label>
                            <div class="col-sm-9">
                                <div class="form-control form-check form-switch border-0">
                                    <input class="form-check-input" type="checkbox" id="chkIsPublish" disabled <?=$data['isPublish']=="Published"?"checked":""?> 
                                        name="chkIsPublish" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isFeatured" class="col-sm-3 col-form-label">Feature Job Post: </label>
                            <div class="col-sm-9">
                                <div class="form-control form-check form-switch border-0">
                                    <input class="form-check-input" type="checkbox" <?=$availableFeature>0?"":"disabled"?> id="chkIsFeatured" name="chkIsFeatured" value="" disabled>
                                </div>
                                <div class="invalid-feedback"></div>
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
        let url = "job_post_controller.php";
        
        $('#jobDescription, #jobRequirement, #jobHighlight').summernote({
            tabsize: 2,
            height: 300
        });
        $('#jobDescription').summernote('disable');
        $('#jobRequirement').summernote('disable');
        $('#jobHighlight').summernote('disable');


        function backConfirmation(){
            window.location.href = "job_post_index.php";
        }
    </script>
</html>

<?php
    } else {
        header("location: /jobnexus/employer/login.php");
    }
?>