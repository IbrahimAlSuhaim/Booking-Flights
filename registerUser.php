<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

include './connectToDB.php';
session_start();
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$user_email=$_POST['email'];
$hashed_password=password_hash($_POST['password'],PASSWORD_DEFAULT);


$sql= "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name','$last_name','$user_email','$hashed_password')";


if($con->query($sql)===TRUE){
  $_SESSION['message'] = 'Thank you For registration, '.$first_name;
  $emailTo=$_POST['email'];


  $email = new \SendGrid\Mail\Mail();
  $email->setFrom("No-replay@bookflights.com", "Bookflights Team");
  $email->setSubject("Thank you for registration");
  $email->addTo($emailTo, $first_name);
  $email->addContent("text/plain", "Thank you for registering in book-flights, ".$first_name);
  $email->addContent(
      "text/html", "<strong>Thank you for registering in book-flights, ".$first_name."</strong>"
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

  header('Location:./register');
}
else{
  $_SESSION['error'] = '<b>Faild:</b>'.$con->error;
  header('Location:./register');
}


$con->close();


?>
