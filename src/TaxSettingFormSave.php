<?php

require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
// $companyId = ;
$response=[];

$InputTaxName = $_POST['taxName'];
$InputTaxVal  = $_POST['taxVal'];

if(empty($_POST['taxId']) && !empty($_POST['taxName']) && !empty($_POST['taxVal']) ){
  // if(){
//   $DeletPrevDayOff_sql = "DELETE FROM weekDaysOff WHERE day = '$selectedDay' AND weeknumber = $selectedWeek AND UserId = $UserId";
//    mysqli_query($con,$DeletPrevDayOff_sql)or die(mysqli_error($con));

    $sql_query = "INSERT INTO TaxMaster(UserId, taxname, taxvalue)";
    $sql_query .="VALUES($UserId,'$InputTaxName',$InputTaxVal)";
    if (mysqli_query($con,$sql_query)or die(mysqli_error($con))) {
      $response['add'] = true;
    }else {
      $response['add'] = false;
    }
  // }
}
elseif(!empty($_POST['taxId'])) {
    $tid = $_POST['taxId'];
  if(!empty($_POST['taxName']) && !empty($_POST['taxVal'])){
  $update_sql = "UPDATE TaxMaster SET taxname ='$InputTaxName',taxvalue = $InputTaxVal WHERE t_id = $tid AND UserId = $UserId";
  if (mysqli_query($con,$update_sql)or die(mysqli_error($con))) {
    if(mysqli_affected_rows($con)>0){
      $response['update'] = true;
    }else{ 
      $response['update'] = 'noChange';
      }
  }else {
    $response['update'] = false;
  }
}
}

mysqli_close($con);
exit(json_encode($response));

?>