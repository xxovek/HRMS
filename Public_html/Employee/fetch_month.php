<?php
$yr=$_POST['yr'];
$month1=$_POST['month'];
$Jyr=$_POST['Jyr'];
$newMon=(int)date("m");
// echo $newMon;
if($Jyr==$yr)
{
  if($month1>=$newMon){
      $monthArray = range($month1, 12);
  }
  else {
    $monthArray = range($month1, date("m"));
  }
}
else if($yr==date("Y"))
{
$monthArray = range(1, date("m"));
}
else if($yr<date("Y")){
$monthArray = range(1, 12);
}

foreach ($monthArray as $month) {
  $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
  $fdate = date("F", strtotime("2015-$monthPadding-01"));
  $month_name =  ucfirst(strftime("%B", strtotime(date("Y-m-d"))));
  $selected = $month_name ? 'selected' : '';
  echo '<option '.$selected.'value="'.$monthPadding.'">'.$fdate.'</option>';
}
?>
