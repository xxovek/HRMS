<?php
require_once '../config/connection.php';
session_start();
$response     = [];
$UserId = $_SESSION['a_id'];
$PFValue = $_POST['PFPercentVal'];
$SalComponent = $_POST['option'];
$PTValue = $_POST['PTValue'];
$PFRecordId = $_POST['PFRecordId'];

if(empty($PFRecordId)){

$sql = "INSERT INTO `ConfigSettings`( `UserId`,`PFPercent`, `SalComponentId`, `PT`)";
$sql .= "VALUES ($UserId,'$PFValue','$SalComponent','$PTValue')";

if(mysqli_query($con,$sql) or die(mysqli_error($con))){
    // $response['add'] = true;
    if(mysqli_affected_rows($con)>0){
      $response['add'] = true;
    }else{ 
      $response['add'] = 'noChange';
      }
    }else {
      $response['add'] = false;
    }
}
else{
  $sql_update = "UPDATE ConfigSettings 
  SET PFPercent= '$PFValue',
  SalComponentId='$SalComponent',
  PT= '$PTValue' WHERE UserId = $UserId";
  
  if(mysqli_query($con,$sql_update) or die(mysqli_error($con))){
      // $response['update'] = true;
      if(mysqli_affected_rows($con)>0){
        $response['update'] = true;
      }else{ 
        $response['update'] = 'noChange';
        }
      }else {
        $response['update'] = false;
      }
}

mysqli_close($con);
exit(json_encode($response));
?>