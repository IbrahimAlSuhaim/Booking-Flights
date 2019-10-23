<?php

include './connectToDB.php';

// if(empty($_POST['flight_number']))
// {
//
//   header('Location:dashboard.php?failMsg=You must fill the FLIGHT_NUMBER');
//     exit();
// }
//
// if(!isset($_POST['submit']))
// {
//     header('Location:dashboard.php?failMsg=All fields are required');
//     exit();
// }
$del = $_GET['flight_id'];
$isThere = mysqli_query($con,"SELECT flight_number FROM `flights` WHERE `flight_id` = '$del'");
if(mysqli_num_rows($isThere)>0){
  $sql = "DELETE FROM `flights` WHERE `flight_id` = '$del'";
  if(mysqli_query($con,$sql)){
    header("Location:dashboard.php?successMsg=flight_id='$del' has been deleted successfully");
    exit();
  }
  else {
    header("Location:dashboard.php?failMsg=".mysqli_error($con));
    exit();
  }
}
else {
  header("Location:dashboard.php?failMsg=flight_id='$del' not in the database");
  exit();
}


mysqli_close($con);


?>
