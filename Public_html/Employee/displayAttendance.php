<?php
include '../../config/connection.php';
$response = [];
session_start();
$jdate=$_POST['jdate'];
$jmonth=$_POST['jmonth'];
$jyr=$_POST['jyr'];
$start=1;
$Emp_id = $_SESSION['Emp_id'];
$adminid =$_SESSION['UserId'];
$weekOffDaysArr = [];


$fetchDayOff_sql ="SELECT DISTINCT weeknumber,day FROM weekDaysOff where UserId = $adminid";
$fetchDayOff_sql_res = mysqli_query($con,$fetchDayOff_sql)or die(mysqli_error($con));

if (mysqli_num_rows($fetchDayOff_sql_res)>0) {
 while ($row = mysqli_fetch_array($fetchDayOff_sql_res)) {
   if ($row['day'] == 'Sunday') {
     $day = 'Sun';
   }elseif ($row['day'] == 'Monday') {
     $day = 'Mon';

   }elseif ($row['day'] == 'Tuesday') {
     $day = 'Tue';

   }elseif ($row['day'] == 'Wednesday') {
     $day = 'Wed';

   }elseif ($row['day'] == 'Thursday') {
     $day = 'Thu';

   }elseif ($row['day'] == 'Friday') {
     $day = 'Fri';

   }elseif ($row['day'] == 'Saturday') {
     $day = 'Sat';

   }

   array_push($weekOffDaysArr,[
     'weeknumber' => $row['weeknumber'],
     'dayName' => $day

   ]);
 }
}

$offDaysArrSize = sizeof($weekOffDaysArr);

// to get week number in month
function week_number( $date ){
   return ceil( date( 'j', strtotime( $date ) ) / 7 );
}

if(empty($_POST['month'])){
$month        = date("m");
$year         = date('Y');
}
else {
  $month1 = $_POST['month'];
  $year  =$_POST['yr'];
  $month = date("m", strtotime($month1));
}


if($year==date('Y') && $month==date("m")){
  if ($year==$jyr && $month==$jmonth) {
    $start=$jdate;
  }
$num_of_days=date('d');
}
elseif ($year==$jyr && $month==$jmonth) {
  if($year==date('Y') && $month==date("m")){
  $num_of_days=date('d');
  }
  else {
    $num_of_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
  }
  $start=$jdate;
}
else {
  $num_of_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
}

for( $i=$start; $i<= $num_of_days; $i++){
    $dates[]= str_pad($i,2,'0', STR_PAD_LEFT);
}

foreach($dates as $date){
  $d = $year."-".$month."-".$date;
  $days = date('D', strtotime($d));

  $week_num = week_number($d);

$status="PRESENT";
$sql_query = "SELECT * FROM EmployeeAttendance WHERE Day='$d' AND EmpId=$Emp_id";
$result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
  $row = mysqli_fetch_array($result);
  $sql = "SELECT HolidayId FROM Holidays WHERE HolidayDate='$d' AND UserId=$adminid";
  $result1 = mysqli_query($con,$sql) or die(mysqli_error($con));
  $sql_leave = "SELECT LeaveId FROM EmployeeLeaves WHERE FromDate  <= '$d'
AND UptoDate >= '$d' AND EmpId = $Emp_id";
  $result_leave = mysqli_query($con,$sql_leave) or die(mysqli_error($con));

$flag = true;
    if(mysqli_num_rows($result1)>0)
    {
      $status="HOLIDAY";
      $flag = false;
    }

    if(mysqli_num_rows($result_leave)>0)
    {
      $status="LEAVE";
      $flag = false;
    }

    if ($flag) {
      for ($i=0; $i < $offDaysArrSize; $i++) {
        // echo $weekOffDaysArr[$i]['dayName'];
        if ($weekOffDaysArr[$i]['dayName'] == $days && $weekOffDaysArr[$i]['weeknumber'] == $week_num){
            $status = "WEEK-OFF";
            // $flag = true;
        }

     }
    }

    array_push($response,[
      'time_in'         => $row['TimeIn'],
      'time_out'         => $row['TimeOut'],
      'date1'         => $date,
      'day'         => $days,
      'status'         => $status,
      'hour'         => $row['hours']
    ]);
}
mysqli_close($con);
exit(json_encode($response));
 ?>
