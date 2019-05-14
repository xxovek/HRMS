<?php


require_once '../config/connection.php';
session_start();
$adminid = $_SESSION['a_id'];

$taxid = $_POST['taxid'];
$response = [];

$delete_sql = "DELETE FROM TaxMaster WHERE t_id = '$taxid' AND UserId = $adminid";
$result = mysqli_query($con,$delete_sql)or die(mysqli_error($con));

if(mysqli_query($con,$delete_sql)or die(mysqli_error($con))){
  $response['msg'] = true;
}
else {
  $response['msg'] = false;
}


mysqli_close($con);
exit(json_encode($response));


?>