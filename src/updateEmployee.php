<?php
include '../config/connection.php';
$response = [];
session_start();
$UserId = $_SESSION['a_id'];
$fname   = $_REQUEST['editfname'];
$lname   = $_REQUEST['editlname'];

$EmpName = $fname.'-'.$lname;

$gender  = $_REQUEST['editgender'];
$DOB     = $_REQUEST['editbirthdate'];
$empPan = $_REQUEST['empPan'];

  if(!empty($_REQUEST['editempid'])){
    $Emp_id = $_REQUEST['editempid'];
    $sql_query  = "SELECT EmpId FROM Employees WHERE EmpId = $Emp_id";
    $result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
    if(mysqli_num_rows($result)==1){
      $sql_update    = "UPDATE Employees SET EmpName = '$EmpName',gender='$gender',DOB='$DOB',PAN = '$empPan'
   WHERE EmpId = '$Emp_id'";
   mysqli_query($con,$sql_update) or die(mysqli_error($con));
   $response['update'] = true;

    }

  }

  mysqli_close($con);
  exit(json_encode($response));

?>
