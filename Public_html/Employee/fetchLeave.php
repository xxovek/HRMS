<?php
include '../../config/connection.php';

$l_id = $_REQUEST['leave_id'];
$response = [];
$sql_query  = "SELECT * FROM Leaves,EmployeeLeaves WHERE Leaves.LeaveId=EmployeeLeaves.LeaveId AND  EmployeeLeaves.EmpLeaveId = '$l_id'";
// echo $sql_query;
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);

        $response['LeaveId']      = $row['LeaveId'];
        $response['LeaveType']      = $row['LeaveType'];
        $response['fromDate']   = $row['fromDate'];
        $response['uptoDate']       = $row['uptoDate'];
        $response['NoOfDays']          = $row['NoOfDays'];
        $response['reason']         = $row['reason'];

}else {
  $response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
