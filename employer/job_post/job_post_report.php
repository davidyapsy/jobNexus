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
                    <div class="row" class="d-none">
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
                                        <input type="date" class="form-control date" name="createdDateFrom" id="createdDateFrom" title="Created Date (From)"
                                        >
                                        <label for="createdDateFrom">Created Date (From)</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" class="form-control date" name="createdDateTo" id="createdDateTo" title="Created Date (To)"
                                        >
                                        <label for="createdDateTo">Created Date (To)</label>
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
                    </div>
                    <hr>
                    <div class="row pb-2">

                        <div class="col-sm-6">
                            <canvas id="lineChart"></canvas>
                        </div>
                        <div class="col-sm-6">
                            <canvas id="stackedBarChart"></canvas>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>                 
                    <hr>
                    <div class="row">
                        <h4>Job Post Details</h4>
                        <table class="table table-bordered" id="job_seeker_details_table">
                        <thead>
                                <tr>
                                    <th class="text-center" scope="col" style="width:5%;">No.</th>
                                    <th class="text-center" scope="col" style="width:20%;">Job Category</th>
                                    <th class="text-center" scope="col" style="width:25%;">Job Title</th>
                                    <th class="text-center" scope="col" style="width:12%;">Location (State)</th>
                                    <th class="text-center" scope="col" style="width:12%;">Employment Type</th>
                                    <th class="text-center" scope="col" style="width:10%;">Salary</th>
                                    <th class="text-center" scope="col" style="width:10%;">Publishment</th>
                                    <th class="text-center" scope="col"><i class="bi bi-lightning-charge-fill"></i></th>
                                </tr>
                            </thead>
                            <tbody id="filtered_table_data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart.js Chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </body>

    <script>
    // at here we try to be native as possible and you can use url to ease change the which one you prefer
    let url = "job_post_controller.php";
    const tbody = $("#filtered_table_data");
    var pieLabelArr = [];
    var pieDataArr =[];
    var pieConfig={};
    var lineLabelArr = [];
    var lineDataArr =[];
    var lineConfig={};
    var stackedLabelArr = [];
    var stackedSalaryArr =[];
    var stackedSalaryExpArr =[];
    var stackedConfig={};
                                            
    $(window).on("load", function() {
            $( "#filterBtn" ).trigger( "click" );
        } );


        function load_data()
        {
            $.ajax({
                type: "post",
                url: url,
                contentType: "application/x-www-form-urlencoded",
                data: {
                    mode: "print_report",
                    jobCategoryID: $("#jobCategory").val(),
                    jobTitle: $("#jobTitle").val(),
                    createdDateFrom: $("#createdDateFrom").val(),
                    createdDateTo: $("#createdDateTo").val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        let records = data.tableData;
                        var tableStringBuilder = '';
                        var statusLine="";
                        pieLabelArr= [];
                        pieDataArr = [];
                        lineLabelArr= [];
                        lineDataArr = [];
                        stackedLabelArr= [];
                        stackedSalaryArr = [];
                        stackedSalaryExpArr=[];

                        if(response.tableData.length > 0)
                        {
                            for(var i = 0; i < records.length; i++)
                            {
                                tableStringBuilder+=
                                "  <tr>" +
                                "        <th scope='row' class='text-center'>" + (i+1) + ".</th>" +
                                "        <td>" + records[i].categoryName + "</td>" +
                                "        <td>" + records[i].jobTitle + "</td>" +
                                "        <td>" + records[i].locationState + "</td>" +
                                "        <td>" + records[i].employmentType + "</td>" +
                                "        <td>" + records[i].salary + "</td>" +
                                "        <td class='text-center'>" + (records[i].isPublish=="Published"?"<span class='badge bg-success'>Published</span>":"<span class='badge bg-info'>Unpublished</span>") + "</td>" +
                                "" +
                                "        <td class='text-center'>" +
                                "          <div class=\"btn-group\">" +
                                "             <a href=\"job_post_edit.php?id="+ encodeURI(btoa(records[i].jobPostingID)) + "\">"+
                                "               <button type=\"button\"  title=\"update\" class=\"btn btn-sm btn-warning mx-1\">" +
                                "                 <i class=\"bi bi-pencil\"></i>" +
                                "               </button>"+
                                "             </a>" +
                                "            <button type=\"button\" title=\"delete\" onclick=\"deleteRecord('" + encodeURI(btoa(records[i].jobPostingID)) + "')\" class=\"btn btn-sm btn-danger\">" +
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
                            tableStringBuilder += '<tr><td colspan="8" class="text-center">No Data Found</td></tr>';
                        }

                        if(response.pieData.length>0){
                            for(let i=0;i<response.pieData.length;i++){
                                pieLabelArr[i] = response.pieData[i].label;
                                pieDataArr[i] = response.pieData[i].data;
                            }
                        }
                        let pieConfig = {
                            type: 'pie',
                            data: {
                                labels: pieLabelArr,
                                datasets: [{
                                    label: 'Percentage',
                                    data: pieDataArr,
                                    backgroundColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 205, 86)'
                                    ],
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Distribution of Job Posts Across Job Categories',
                                        font:{
                                            size: 20,
                                            weight: 'bold'
                                        }
                                    }
                                }
                            }
                        };
                        update_pie_chart(pieConfig);
                        
                        if(response.lineData.length>0){
                            for(let i=0;i<response.lineData.length;i++){
                                lineLabelArr[i] = response.lineData[i].month;
                                lineDataArr[i] = response.lineData[i].totalPost;
                            }
                        }
                        let lineConfig = {
                            type: 'line',
                            data: {
                                labels: lineLabelArr,
                                datasets: [{
                                    label: 'Total Job Post',
                                    data: lineDataArr,
                                    fill: false,
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.5
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Monthly Trend Analysis of Job Postings',
                                        font:{
                                            size: 20,
                                            weight: 'bold'
                                        }
                                    }
                                }
                            }
                        };
                        update_line_chart(lineConfig);

                        if(response.stackedBCData.length>0){
                            for(let i=0;i<response.stackedBCData.length;i++){
                                stackedLabelArr[i] = response.stackedBCData[i].label;
                                stackedSalaryArr[i] = response.stackedBCData[i].salary;
                                stackedSalaryExpArr[i] = response.stackedBCData[i].salaryExp;
                            }
                        }
                        let stackedConfig = {
                            type: 'bar',
                            data: { 
                                labels: stackedLabelArr, 
                                datasets: [{ 
                                    label: 'Salary', 
                                    data: stackedSalaryArr,
                                    fill: false,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    borderWidth: 1, 
                                }, { 
                                    label: 'Avg Salary Expectation',
                                    data: stackedSalaryExpArr, 
                                    fill: false, 
                                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                    borderColor: 'rgb(255, 159, 64)', 
                                    borderWidth: 1,
                                }], 
                            }, 
                            options: {
                                indexAxis: 'y',
                                scales: {
                                    x: {
                                        stacked: true
                                    },
                                    y: {
                                        stacked: true
                                    }
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Proposed Salary vs. Average Seeker Expectation',
                                        font:{
                                            size: 20,
                                            weight: 'bold'
                                        }
                                    }
                                }
                            }
                        };
                        update_stacked_chart(stackedConfig);

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

        
        let pieChart = new Chart(
            document.getElementById('pieChart'),
            pieConfig
        );
        function update_pie_chart(pieConfig){
            pieChart.config._config = pieConfig;
            pieChart.update();
        }

        let lineChart = new Chart(
            document.getElementById('lineChart'),
            lineConfig
        );
        function update_line_chart(lineConfig){
            lineChart.config._config = lineConfig;
            lineChart.update();
        }

        let stackedChart = new Chart(
            document.getElementById('stackedBarChart'),
            stackedConfig
        );
        function update_stacked_chart(stackedConfig){
            stackedChart.config._config = stackedConfig;
            stackedChart.update();
        }

        

    </script>
</html>