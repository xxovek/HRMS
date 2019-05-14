<?php
include '../../config/connection.php';
session_start();
$Emp_id = $_SESSION['Emp_id'];
$adminid =$_SESSION['UserId'];
$response = [];

if(!empty($_FILES["imgnameProfile"]["type"])){
  $Profileimgname = $_FILES["imgnameProfile"]["name"];
  $target_dir = "../../images/";
  $target_file = $target_dir . basename($_FILES['imgnameProfile']["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $fname = $adminid."-".$Emp_id."Emp".".".$imageFileType;

  $find_prev_profile = "../../images/".$adminid."-".$Emp_id."Emp.*";
  $files = glob($find_prev_profile);
  $files = glob($find_prev_profile);

  foreach($files as $file){
    if(is_file($file)) {
      unlink($file);
    }
  }
    move_uploaded_file($_FILES['imgnameProfile']['tmp_name'],$target_dir.$fname);
    chmod($target_dir.$fname, 0777);
    $updateImageQuery = "UPDATE Employees SET ProfilePic = '$fname' WHERE EmpId = '$Emp_id'";
  if(mysqli_query($con,$updateImageQuery)or die(mysqli_error($con))){
   $response['msg'] = true;
  }
  else {
    $response['msg'] = false;
  }
  }
  mysqli_close($con);
  exit(json_encode($response));
?>
