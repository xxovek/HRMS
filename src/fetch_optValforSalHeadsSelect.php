<?php
include_once('../config/connection.php');
session_start();
$aid = $_SESSION['a_id'];
?>
<option value=''>Select Components</option>
<?php
$response = [];

if($result = mysqli_query($con,"SELECT DISTINCT SalaryHeadId,HeadName FROM SalaryHeads WHERE UserId='$aid'"))
{
 if(mysqli_num_rows($result)>0)
 {
   $i = 0;
   while($row=mysqli_fetch_array($result))
   {?>
   <option value='<?php echo $row['SalaryHeadId'] . "-" . $row['HeadName'];?>'><?php echo $row['HeadName'];?></option>
   <?php
   $i++;

   array_push($response,[
       'optval' => $row['SalaryHeadId'] . "-" . $row['HeadName']
   ]);

   }

 }
}

mysqli_close($con);
exit(json_encode($response));
?>
