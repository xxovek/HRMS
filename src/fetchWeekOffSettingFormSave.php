<?php

require_once '../config/connection.php';
session_start();
$adminid = $_SESSION['a_id'];
$response = [];

$fetch_sql = "SELECT DISTINCT weeknumber,day FROM weekDaysOff where UserId = $adminid";
$result = mysqli_query($con,$fetch_sql)or die(mysqli_error($con));

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    array_push($response,[
      // 'h_id' => $row['HolidayId'],
      'weeknumber' => $row['weeknumber'],
      'day' => $row['day']
    ]);
  }
}

mysqli_close($con);
exit(json_encode($response));
 ?>

<!-- //SELECT COUNT( DISTINCT weeknumber),COUNT( DISTINCT day) FROM weekDaysOff where UserId = 1  -->
