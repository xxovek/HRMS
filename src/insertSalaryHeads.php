<?php
include_once('../config/connection.php');
session_start();
$aid = $_SESSION['a_id'];
$salaryHead      = $_REQUEST['ip_salaryhead'];
$type            = $_REQUEST['type'];
$response        = [];

if(!empty($_REQUEST['SalaryHead_id']))
{
  $SalaryHead_id = $_REQUEST['SalaryHead_id'];
  $sql_fetch  = "SELECT HeadName,CredDebit FROM SalaryHeads WHERE SalaryHeadId = '$SalaryHead_id'";
  $result = mysqli_query($con,$sql_fetch);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $sql_query  = "UPDATE SalaryHeads SET HeadName = '$salaryHead',CredDebit = '$type' WHERE SalaryHeadId = '$SalaryHead_id'";
    mysqli_query($con,$sql_query);
    }
  $response['true'] = true;
}
else
{
  $sql_query  =  "INSERT INTO SalaryHeads(UserId,HeadName,CredDebit) VALUES";
  $sql_query .=  "('$aid','$salaryHead','$type')";
  mysqli_query($con,$sql_query);
  $response['true'] = true;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
