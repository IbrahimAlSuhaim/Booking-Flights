<?php
include './connectToDB.php';
session_start();
$username = $_POST['username'];

if($result=$con->query("SELECT * FROM admins WHERE username='$_POST[username]'")) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if($_POST['password']!='') {
    if(password_verify($_POST['password'],$row['password'])){
      date_default_timezone_set('Asia/Kuwait');
      $sql = "SELECT * FROM `flights` where '".date("Y-m-d")."'>=date(`departure_date`) AND '".date("h:i:s")."' > `departure_time`";
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
      if(isset($_POST['remember'])) {
        setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
      }
      else {
        $_SESSION['username']=$username;
      }
      header('Location:./dashboard');
    }
    else {
      $_SESSION['error'] = 'Wrong Username/Password';
      header('Location:./admin');
    }

  }
  else {
    $_SESSION['error'] = 'Enter Username and Password';
    header('Location:./admin');
  }
}
else {
  $_SESSION['error'] = 'Wrong Username/Password';
  header('Location:./admin');
}


 ?>
