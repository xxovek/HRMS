<?php
include_once('../config/connection.php');
session_start();
$adminid = $_SESSION['a_id'];
$Emp_id    = $_POST['id'];
$yr   = $_POST['yr'];
$month1    = $_POST['month'];
$month = date("m", strtotime($month1));
$response  = [];
$sql_query  = "SELECT *,(L.NoOfDays+IFNULL(AL.NoOfDays,0)) as asLeaves,L.LeaveId as lid FROM Leaves L LEFT JOIN EmployeeLeaveAdditional AL
 ON L.LeaveId=AL.LeaveId AND AL.LeaveId=4  AND YEAR(L.FromDate)='$yr' WHERE L.UserId = $adminid";
// "SELECT * FROM Leaves WHERE YEAR(FromDate)='$yr'";
// echo $sql_query;

$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){
    $leaveId=$row['lid'];
    $sql  = "SELECT IFNULL(SUM(`NoOfDays`),0) as takenLeaves FROM EmployeeLeaves WHERE EmpId='$Emp_id' AND `LeaveId`='$leaveId' AND YEAR(fromDate)='$yr'
    AND MONTH(fromDate)<='$month'";
    $result1 = mysqli_query($con,$sql);
    $row1 = mysqli_fetch_array($result1);
    $balance=$row['asLeaves']-$row1['takenLeaves'];
    array_push($response,[
      'Leave'    => $row['LeaveType'],
      'asLeaves'   => $row['asLeaves'],
      'takenLeaves'   => $row1['takenLeaves'],
      'balanceLeaves'   => $balance
    ]);
  }
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
 ?>
