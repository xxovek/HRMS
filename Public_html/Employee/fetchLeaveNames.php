<?php
include '../../config/connection.php';
session_start();
$userId = $_SESSION['UserId'];

?>
 <option values=""></option>
 <?php
if($result = mysqli_query($con,"SELECT  LeaveId,LeaveType FROM Leaves WHERE UserId='$userId'"))
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
