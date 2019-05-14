
<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$empid = $_REQUEST['empeducation'];

$response = [];
$sql_query  = "SELECT Empdegree,specialization,passoutyear,university,CGPA,EmployeeEducationDetails.EmpId as EmpEdId,EmployeeEducationDetails.EduId as EmpEducationId FROM Employees,EmployeeEducationDetails WHERE
 Employees.EmpId =EmployeeEducationDetails.EmpId AND Employees.UserId='$UserId' AND  Employees.EmpId='$empid'";
// echo $sql_query;
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){
    array_push($response,[
      'Empid'    => $row['EmpEdId'],
      'Empeduid'    => $row['EmpEducationId'],
      'Empdegree'   => ucwords($row['Empdegree']),
      'specialization'   => ucwords($row['specialization']),
      'passoutyear'   => $row['passoutyear'],
      'university' => ucwords($row['university']),
      'CGPA' => $row['CGPA']
    ]);
  }
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
 ?>
