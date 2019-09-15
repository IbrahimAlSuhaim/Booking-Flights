<?php
include 'connectToDB.php';
session_start();
$username = $_POST['username'];

if($result=$con->query("SELECT * FROM admins WHERE username='$_POST[username]'")) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if($_POST['password']!='') {
    if(password_verify($_POST['password'],$row['password'])){
      if(isset($_POST['remember'])) {
        setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('first_name', 'Admin', time() + (86400 * 30), "/");
      }
      else {
        $_SESSION['username']=$username;
        $_SESSION['first_name']='Admin';
      }
      header('Location:./dashboard.php');
    }
    else {
      $_SESSION['error'] = 'Wrong Username/Password';
      header('Location:./admin.php');
    }

  }
  else {
    $_SESSION['error'] = 'Enter Username and Password';
    header('Location:./admin.php');
  }
}
else {
  $_SESSION['error'] = 'Wrong Username/Password';
  header('Location:./admin.php');
}


 ?>
