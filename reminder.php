<?php
require 'vendor/autoload.php';

include './connectToDB.php';
$sql = "SELECT users.email AS user_email, users.first_name AS user_first_name, passengers.first_name, passengers.family_name, flights.departure_date, flights.departure_time, booked_tickets.ticket_id FROM users, flights, booked_tickets, passengers
WHERE users.user_id = booked_tickets.user_id AND flights.flight_id = booked_tickets.flight_id AND passengers.passenger_id = booked_tickets.passenger_id
AND flights.departure_date <= ".date('Y-m-d',strtotime("+1 days"))." AND flights.departure_time < '".date("H:i")."' AND booked_tickets.emailSent = 0 ";
$result=$con->query($sql);
if($result->num_rows>0) {
  while($row=mysqli_fetch_array($result)) {
    $emailTo = $row['user_email'];
    $user_first_name = $row['user_first_name'];

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("No-reply@bookflights.com", "Bookflights Team");
    $email->setSubject("Reminder");
    $email->addTo($emailTo, $user_first_name);
    $email->addContent("text/plain", "Hi, ".$user_first_name." This is a flight reminder");
    $email->addContent(
        "text/html", "<p>Hello ". $user_first_name. " 👋</p>
        <br>
        <strong>You have a flight in ".$row['departure_date']." at ".$row['departure_time']." with passenger name: ".$row['first_name']." ".$row['family_name']."</strong>
        <br>
        <br>
        <p>✈️ for more info visit </p><a href='http://book-flights.herokuapp.com/'> http://book-flights.herokuapp.com/</a>"
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

    $sql = "UPDATE booked_tickets SET emailSent = 1 WHERE ticket_id ='$row[ticket_id]'";
    $con->query($sql);
  }
}


 ?>
