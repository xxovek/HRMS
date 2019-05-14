<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$l_id       = $_POST['leave_id'];
$status      = $_POST['status'];
$Emp_id = $_POST['empid'];
$response     = [];

    $sql = "UPDATE EmployeeLeaves SET LeaveStatus = '$status' WHERE EmpLeaveId= $l_id AND EmpId = $Emp_id ";
    if(mysqli_query($con,$sql)){
    $response['update'] = true;
    }else {
      $response['false'] = false;
    }
    mysqli_close($con);
exit(json_encode($response));
?>
