<?php
include_once('../config/connection.php');
session_start();
$aid = $_SESSION['a_id'];

//SELECT day(holiday_date) FROM Holidays WHERE month(holiday_date) = '09'
$designname             = $_REQUEST['designationname'];
$deptId                 = $_REQUEST['department'];

$response        = [];

if(!empty($_REQUEST['designation_id'])){
  $designation_id = $_REQUEST['designation_id'];
  $sql_fetch  = "SELECT DesigName FROM Designations WHERE DesigId = '$designation_id'";
  $result = mysqli_query($con,$sql_fetch);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $sql_query  = "UPDATE Designations SET DesigName = '$designname',DeptId = '$deptId' WHERE DesigId = '$designation_id'";
    mysqli_query($con,$sql_query);
    }

  $response['true'] = true;
}
else {
  $sql_query  =  "INSERT INTO Designations(UserId,DeptId,DesigName) VALUES";
  $sql_query .=  "('$aid','$deptId','$designname')";
  mysqli_query($con,$sql_query);
  $response['true'] = true;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
