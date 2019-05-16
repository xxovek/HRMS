<?php

require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
// $companyId = ;
$response=[];

$startingamount = $_POST['startingamount'];
$endingamount  = $_POST['endingamount'];
$tdspercentage  = $_POST['tdspercentage'];
if(!empty($_POST['startingamount']) && !empty($_POST['endingamount']) && !empty($_POST['tdspercentage']) ){
    $sql_query = "INSERT INTO TdsDetails(Company_id,FromBal, UptoBal, Percentage) VALUES($UserId,'$startingamount','$endingamount','$tdspercentage')";
    if (mysqli_query($con,$sql_query)or die(mysqli_error($con))) {
      $response['add'] = true;
    }else {
      $response['add'] = false;
    }
}
elseif(!empty($_POST['TdsId'])) {
     $tid = $_POST['TdsId'];
  $update_sql = "UPDATE TdsDetails SET FromBal ='$startingamount',UptoBal = '$endingamount',Percentage='$tdspercentage' WHERE id = $tid AND Company_id = $UserId";
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

mysqli_close($con);
exit(json_encode($response));

?>
