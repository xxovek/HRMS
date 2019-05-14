<?php
/* include autoloader */
require_once '../dompdf/autoload.inc.php';
/* reference the Dompdf namespace */
use Dompdf\Dompdf;

/* instantiate and use the dompdf class */
$dompdf = new Dompdf();
include '../config/connection.php';
include '../convert_in_indian_rupee.php';
session_start();
if(isset($_SESSION['a_id'])){
   $adminid =$_SESSION['a_id'];
    // $adminid = 1;

    $CmpInfoTr = '';

$fetchCompanyInfo = "SELECT CD.companyname, CD.contactperson, CD.address, CD.country, CD.City, CD.State, CD.postalcode,CD.email, CD.contactnumber,CD.fax, CD.websiteurl,users.logoImage FROM CompanyDetails CD,users WHERE CD.userId = users.userId AND CD.userId = $adminid";
$CInfo_res = mysqli_query($con,$fetchCompanyInfo)or die(mysqli_error($con));
if(mysqli_num_rows($CInfo_res)>0){
  $CInfo_row = mysqli_fetch_array($CInfo_res);

$Caddress = ucwords($CInfo_row['address'])." ".$CInfo_row['country'].",".$CInfo_row['State'].",".$CInfo_row['City']."-".$CInfo_row['postalcode'];

if($CInfo_row['logoImage'] == 'defaultlogo.png'){
  $CmpInfoTr ='<tr>
    <th colspan="6" style="text-align:center">'.$CInfo_row['companyname'].'<br>'.$Caddress.'</th>
    </tr>';
}
else {
  $CmpInfoTr ='<tr>
    <th colspan="1" style="text-align:center"><img src="../images/'.$CInfo_row['logoImage'].'" width="50" height="50" class="img-circle" alt="User Image" ></th>
    <th colspan="5" style="text-align:center">'.$CInfo_row['companyname'].'<br>'.$Caddress.'</th>
    </tr>';
}

}

  // $uname=$_SESSION['uname'];
   $Emp_id= $_REQUEST['id'];
   // $Emp_id = '5';
   $month= $_REQUEST['month'];
   // $month = '2';
   $yr= $_REQUEST['year'];
   // $yr = '2019';

   define('MONTHS', array(
       'dum','Jan','Feb','Mar','Apr','May','Jun',
       'Jul','Aug','Sept','Oct','Nov','Dec'
   ));

for($i = 1;$i <= 12; $i++ ){
  if($month == $i){
    $SalaryMonth = MONTHS[$i];
    break;
  }

}

$SalaryMonth = $SalaryMonth . "-".$yr;

   // $total=$totDed=$totEar=0;
   $sql_query = "SELECT * FROM Employees e,EmployeeSalaryPayslip ep,SalaryHeads s WHERE e.EmpId = ep.EmpId
    AND ep.SalaryHeadId = s.SalaryHeadId
    AND YEAR(GeneratedDate)='$yr'
    AND MONTH(GeneratedDate)='$month'
    AND e.EmpId='$Emp_id'";
    // echo $sql_query;
    $result    = mysqli_query($con,$sql_query);
    $tr = '';
if(mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);

$empname = $row['EmpName'];
$EmpName = explode("-",$empname);
$joinDate = $row['joining_date'];
// 'amount'  => $row['Amount'],

$tr = '<tr>
    <th colspan="3"style="text-align:center" >Salary Slip</th>
    <th colspan="1" style="text-align:center">Month</th>
    <th colspan="1" style="text-align:center">'.$SalaryMonth.'</th>
  </tr><tr>
  <td>Employee Name</td>
  <td style="text-align:center">'.ucfirst($EmpName[0])." ".ucfirst($EmpName[1]).'</td>
  <td>Date of Joining</td>
  <td colspan="2" style="text-align:center">'.$row['joining_date'].'</td>
  </tr>
  <tr>
  <td >Employee Code/Id</td>
  <td  style="text-align:center">'."E-".$row['EmpId'].'</td>
  <td  >PAN</td>
  <td  colspan="2" style="text-align:center">'.strtoupper($row['PAN']).'</td>
  </tr>';


$fetchDep_query  = "SELECT E.EmpId,D1.DeptId,D.DesigId,E.DOB,E.Address,
country,state,city,postalcode,EmailId,contactNumber,
D1.DeptName,D.DesigName FROM Employees E
LEFT JOIN EmployeeDesignations ED ON E.EmpId = ED.EmpId
LEFT JOIN EmployeeDepartments ED1 ON ED1.EmpId = E.EmpId
LEFT JOIN Designations D ON D.DesigId = ED.DesigId
LEFT JOIN Departments D1 ON D1.DeptId = ED1.DeptId
WHERE E.EmpId  = '$Emp_id'";

// $tr2 = '';
$res = mysqli_query($con,$fetchDep_query)or die(mysqli_error($con));
if(mysqli_num_rows($res)>0){
  $resDept = mysqli_fetch_array($res);

  $tr .= '<tr>
  <td >Department</td>
  <td  style="text-align:center">'.ucwords($resDept['DeptName']).'</td>
  <td  >Designation</td>
  <td  colspan="2" style="text-align:center">'.ucwords($resDept['DesigName']).'</td>
  </tr>';

}


$fetchBankinfo = "SELECT * FROM EmployeeBankDetails WHERE EmpId  = '$Emp_id'";
// $tr3 = '';
$Bank_res = mysqli_query($con,$fetchBankinfo)or die(mysqli_error($con));
if(mysqli_num_rows($Bank_res)>0){
  $rowBankinfo = mysqli_fetch_array($Bank_res);

if(!empty($rowBankinfo['BranchName'])){
  $tr .= '<tr>
  <td >Bank Name</td>
  <td  style="text-align:center">'.$rowBankinfo['BankName'].'</td>
  <td >Branch Name</td>
  <td colspan="2" style="text-align:center">'.ucwords($rowBankinfo['BranchName']).'</td>
  </tr>
  <tr>
  <td >Bank Account Number</td>
  <td  style="text-align:center">'.$rowBankinfo['AccountNumber'].'</td>
  <td >Bank IFSC</td>
  <td colspan="2" style="text-align:center">'.$rowBankinfo['IFSC'].'</td>
  </tr>';
}

}

  $fetchPFInfo = "SELECT * FROM EmployeePFDetails WHERE EmpId = '$Emp_id'";
  $PFInfoRes = mysqli_query($con,$fetchPFInfo)OR die(mysqli_error($con));
  if(mysqli_num_rows($PFInfoRes)>0){
    $rowPFInfo = mysqli_fetch_array($PFInfoRes);
    if(!empty($rowBankinfo['pfnumber'])){

  $tr.='<tr>
  <td >PF Number</td>
  <td style="text-align:center">'.$rowPFInfo['pfnumber'].'</td>
  <td >UAE Number</td>
  <td  colspan="2" style="text-align:center">'.$rowPFInfo['UAENumber'].'</td>
  </tr>';
}
}


$fetchDays = "SELECT COUNT(Day)as presentdays FROM EmployeeAttendance WHERE YEAR(Day)='$yr' AND MONTH(Day)='$month' AND EmpId = $Emp_id";
$PdaysResult = mysqli_query($con,$fetchDays)or die(mysqli_error($con));
$PresentDaysrow = mysqli_fetch_array($PdaysResult);

$fetch_weekOff = "SELECT COUNT(weeknumber) as offCnt FROM weekDaysOff where UserId = $adminid";
$result = mysqli_query($con,$fetch_weekOff)or die(mysqli_error($con));
$weekOffrow = mysqli_fetch_array($result);

$fetchHolidaySql = "SELECT COUNT(HolidayId)as holidayCnt FROM Holidays WHERE YEAR(HolidayDate)='$yr' AND MONTH(HolidayDate)='$month' AND UserId = $adminid";
$fetchHolidaySqlReslt = mysqli_query($con,$fetchHolidaySql)or die(mysqli_error($con));
$holidayCntRow = mysqli_fetch_array($fetchHolidaySqlReslt);

// $sql_query  = "SELECT *,(L.NoOfDays+IFNULL(AL.NoOfDays,0)) as asLeaves,L.LeaveId as lid FROM Leaves L LEFT JOIN EmployeeLeaveAdditional AL
//  ON L.LeaveId=AL.LeaveId AND AL.LeaveId=4  AND YEAR(L.FromDate)='$yr'";

$EmpTakenLeave = "SELECT count(LeaveId) as EmptakenLeaves,LeaveId FROM EmployeeLeaves WHERE EmpId = $Emp_id AND LeaveStatus = 'Approved'";
$res = mysqli_query($con,$EmpTakenLeave)or die(mysqli_error($con));
// $holidayCntRow = mysqli_fetch_array($res);
$paidLeavesCnt = 0;
$unPaidLeavesCnt = 0;
$paidUnpaidCntRow = mysqli_fetch_array($res);
// for ($i=0; $i < $holidayCntRow['EmptakenLeaves']; $i++) {
//   $sql = "SELECT paidunpaidflag from Leaves Where LeaveId = "
// }
if($paidUnpaidCntRow['EmptakenLeaves'] > 0){
  if(mysqli_num_rows($res)>0){
    while($paidUnpaidCntRow = mysqli_fetch_array($res)){

        $leaveId = $paidUnpaidCntRow['LeaveId'];
        $sql = "SELECT paidunpaidflag from Leaves Where LeaveId = $leaveId";
        $query_res = mysqli_query($con,$sql)or die(mysqli_error($con));
        $statusRow = mysqli_fetch_array($query_res);

      if($statusRow['paidunpaidflag'] === 1){
        $paidLeavesCnt = $paidLeavesCnt + 1;
      }else {
        $unPaidLeavesCnt = $unPaidLeavesCnt + 1;
      }

    }
  }

}else {
}


$SalaryDays = $PresentDaysrow['presentdays'] + $paidLeavesCnt ;

$trAttendance = '<tr>
  <th colspan="1"style="text-align:center" >Attendance Days</th>
  <th colspan="1" style="text-align:center">Weekly Offs</th>
  <th colspan="1" style="text-align:center">Holidays</th>
  <th colspan="1" style="text-align:center">Paid Leaves</th>
  <th colspan="1" style="text-align:center">Unpaid Leaves</th>
  <th colspan="1" style="text-align:center">Salary Days</th>
  </tr>
  <tr>
  <td colspan="1" style="text-align:center" >'.$PresentDaysrow['presentdays'].'</td>
  <td colspan="1" style="text-align:center">'.$weekOffrow['offCnt'].'</td>
  <td colspan="1" style="text-align:center">'.$holidayCntRow['holidayCnt'].'</td>
  <td colspan="1" style="text-align:center">'.$paidLeavesCnt.'</td>
  <td colspan="1" style="text-align:center">'.$unPaidLeavesCnt.'</td>
  <td colspan="1" style="text-align:center">'.$SalaryDays.'</td>
  </tr>';




  

$fetch_CreditSql = "SELECT EmpId,EmployeeSalaryStructure.SalaryHeadId,SalaryHeads.CredDebit,Amount,SalaryHeads.HeadName,EmployeeSalaryStructure.fromDate,EmployeeSalaryStructure.uptoDate
FROM EmployeeSalaryStructure,SalaryHeads WHERE YEAR(fromDate)='$yr' AND MONTH(fromDate)='$month' AND EmpId = $Emp_id AND SalaryHeads.SalaryHeadId = EmployeeSalaryStructure.SalaryHeadId AND SalaryHeads.CredDebit = 'C'";
$CreditResult = mysqli_query($con,$fetch_CreditSql);
$CreditComponent =[];
$totalCreditAmount = 0;
if(mysqli_num_rows($CreditResult) > 0){

 while($row = mysqli_fetch_array($CreditResult)){
   $totalCreditAmount = $totalCreditAmount + $row['Amount'];
    array_push($CreditComponent,[
   'HeadName'   => $row['HeadName'],
   'CredDebitType'   => $row['CredDebit'],
   'Amount' => $row['Amount']
   ]);
 }
}


$DebitComponent =[];
$fetch_DebitSql = "SELECT EmpId,EmployeeSalaryStructure.SalaryHeadId,SalaryHeads.CredDebit,Amount,SalaryHeads.HeadName,EmployeeSalaryStructure.fromDate,EmployeeSalaryStructure.uptoDate
FROM EmployeeSalaryStructure,SalaryHeads WHERE YEAR(fromDate)='$yr' AND MONTH(fromDate)='$month' AND EmpId = $Emp_id AND SalaryHeads.SalaryHeadId = EmployeeSalaryStructure.SalaryHeadId AND SalaryHeads.CredDebit = 'D'";
$DebitResult = mysqli_query($con,$fetch_DebitSql);
$totalDebitAmount = 0;
if(mysqli_num_rows($DebitResult) > 0){
 while($row = mysqli_fetch_array($DebitResult)){
$totalDebitAmount = $totalDebitAmount + $row['Amount'];
    array_push($DebitComponent,[
   'HeadName'   => $row['HeadName'],
   'CredDebitType'   => $row['CredDebit'],
   'Amount' => $row['Amount']
   ]);
 }
}

$NetSalary = $totalCreditAmount - $totalDebitAmount;
if ($NetSalary < 0) {
 $NetSalary = 0;
}

$CreditComponentLen = sizeof($CreditComponent) ;
$DebitComponentLen = sizeof($DebitComponent) ;

$emtyRow = '<td colspan="2"style="text-align:center"></td>
<td colspan="1"style="text-align:center"></td>';

// $ComponentTr = '<tr>
// <td colspan="2"style="text-align:center">Description</td>
// <td colspan="1"style="text-align:center">Amount(Rs.)</td>
// <td colspan="2"style="text-align:center">Description</td>
// <td colspan="1"style="text-align:center">Amount(Rs.)</td>
// </tr>';

if ($CreditComponentLen > $DebitComponentLen) {
  // $tempDebLen = $DebitComponentLen;
  for ($i=0; $i < $CreditComponentLen; $i++) {

    if ($i < $DebitComponentLen) {
      $ComponentTr .='<tr>
      <td colspan="2"style="text-align:center">'.$CreditComponent[$i]['HeadName'].'</td>
      <td colspan="1"style="text-align:center">'.$CreditComponent[$i]['Amount'].'</td>
      <td colspan="2"style="text-align:center">'.$DebitComponent[$i]['HeadName'].'</td>
      <td colspan="1"style="text-align:center">'.$DebitComponent[$i]['Amount'].'</td>
      </tr>';
    }
    else {
      $ComponentTr .='<tr>
      <td colspan="2"style="text-align:center">'.$CreditComponent[$i]['HeadName'].'</td>
      <td colspan="1"style="text-align:center">'.$CreditComponent[$i]['Amount'].'</td>'.$emtyRow.'</tr>';
    }

  }
}

elseif($CreditComponentLen < $DebitComponentLen) {
  // $tempCreditLen = $CreditComponentLen;
  for ($i=0; $i < $DebitComponentLen; $i++) {

    if ($i < $CreditComponentLen) {
      $ComponentTr .='<tr>
      <td colspan="2"style="text-align:center">'.$CreditComponent[$i]['HeadName'].'</td>
      <td colspan="1"style="text-align:center">'.$CreditComponent[$i]['Amount'].'</td>
      <td colspan="2"style="text-align:center">'.$DebitComponent[$i]['HeadName'].'</td>
      <td colspan="1"style="text-align:center">'.$DebitComponent[$i]['Amount'].'</td>
      </tr>';
    }
    else {
      $ComponentTr .='<tr>'.$emtyRow.'
      <td colspan="2"style="text-align:center">'.$DebitComponent[$i]['HeadName'].'</td>
      <td colspan="1"style="text-align:center">'.$DebitComponent[$i]['Amount'].'</td></tr>';
    }

  }
}

$ComponentTotal ='
<td colspan="2"style="text-align:center">TOTAL</td>
<td colspan="1"style="text-align:center">'.$totalCreditAmount.'</td>
<td colspan="2"style="text-align:center">TOTAL</td>
<td colspan="1"style="text-align:center">'.$totalDebitAmount.'</td>';





$html ='<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;
                  }
    th, td {
                    padding: 5px;
                    text-align: left;
                  }
    </style>
    </head>
    <body>
  <table style="width:100%">'.$CmpInfoTr.'</table>
