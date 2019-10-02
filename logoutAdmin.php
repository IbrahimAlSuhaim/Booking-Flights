<?php
session_start();

setcookie("username", "", time() - 3600,"/");

session_unset();
session_destroy();// destroys all of the data associated with the current session.
session_start();
$_SESSION['message']='See you later sir!';
header('Location:./admin');
?>
