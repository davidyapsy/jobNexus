<?php
session_start();
if($_SESSION['customerLoggedIn']==true){
    
    ?>

<html>
    <head>
        <title>Gogo Airline</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            .select-option{
                width:30%;
                padding:5px;
                border-color:rgb(230, 230, 230);
            }
            #searchBar{
                position: absolute;
                left: 0px;
                top: 60px;
                z-index: 1;
            }
            .row{
                margin-left:0px;
                margin-right:0px;
            }
            body{
                background-color:#e6e8e6;
            }
            fieldset.searchSchedule {
/*                border: 1px ;
                border-style : solid;
                border-color: black;*/
                padding: 30px 30px 30px 30px;
                margin: 15px 30px 0px 0px ; 
                width:100%;
            }
            .banner{
                margin-top:50px;
            }
            #mydiv {
                background-image: url("homepage.png");
                background-color: #cccccc;


           }
        </style>
      <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(3.1347388908623515, 101.68567989525806),
                zoom: 15,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var markerPosition = new google.maps.LatLng(3.1347388908623515, 101.68567989525806);
            var marker = new google.maps.Marker({
                position: markerPosition,
                map: map
            });
        }
</script>
    </head>

    <body>
        <!--Top Nav-->
         <nav class="navbar navbar-expand-sm bg-white navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/flight_ticketing_system/Home_Page/index.php">GOGO AIRPLANE</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto d-flex">
                    <li class="nav-item ms-auto">
                        <a class="ms-auto nav-link active" href="/flight_ticketing_system/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        </nav>
        <!--End Top Nav-->
         <div id="mydiv" style="border:1px solid black; padding:130px;">
        <fieldset class="searchSchedule" id="searchBar">
            <form action="../Schedule/departureSchedule.php" method="post">
                <div class="row" >
                      <div class="col-lg-3">
                    <div class="form-floating">
                        <select class="form-select" id="trip" name="trip" onchange="disableReturnDate()">
                            <option value="Round">Round Trip</option>
                            <option value="One">One Way</option>
                          </select>
                    <label for="trip">Trip</label>
                    </div>
                </div>
               
                    <div class="col-lg-4">
                    <div class="form-floating" >
                      <select class="form-select" id="departure" name="departure" required>
                        <option value="">----------</option>
                        <option value="KLIA2">KLIA2</option>
                        <option value="Haneda">Haneda</option>
                        <option value="Indira Gandhi">Indira Gandhi</option>
                        <option value="Orlando">Orlando</option>
                        <option value="Changi">Changi</option>
                        <option value="Istanbul">Istanbul</option>
                        <option value="Beijing">Beijing</option>
                      </select>
                      <label for="departure" class="form-label">Departure</label>
                    </div>          
                  </div>
                  <div class="col-lg-4">
                    <div class="form-floating" >
                      <select class="form-select" id="destination" name="destination" required>
                        <option value="">----------</option>
                        <option value="KLIA2">KLIA2</option>
                        <option value="Haneda">Haneda</option>
                        <option value="Indira Gandhi">Indira Gandhi</option>
                        <option value="Orlando">Orlando</option>
                        <option value="Changi">Changi</option>
                        <option value="Istanbul">Istanbul</option>
                        <option value="Beijing">Beijing</option>
                      </select>
                      <label for="destination" class="form-label">Destination</label>
                    </div>          
                  </div>         
                 </div>
                <div class="row my-2">
                      <div class="col-lg-3">
                    <div class="form-floating">
                        <select class="form-select" name="guests">
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5 Guests</option>
                        </select>
                       <label for="guests">Guests</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="depart_date" name="depart_date" placeholder="DD/MM/YYYY" min="<?php echo date('Y-m-d'); ?>" required value="<?php echo $departureDate; ?>" onchange="setMinReturnDate()"> 
                      <label for="depart_date">Departure Date</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="return_date" name="return_date" placeholder="DD/MM/YYYY" min="<?php echo date('Y-m-d'); ?>" required value="<?php echo $returnDate; ?>"onchange="checkReturnDate()"> 
                        <label for="return_date">Return Date</label>
                    </div>
                </div>
                </div>

                <button type="submit" class="btn btn-primary float-right">Search</button>
            </form>
        </fieldset>
        </div>
        <div class="banner" >
            <div class="container my-5">
<!--                Banner Section-->
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-70" src="/flight_ticketing_system/Home_Page/adv1.png" alt="First slide" style="margin-left:200px;">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-70" src="adv2.png" alt="Second slide"  style="margin-left:200px;">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
<!--                End Banner Section-->
            </div>
        </div>
