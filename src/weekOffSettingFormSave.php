<?php

require_once "../config/connection.php";
session_start();
$UserId = $_SESSION['a_id'];
$response=[];
$selectedDay = $_POST['weekdaysInput'];
$selectedWeek = $_POST['WeekNumberInput'];

if(empty($_POST['prevSetId']) && !empty($_POST['weekdaysInput']) && !empty($_POST['WeekNumberInput'])){
  // if(){
  $DeletPrevDayOff_sql = "DELETE FROM weekDaysOff WHERE day = '$selectedDay' AND weeknumber = $selectedWeek AND UserId = $UserId";
   mysqli_query($con,$DeletPrevDayOff_sql)or die(mysqli_error($con));

    $sql_query = "INSERT INTO weekDaysOff(UserId, day, weeknumber)";
    $sql_query .="VALUES($UserId,'$selectedDay',$selectedWeek)";
    if (mysqli_query($con,$sql_query)or die(mysqli_error($con))) {
      // $response['add'] = true;
      if(mysqli_affected_rows($con)>0){
        $response['add'] = true;
      }else{ 
        $response['add'] = 'noChange';
        }
    }else {
      $response['add'] = false;
    }
  // }

}
// elseif(!empty($_POST['prevSetId'])) {
//   if(!empty($_POST['weekdaysInput']) && !empty($_POST['WeekNumberInput'])){
//   $update_sql = "UPDATE weekDaysOff SET day='$selectedDay',weeknumber = $selectedWeek WHERE UserId = $UserId";
//   if (mysqli_query($con,$sql_query)or die(mysqli_error($con))) {
//     $response['update'] = true;
//   }else {
//     $response['update'] = false;
//   }
// }
// }

mysqli_close($con);
exit(json_encode($response));

 ?>
