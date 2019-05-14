<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
// $empid = $_REQUEST['empeducation'];

?>
  <!-- <option values=""></option> -->
  <option value=''>Select Department</option>

 <?php
if($result = mysqli_query($con,"SELECT DeptId,DeptName From Departments WHERE UserId = $UserId "))
{
  if(mysqli_num_rows($result)>0)
  {
    while($row=mysqli_fetch_array($result))
    {?>
    <option value='<?php echo $row['DeptId'];?>'><?php echo $row['DeptName'];?></option>
    <?php
    }
  }
}

 ?>
