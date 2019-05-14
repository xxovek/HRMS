<?php
require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$response = [];

if(!empty($_FILES["imgnameProfile"]["type"]) && !empty($_FILES["imgnameLogo"]["type"])){

  $Profileimgname = $_FILES["imgnameProfile"]["name"];
  $target_dir = "../images/";
  $target_file = $target_dir . basename($_FILES['imgnameProfile']["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $fnameProfile = $UserId."Admin".".".$imageFileType;
  $find_prev_profile = "../images/".$UserId."Admin.*";
  $files = glob($find_prev_profile);
  $files = glob($find_prev_profile);

  foreach($files as $file){
    if(is_file($file)) {
      unlink($file);
    }
  }
    move_uploaded_file($_FILES['imgnameProfile']['tmp_name'],$target_dir.$fnameProfile);
    chmod($target_dir.$fnameProfile, 0777);



    $Logoimgname = $_FILES["imgnameLogo"]["name"];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES['imgnameLogo']["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $fnameLogo = $UserId."Logo".".".$imageFileType;
    $find_prev_profile = "../images/".$UserId."Logo.*";
    $files = glob($find_prev_profile);
    $files = glob($find_prev_profile);

    foreach($files as $file){
      if(is_file($file)) {
        unlink($file);
      }
    }
      move_uploaded_file($_FILES['imgnameLogo']['tmp_name'],$target_dir.$fnameLogo);
      chmod($target_dir.$fnameLogo, 0777);




    $updateImageQuery = "UPDATE users SET ProfilePic = '$fnameProfile',logoImage = '$fnameLogo' WHERE userId = $UserId";
  if(mysqli_query($con,$updateImageQuery)or die(mysqli_error($con))){
   $response['msg'] = true;
  }
  else {
    $response['msg'] = false;
  }

}
else {


if(!empty($_FILES["imgnameProfile"]["type"])){
  $Profileimgname = $_FILES["imgnameProfile"]["name"];
  $target_dir = "../images/";
  $target_file = $target_dir . basename($_FILES['imgnameProfile']["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $fname = $UserId."Admin".".".$imageFileType;
  $find_prev_profile = "../images/".$UserId."Admin.*";
  $files = glob($find_prev_profile);
  $files = glob($find_prev_profile);

  foreach($files as $file){
    if(is_file($file)) {
      unlink($file);
    }
  }
    move_uploaded_file($_FILES['imgnameProfile']['tmp_name'],$target_dir.$fname);
    chmod($target_dir.$fname, 0777);
    $updateImageQuery = "UPDATE users SET ProfilePic = '$fname' WHERE userId = $UserId";
  if(mysqli_query($con,$updateImageQuery)or die(mysqli_error($con))){
   $response['msg'] = true;
  }
  else {
    $response['msg'] = false;
  }
  }

if(!empty($_FILES["imgnameLogo"]["type"])){
  $Logoimgname = $_FILES["imgnameLogo"]["name"];
  $target_dir = "../images/";
  $target_file = $target_dir . basename($_FILES['imgnameLogo']["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $fnameLogo = $UserId."Logo".".".$imageFileType;
  $find_prev_profile = "../images/".$UserId."Logo.*";
  $files = glob($find_prev_profile);
  $files = glob($find_prev_profile);

  foreach($files as $file){
    if(is_file($file)) {
      unlink($file);
    }
  }
    move_uploaded_file($_FILES['imgnameLogo']['tmp_name'],$target_dir.$fnameLogo);
    chmod($target_dir.$fnameLogo, 0777);
    $updateImageQuery = "UPDATE users SET logoImage = '$fnameLogo' WHERE userId = $UserId";
  if(mysqli_query($con,$updateImageQuery)or die(mysqli_error($con))){
   $response['msg'] = true;
  }
  else {
    $response['msg'] = false;
  }

}

  }
  //
  // if(!empty($_FILES["file"]["type"])){
  //   $Logoimgname = $_FILES["file"]["name"];
  //   $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
  //   $targetPath = "../images/".$_FILES['file']['name']; // Target path where file is to be stored
  //   move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
  //   // $insertImageQuery = "INSERT INTO users (logoImage)VALUES('$Logoimgname')";
  //   $updateImageQuery = "UPDATE users SET logoImage = '$Logoimgname' WHERE userId = $UserId";
  //   }
  //   else {
  //   }

    // $insertImageQuery = "INSERT INTO users (ProfilePic logoImage)VALUES('$Profileimgname','$Logoimgname')";
    // $updateImageQuery = "UPDATE users SET ProfilePic = '', logoImage = '' WHERE userId = $UserId";
mysqli_close($con);
exit(json_encode($response));

 ?>
