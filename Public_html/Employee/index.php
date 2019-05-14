<?php
session_start();
include_once '../../config/connection.php';
if(isset($_SESSION['Emp_id'])){
  $id=$_SESSION['Emp_id'];
  $adminid =$_SESSION['UserId'];
// echo $id;
   $sql=" SELECT * FROM EmployeeAttendance t WHERE t.Day >= ( CURDATE() - INTERVAL 2 DAY ) AND EmpId=$id ORDER BY Day DESC ;";
   $result=mysqli_query($con,$sql);
   $sql1="SELECT COUNT(Day) FROM EmployeeAttendance WHERE MONTH(Day)=MONTH(CURDATE()) AND EmpId=$id";
    $result1=mysqli_query($con,$sql1);
    $row1=mysqli_fetch_array($result1);
    $days=cal_days_in_month(CAL_GREGORIAN,date('m'),date('y'));
    // echo $days;
    $sql2="SELECT COUNT(UserId) FROM Leaves WHERE UserId='$adminid' AND MONTH(created_at)=MONTH(CURDATE())";
    $result2=mysqli_query($con,$sql2);
    $row2=mysqli_fetch_array($result2);
    $sql3="SELECT COUNT(UserId) FROM Holidays WHERE UserId='$adminid' AND MONTH(HolidayDate)=MONTH(CURDATE())";
    $result3=mysqli_query($con,$sql3);
    $row3=mysqli_fetch_array($result3);
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | DASHBOARD </title>
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
  <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<style media="screen">

  @media (min-width: 992px) {
    .col-md-3 > .panel {
      min-height: 280px;
      font-size: 18px;
    }
  }

  #middle{
    margin-top: 80px;
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
      <h1>
        Dashboard
        <!-- <small>Control panel</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
      <br>
    </section>
    <!-- <h2>Mark Attendance</h2> -->
    <!-- Main content -->
    <section class="content">
      <!-- <div class="content-wrapper"> -->
<div id="middle" class="row">
  <!-- <h2>Mark Attendance</h2> -->

  <div class="col-md-12">
  <div class="col-md-3 grid-margin stretch-card">
      <div class="panel panel-default">
        <div class="panel-heading text-center" style="background:#2da3e6">
  <h2><p id="date" style="font-size: 28px; "></p></h2>
    <p id="time"  style="font-size: 15px;padding-left: 37%;font-weight: bold;"></p>
  </div>
  <!-- <div class="row"> -->
    <!-- <div class="col-md-4">
    </div> -->
    <!-- <div class="col-md-4 grid-margin stretch-card"> -->
        <div class="panel-body">
          <h4 class="card-title">Select Time</h4>
          <form class="forms-sample" id="attendance">
            <div class="form-group">
              <select class="form-control select2" id="Time"  name="status">
                <option value="in">Time In</option>
                <option value="out">Time Out</option>
              </select>
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control" id="employee" name="employee" placeholder="Employee Id" value="<?php echo $_SESSION['Emp_id'];?>" readonly>
            </div>
            <button type="submit" class="btn btn-success mr-2"><i class="fa fa-sign-in"></i>Click</button>
          </form>
        </div>


      </div>
      <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none; margin-top: 10px;" >
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
      </div>
      <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none; margin-top: 10px;" >
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
      </div>
      <!-- <div class="col-md-4">
      </div> -->
    <!-- </div> -->
  <!-- </div> -->
  </div>
  <div class="col-sm-1">
    </div>
<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading text-center" style="background:#2da3e6"><h2>Recent Swipes</h2></div>
    <div class="panel-body">
      <?php
      while ($row=mysqli_fetch_array($result)) {

      ?>
      <div class="row">
      <div class="col-sm-2">IN: </div> <div class="col-sm-2"><?php echo $row[2].'&nbsp;'.$row[3]?> </div>
    </div>
        <div class="row">
      <div class="col-sm-2">OUT: </div><div class="col-sm-2"> <?php echo $row[2].'&nbsp;'.$row[4];?></div>
      </div>
    <?php
  } ?>
    </div>
  </div>
</div>
<!-- </div> -->
<div class="col-sm-1">
  </div>
<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading text-center" style="background:#2da3e6"><h2>Monthly Salary</h2></div>
    <div class="panel-body">
      <div class="row">
      <div class="col-sm-6">Present Days</div><div class="col-sm-1"><?php  echo $row1[0];?></div>
    </div>
    <div class="row">
      <div class="col-sm-6">Absent </div><div class="col-sm-1"> <?php  echo $days-$row1[0];?></div>
    </div>
    <div class="row">
      <div class="col-sm-6">On Leave </div> <div class="col-sm-1"> <?php echo $row2[0]; ?></div>
    </div>
    <div class="row">
      <div class="col-sm-6">Holidays </div><div class="col-sm-1"> <?php echo $row3[0]; ?></div>
    </div>
    <div class="row">
      <div class="col-sm-6">Late In </div><div class="col-sm-1">- </div>
    </div>
    </div>
  </div>
</div>
</div>

      <!-- </div> -->
    </section>
    <!-- /.content -->

  </div>
</div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <?php include 'RightSidebar.php';?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<script src="../../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>

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
<script src="../../js/moment.js"></script>
<script type="text/javascript">

$('.select2').select2()
</script>
<script type="text/javascript">

$(function() {
    var interval = setInterval(function() {
      var momentNow = moment();
      $('#date').html(momentNow.format('dddd').substring(0,15).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
      $('#time').html(momentNow.format('hh:mm:ss A'));
    }, 100);
      });
      $('#attendance').submit(function(e){
        e.preventDefault();
        var attendance = $(this).serialize();
        $.ajax({
          type: 'POST',
          url: 'addAttendance.php',
          data: attendance,
          dataType: 'json',
          success: function(response){
            if(response.error){
              $('.alert').hide();
              $('.alert-danger').show();
              $('.message').html(response.message);
            }
            else{
              $('.alert').hide();
              $('.alert-success').show();
              $('.message').html(response.message);
              //$('#employee').val('');
            }
          }
        });
      });
</script>
</body>
</html>
<?php }
else {
  header('LOCATION:../EmpLogin.php');
} ?>
