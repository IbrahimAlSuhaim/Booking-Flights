<?php

include './connectToDB.php';

if(empty($_POST['flight_number']))
{
    
  header('Location:dashboard.php?failMsg=You must fill the FLIGHT_NUMBER');
    exit();
}

if(!isset($_POST['submit']))
{
    header('Location:dashboard.php?failMsg=All fields are required');
    exit();
}
$del = $_POST['flight_number'];

$sql = " DELETE FROM `flights` WHERE `flight_number` = '$del'";

mysqli_query($con,$sql);

header('Location:dashboard.php?successMsg=Deleted successfully');

mysqli_close($con);


?>