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
                            <h3>Subscription</h3>
                        </div>
                        <div class="col">
                            <a href="subscription_add.php">
                                <button type="button" class="btn btn-primary btn-round">
                                    <span class="text hidden-md-down">Subscribe</span>
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
                                    <select class="form-select" id="subscriptionPlan" name="subscriptionPlan">
                                        <option value="">All (Subscription Plan)</option>
                                        <?php $subscriptionPlan_sql = "SELECT subscriptionPlanID, planName
                                                                FROM subscription_plan 
                                                                WHERE isActive = 1";
                                        $subscriptionPlan_result = $connection->query($subscriptionPlan_sql);
                                        while (($row = $subscriptionPlan_result->fetch_assoc()) == TRUE) { ?>
                                                    <option value="<?= base64_encode($row['subscriptionPlanID']); ?>"><?= $row['planName'] ?></option>
                                        <?php } ?>
                                    </select>                                
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control date" name="startDateFrom" id="startDateFrom" title="Start Date (From)">
                                    <label for="startDateFrom">Start Date (From)</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control date" name="startDateTo" id="startDateTo" title="Start Date (To)">
                                    <label for="startDateTo">Start Date (To)</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-select" id="autoRenewal" name="autoRenewal">
                                        <option value="">All (Auto Renewal)</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control date" name="endDateFrom" id="endDateFrom" title="Start Date (From)">
                                    <label for="endDateFrom">End Date (From)</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control date" name="endDateTo" id="endDateTo" title="End Date (To)">
                                    <label for="endDateTo">End Date (To)</label>
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
                                    <th class="text-center" scope="col" style="width:30%;">Subscription Plan</th>
                                    <th class="text-center" scope="col" style="width:25%;">Start Date</th>
                                    <th class="text-center" scope="col" style="width:25%;">End Date</th>
                                    <th class="text-center" scope="col" style="width:10%;">Auto Renewal</th>
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
    let url = "subscription_controller.php";
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
                    subscriptionPlanID: $("#subscriptionPlan").val(),
                    startDateFrom: $("#startDateFrom").val(),
                    startDateTo: $("#startDateTo").val(),
                    endDateFrom: $("#endDateFrom").val(),
                    endDateTo: $("#endDateTo").val(),
                    autoRenewal: ($("#autoRenewal").val()==""?2:$("#autoRenewal").val()),
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
                                "        <td>" + records[i].planName + "</td>" +
                                "        <td>" + records[i].startDate + "</td>" +
                                "        <td>" + records[i].endDate + "</td>" +
                                "        <td class='text-center'>" + (records[i].autoRenewal==1?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-info'>No</span>") + "</td>" +
                                "" +
                                "        <td class='text-center'>" +
                                "          <div class=\"btn-group\">" +
                                "             <a href=\"subscription_edit.php?id="+ encodeURI(btoa(records[i].subscriptionID)) + "\">"+
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
                            tableStringBuilder += '<tr><td colspan="6" class="text-center">No Data Found</td></tr>';
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