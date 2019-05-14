<?php

require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$empid = $_POST['empid'];
$response =[];

$fetchData = "SELECT * FROM EmployeeBankDetails WHERE EmpId = $empid";
$result = mysqli_query($con,$fetchData)OR die(mysqli_error($con));

if( mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);

  $response['BankDetailsId'] = $row['BankDetailsId'];
  $response['BankName'] = $row['BankName'];
  $response['BranchName'] = $row['BranchName'];
  $response['AccHolderName'] = $row['AccountName'];
  $response['AccountNumber'] = $row['AccountNumber'];
  $response['ifsc'] = $row['IFSC'];
}
mysqli_close($con);
exit(json_encode($response));
 ?>
