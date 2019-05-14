<?php
include '../config/connection.php';
$response = [];
$educationempid   = trim($_POST['empid1']);

$educationdegree   = trim($_POST['degreename']);
$educationspecialization  = trim($_POST['specialization']);
$passingyear  = trim($_POST['yearofpassing']);
$university     = trim($_POST['university']);
$cgpa = trim($_POST['cgpa']);
$eduempid = $_REQUEST['eduid1'];
if(empty($eduempid))
{
  $sql = "INSERT INTO `EmployeeEducationDetails` (EmpId,Empdegree,specialization,passoutyear,university,CGPA)
  VALUES ('$educationempid','$educationdegree','$educationspecialization','$passingyear','$university','$cgpa')";
if(mysqli_query($con,$sql) or die(mysqli_error($con)))
{
  $response['add'] = true;
}
else
{
  $response['add'] = false;
}
}
else
{
  $sql = "UPDATE `EmployeeEducationDetails` SET Empdegree='$educationdegree',specialization='$educationspecialization',passoutyear='$passingyear',
  university='$university',CGPA='$cgpa' WHERE EduId='$eduempid'" ;
  if(mysqli_query($con,$sql) or die(mysqli_error($con)))
  {
    $response['update'] = true;
  }
  else
  {
    $response['update'] = false;
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
