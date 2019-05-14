<?php
include_once('../config/connection.php');
$id = $_REQUEST['id'];
$tblName  = $_REQUEST['tblName'];
$colName  = $_REQUEST['colName'];

$response = [];
$sql_query  = "DELETE FROM $tblName WHERE $colName ='$id'";
if(mysqli_query($con,$sql_query)){
$response['true'] = true;
}else {
$response['false'] = false;
}
mysqli_close($con);
exit(json_encode($response));
 ?>
