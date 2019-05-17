<?php
include_once('../config/connection.php');
$response = [];
// session_start();
// $aid = $_SESSION['a_id'];

if(!empty($_POST["email"])) {
  $result = mysqli_query($con,"SELECT count(EmailId) FROM Employees WHERE EmailId='" . $_POST["email"] . "'");
  $row = mysqli_fetch_array($result);
  $user_count = $row[0];
  if($user_count>0) {
      // echo "<span class='status-not-available'>E-Mail Id Already Exists</span>";
      $response['status'] = true;
      
  }else{
      // echo "<span class='status-available'> </span>";
      $response['status'] = false;

  }
}
mysqli_close($con);
exit(json_encode($response));
?>
