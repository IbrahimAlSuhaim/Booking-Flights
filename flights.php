<?php
  session_start();
  $origin = $_POST['from'];
  $destination = $_POST['to'];
  $directionality = $_POST['directionality'];
  $departure_date = $_POST['departure_date'];
  $return_date = "";
  if ($directionality == 'return') {
    $return_date = $_POST['return_date'];
  }
  $passengers = $_POST['passengers'];
  $class = $_POST['class'];
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
          <div class="row justify-content-center row-grid">
            <div class="col-12">
              <h3>Select your departure flight</h3>
            </div>

            <div class="col-lg-8 col-sm-12 text-center py-4">
              <div class="card card-lift--hover shadow border-0">
                <div class="card-body py-3">
                  <div class="row justify-content-center">
                    <div class="col-4">
                      <span class="d-block mb-1">02:30</span>
                      <span class="d-block mb-1">RUH</span>
                      <small class="d-block mb-1">(Riyadh)</small>
                    </div>
                    <div class="col-4">
                      <small class="d-block mb-1 text-success">Direct</small>
                      <hr>
                      <small class="d-block mb-1">Duration</small>
                      <small class="d-block mb-1">1h 40m</small>
                    </div>
                    <div class="col-4">
                      <span class="d-block mb-1">04:10</span>
                      <span class="d-block mb-1">JED</span>
                      <small class="d-block mb-1">(Jeddah)</small>
                    </div>
                  </div>
                  <hr>
                  <div class="row justify-content-between">
                    <div class="col-lg-4 col-sm-6">
                      <p class="font-weight-bold">Class: Guest</p>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                      <p class="font-weight-bold">Price: 460.75 SR</p>
                    </div>
                  </div>
                  <div class="row justify-content-end">
                    <div class="col-lg-4 col-sm-12">
                      <button class="btn btn-1 btn-warning" type="button">Select</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>';
          if ($directionality !== "oneWay") {
            echo '
            <div class="row justify-content-center row-grid">
              <div class="col-12">
                <h3>Select your return flight</h3>
              </div>

              <div class="col-lg-8 col-sm-12 text-center py-4">
                <div class="card card-lift--hover shadow border-0">
                  <div class="card-body py-3">
                    <div class="row justify-content-center">
                      <div class="col-4">
                        <span class="d-block mb-1">04:10</span>
                        <span class="d-block mb-1">JED</span>
                        <small class="d-block mb-1">(Jeddah)</small>
                      </div>
                      <div class="col-4">
                        <small class="d-block mb-1 text-success">Direct</small>
                        <hr>
                        <small class="d-block mb-1">Duration</small>
                        <small class="d-block mb-1">1h 40m</small>
                      </div>
                      <div class="col-4">
                        <span class="d-block mb-1">05:50</span>
                        <span class="d-block mb-1">RUH</span>
                        <small class="d-block mb-1">(Riyadh)</small>
                      </div>
                    </div>
                    <hr>
                    <div class="row justify-content-between">
                      <div class="col-lg-4 col-sm-6">
                        <p class="font-weight-bold">Class: Guest</p>
                      </div>
                      <div class="col-lg-4 col-sm-6">
                        <p class="font-weight-bold">Price: 460.75 SR</p>
                      </div>
                    </div>
                    <div class="row justify-content-end">
                      <div class="col-lg-4 col-sm-12">
                        <button class="btn btn-1 btn-warning" type="button">Select</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>';
          }
        echo '</div>
      ';
     ?>

  </main>
  <footer class="footer">
    <div class="container">
      <hr>
      <div class="row align-items-center justify-content-md-between">
        <div class="col-md-6">
          <div class="copyright">
            &copy; 2019 Flight Ticket Booking.
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
</body>

</html>
