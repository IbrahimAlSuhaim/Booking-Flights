<?php
include 'connectToDB.php';
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$hashed_password=password_hash($_POST['password'],PASSWORD_DEFAULT);


$sql= "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name','$last_name','$email','$hashed_password')";


if($con->query($sql)===TRUE){
header('Location:./register.php?message=Thank you for registration');
}
else{
header('Location:./register.php?error=<b>Failed:</b> '.$con->error);
}


$con->close();
 ?>
