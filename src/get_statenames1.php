<?php
include '../config/connection.php';
$user_id = $_REQUEST['user_id'];
?>
 <option values=""></option>
 <?php
 $sql="SELECT states.name,states.id From states where country_id=101";

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
