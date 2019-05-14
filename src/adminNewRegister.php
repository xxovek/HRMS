<?php

require_once '../config/connection.php';
$response = [];

$adminFName = $_POST['inputFName'];
$adminLName = $_POST['inputLName'];
$adminEmail = $_POST['email'];
$firmName = $_POST['inputFirmName'];
$adminPWD = $_POST['oldpwd'];
$adminPhone = $_POST['phone'];
$Profileimage = 'defaultuserimage.png';
$Logoimage = 'defaultlogo.png';

$insert_sql = "INSERT INTO users(fname, lname, email, contactNumber, firm, upassword, ProfilePic, logoImage) VALUES
('$adminFName','$adminLName','$adminEmail','$adminPhone','$firmName','$adminPWD','$Profileimage','$Logoimage')";

if(mysqli_query($con,$insert_sql)or die(mysqli_error($con))){
  $last_id = $con->insert_id;

  $insertintoCompanyinfo = "INSERT INTO CompanyDetails(userId,companyname,contactnumber)VALUES($last_id,'$firmName','$adminPhone')";
  mysqli_query($con,$insertintoCompanyinfo)or die(mysqli_error($con));
 $response['success'] = true;
}
else {
  $response['success'] = false;
}


mysqli_close($con);
exit(json_encode($response));

 ?>
