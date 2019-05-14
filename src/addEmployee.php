<?php
include '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$response = [];

$fname   = $_POST['fname'];
$lname   = $_POST['lname'];
$EmpName = $fname.'-'.$lname;
$gender  = $_POST['gender'];
$DOB     = $_POST['birthdate'];
$address = $_POST['addr'];
$country = $_POST['scountry'];
$state   = $_POST['sstate'];
$city    = $_POST['scity'];
$postalcode =$_POST['pincode'];
$EmailId = $_POST['email'];
$contactNumber = $_POST['phone'];
$joining_date = $_POST['jdate'];
$EmpPAN = $_POST['panNum'];
$fnameProfile = 'defaultuserimage.png';

// if(empty($_FILES["file"]["type"])){
//     $fnameProfile = 'defaultuserimage.png';
//  }

// if(empty($_FILES["file"]["type"])){
//     $fnameProfile = 'defaultuserimage.png';
//     }
    // else {
    //   $imgname = $_FILES["file"]["name"];
    //   $target_dir = "../images/";
    //   $target_file = $target_dir . basename($_FILES['file']["name"]);
    //   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //   $fnameProfile = $UserId."-".$Emp_id."Emp".".".$imageFileType;
    //   $find_prev_profile = "../images/".$UserId."-".$Emp_id."Emp.*";
    //   $files = glob($find_prev_profile);
    //   $files = glob($find_prev_profile);
    //   foreach($files as $file){
    //       if(is_file($file)) {
    //         unlink($file);
    //       }
    //     }
    // }
    // $insertImgNameSql = "INSERT INTO Employees (ProfilePic) VALUES('$fnameProfile')";
    // mysqli_query($con,$insertImgNameSql) or die(mysqli_error($con));
    // move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$fnameProfile);
    // chmod($target_dir.$fnameProfile, 0777);


  if (!empty($_POST['gender']) && !empty($_POST['panNum']) && !empty($_POST['jdate']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['pincode']) && !empty($_POST['scity']) &&
  !empty($_POST['sstate']) && !empty($_POST['scountry']) && !empty($_POST['addr']) && !empty($_POST['birthdate']) && !empty($_POST['lname']) && !empty($_POST['fname'])){
  // $gender  = $_POST['gender'];

  $sql = "INSERT INTO Employees (UserId,EmpName,gender,DOB,Address,country,state,city,postalcode,EmailId,contactNumber,ProfilePic,joining_date,PAN)
  VALUES ('$UserId','$EmpName','$gender','$DOB','$address','$country','$state','$city','$postalcode','$EmailId','$contactNumber','$fnameProfile','$joining_date','$EmpPAN')";


if(mysqli_query($con,$sql) or die(mysqli_error($con))){
    $Emp_id= $con->insert_id;

    if(!empty($_FILES["file"]["type"])){
        $imgname = $_FILES["file"]["name"];
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES['file']["name"]);
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
          $insertImgNameSql = "UPDATE Employees SET ProfilePic = '$fnameProfile' WHERE EmpId = '$Emp_id'";
         
          mysqli_query($con,$insertImgNameSql) or die(mysqli_error($con));
          move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$fnameProfile);
          chmod($target_dir.$fnameProfile, 0777);
        }
    


    if(!empty($_POST['designation'])){
        $desigId = $_POST['designation'];
        $desg_sql = "INSERT INTO EmployeeDesignations(EmpId,DesigId) VALUES('$Emp_id','$desigId')";
        mysqli_query($con,$desg_sql) or die(mysqli_error($con));
    }

    else{
        $desg_sql = "INSERT INTO EmployeeDesignations(EmpId,DesigId) VALUES('$Emp_id',NULL)";
        mysqli_query($con,$desg_sql) or die(mysqli_error($con));
    }


    if(!empty($_POST['department'])){
        $deptId = $_POST['department'];
        $dept_sql = "INSERT INTO EmployeeDepartments(EmpId,DeptId) VALUES('$Emp_id','$deptId')";
        mysqli_query($con,$dept_sql) or die(mysqli_error($con));
    }
        else{
            $dept_sql = "INSERT INTO EmployeeDepartments(EmpId,DeptId) VALUES('$Emp_id',NULL)";
            mysqli_query($con,$dept_sql) or die(mysqli_error($con));
        }
        $response['message'] = true;
}
else{
$response['message'] = false;
}
}
mysqli_close($con);
exit(json_encode($response));
?>
