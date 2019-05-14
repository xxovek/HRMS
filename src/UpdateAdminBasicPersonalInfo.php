<?php

require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$response = [];

$adminFName = $_POST['inputFName'];
$adminLName = $_POST['inputLName'];
$adminEmail = $_POST['email'];
$adminPWD = $_POST['pwd'];
$adminPhone = $_POST['phone'];


if(empty($adminPWD)){
  $UpdateQuery = "UPDATE users SET fname ='$adminFName',lname='$adminLName', email='$adminEmail',contactNumber='$adminPhone' WHERE userId = $UserId";
}
else{
  $UpdateQuery = "UPDATE users SET fname ='$adminFName',lname='$adminLName', email='$adminEmail',contactNumber='$adminPhone',upassword = '$adminPWD' WHERE userId = $UserId";
}

if(mysqli_query($con,$UpdateQuery)or die(mysqli_error($con))){
  if(mysqli_affected_rows($con)>0){
    $response['true'] = true;
  }else{ 
    $response['true'] = 'noChange';
    }
}
else{
  $response['true'] = false;
}

mysqli_close($con);
exit(json_encode($response));

 ?>