<!--                  <h2 style=" font-family: Abril Fatface; text-align:center;"><b>Welcome aboard Gogo Flight ! </b></h2>-->
            <p  style="margin-left:100px;">At Gogo, we understand that your flying experience is important to you. That's why we are committed to making your journey delightful, comfortable, and hassle-free from start to finish.</p>
            <div style="display:flex;">   
            <div style="border:1px solid black; margin:0px 20px 20px 100px; padding:20px;">
                            <h5><b>Comfortable Seat</b></h5>
                We take pride in providing spacious seats designed for all shapes and sizes, ensuring your utmost comfort during your flight. Our classy and minimalist design will make you feel right at home in the sky.
            </div>
            <div style="border:1px solid black;margin:0px 100px 20px 0px; padding:20px;">
                <h5><b>Trust us to be on time, every time.</b></h5>
                At Gogo, we understand that time is precious, and that's why we strive to fly on-time, every time. We know that even a minute can make a difference, and we are committed to ensuring that you reach your destination on schedule.
            </div>
            </div>
            <p  style="margin:5px 5px 20px 100px;">Thank you for choosing Gogo Flight. We can't wait to welcome you onboard and make your flying experience unforgettable.</p>
    </body>
    <!-- Footer -->
    <footer class="bg-light text-center text-dark">
        <!-- Grid container -->
        <div class="container p-4 pb-0" >
            <div class="row">
                 <div class="col-md-6">
            <h6 style="margin-top:10px;">We Accept :</h6>
            <img src="paypal.png" alt="Paypal" style="width:20%;height:130px;">
            <h6 style="margin-top:80px;">Contact Us:</h6>
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-dark btn-floating m-1" href="https://www.w3schools.com" role="button"
                   ><i class="fa fa-facebook"></i
                    ></a>

                <!-- Twitter -->
                <a class="btn btn-outline-dark btn-floating m-1" href="https://www.w3schools.com" role="button"
                   ><i class="fa fa-twitter"></i
                    ></a>

                <!-- Google -->
                <a class="btn btn-outline-dark btn-floating m-1" href="https://www.w3schools.com" role="button"
                   ><i class="fa fa-google"></i
                    ></a>

                <!-- Instagram -->
                <a class="btn btn-outline-dark btn-floating m-1" href="https://www.w3schools.com" role="button"
                   ><i class="fa fa-instagram"></i
                    ></a>

                <!-- Linkedin -->
                <a class="btn btn-outline-dark btn-floating m-1" href="https://www.w3schools.com" role="button"
                   ><i class="fa fa-linkedin"></i
                    ></a>

                <!-- Github -->
                <a class="btn btn-outline-dark btn-floating m-1" href="#!" role="button"
                   ><i class="fa fa-github"></i
                    ></a>
            </section>
              </div>
                  <div class="col-md-6">
            <!-- Section: Social media -->
              <h6>Find Us At: </h6>
            <div id="googleMap" style="width:80%;height:300px; margin-left:20px; margin-bottom:20px;"></div>
        </div>
                 </div>
               </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->


</html>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwplG9TFG2yDu_lHaA5znPGpII3U090YE&callback=myMap"></script>
<script>

// Selectors
const departure = document.getElementById('departure');
const destination = document.getElementById('destination');
const tripSelect = document.getElementById('trip');
const returnDateInput = document.getElementById('return_date');
const departDateInput = document.getElementById('depart_date');

// Event listeners
departure.addEventListener('change', checkDepartureAndDestination);
destination.addEventListener('change', checkDepartureAndDestination);
tripSelect.addEventListener('change', disableReturnDate);
departDateInput.addEventListener('change', setMinReturnDate);
returnDateInput.addEventListener('change', checkReturnDate);

// Functions
function checkDepartureAndDestination() {
  if (departure.value && destination.value && departure.value === destination.value) {
    alert('Departure and destination cannot be the same.');
    // Reset selection
    departure.value = '';
    destination.value = '';
  }
}

function disableReturnDate() {
  returnDateInput.disabled = tripSelect.value === 'One';
}

function setMinReturnDate() {
  returnDateInput.min = departDateInput.value;
}

function checkReturnDate() {
  const departDate = new Date(departDateInput.value);
  const returnDate = new Date(returnDateInput.value);
  if (returnDate < departDate) {
    alert('Return date cannot be earlier than departure date.');
    returnDateInput.value = '';
  }
}
</script>

<?php }else{
    header("Location: /flight_ticketing_system/login.html");

    }?>