<?php
  session_start();
include './preventUnregisteredUsers.php';
$id = $_SESSION['user_id'];
  include_once 'connectToDB.php';
  include_once 'assets/helper.php';



  $sql_BookedTickets = " SELECT * FROM flights, booked_tickets, passengers
  WHERE flights.flight_id = booked_tickets.flight_id AND booked_tickets.user_id = '$id' AND booked_tickets.passenger_id= passengers.passenger_id";
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
  <title>Booked tickets</title>
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
      <section class="section-shaped">
        <!-- Background circles -->
        <div class="shape shape-style-1 shape-primary">

        </div>
        <div class="container shape-container d-flex align-items-center py-lg">
          <div class="col px-0">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="font-weight-300 text-center text-white">Booked Tickets</h1>
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

          <?php

if(isset($_SESSION['delete'])){
  echo '
    <div class="col-12 mb-3">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-inner--icon"><i class="ni ni-support-16"></i></span>
        <span class="alert-inner--text">'.$_SESSION['delete'].'</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    </div>
    ';

    unset($_SESSION['delete']);
}

?>

            <!-- Inputs -->
    <?php

      if($result_BookedTickets->num_rows !== 0){
        echo '
          <h3 class="h4 text-primary font-weight-bold mb-4">Available Tickets</h3>';
        while($row=mysqli_fetch_array($result_BookedTickets)){
          echo '
          <div class="col-lg-8 col-sm-12 text-center py-2 mx-auto mb-3">
            <div class="card card-lift shadow border-0">
              <div class="card-header pt-2 pb-0">
                <div class="row">
                  <div class="col-6">
                    <p class="text-left">Passenger name: '.$row['first_name'].' '.$row['family_name'].'</p>
                  </div>
                  <div class="col-6">
                    <p class="text-right font-weight-bold text-muted">'.$row['flight_number'].'</p>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-4">
                    <span class="d-block mb-1">'.substr($row['departure_time'], 0, -3).'</span>
                    <span class="d-block mb-1">'.$row['from'].'</span>
                    <span class="d-block mb-1 text-muted">'.$row['departure_date'].'</span>
                  </div>
                  <div class="col-4">
                    <small class="d-block mb-1 text-success">Direct</small>
                    <small class="d-block mb-1">Duration: '.getDuration($row['departure_time'], $row['arrival_time']).'</small>
                  </div>
                  <div class="col-4">
                    <span class="d-block mb-1">'.substr($row['arrival_time'], 0, -3).'</span>
                    <span class="d-block mb-1">'.$row['to'].'</span>
                    <span class="d-block text-muted mb-1">'.$row['arrival_date'].'</span>
                  </div>
                </div>
                <hr class="py-0 mt-0 mb-0">
                <div class="row">
                  <div class="col-6 text-left">
                    <a onclick="confirmDelete('.$row['ticket_id'].')" data-toggle="modal" data-target="#modal" style="cursor: pointer;" class="btn btn-link text-danger mb-0">Delete</a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="detailTicket.php?ticketId='.$row['ticket_id'].'"  class="btn btn-link text-info mb-0">Details</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        ';
        }
      }
      else{
        echo '
        <div class="row">
          <div class="col mb-5">
            <p class="h4 mb-4">Unfortunately there is no tickets booked by your account, <a class="small" href="./index#search">book a trip</a></p>
          </div>
        </div>';
      }


            ?>
          </div>



   <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
            Are you sure you want to delete a ticket ?
            </div>
            <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
          <a href="" id="btnDel" type="button" class="btn btn-primary ml-3">delete</a>
        </div>
      </div>
    </div>
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

  <script>

      function confirmDelete(ticketId)
      {
        btn = document.querySelector('#btnDel');
        btn.href = "deleteTicket.php?ticketId="+ticketId;
      }

  </script>

</body>

</html>
