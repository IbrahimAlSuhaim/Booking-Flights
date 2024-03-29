<?php
  session_start();
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
  <title>Book Flights System</title>
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
    <div class="position-relative">
      <!-- Hero for FREE version -->
      <section class="section section-lg section-hero section-shaped">
        <!-- Background circles -->
        <div class="shape shape-style-1 shape-primary">
          <span class="span-150"></span>
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
        <div class="container shape-container d-flex align-items-center py-lg">
          <div class="col px-0">
            <div class="row align-items-center justify-content-center">
              <div class="col-lg-6 text-center">
                <img alt="image" src="./assets/img/brand/white.png" style="width: 200px;" class="img-fluid">
                <p class="lead text-white">Welcome to our website</p>
                <a href="#search" class="btn btn-1 btn-primary" type>Book A trip</a>
              </div>
            </div>
          </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew zindex-100">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </section>
        <section class="section pb-0 section-components">
          <div class="container mb-5">
            <!-- Inputs -->
            <h3 class="h4 text-primary font-weight-bold mb-4" id="search">Search for tickets</h3>
            <form class="" action="./flights" method="post">
              <div class="row">
                <?php
                  if(isset($_SESSION['error'])){
                    echo '
                      <div class="col-12 mb-3">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <span class="alert-inner--icon"><i class="ni ni-support-16"></i></span>
                          <span class="alert-inner--text">'.$_SESSION['error'].'</span>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                      </div>
                      ';
                    unset($_SESSION['error']);
                  }
                 ?>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group">
                    <label for="inputGroupSelect01">From</label>
                    <div class="input-group mb-3">
                      <select class="custom-select" name="from" required>
                        <option selected disabled value="">Choose...</option>
                        <option>Riyadh (RUH)</option>
                        <option>Jeddah (JED)</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group">
                    <label for="inputGroupSelect01">To</label>
                    <div class="input-group mb-3">
                      <select class="custom-select" name="to" required>
                        <option selected disabled value="">Choose...</option>
                        <option>Riyadh (RUH)</option>
                        <option>Jeddah (JED)</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3">
                  <div class="custom-control custom-radio mb-3">
                    <input name="directionality" class="custom-control-input" id="return" value="return" type="radio" required>
                    <label class="custom-control-label" for="return"><span>Return</span></label>
                  </div>
                </div>
                <div class="col-3">
                  <div class="custom-control custom-radio mb-3">
                    <input name="directionality" class="custom-control-input" id="oneWay" value="oneWay" type="radio" required>
                    <label class="custom-control-label" for="oneWay"><span>One Way</span></label>
                  </div>
                </div>
              </div>
              <div class="row" id="date">
                <div class="col-md-12 mt-4 mt-md-0" id="departure_return">
                  <small class="d-block text-uppercase font-weight-bold mb-3">Departure - Return</small>
                  <div class="input-daterange datepicker row align-items-center" data-date-format="yyyy-mm-dd">
                    <div class="col">
                      <div class="form-group focused">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                          <input class="form-control" placeholder="Departure date" type="text" id="departure_return_departure" name="departure_date">
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group focused">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                          <input class="form-control" placeholder="Return date" type="text" id="departure_return_return" name="return_date">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0" id="departure">
                  <small class="d-block text-uppercase font-weight-bold mb-3">Departure</small>
                  <div class="form-group focused">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                      </div>
                      <input class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Select date" type="text" id="departure_departure">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <div class="form-group">
                    <label for="passengers">How many are going?</label>
                    <div class="input-group mb-3">
                      <select class="custom-select" id="passengers" name="passengers" required>
                        <option value="1">1 traveler</option>
                        <option value="2">2 travelers</option>
                        <option value="3">3 travelers</option>
                        <option value="4">4 travelers</option>
                        <option value="5">5 travelers</option>
                        <option value="6">6 travelers</option>
                        <option value="7">7 travelers</option>
                        <option value="8">8 travelers</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <div class="form-group">
                    <label for="class">Please choose your ticket type</label>
                    <div class="input-group mb-3">
                      <select class="custom-select" id="class" name="class" required>
                        <option value="Guest">Guest</option>
                        <option value="Business">Business</option>
                        <option value="First">First</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-1 col-sm-12 offset-md-3 mt-4">
                  <button class="btn btn-1 btn-primary" type="submit">GO!</button>
                </div>
              </div>
            </form>
          </div>
      </section>
    </div>
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
  <!-- Custom JS -->
  <script src="./assets/js/custom.js"></script>
</body>

</html>
