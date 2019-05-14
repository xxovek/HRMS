<?php
session_start();
if(isset($_SESSION['Emp_id'])){
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | HOLIDAYS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- DataTable CSS-->
  <link rel="stylesheet" href="../../datatables/CSS/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../datatables/CSS/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'MainHeader.php';?>

  <!-- Left side column. contains the logo and sidebar -->
 <?php include 'MainSidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 >
        Holidays
        <!-- <small>Control panel</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Holidays</li>
      </ol> -->
    <div class="row">
      <div class="jumbotron text-center" id="nodata" style="display:none;">
        <span class="text-center" style="color:green">
        <h2>There is No Holidays Available !!</h2>
        </span>
      </div>

        <div class="col-xs-12" style="margin-top: 45px;" id="tbldata">
            <div class="box" id="emp">
              <div class="box-header">
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                <table id="datble" class="table  table-borderd ">
                  <thead  class="tableHeader">
                  <tr>
                    <th class="text-center ">#</th>
                    <th class="text-center ">HOLIDAY NAME</th>
                    <th class="text-center ">DATE  </th>
                  </tr>
                  </thead>
                  <tbody id="loadtable">
                  </tbody>
                </table>
              </div>
              </div>
            </div>

      </div>
    </div>


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
  <?php include 'RightSidebar.php';?>

  <div class="control-sidebar-bg"></div>
</div>


<!-- jQuery UI 1.11.4 -->
<script src="../../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../../bower_components/raphael/raphael.min.js"></script>
<script src="../../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
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
<script type="text/javascript">
fetchholidays();
function fetchholidays()
{
$.ajax({
  type:'POST',
  url:'displayHolidays.php',
  dataType:'json',
  success:function(response){
    var count=Object.keys(response).length;
    if(count>0){
    for(var i=0;i<count;i++)
    {
    $("#loadtable").append('<tr><td  class="text-center">'+(i + 1)+'</td><td class="text-center">'+response[i]['holiday_name']+
    '</td><td class="text-center"> '+ response[i]['holiday_date'] +'</td></tr>');
    }
  $('#tbldata').show();


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

}else {
  $('#tbldata').hide();
    $('#nodata').show();

}
}
});
}
</script>
</body>
</html>
<?php }
else {
  header('LOCATION:../EmpLogin.php');
} ?>
