<?php
include './connectToDB.php';
session_start();
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$hashed_password=password_hash($_POST['password'],PASSWORD_DEFAULT);


$sql= "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name','$last_name','$email','$hashed_password')";


if($con->query($sql)===TRUE){
  $_SESSION['message'] = 'Thank you For registration';
  //header('Location:./register');
}
else{
  $_SESSION['error'] = '<b>Faild:</b>'.$con->error;
  //header('Location:./register');
}


$con->close();
 ?>
<!--

this is for confirmation email
-->

<?php

    use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
  //  require 'vendor/autoload.php';


    // require_once "PHPMailer\PHPMailer.php";
    // require_once "PHPMailer\SMTP.php";
    // require_once "PHPMailer\Exception.php";

    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
    $tot = 'hii';
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "ksu444project@gmail.com";
    $mail->Password = "444project";
    $mail->Port = 465;
    $mail->SMTPSecure="tls";

    $mail->isHTML(true);
    $mail->setFrom("ksu444project@gmail.com",'Admin');
    $mail->addAddress($email);
    $mail->Subject = 'Thank you';
    $mail->Body = 'Thank you for registering in book-flights.herokuapp.com';

    if($mail->send())
        echo "done";
    else
        echo $mail->ErrorInfo;
    ?>

    <?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases
$email = new \SendGrid\Mail\Mail();
$email->setFrom("ksu444project@gmail.com", "Admin");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo($email, "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
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
