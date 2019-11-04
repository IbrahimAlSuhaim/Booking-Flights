<?php
  session_start();
  include_once('connectToDB.php');
  if(!isset($_SESSION['departure_flight'])) {
    $_SESSION['error'] = 'some error occured, We sorry -.-!. Try again';
    header('Location: ./index#search');
    exit();
  }

  $passengers = $_SESSION['departure_flight']['passengers'];

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
  <title>Select seats</title>
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
  <!-- StateChart CSS -->
  <link rel="stylesheet" href="./assets/seatmap/src/css/seatchart.css">
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
    <section class="section">
      <div class="container mb-5">
        <h3 class="mb-4">Now select seats and preferred meal for your return flight</h3>
        <div class="row justify-content-center">
          <div class="col-7 mr-5">
            <div id="map-container">
            </div>
          </div>
          <div class="col-3">
            <div id="cart-container"></div>
            <div id="legend-container"></div>
            <form>
              <hr>
              <div class="form-group">
                <p class="h5" for="">Special meal</p>
                <small class="text-muted" for="">You can order a special meal on any flight where a meal service is normally provided.</small>
              <?php
                for ($i=1; $i <= $passengers ; $i++) {
                  echo '
                  <div class="form-group mt-3">
                    <label>Special meal for '.$_SESSION['list_passengers']["first_name_$i"].'</label>
                    <select class="form-control form-control-sm" id="meal_'.$i.'" name="meal" required>
                      <option selected value="" disabled>None</option>
                      <option>Seafood</option>
                      <option>Baby meal, for infants</option>
                      <option>Bland meal, especially formulated for ulcer-patients</option>
                      <option>Diabetic meal, especially formulated for diabetic passengers</option>
                      <option>Low fat meal, especially for passengers on a low-fat diet</option>
                      <option>Salt-free meal, especially for passengers on a low-sodium diet</option>
                      <option>Vegetarian meal, European style food</option>
                      <option>Asian vegetarian meal</option>
                      <option>Fasting meal</option>
                    </select>
                  </div>
                  ';
                }
               ?>
              </div>
            </form>
            <hr>
            <button id="submit" class="btn btn-1 btn-primary mt-2" onclick="handleSubmit()" disabled>Go!</button>
          </div>

        </div>
            <?php
              $directionality = $_SESSION['departure_flight']['directionality'];
              if($directionality === 'return'){
                echo '<div id="directionality" hidden>return</div>';
              }
              else{
                  echo '<div id="directionality" hidden>oneWay</div>';
              }
              $flightId = $_SESSION['return_flight_id'];
              $sql = "SELECT airplane FROM flights WHERE flight_id = $flightId";
              $result = $con->query($sql);
              $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              echo '<div id="airplane" hidden>'.$row['airplane'].'</div>';

              echo '<div id="className" hidden>'.$_SESSION['departure_flight']['class'].'</div>';

              echo '<div id="flightId" hidden>'.$_SESSION['return_flight_id'].'</div>';

              echo '<div id="passengersNum" hidden>'.$_SESSION['departure_flight']['passengers'].'</div>';
             ?>
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
  <script type="text/javascript" src="./assets/seatmap/src/js/seatchart.js"></script>
  <script>

    var sc;
    var flightId = document.getElementById('flightId').innerHTML
    var directionality = document.getElementById('directionality').innerHTML
    var className = document.getElementById('className').innerHTML
    var airplane = document.getElementById('airplane').innerHTML
    var passengersNum = parseInt(document.getElementById('passengersNum').innerHTML)
    var next = './payment'
    var rowNum;
    if(airplane === 'Boeing 777-300ER'){
      rowNum = 46
    }
    else {
      rowNum = 38
    }

    var firstClass = [0, 5, 6, 11, 12, 17, 18, 23]
    var businessClass = [36, 37, 41, 42, 46, 47, 48, 49, 53, 54, 58, 59, 60, 61, 65, 66, 70, 71,
      72, 73, 77, 78, 82, 83, 84, 85, 89, 90, 94, 95, 96, 97, 101, 102, 106, 107]

    var guestClass = []

    var allGuestSeats = [] // generate all guest seats include blanks
    for (var i = 117; i <= 551; i++) {
      allGuestSeats.push(i);
    }
    var count= 0;
    var flag = true
    var blankSeats = []
    for(seat of allGuestSeats) { // indecate which seats are blank
      count++
      if(count==5 && !flag) {
        blankSeats.push(seat)
        count=0
        flag=true
      }
      if(count == 7 && flag){
        blankSeats.push(seat)
        count=0;
        flag=false
      }
    }
    guestClass = allGuestSeats.filter((i) => !blankSeats.includes(i)) // exclude blank seats from allGuestSeats





    var bookedSeats = []
    if (className === 'Guest') {
      bookedSeats = firstClass.concat(businessClass)
    }
    else if (className === 'First') {
      bookedSeats = guestClass.concat(businessClass)
    }
    else {
      bookedSeats = guestClass.concat(firstClass)
    }

    var selected = []

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

    $.ajax({
        type: "POST",
        url: "./getSeats.php",
        data: {flightId: flightId, className: className},
        dataType:'JSON',
        success: function(response){
            console.log(response);
            // put on console what server sent back...
            options.map.reserved.seats = bookedSeats.concat(response)
            sc = new Seatchart(options);
        }
    });


      function handleSubmit() {
        var selectedArray = sc.getCart().selected;
        var meals = []
        var arrMeals = []
        for (var i = 1; i <= passengersNum; i++) {
          var meal = document.getElementById('meal_'+i).value
          arrMeals.push(meals['meal_'+i] = meal)
        }
        fetch("./returnSeats_to_session.php", {
          method: "POST",
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            "selectedSeats": selectedArray,
            "meals": arrMeals
          })
        }).then(window.location.href=next)
      }
  </script>
</body>

</html>
