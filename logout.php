<?php
// set the expiration date to one hour ago
setcookie("email", "", time() - (86400 * 30),"/");
header('Location:./login.php?message=See you later.')
?>
