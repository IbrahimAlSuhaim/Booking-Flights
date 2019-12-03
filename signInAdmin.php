<?php
include './connectToDB.php';
session_start();
$username = $_POST['username'];

if($result=$con->query("SELECT * FROM admins WHERE username='$_POST[username]'")) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if($_POST['password']!='') {
    if(password_verify($_POST['password'],$row['password'])){
      if(isset($_POST['remember'])) {
        setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
      }
      else {
        $_SESSION['username']=$username;
      }
      header('Location:./dashboard');
    }
    else {
      $_SESSION['error'] = 'Wrong Username/Password';
      header('Location:./admin');
    }

  }
  else {
    $_SESSION['error'] = 'Enter Username and Password';
    header('Location:./admin');
  }
}
else {
  $_SESSION['error'] = 'Wrong Username/Password';
  header('Location:./admin');
}


 ?>
