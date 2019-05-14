<?php
include '../../config/connection.php';
session_start();
$EmpId = $_SESSION['Emp_id'];
$sql = "SELECT *,DATE_FORMAT(joining_date,'%b %Y') joining_date FROM Employees WHERE EmpId = $EmpId";
$sql1 = "SELECT * FROM EmployeeEducationDetails WHERE EmpId = $EmpId";

$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    array_push($response,[
        'EmpName' => $row['EmpName'],
        // 'EmpLname' => $row['']
        'ProfilePic' => $row['ProfilePic'],
        'joining_date' => $row['joining_date'],
        'contactNumber' => $row['contactNumber'],
        'EPassword' => $row['EPassword'],
        'EmailId' => $row['EmailId'],
        'address' => $row['Address'].' , '.$row['city'].' , '.$row['state'].' , '.$row['country'],
        ]);
  }
}
if($result = mysqli_query($con,$sql1)){
    while($row = mysqli_fetch_array($result))
    {
      array_push($response,[
        'education' => $row['Empdegree'],
        'passoutyear' => $row['passoutyear'],
        'university' => $row['university']
      ]);

  }
}
mysqli_close($con);
echo json_encode($response);
?>
