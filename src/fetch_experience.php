
<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$empid = $_REQUEST['empexperience'];

$response = [];
$sql_query  = "SELECT EmployerName,NoOfYear,NoOfMonth,EmployeeExperienceDetails.EmpId as EmpExpId,EmployeeExperienceDetails.ExpId as ExperienceId
FROM Employees,EmployeeExperienceDetails WHERE
 Employees.EmpId =EmployeeExperienceDetails.EmpId AND Employees.UserId='$UserId' AND  Employees.EmpId='$empid'";
// echo $sql_query;
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){
    array_push($response,[
      'EmpExpId'    => $row['EmpExpId'],
      'ExperienceId'    => $row['ExperienceId'],
      'EmployerName'   => ucwords($row['EmployerName']),
      'NoOfYear'   => $row['NoOfYear'],
      'NoOfMonth'   => $row['NoOfMonth']
    ]);
  }
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
 ?>
