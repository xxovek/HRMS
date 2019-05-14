<?php
include_once('../config/connection.php');
session_start();
$aid = $_SESSION['a_id'];
$emp_id = $_POST['emp_id'];
$tblDataArr = $_POST['TableValues'];
$startDate = $_POST['startdate'];
$endDate = $_POST['enddate'];
$funCall = $_POST['funCall'];
$itrator = new ArrayIterator($tblDataArr);

if($funCall === '0'){
  $sql_ins = "INSERT INTO EmployeeSalaryStructure(EmpId, SalaryHeadId, Amount, fromDate, uptoDate) VALUES";

  while ($itrator -> valid()) {
    $currentItem = $itrator->current();
    $sql_ins .='('.$emp_id.','.$currentItem['compo'].','
    .$currentItem['amt'].',"'.$startDate.'","'.$endDate.'")';
    $itrator -> next();
    $sql_ins .= $itrator->key() ? ',' : ';';
  }
  mysqli_query($con,$sql_ins);
}

else{

 $sql_del = "DELETE FROM EmployeeSalaryStructure WHERE EmpId = '$emp_id' AND CURRENT_DATE BETWEEN '$startDate' AND '$endDate'";
 mysqli_query($con,$sql_del);

 $sql_ins = "INSERT INTO EmployeeSalaryStructure(EmpId, SalaryHeadId, Amount, fromDate, uptoDate) VALUES";
 while ($itrator -> valid()) {
   $currentItem = $itrator->current();
   $sql_ins .='('.$emp_id.','.$currentItem['compo'].','
   .$currentItem['amt'].',"'.$startDate.'","'.$endDate.'")';
   $itrator -> next();
   $sql_ins .= $itrator->key() ? ',' : ';';
 }
 mysqli_query($con,$sql_ins);
  //update
}
// echo $sql_ins;
mysqli_close($con);

 ?>
