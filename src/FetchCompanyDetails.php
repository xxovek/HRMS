<?php

require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$response =[];
$sql="SELECT * FROM CompanyDetails WHERE userId = $UserId";
$result = mysqli_query($con,$sql)or die(mysqli_error($con));

if(mysqli_num_rows($result)>0){

$row = mysqli_fetch_array($result);

$response['companyid'] = $row['c_id'];
$response['companyname'] = $row['companyname'];
$response['contactperson'] = $row['contactperson'];
$response['finaYear'] = $row['financial_year'];
$response['address'] = $row['address'];
$response['country'] = $row['country'];
$response['City'] = $row['City'];
$response['State'] = $row['State'];
$response['postalcode'] = $row['postalcode'];
$response['email'] = $row['email'];
$response['contactnumber'] = $row['contactnumber'];
$response['fax'] = $row['fax'];
$response['websiteurl'] = $row['websiteurl'];

}
mysqli_close($con);
exit(json_encode($response));
 ?>
