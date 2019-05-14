<?php
include '../config/connection.php';
$response = [];
session_start();
$UserId = $_SESSION['a_id'];

// if(!isset($_FILES["file1"]["type"])){
//     $imgname = '../images/user.png';
//   }
//   else {
//     $imgname = $_FILES["file1"]["name"];
//     $sourcePath = $_FILES['file1']['tmp_name']; // Storing source path of the file in a variable
//     $targetPath = "../images/".$_FILES['file1']['name']; // Target path where file is to be stored
  
//     move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
//   }

    if(!empty($_REQUEST['editempid']))
    {
      $Emp_id = $_REQUEST['editempid'];
      $sql_query  = "SELECT EmpId FROM Employees WHERE EmpId = $Emp_id";
      $result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
      if(mysqli_num_rows($result)==1){


        // if(empty($_FILES["file1"]["type"])){
        //   $imgname = 'defaultuserimage.png';
        //   }
        //   else {
            $imgname = $_FILES["file1"]["name"];
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES['file1']["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $fnameProfile = $UserId."-".$Emp_id."Emp".".".$imageFileType;
            $find_prev_profile = "../images/".$UserId."-".$Emp_id."Emp.*";
            $files = glob($find_prev_profile);
            $files = glob($find_prev_profile);
            foreach($files as $file){
                if(is_file($file)) {
                  unlink($file);
                }
              }
                move_uploaded_file($_FILES['file1']['tmp_name'],$target_dir.$fnameProfile);
                chmod($target_dir.$fnameProfile, 0777);
          // }

        $sql_update    = "UPDATE Employees SET ProfilePic = '$fnameProfile' WHERE EmpId = '$Emp_id'";
        mysqli_query($con,$sql_update) or die(mysqli_error($con));
     $response['update'] = true;


      }

    }

  mysqli_close($con);
  exit(json_encode($response));

?>
