<?php
include_once('../config/connection.php');
$id = $_REQUEST['ExpId'];

$response = [];
$sql_query  = "DELETE FROM EmployeeExperienceDetails WHERE ExpId ='$id'";

if(mysqli_query($con,$sql_query)){
$response['true'] = true;
}else {
$response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
