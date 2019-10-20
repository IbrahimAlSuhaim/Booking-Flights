<?php
  session_start();
  if(!isset($_SESSION['departure_flight'])) {
    $_SESSION['error'] = 'some error occured, We sorry -.-!. Try again';
    header('Location: ./index#search');
    exit();
  }
  $departure_flight = $_SESSION['departure_flight'];
  $departure_flight_id = $_GET['id'];
  $origin = $departure_flight['origin'];
  $destination = $departure_flight['destination'];
  $directionality = $departure_flight['directionality'];
  $departure_date = $departure_flight['departure_date'];
  $return_date = $departure_flight['return_date'];
  $passengers = $departure_flight['passengers'];
  $class = $departure_flight['class'];
  $next = 'passenger';

  include 'connectToDB.php';

  function getDuration($a , $b) {
    $start = strtotime($a);
    $end = strtotime($b);
    $time = (int)(($end - $start) / 60);

    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return $hours.'h '.$minutes.'m';
  }
  function getPrice($type) {
    if($type==='Guest'){
      return 105.40;
    }
    else if ($type==='Business'){
      return 135.40;
    }
    else {
      return 165.40;
    }
  }
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
            <span>3</span>
          </a>
          <p class="font-weight-bold">Passenger</p>
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
          <hr>';
    ?>
    <section class="section pb-0 section-components mt-5">
      <div class="container mb-5">
        <h3 class="h4 font-weight-bold mb-4">Passengers information</h3>
        <h5>Passenger 1</h5>
        <form class="" action="" method="post">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="first_name">First Name:*</label>
                <input class="form-control" placeholder="First name" type="text" id="first_name" name="first_name" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input class="form-control" placeholder="Middle name" type="text" id="middle_name" name="middle_name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="family_name">Family Name:*</label>
                <input class="form-control" placeholder="Family name" type="text" id="family_name" name="family_name" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="nationality">Nationality:*</label>
                <select class="form-control form-control-sm" id="nationality" name="nationality" required>
                  <option selected value="" disabled>Nationality</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="document_type">Type of identification:*</label>
                <select class="form-control form-control-sm" id="document_type" name="document_type" required>
                  <option selected value="" disabled>Document Type</option>
                  <option value="passport">Passport</option>
                  <option value="national_id">Natinal identity card</option>
                  <option value="iqama">Iqama</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="document_number">Document Number:*</label>
                <input class="form-control" placeholder="Document Number" type="text" id="document_number" name="document_number" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label>Date of Birth:*</label>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control form-control-sm" id="birth_day" name="birth_day" required>
                      <option selected value="" disabled>Day</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <select class="form-control form-control-sm" id="birth_month" name="birth_month" required>
                    <option selected value="" disabled>Month</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select class="form-control form-control-sm" id="birth_year" name="birth_year" required>
                    <option selected value="" disabled>Year</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 pt-1">
              <label for="gender">Gender:*</label>
              <div class="row">
                <div class="col-md-2 mt-1">
                  <div class="custom-control custom-radio ml-2" id="gender">
                    <input type="radio" class="custom-control-input" id="male" name="gender" value="male" required>
                    <label class="custom-control-label" for="male">Male</label>
                  </div>
                </div>
                <div class="col-md-2 mt-1">
                  <div class="custom-control custom-radio ml-2" id="gender">
                    <input type="radio" class="custom-control-input" id="female" name="gender" value="female" required>
                    <label class="custom-control-label" for="female">Female</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <h6>Contact information</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="country_code">Country Code:*</label>
                <select class="form-control form-control-sm" id="country_code" name="country_code" required>
                  <option selected value="" disabled>Country code</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="number">Number:*</label>
                <input class="form-control" placeholder="566334477" type="text" id="number" name="number" required>
                <small class="text-muted">without a leading zero for example: 566334477</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="number">Email:*</label>
                <input class="form-control" placeholder="email" type="email" id="email" name="email" required>
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-md-1">
              <button class="btn btn-1 btn-primary" type="submit" name="submit">Go!</button>
            </div>
          </div>
        </div>
        </form>
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
