<?php
include '../config/connection.php';

$uname    = $_POST['uname'];
$pwd      = $_POST['pwd'];
$response = [];
// $sql="select id,uname,pwd from admin where uname='$uname' and pwd='$pwd'";
$sql="select userId,email,upassword from users where email='$uname' and upassword='$pwd'";

// echo $sql;
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)==1)
{
  session_start();
  $row=mysqli_fetch_array($result);
  $_SESSION['a_id']=$row['userId'];
  $_SESSION['uname']=$row['email'];
  $_SESSION['upassword']=$row['upassword'];

  $response['success']=true;
}
else {
  $response['failure']=false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
