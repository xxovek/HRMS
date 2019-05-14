<?php

require_once "../config/connection.php";
session_start();
$adminid = $_SESSION['a_id'];
$response=[];

$fetch_sql = "SELECT * FROM TaxMaster WHERE UserId = $adminid";
$result = mysqli_query($con,$fetch_sql)or die(mysqli_error($con));

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    array_push($response,[
      't_id' => $row['t_id'],
      'taxname' => $row['taxname'],
      'taxvalue' => $row['taxvalue'],
      'createdDate' => $row['created_at'],
      'updatedDate' => $row['updated_at']
    ]);
  }
}

mysqli_close($con);
exit(json_encode($response));
?>