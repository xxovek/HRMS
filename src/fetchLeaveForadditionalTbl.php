
<?php
require_once '../config/connection.php';
session_start();
$response = [];
$temp = [];
$UserId = $_SESSION['a_id'];
$Emp_id = $_POST['empid'];
$leavetbl_query = "SELECT sum(NoOfDays)  AS EmpLeaveSum ,LeaveId  FROM EmployeeLeaveAdditional WHERE EmpId = $Emp_id GROUP BY LeaveId,EmpId";
$leavetblResult = mysqli_query($con,$leavetbl_query) or die(mysqli_error($con));

if(mysqli_num_rows($leavetblResult)>0){
  while($row = mysqli_fetch_array($leavetblResult) ) {
    array_push($temp,[
      'EmpLeaveSum' => $row['EmpLeaveSum'],
      'EmpLeaveId' => $row['LeaveId']
    ]);
}
}

$sql_query = "SELECT LeaveId,LeaveType,NoOfDays,FromDate,UptoDate FROM Leaves WHERE UserId = $UserId";
$sql_queryResult = mysqli_query($con,$sql_query)or die(mysqli_error($con));

if(mysqli_num_rows($sql_queryResult)>0){
$i = 0;
while($row = mysqli_fetch_array($sql_queryResult) ) {

if(!empty($temp[$i]['EmpLeaveSum']) ){
  $EmpLvSum = $temp[$i]['EmpLeaveSum'];
}
else {
  $EmpLvSum = 0;
}
array_push($response,[
  'LeaveId' => $row['LeaveId'],
  'LeaveType' => $row['LeaveType'],
  'NoOfDays' => $row['NoOfDays'],
  'FromDate' => $row['FromDate'],
  'UptoDate' => $row['UptoDate'],
  'EmpLeaveSum' => $EmpLvSum
]);

$i++;
}

}
mysqli_close($con);
exit(json_encode($response));

?>