<br>
<b>Employee Account Information</b>
    <table style="width:100%">'.$tr.'</table>
<br>
<b>Attendance Information</b>
<table border="1" style="width:100%">'.$trAttendance.'</table>
<br>
<b>Salary Components</b>
<table border="1" style="width:100%">
<tr>
  <th colspan="3"style="text-align:center" >Income</th>
  <th colspan="3" style="text-align:center">Deductions</th>
</tr>'.$ComponentTr.'<tr>'.$ComponentTotal.'</tr></table>
<br>
<table style="width:100%">
  <tr>
    <th colspan="4"style="text-align:center" >Net Salary Payable</th>
    <th colspan="2" style="text-align:center">'.$NetSalary.'</th>
  </tr>
  <tr>
    <td colspan="3" style="height:5%"></td><td colspan="3" style="height:5%"></td>
  </tr>

  <tr>
    <td colspan="3" style="text-align:center;">Employee Signature</td>
    <td colspan="3" style="text-align:center;">Employer Signature</td>
  </tr>
</table>
  </body>
</html>';

$dompdf->setPaper('A4', 'portrait');
// $dompdf->loadHtml(file_get_contents('newpdf.html'));
 // $dompdf->loadHtml(file_get_contents('a2.html'));
$dompdf->loadHtml($html);
/* Render the HTML as PDF */
$dompdf->render();

