<?php
include './preventUnregisteredUsers.php';
session_start();

if (isset($_COOKIE['email'])) { // is user using cookies?
  $first_name = $_COOKIE['first_name'];
  setcookie("email", "", time() - (86400 * 30),"/");
  setcookie("first_name", "", time() - (86400 * 30),"/");
  $_SESSION['message']='See you later '.$first_name;
  header('Location:./login.php');
}
else { // or session
  $first_name = $_SESSION['first_name'];
  session_unset();
  session_destroy();// destroys all of the data associated with the current session.
  session_start();
  $_SESSION['message']='See you later '.$first_name;
  header('Location:./login.php');
}




?>
