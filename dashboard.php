<!--

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<?php
include './checkAdmin.php';
include_once './connectToDB.php';

$sql_display = " SELECT * FROM `flights` ";

$result_display = mysqli_query($con,$sql_display);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Book Flights Dashboard
  </title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <link href="./assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="./dashboard">
        <img src="./assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="./assets/img/theme/admin.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="./logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./dashboard">
                <img src="./assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item  class=" active" ">
          <a class=" nav-link active " href=" ./dashboard"> <i class="ni ni-tv-2 text-primary"></i>Manage flights</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./dashboard">Manage flights</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets/img/theme/admin.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Adminstrator</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="./logoutAdmin" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pt-5 pt-md-8">
    </div>
    <section class="section pb-0 section-components mt-5">
      <div class="container mb-5">
        <!-- Inputs -->
<?php
                if(isset($_GET['failMsg'])) {
                  echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <span class="alert-inner--icon"><i class="ni ni-support-16"></i></span>
                      <span class="alert-inner--text">'.$_GET['failMsg'].'</span>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  ';
                }
                if(isset($_GET['successMsg'])) {
                  echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-inner--text">'.$_GET['successMsg'].'</span>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  ';
                }
?>
        <h3 class="h4 text-success font-weight-bold mb-4">Add flight</h3>
        <form class="" action="addFlight.php" method="post">
          <div class="row">
            <div class="col-4 my-2">
              <label for="flight_number">Flight Number</label>
              <input class="form-control" type="text" placeholder="0000" id="flight_number" name="flight_number" value="">
              <small class="form-text text-muted">without carrier code, just enter the numbers for ex:1234</small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="" for="from">From</label>
                <select class="custom-select" id="from" name="from">
                  <option selected value="" disabled>Choose...</option>
                  <option>Riyadh (RUH)</option>
                  <option>Jeddah (JED)</option>
                </select>
              </div>
              <div class="form-group">
                <label for="carrier">Carrier</label>
                <select class="custom-select" id="carrier" name="carrier">
                  <option selected value="" disabled>Choose...</option>
                  <option value="SV">Saudia (SV)</option>
                  <option value="XY">Flynas (XY)</option>
                  <option value="6S">SaudiGulf (6S)</option>
                  <option value="F3">Flyadeal (F3)</option>
                </select>
                <small class="form-text text-muted">first two chars of flight_number are generated based on this choice</small>
              </div>
              <div class="form-group">
                <label for="departure_date">Departure Date</label>
                <input class="form-control" placeholder="yyyy-mm-dd" type="text" id="departure_date" name="departure_date">
                <small class="form-text text-muted">Date Format: yyyy-mm-dd</small>
              </div>
              <div class="form-group">
                <label for="arrival_date">Arrival Date</label>
                <input class="form-control" placeholder="yyyy-mm-dd" type="text" id="arrival_date" name="arrival_date">
              </div>
              <div class="form-group">
                <label for="price_factor">Price Factor</label>
                <input class="form-control" placeholder="Price factor" type="text" id="price_factor" name="price_factor" maxlength="3">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="to">To</label>
                <select class="custom-select" id="to" name="to">
                  <option selected value="" disabled>Choose...</option>
                  <option value="Riyadh (RUH)">Riyadh (RUH)</option>
                  <option value="Jeddah (JED)">Jeddah (JED)</option>
                </select>
              </div>
              <div class="form-group mb-5">
                <label for="airplane">Airplane</label>
                <select class="custom-select" id="airplane" name="airplane">
                  <option selected value="" disabled>Choose...</option>
                  <option>Boeing 777-300ER</option>
                  <option>Airbus A330</option>
                </select>
              </div>
              <div class="form-group">
                <label for="departure_time">Departure Time</label>
                <input class="form-control" placeholder="hh:mm:ss" type="text" id="departure_time" name="departure_time">
                <small class="form-text text-muted">Time Format: hh:mm:ss</small>
              </div>
              <div class="form-group">
                <label for="arrival_time">Arrival Time</label>
                <input class="form-control" placeholder="hh:mm:ss" type="text" id="arrival_time" name="arrival_time">
              </div>
            </div>
            <div class="col-lg-12 col-sm-12">
              <button class="btn btn-1 btn-primary" type="submit" name="submit">Add</button>
            </div>
          </div>
        </form>
    </section>
    <section class="container-fluid">
      <div class="row my-3">
        <div class="co-12">
            <h3 class="h4 text-danger font-weight-bold mb-4">Delete flight</h3>
            <input class="form-control" placeholder="FLIGHT_ID" type="text" id="delete_flight">
            <button class="btn btn-1 btn-danger mt-2" onclick="confirm()">Delete</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <table class="table">
            <thead>
              <tr class="table-dark">
                <th scope="col">flight_id</th>
                <th scope="col">flight_number</th>
                <th scope="col">from</th>
                <th scope="col">to</th>
                <th scope="col">carrier</th>
                <th scope="col">airplane</th>
                <th scope="col">departure_date</th>
                <th scope="col">departure_time</th>
                <th scope="col">arrival_date</th>
                <th scope="col">arrival_time</th>
                <th scope="col">capacity</th>
                <th scope="col">reserved</th>
                <th scope="col">price factor</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(mysqli_num_rows($result_display) > 0)
              while($row = mysqli_fetch_assoc($result_display)) {
                echo"
                <tr>
                <th>".$row['flight_id']."</th>
                <th>".$row['flight_number']."</th>
                <td>".$row['from']."</td>
                <td>".$row['to']."</td>
                <td>".$row['carrier']."</td>
                <td>".$row['airplane']."</td>
                <td>".$row['departure_date']."</td>
                <td>".$row['departure_time']."</td>
                <td>".$row['arrival_date']."</td>
                <td>".$row['arrival_time']."</td>
                <td>".$row['capacity']."</td>
                <td>".$row['reserved']."</td>
                <td>".$row['price_factor']."</td>
                </tr>
                ";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
  <!--   Core   -->
  <script src="./assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="./assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="./assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src="./assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <!-- jquery-confirm -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script>
    function confirm() {
      const flight_id = $('#delete_flight').val().trim();
      if(flight_id!='') {
        $.confirm({
          icon: 'fa fa-question-circle',
          title: 'Delete',
          content: 'Delete flight_id='+flight_id+' ?',
          btnClass: 'btn-blue',
          buttons: {
            Proceed: {
              btnClass: 'btn-red',
              action: function () {
                $.confirm({
                  icon: 'fa fa-warning',
                  title: 'This is critical action!',
                  content: 'Do you really want to delete flight id: '+flight_id+' ?',
                  type: 'red',
                  typeAnimated: true,
                  buttons: {
                    Yes: {
                      text: 'Yes, Sure',
                      btnClass: 'btn-red',
                      action: function(){
                        window.location="./deleteFlight.php?flight_id="+flight_id;
                      }
                    },
                    No: function () {
                      $('#delete_flight').val('');
                      $.alert('Canceled!');
                    }
                  }
                });
              }
            },
            cancel: function () {
              $('#delete_flight').val('');
              $.alert('Canceled!');
            }
          }
        });
      }
    }

  </script>
</body>

</html>
