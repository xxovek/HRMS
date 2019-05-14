<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$response = [];
$emp_id = $_POST['emp_id'];
$startDate = $_POST['fromDate'];
$endDate = $_POST['uptoDate'];

$sql_del = "DELETE FROM EmployeeSalaryStructure WHERE EmpId = '$emp_id' AND CURRENT_DATE BETWEEN '$startDate' AND '$endDate'";
if(mysqli_query($con,$sql_del)){
$response['success'] = true;
}else {
  $response['success'] = false;
}

mysqli_close($con);
exit(json_encode($response));
 ?>
