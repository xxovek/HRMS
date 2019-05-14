<?php
session_start();
include_once '../../config/connection.php';
if(isset($_SESSION['Emp_id'])){
  $id= $_SESSION['Emp_id'];
   $sql=" SELECT joining_date FROM Employees t WHERE  `EmpId`='$id' ;";
   $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result);
  $Joinyear=date("Y",strtotime($row[0]));
  $Joinmonth=date("m",strtotime($row[0]));
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Advanced form elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 --><script src="../../bower_components/jquery/dist/jquery.min.js"></script>

  <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../../datatables/CSS/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../datatables/CSS/dataTables.bootstrap4.min.css" />
  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'MainHeader.php';?>

    <!-- Left side column. contains the logo and sidebar -->
   <?php include 'MainSidebar.php';?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 >
        Employee Payslips
        <!-- <small>Preview</small> -->
      </h1>

    </section>

      <section class="content">

        <div class="row" style="display:none" id="previewRowDiv">

          <div class="col-md-12" >
            <div class="" id="data">

            </div>

        <div class="col-md-5" >
        <button type="button" class="btn btn-primary"  onClick="javascript:history.go()">Back</button>
        </div>
        </div>
          <div class="col-md-1"></div>

        </div>

      <div class="row" id="tbldata">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header" style="background:lightgrey">
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

          </div>
            </div>
          </div><br>
            <!-- /.box-header -->
            <div class="box">

            <div class="box-body">
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
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- DataTable -->
<script src="../../datatables/jquery.dataTables.min.js"></script>
<script src="../../datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../datatables/dataTables.buttons.min.js"></script>
<script src="../../datatables/buttons.bootstrap4.min.js"></script>
<script src="../../datatables/jszip.min.js"></script>
<script src="../../datatables/pdfmake.min.js"></script>
<script src="../../datatables/vfs_fonts.js"></script>
<script src="../../datatables/buttons.html5.min.js"></script>
<script src="../../datatables/buttons.print.min.js"></script>
<script src="../../datatables/buttons.colVis.min.js"></script>
<script>

var months = [
    'January', 'February', 'March', 'April', 'May',
    'June', 'July', 'August', 'September',
    'October', 'November', 'December'
];

// function getMonth(monthStr){
//   // alert(monthStr);
//     return new Date(monthStr+'-1-01').getMonth()+1;
// }

function monthNameToNum(monthname) {
    var month = months.indexOf(monthname);
    return month ? month + 1 : 1;
}

$('.select2').select2();

fetchPayslip();
function fetchPayslip(year){
  var year = document.getElementById('year').value;
  // alert(year);
  // alert(yr);


  var table = $('#datble').DataTable();
  table.destroy();
  $("#loadtable").empty();
  var id = '<?php echo $id; ?>';
// alert(id);
var month = 0;
$.ajax({
  type:'POST',
  url:'displayPayslips.php',
  data:{yr:year},
  dataType :'json',
  success:function(response){
      // alert(response);
    var count=Object.keys(response).length;
    for(var i=0;i<count;i++){

    month = monthNameToNum(response[i]['Month']);
    // alert(month);
    $("#loadtable").append('<tr></td><td class="text-center"> '+ (i+1) +'</td><td class="text-center">'
    + response[i]['Month']  +'</td><td class="text-center">'
    + response[i]['Amount'] +
    '</td><td class="text-center"><div class="btn-group"><button type="button" name="remove" class="label label-warning pull-right" title="Download Payslip" onClick="download_payslip('
    +month+","+year+');"><i class="fa fa-download"></i></button></div></td></tr>');
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



// function view_payslip(emp_id,month){
//   var yr = document.getElementById('year').value;
// alert(month);
//     $("#previewRowDiv").show();
//     $("#nodata").hide();
//     $("#tbldata").hide();
//     // $("#data").load('PaymentSlip.php',{'id':emp_id,'fromDate':fromDate,'uptoDate':uptoDate});
//     $("#data").load('PaymentSlip.php',{'id':emp_id,'month':month,'yr':yr});
// }

// function countDays(month,year){
//
// var retCnt = 0;
//   $.ajax({
//     url:'countEmpWorkDays.php',
//     type:'POST',
//     data:{month:month,year:year},
//     dataType:'json',
//     success:function(response){
//         alert(response.AttendanceDays);
//         retCnt
//
//     }
//
//   });
//
// }


function download_payslip(month,year){
  window.open("emppayslippdf.php?month=" + month +"&year=" + year, "_blank");
}

</script>
</body>
</html>
<?php }
else {
  header('LOCATION:../EmpLogin.php');
} ?>
