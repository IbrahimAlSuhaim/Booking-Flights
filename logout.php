<?php
session_start();
include './preventUnregisteredUsers.php';

$first_name = $_COOKIE['first_name']? $_COOKIE['first_name'] : $_SESSION['first_name'];
setcookie("email", "", time() - 3600,"/");
setcookie("first_name", "", time() - 3600,"/");

session_unset();
session_destroy();// destroys all of the data associated with the current session.
session_start();
$_SESSION['message']='See you later '.$first_name;
header('Location:./login');





?>
