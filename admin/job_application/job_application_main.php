<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $jobPostingID = base64_decode($_GET['id']);

    $sql = "SELECT C.jobTitle, B.firstName, B.lastName, B.emailAddress, B.working_experience, A.availableDate, A.replies
            FROM job_application A 
            JOIN job_seeker B ON A.jobSeekerID = B.jobSeekerID
            JOIN job_posting C ON A.jobPostingID = C.jobPostingID
            JOIN job_category D ON C.jobCategoryID = D.jobCategoryID
            WHERE A.jobPostingID = '$jobPostingID' AND C.employerID = 'E2300000'";

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


        <link href="../../admin/assets/css/content.css" type="text/css" rel="stylesheet">

        <style>
            .col-md-3 .form-group label{
                color:rgb(179, 179, 179);
            }
        </style>
    </head>

    <body>
        <?php require('../../admin/topBar.php') ?>
        <?php require('../../admin/sideNav.php') ?>

        <div class="main h-100">
            <div class="panel panel-bordered p-2">
                <div class="panel-heading p-2">
                    <div class="row">
                        <div class="col-11">
                            <h3>Job Application / <?=$data['jobTitle']?></h3>
                        </div>
                            <div class="col">
                                <a href="job_post_add.php">
                                    <button type="button" class="btn btn-primary btn-round">
                                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                                            <span class="text hidden-md-down">Add</span>
                                    </button>
                                </a>
                            </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <form id="filterBox" method="post" action="">
                        <h4 style="padding-left:15px;">Filter Box</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="jobSeekerName" id="jobSeekerName" placeholder="Job Seeker Name"/>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="emailAddress" id="emailAddress" placeholder="Email Address"/>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="workingExperience" name="workingExperience" value="0">
                                    <span class="input-group-text">
                                        <i>Years</i>
                                    </span>
                                </div>                          
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="replies" id="replies" placeholder="Replies"/>
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control date" name="availableDateFrom" id="availableDateFrom" title="Available Date(From)">
                                    <label for="availableDateFrom">Available Date (From)</label>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control date" name="availableDateTo" id="availableDateTo" title="Available Date(To)">
                                    <label for="availableDateTo">Available Date (To)</label>
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
                            <button type="button" id="exportBtn"
                                    class="btn btn-round btn-success btn-sm ladda-button"
                                    data-style="zoom-in"
                                    onclick="export_to_excel()">
                                <span class="ladda-label">
                                    <i class="bi bi-file-earmark-excel" aria-hidden="true"></i> Export
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
                                    <th class="text-center" scope="col" style="width:18%;">Email Address</th>
                                    <th class="text-center" scope="col" style="width:15%;">Working Experience</th>
                                    <th class="text-center" scope="col" style="width:15%;">Available Date</th>
                                    <th class="text-center" scope="col" style="width:20%;">Replies</th>
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
            <?php include('../footer.php') ?>

        </div>
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
                    mode: "search",
                    jobSeekerName: $("#jobSeekerName").val(),
                    emailAddress: $("#emailAddress").val(),
                    workingExperience: $("#workingExperience").val(),
                    replies: $("#replies").val(),
                    availabilityDateFrom: $("#availabilityDateFrom").val(),
                    availabilityDateTo: $("#availabilityDateTo").val(),
                    page: page_number
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        let records = data.data;
                        var tableStringBuilder = '';
                        if(response.data.length > 0)
                        {
                            for(var i = 0; i < records.length; i++)
                            {
                                tableStringBuilder+=
                                "  <tr>" +
                                "        <th scope='row' class='text-center'>" + (((i+1)+page_number*5)-5) + ".</th>" +
                                "        <td>" + records[i].firstName + " " + records[i].lastName + "</td>"
                                "        <td>" + records[i].emailAddress + "</td>" +
                                "        <td>" + records[i].workingExperience + " Years" + "</td>"
                                "        <td>" + records[i].availabilityDate + "</td>" +
                                "        <td>" + records[i].replies + "</td>" +
                                "" +
                                "        <td class='text-center'>" +
                                "          <div class=\"btn-group\">" +
                                "             <a href=\"job_post_edit.php?id="+ encodeURI(btoa(records[i].jobApplicationID)) + "\">"+
                                "               <button type=\"button\"  title=\"update\" class=\"btn btn-sm btn-warning mx-1\">" +
                                "                 <i class=\"bi bi-pencil\"></i>" +
                                "               </button>"+
                                "             </a>" +
                                "            <button type=\"button\" title=\"delete\" onclick=\"deleteRecord('" + encodeURI(btoa(records[i].jobApplicationID)) + "')\" class=\"btn btn-sm btn-danger\">" +
                                "              <i class=\"bi bi-trash\"></i>" +
                                "            </button>" +
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
                        // document.getElementById('total_data').innerHTML = response.total_data;
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
        
        function deleteRecord(jobApplicationID) {
            
            Swal.fire({
                title: "Are you sure?",
                text: "You will not able to recover this record!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                confirmButtonText: 'Yes !',
                cancelButtonText: "Cancel !",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: url,
                        contentType: "application/x-www-form-urlencoded",
                        data: {
                            mode: "delete",
                            jobApplicationID: jobApplicationID
                        }, success: function (response) {
                            const data = response;
                            if (data.status) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Record has been deleted.",
                                    icon: "success"
                                });
                                clear_form();
                            } else {
                                console.log("something wrong");
                            }
                        }, failure: function (xhr) {
                            console.log(xhr.status);
                        }
                    })
                }
            });
        }

        function export_to_excel(){
            var jobCategoryID= $("#jobCategory").val();
            var jobTitle= $("#jobTitle").val();
            var locationState = $("#locationState").val();
            var employmentType = $("#employmentType").val();
            var salary = $("#salary").val();
            var isPublish = $("#isPublish").val();

            $.ajax({
                type: "post",
                url: "job_post_export.php",
                contentType: "application/x-www-form-urlencoded",
                data: {
                    jobCategoryID: jobCategoryID,
                    jobTitle: jobTitle,
                    locationState: locationState,
                    employmentType: employmentType,
                    salary: salary,
                    isPublish: isPublish
                },success: function(dataResult){
                    window.open('job_post_export.php?jobCategoryID='+jobCategoryID+'&jobTitle='+jobTitle+'&locationState='+locationState
                    +'&employmentType='+employmentType+'&salary='+salary+'&isPublish='+isPublish);
                }, failure: function(xhr){
                    console.log(xhr);
                }
            });
        }
    </script>
</html>