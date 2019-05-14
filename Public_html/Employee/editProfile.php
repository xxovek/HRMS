<?php
include '../../config/connection.php';
session_start();
$Emp_id = $_SESSION['Emp_id'];

$fname    = $_POST['inputFName'];
$lname    = $_POST['inputLName'];

$name    =  $_POST['inputFName']."-".$_POST['inputLName'];
$email    = $_POST['email'];
$pwd   = $_POST['pwd'];
$phone       = $_POST['phone'];
$response     = [];

if(!empty($_POST['pwd'])){
  $sql = "UPDATE Employees SET EmpName='$name',EmailId = '$email',contactNumber = '$phone', EPassword='$pwd' WHERE EmpId = $Emp_id";
}
else{
  $sql = "UPDATE Employees SET EmpName='$name',EmailId = '$email',contactNumber = '$phone' WHERE EmpId = $Emp_id";

}
      if(mysqli_query($con,$sql)){
      $response['true'] = true;
      }else {
        $response['false'] = false;
      }

// echo $sql;

mysqli_close($con);
exit(json_encode($response));
 ?>
