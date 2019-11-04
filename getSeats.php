<?php
  include_once('./connectToDB.php');
  if(isset($_POST['flightId']) && !empty($_POST['flightId'])) {
    $flightId = $_POST['flightId'];
    $sql = "SELECT `seat` FROM `booked_tickets` WHERE `flight_id`= $flightId";
    $result = $con->query($sql);
    $reserved = mysqli_fetch_all($result,MYSQLI_NUM);
    echo json_encode($reserved);
  }

 ?>
