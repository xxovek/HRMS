<?php
include_once('../config/connection.php');
session_start();
$aid = $_SESSION['a_id'];

//SELECT day(holiday_date) FROM Holidays WHERE month(holiday_date) = '09'
$deptname             = $_REQUEST['departmentname'];
$response        = [];

if(!empty($_REQUEST['department_id'])){
  $department_id = $_REQUEST['department_id'];
  $sql_fetch  = "SELECT DeptName FROM Departments WHERE DeptId = '$department_id'";
  $result = mysqli_query($con,$sql_fetch);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $sql_query  = "UPDATE Departments SET DeptName = '$deptname' WHERE DeptId = '$department_id'";
    mysqli_query($con,$sql_query);
    }

  $response['true'] = true;
}
else {
  $sql_query  =  "INSERT INTO Departments(UserId,DeptName) VALUES";
  $sql_query .=  "('$aid','$deptname')";
  mysqli_query($con,$sql_query);
  $response['true'] = true;

}
mysqli_close($con);
exit(json_encode($response));
 ?>
