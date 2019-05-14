
<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$empid = $_REQUEST['empskillid'];

$response = [];
$sql_query  = "SELECT SkillName,EmployeeSkillsDetails.EmpId as EmpSkillId,EmployeeSkillsDetails.SkillId as skillid
FROM Employees,EmployeeSkillsDetails WHERE
 Employees.EmpId = EmployeeSkillsDetails.EmpId AND Employees.EmpId='$empid'";
// echo $sql_query;

// SELECT `SkillId`, `EmpId`, `SkillName`, `created_at`, `updated_at` FROM `EmployeeSkillsDetails` WHERE 1
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){
    array_push($response,[
      'EmpSkillId'    => $row['EmpSkillId'],
      'SkillName'   => ucwords($row['SkillName']),
      'SkillId'    => $row['skillid']
    ]);
  }
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
 ?>
