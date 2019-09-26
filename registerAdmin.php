<?php
include './connectToDB_Local.php';
session_start();
$username='Admin';

$hashed_password='$2y$10$YzzuFRS/mbaILIfPnAbVpeNLqBjmd/9/3MxZNkNNR52Yk4Bg03VHe';


$sql= "INSERT INTO `admins`(`username`, `password`) VALUES ('$username','$hashed_password')";


if($con->query($sql)===TRUE){
  echo 'Thank you for registration';
}
else{
  echo '<b>Faild:</b>'.$con->error;
}


$con->close();
 ?>
