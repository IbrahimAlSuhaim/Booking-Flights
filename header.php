<header class="header-global">
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
    <div class="container">
      <a class="navbar-brand mr-lg-5" href="./index">
        <img src="./assets/img/brand/white.png" alt="brand">
      </a>
      <!-- START -->
      <?php
      if(isset($_COOKIE['email'])||isset($_SESSION['email'])) {
       
        echo' <a href="BookedTickets.php" class="btn btn-1 btn-primary btn-sm" type="" data-hide="">Booked Tickets</a> ';

      }
      ?>
      <!-- END -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar_global">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index">
                <img src="./assets/img/brand/blue.png" alt="brand">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.facebook.com/" target="_blank" data-toggle="tooltip" title="Like us on Facebook">
              <i class="fa fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" title="Follow us on Instagram">
              <i class="fa fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">Instagram</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://twitter.com/" target="_blank" data-toggle="tooltip" title="Follow us on Twitter">
              <i class="fa fa-twitter-square"></i>
              <span class="nav-link-inner--text d-lg-none">Twitter</span>
            </a>
          </li>
          <?php
            if(isset($_COOKIE['email'])||isset($_SESSION['email'])) {
              $first_name = (isset($_COOKIE['first_name'])?
                 $_COOKIE['first_name']
                : $_SESSION['first_name']);

              echo '
              <li class="nav-item">
                <span class="text-primary d-lg-none d-block">Welcome '.$first_name.'</span>
                <span class="text-white d-none d-lg-block">Welcome '.$first_name.'</span>
              </li>
              <li class="nav-item d-block ml-lg-4">
              <a href="./logout" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              </span>
              <span class="nav-link-inner--text">Sign out</span>
              </a>
              </li>';
            }
            else {
              echo '
              <li class="nav-item d-block ml-lg-4">
              <a href="./login" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
              <i class="fa fa-sign-in" aria-hidden="true"></i>
              </span>
              <span class="nav-link-inner--text">Sign In</span>
              </a>
              </li>';
            }
           ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
