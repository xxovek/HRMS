<?php

require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$empid = $_REQUEST['empid'];
$AccinfoID = $_POST['BankInfoId'];
$bankName = $_POST['bankName'];
$branchName = $_POST['branchName'];
$AccHolderName = $_POST['EmpFullName'];
$AccountNumber = $_POST['AccNumber'];
$ifsc = $_POST['bifsc'];
$response     = [];

if(empty($AccinfoID)){
  $sql  = "INSERT INTO EmployeeBankDetails(EmpId, BankName, BranchName, AccountName, AccountNumber, IFSC)
  VALUES ($empid,'$bankName','$branchName','$AccHolderName',$AccountNumber,'$ifsc')";
  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
  $response['add'] = true;
  }else {
    $response['add'] = false;
  }
}
else{
  $update = "UPDATE EmployeeBankDetails SET BankName = '$bankName' ,
  BranchName = '$branchName',AccountName = '$AccHolderName', AccountNumber = $AccountNumber,IFSC = '$ifsc'
  WHERE EmpId = $empid";
// echo $update;
  if(mysqli_query($con,$update) or die(mysqli_error($con))){
    $response['update'] = true;
  }
  else{
    $response['update'] = false;
  }
}



// $response['msg'] = true;
mysqli_close($con);
exit(json_encode($response));
 ?>
