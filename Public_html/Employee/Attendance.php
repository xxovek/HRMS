<?php
session_start();
include_once '../../config/connection.php';
if(isset($_SESSION['Emp_id'])){
  $id=$_SESSION['Emp_id'];
   $sql="SELECT joining_date FROM Employees t WHERE  EmpId = $id";
   $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result);
  $Joinyear=date("Y",strtotime($row[0]));
  $Joinmonth=date("m",strtotime($row[0]));
  $Joindate= date("d",strtotime($row[0]));
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | ATTENDANCE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../datatables/CSS/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../datatables/CSS/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">

  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style media="screen">
.dot {
  border-radius: 50%;
   behavior: url(PIE.htc);
   /* remove if you don't care about IE8 */
   width: 26px;
   height: 26px;
   padding: 8px;
   background: #fff;
   border: 2px solid #666;
   color: #666;
   text-align: center;
   font: 12px Arial, sans-serif;
}
</style>
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
        Attendance
        <!-- <small></small> -->
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- <div class="row">

        <div class="jumbotron text-center" id="nodata" style="display:none;">
          <span class="text-center" style="color:green"><h2>No Data !!</h2>
          </span>
          </div>

      </div> -->
      <div class="row" id="PageDataDiv">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header" style="background:lightgrey">
              <h3 class="box-title"></h3>
              <div class="row" >
              <div class="col-sm-2">
              <select class="select2 form-control" name="year" id="year" onchange="fetch_month(this.value);">
                <option value="">Select Year</option>
                <?php
                $yearArray = range($Joinyear, 2050);
                foreach ($yearArray as $year) {
                  // if you want to select a particular year
                  $selected = ($year == date("Y")) ? 'selected' : '';
                  echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-sm-1">
            </div>
            <div class="col-sm-2">
              <select class="select2 form-control" name="month" id="months" onchange="fetchattendence(this.value)">
                <option value="">Select Month</option>
                <?php

                $monthArray = range(1, date("m"));

                foreach ($monthArray as $month) {
                  $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                  $fdate = date("F", strtotime("2015-$monthPadding-01"));
                  $month_name =  ucfirst(strftime("%B", strtotime(date("Y-m-d"))));
                  $selected = $month_name ? 'selected' : '';
                  echo '<option '.$selected.'value="'.$monthPadding.'">'.$fdate.'</option>';
                }
                ?>
              </select>
            </div>
          </div>
            </div>
          </div><br>
            <div class="box">
            <!-- /.box-header -->
            <div class="row">
              <div class="jumbotron text-center" id="nodata" >
                <span class="text-center" style="color:green"><h2>Select Month !!</h2>
                </span>
                </div>
            </div>
            <div class="box-body" id="tbodyBoxDiv" style="display:none">

              <div class="table-responsive">


              <table id="datble" class="table table-bordered table-striped">
                <thead class="tableHeader">
                <tr>
                  <th class="text-center ">Date</th>
                  <th class="text-center ">In Time</th>
                  <th class="text-center ">Out Time</th>
                  <th class="text-center ">Work Hours</th>
                  <th class="text-center ">Status</th>
                </tr>
                </thead>
                <tbody id="loadtable">

                </tbody>

              </table>
              </div>
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
  <?php include 'RightSidebar.php';?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
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
<!-- page script -->
<script>
$('.select2').select2();


fetchattendence(month);
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });


// var yr = document.getElementById('year').value;
  function fetchattendence(month){
    $("#tbodyBoxDiv").show();
    $("#nodata").hide();

    var table = $('#datble').DataTable();
  table.destroy();
    $("#loadtable").empty();
    var yr = document.getElementById('year').value;

  $.ajax({
    url:'displayAttendance.php',
   type:'POST',
    data:{yr:yr,month:month,jdate:<?php echo $Joindate ?>,jmonth:<?php echo $Joinmonth; ?>,jyr:<?php echo $Joinyear; ?>},
    // dataType :'json',
    success:function(data){
      var response = JSON.parse(data);
      // alert("ok");

      var count= Object.keys(response).length;

      // if(count>0){
      for(var i=0;i<count;i++){
        var status="PRESENT";
        color1='style="color:green"';
      //  alert(response[i]['time_in']);

        // if (!(response[i]['time_in'])) {
        //   response[i]['time_in']='----';
        //   response[i]['time_out']='----';
        //   response[i]['hour']='----';
        //   if(!(response[i]['status'])){
        //   status="ABSENT";
        //   color1='style="color:red"';
        // }
        //   else {
        //     status=response[i]['status'];
        //     color1='style="color:orange"';
        //   }
        // }
        if (!(response[i]['time_in'])) {
          response[i]['time_in']='----';
          response[i]['time_out']='----';
          response[i]['hour']='----';

        if (response[i]['status']=='LEAVE') {
          status=response[i]['status'];
          color1='style="color:blue"';
        }
        else if (response[i]['status']=='HOLIDAY'){
          status = response[i]['status'];
          color1='style="color:orange"';
        }
        else if (response[i]['status']=='WEEK-OFF'){
          status = response[i]['status'];
          color1='style="color:black"';
        }
          else {
            // status=response[i]['status'];
            status="ABSENT";
            color1='style="color:red"';
          }

        }
          // statusarr.push(status);
      $("#loadtable").append('<tr><td  class="text-center"><span class="dot">'+response[i]['date1']+'</span><br><br>'+response[i]['day']+'</td><td class="text-center">'+response[i]['time_in']+
      '</td><td class="text-center"> '+ response[i]['time_out'] +'</td><td class="text-center"> '+ response[i]['hour'] +'&nbsp; Hours</td><td class="text-center"'+color1+'> '+status+'</td></tr>');
      }
      // cnt=count;

    var table = $("#datble").DataTable({

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

}


  function fetch_month(param) {
    $("#months").html("");
    $.ajax({
        type: "POST",
        url: "fetch_month.php",
        data:{yr:param,month:<?php echo $Joinmonth; ?>,Jyr:<?php echo $Joinyear; ?>},
        success: function(msg) {
          // alert(msg);
          $("#months").html('<option value="">Select Month</option>'+msg);
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
