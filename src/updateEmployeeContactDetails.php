<?php
include '../config/connection.php';
$response = [];
session_start();
$UserId = $_SESSION['a_id'];
$country   = $_REQUEST['editcountry'];
$State   = $_REQUEST['editstate'];
$city  = $_REQUEST['editcity'];
$pincode  = $_REQUEST['editpincode'];

$email     = $_REQUEST['editemail'];
$contact     = $_REQUEST['editcontactno'];
$address     = $_REQUEST['editaddress'];

  if(!empty($_REQUEST['editempid']))
  {
    $Emp_id = $_REQUEST['editempid'];
    $sql_query  = "SELECT EmpId FROM Employees WHERE EmpId = $Emp_id";
    $result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
    if(mysqli_num_rows($result)==1){
      $sql_update    = "UPDATE Employees SET country='$country',state='$State',city='$city',postalcode='$pincode',EmailId='$email',contactNumber='$contact',Address='$address'
   WHERE EmpId = '$Emp_id'";
   mysqli_query($con,$sql_update) or die(mysqli_error($con));
   $response['update'] = true;

    }

  }

  mysqli_close($con);
  exit(json_encode($response));

?>
