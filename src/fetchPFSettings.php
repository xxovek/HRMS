<?php
require_once '../config/connection.php';
session_start();
$response     = [];
$UserId = $_SESSION['a_id'];


// $fetchData = "SELECT id,PFPercent,SalComponentId,PT,WorkHours FROM ConfigSettings WHERE UserId = $UserId";

$fetchData = "SELECT ConfigSettings.id,PFPercent,SalComponentId,PT,WorkHours,SalaryHeads.HeadName FROM ConfigSettings,SalaryHeads WHERE SalaryHeads.SalaryHeadId = ConfigSettings.SalComponentId AND SalaryHeads.UserId = ConfigSettings.UserId 
AND ConfigSettings.UserId = $UserId";

$result = mysqli_query($con,$fetchData)OR die(mysqli_error($con));

if( mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);

  $response['id'] = $row['id'];
  $response['PFPercent'] = $row['PFPercent'];
  $response['SalComponentId'] = $row['SalComponentId'];
  $response['PT'] = $row['PT'];
  $response['WorkHours'] = $row['WorkHours'];
  $response['compName'] = $row['HeadName'];

}
mysqli_close($con);
exit(json_encode($response));

?>