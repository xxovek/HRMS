<?php
include '../config/connection.php';
$response = [];
session_start();
$UserId = $_SESSION['a_id'];
$joindate   = $_REQUEST['editjoindate'];
mysqli_query($con,'SET foreign_key_checks = 0');
if(!empty($_REQUEST['editempid']))
{
  $Emp_id = $_REQUEST['editempid'];

  $sql_query  = "SELECT EmpId FROM Employees WHERE EmpId = $Emp_id";
  $result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
  if(mysqli_num_rows($result)==1){
    $sql_update    = "UPDATE Employees SET joining_date = '$joindate' WHERE EmpId = '$Emp_id'";
    mysqli_query($con,$sql_update) or die(mysqli_error($con));
    if(!empty( $_REQUEST['empdesg'])){
        $desigId = $_REQUEST['empdesg'];
        $desgn_sql  = "SELECT EmpId FROM EmployeeDesignations WHERE EmpId='$Emp_id'";
        // echo $desgn_sql;
        $result1 = mysqli_query($con,$desgn_sql) or die(mysqli_error($con));
        if(mysqli_num_rows($result1)==1){
        $desgn_update = "UPDATE EmployeeDesignations SET DesigId='$desigId' WHERE EmpId='$Emp_id'";
        // echo $desgn_update;
        mysqli_query($con,$desgn_update) or die(mysqli_error($con));
    }
  }
  if(!empty($_REQUEST['editdept'])){
      $deptId = $_REQUEST['editdept'];
      $dept_sql  = "SELECT EmpId FROM EmployeeDepartments WHERE EmpId='$Emp_id'";

      $result2 = mysqli_query($con,$dept_sql) or die(mysqli_error($con));
      if(mysqli_num_rows($result2)==1){
      $dept_update = "UPDATE EmployeeDepartments SET DeptId='$deptId' WHERE EmpId='$Emp_id'";
      mysqli_query($con,$dept_update) or die(mysqli_error($con));
  }
}
$response['update']  = true;
  }
  else {
  $response['notupdated'] = false;
  }
}

mysqli_query($con,'SET foreign_key_checks = 1');

  mysqli_close($con);
  exit(json_encode($response));

?>
