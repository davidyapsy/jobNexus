<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);

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
                        <div class="col-12">
                            <h3>Job Post / Report</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <form id="filterBox" method="post" action="">
                        <h4 style="padding-left:15px;">Filter Box</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-select" id="jobCategory" name="jobCategory">
                                        <option value="">All (Job Category)</option>
                                        <?php $jobCategory_sql = "SELECT jobCategoryID, categoryName
                                                                FROM job_category";
                                        $jobCategory_result = $connection->query($jobCategory_sql);
                                        while (($row = $jobCategory_result->fetch_assoc()) == TRUE) { ?>
                                                    <option value="<?= base64_encode($row['jobCategoryID']); ?>"><?= $row['categoryName'] ?></option>
                                        <?php } ?>
                                    </select>                                
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="jobTitle" id="jobTitle" placeholder="Job Title"/>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control date" name="publishDateFrom" id="publishDateFrom" title="Publish Date (From)">
                                    <label for="publishDateFrom">Publish Date (From)</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control date" name="publishDateTo" id="publishDateTo" title="Publish Date (To)">
                                    <label for="publishDateTo">Publish Date (To)</label>
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
                            <button type="button" id="reportBtn"
                                    class="btn btn-round btn-success btn-sm ladda-button"
                                    data-style="zoom-in"
                                    onclick="print_report()">
                                <span class="ladda-label">
                                    <i class="bi bi-printer" aria-hidden="true"></i> Report
                                </span>
                            </button>
                            <button type="button" class="btn btn-danger btn-round btn-sm"
                                    onclick="clear_form()">
                                <i class="bi bi-arrow-clockwise" aria-hidden="true"></i> Clear
                            </button>
                        </div>
                    </form>

                    <div class="row" style="padding-left:15px; padding-right:15px;">
                        <table class="table table-bordered" id="job_post_table">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col" style="width:5%;">No.</th>
                                    <th class="text-center" scope="col" style="width:20%;">Job Seeker Name</th>
                                    <th class="text-center" scope="col" style="width:10%;">Working Year(s)</th>
                                    <th class="text-center" scope="col" style="width:15%;">Skills</th>
                                    <th class="text-center" scope="col" style="width:15%;">Field Of Study</th>
                                    <th class="text-center" scope="col" style="width:10%;">Salary Expectation</th>
                                    <th class="text-center" scope="col" style="width:10%;">Application Date</th>
                                    <th class="text-center" scope="col" style="width:10%;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="filtered_data">
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <?php include('../footer.php') ?>

    </body>

    <script>
    // at here we try to be native as possible and you can use url to ease change the which one you prefer
    let url = "job_post_controller.php";
    const tbody = $("#filtered_data");
        
        $(window).on("load", function() {
            $( "#filterBtn" ).trigger( "click" );
        } );

        function load_data(page_number = 1)
        {
            $.ajax({
                type: "post",
                url: url,
                contentType: "application/x-www-form-urlencoded",
                data: {
                    mode: "print_report",
                    jobCategoryID: $("#jobCategory").val(),
                    jobTitle: $("#jobTitle").val(),
                    publishDateFrom: $("#publishDateFrom").val(),
                    publishDateTo: $("#publishDateTo").val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        let records = data.data;
                        var tableStringBuilder = '';
                        var statusLine="";
                        
                        if(response.data.length > 0)
                        {
                            for(var i = 0; i < records.length; i++)
                            {
                                if(records[i].status=="Under Review"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-light text-dark'>Under Review</span>" + "</td>" 
                                }else if(records[i].status=="Shortlisted"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-secondary'>Shortlisted</span>" + "</td>" 
                                }
                                else if(records[i].status=="Interview Scheduled"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-info text-dark'>Interview Scheduled</span>" + "</td>" 
                                }
                                else if(records[i].status=="Interviewed"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-success'>Interview Scheduled</span>" + "</td>" 
                                }
                                tableStringBuilder+=
                                "  <tr>" +
                                "        <th scope='row' class='text-center'>" + (((i+1)+page_number*5)-5) + ".</th>" +
                                "        <td>" + records[i].jobSeekerName + "</td>" +
                                "        <td>" + records[i].working_experience + "</td>" +
                                "        <td>" + records[i].skills + "</td>" +
                                "        <td>" + records[i].field_of_study + "</td>" +
                                "        <td>" + records[i].salaryExpectation + "</td>" +
                                "        <td>" + records[i].applicationDate + "</td>" +
                                statusLine+
                                "" +
                                "  </tr>" +
                                "";
                            }
                        }
                        else
                        {
                            tableStringBuilder += '<tr><td colspan="8" class="text-center">No Data Found</td></tr>';
                        }
                        tbody.html("").html(tableStringBuilder);
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

        function print_report(){
            
        }
    </script>
</html>