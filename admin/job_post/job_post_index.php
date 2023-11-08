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
                            <h3>Job Post</h3>
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
                        <div class="row pb-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="jobTitle" id="jobTitle" placeholder="Job Title"/>
                                </div>                            
                            </div>
                            <div class="col-sm-3">
                                <select class="form-select" id="locationState" name="locationState">
                                    <option value="">All (State)</option>
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
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-select" id="employmentType" name="employmentType">
                                        <option value="">All (Employment Type)</option>
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Temporary">Temporary</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Internship">Internship</option>
                                    </select>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-select" id="status" name="status">
                                        <option value="">All (Status)</option>
                                        <option value="Posted">Posted</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Closed">Closed</option>
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
                                    <th scope="col" style="width:5%;">No.</th>
                                    <th scope="col" style="width:25%;">Job Title</th>
                                    <th scope="col" style="width:15%;">Location (State)</th>
                                    <th scope="col" style="width:15%;">Employment Type</th>
                                    <th scope="col" style="width:15%;">Salary</th>
                                    <th scope="col" style="width:10%;">Status</th>
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
    </body>
    <!-- Footer -->

    <!-- Footer -->

    <script>
    // at here we try to be native as possible and you can use url to ease change the which one you prefer
    let url = "job_post_controller.php";
    const tbody = $("#filtered_data");
        
        $(window).on( "load", function() {
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
                    jobTitle: $("#jobTitle").val(),
                    locationState: $("#locationState").val(),
                    employmentType: $("#employmentType").val(),
                    status: $("#status").val(),
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
                                "        <td>" + records[i].jobTitle + "</td>" +
                                "        <td>" + records[i].locationState + "</td>" +
                                "        <td>" + records[i].employmentType + "</td>" +
                                "        <td>" + records[i].salary + "</td>" +
                                "        <td>" + records[i].status + "</td>" +
                                "" +
                                "        <td class='text-center'>" +
                                "          <div class=\"btn-group\">" +
                                "             <a href=\"job_post_view.php?id="+ encodeURI(btoa(records[i].job_post_id)) + "\">"+
                                "               <button type=\"button\"  title=\"view\" class=\"btn btn-sm btn-info\">" +
                                "                 <i class=\"bi bi-eye\"></i>" +
                                "               </button>"+
                                "             </a>" +
                                <?php if($position =="manager"){?>
                                "             <a href=\"job_post_edit.php?id="+ encodeURI(btoa(records[i].job_post_id)) + "\">"+
                                "               <button type=\"button\"  title=\"update\" class=\"btn btn-sm btn-warning mx-1\">" +
                                "                 <i class=\"bi bi-pencil\"></i>" +
                                "               </button>"+
                                "             </a>" +
                                "            <button type=\"button\" title=\"delete\" onclick=\"deleteRecord('" + encodeURI(btoa(records[i].job_post_id)) + "')\" class=\"btn btn-sm btn-danger\">" +
                                "              <i class=\"bi bi-trash\"></i>" +
                                "            </button>" +
                                <?php }?>

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
        
        function deleteRecord(employerID, jobPostingID) {
            
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
                            employerID: employerID,
                            jobPostingID: jobPostingID
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
            var origin = $("#origin").val();
            var destination = $("#destination").val();
            var airplaneId = $("#planeName").val();
            var departureDay = $("#departureDay").val();
            var departureTimeFrom = $("#departureTimeFrom").val();
            var departureTimeTo = $("#departureTimeTo").val();

            $.ajax({
                type: "post",
                url: "job_post_export.php",
                contentType: "application/x-www-form-urlencoded",
                data: {
                    origin: origin,
                    destination: destination,
                    airplaneId: airplaneId,
                    departureDay: departureDay,
                    departureTimeFrom: departureTimeFrom,
                    departureTimeTo: departureTimeTo
                },success: function(dataResult){
                    window.open('job_post_export.php?origin='+origin+'&destination='+destination+'&airplaneId='+airplaneId
                    +'&departureDay='+departureDay+'&departureTimeFrom='+departureTimeFrom+'&departureTimeTo='+departureTimeTo);
                }, failure: function(xhr){
                    console.log(xhr);
                }
            });
        }
    </script>
</html>