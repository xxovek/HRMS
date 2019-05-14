<?php
include '../config/connection.php';
session_start();

$l_id = $_REQUEST['l_id'];
$EmpId =$_REQUEST['emp_id'];
$UserId = $_SESSION['a_id'];

$response = [];
$sql_query  = "SELECT * FROM Leaves WHERE LeaveId = '$l_id'";
// $sql="SELECT (E.NoOfDays+L.NoOfDays) as Balance from EmployeeLeaveAdditional E INNER JOIN Leaves L ON E.LeaveId = L.LeaveId WHERE E.EmpId  =$EmpId ";
$sql="SELECT NoOfDays from Leaves WHERE LeaveId = '$l_id'";

$sql1="SELECT NoOfDays from EmployeeLeaveAdditional WHERE UserId = '$UserId' AND LeaveId='$l_id' AND EmpId='$EmpId'";

$sql2="SELECT SUM(NoOfDays) as sum1 from EmployeeLeaves WHERE  LeaveId='$l_id' AND EmpId='$EmpId'";


$result = mysqli_query($con,$sql);
$result1 = mysqli_query($con,$sql1);
$result2 = mysqli_query($con,$sql2);

$row1 = mysqli_fetch_array($result1);
$row = mysqli_fetch_array($result);
$row2 = mysqli_fetch_array($result2);

$Numdays=$row1['NoOfDays']+$row['NoOfDays']-$row2['sum1'];
          // $response['Balance']      = $row1['Balance'];
        $response['NoOfDays']      = $Numdays;


mysqli_close($con);
exit(json_encode($response));
 ?>
