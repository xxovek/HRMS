<?php
include '../../config/connection.php';
$leave_id = $_POST['leave_id'];
// $Emp_id   =$_REQUEST['Emp_id'];
$sql = "DELETE FROM EmployeeLeaves WHERE EmpLeaveId='$leave_id'";
$response = [];
if(mysqli_query($con,$sql)){
  $response['true'] = true;
}
else {
$response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
