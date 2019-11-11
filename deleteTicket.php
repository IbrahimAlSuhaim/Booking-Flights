<?php

include './connectToDB.php';

if(!isset($_GET['ticketId']))
{
    header('Location:BookedTickets.php');
    exit();
}
else
{
    session_start();
    $ticketId = $_GET['ticketId'];

    $sql = "SELECT `flight_id` FROM `booked_tickets` WHERE `ticket_id`='$ticketId'";
    $result = $con->query($sql);
    $row=mysqli_fetch_array($result);
    $flightId = $row['flight_id'];

    $sql = ' DELETE FROM booked_tickets WHERE passenger_id = "'.$ticketId.'" ';
    $result = mysqli_query($con,$sql);

    // decremeant reserved
    $sql = "UPDATE `flights` SET `reserved`=`reserved`-1 WHERE `flight_id` = '$flightId'";
    $con->query($sql);

    $_SESSION['delete'] = "Deleted successfully";
    header('Location:BookedTickets.php');
    exit();

}




mysqli_close($con);


?>
