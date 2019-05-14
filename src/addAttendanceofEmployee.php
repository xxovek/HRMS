<?php
include_once '../config/connection.php';
include '../sundayCalculations.php';

$Emp_id       = $_REQUEST['Emp_id'];
$today_date   = date('d');//for date number example today date is 24
$month_number = date("n");//for month number example current month is 8
$year         = date('Y');
$response     = [];

$flag = 0;
$sql_joiningdate = "SELECT joining_date FROM Employees WHERE EmpId = '$Emp_id'";
$result_joiningdate = mysqli_query($con,$sql_joiningdate);
if(mysqli_num_rows($result_joiningdate)>0){
  $row = mysqli_fetch_array($result_joiningdate);
  $data = explode('-',$row['joining_date']);//0-year,1-month,2-date

    if($year == $data[0] && $month_number == $data[1]){
      $sql_query    = "SELECT month FROM Employee_attendance WHERE Emp_id =  '$Emp_id' AND year='$year'";
      $result       = mysqli_query($con,$sql_query) or die(mysqli_error($con));
      if(mysqli_num_rows($result)==1){
      }else {
        if($data[2]>=$today_date){
          $sql  = "INSERT INTO Employee_attendance(Emp_id,year,month,`$today_date`) VALUES";
          $sql .= "($Emp_id,'$year','$month_number',4)";
          mysqli_query($con,$sql);
          for($i=1;$i<=$data[2];$i++){
            if($i<=9){
              $i = '0'.$i;
            }
            $sql_h  = "UPDATE Employee_attendance SET `$i` = 4 WHERE Emp_id = '$Emp_id' AND month ='$month_number' AND year ='$year'";
            mysqli_query($con,$sql_h) or die(mysqli_error($con));
          }
          $flag = 1;
          $sunday1 = $data[2];
      }
      }
  }
}
if($flag == 0){
  $sql_query    = "SELECT month FROM Employee_attendance WHERE Emp_id =  '$Emp_id' AND month ='$month_number' AND year = '$year'  ORDER BY Emp_id DESC LIMIT 1";
  $result       = mysqli_query($con,$sql_query) or die(mysqli_error($con));
  if(mysqli_num_rows($result)==1){
      $sql_update = "UPDATE Employee_attendance SET `$today_date` = 1 WHERE Emp_id = '$Emp_id' AND month ='$month_number' AND year ='$year' AND `$today_date`!=4";
      mysqli_query($con,$sql_update) or die(mysqli_error($con));
      $response['true'] = true;
  }else {
    $sql  = "INSERT INTO Employee_attendance(Emp_id,year,month,`$today_date`) VALUES";
    $sql .= "($Emp_id,'$year','$month_number',1)";
    mysqli_query($con,$sql) or die(mysqli_error($con));

    //for holidays of that particular month
    $sql_holiday = "SELECT holiday_date FROM Holidays WHERE year(Holidays.holiday_date) = '$year'";
    $holiday_result = mysqli_query($con,$sql_holiday);
    if(mysqli_num_rows($holiday_result)>0){
      while($row = mysqli_fetch_array($holiday_result)){
        $data = explode('-',$row['holiday_date']);//0-year,1-month,2-date
        if($data[1]== $month_number){
          $sql_h  = "UPDATE Employee_attendance SET `$data[2]` = 3 WHERE Emp_id = '$Emp_id' AND month ='$month_number'";
          mysqli_query($con,$sql_h) or die(mysqli_error($con));
        }

      }
    }
    //for sundays of that month
    foreach (getSundays($year, $month_number) as $sunday) {
        $sun =  $sunday->format("d");
        $sql_update_sun = "UPDATE Employee_attendance SET `$sun` = 2 WHERE Emp_id = '$Emp_id' AND month ='$month_number' AND year ='$year'";
        mysqli_query($con,$sql_update_sun) or die(mysqli_error($con));
    }
    $response['true'] = true;
  }
}else {
  $sql_update = "UPDATE Employee_attendance SET `$today_date` = 1 WHERE Emp_id = '$Emp_id' AND `$today_date`!=4 AND month ='$month_number' AND year ='$year'";
  mysqli_query($con,$sql_update) or die(mysqli_error($con));
  $sql_holiday = "SELECT holiday_date FROM Holidays WHERE year(Holidays.holiday_date) = '$year'";
  $holiday_result = mysqli_query($con,$sql_holiday);
  if(mysqli_num_rows($holiday_result)>0){
    while($row = mysqli_fetch_array($holiday_result)){
      $data = explode('-',$row['holiday_date']);//0-year,1-month,2-date
      if($data[1]== $month_number){
        $sql_h  = "UPDATE Employee_attendance SET `$data[2]` = 3 WHERE Emp_id = '$Emp_id' AND month ='$month_number'";
        mysqli_query($con,$sql_h) or die(mysqli_error($con));
      }
    }
  }
  //for sundays of that month
  foreach (getSundays($year, $month_number) as $sunday) {
      $sun =  $sunday->format("d");
      if($sun > $sunday1){
        $sql_update_sun = "UPDATE Employee_attendance SET `$sun` = 2 WHERE Emp_id = '$Emp_id' AND month ='$month_number' AND year ='$year'";
        mysqli_query($con,$sql_update_sun) or die(mysqli_error($con));
      }

  }
}

mysqli_close($con);
exit(json_encode($response));
 ?>
