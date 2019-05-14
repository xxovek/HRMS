<?php
require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$empid = $_REQUEST['empid'];
$response     = [];
$pfNumber = $_POST['pfnum'];
$uaeNumber = $_POST['uaenum'];
$PFinfoID = $_POST['PFInfoAccId'];


if(empty($PFinfoID)){
  $sql  = "INSERT INTO EmployeePFDetails(EmpId, pfnumber, UAENumber)
  VALUES ($empid,'$pfNumber','$uaeNumber')";
  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
  $response['add'] = true;
  }else {
    $response['add'] = false;
  }
}
else{
  $update = "UPDATE EmployeePFDetails
  SET pfnumber = '$pfNumber',UAENumber = '$uaeNumber' WHERE EmpId = $empid";
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
