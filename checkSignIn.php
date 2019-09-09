<?php
$email = $_POST['email'];
include 'connectToDB.php';

if($result=$con->query("SELECT * FROM users WHERE email='$_POST[email]'")) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if($_POST['password']!='') {
    if($_POST["password"]==$row['password']){
      setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
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
