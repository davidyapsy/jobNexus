<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "db_jobnexus";

    $connection = new mysqli($serverName, $userName, $password, $database);
    // $companyId = base64_decode($_GET['id']);

    $sql = "SELECT employerID, companyName, contactPersonName, emailAddress, password, phoneNumber, address, numberOfEmployees, industry, state, aboutUs, logo, backgroundPicture, 
            officePicture, facebookUrl, linkedinUrl, whatsappUrl, status, dateJoined
            FROM employer
            WHERE employerID = 'E2300000'";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    $data =[];
    while(($row = $result->fetch_assoc())==TRUE){
        $data = $row;
    }

?>
<html>
    <head>
        <title>Gogo Airline</title>
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
        <link rel="stylesheet" href="assets/summernote/summernote.css">
        <link href="assets/css/content.css" type="text/css" rel="stylesheet">
        <style>
            .required{
                color:red;
            }
        </style>
    </head>

    <body>
        <?php require('topBar.php') ?>
        <?php require('sideNav.php') ?>

        <div class="main">
            <div class="panel panel-bordered p-2">
                <div class="panel-heading p-2">
                    <div class="row">
                        <div class="col-12">
                            <h3>Company Profile</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body bg-white p-2 rounded">
                    <h4 style="padding:10px;"><i class="bi bi-person-fill px-2"></i>Profile Details</h4>
                    <hr>
                    <form id="form_details" action="" method="post" >
                        <input type="hidden" id="companyId" name="companyId" value=" <?= base64_encode($companyId);?>">
                        <div class="form-group row">
                            <label for="companyName" class="col-sm-3 col-form-label">Company Name: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="companyName" id="companyName" value="<?= $data['companyName'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contactPersonName" class="col-sm-3 col-form-label">Contact Person Name: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="contactPersonName" id="contactPersonName" value="<?= $data['contactPersonName'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emailAddress" class="col-sm-3 col-form-label">Email: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="input" class="form-control" name="emailAddress" id="emailAddress" value="<?= $data['emailAddress'];?>"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"> 
                                    <span class="input-group-text" onclick="toggleVisibility('password', 'passwordVisibility')">
                                        <i id="passwordVisibility" class='bi bi-eye-slash'></i>
                                    </span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"> 
                                    <span class="input-group-text" onclick="toggleVisibility('confirmPassword', 'confirmPasswordVisibility')">
                                        <i id="confirmPasswordVisibility" class="bi bi-eye-slash"></i>
                                    </span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Phone Number: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        +60
                                    </span>
                                    <input type="input" class="form-control" name="phoneNumber" id="phoneNumber" value="<?= $data['phoneNumber'];?>"/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address: <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="address" id="address" rows="3"><?= $data['address'];?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Number Of Employees: <span class="required">*</span> </label>
                            <div class="col-sm-9">
                                <select class="form-select" id="numberOfEmployees" name="numberOfEmployees">
                                    <option value=""> -- Please select number of employees. -- </option>
                                    <option value="10-50" <?= $data['numberOfEmployees']=='10-50'? 'selected':'';?>>10-50</option>
                                    <option value="50-100" <?= $data['numberOfEmployees']=='50-100'? 'selected':'';?>>50-100</option>
                                    <option value="100-500" <?= $data['numberOfEmployees']=='100-500'? 'selected':'';?>>100-500</option>
                                    <option value="> 500" <?= $data['numberOfEmployees']=='> 500'? 'selected':'';?>>> 500</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Number Of Employees: <span class="required">*</span> </label>
                            <div class="col-sm-3">
                                <select class="form-select" id="numberOfEmployees" name="numberOfEmployees">
                                    <option value=""> -- Please select number of employees. -- </option>
                                    <option value="Accounting/Finance" <?= $data['numberOfEmployees']=='10-50'? 'selected':'';?>>10-50</option>
                                    <option value="Admin/Human Resources" <?= $data['numberOfEmployees']=='50-100'? 'selected':'';?>>50-100</option>
                                    <option value="Sales/Marketing" <?= $data['numberOfEmployees']=='100-500'? 'selected':'';?>>100-500</option>
                                    <option value="> 500" <?= $data['numberOfEmployees']=='> 500'? 'selected':'';?>>> 500</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">State: <span class="required">*</span> </label>
                            <div class="col-sm-3">
                                <select class="form-select" id="state" name="state">
                                    <option value=""> -- Please select a state. -- </option>
                                    <option value="Selangor" <?= $data['state']=='Selangor'? 'selected':'';?>>Selangor</option>
                                    <option value="Kuala Lumpur" <?= $data['state']=='Kuala Lumpur'? 'selected':'';?>>Kuala Lumpur</option>
                                    <option value="Sabah" <?= $data['state']=='Sabah'? 'selected':'';?>>Sabah</option>
                                    <option value="Kelantan" <?= $data['state']=='Kelantan'? 'selected':'';?>>Kelantan</option>
                                    <option value="Sarawak" <?= $data['state']=='Sarawak'? 'selected':'';?>>Sarawak</option>
                                    <option value="Pahang" <?= $data['state']=='Pahang'? 'selected':'';?>>Pahang</option>
                                    <option value="Kedah" <?= $data['state']=='Kedah'? 'selected':'';?>>Kedah</option>
                                    <option value="Terengganu" <?= $data['state']=='Terengganu'? 'selected':'';?>>Terengganu</option>
                                    <option value="Negeri Sembilan" <?= $data['state']=='Negeri Sembilan'? 'selected':'';?>>Negeri Sembilan</option>
                                    <option value="Perak" <?= $data['state']=='Perak'? 'selected':'';?>>Perak</option>
                                    <option value="Johor" <?= $data['state']=='Johor'? 'selected':'';?>>Johor</option>
                                    <option value="Malacca" <?= $data['state']=='Malacca'? 'selected':'';?>>Malacca</option>
                                    <option value="Penang" <?= $data['state']=='Penang'? 'selected':'';?>>Penang</option>
                                    <option value="Perlis" <?= $data['state']=='Perlis'? 'selected':'';?>>Perlis</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- Panel Standard Editor -->
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">State: <span class="required">*</span> </label>
                            <div class="col-sm-3">
                                <div id="summernote" data-plugin="summernote">
                                    <h2>WYSIWYG Editor</h2> Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit. Aliquam ullamcorper sapien non nisl facilisis bibendum
                                    in quis tellus. Duis in urna bibendum turpis pretium fringilla.
                                    Aenean neque velit, porta eget mattis ac, imperdiet quis nisi.
                                    Donec non dui et tortor vulputate luctus. Praesent consequat
                                    rhoncus velit, ut molestie arcu venenatis sodales.
                                    <h4>Lacinia</h4>
                                    <ul>
                                        <li>Suspendisse tincidunt urna ut velit ullamcorper fermentum.</li>
                                        <li>Nullam mattis sodales lacus, in gravida sem auctor at.</li>
                                        <li>Praesent non lacinia mi.</li>
                                        <li>Mauris a ante neque.</li>
                                        <li>Aenean ut magna lobortis nunc feugiat sagittis.</li>
                                    </ul>
                                    <h4>Pellentesque Adipiscing</h4> Maecenas quis ante ante. Nunc adipiscing
                                    rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus
                                    ultrices ac. Pellentesque sodales, libero et mollis interdum,
                                    dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc.
                                    Sed porttitor leo adipiscing venenatis vehicula. Aenean quis
                                    viverra enim. Praesent porttitor ut ipsum id ornare.
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- End Panel Standard Editor -->
                        

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick ="submitConfirmation()" class="btn btn-primary" style="float:right;">Save</button>
                                <button type="button" onclick="backConfirmation()" class="btn btn-danger btn-outline">Back</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/summernote/summernote.min.js"></script>
        <script src="assets/summernote/summernote.js"></script>
        <script src="assets/summernote/editor-summernote.js"></script>
    </body>
    <!-- Footer -->

    <!-- Footer -->

    <script>
        let url = "flight_schedule_controller.php";
        let chkedDepartureDay = '<?php echo $data['departure_day'];?>';

        $( window ).on( "load", function() {
            $("#chk"+'<?php echo $data['departure_day'];?>').click();
        } );

        $('.departure_day').click(function(){     
            if(this.checked == true){
                chkedDepartureDay = this.value;
                $('.departure_day').attr('disabled', true);
                $(this).attr('disabled', false);
                $(this).attr('checked', true);      
            }else{
                chkedDepartureDay = "";
                $(this).attr('checked', false);      
                $('.departure_day').attr('disabled', false);
            }    
        });

        function generateDestination(){
            $('#destination')
                .find('option')
                .remove()
                .end()
                .append('<option value="">-- Please select a destination. --</option>');

            $.ajax({
                type: "POST",
                contentType: "application/x-www-form-urlencoded",
                url: url,
                data: { 
                    mode: "generateDestination",
                    origin :  $("#origin").val()
                }, success: function (response) {
                const data = response;
                if (data.status) {
                    let records = data.data;
                    $.each(records, function (i, record) {
                        $('#destination').append($('<option>', { 
                            value: record['destination'],
                            text : record['destination']
                        }));
                    });
                } else {
                    console.log("something wrong");
                }
            }, failure: function (xhr) {
                console.log(xhr.status);
            }

        });
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
                    window.location.href = "flight_schedule_index.php"
                }
                
            });
        }

        function submitConfirmation(){
            Swal.fire({
                title: "Are you sure to save it?",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    submitValidate();
                }
            });
        }

        function submitValidate(){
            $('.is-invalid').removeClass('is-invalid');

            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "check_validation",
                    type: "edit",
                    airplaneId : $("#planeName").val(),
                    origin : $("#origin").val(),
                    destination : $("#destination").val(),
                    departureDay : chkedDepartureDay,
                    departureTime : $("#departureTime").val(),
                    price : $('#price').val(),
                    startingDate : $('#scheduleStartDate').val()
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
                        updateRecord();
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }

        function updateRecord() {
            $.ajax({
                type: "post",
                url: url,
                contentType:"application/x-www-form-urlencoded",
                data: {
                    mode: "update",
                    companyId : $('#companyId').val(),
                    airplaneId : $("#planeName").val(),
                    origin : $("#origin").val(),
                    destination : $("#destination").val(),
                    departureDay : chkedDepartureDay,
                    departureTime : $("#departureTime").val(),
                    price : $('#price').val(),
                    startingDate : $('#scheduleStartDate').val()
                }, success: function (response) {
                    const data = response;
                    if (data.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Record successfully updated! ',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                    } else {
                    }
                }, failure: function (xhr) {
                    console.log(xhr.status);
                }
            })
        }
    </script>
</html>