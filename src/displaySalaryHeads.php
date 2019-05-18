<?php
include '../config/connection.php';

session_start();
$aid = $_SESSION['a_id'];
$sql = "SELECT SalaryHeadId,HeadName,CredDebit,created_at FROM SalaryHeads WHERE UserId ='$aid' OR UserId IS NULL";

$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'SalaryHeadId' => $row['SalaryHeadId'],
        'HeadName' => $row['HeadName'],
        'CredDebit' => $row['CredDebit'],
        'created_at' => $row['created_at']
      ]);
    }

  }
}
mysqli_close($con);
exit(json_encode($response));
  ?>
