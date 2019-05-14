<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$response = [];

 $sql_query = "SELECT E.EmpId,E.ProfilePic,E.EmpName,E.gender,E.DOB,E.Address,country,state,city,postalcode,EmailId,contactNumber,joining_date,ProfilePic,D1.DeptName,D.DesigName,ES.fromDate,ES.uptoDate,SUM(ES.Amount) AS NetSalary
FROM Employees E LEFT JOIN EmployeeDesignations ED ON E.EmpId = ED.EmpId
LEFT JOIN EmployeeDepartments ED1 ON ED1.EmpId = E.EmpId
LEFT JOIN Designations D ON D.DesigId = ED.DesigId
LEFT JOIN Departments D1 ON D1.DeptId = ED1.DeptId
LEFT JOIN EmployeeSalaryStructure ES ON ES.EmpId = E.EmpId
WHERE E.UserId='$UserId' AND CURRENT_DATE BETWEEN ES.fromDate AND ES.uptoDate
GROUP BY ES.EmpId";

// echo $sql_query;
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_array($result)){
    array_push($response,[
      'Empid'    => $row['EmpId'],
      'name'   => ucwords($row['EmpName']),
      'designation'   => ucwords($row['DesigName']),
      'department'   => ucwords($row['DeptName']),
      'contactNumber' => $row['contactNumber'],
      // 'Tot_sal' => $row['NetSalary'],
      'formDate' => $row['fromDate'],
      'img' => $row['ProfilePic'],
      'uptoDate' => $row['uptoDate']
    ]);
  }
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
 ?>
