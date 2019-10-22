<?php
session_start();
include './connectToDB.php';
$listPassengers = $_SESSION['list_passengers'];
$passengersNum = $_SESSION['departure_flight']['passengers'];
$departure_flight_id = $_SESSION['departure_flight_id'];
$class = $_SESSION['departure_flight']['class'];

for ($i=1; $i <= $passengersNum ; $i++) {
  $first_name = $listPassengers["first_name_$i"]; $middle_name = $listPassengers["middle_name_$i"]; $family_name = $listPassengers["family_name_$i"]; $nationality = $listPassengers["nationality_$i"]; $document_type = $listPassengers["document_type_$i"]; $document_number = $listPassengers["document_number_$i"];
  $birth_date = $listPassengers["birth_date_$i"]; $gender = $listPassengers["gender_$i"]; $number = $listPassengers["number_$i"]; $email = $listPassengers["email_$i"];

  $sql = "SELECT * FROM passengers WHERE `document_type`='$document_type' AND `document_number`= '$document_number'";
  $result = $con->query($sql);
  if($result->num_rows==0) { // if there is no passenger in the DB with that identification then we add new passenger to DB
    $sql = "INSERT INTO `passengers`(`first_name`, `middle_name`, `family_name`, `nationality`, `document_type`, `document_number`, `birth_date`, `gender`, `number`, `email`)
    VALUES ('$first_name', '$middle_name', '$family_name', '$nationality', '$document_type', '$document_number', '$birth_date', '$gender', '$number', '$email')";

    $con->query($sql);

  }
  else {
    // todo: update passenger information
  }

  if(isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
  }
  else if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  }
  else {
    $_SESSION['next'] = './bookflight';
    $_SESSION['error'] = 'Please login to continue or register';
    header('Location:./login');
    exit();
  }
  $sql = "SELECT `passenger_id` FROM `passengers` WHERE `document_type`='$document_type' AND `document_number`= '$document_number'";
  $result = $con->query($sql);
  $row=mysqli_fetch_array($result);
  $passenger_id = $row['passenger_id'];

  $sql = "SELECT `ticket_id` FROM `booked_tickets` WHERE `user_id`='$user_id' AND `passenger_id`= '$passenger_id' AND `flight_id`= '$departure_flight_id'";
  $result = $con->query($sql);
  if ($result->num_rows === 0) { // check if the user has already booked a ticket with same info to prevent redundancy for ex: user update the confirmation page
    $sql = "INSERT INTO `booked_tickets`(`user_id`, `flight_id`, `passenger_id`, `class`, `seat`, `meal`)
    VALUES ('$user_id', '$departure_flight_id', '$passenger_id', '$class', '', '')";
    if($con->query($sql)!==TRUE) {
      echo 'fail'.$con->error;
    }
    incReserved($con, $departure_flight_id);

    if(isset($_SESSION['return_flight_id'])){ // add the return flight if the user chose return option
      $return_flight_id = $_SESSION['return_flight_id'];
      $sql = "INSERT INTO `booked_tickets`(`user_id`, `flight_id`, `passenger_id`, `class`, `seat`, `meal`)
      VALUES ('$user_id', '$return_flight_id', '$passenger_id', '$class', '', '')";
      $con->query($sql);
      incReserved($con, $return_flight_id);
    }
  }
  header("Location:./confirmation");
}


function incReserved($con, $flight_id) {
  $sql = "UPDATE `flights` SET `reserved`=`reserved`+1 WHERE `flight_id` = '$flight_id'";
  $con->query($sql);
}
 ?>