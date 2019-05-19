<?php
include '../config/connection.php';
$user_id = $_REQUEST['user_id'];
?>
 <option values=""></option>
 <?php
 $sql="SELECT id, name FROM cities WHERE state_id=22";

if($result = mysqli_query($con,$sql))
{
  if(mysqli_num_rows($result)>0)
  {
    while($row=mysqli_fetch_array($result))
    {?>
    <option value='<?php echo $row['name'];?>'><?php echo $row['name'];?></option>
    <?php
    }
  }
}
 ?>
