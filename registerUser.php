<?php
include './connectToDB_Local.php';
session_start();
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$hashed_password=password_hash($_POST['password'],PASSWORD_DEFAULT);


$sql= "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name','$last_name','$email','$hashed_password')";


if($con->query($sql)===TRUE){
  $_SESSION['message'] = 'Thank you for registration';
  header('Location:./register');
}
else{
  $_SESSION['error'] = '<b>Faild:</b>'.$con->error;
  header('Location:./register');
}


$con->close();
 ?>
