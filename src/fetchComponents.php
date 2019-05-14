<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
$emp_id = $_POST['emp_id'];
$fromDate = $_POST['fromDate'];
$uptoDate = $_POST['uptoDate'];

$response = [];

$sql_query = "SELECT EmpId,EmployeeSalaryStructure.SalaryHeadId,SalaryHeads.CredDebit,Amount,SalaryHeads.HeadName,EmployeeSalaryStructure.fromDate,EmployeeSalaryStructure.uptoDate
FROM EmployeeSalaryStructure,SalaryHeads
WHERE EmpId = '$emp_id'
AND fromDate = '$fromDate'
AND uptoDate = '$uptoDate'
AND SalaryHeads.SalaryHeadId = EmployeeSalaryStructure.SalaryHeadId";
// echo $sql_query;
$result = mysqli_query($con,$sql_query);
// echo $result;
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result)){
   array_push($response,[
     'Empid'    => $row['EmpId'],
     'HeadName'   => $row['HeadName'],
     'SalaryHeadId'   => $row['SalaryHeadId'],
     'CredDebitType'   => $row['CredDebit'],
     'Amount' => $row['Amount'],
     'formDate' => $row['fromDate'],
     'uptoDate' => $row['uptoDate']
   ]);
 }
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
?>
