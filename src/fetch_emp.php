<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
?>
  <option values=""></option>
 <?php
if($result = mysqli_query($con,"SELECT EmpId,EmailId From Employees  WHERE UserId = $UserId"))
{
  if(mysqli_num_rows($result)>0)
  {
    while($row=mysqli_fetch_array($result))
    {?>
    <option value='<?php echo $row['EmpId'];?>'><?php echo $row['EmailId'];?></option>
    <?php
    }
  }
}

 ?>
