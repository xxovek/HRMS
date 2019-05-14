<?php
include_once '../../config/connection.php';
$username = $_REQUEST['uname'];
$password = $_REQUEST['pwd'];
$response = [];

$sql_query = "SELECT * FROM Employees WHERE EmailId='$username' AND EPassword='$password'";
$result = mysqli_query($con,$sql_query) or die(mysqli_error($cons));
// echo $sql_query;
if(mysqli_num_rows($result)==1){
session_start();
$row = mysqli_fetch_array($result);
$_SESSION['Emp_id'] = $row['EmpId'];
$_SESSION['UserId'] = $row['UserId'];
$response['success'] = true;
// header('LOCATION:index.php');
}else {
  $response['false'] = false;
  // header('LOCATION:EmployeeSalaryStructure.php');
  // echo $sql_query;
}
mysqli_close($con);
echo json_encode($response);
 ?>
