<?php
require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$empid = $_POST['empid'];
$response =[];


$fetchData = "SELECT * FROM EmployeePFDetails WHERE EmpId = $empid";
$result = mysqli_query($con,$fetchData)OR die(mysqli_error($con));

if( mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);

  $response['PFInfoId'] = $row['id'];
  $response['pfnumber'] = $row['pfnumber'];
  $response['UAENumber'] = $row['UAENumber'];

}
mysqli_close($con);
exit(json_encode($response));
 ?>
