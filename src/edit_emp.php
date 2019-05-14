<?php
include_once('../config/connection.php');
$Emp_id = $_REQUEST['Emp_id'];
$response = [];

$sql_query  = "SELECT E.EmpId,E.EmpName,E.gender,E.PAN,
D1.DeptId,D.DesigId,E.DOB,E.Address,
country,state,city,postalcode,EmailId,contactNumber,joining_date,ProfilePic,
D1.DeptName,D.DesigName FROM Employees E
LEFT JOIN EmployeeDesignations ED ON E.EmpId = ED.EmpId
LEFT JOIN EmployeeDepartments ED1 ON ED1.EmpId = E.EmpId
LEFT JOIN Designations D ON D.DesigId = ED.DesigId
LEFT JOIN Departments D1 ON D1.DeptId = ED1.DeptId
WHERE E.EmpId  = '$Emp_id'";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
  $row = mysqli_fetch_array($result);

        $response['Emp_id']      = $row['EmpId'];
        $response['name']      = ucwords($row['EmpName']);
        $response['empPan']   = $row['PAN'];
        $response['gender']   = $row['gender'];
        $response['birthdate']       = $row['DOB'];
        $response['Addr']          = $row['Address'];
        $response['country']         = $row['country'];
        $response['state']  = $row['state'];
        $response['city']  = $row['city'];
        $response['pincode']  = $row['postalcode'];
        $response['useremail']  = $row['EmailId'];
        $response['userphone']  = $row['contactNumber'];
        $response['Joiningdate']  = $row['joining_date'];
        $response['DeptName']  = $row['DeptName'];
        $response['DeptId']  = $row['DeptId'];

        $response['DesigName']  = $row['DesigName'];
        $response['DesigId']  = $row['DesigId'];
        $response['ProfilePic']  = $row['ProfilePic'];

      }
else {
  $response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
