<?php
    session_start();
    $transactionStatus = isset($_GET['status'])?$_GET['status']:"";
    $startDate = isset($_GET['startDate'])?$_GET['startDate']:"";
    $endDate = isset($_GET['endDate'])?$_GET['endDate']:"";
    $paymentMethod = isset($_GET['paymentMethod'])?$_GET['paymentMethod']:"";
    
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    $subscriptionPlanID = base64_decode($_GET['id']);

    //employerID
    $sql = "SELECT *
            FROM subscription_plan
            WHERE subscriptionPlanID = '$subscriptionPlanID'";

    $result = $connection->query($sql);
    $data =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $data = $row;
    }
    
    
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
                    <div class="data">
                        <div class="col-12">
                            <h3>Subscription / Order Summary</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Subscription Details</h4>
                    <hr>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Package Name</th>
                                <th scope="col">Package Price (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <b><?=$data['planName']?></b></br>
                                    <u>Package Details</u>
                                    <ul>
                                        <li>Flexible to post, report & edit <?= $data['maxJobPosting']?> jobs for <?= $data['validityPeriod']?></li>
                                        <li>Flexible to manage <?= $data['maxJobApplication']?> applications for each job</li>
                                        <?php if($data['applicationRankingAvailability']==1){ ?>
                                            <li>Job application ranking availability</li>
                                        <?php } ?>
                                        <?php if($data['maxFeatureJobListing']>=1){ ?>
                                            <li>Total <?=$data['maxFeatureJobListing']?> modifiable feature job listing</li>
                                        <?php } ?>
                                        <li id="validDateRange">Valid From dd/mm/yyyy To dd/mm/yyyy.</li>
                                    </ul>
                                </td>
                                <td class="align-middle text-center">
                                    <?=number_format($data['price'])?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-end">Subtotal: </td>
                                <td class="align-middle text-center"><?=number_format($data['price'])?></td>
                            </tr>
                            <tr>
                                <td class="text-end">SST: </td>
                                <td class="align-middle text-center"><?=number_format($data['price']*0.1)?></td>
                            </tr>
                            <tr>
                                <td class="text-end"><b>Grant Total: </b></td>
                                <td class="align-middle text-center"><?=number_format($data['price']*1.1)?></td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="pb-3">

                    <form id="form_details" method="post">
                        <input type="hidden" class="form-control" name="subscriptionPlanID" id="subscriptionPlanID" value="<?=base64_encode($subscriptionPlanID)?>"/>
                        <input type="hidden" class="form-control" name="endDate" id="endDate"  min="<?= date('Y-m-d'); ?>"/>
                        <input type="hidden" class="form-control" name="subtotalAmount" id="subtotalAmount"  value="<?=$data['price']?>'"/>
                        <input type="hidden" class="form-control" name="taxAmount" id="taxAmount"  value="<?=$data['price']*0.1?>'"/>
                        <input type="hidden" class="form-control" name="totalAmount" id="totalAmount"  value="<?=$data['price']*1.1?>'"/>


                        <div class="form-group row">
                            <label for="startDate" class="col-sm-3 col-form-label">Start Date: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="startDate" id="startDate" min="<?= date('Y-m-d'); ?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paymentMethod" class="col-sm-3 col-form-label">Payment Method: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="paymentMethod" name="paymentMethod" onchange="paymentMethodFunction()">
                                    <option value=""> -- Please select a payment method. -- </option>
                                    <option value="Online Banking">Online Banking</option>
                                    <option value="Credit / Debit Card">Credit / Debit Card</option>
                                    <option value="Paypal">Paypal</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row d-none" id="subPaymentMethod">
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick ="submitValidate()" id="obPayment"class="btn btn-primary float-end">Make Payment</button>
                        </div>
                    </div>
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
        let url = "subscription_controller.php";

        $(window).on("load",function(){
            var transactionStatus = "<?= $transactionStatus?>";
            if(transactionStatus=="success"){
                $("#startDate").val("<?=$startDate?>");
                $("#endDate").val("<?=$endDate?>");
                $("#paymentMethod").val("<?=$paymentMethod?>");

                createRecord();
            }else if(transactionStatus=="failed"){
                Swal.fire({
                    title: 'Transaction failed!',
                    text: 'Please contact technical staff! ',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            }
        });

        $('#startDate').change(function() {
            if($(this).val()){
                var oriStartDate = new Date($(this).val());
                var startDate = new Date($(this).val());
                var oriEndDate = new Date(startDate.setFullYear(startDate.getFullYear() + 1));

                var formattedStartDate = convertDateFormat(oriStartDate);
                var formattedEndDate = convertDateFormat(oriEndDate);

                $("#validDateRange").text('Valid From '+formattedStartDate+' To '+formattedEndDate);
                var endDate = formattedEndDate.split("/").reverse().join("-");
                $("#endDate").val(endDate);
            }else{
                $("#validDateRange").text('Valid From dd/mm/yyyy To dd/mm/yyyy.');
            }
        });

        function paymentMethodFunction() {
            var paymentMethod = $('#paymentMethod').val();

            if(paymentMethod=="Online Banking"){
                var text = "<label for='paymentMethod' class='col-sm-3 col-form-label'>Bank: <span class='required'>*</span> </label>"+
                            "<div class='col-sm-9'>"+
                                    "<select class='form-select' id='bank' name='bank'>"+
                                        "<option value=''> -- Please select a bank. -- </option>"+
                                        "<option value='Maybank2u'>Maybank2u</option>"+
                                        "<option value='CIMB Clicks'>CIMB Clicks</option>"+
                                        "<option value='Public Bank'>Public Bank</option>"+
                                        "<option value='RHB Now'>RHB Now</option>"+
                                        "<option value='Ambank'>Ambank</option>"+
                                        "<option value='MyBSN'>MyBSN</option>"+
                                        "<option value='Bank Rakyat'>Bank Rakyat</option>"+
                                        "<option value='UOB'>UOB</option>"+
                                        "<option value='Affin Bank'>Affin Bank</option>"+
                                        "<option value='Bank Islam'>Bank Islam</option>"+
                                        "<option value='HSBC Online'>HSBC Online</option>"+
                                        "<option value='Standard Chartered Bank'>Standard Chartered Bank</option>"+
                                        "<option value='Kuwai Finance House'>Kuwai Finance House</option>"+
                                        "<option value='Bank Muamalat'>cBank Muamalat</option>"+
                                        "<option value='OCBS Online'>OCBS Online</option>"+
                                        "<option value='Alliance Bank (Personal)'>Alliance Bank (Personal)</option>"+
                                        "<option value='Hong Leong Connect'>Hong Leong Connect</option>"+
                                        "<option value='Agrobank'>Agrobank</option>"+
                                    "</select>"+
                                    "<div class='invalid-feedback'></div>"+
                            "</div>";
                var text1 = "<button type='button' onclick ='submitConfirmation()' class='btn btn-primary float-end'>Make Payment</button>";
                $("#subPaymentMethod").removeClass("d-none");
                $("#subPaymentMethod").html(text);

            }else if(paymentMethod=="Credit / Debit Card" || paymentMethod=="Paypal"){
                $("#subPaymentMethod").addClass("d-none");

            }else{
                $("#subPaymentMethod").addClass("d-none");

            }
        }

        function convertDateFormat(inputDate){
            var date = inputDate.getDate();
            var month = inputDate.getMonth()+1;
            var year = inputDate.getFullYear();
            outputDate = date+"/"+month+"/"+year;
            return outputDate;
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
                    window.location.href = "subscription_plan.php"
                }
                
            });
        }

        function submitValidate(){
            $('.is-invalid').removeClass('is-invalid');
            var paymentMethod = $('#paymentMethod').val();
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "check_validation",
                    startDate: $("#startDate").val(),
                    endDate: $("#endDate").val(),
                    paymentMethod: paymentMethod
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
                        if(data.recordFound){
                           Swal.fire({
                                title: "Question",
                                text: "You are currently subscribed a plan, Do you want to replace with new plan?",
                                icon: "question",
                                showCancelButton: true,
                                confirmButtonText: "Confirm",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    if(paymentMethod=="Online Banking"){
                                        createRecord();
                                    }else{
                                        makePayment();
                                    }
                                }
                            });
                            
                        } else{
                            if(paymentMethod=="Online Banking"){
                                loading();
                                // createRecord();
                            }else{
                                makePayment();
                            }
                        }
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }

        function makePayment() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "make_payment",
                    subscriptionPlanID: $("#subscriptionPlanID").val(),
                    startDate : $("#startDate").val(),
                    endDate: $("#endDate").val(),
                    paymentMethod: $("#paymentMethod").val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        window.location.href=data.linkAddress;
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

        function loading(){
            let timerInterval;
            Swal.fire({
                title: "Processing!",
                timer: 5000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    createRecord();
                },
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        }

        function createRecord() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "create",
                    subscriptionPlanID: $("#subscriptionPlanID").val(),
                    startDate : $("#startDate").val(),
                    endDate: $("#endDate").val(),
                    subtotalAmount: <?=$data['price']?>,
                    taxAmount: <?=$data['price']*0.1?>,
                    totalAmount: <?=$data['price']*1.1?>,
                    paymentMethod: $("#paymentMethod").val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'You have successfully subscribed to a plan, Please check your email for receipt! Please login again.',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        }).then((result) => {
                            window.location.href= "/jobnexus/employer/security/logout.php";
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