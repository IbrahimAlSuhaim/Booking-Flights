<?php
// enter your sql login information------

$con=mysqli_connect("localhost","root","","booking_flight");

if(mysqli_connect_errno()){
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);

  $con = new mysqli($server, $username, $password, $db);


  if(mysqli_connect_errno()){
    die("Couldn't connect to the database beacuse: ".mysqli_connect_error());
  }
}



 ?>
