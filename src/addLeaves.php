<?php
include_once('../config/connection.php');
session_start();
$aid = $_SESSION['a_id'];
$leavetype             = $_REQUEST['leavetype'];
$fdate            = $_REQUEST['fromdate'];
$udate            = $_REQUEST['uptodate'];
$days            = $_REQUEST['numdays'];

$paidUnpaidFlag  = $_REQUEST['type'];
$response        = [];

if(!empty($_REQUEST['leave_id'])){
  $leave_id = $_REQUEST['leave_id'];
  $sql_fetch  = "SELECT LeaveType FROM Leaves WHERE LeaveId = '$leave_id'";
  $result = mysqli_query($con,$sql_fetch);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $sql_query  = "UPDATE Leaves SET LeaveType = '$leavetype',paidunpaidflag='$paidUnpaidFlag',FromDate='$fdate',UptoDate='$udate',NoOfDays='$days' WHERE LeaveId = $leave_id";
    mysqli_query($con,$sql_query);
    }
  $response['update'] = true;
}
else{
  $sql_query  =  "INSERT INTO Leaves(UserId,LeaveType,NoOfDays,paidunpaidflag,FromDate,UptoDate) VALUES";
  $sql_query .=  "($aid,'$leavetype','$days',$paidUnpaidFlag,'$fdate','$udate')";
  mysqli_query($con,$sql_query);
  $response['add'] = true;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
