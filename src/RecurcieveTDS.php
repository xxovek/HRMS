<?php
$TaxArray = [];
$TotalCTC = 500000;
function calculateTDS($Taxable){
    global $TaxArray;
    include '../config/connection.php';
    $sql = "SELECT FromBal,UptoBal,Percentage FROM TdsDetails WHERE FromBal < $Taxable AND UptoBal >= $Taxable";
    $result = mysqli_query($con,$sql);
    $row        = mysqli_fetch_array($result);
    $fromBal    = $row['FromBal'];
    $percentage = $row['Percentage'];

    if($percentage == 0){
        return AverageTotalTDS(array_sum($TaxArray));
    }else{
        $newTaxable = $Taxable-$fromBal;
        $Tax = $newTaxable*($percentage/100);
        array_push($TaxArray,$Tax);
        return calculateTDS($fromBal);
    }
}

function AverageTotalTDS($Tax){
    global $TotalCTC;
    $avgTax =   ($Tax*100)/$TotalCTC;
    $MonthlyTds = ($TotalCTC/12)*($avgTax/100);
    return number_format($MonthlyTds,2);
}
echo calculateTDS(450000);
?>