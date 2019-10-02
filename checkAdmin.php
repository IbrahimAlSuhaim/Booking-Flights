<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


if(isset($_COOKIE['username'])){
  if($_COOKIE['username'] != 'Admin'){
    header('Location:./not-found');
    exit();
  }
}
else if (isset($_SESSION['username'])) {
  if($_SESSION['username'] != 'Admin'){
    header('Location:./not-found');
    exit();
  }
}
else {
  header('Location:./not-found');
  exit();
}
 ?>
