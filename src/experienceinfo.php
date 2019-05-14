<?php
include '../config/connection.php';
$response = [];
mysqli_query($con,'SET foreign_key_checks = 0');

$employeername   = trim($_POST['employeername']);

$Noofyear   = trim($_POST['Noofyear']);
$Noofmonth  = trim($_POST['Noofmonth']);
$empexpid = $_REQUEST['experienceid'];

$empid = $_REQUEST['empexpid'];
if(empty($empexpid))
{
  $sql = "INSERT INTO `EmployeeExperienceDetails` (EmpId,EmployerName,NoOfYear,NoOfMonth)
  VALUES ('$empid','$employeername','$Noofyear','$Noofmonth')";
if(mysqli_query($con,$sql) or die(mysqli_error($con))){
  $response['add'] = true;
}
else{
  $response['add'] = false;
}
}
else
{
  $sql = "UPDATE `EmployeeExperienceDetails` SET EmployerName='$employeername',NoOfYear='$Noofyear',NoOfMonth='$Noofmonth'
 WHERE ExpId='$empexpid'" ;
  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
    $response['update'] = true;
  }
  else
  {
    $response['update'] = false;
  }
}
mysqli_query($con,'SET foreign_key_checks = 1');

mysqli_close($con);
exit(json_encode($response));
?>
