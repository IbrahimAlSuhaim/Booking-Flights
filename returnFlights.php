<?php
  session_start();
  if(!isset($_SESSION['departure_flight']) || !isset($_GET['departure_id'])) {
    $_SESSION['error'] = 'some error occured, We sorry -.-!. Try again';
    header('Location: ./index#search');
    exit();
  }
  $departure_flight = $_SESSION['departure_flight'];
  $departure_flight_id = $_GET['departure_id'];
  $_SESSION['departure_flight'] = array("flight_id"=>$departure_flight_id) + $_SESSION['departure_flight'];// insert flight_id at the beginning of array $_SESSION['departure_flight']

  $origin = $departure_flight['origin'];
  $destination = $departure_flight['destination'];
  $directionality = $departure_flight['directionality'];
  $departure_date = $departure_flight['departure_date'];
  $return_date = $departure_flight['return_date'];
  $passengers = $departure_flight['passengers'];
  $class = $departure_flight['class'];
  $next = 'r_passenger';

  include 'connectToDB.php';
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
  <!-- Confirm CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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
            <span>2</span>
          </a>
          <p class="font-weight-bold">Flights</p>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link" role="tab" aria-selected="false">
            <span>3</span>
          </a>
          <p>Passenger</p>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link" role="tab" aria-selected="false">
            <span>4</span>
          </a>
          <p>Seats</p>
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
    <?php
      echo '
        <div class="container mb-5">
          <div class="row">
            <div class="col-2">
              <span class="d-block mb-1 font-weight-bold">'.$origin.'</span>
              <small class="d-block mb-1"></small>
            </div>
            <div class="col-2">
              <i class="fa fa-long-arrow-right d-block" aria-hidden="true"></i>';
              if($directionality !== "oneWay") {
                echo '
                <i class="fa fa-long-arrow-left d-block" aria-hidden="true"></i>
                ';
              }
            echo '</div>
            <div class="col-2">
              <span class="d-block mb-1 font-weight-bold">'.$destination.'</span>
              <small class="d-block mb-1"></small>
            </div>
            <div class="col-2">
              <span class="d-block mb-1">Departure</span>
              <small class="d-block mb-1 font-weight-bold">'.$departure_date.'</small>
            </div>';
            if($directionality !== "oneWay") {
              echo '
              <div class="col-2">
                <span class="d-block mb-1">Return</span>
                <small class="d-block mb-1 font-weight-bold">'.$return_date.'</small>
              </div>
              ';
            }
            echo '<div class="col-2">
              <span class="d-block mb-1">Class: <b>'.$class.'</b></span>
              <span class="d-block mb-1">passengers: '.$passengers.'</span>
            </div>
          </div>
          <hr>
          <div class="row justify-content-center row-grid mt-3">
            <div class="col-12">
              <h3 id="return">Now select your return flight</h3>
            </div>';

          $sql="SELECT * FROM flights WHERE departure_date LIKE '$return_date' AND `to`='$origin' AND `from`='$destination' AND reserved+'$passengers' <= capacity";
          $result=$con->query($sql);
          if($result->num_rows==0) {
            echo '<p>No return flights available -.-!</p>';
            echo '<a href="./index#search">Try another date</a>';
          }

          while($row=mysqli_fetch_array($result)) {
            echo '
            <div class="col-lg-8 col-sm-12 text-center py-2">
              <div class="card card-lift shadow border-0">
                <div class="card-body py-3">
                  <div class="row justify-content-center">
                    <div class="col-4">
                      <span class="d-block mb-1">'.substr($row['departure_time'], 0, -3).'</span>
                      <span class="d-block mb-1">'.$row['from'].'</span>
                    </div>
                    <div class="col-4">
                      <small class="d-block mb-1 text-success">Direct</small>
                      <small class="d-block mb-1">Duration: '.getDuration($row['departure_time'], $row['arrival_time']).'</small>
                    </div>
                    <div class="col-4">
                      <span class="d-block mb-1">'.substr($row['arrival_time'], 0, -3).'</span>
                      <span class="d-block mb-1">'.$row['to'].'</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row justify-content-between">
                    <div class="col-lg-3 col-sm-4">
                      <img src="./assets/img/carriers/'.$row['carrier'].'.png" alt=carrier: "'.$row['carrier'].'" title="'.$row['carrier'].'">
                    </div>
                    <div class="col-lg-3 col-sm-4">
                      <p class="font-weight">Class: '.$class.'</p>
                    </div>
                    <div class="col-lg-3 col-sm-4">
                      <p class="font-weight-bold">Price: '.($row['price_factor']*getPrice($class)).' SR</p>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <button onClick="handleChooseFlight(`'.$next.'`,`'.$row['flight_id'].'`)" class="btn btn-1 btn-warning" type="button">Select</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>';

            }
          echo '</div>';

            echo '
            </div>';

        echo '
        </div>';
     ?>
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
</body>

</html>
