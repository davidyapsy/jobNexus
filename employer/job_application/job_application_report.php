<?php
session_start();
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";
    $employerID = base64_decode($_SESSION['employerID']);

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
                            <h3>Job Application / Report</h3>
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
                                        <select class="form-select" id="jobPosting" name="jobPosting">
                                            <option value="">All (Job Post)</option>
                                            <?php $jobPosting_sql = "SELECT jobPostingID, jobTitle
                                                                    FROM job_posting
                                                                    WHERE isDeleted =0 AND employerID = '$employerID'
                                                                    GROUP BY jobPostingID, jobTitle";
                                            $jobPosting_result = $connection->query($jobPosting_sql);
                                            while (($row = $jobPosting_result->fetch_assoc()) == TRUE) { ?>
                                                        <option value="<?= base64_encode($row['jobPostingID']); ?>"><?= $row['jobTitle'] ?></option>
                                            <?php } ?>
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
                    <div class="row">
                        <div class="col-sm-6">
                            <canvas id="pieChart"></canvas>
                        </div>   
                        <div class="col-sm-6">
                            <canvas id="barChart"></canvas>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas id="multiLineChart"></canvas>
                        </div>
                    </div>                 
                    <hr>
                    <div class="row">
                        <h4>Job Application Details</h4>
                        <table class="table table-bordered" id="job_application_details_table">
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
    let url = "job_application_controller.php";
    const tbody = $("#filtered_table_data");
    var pieLabelArr = [];
    var pieDataArr =[];
    var pieConfig={};
    var barLabelArr = [];
    var barDataArr =[];
    var barConfig={};
    var multiLineArr1 =[];
    var multiLineArr2 =[];
    var multiLineArr3 = [];
    var multiLineConfig={};
                                            
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
                    jobPostingID: $("#jobPosting").val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        let records = data.tableData;
                        var tableStringBuilder = '';
                        var statusLine="";
                        pieLabelArr= [];
                        pieDataArr = [];
                        pieLabelArr2= [];
                        pieDataArr2 = [];
                        lineLabelArr= [];
                        lineDataArr = [];
                        multiLineArr = [];
                        multiLineDatasets =[];

                        if(response.tableData.length > 0)
                        {
                            for(var i = 0; i < records.length; i++)
                            {
                                if(records[i].status=="Under Review"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-light text-dark'>Under Review</span>" + "</td>" 
                                }else if(records[i].status=="Pending"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-warning'>Pending</span>" + "</td>" 
                                }
                                else if(records[i].status=="Success"){
                                    statusLine="        <td class='text-center'>"+"<span class='badge bg-success'>Success</span>" + "</td>" 
                                }
                                tableStringBuilder+=
                                "  <tr>" +
                                "        <th scope='row' class='text-center'>" + (i+1) + ".</th>" +
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

                        // Pie chart
                        if(response.pieData.length>0){
                            for(let i=0;i<response.pieData.length;i++){
                                pieLabelArr[i] = response.pieData[i].title;
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

                        // Bar chart
                        if(response.barData.length>0){
                            for(let i=0;i<response.pieData.length;i++){
                                barLabelArr[i] = response.barData[i].title;
                                barDataArr[i] = response.barData[i].successRate;
                            }
                        }
                        let barConfig = {
                            type: 'bar',
                            data: {
                                labels: barLabelArr,
                                datasets: [{
                                    label: 'Percentage',
                                    data: barDataArr,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                    ],
                                    borderWidth: 1
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
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        };
                        update_bar_chart(barConfig);

                        // Multi line chart
                        if(response.multiLineData.length>0){
                            for(let i=0;i<response.multiLineData.length;i++){
                                var eachData = [];
                                for(let j=0; j<30; j++){
                                    for(let z=0, found = false; z<response.multiLineData[i].daysApplied.length && found==false ; z++){
                                        var daysApplied = parseInt(response.multiLineData[i].daysApplied[z]);
                                        if(daysApplied == j){
                                            found=true;
                                            eachData[j] = {
                                                x: daysApplied+1,
                                                y: parseInt(response.multiLineData[i].totalApplication[z])
                                            };
                                        }else{
                                            eachData[j] = {
                                                x: j+1,
                                                y: 0
                                            };
                                        }
                                    }
                                }

                                multiLineDatasets[i] = {
                                    label: response.multiLineData[i].jobTitle,
                                    data: eachData,
                                    fill: false,
                                    tension: 0.5
                                };
                            }
                        }
                        let multiLineConfig = {
                            type: 'line',
                            data: {
                                labels: [1,2,3,4,5,6,7,8,9,10,11,12,
                                        13,14,15,16,17,18,19,20,21,
                                        22,23,24,25,26,27,28,29,30],
                                datasets: multiLineDatasets
                            },
                            options: {
                                responsive: true,
                                interaction: {
                                    mode: 'index',
                                    intersect: false,
                                },
                                stacked: false,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Chart.js Line Chart - Multi Axis'
                                    }
                                },
                            }
                        };
                        update_multiLine_chart(multiLineConfig);

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

        let barChart = new Chart(
            document.getElementById('barChart'),
            barConfig
        );
        function update_bar_chart(barConfig){
            barChart.config._config = barConfig;
            barChart.update();
        }

        let multiLineChart = new Chart(
            document.getElementById('multiLineChart'),
            multiLineConfig
        );
        function update_multiLine_chart(multiLineConfig){
            multiLineChart.config._config = multiLineConfig;
            multiLineChart.update();
        }




        

    </script>
</html>