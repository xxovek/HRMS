<?php
include_once '../../config/connection.php';

include '../../convert_in_indian_rupee.php';

session_start();
if(isset($_SESSION['Emp_id'])){
  $id=$_SESSION['Emp_id'];
  $month = $_REQUEST['month'];
  $yr = $_REQUEST['yr'];
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
            <td>Assigned Day's</td>
            <td>Leaves Taken</td>
            <td>Balance Leaves </td>
          </thead>
          <tbody id="leaves">

        </tbody>
        </table>
        </div>
  </div>
     <!-- Net Payable Income :<span id="total"></span> -->
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
       // var yr = document.getElementById('year').value;
       var yr = <?php echo $yr; ?>;

       // alert(yr);
       var month = <?php echo $month; ?>;
       // alert(month);

       var total=0;
     $.ajax({
       url:"fetchPayslipData.php",
       method:"POST",
       // method:"REQUEST",
       data:{yr:yr,month:month},
       success:function(data){
         var response=JSON.parse(data);
         var count=Object.keys(response).length;
         for (var i = 0; i < count-1; i++) {
           if(response[i]['creditdebit']=='C')
           {
           $("#loadearnings").append('<tr><td>'+response[i]['head']+'</td><td>'+response[i]['amount']+'</td></tr>');
         }
         else if (response[i]['creditdebit']=='D') {
           $("#loaddeductions").append('<tr><td>'+response[i]['head']+'</td><td>'+response[i]['amount']+'</td></tr>');
         }
         }
         $("#paymonth").html(month+' '+yr);
         $("#payid").html('PAYSLIP #'+response[0]['PayslipId']+'<br>salary Month:'+month+','+yr+'');
         $("#emp").html(response[0]['EmpName']+'<br>'+response[0]['address']+'<br>'+response[0]['country']+'<br>'+response[0]['phone']);
        // $("#total").html(response[count-1]['totalEar']);
         // $("#total").html(response[count-1]['total']);
         $("#total").html(response[count-1]['total']);
         $("#netSalary").html(response[count-1]['netSal']);
         $("#TotalInWords").html(response[count-1]['totInWords'])
         
         $("#loadearnings").append('<tr><td>Total Earnings</td><td>'+response[count-1]['totalEar']+'</td></tr>');
         $("#loaddeductions").append('<tr><td>Total Deductions</td><td>'+response[count-1]['totalDed']+'</td></tr>');

     }
     });
   }

   function empLeaves() {
     // var yr='2019';
     // var month='Feb';
     var yr = <?php echo $yr; ?>;
     // alert(yr);
     var month = <?php echo $month; ?>;
     $.ajax({
       url:"fetchLeavesDetails.php",
       method:"POST",
       // method:"REQUEST",
       data:{yr:yr,month:month,id:<?php echo $id; ?>},
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
       url:"companyDetails.php",
       // method:"REQUEST",
       method:"POST",
       success:function(data){
         // alert(data);
         var response=JSON.parse(data);
           $("#company").html(response[0]['cname']+'<br>'+response[0]['address']+'<br>'+response[0]['country']+'<br>'+response[0]['email']+'<br>'+response[0]['cphone']);
       }
       });
   }
 </script>

 <?php
 }
 else {
   header("Location:../login.php");
 }
 ?>
