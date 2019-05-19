<?php
// include '../config/connection.php';
include '../config/connection.php';

include '../convert_in_indian_rupee.php';

session_start();
if(isset($_SESSION['a_id']))
{
    $Emp_id=$_REQUEST['id'];//emp_id
    $uname=$_SESSION['uname'];
    $yr = $_REQUEST['yr'];//year
    $month = $_REQUEST['month'];

 ?>


 <div class="col-md-12 " >
   <div class="box">
     <div class="box-body">
         <div class="row">
           <div class="col-sm-4"></div>
           PAYSLIP FOR THE MONTH OF <span id="paymonth"></span>
         </div><br>
         <div class="row">
           <div class="col-sm-10"></div>
           <div class="col-sm-2">
             <span id="payid"></span>
           </div>
         </div><br>

         <div class="row">
            <div class="col-sm-6">
           <span id="company"></span>
         </div>
      </div><br>
      <div class="row">
        <div class="col-sm-6">
          <span id="emp"></span>
        </div>
      </div><br>
      <div class="row">
        <div class="col-sm-6">
          <b>Earnings :</b><br>
          <table class="table table-bordered" style="width:100%">
            <!-- <caption>Monthly savings</caption> -->
            <tbody id="loadearnings">

          </tbody>
          </table>
          </div>
        <div class="col-sm-6">
        <b>Deductions :</b><br>
        <table class="table table-bordered" style="width:100%">
         <tbody id="loaddeductions">
         </tbody>
        </table>
      </div>
    </div><br>
    <div class="row">
      <div class="col-sm-12">
        <b>Leaves :</b><br>
        <table class="table table-bordered" style="width:100%">
          <thead>
            <td>Leave Type</td>
            <td>Assigned Days</td>
            <td>Leaves Taken</td>
            <td>Balance Leaves </td>
          </thead>
          <tbody id="leaves">

        </tbody>
        </table>
        </div>
  </div>
     Net Payable Salary : <span id="netSalary"></span><br>
     In Words : <span id="TotalInWords"></span><br>
     Total Salary : <span id="total"></span>
   </div>
   </div>
 </div>



 <script>
 empdata();
 empLeaves();
 comanyDetails();
     function empdata() {
       // var yr='2019';
       var yr=<?php echo $yr; ?>;
// alert(yr);
       // var month='Feb';
       var month = <?php echo $month; ?>;
       // alert(month);
       var total=0;
     $.ajax({
       url:"../src/fetchPayslipData.php",
       method:"POST",
       data:{yr:yr,month:month,id:<?php echo $Emp_id; ?>},
       success:function(data){
         var response=JSON.parse(data);
         var count=Object.keys(response).length;
         
         for (var i = 0; i < count-1; i++) {
           if(response[i]['creditdebit']=='C')
           {
           $("#loadearnings").append('<tr><td>'+response[i]['head']+'</td><td>'+response[i]['amount']+'</td></tr>');
         }
         else if (response[i]['creditdebit']=='D'){
           $("#loaddeductions").append('<tr><td>'+response[i]['head']+'</td><td>'+response[i]['amount']+'</td></tr>');
         }

         }
        //  alert(response[count-1]['totalEar']);

         $("#paymonth").html(month+' '+yr);
         $("#payid").html('PAYSLIP #'+response[0]['PayslipId']+'<br>salary Month:'+month+','+yr+'');
         $("#emp").html(response[0]['EmpName']+'<br>'+response[0]['address']+'<br>'+response[0]['country']+'<br>'+response[0]['phone']);
         $("#total").html(response[count-1]['total']);
         $("#netSalary").html(response[count-1]['netSal']);
         $("#TotalInWords").html(response[count-1]['totInWords'])
         $("#loadearnings").append('<tr><td>Total Earnings</td><td>'+response[count-1]['totalEar']+'</td></tr>');
         
         $("#loaddeductions").append('<tr><td>Total Deductions</td><td>'+response[count-1]['totalDed']+'</td></tr>');
     }
     });
   }
   function empLeaves() {
     var yr='2019';
     var month='Feb';
     $.ajax({
       url:"../src/fetchLeavesDetails.php",
       method:"POST",
       data:{yr:yr,month:month,id:<?php echo $Emp_id; ?>},
       success:function(data){
         // alert(data);
         var response=JSON.parse(data);
         var count=Object.keys(response).length;
         for (var i = 0; i < count; i++) {
           $("#leaves").append('<tr><td>'+response[i]['Leave']+'</td><td>'+response[i]['asLeaves']+'</td><td>'+response[i]['takenLeaves']+'</td><td>'+response[i]['balanceLeaves']+'</td></tr>');

         }
       }
       });
   }
   function comanyDetails() {
     $.ajax({
       url:"../src/companyDetails.php",
       method:"POST",
       success:function(data){
         var response=JSON.parse(data);
           $("#company").html(response[0]['cname']+'<br>'+response[0]['address']+'<br>'+response[0]['country']+'<br>'+response[0]['email']+'<br>'+response[0]['cphone']);
       }
       });
   }
 </script>

 <?php
 }
 else {
   header("Location:login.php");
 }
 ?>
