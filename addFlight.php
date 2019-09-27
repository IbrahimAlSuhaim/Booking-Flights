<?php

include './connectToDB.php';

if(!isset($_POST['submit']))
{
    header('Location:dashboard.php?failMsg=All fields are required');
    exit();
}
else if(empty($_POST['from']) or empty($_POST['to']) or empty($_POST['carrier']) or empty($_POST['airplane']) or empty($_POST['departure_date']) or empty($_POST['departure_time']) or empty($_POST['arrival_date']) or empty($_POST['arrival_time']))
{
    header('Location:dashboard.php?failMsg=All fields are required');
    exit();
}
else if($_POST['from'] == $_POST['to'])
{
    header('Location:dashboard.php?failMsg=from field and to field must be different');
    exit();
}
else
{
    //$flight_number = uniqid();
    $flightsCount = $con->query("SELECT COUNT(*) FROM flights")->fetch_assoc()['COUNT(*)']+1000; //get number of flights in the DB
    $flight_number = $_POST['carrier'].''.$flightsCount;
    $from = $_POST['from'];
    $to = $_POST['to'];
    $carrier = $_POST['carrier'];
    $airplane = $_POST['airplane'];
    $departure_date = $_POST['departure_date'];
    $departure_time = $_POST['departure_time'];
    $arrival_date = $_POST['arrival_date'];
    $arrival_time = $_POST['arrival_time'];

    if($airplane == "Boeing 777-300ER")
        $capacity = 365;
    else if($airplane == "Airbus A330")
        $capacity = 293;
    else
        $capacity = 300;


$sql = " INSERT INTO `flights`(`flight_number`,`from`,`to`,`carrier`,`airplane`,`departure_date`,`departure_time`,`arrival_date`,`arrival_time`,`capacity`) VALUES ('$flight_number','$from','$to','$carrier','$airplane','$departure_date','$departure_time','$arrival_date','$arrival_time',$capacity); ";

mysqli_query($con,$sql);

header('Location:dashboard.php?successMsg=Added successfully');

}

mysqli_close($con);


?>
