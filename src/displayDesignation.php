<?php
include_once('../config/connection.php');

session_start();
$UserId = $_SESSION['a_id'];

$sql = "SELECT DesigId,DeptId,DesigName FROM Designations  WHERE UserId = $UserId";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      $did = $row['DeptId'];
    $fetchDeptName_sql = "SELECT DeptName FROM Departments WHERE DeptId = $did";
    // echo $fetchDeptName_sql;
    $fetchDeptName_Res = mysqli_query($con,$fetchDeptName_sql);
    $DNameRow = mysqli_fetch_row($fetchDeptName_Res);
      // $deptName = $DNameRow[0];
      array_push($response,[
        'design_id' => $row['DesigId'],
        //deptName'  => $DNameRow['DeptName'],
        'deptName'  => $DNameRow[0],
        'deptId' => $row['DeptId'],
        'design_name' => $row['DesigName']
      ]);
    }

  }
}

mysqli_close($con);
exit(json_encode($response));
  ?>
