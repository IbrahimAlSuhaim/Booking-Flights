<?php
session_start();
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  $decoded = json_decode($content, true);
  $_SESSION['selectedSeats_return'] = $decoded['selectedSeats'];
  $_SESSION['return_meals'] = $decoded['meals'];

  //If json_decode failed, the JSON is invalid.
  if(! is_array($decoded)) {

  } else {
    // Send error back to user.
  }
}
 ?>
