<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if(!isset($_COOKIE['email'])&&!isset($_SESSION['email'])){ //prevent unregistered users from entering this page
  header('location:./index.php');
  exit();
}
 ?>
