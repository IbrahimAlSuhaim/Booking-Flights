<?php
include './connectToDB.php';
session_start();
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$hashed_password=password_hash($_POST['password'],PASSWORD_DEFAULT);


$sql= "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name','$last_name','$email','$hashed_password')";


if($con->query($sql)===TRUE){
  $_SESSION['message'] = 'Thank you for registration';
  header('Location:./register.php');
}
else{
  $_SESSION['error'] = $email.' already exist';
  header('Location:./register.php');
}


$con->close();
 ?>
