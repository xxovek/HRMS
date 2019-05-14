<?php
require_once '../config/connection.php';
session_start();
$empemailid       = $_POST['email'];

$leavetype    = $_POST['leavetype'];
$from_date    = $_POST['from_date'];
$upto_date    = $_POST['upto_date'];
$numberofdays = $_POST['numberofdays'];
$Reason       = $_POST['Reason'];
$response     = [];
$status='New';
if(isset($_SESSION['EmpId'])){
  $Emp_id = $_SESSION['EmpId'];
  $sql  = "INSERT INTO EmployeeLeaves(EmpId,LeaveId,fromDate,uptoDate,NoOfDays,Reason,LeaveStatus) VALUES";
  $sql .= "('$Emp_id','$leavetype','$from_date','$upto_date','$numberofdays','$Reason','$status')";
  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
  $response['true'] = true;
  }else {
    $response['false'] = false;
  }
}
else {
  if(!empty($_REQUEST['leaveid'])){
    $l_id = $_REQUEST['leaveid'];
    $sql_query  = "SELECT EmpId FROM EmployeeLeaves WHERE EmpLeaveId = $l_id";
    $result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
    if(mysqli_num_rows($result)==1){
      $sql = "UPDATE EmployeeLeaves SET NoOfDays='$numberofdays',LeaveId = '$leavetype',fromDate = '$from_date',uptoDate='$upto_date',Reason = '$Reason' WHERE EmpLeaveId='$l_id' ";

      if(mysqli_query($con,$sql)){
      $response['update'] = true;
      }else {
        $response['false'] = false;
      }
    }
  }
  else {
    $Emp_id       = $_POST['email'];
$sql  = "INSERT INTO EmployeeLeaves(EmpId,LeaveId,fromDate,uptoDate,NoOfDays,LeaveStatus,Reason) VALUES";
$sql .= "('$Emp_id','$leavetype','$from_date','$upto_date','$numberofdays','$status','$Reason')";
if(mysqli_query($con,$sql) or die(mysqli_error($con))){
$response['true'] = true;
}else {
  $response['false'] = false;
}
}
  // $Emp_id       = $_POST['Emp_id'];
  // $sql  = "INSERT INTO EmployeeLeaves(Emp_id,leave_type,from_date,upto_date,numOfDays,reason,status) VALUES";
  // $sql .= "('$Emp_id','$leavetype','$from_date','$upto_date','$numberofdays','$Reason','$status')";
}


mysqli_close($con);
exit(json_encode($response));
 ?>
