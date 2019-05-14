<?php
include '../config/connection.php';
session_start();
$adminid = $_SESSION['a_id'];
$response =  [];
$yr=$_REQUEST['yr'];
$month1=$_REQUEST['month'];
$month = date("m", strtotime($month1));

$date1=$yr.'-'.$month.'-01';

$arrJson=$_REQUEST['arr'];
$userId=$_REQUEST['empattendanceid'];
$presentCnt=$holidayCnt=$LeaveCnt=0;
$daysinMonth=$_REQUEST['days'];
$length=count($arrJson);
$sql_leave = "SELECT SUM(Amount) FROM EmployeeSalaryStructure WHERE EmpId=$userId";
$result_leave = mysqli_query($con,$sql_leave) or die(mysqli_error($con));
$row=mysqli_fetch_array($result_leave);
for ($i=0; $i <$length ; $i++) {
  $result=$arrJson[$i];
  if($result=='PRESENT')
  {
    $presentCnt++;
  }
else if($result=='Holiday')
  {
    $holidayCnt++;
  }
  else if($result=='Leave')
    {
      $LeaveCnt++;
    }
  }

$perday=($row[0])/30;
$totalDays=($presentCnt+$holidayCnt+$LeaveCnt);
$salary=($perday*$totalDays);

  $FindTaxValu_sql ="SELECT taxvalue FROM TaxMaster WHERE UserId = $adminid";
  $result_TaxValu = mysqli_query($con,$FindTaxValu_sql) or die(mysqli_error($con));
  // $result_row=mysqli_fetch_array($result_TaxValu);
  $TaxAmt =  0;
  while($result_row=mysqli_fetch_array($result_TaxValu)){
   
    $TaxAmt += ($salary * ($result_row['taxvalue']/100));
  }

  $salary_withTax = $salary - $TaxAmt;
$response['sal'] = round($salary_withTax,2);

$sql_check = "SELECT PayslipId FROM `EmployeeSalaryPayslip` WHERE EmpId='$userId' AND GeneratedDate='$date1'";
$result_check = mysqli_query($con,$sql_check) or die(mysqli_error($con));
if(mysqli_num_rows($result_check)>0)
{
  $sql_del = "DELETE FROM `EmployeeSalaryPayslip` WHERE EmpId='$userId' AND GeneratedDate='$date1'";
  $result_del = mysqli_query($con,$sql_del) or die(mysqli_error($con));
}
$sql = "SELECT `SalaryHeadId`,`Amount` FROM `EmployeeSalaryStructure` WHERE `EmpId`= $userId";
$result1 = mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($result1)){
  $headid=$row['SalaryHeadId'];
  $perday1=($row['Amount'])/30;
  $amt=$totalDays*$perday1;

  $sql1 = "INSERT into `EmployeeSalaryPayslip` (EmpId,SalaryHeadId,Amount,GeneratedDate) values('$userId','$headid','$amt','$date1')";
  $result2 = mysqli_query($con,$sql1) or die(mysqli_error($con));
}
// echo ($daysinMonth).'vv'.($presentCnt+$holidayCnt+$LeaveCnt).' '.$salary;
mysqli_close($con);
exit(json_encode($response));
?>
