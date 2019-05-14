<?php
include '../config/connection.php';
$response = [];
session_start();
$yr=$_REQUEST['yr'];
$month1=$_REQUEST['month'];
$month = date("m", strtotime($month1));
$date1=$yr.'-'.$month.'-01';

$emparr = $_REQUEST['arr'];

for ($i=0; $i <count($emparr) ; $i++) {
$status="";
$perday=0;
$presentCnt=$holidayCnt=$LeaveCnt=$totalDays=0;

$sql_query = "SELECT count(EmpAtteId) FROM EmployeeAttendance WHERE YEAR(Day)='$yr' AND MONTH(Day)='$month' AND EmpId='$emparr[$i]'";
$result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
$row=mysqli_fetch_array($result);
$presentCnt=$row[0];

  $sql = "SELECT count(HolidayId) FROM Holidays WHERE YEAR(HolidayDate)='$yr' AND MONTH(HolidayDate)='$month' AND UserId='$emparr[$i]'";
  $result1 = mysqli_query($con,$sql) or die(mysqli_error($con));
  $row1=mysqli_fetch_array($result1);
  $holidayCnt=$row1[0];

    $sql_leave = "SELECT count(LeaveId) FROM EmployeeLeaves WHERE YEAR(FromDate)='$yr' AND MONTH(FromDate)='$month' AND EmpId='$emparr[$i]'";
    $result_leave = mysqli_query($con,$sql_leave) or die(mysqli_error($con));
    $row2=mysqli_fetch_array($result_leave);
    $LeaveCnt=$row2[0];

     $sql_leave1 = "SELECT SUM(Amount) FROM EmployeeSalaryStructure WHERE EmpId='$emparr[$i]'";
     $result_leave1 = mysqli_query($con,$sql_leave1) or die(mysqli_error($con));
     $row3=mysqli_fetch_array($result_leave1);
     $perday=($row3[0])/30;
     
     $totalDays=($presentCnt+$holidayCnt+$LeaveCnt);
     $salary=($perday*$totalDays);
     $total_sal=round($salary,2);
     
     $sql_check = "SELECT PayslipId FROM `EmployeeSalaryPayslip` WHERE EmpId='$emparr[$i]' AND GeneratedDate='$date1'";
    $result_check = mysqli_query($con,$sql_check) or die(mysqli_error($con));
    if(mysqli_num_rows($result_check)>0){
      $sql_del = "DELETE FROM `EmployeeSalaryPayslip` WHERE EmpId='$emparr[$i]' AND GeneratedDate='$date1'";
      $result_del = mysqli_query($con,$sql_del) or die(mysqli_error($con));
    }

    $sql_new = "SELECT `SalaryHeadId`,`Amount` FROM `EmployeeSalaryStructure` WHERE `EmpId`='$emparr[$i]'";
    $result_new = mysqli_query($con,$sql_new) or die(mysqli_error($con));
    
    while($row=mysqli_fetch_array($result_new)){
      $headid=$row['SalaryHeadId'];

      $perday1=($row['Amount'])/30;
       $amt= $totalDays * $perday1;

      $sql11 = "INSERT into `EmployeeSalaryPayslip` (EmpId,SalaryHeadId,Amount,GeneratedDate) values('$emparr[$i]','$headid','$amt','$date1')";
      $result22 = mysqli_query($con,$sql11) or die(mysqli_error($con));
      if($result22)
      $response['true']=true;
      else
      $response['false']=false;

    }
}

mysqli_close($con);
exit(json_encode($response));
 ?>