/* Output the generated PDF to Browser */
// $dompdf->stream();
$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

// exit(0);
}
}
else {
header("Location:login.php");
}
?>




<!-- <tr>
<td colspan="2"style="text-align:center">Basic Salary</td>
<td colspan="1"style="text-align:center">20000</td>
<td colspan="2"style="text-align:center">PF Deducted</td>
<td colspan="1"style="text-align:center">250</td>
</tr>
<tr>
<td colspan="2"style="text-align:center">Dearness allowance</td>
<td colspan="1"style="text-align:center">6600</td>
<td colspan="2"style="text-align:center">Professional tax</td>
<td colspan="1"style="text-align:center">210</td>
</tr>
<tr>
<td colspan="2"style="text-align:center">HRA</td>
<td colspan="1"style="text-align:center">2000</td>
<td colspan="2"style="text-align:center">TDS</td>
<td colspan="1"style="text-align:center">2500</td>
</tr>
<tr>
<td colspan="2"style="text-align:center">Tiffin allowance</td>
<td colspan="1"style="text-align:center">1250</td>
<td colspan="2"style="text-align:center"></td>
<td colspan="1"style="text-align:center"></td>
</tr>
<tr>
<td colspan="2"style="text-align:center">Assistant allowance</td>
<td colspan="1"style="text-align:center">1500</td>
<td colspan="2"style="text-align:center"></td>
<td colspan="1"style="text-align:center"></td>
</tr>
<tr>
<td colspan="2"style="text-align:center">City compensatory allowance</td>
<td colspan="1"style="text-align:center">120</td>
<td colspan="2"style="text-align:center"></td>
<td colspan="1"style="text-align:center"></td>
</tr>
<tr>
<td colspan="2"style="text-align:center">Washing allowance</td>
<td colspan="1"style="text-align:center">200</td>
<td colspan="2"style="text-align:center"></td>
<td colspan="1"style="text-align:center"></td>
</tr>
<tr>
<td colspan="2"style="text-align:center">Medical allowance</td>
<td colspan="1"style="text-align:center">500</td>
<td colspan="2"style="text-align:center"></td>
<td colspan="1"style="text-align:center"></td>
</tr> -->
