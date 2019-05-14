<?php
include '../../config/connection.php';
session_start();
$userId = $_SESSION['UserId'];
$sql = "SELECT HolidayId,HolidayName,DATE_FORMAT(HolidayDate,'%a %e %M %Y') AS HolidayDate FROM Holidays WHERE UserId = $userId order by HolidayDate";
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
echo json_encode($response);
?>
