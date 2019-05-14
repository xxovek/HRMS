<?php
include '../config/connection.php';
$response = [];
session_start();

$userId = $_POST['emp_id'];
if(empty($_POST['yr'])){
$year         = date('Y');

}
else {
  $year  =$_POST['yr'];
}
if($year==date('Y'))
{
  $n=date('m');
}
else {
  $n=12;
}
for($i=1;$i<=$n;$i++)
{
  // $month= date('M', strtotime($i));
$month=date('F',strtotime('01.'.$i.'.'.$year));
$sql_query = "SELECT  IFNULL(SUM(`Amount`),0) as Amount FROM EmployeeSalaryPayslip WHERE YEAR(GeneratedDate)='$year' AND MONTH(GeneratedDate)='$i' AND EmpId=$userId";

// echo $sql_query;
$result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
  $row = mysqli_fetch_array($result);
    array_push($response,[
      'Amount'         => $row['Amount'],
      'Month'         => $month

    ]);
}
mysqli_close($con);
exit(json_encode($response));
 ?>
