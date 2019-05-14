<?php
include '../config/connection.php';
$response = [];
mysqli_query($con,'SET foreign_key_checks = 0');
$employeeSkill   = trim($_POST['skill_ip']);
$empskillid = $_REQUEST['skillid'];//hidden ip
$empid = $_REQUEST['empskillid'];

if(empty($empskillid)){
  $sql = "INSERT INTO `EmployeeSkillsDetails`(EmpId,SkillName)
  VALUES ('$empid','$employeeSkill')";

  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
    $response['add'] = true;
  }
  else{
    $response['add'] = false;
  }

}
else {
  $sql = "UPDATE `EmployeeSkillsDetails` SET SkillName='$employeeSkill'
 WHERE SkillId='$empskillid'" ;
  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
    $response['update'] = true;
  }
  else{
    $response['update'] = false;
  }
}
mysqli_query($con,'SET foreign_key_checks = 1');

mysqli_close($con);
exit(json_encode($response));
 ?>
