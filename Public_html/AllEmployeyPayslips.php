<?php
session_start();
include_once '../config/connection.php';

// if(isset($_SESSION['Emp_id'])){
//   $id= $_SESSION['Emp_id'];
//    $sql=" SELECT joining_date FROM Employees t WHERE  `EmpId`='$id' ;";
//    $result=mysqli_query($con,$sql);
//   $row=mysqli_fetch_array($result);
//   $Joinyear=date("Y",strtotime($row[0]));
//   $Joinmonth=date("m",strtotime($row[0]));
//
  if(isset($_SESSION['a_id'])){
      $adminid =$_SESSION['a_id'];
    $uname=$_SESSION['uname'];
    $id= $_REQUEST['id'];//emp_id
    $EmpName = $_REQUEST['EmpName'];
    $sql=" SELECT joining_date FROM Employees t WHERE EmpId='$id';";
       $result=mysqli_query($con,$sql);
      $row=mysqli_fetch_array($result);
      $Joinyear=date("Y",strtotime($row[0]));
      $Joinmonth=date("m",strtotime($row[0]));

   ?>


   <!-- <div class="content-wrapper">
     <section class="content-header">
       <h1>
         Employee Salary Structure
       </h1>

     </section> -->

       <section class="content">
         <!-- <section class="content-header">
           <h1>
             Employee Monthwise Salary Slips
           </h1>

         </section> -->
         <div class="row" style="display:none" id="previewRowDiv">

           <div class="col-md-12" >
             <div class="" id="data">

             </div>

         <div class="col-md-5" >
         <!-- <button type="button" class="btn btn-success" title="Download Payslip" onClick="download_payslip();"><i class="fa fa-download"></i></button> -->
         </div>
         </div>
           <div class="col-md-1"></div>

         </div>

       <div class="row" id="tbldata">
         <div class="col-md-12">

           <div class="box">
             <div class="box-header" >
               <h3 class="box-title"></h3>
               <div class="row" >
               <div class="col-sm-2">
               <select class="select2 form-control" name="year" id="year" onchange="fetchPayslip(this.value);">
                 <option value="">Select Year</option>
                 <?php
                 $yearArray = range($Joinyear, date('Y'));
                 foreach ($yearArray as $year) {
                   // if you want to select a particular year
                   $selected = ($year == date("Y")) ? 'selected' : '';
                   echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                 }
                 ?>
               </select>
             </div>


             <!-- <div class="col-sm-2">
               <select class="form-control select2" name="month" id="month" onchange="fetchPayslip(this.value);">
                 <option value="January">January</option>
                 <option value="February">February</option>
                 <option value="March">March</option>
                 <option value="April">April</option>
                 <option value="May">May</option>
                 <option value="June">June</option>
                 <option value="July">July</option>
                 <option value="August">August</option>
                 <option value="September">September</option>
                 <option value="October">October</option>
                 <option value="November">November</option>
                 <option value="December">December</option>
               </select>
             </div> -->

           </div>
             </div>
           </div><br>
             <!-- /.box-header -->
             <div class="box">
             <div class="box-header"><h4>Monthwise Salary Slips Of <b><?php echo $EmpName; ?></b></h4></div>
             <div class="box-body">
               <!-- Employee Monthwise Salary Slips -->
               <table id="datble" class="table table-bordered table-striped">
                 <thead class="tableHeader">
                 <tr>
                   <th class="text-center ">#</th>
                   <th class="text-center ">Month</th>
                   <th class="text-center ">Net Salary</th>
                   <th class="text-center ">Action</th>
                 </tr>
                 </thead>
                 <tbody id="loadtable">

                 </tbody>

               </table>
             </div>
             <!-- /.box-body -->
           </div>
           <!-- /.box -->
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->
     </section>
     <!-- /.content -->
   <!-- </div> -->


<script>

var months = [
    'January', 'February', 'March', 'April', 'May',
    'June', 'July', 'August', 'September',
    'October', 'November', 'December'
];

function monthNameToNum(monthname) {
    var month = months.indexOf(monthname);
    return month ? month + 1 : 1;
}

$('.select2').select2();

fetchPayslip();
function fetchPayslip(year){
  // alert(year);
  var table = $('#datble').DataTable();
table.destroy();
  $("#loadtable").empty();
  var id = '<?php echo $id; ?>';
// alert(id);
var month = 0;
$.ajax({
  type:'POST',
  url:'../src/displayPayslips.php',
  data:{yr:year,emp_id:id},
  dataType :'json',
  success:function(response){
      // alert(response);
    var count=Object.keys(response).length;
    for(var i=0;i<count;i++){

    month = monthNameToNum(response[i]['Month']);
    // alert(month);
    $("#loadtable").append('<tr></td><td class="text-center"> '+ (i+1) +'</td><td class="text-center">'
    + response[i]['Month']  +'</td><td class="text-center">'
    + response[i]['Amount'] +'</td><td class="text-center"><div class="btn-group"><button type="button" name="edit" title="View Payslip Preview" class="label label-primary pull-right" onClick="view_payslip('+ id+','+month +');"><i class="fa fa-eye"></i></button><button type="button" class="label label-success pull-right" title="Download Payslip" onClick="download_payslip('+ id+','+month +');"><i class="fa fa-download"></i></button></div></td></tr>');
    }

    var table = $("#datble").DataTable({
      // lengthChange: false,
      // buttons: ['copy', 'excel', 'pdf','print']
      bPaginate: $('#datble tbody tr').length>10,
      order: [],
      columnDefs: [ { orderable: false, targets: [0,1,2] } ],
      dom: 'Bfrtip',
          buttons: [
            {
               extend: 'collection',
               text: 'Export',
               buttons: ['copy', 'excel', 'pdf','print']
            }
         ]
    });
table.buttons().container()
.appendTo( '#datble_wrapper .col-md-6:eq(0)' );
}
});
// debugger
}

function fetch_month(param) {
  $("#months").html("");
  $.ajax({
      type: "POST",
      url: "fetch_month.php",
      data:{yr:param,month:<?php echo $Joinmonth; ?>,yr:<?php echo $Joinyear; ?>},
      success: function(msg) {
        // alert(msg);
        $("#months").html('<option value="">Select Month</option>'+msg);
}
});
}

function view_payslip(emp_id,month){
  var yr = document.getElementById('year').value;
// alert(month);
    $("#btn_download").show();
    $("#previewRowDiv").show();
    $("#nodata").hide();
    $("#tbldata").hide();
    // $("#data").load('PaymentSlip.php',{'id':emp_id,'fromDate':fromDate,'uptoDate':uptoDate});
    $("#data").load('PaymentSlip.php',{'id':emp_id,'month':month,'yr':yr});
}


function download_payslip(empid,month){
    // alert(month);
  var yr = document.getElementById('year').value;
  // window.open("pdf.php?id=" + empid , "_blank");
  window.open("pdf.php?id=" + empid +"&month=" + month +"&year="+yr, "_blank");

}
</script>
</body>
</html>
<?php
}
else {
  header("Location:login_salesman.php");
}
?>
