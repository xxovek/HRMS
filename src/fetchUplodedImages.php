<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$response = [];

$sql = "SELECT ProfilePic ,logoImage FROM users WHERE userId = $UserId";
$result = mysqli_query($con,$sql)OR die(mysqli_error($con));

if( mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);
  $response['ProfilePic'] = $row['ProfilePic'];
  $response['logoImage'] = $row['logoImage'];
}
mysqli_close($con);
exit(json_encode($response));
?>