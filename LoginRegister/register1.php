<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <title>Job Nexus | Register</title>
        <link rel="icon" type="image/x-icon" href="..\Pic/JobNexus_Logo.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <style>
            .topnav{
                background-color: white;
                overflow: hidden;
            }
            .topnav a {
                float: left;
                color: black;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }
            .topnav a:hover {
               color: #BABBDE;
            }
            .btn{
                background-color: #BABBDE;
            }
            .btn:hover{
                background-color: #b0b1d1;
            }
        </style>
    </head>
    
    <body style="background-color:#dfe2e6;">
        <div class="topnav">
            <a href="..\index.php"><h5>Job Nexus</h5></a>
        </div>
        
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 mt-4">
                    <div class="card text-black" style="border-radius: 30px;">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 order-2 order-lg-1">

                                    <p class="text-center h2 fw-bold mb-1">Register</p>
                                    <p class="text-center">Please enter your information</p>
                                    <!--<p><small>note: You can enter or select multiple option if you have Double Degree. Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</small></p>-->
                                    <form class="mx-md-1" action="..\registerFunctions.php" method="post">
                                        <label class="h5 fw-bold">Education</label>
                                        
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="profileDisplay flex-fill w-100">
                                                <input type="text" id="institution" class="form-control" name="institution" placeholder="eg: TARUMT, UM">
                                                <label>Institution</label>
                                            </div>
                                            
                                            <div class="profileDisplay flex-fill m-1 w-100">
                                                <select class="form-control" name='fieldStudy' id="fieldStudy">
                                                    <option value='Business'>Business</option>
                                                    <option value='Finance'>Finance</option>
                                                    <option value='Creative Arts, Design, Architecture'>Creative Arts, Design, Architecture</option>
                                                    <option value='Engineering'>Engineering</option>
                                                    <option value='Health Science'>Health Science</option>
                                                    <option value='Hospitality, Tourism and Culinary'>Hospitality, Tourism and Culinary</option>
                                                    <option value='Computer Science, IT'>Computer Science, IT</option>
                                                    <option value='Law'>Law</option>
                                                    <option value='Social Science'>Social Science</option>
                                                  </select>
                                                <label>Field Of Study</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="profileDisplay flex-fill w-100">
                                                <select class="form-control" name='level' id="level">
                                                    <option value='Secondary School'>Secondary School</option>
                                                    <option value='Pre-University'>Pre-University (A-Levels, Foundation, Diploma or equivalent)</option>
                                                    <option value='Undergraduate'>Undergraduate (Bachelor's Degree or equivalent)</option>
                                                    <option value='Postgraduate'>Postgraduate (Master's Degree or equivalent or higher)</option>
                                                  </select>
                                                <label>Level</label>
                                            </div>
                                            
                                            <div class="profileDisplay flex-fill m-1 w-100">
                                                <select class="form-control" name="year" id="year">
                                                    <?php
                                                    $currentYear = date("Y"); // Get the current year
                                                    for ($year = ($currentYear- 40); $year <= ($currentYear + 5); $year++) {
                                                        $selected = ($year == 2023) ? 'selected' : ''; // Change 2023 to the desired default year
                                                        echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label>Graduation Year</label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <input type="submit" name="next1" class="submit btn col-4" value="Next">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        
        ?>
    </body>
</html>
