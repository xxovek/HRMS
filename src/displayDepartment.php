<?php
include_once('../config/connection.php');

session_start();
$UserId = $_SESSION['a_id'];
$sql = "SELECT DeptId,DeptName FROM Departments WHERE UserId = $UserId";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'd_id' => $row['DeptId'],
        'dept_name' => ucwords($row['DeptName'])
      ]);
    }

  }
}
mysqli_close($con);
exit(json_encode($response));
  ?>
