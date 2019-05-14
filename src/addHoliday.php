<?php
include_once('../config/connection.php');
session_start();
$aid = $_SESSION['a_id'];

//SELECT day(holiday_date) FROM Holidays WHERE month(holiday_date) = '09'
$day             = $_REQUEST['date1'];
$hname           = $_REQUEST['hname'];
$response        = [];
$dayof           = explode('-',$day);

if(!empty($_REQUEST['holiday_id'])){
  $holiday_id = $_REQUEST['holiday_id'];
  $sql_fetch  = "SELECT HolidayDate FROM Holidays WHERE HolidayId = '$holiday_id'";
  $result = mysqli_query($con,$sql_fetch);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $data = explode('-',$row['HolidayDate']);//0-year,1-month,2-date
    $sql_query  = "UPDATE Holidays SET HolidayName = '$hname',HolidayDate='$day' WHERE HolidayId = '$holiday_id'";
    mysqli_query($con,$sql_query);
    }


  $response['true'] = true;
}else {
  $sql_query  =  "INSERT INTO Holidays(UserId,HolidayName,HolidayDate) VALUES";
  $sql_query .=  "('$aid','$hname','$day')";
  mysqli_query($con,$sql_query);

  $response['true'] = true;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
