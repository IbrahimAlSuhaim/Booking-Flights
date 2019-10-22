<?php
include './connectToDB.php';
session_start();
$email = $_POST['email'];

if($result=$con->query("SELECT * FROM users WHERE email='$_POST[email]'")) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if($_POST['password']!='') {
    if(password_verify($_POST['password'],$row['password'])){
      if(isset($_POST['remember'])) {
        setcookie('user_id', $row['user_id'], time() + (86400 * 30), "/");
        setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('first_name', $row['first_name'], time() + (86400 * 30), "/");
      }
      else {
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['email']=$email;
        $_SESSION['first_name']=$row['first_name'];
      }
      if(isset($_SESSION['next'])){
        $next = $_SESSION['next'];
        unset($_SESSION['next']);
        header("Location:$next");
        exit();
      }
      else {
        header('Location:./index');
        exit();
      }
    }
    else {
      $_SESSION['error'] = 'Wrong Email/Password';
      header('Location:./login');
      exit();
    }

  }
  else {
    $_SESSION['error'] = 'Enter Email and Password';
    header('Location:./login');
    exit();
  }
}
else {
  $_SESSION['error'] = 'Wrong Email/Password';
  header('Location:./login');
  exit();
}


 ?>
