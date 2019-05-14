<?php

require_once '../config/connection.php';
session_start();
$UserId = $_SESSION['a_id'];
$companyid = $_POST['companyid'];
$finYear = $_POST['startdatepicker']; 
$companyName = $_POST['inputCname'];
$companyCPerson = $_POST['inputContPersonName'];
$companyPhone = $_POST['inputContNumber'];
$companyEmail = $_POST['inputCompanyEmail'];
$companyFax = $_POST['inputCompanyFax'];
$companyUrl = $_POST['inputCompanyWebUrl'];
$country = $_POST['scountry'];
$state = $_POST['sstate'];
$city = $_POST['scity'];
$pincode = $_POST['inputPincode'];
$CompanyAddr = $_POST['inputCompanyAddr'];

// echo $finYear ;
$response     = [];

if(empty($companyid)){

  $sql  = "INSERT INTO CompanyDetails(userId, companyname,contactperson,address, country,City, State,postalcode, email, contactnumber,fax, websiteurl,financial_year)";
  $sql .= "VALUES($UserId,'$companyName','$companyCPerson','$CompanyAddr','$country','$city',
  '$state','$pincode','$companyEmail','$companyPhone','$companyFax','$companyUrl','$finYear')";
// echo $sql;
  if(mysqli_query($con,$sql) or die(mysqli_error($con))){
  $response['add'] = true;
  }else {
    $response['add'] = false;
  }
}
else{
  $update = "UPDATE CompanyDetails SET companyname='$companyName',contactperson='$companyCPerson',
  address='$CompanyAddr',country='$country',City='$city',State='$state',postalcode='$pincode',
  email='$companyEmail',contactnumber='$companyPhone',fax='$companyFax',websiteurl='$companyUrl',financial_year ='$finYear' WHERE userId = $UserId";

  $updateFirmName ="UPDATE users SET firm = '$companyName' WHERE userId = $UserId";
  mysqli_query($con,$updateFirmName)or die(mysqli_error($con));   
  if(mysqli_query($con,$update) or die(mysqli_error($con))){
    // $response['update'] = true;
    if(mysqli_affected_rows($con)>0){
      $response['update'] = true;
    }else{ 
      $response['update'] = 'noChange';
      }
  }
  else{
    $response['update'] = false;
  }
}



mysqli_close($con);
exit(json_encode($response));
 ?>
