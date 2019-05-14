<?php
include '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$response = [];

$sql = "SELECT * FROM Leaves WHERE UserId = $UserId";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      $fdate=date('M d Y', strtotime($row['FromDate']));
      $udate=date('M d Y', strtotime($row['UptoDate']));

      array_push($response,[
        'leave_id' => $row['LeaveId'],
        'leave_type' => ucwords($row['LeaveType']),
        'paidFlag' =>  $row['paidunpaidflag'],
        'numdays' => $row['NoOfDays'],
        'fdate' => $fdate,
        'udate' => $udate,
        'fromdate' => $row['FromDate'],
        'uptodate' => $row['UptoDate']
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
  ?>
