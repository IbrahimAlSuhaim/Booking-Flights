<?php
include 'connectToDB.php';
session_start();
$email = $_POST['email'];

if($result=$con->query("SELECT * FROM users WHERE email='$_POST[email]'")) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if($_POST['password']!='') {
    if(password_verify($_POST['password'],$row['password'])){
      if(isset($_POST['remember'])) {
        setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('first_name', $row['first_name'], time() + (86400 * 30), "/");
      }
      $_SESSION['email']=$email;
      $_SESSION['first_name']=$row['first_name'];
      header('Location:./index.php');
    }
    else {
      $_SESSION['error'] = 'Wrong Username/Password';
      header('Location:./login.php');
    }

  }
  else {
    $_SESSION['error'] = 'Enter Username and Password';
    header('Location:./login.php');
  }
}
else {
  $_SESSION['error'] = 'Wrong Username/Password';
  header('Location:./login.php');
}


 ?>
