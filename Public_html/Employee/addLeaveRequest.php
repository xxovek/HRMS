<?php
include '../../config/connection.php';
session_start();

$leavetype    = $_POST['leavetype'];
$from_date    = $_POST['from_date'];
$upto_date    = $_POST['upto_date'];
$numberofdays = $_POST['numberofdays'];
$Reason       = $_POST['Reason'];
$response     = [];
$status='New';

  $Emp_id = $_SESSION['Emp_id'];
  if(empty($_REQUEST['leaveid']))
  {
  $sql  = "INSERT INTO EmployeeLeaves(EmpId,LeaveId,fromDate,uptoDate,NoOfDays,LeaveStatus,reason) VALUES";
  $sql .= "('$Emp_id','$leavetype','$from_date','$upto_date','$numberofdays','$status','$Reason')";
  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
  $response['true'] = true;
  }else {
    $response['false'] = false;
  }
}
else {
    $l_id = $_REQUEST['leaveid'];
      $sql = "UPDATE EmployeeLeaves SET NoOfDays='$numberofdays',LeaveId = '$leavetype',fromDate = '$from_date',uptoDate='$upto_date',LeaveStatus='$status',reason = '$Reason' WHERE EmpLeaveId='$l_id' ";
      if(mysqli_query($con,$sql)){
      $response['true'] = true;
      }else {
        $response['false'] = false;
      }
}
// echo $sql;

mysqli_close($con);
exit(json_encode($response));
 ?>
