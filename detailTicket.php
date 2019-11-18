<?php
  session_start();
include './preventUnregisteredUsers.php';
$id = $_SESSION['user_id'];
$ticket_id = $_GET['ticketId'];
  include_once 'connectToDB.php';
  include_once 'assets/helper.php';



  $sql_BookedTicket = " SELECT * FROM flights, booked_tickets, passengers
  WHERE flights.flight_id = booked_tickets.flight_id AND booked_tickets.ticket_id = '$ticket_id' AND booked_tickets.passenger_id= passengers.passenger_id";
  $result_BookedTicket = mysqli_query($con,$sql_BookedTicket)



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
                <h1 class="font-weight-300 text-center text-white">Booked Ticket</h1>
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
    <?php

      if($result_BookedTicket->num_rows !== 0){
        echo '
          <h3 class="h4 text-primary font-weight-bold mb-4">Ticket Details</h3>';
        while($row=mysqli_fetch_array($result_BookedTicket)){
          echo '
          <div class="col-lg-8 col-sm-12 text-center py-2 mx-auto mb-3">
            <div class="card card-lift shadow border-0 w-75 mx-auto">
              <div class="card-header pt-3 pb-0">
                  <div class="text-center">
                    <p>Passenger name: '.$row['first_name'].' '.$row['family_name'].'</p>
                  </div>
              </div>
              <div class="card-body px-5">
                  <div class="d-flex justify-content-between py-2">
                    <span>Flight number</span>
                    <span>'.$row['flight_number'].'</span>
                  </div>
                  <div class="d-flex justify-content-between py-2">
                    <span>From</span>
                    <span>'.$row['from'].'</span>
                 </div>
                <div class="d-flex justify-content-between py-2">
                    <span>To</span>
                    <span>'.$row['to'].'</span>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span>Carrier</span>
                    <span>'.$row['carrier'].'</span>
               </div>
             <div class="d-flex justify-content-between py-2">
                <span>Airplane</span>
                <span id="airplane">'.$row['airplane'].'</span>
            </div>
            <div class="d-flex justify-content-between py-2">
                <span>Departure date</span>
                <span>'.$row['departure_date'].'</span>
           </div>
           <div class="d-flex justify-content-between py-2">
                <span>Departure time</span>
                <span>'.substr($row['departure_time'], 0, -3).'</span>
         </div>
         <div class="d-flex justify-content-between py-2">
            <span>Arrival date</span>
            <span>'.$row['arrival_date'].'</span>
        </div>
        <div class="d-flex justify-content-between py-2">
            <span>Arrival time</span>
            <span>'.substr($row['arrival_time'], 0, -3).'</span>
        </div>
        <div class="d-flex justify-content-between py-2">
           <span>Class</span>
           <span>'.$row['class'].'</span>
       </div>
        <div class="d-flex justify-content-between py-2">
            <span>Seat</span>
            <span id="seat">'.$row['seat'].'</span>
        </div>
        <div class="d-flex justify-content-between py-2">
            <span>Special meal</span>
            <span>'.$row['meal'].'</span>
        </div>

              </div>
              <div class="card-footer pt-1 pb-2">
              <div class="text-center">
              <small><a href="BookedTickets.php"  class="btn btn-link text-info mb-0">Back to My Tickets</a></small>
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

          <div hidden>
            <div id="map-container"></div>
            <div id="cart-container"></div>
            <div id="legend-container"></div>
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
  <!-- jquery-confirm -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script src="./assets/js/flights.js"></script>
  <script type="text/javascript" src="./assets/seatmap/src/js/seatchart.js"></script>

  <script>
    var passengersNum = 1;
      function confirmDelete(passId)
      {
        btn = document.querySelector('#btnDel');
        btn.href = "deleteTicket.php?passId="+passId;
      }
   $( document ).ready(function() {
      var airplane = document.getElementById('airplane').innerHTML;
      var rowNum;
      if(airplane === 'Boeing 777-300ER'){
        rowNum = 46
      }
      else {
        rowNum = 38
      }

      var options = {
          // Reserved and disabled seats are indexed
          // from left to right by starting from 0.
          // Given the seatmap as a 2D array and an index [R, C]
          // the following values can obtained as follow:
          // I = columns * R + C
          map: {
              id: 'map-container',
              rows: rowNum,
              columns: 12,
              // e.g. Reserved Seat [Row: 1, Col: 2] = 7 * 1 + 2 = 9
              reserved: {
                  seats: []
              },
              disabled: {
                  seats: [1, 2, 4, 7, 9, 10, 13, 14, 16, 19, 21, 22, 38, 40, 43, 45, 50, 52, 55,
                    57, 62, 64, 67, 69, 74, 76, 79, 81, 86, 88, 91, 93, 98, 100, 103, 105],
                  rows: [2, 9, 13, 25, 37],
                  columns: [3, 8]
              }
          },
          types: [
              { type: "selected", backgroundColor: "#287233", price: 0, selected: [] }
          ],
          cart: {
              id: 'cart-container',
              width: 280,
              height: 250,
              currency: 'SR',
          },
          legend: {
              id: 'legend-container',
          },
          assets: {
              path: "./assets/seatmap/src/assets",
          }
      };
        sc = new Seatchart(options);
        var seatIndex = document.getElementById('seat');
        var seatName = sc.get(seatIndex.innerHTML);
        seatIndex.innerHTML = seatName.name;
    });



  </script>

</body>

</html>
