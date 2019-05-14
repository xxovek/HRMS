<?php
include '../../config/connection.php';
session_start();
$EmpId =$_SESSION['Emp_id'];

$sql = "SELECT EmpLeaveId,LeaveType,DATE_FORMAT(E.fromDate,'%e %M %Y') fromDate,DATE_FORMAT(E.uptoDate,'%e %M %Y') uptoDate,E.NoOfDays as NoOfDays,LeaveStatus from EmployeeLeaves E INNER JOIN Leaves L ON E.LeaveId = L.LeaveId WHERE E.EmpId  = $EmpId";
$response = [];
// echo $sql;
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'LeaveType' => $row['LeaveType'],
        'fromDate' => $row['fromDate'],
        'uptoDate' => $row['uptoDate'],
        'NoOfDays' => $row['NoOfDays'],
        'LeaveStatus' => $row['LeaveStatus'],
        'EmpLeaveId' => $row['EmpLeaveId']
      ]);
    }

  }
}
mysqli_close($con);
echo json_encode($response);
?>
