<?php
require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$response = [];
$sql_query ="SELECT fname, lname, email, contactNumber, firm, upassword, ProfilePic, logoImage FROM users WHERE userId = $UserId";
$result = mysqli_query($con,$sql_query)or die(mysqli_error($con));

if(mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);

$response['fname'] = $row['fname'];
$response['lname'] = $row['lname'];
$response['email'] = $row['email'];
$response['contactNumber'] = $row['contactNumber'];
$response['firm'] = $row['firm'];
$response['upassword'] = $row['upassword'];
$response['ProfilePic'] = $row['ProfilePic'];
$response['logoImage'] = $row['logoImage'];
}

mysqli_close($con);
exit(json_encode($response));

?>
