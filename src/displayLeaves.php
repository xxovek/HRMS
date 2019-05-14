<?php
require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];

// if(isset($_SESSION['Emp_id'])){
//   $Emp_id = $_SESSION['Emp_id'];
//   $sql ="SELECT E.ProfilePic,EL.EmpLeaveId,E.EmpName,D1.DeptName,L.LeaveType,
//   concat(DATE_FORMAT(EL.fromDate,'%a %e %M %Y'),' To ',DATE_FORMAT(EL.uptoDate,'%a %e %M %Y')) AS LeaveDate,
//   EL.NoOfDays,EL.Reason,EL.LeaveStatus,EL.created_at,EL.EmpId,DesigName
//   FROM EmployeeLeaves EL
//   LEFT JOIN Employees E ON E.EmpId = EL.EmpId
//   LEFT JOIN Leaves L ON L.LeaveId = EL.LeaveId
//   LEFT JOIN EmployeeDesignations ED ON E.EmpId=ED.EmpId
//   LEFT JOIN Designations D ON D.DesigId=ED.DesigId
//   LEFT JOIN EmployeeDepartments ED1 ON ED1.EmpId=E.EmpId
//   LEFT JOIN Departments D1 ON D1.DeptId=ED1.DeptId
//   WHERE EL.EmpId= $Emp_id GROUP BY EL.EmpLeaveId";
//   }
// else {
$sql ="SELECT E.EmpId, E.ProfilePic,EL.EmpLeaveId,E.EmpName,D1.DeptName,L.LeaveType,
concat(DATE_FORMAT(EL.fromDate,'%a %e %M %Y'),' To ',DATE_FORMAT(EL.uptoDate,'%a %e %M %Y')) AS LeaveDate,
EL.NoOfDays,EL.Reason,EL.LeaveStatus,EL.created_at,EL.EmpId,DesigName
FROM EmployeeLeaves EL
LEFT JOIN Employees E ON E.EmpId = EL.EmpId
LEFT JOIN Leaves L ON L.LeaveId = EL.LeaveId
 LEFT JOIN EmployeeDesignations ED ON E.EmpId=ED.EmpId
 LEFT JOIN Designations D ON D.DesigId=ED.DesigId
 LEFT JOIN EmployeeDepartments ED1 ON ED1.EmpId=E.EmpId
 LEFT JOIN Departments D1 ON D1.DeptId=ED1.DeptId
WHERE E.UserId= $UserId GROUP BY EL.EmpLeaveId";
// echo $sql;
// }
// echo $sql;
$response = [];
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){
    array_push($response,[
      'EmpId' => $row['EmpId'],
      'leave_id' => $row['EmpLeaveId'],
      'Emp_fname' => ucwords($row['EmpName']),
      'Emp_department' => ucwords($row['DeptName']),
      'Emp_designation' => ucwords($row['DesigName']),
      'Leaves_Emp_id' => $row['EmpId'],
      'Leaves_leave_type'=> ucwords($row['LeaveType']),
      'Leaves_date' => $row['LeaveDate'],
      'Leaves_no_of_days' => $row['NoOfDays'],
      'Leaves_reason' => $row['Reason'],
      'Leaves_status' => $row['LeaveStatus'],
      'created_at'    => $row['created_at'],
      'img'    => $row['ProfilePic']

    ]);
  }
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
 ?>
