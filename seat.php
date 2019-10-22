<?php
  session_start();
  if(!isset($_SESSION['departure_flight'])) {
    $_SESSION['error'] = 'some error occured, We sorry -.-!. Try again';
    header('Location: ./index#search');
    exit();
  }
  $passengers = $_SESSION['departure_flight']['passengers'];
  $listPassengers = [];
  for ($i=1; $i <= $passengers ; $i++) {
    $birth_date = $_POST["birth_year_$i"] . '-' . $_POST["birth_month_$i"] . '-' . $_POST["birth_day_$i"];
    $number = $_POST["country_code_$i"] . $_POST["number_$i"];

    $passenger = array("first_name_$i"=>$_POST["first_name_$i"],"middle_name_$i"=>$_POST["middle_name_$i"], "family_name_$i"=>$_POST["family_name_$i"],
    "nationality_$i"=>$_POST["nationality_$i"], "document_type_$i"=>$_POST["document_type_$i"], "document_number_$i"=>$_POST["document_number_$i"],
    "birth_date_$i"=>$birth_date, "gender_$i"=>$_POST["gender_$i"], "number_$i"=>$number, "email_$i"=>$_POST["email_$i"]) ;
    $listPassengers+=  $passenger;
  }
  //to be used later
  // So until here we have in $_SESSION : 'departure_flight', 'departure_flight_id', and maybe 'return_flight_id'
  $_SESSION['list_passengers'] = $listPassengers;

  $next = 'payment';


  include './assets/helper.php';
?>
<!--

=========================================================
* Argon Design System - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Book flight tickets">
  <meta name="author" content="SWE444 Project">
  <title>SELECT YOUR FLIGHT(S)</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.1.0" rel="stylesheet">
</head>

<body>
  <?php include 'header.php' ?>
  <main>
    <div class="position-relative">
      <!-- Hero for FREE version -->
      <section class="section section-lg section-shaped pb-100">
        <!-- Background circles -->
        <div class="shape shape-style-1 shape-default">
          <span class="span-50"></span>
          <span class="span-50"></span>
          <span class="span-75"></span>
          <span class="span-100"></span>
          <span class="span-75"></span>
          <span class="span-50"></span>
          <span class="span-100"></span>
          <span class="span-50"></span>
          <span class="span-100"></span>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew zindex-100">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </section>
    </div>
    <div class="row justify-content-center text-center">
      <ul class="nav nav-pills nav-pills-circle" role="tablist">
        <li class="nav-item mx-4">
          <a class="nav-link active" role="tab" aria-selected="true">
            <span><i class="fa fa-check" aria-hidden="true"></i></span>
          </a>
          <p>Search</p>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link active" role="tab" aria-selected="true">
            <span><i class="fa fa-check" aria-hidden="true"></i></span>
          </a>
          <p class="font-weight">Flights</p>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link active" role="tab" aria-selected="false">
            <span><i class="fa fa-check" aria-hidden="true"></i></span>
          </a>
          <p class="font-weight">Passenger</p>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link active" role="tab" aria-selected="false">
            <span>4</span>
          </a>
          <p class="font-weight-bold">Seats</p>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link" role="tab" aria-selected="false">
            <span>5</span>
          </a>
          <p>Payment</p>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link" role="tab" aria-selected="false">
            <span>6</span>
          </a>
          <p>Confirmation</p>
        </li>
      </ul>
    </div>
    <hr>
    <section class="section pb-0 section-components mt-5 text-center">
      <div class="container mb-5">
        <p class="display-3 text-center pb-5">Coming Soon!</p>

        <a class="btn btn-1 btn-primary" href="./payment">Go to payment!</a>
      </div>
    </section>
  </div> <!--end of container-->
  </main>
  <footer class="footer">
    <div class="container">
      <hr>
      <div class="row align-items-center justify-content-md-between">
        <div class="col-md-6">
          <div class="copyright">
            &copy; 2019 Book Flights
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Core -->
  <script src="./assets/vendor/jquery/jquery.min.js"></script>
  <script src="./assets/vendor/popper/popper.min.js"></script>
  <script src="./assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="./assets/vendor/headroom/headroom.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/onscreen/onscreen.min.js"></script>
  <script src="./assets/vendor/nouislider/js/nouislider.min.js"></script>
  <script src="./assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.1.0"></script>
  <!-- jquery-confirm -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script src="./assets/js/flights.js"></script>
  <!-- Confirm CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</body>

</html>
