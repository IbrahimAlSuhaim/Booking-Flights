<?php
include 'connectToDB.php';
$email = $_POST['email'];

if($result=$con->query("SELECT * FROM users WHERE email='$_POST[email]'")) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if($_POST['password']!='') {
    if(password_verify($_POST['password'],$row['password'])){
      setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
      setcookie('first_name', $row['first_name'], time() + (86400 * 30), "/");
      header('Location:./index.php');
    }
    else {
      header('Location:./login.php?error=Wrong Username/Password');
    }

  }
  else {
    header('Location:./login.php?error=Enter Username and Password');
  }
}
else {
  header('Location:./login.php?error=Wrong Username/Password');
}


 ?>
