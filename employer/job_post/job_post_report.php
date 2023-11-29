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
                                        <input type="date" class="form-control date" name="publishDateFrom" id="publishDateFrom" title="Publish Date (From)"
                                        value="<?=date('Y-m-d', strtotime('first day of january this year'));?>">
                                        <label for="publishDateFrom">Publish Date (From)</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" class="form-control date" name="publishDateTo" id="publishDateTo" title="Publish Date (To)"
                                        value="<?=date('Y-m-d', strtotime('last day of december this year'));?>">
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
                    </div>
                    <hr>
                    <div class="row pb-2">
                        <div class="col-sm-4">
                            <canvas id="pieChart"></canvas>
                        </div>
                        <div class="col-sm-4">
                            <canvas id="lineChart"></canvas>
                        </div>
                        <div class="col-sm-4">
                            <canvas id="stackedBarChart"></canvas>
                        </div>   
                    </div>                 
                    <div class="row">
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
                        let records = data.tableData;
                        var tableStringBuilder = '';
                        var statusLine="";
                        
                        if(response.tableData.length > 0)
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
                        pie_chart(response.pieData);
                        stacked_bar_chart(response.stackedBCData);
                        line_chart(response.lineData);
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

        function pie_chart(pieData){
            const pieLabels = [];
            const pieDatas =[];
            pieData.forEach((element) => {
                    pieLabels.push(element.label),
                    pieDatas.push(element.data)
                }
            );

            const ctx = document.getElementById('pieChart');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: pieLabels,
                    datasets: [{
                        label: 'Percentage',
                        data: pieDatas,
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
                            text: 'Pie chart',
                            font:{
                                size: 20,
                                weight: 'bold'
                            }
                        }
                    }
                }
            });
        }

        function stacked_bar_chart(stackedBCData){
            const labels = [];
            const salary =[];
            const salaryExp =[];
            stackedBCData.forEach((element) => {
                    labels.push(element.label),
                    salary.push(element.salary),
                    salaryExp.push(element.salaryExp)
                }
            );

            const ctx = document.getElementById('stackedBarChart');
            const stackedBar = new Chart(ctx, {
                type: 'bar',
                data: { 
                    labels: labels, 
                    datasets: [{ 
                        label: 'Salary', 
                        data: salary,
                        fill: false,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        borderWidth: 1, 
                    }, { 
                        label: 'Avg Salary Expectation',
                        data: salaryExp, 
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
                            text: 'Stacked bar chart',
                            font:{
                                size: 20,
                                weight: 'bold'
                            }
                        }
                    }
                },
            });
        }

        function line_chart(lineData){
            const lineLabels = [];
            const lineDatas =[];
            lineData.forEach((element) => {
                    lineLabels.push(element.month),
                    lineDatas.push(element.totalPost)
                }
            );
            const ctx = document.getElementById('lineChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: lineLabels,
                    datasets: [{
                        label: 'Total Job Post',
                        data: lineDatas,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Line chart',
                            font:{
                                size: 20,
                                weight: 'bold'
                            }
                        }
                    }
                }
            });

        }

    </script>
</html>