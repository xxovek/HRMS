<?php
include_once('../config/connection.php');
session_start();
$UserId = $_SESSION['a_id'];
// $empid = $_REQUEST['empeducation'];

?>
  <option values=""></option>
 <?php
if($result = mysqli_query($con,"SELECT LeaveId,LeaveType From Leaves WHERE UserId = $UserId "))
{
  if(mysqli_num_rows($result)>0)
  {
    while($row=mysqli_fetch_array($result))
    {?>
    <option value='<?php echo $row['LeaveId'];?>'><?php echo $row['LeaveType'];?></option>
    <?php
    }
  }
}

 ?>
