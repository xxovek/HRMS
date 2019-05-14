<?php
include_once('../config/connection.php');
$l_id = $_REQUEST['leave_id'];
$response = [];
$sql_query  = "SELECT EmployeeLeaves.EmpId,Leaves.LeaveId,EmployeeLeaves.fromDate,EmployeeLeaves.uptoDate,EmployeeLeaves.NoOfDays,EmployeeLeaves.Reason,Leaves.LeaveType,Employees.EmailId FROM Employees,EmployeeLeaves,Leaves WHERE Employees.EmpId=EmployeeLeaves.EmpId AND
EmployeeLeaves.LeaveId=Leaves.LeaveId AND  EmployeeLeaves.EmpLeaveId = '$l_id'";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);
        $response['Emp_id']      = $row['EmpId'];
        $response['leave_type']   = $row['LeaveType'];
        $response['leave_id']   = $row['LeaveId'];
        $response['useremail']   = $row['EmpId']."-".$row['EmailId'];
        $response['from_date']       = $row['fromDate'];
        $response['upto_date']          = $row['uptoDate'];
        $response['numOfDays']         = $row['NoOfDays'];
        $response['reason']  = $row['Reason'];

}else {
  $response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
