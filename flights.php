<?php
  session_start();
  if(!isset($_POST['from'])) {
    $_SESSION['error'] = 'some error occured, We sorry -.-!. Try again';
    header('Location: ./index#search');
    exit();
  }
  $origin = $_POST['from'];
  $destination = $_POST['to'];
  $directionality = $_POST['directionality'];
  $departure_date = $_POST['departure_date'];
  $return_date = "";
  $passengers = $_POST['passengers'];
  $class = $_POST['class'];
  $next = 'd_passenger';

  include 'connectToDB.php';

  if ($directionality == 'return') {
    $return_date = $_POST['return_date'];

    $sql="SELECT * FROM flights WHERE departure_date LIKE '$return_date' AND `to`='$origin' AND `from`='$destination' AND reserved+'$passengers' <= capacity";
    $result=$con->query($sql);
    if($result->num_rows==0) {
      $_SESSION['error'] = "Sorry we couldn't find any return flights in the specified date";
      header("Location: index#search");
      exit();
    }
    $next = 'f_return';
  }
  // to be used in returnflights
  $_SESSION['departure_flight'] = array("origin"=>$origin, "destination"=>$destination,
    "directionality"=>$directionality, "departure_date"=>$departure_date,
    "return_date"=>$return_date, "passengers"=>$passengers, "class"=>$class);


  $sql="SELECT * FROM flights WHERE departure_date LIKE '$departure_date' AND `from`='$origin' AND `to`='$destination' AND reserved+'$passengers' <= capacity";
  $result=$con->query($sql);
  if($result->num_rows==0) {
      $_SESSION['error'] = "Sorry we couldn't find any departure flight";
      header("Location: index#search");
      exit();
  }

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
          <div class="row justify-content-center row-grid">
            <div class="col-12">
              <h3>Select your departure flight</h3>
            </div>';?>
    <!-- //TODO: -->

            <div class="container my-5 d-flex justify-content-around align-items-center">
            <div class="mixLeft">
                <button type="button" data-filter="all" class="btn btn-sm btn-1 btn-primary">All</button>
                <button type="button" data-filter=".SV" class="btn btn-sm btn-1 btn-primary">Saudi Airline</button>
                <button type="button" data-filter=".XY" class="btn btn-sm btn-1 btn-primary">Flynas</button>
            </div>

            <div class="mixRight">
                <button type="button" data-sort="order:asc" class="btn btn-sm btn-1 btn-primary">Ascending</button>
                <button type="button" data-sort="order:descending" class="btn btn-sm btn-1 btn-primary">Descending</button>
            </div>
            </div>


    <!-- //TODO: -->

                    <div id="container">
            <?php
            while($row=mysqli_fetch_array($result)){
              echo '
              <div class="col-lg-12 col-sm-12 text-center py-3 mix '.$row['carrier'].'" data-order="'.($row['price_factor']*getPrice($class)).'">
                <div class="card card-lift shadow border-0">
                  <div class="card-body py-3" >
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
                    <div class="row justify-content-between" >
                      <div class="col-lg-4 col-sm-4">
                        <img src="./assets/img/carriers/'.$row['carrier'].'.png" alt=carrier: "'.$row['carrier'].'" title="'.$row['carrier'].'">
                      </div>
                      <div class="col-lg-4 col-sm-4">
                        <p class="font-weight">Class: '.$class.'</p>
                      </div>
                      <div class="col-lg-4 col-sm-4 " >
                        <p class="font-weight-bold">Price: '.($row['price_factor']*getPrice($class)).' SR</p>
                      </div>
                      <div class="col-lg-12 col-sm-12">
                        <button onClick="handleChooseFlight(`'.$next.'`,`'.$row['flight_id'].'`)" class="btn btn-1 btn-warning" type="button">Select</button>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            ';
            }

            ?>
                            </div>
            <?php
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
  <!-- else -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.js"></script>
  <script>
  
  var mixer = mixitup('#container');

  </script>
</body>

</html>
