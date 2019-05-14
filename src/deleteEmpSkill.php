<?php
include_once('../config/connection.php');
$SkillId = $_REQUEST['SkillId'];

$response = [];
$sql_query  = "DELETE FROM EmployeeSkillsDetails WHERE SkillId ='$SkillId'";

if(mysqli_query($con,$sql_query)){
$response['true'] = true;
}else {
$response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
