<?php
include '../../config/connection.php';
session_start();
$EmpId = $_SESSION['Emp_id'];
$sql1 = "SELECT * FROM EmployeeSkillsDetails WHERE EmpId = $EmpId";

$response = [];

if($result = mysqli_query($con,$sql1)){
    while($row = mysqli_fetch_array($result))
    {
      array_push($response,[
        'skill' => $row['SkillName']
      ]);

  }
}
mysqli_close($con);
echo json_encode($response);
?>
