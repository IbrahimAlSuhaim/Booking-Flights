<?php
  session_start();

$id = $_SESSION['user_id'];
  include_once 'connectToDB.php';
  include_once 'assets/helper.php';



  $sql_BookedTickets = ' SELECT * FROM flights, booked_tickets WHERE flights.flight_id = booked_tickets.flight_id AND booked_tickets.user_id = "'.$id.'" ';
  $result_BookedTickets = mysqli_query($con,$sql_BookedTickets)
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

  <style>
   
    a[data-hide]
    {
    display: none;
    }

    @media (max-width: 576px) { 
        #mainText
        {
            font-size: 2rem !important;
        }
     }

    
    @media (max-width: 768px) { 
        #mainText
        {
            font-size: 3rem !important;
        }
     }

   
   

</style>

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
                <h1 id="mainText" style="font-size: 4rem; color: #f4f4f4; font-weight: 300;">Booked Tickets</h1>
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
            <h3 class="h4 text-primary font-weight-bold mb-4" id="search">Available Tickets</h3>
            <?php

while($row=mysqli_fetch_array($result_BookedTickets)){
    echo '
    <div class="col-lg-8 col-sm-12 text-center py-2 mx-auto mb-3">
      <div class="card card-lift shadow border-0">
        <div class="card-body">
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
         
          <button class="btn btn-1 btn-warning mt-4" type="button">Details</button>
        </div>
      </div>

    </div>
  ';
  }






            ?>
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
