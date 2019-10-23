<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases
session_start();
include './connectToDB.php';
if(!isset($_SESSION['departure_flight'])) {
  $_SESSION['error'] = 'some error occured, We sorry !. Try again';
  header('Location: ./index#search');
  exit();
}
$listPassengers = $_SESSION['list_passengers'];
$passengersNum = $_SESSION['departure_flight']['passengers'];
$departure_flight_id = $_SESSION['departure_flight_id'];
$class = $_SESSION['departure_flight']['class'];

if(isset($_COOKIE['user_id'])) {
  $user_id = $_COOKIE['user_id'];
  $user_first_name = $_COOKIE['first_name'];
}
else if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $user_first_name = $_SESSION['first_name'];
}
else {
  $_SESSION['next'] = './bookflight';
  $_SESSION['error'] = 'Please login to continue or register';
  header('Location:./login');
  exit();
}

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
}
$result = $con->query("SELECT * FROM users WHERE user_id=$user_id");
$row=mysqli_fetch_array($result);
$emailTo=$row['email'];


$email = new \SendGrid\Mail\Mail();
$email->setFrom("No-replay@bookflights.com", "Bookflights Team");
$email->setSubject("Thank you for booking");
$email->addTo($emailTo, $user_first_name);
$email->addContent("text/plain", "Thank you for booking, ".$user_first_name."Your flight booking is confirmed");
$email->addContent(
    "text/html", "<p>Thank you for booking, ".$user_first_name."</p><br><strong>Your flight booking is confirmed</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
header("Location:./confirmation");


function incReserved($con, $flight_id) {
  $sql = "UPDATE `flights` SET `reserved`=`reserved`+1 WHERE `flight_id` = '$flight_id'";
  $con->query($sql);
}
 ?>
