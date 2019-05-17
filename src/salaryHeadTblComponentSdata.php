<?php
include_once('../config/connection.php');
session_start();
include_once('RecurcieveTDS.php');


$aid = $_SESSION['a_id'];
$emp_id = $_POST['emp_id'];
$tblDataArr = $_POST['TableValues'];
$startDate = $_POST['startdate'];
$endDate = $_POST['enddate'];
$funCall = $_POST['funCall'];
$ctcVal = $_POST['ctcValue'];
$TotalCTC = $ctcVal;
$avgTax = 0;
$totalTDS = calculateTDS($ctcVal);

$itrator = new ArrayIterator($tblDataArr);

if($funCall === '0'){
  $sql_ins = "INSERT INTO EmployeeSalaryStructure(EmpId, SalaryHeadId, Amount,ctcVal,percentage,fromDate, uptoDate) VALUES";

  while ($itrator -> valid()) {
    $currentItem = $itrator->current();
    $sql_ins .='('.$emp_id.','.$currentItem['compo'].','
    .$currentItem['amt'].',"'.$ctcVal.'","'.$currentItem['perc'].'","'.$startDate.'","'.$endDate.'")';
    $itrator -> next();
    $sql_ins .= $itrator->key() ? ',' : ';';
  }
  if( mysqli_query($con,$sql_ins)or die(mysqli_error($con))){
    
    $sql_tds_ins = "INSERT INTO EmployeeSalaryStructure(EmpId, SalaryHeadId, Amount,ctcVal,percentage,fromDate, uptoDate) 
             VALUES('$emp_id','3','$totalTDS',$ctcVal,'$avgTax','$startDate','$endDate')";
             if( mysqli_query($con, $sql_tds_ins )or die(mysqli_error($con))){
              $response['add'] = true;
             }
             else{
              $response['add'] = false;
            
              }
  }
  else{
  $response['add'] = false;

  }
}

else{

 $sql_del = "DELETE FROM EmployeeSalaryStructure WHERE EmpId = '$emp_id' AND CURRENT_DATE BETWEEN '$startDate' AND '$endDate'";
 mysqli_query($con,$sql_del);

 $sql_ins = "INSERT INTO EmployeeSalaryStructure(EmpId, SalaryHeadId, Amount,ctcVal,percentage, fromDate, uptoDate) VALUES";
 while ($itrator -> valid()) {
   $currentItem = $itrator->current();
   $sql_ins .='('.$emp_id.','.$currentItem['compo'].','
   .$currentItem['amt'].',"'.$ctcVal.'","'.$currentItem['perc'].'","'.$startDate.'","'.$endDate.'")';
   $itrator -> next();
   $sql_ins .= $itrator->key() ? ',' : ';';
 }
 if(mysqli_query($con,$sql_ins)or die(mysqli_error($con))){
  $sql_tds_ins = "INSERT INTO EmployeeSalaryStructure(EmpId, SalaryHeadId, Amount,ctcVal,percentage,fromDate, uptoDate) 
  VALUES('$emp_id','3','$totalTDS',$ctcVal,'$avgTax','$startDate','$endDate')";
  if( mysqli_query($con, $sql_tds_ins)or die(mysqli_error($con))){
   $response['add'] = true;
  }
  else{
   $response['add'] = false;
 
   }
  }
else{
$response['add'] = false;

}
   //mysqli_query($con,$sql_ins);
  //update
}
// echo $sql_ins;

mysqli_close($con);
exit(json_encode($response));

 ?>
