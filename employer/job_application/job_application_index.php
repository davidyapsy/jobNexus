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

        $sql = "SELECT jobTitle
                FROM job_posting 
                WHERE jobPostingID = '$jobPostingID' AND employerID = '$employerID'";

        $result = $connection->query($sql);
        $data =[];
        while(($row = $result->fetch_assoc())==TRUE){
            $data = $row;
        }
?>
<html>
    <head>
        <title>Job Nexus</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <!-- icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"> </script>  


        <link href="../../employer/assets/css/content.css" type="text/css" rel="stylesheet">

        <style>
            .col-md-3 .form-group label{
                color:rgb(179, 179, 179);
            }
        </style>
    </head>

    <body>
        <?php require('../../employer/topBar.php') ?>
        <?php require('../../employer/sideNav.php') ?>

        <div class="main h-100">
            <div class="panel panel-bordered p-2">
                <div class="panel-heading p-2">
                    <div class="row">
                        <div class="col-9">
                            <h3>Job Application / <?=$data['jobTitle']?></h3>
                        </div>
                        <!-- <div class="col-3 text-end">
                            <a href='job_application_db_access.php?id=<?= base64_encode($jobPostingID);?>'> 
                                <button type='button' class='btn btn-primary btn-round'>
                                    <i class='bi bi-plus-lg' aria-hidden='true'></i>
                                    <span class='text hidden-md-down'> Potential Candidate </span>
                                </button>
                            </a>
                        </div> -->
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <form id="filterBox" method="post" action="">
                        <h4 style="padding-left:15px;">Filter Box</h4>
                        <input type="hidden" id="jobPostingID" name="jobPostingID" value=" <?= base64_encode($jobPostingID);?>">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="jobSeekerName" id="jobSeekerName" placeholder="Job Seeker Name"/>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Address"/>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i>More than or equals to</i>
                                    </span>
                                    <input type="number" class="form-control" id="workingExperience" name="workingExperience" value="0" min="0" title="Working Experience">
                                    <span class="input-group-text">
                                        <i>Years</i>
                                    </span>
                                </div>                          
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="skills" name="skills" placeholder="Skills">
                                </div>                          
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i>More than or equals to (RM)</i>
                                    </span>
                                    <input type="number" class="form-control" id="salaryExpectation" name="salaryExpectation" value="0" title="SalaryExpectation" min="0">
                                </div>                          
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-select" id="status" name="status">
                                        <option value="">All (Status)</option>
                                        <option value="Under Review">Under Review</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Success">Success</option>
                                    </select>
                                </div>                            
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" id="filterBtn"
                                    class="btn btn-round btn-primary btn-sm" id="filterBtn"
                                    data-style="zoom-in"
                                    onclick="load_data()">
                                <i class="bi bi-funnel-fill" aria-hidden="true"></i> Filter
                            </button>
                            <!-- <button type="button" id="exportBtn"
                                    class="btn btn-round btn-success btn-sm ladda-button"
                                    data-style="zoom-in"
                                    onclick="export_to_excel()">
                                <span class="ladda-label">
                                    <i class="bi bi-file-earmark-excel" aria-hidden="true"></i> Export
                                </span>
                            </button> -->
                            <button type="button" id="reportBtn"
                                    class="btn btn-round btn-success btn-sm ladda-button"
                                    data-style="zoom-in"
                                    onclick="print_report()">
                                <span class="ladda-label">
                                    <i class="bi bi-file-bar-graph" aria-hidden="true"></i> Report
                                </span>
                            </button>
                            <button type="button" class="btn btn-danger btn-round btn-sm"
                                    onclick="clear_form()">
                                <i class="bi bi-arrow-clockwise" aria-hidden="true"></i> Clear
                            </button>
                        </div>
                    </form>
                    <div class="row" style="padding-left:15px; padding-right:15px;">
                        <table class="table table-bordered" id="job_application_table">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col" style="width:5%;">No.</th>
                                    <th class="text-center" scope="col" style="width:20%;">Job Seeker Name</th>
                                    <th class="text-center" scope="col" style="width:15%;">Address</th>
                                    <th class="text-center" scope="col" style="width:15%;">Working Year(s)</th>
                                    <th class="text-center" scope="col" style="width:15%;">Skills</th>
                                    <th class="text-center" scope="col" style="width:15%;">Salary Expectation</th>
                                    <th class="text-center" scope="col" style="width:10%;">Status</th>
                                    <th class="text-center" scope="col"><i class="bi bi-lightning-charge-fill"></i></th>
                                </tr>
                            </thead>
                            <tbody id="filtered_data">
                            </tbody>
                        </table>
                        <div id="pagination_link"></div>
                    </div>

                </div>

            </div>

        </div>
        <?php include('../footer.php') ?>

    </body>

    <script>
    // at here we try to be native as possible and you can use url to ease change the which one you prefer
    let url = "job_application_controller.php";
    const tbody = $("#filtered_data");
        
        $(window).on("load", function() {
            $( "#filterBtn" ).trigger( "click" );
        } );

        window.addEventListener("keypress", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                load_data();
            }
        });

        function load_data(page_number = 1)
        {
            $.ajax({
                type: "post",
                url: url,
                contentType: "application/x-www-form-urlencoded",
                data: {
                    mode: "search",
                    jobPostingID: $('#jobPostingID').val(),
                    jobSeekerName: $("#jobSeekerName").val(),
                    address: $("#address").val(),
                    workingExperience: $("#workingExperience").val(),
                    skills: $("#skills").val(),
                    salaryExpectation: $("#salaryExpectation").val(),
                    status: $("#status").val(),
                    page: page_number
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        let records = data.data;
                        var tableStringBuilder = '';
                        if(response.data.length > 0)
                        {
                            for(var i = 0; i < records.length; i++){
                                var statusLine="";
                                if(records[i].status=="Under Review"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-light text-dark'>Under Review</span>" + "</td>" 
                                }else if(records[i].status=="Rejected"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-warning'>Rejected</span>" + "</td>" 
                                }
                                else if(records[i].status=="Success"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-success'>Success</span>" + "</td>" 
                                }
                                tableStringBuilder+=
                                "  <tr>" +
                                "        <th scope='row' class='text-center'>" + (((i+1)+page_number*5)-5) + ".</th>" +
                                "        <td>" + records[i].jobSeekerName + "</td>" +
                                "        <td>" + records[i].address + "</td>" +
                                "        <td>" + records[i].working_experience + " Year(s)" + "</td>" +
                                "        <td>" + records[i].skills + "</td>" +
                                "        <td>" + records[i].salaryExpectation + "</td>" +
                                statusLine +
                                "" +
                                "        <td class='text-center'>" +
                                "          <div class=\"btn-group\">" +
                                "             <a href=\"job_application_edit.php?jaID="+ encodeURI(btoa(records[i].applicationID)) +"&jpID="+ encodeURI(btoa(records[i].jobPostingID)) + "\">"+
                                "               <button type=\"button\"  title=\"update\" class=\"btn btn-sm btn-warning mx-1\">" +
                                "                 <i class=\"bi bi-pencil\"></i>" +
                                "               </button>"+
                                "             </a>" +
                                "          </div>" +
                                "        </td>" +
                                "      </tr>" +
                                "";
                            }
                        }
                        else
                        {
                            tableStringBuilder += '<tr><td colspan="7" class="text-center">No Data Found</td></tr>';
                        }
                        tbody.html("").html(tableStringBuilder);
                        $('#pagination_link').html(response.pagination);
                    } else {
                        console.log("something wrong");
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }

        function clear_form(){
            $('form#filterBox').each(function () {
                this.reset();
            });
            load_data();
        }

        function export_to_excel(){
            var jobSeekerName= $("#jobSeekerName").val();
            var address= $("#address").val();
            var workingExperience= $("#workingExperience").val();
            var skills= $("#skills").val();
            var salaryExpectation= $("#salaryExpectation").val();
            var status= $("#status").val();
            $.ajax({
                type: "post",
                url: "job_application_export.php",
                contentType: "application/x-www-form-urlencoded",
                data: {
                    jobSeekerName: jobSeekerName,
                    address: address,
                    workingExperience: workingExperience,
                    skills: skills,
                    availableDateTo: availableDateTo,
                    status: status
                },success: function(dataResult){
                    window.open('job_application_export.php?jobSeekerName='+jobSeekerName+'&address='+address+'&workingExperience='+workingExperience
                    +'&skills='+skills+'&salaryExpectation='+salaryExpectation+'&status='+status);
                }, failure: function(xhr){
                    console.log(xhr);
                }
            });
        }

        function print_report(){
            window.location.href="job_application_report.php";
        }
    </script>
</html>

<?php
    } else {
        header("location: /jobNexus/employer/login.php");
    }
?>