<?php

include './connectToDB.php';

if(!isset($_GET['passId']))
{
    header('Location:BookedTickets.php');
    exit();
}
else
{
    session_start();
    $passId = $_GET['passId'];

    $sql = ' DELETE FROM booked_tickets WHERE passenger_id = "'.$passId.'" ';
    $result = mysqli_query($con,$sql);

    $_SESSION['delete'] = "Deleted successfully";
    header('Location:BookedTickets.php');
    exit();
  
}




mysqli_close($con);


?>
