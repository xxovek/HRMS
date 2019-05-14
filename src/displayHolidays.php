<?php
include_once('../config/connection.php');

session_start();
$UserId = $_SESSION['a_id'];
$sql = "SELECT HolidayId,HolidayName,HolidayDate FROM Holidays WHERE UserId = $UserId";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'h_id' => $row['HolidayId'],
        'holiday_name' => $row['HolidayName'],
        'holiday_date' => $row['HolidayDate']
      ]);
    }

  }
}
mysqli_close($con);
exit(json_encode($response));
  ?>
