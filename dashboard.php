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

include_once 'connectToDB_Local.php';

$sql_display = " SELECT * FROM `flights` ";

$result_display = mysqli_query($con,$sql_display);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Bookslights Dashboard
  </title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
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
          <a class=" nav-link active " href=" ./dashboard"> <i class="ni ni-tv-2 text-primary"></i> Manage flights
            </a>
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
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">from</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" name="from">
                    <option selected value="">Choose...</option>
                    <option>Riyadh (RUH )</option>
                    <option>Jeddah (JED)</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Carrier</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect02" name="carrier">
                    <option selected value="">Choose...</option>
                    <option>Saudi Airlines</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect03">to</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect03" name="to">
                    <option selected value="">Choose...</option>
                    <option>Riyadh (RUH )</option>
                    <option>Jeddah (JED)</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect04">Airplane</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect04" name="airplane">
                    <option selected value="">Choose...</option>
                    <option>Boeing 777-300ER</option>
                    <option>Airbus A330</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <div class="input-group mb-4">
                  <input class="form-control" placeholder="Departure date" type="text" name="departure_date">
                  <div class="input-group-append">
                    <span class="input-group-text"></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"></span>
                  </div>
                  <input class="form-control" placeholder="Arrival date" type="text" name="arrival_date">
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="form-group">
                <div class="input-group mb-4">
                  <input class="form-control" placeholder="Departure time" type="text" name="departure_time">
                  <div class="input-group-append">
                    <span class="input-group-text"></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"></span>
                  </div>
                  <input class="form-control" placeholder="Arrival time" type="text" name="arrival_time">
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-sm-12">
              <button class="btn btn-1 btn-primary" type="submit" name="submit">Add</button>
            </div>
          </div>
        </form>
      </div>
    </section>



    <section class="container">

    <table class="table">
        <thead>
          <tr class="table-dark">
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
          </tr>
        </thead>
        <tbody>
            <?php
            if(mysqli_num_rows($result_display) > 0)
                while($row = mysqli_fetch_assoc($result_display)) {
                  echo"
                  <tr>
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
                  </tr>
                  ";
                }
            ?>
        </tbody>
    </table>

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
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>
