<?php
include_once('../../config/connection.php');

include '../../convert_in_indian_rupee.php';
session_start();
$total=$totDed=$totEar=0;
$Emp_id    = $_SESSION['Emp_id'];
$yr   = $_REQUEST['yr'];
// $month1    = $_REQUEST['month'];
// $month = date("m", strtotime($month1));
$month = $_REQUEST['month'];
$response  = [];

$fetch_aid_sql = "SELECT UserId FROM Employees WHERE EmpId = $Emp_id";
$queryRes = mysqli_query($con,$fetch_aid_sql);
$row = mysqli_fetch_array($queryRes);
$adminid = $row['UserId'];

$sql_query = "SELECT * FROM Employees e,EmployeeSalaryPayslip ep,SalaryHeads s
 WHERE e.EmpId = ep.EmpId
 AND ep.SalaryHeadId = s.SalaryHeadId
 AND YEAR(GeneratedDate)='$yr'
 AND MONTH(GeneratedDate)=$month
 AND e.EmpId=$Emp_id";
// echo $sql_query;

$result    = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result))
  {
    array_push($response,[
      'EmpName'    => $row['EmpName'],
      'address'       =>$row['Address'],
      'country'      => $row['country'].','.$row['state'].','.$row['city'].','.$row['postalcode'],

      'PayslipId'   => $row['PayslipId'],
      'phone' => $row['contactNumber'],
      'useremail'  => $row['EmailId'],
      'joining_date'=> 'Joining Date : '.$row['joining_date'],
    // 'designation'=> $row['designation'],

      'amount'  => $row['Amount'],
      'head'     => $row['HeadName'],
      'creditdebit'     => $row['CredDebit']
    ]);
    if($row['CredDebit']=='C')
    {
      $totEar+=(float)$row['Amount'];
    }
    elseif ($row['CredDebit']=='D') {
      $totDed+=(float)$row['Amount'];
    }
    }
    $total= $totEar-$totDed;
    if ($total < 0) {
      $total = 0;
    }


  $FindTaxValu_sql ="SELECT taxname,taxvalue FROM TaxMaster WHERE UserId = $adminid";
  $result_TaxValu = mysqli_query($con,$FindTaxValu_sql) or die(mysqli_error($con));
  // $result_row=mysqli_fetch_array($result_TaxValu);
  $TaxAmt =  0;
  $TotalTaxAmt = 0;
  while($result_row=mysqli_fetch_array($result_TaxValu)){
   
    $TaxAmt = ($totEar * ($result_row['taxvalue']/100));
    $TotalTaxAmt += ($totEar * ($result_row['taxvalue']/100));
    array_push($response,[
      'amount'  => round($TaxAmt,2),
      'head'     => $result_row['taxname'],
      'creditdebit'     => "D"
    ]);
  }

  $totDed = $totDed + $TotalTaxAmt;
  $totSalaryAmt = $totEar + $totDed;

    array_push($response,[
      'totalEar' => round($totEar,2),
      'totalDed' => round($totDed,2),
      'totInWords' => convertToIndianCurrency($totEar),
      'total' => round($totSalaryAmt,2)
      // 'netSal' => round($)
  ]);

  //   array_push($response,[
  //     'totalEar' => $totEar,
  //     'totalDed' =>$totDed,
  //     'total' => '<b>Total : </b>'.round($total,2).'<br>In words :'.convertToIndianCurrency($total),
  // ]);
}else {
  $response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
