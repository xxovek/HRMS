<?php
include_once('../config/connection.php');
$id = $_REQUEST['edudetails'];

$response = [];
$sql_query  = "DELETE FROM EmployeeEducationDetails WHERE EduId ='$id'";
if(mysqli_query($con,$sql_query)){
$response['true'] = true;
}else {
$response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
