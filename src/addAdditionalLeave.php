<?php
require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$eid    = $_REQUEST['e_id'];
$sign    = $_REQUEST['signs'];
$leavetype    = $_POST['leavetype'];
$numberofdays = $_POST['numdays'];
$response     = [];
$numberofdays1 = $sign.$numberofdays;
  $sql  = "INSERT INTO EmployeeLeaveAdditional(UserId,EmpId,LeaveId,NoOfDays) VALUES";
  $sql .= "('$UserId','$eid',$leavetype,'$numberofdays1')";
  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
  $response['true'] = true;
  }else {
    $response['false'] = false;
  }

mysqli_close($con);
exit(json_encode($response));
 ?>
