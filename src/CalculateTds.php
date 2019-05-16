<?php
include '../config/connection.php';
$FromBal = [];
$UptoBal = [];
$Percentage = [];
$TaxArray = [];
$TotalCTC = 500000;
$TaxableValue = 450000;

$sql = 'SELECT * FROM TdsDetails ORDER BY Percentage';
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_array($result)){
    array_push($FromBal,$row['FromBal']);
    array_push($UptoBal,$row['UptoBal']);
    array_push($Percentage,$row['Percentage']);
    }
}
$count = count($FromBal);
echo $count;

function calculateTax($TaxableValueNew,$Percentage,$OldTaxable){
    global $TaxArray;
    $newTaxableValue = $OldTaxable - $TaxableValueNew;
    $Tax = $newTaxableValue*($Percentage/100);
    array_push($TaxArray,$Tax);
   return array_sum($TaxArray);
}
function calculateTDS($Tax){
    global $TotalCTC;
    $avgTax =   ($Tax*100)/$TotalCTC;
    $MonthlyTds = ($TotalCTC/12)*($avgTax/100);
    return number_format($MonthlyTds,2);
}
// echo calculateTDS(calculateTax(250000,5,450000));
// print_r($TaxArray);
// calculateTax(250000,5,450000);
?>