<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$emailTo= 'i.su7aim@gmail.com';
$user_first_name = 'Ibrahim';


$email = new \SendGrid\Mail\Mail();
$email->setFrom("No-reply@bookflights.com", "Bookflights Team");
$email->setSubject("Reminder");
$email->addTo($emailTo, $user_first_name);
$email->addContent("text/plain", "Hi, ".$user_first_name." This is a reminder");
$email->addContent(
    "text/html", "<p>Hi 👋, ".$user_first_name."</p><br><strong>This is a reminder ⏰</strong>"
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

 ?>
