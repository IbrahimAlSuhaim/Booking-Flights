<?php
include './connectToDB.php';
date_default_timezone_set('Asia/Kuwait');
$sql = "SELECT * FROM `flights` where '".date("Y-m-d")."'>=date(`departure_date`) AND '".date("h:i:s")."' >= `departure_time`";
$result = $con->query($sql);
if($result->num_rows > 0) {
  while($row=mysqli_fetch_array($result)){
    $sql = "INSERT INTO `flights_archive`(`flight_id`, `flight_number`, `from`, `to`, `carrier`, `airplane`, `departure_date`, `departure_time`, `arrival_date`, `arrival_time`, `capacity`, `reserved`, `price_factor`)
    VALUES ('$row[flight_id]', '$row[flight_number]', '$row[from]', '$row[to]', '$row[carrier]', '$row[airplane]',
      '$row[departure_date]', '$row[departure_time]', '$row[arrival_date]', '$row[arrival_time]', '$row[capacity]', '$row[reserved]', '$row[price_factor]')";
    echo $sql;
    if($con->query($sql)===TRUE){
      $sql = "DELETE FROM `flights` WHERE `flight_id` = '$row[flight_id]'";
      $con->query($sql);
      echo 'success';
    }
    else{
      echo 'false'.$con->error;
    }
  }
}

 ?>
