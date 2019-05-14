<?php
include_once('../config/connection.php');
session_start();
$id=$_SESSION['a_id'];
$response  = [];
$sql_query  = "SELECT * FROM CompanyDetails WHERE userId='$id'";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
$row = mysqli_fetch_array($result);

    array_push($response,[
      'cname'    => $row['companyname'],
      'address'   => $row['address'],
      'country'   => $row['country'].' '.$row['State'].' '.$row['City'].' '.$row['postalcode'],
      'email'   => $row['email'],
      'cphone'   => $row['contactnumber']
    ]);
}
// print_r($response);
mysqli_close($con);
exit(json_encode($response));
 ?>
