<?php

require_once '../config/connection.php';
session_start();
$adminid = $_SESSION['a_id'];
$weekNumber = $_POST['weekNumber'];
$day = $_POST['day'];
$response = [];

$delete_sql = "DELETE FROM weekDaysOff WHERE day = '$day' AND weeknumber = $weekNumber AND UserId = $adminid";
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
