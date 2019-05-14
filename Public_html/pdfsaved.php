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


// $report_id = $_REQUEST['id'];
// $patient_id="";
// $sql="SELECT patient_id from patientmedicalreport where id='$report_id'";
// $result = mysqli_query($con,$sql);
// if(mysqli_num_rows($result)>0){
//   $row = mysqli_fetch_array($result);
//   $patient_id=$row['0'];
//
// }
// $response = [];
// $sql = "SELECT patient_basic_profile.fname,patient_basic_profile.lname,patient_basic_profile.birth_date,patient_basic_profile.contact_no,
// patient_basic_profile.sex,patient_basic_profile.address,patientmedicalreport.symptoms,patientmedicalreport.conclusion,
// patientmedicalreport.created_At,patientmedicalreport.nextvisitdate FROM patient_basic_profile,
// patientmedicalreport WHERE patient_basic_profile.patient_id  ='$patient_id'  AND patientmedicalreport.id='$report_id'";
//
// $result = mysqli_query($con,$sql);
// if(mysqli_num_rows($result)>0){
//   $row = mysqli_fetch_array($result);
//
//   $fname    = $row['fname'];
//   $lname     = $row['lname'];
//   $birth_date= $row['birth_date'];
//   $address  = $row['address'];
//
//   $sex      = $row['sex'];
// 	if($sex==='Male'){
// 		$sex='MALE';
// 	}
// 	else if($sex==='Female'){
// 		$sex='FEMALE';
// 	}
// 	else{
// 		$sex='OTHER';
// 	}
//   $contact_no= $row['contact_no'];
//
//   $symptoms      = $row['symptoms'];
//   $conclusion= $row['conclusion'];
//
//   $created_At      = $row['created_At'];
//   $nextvisitdate= $row['nextvisitdate'];
//   $age        = date_diff(date_create($row['birth_date']), date_create('today'))->y;
//
// }
//
// //-------------------------------------
//
//
// function fetchmedicinedata(){
// 	include 'connection.php';
// 	$report_id = $_REQUEST['id'];
// 	$output = '';
// 	$sql1 = "SELECT patient_medicine_detail.medicinename,patient_medicine_detail.medicineqty,
// 	patient_medicine_detail.patientMorningbefore,patient_medicine_detail.patientMorningafter,
// 	patient_medicine_detail.patientEveningbefore,patient_medicine_detail.patientEveningafter,
// 	patient_medicine_detail.patientNightbefore,patient_medicine_detail.patientNightafter
// 	FROM patient_medicine_detail WHERE reportid='$report_id'";
// 	$result1 = mysqli_query($con,$sql1);
// 	$i=0;
// if(mysqli_num_rows($result1)>0){
//   while($row=mysqli_fetch_array($result1))
//   {
// 		$i++;
// 		$output .='<tr>
// 			<td style="width:10%;">'.$i.'</td>
// 			<td>'.$row['medicinename'].'<br/>(Qty'.$row['medicineqty'].')</td>
// 			<td style="width:5%;">'.$row['patientMorningbefore'].'</td>
// 			<td style="width:5%;">'.$row['patientMorningafter'].'</td>
// 			<td style="width:5%;">'.$row['patientEveningbefore'].'</td>
// 			<td style="width:5%;">'.$row['patientEveningafter'].'</td>
// 			<td style="width:5%;">'.$row['patientNightbefore'].'</td>
// 			<td style="width:5%;">'.$row['patientNightafter'].'</td>
// 		</tr>';
//   }
// }
// return $output;
// }



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
  <table style="width:100%">
    <tr>
    <th colspan="1" style="text-align:center"><img src="../images/xxovek.png" width="50" height="50" class="img-circle" alt="User Image" ></th>
    <th colspan="5" style="text-align:center">Company Name<br>Company Address</th>
    </tr>
  </table>
<br>
<b>Employee Account Information</b>
    <table style="width:100%">

  <tr>
    <th colspan="3"style="text-align:center" >Salary Slip</th>
    <th colspan="1" style="text-align:center">Month</th>
    <th colspan="1" style="text-align:center">Mar-19</th>
  </tr>

  <tr>
  <td>Employee Name</td>
  <td style="text-align:center">Sonali Bhagwat</td>
  <td>Date of Joining</td>
  <td colspan="2" style="text-align:center">1st April 2018</td>
  </tr>

<tr>
<td >Employee Code/Id</td>
<td  style="text-align:center">0020</td>
<td  >PAN</td>
<td  colspan="2" style="text-align:center">DOITR8944C</td>
</tr>

<tr>
<td >Department</td>
<td  style="text-align:center">IT</td>
<td  >Designation</td>
<td  colspan="2" style="text-align:center">Software Engineer</td>
</tr>

<tr>
<td >Branch Name</td>
<td  style="text-align:center">Aundh Branch</td>
<td >Bank Name</td>
<td colspan="2" style="text-align:center">SBI</td>
</tr>

<tr>
<td >Bank Account Number</td>
<td  style="text-align:center">11223344556</td>
<td ></td>
<td  colspan="2"></td>

</tr>



</table>
<br>
<b>Attendance Information</b>
<table border="1" style="width:100%">
<tr>
  <th colspan="1"style="text-align:center" >Attendance Days</th>
  <th colspan="1" style="text-align:center">Weekly Offs</th>
  <th colspan="1" style="text-align:center">Holidays</th>
  <th colspan="1" style="text-align:center">Paid Leaves</th>
  <th colspan="1" style="text-align:center">Unpaid Leaves</th>
  <th colspan="1" style="text-align:center">Salary Days</th>
  <tr>
  <td colspan="1" style="text-align:center" >15</td>
  <td colspan="1" style="text-align:center">8</td>
  <td colspan="1" style="text-align:center">1</td>
  <td colspan="1" style="text-align:center">4</td>
  <td colspan="1" style="text-align:center">0</td>
  <td colspan="1" style="text-align:center">28</td>

  </tr>

</tr>
</table>
<br>
<b>Salary Components</b>
<table border="1" style="width:100%">
<tr>
  <th colspan="3"style="text-align:center" >Income</th>
  <th colspan="3" style="text-align:center">Deductions</th>
</tr>

<tr>
<td colspan="2"style="text-align:center">Description</td>
<td colspan="1"style="text-align:center">Amount(Rs.)</td>
<td colspan="2"style="text-align:center">Description</td>
<td colspan="1"style="text-align:center">Amount(Rs.)</td>
</tr>

<tr>
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
</tr>


</table>
<br>
<table style="width:100%">
  <tr>
    <th colspan="4"style="text-align:center" >Net Salary Payable</th>
    <th colspan="2" style="text-align:center">25710</th>
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

exit(0);
}
else {
header("Location:login.php");
}
?>
