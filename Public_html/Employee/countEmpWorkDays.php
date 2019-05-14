<?php

//Not Used for application


include '../../config/connection.php';
$response = [];
session_start();
$Emp_id = $_SESSION['Emp_id'];
$response = [];
$month = $_POST['month'];
// $month1 = 2;


$year  =$_POST['yr'];
// $year  ='2019';


// echo $month.'<br>';
//
// $date1=$year.'-'.$month.'-01';
//
//
// echo $date1;

// $num_of_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);

$totalsalarydays = 24; //If consider every sunday Off in month and 4 sunday in month

$fetchDays = "SELECT COUNT(Day)as pdays FROM EmployeeAttendance WHERE YEAR(Day)='$year' AND MONTH(Day)='$month' AND EmpId = $Emp_id";

$result = mysqli_query($con,$fetchDays)or die(mysqli_error($con));
$row = mysqli_fetch_row($result);

$response['AttendanceDays'] = $row['pdays'];
$response['totalDays'] = $totalsalarydays;

mysqli_close($con);
exit(json_encode($response));

 ?>
