<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['a_id']))
{
  $uname=$_SESSION['uname'];
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
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<style media="screen">
.dot{
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
    <section class="content">

    <section class="content-header">
      <h1 >
        Attendance
      </h1>
      <br>

    </section>

    <!-- Main content -->
    <div class="col-md-12">

      <div class="row">

        <div class="jumbotron text-center" id="nodata" style="display:none;">
          <span class="text-center" style="color:green"><h2>No Data !!</h2>
          </span>
          </div>

      </div>

      <div class="row" id="PageDataDiv">

        <div class="col-md-12">

          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6"></div>

              <div class="col-sm-2">
          <div class="form-group">
      <!-- <div class="col-sm-1"><h4 >  year </h4></div> -->
      <!-- <div class="col-sm-5"> -->

      <select class="select2 form-control" name="year" id="year" >
        <option value="">Select Year</option>
        <?php
        $yearArray = range(1990, 2050);
        foreach ($yearArray as $year) {
          // if you want to select a particular year
          $selected = ($year == date("Y")) ? 'selected' : '';
          echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
        }
        ?>
      </select>
      <!-- </div> -->
      </div>
      </div>

      <div class="col-sm-2">


      <div class="form-group">
        <!-- <div class="col-sm-1"><h4 >  Month </h4></div> -->
        <!-- <div class="col-sm-5"> -->
      <select class="select2 form-control" name="month" id="months" >
        <option value="">Select Month</option>
        <?php

        $monthArray = range(1, 12);

        foreach ($monthArray as $month) {
          $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
          $fdate = date("F", strtotime("2015-$monthPadding-01"));
          $month_name =  ucfirst(strftime("%B", strtotime(date("Y-m-d"))));
          $selected = $month_name ? 'selected' : '';
          echo '<option '.$selected.'value="'.$monthPadding.'">'.$fdate.'</option>';
        }
        ?>
      </select>
      <!-- </div> -->
      </div>

      </div>
      <div class="col-sm-2"><button class="btn btn-success" title="Generate All Employees Salaryslips" type="button" onclick="salaryDays();"  name="button">Generate Payslips</button></div>

      </div>
      </div>
<br>
          <div class="box">

            <div class="box-header"></div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="datble" class="table table-bordered table-striped">
                <thead class="tableHeader">
                <tr>
                  <th class="text-center ">Employee</th>
                  <th class="text-center ">Department</th>
                  <th class="text-center ">Joining date</th>
                  <th class="text-center ">Address</th>
                  <th class="text-center ">Action</th>
                </tr>
                </thead>
                <tbody id="loadtable"></tbody>
              </table>
            </div>
          </div>
            <!-- /.box-body -->
          </div>
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

<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/attendances.js"></script>

<!-- page script -->
<script>
$('.select2').select2();
// fetchattendence();



</script>
</body>
</html>
<?php
}
else {
  header("Location:login.php");
}
?>
