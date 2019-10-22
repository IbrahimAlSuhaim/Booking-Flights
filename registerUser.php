<?php
include './connectToDB.php';
session_start();
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$hashed_password=password_hash($_POST['password'],PASSWORD_DEFAULT);


$sql= "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name','$last_name','$email','$hashed_password')";


if($con->query($sql)===TRUE){
  $_SESSION['message'] = 'Thank you for registration';
  header('Location:./register');
}
else{
  $_SESSION['error'] = '<b>Faild:</b>'.$con->error;
  header('Location:./register');
}


$con->close();
 ?>
<!-- 

this is for confirmation email
-->

<?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    
    require_once "PHPMailer\PHPMailer.php";
    require_once "PHPMailer\SMTP.php";
    require_once "PHPMailer\Exception.php";

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
    $mail->SMTPSecure="ssl";
    
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
