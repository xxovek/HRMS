<?php

require_once "../config/connection.php";
session_start();
$adminid = $_SESSION['a_id'];
$response=[];

$fetch_sql = "SELECT id, userId, FromBal, UptoBal, Percentage, Created_at FROM TdsDetails WHERE userId=$adminid OR userId IS NULL";
$result = mysqli_query($con,$fetch_sql)or die(mysqli_error($con));

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    array_push($response,[
      'id' => $row['id'],
      'Company_id' => $row['userId'],
      'FromBal' => $row['FromBal'],
      'UptoBal' => $row['UptoBal'],
      'Percentage' => $row['Percentage'],
      'createdDate' => $row['Created_at']
    ]);
  }
}

mysqli_close($con);
exit(json_encode($response));
?>
