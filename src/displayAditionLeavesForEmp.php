
<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$response = [];
$sql_query  = "SELECT E.EmpId,E.ProfilePic,EmpName ,concat(E.city,'-',E.country) AS location,DATE_FORMAT(E.joining_date,'%e %M %Y') as
joining_date,DesigName,DeptName FROM Employees E LEFT JOIN EmployeeDesignations ED ON E.EmpId = ED.EmpId LEFT JOIN EmployeeDepartments ED1
 ON ED1.EmpId = E.EmpId LEFT JOIN Designations D ON D.DesigId = ED.DesigId LEFT JOIN Departments D1 ON D1.DeptId = ED1.DeptId WHERE E.UserId='$UserId'";
// echo $sql_query;
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){
    array_push($response,[
      'Empid'    => $row['EmpId'],
      'name'   => ucwords($row['EmpName']),
      'designation'   => ucwords($row['DesigName']),
      'department'   => ucwords($row['DeptName']),
      'Joining_date' => $row['joining_date'],
      'address' => $row['location'],
      'img' => $row['ProfilePic']

    ]);
  }
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
 ?>
