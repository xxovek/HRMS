<?php
include '../config/connection.php';
include '../convert_in_indian_rupee.php';

session_start();
if(isset($_SESSION['a_id']))
{
    $Emp_id=$_REQUEST['id'];
    $uname=$_SESSION['uname'];

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Payroll | Payslip</title>
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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
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
<div class="content-wrapper">
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
             <td>Assigned Dyas</td>
             <td>Leaves Taken</td>
             <td>Balance Leaves </td>
           </thead>
           <tbody id="leaves">

         </tbody>
         </table>
         </div>
   </div>
      <span id="total"></span>
    </div>
    </div>
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

<!-- page script -->
<script>
empdata();
empLeaves();
comanyDetails();
    function empdata() {
      var yr='2019';
      var month='Feb';
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
        else if (response[i]['creditdebit']=='D') {
          $("#loaddeductions").append('<tr><td>'+response[i]['head']+'</td><td>'+response[i]['amount']+'</td></tr>');
        }
        }
        $("#paymonth").html(month+' '+yr);
        $("#payid").html('PAYSLIP #'+response[0]['PayslipId']+'<br>salary Month:'+month+','+yr+'');
        $("#emp").html(response[0]['EmpName']+'<br>'+response[0]['address']+'<br>'+response[0]['country']+'<br>'+response[0]['phone']);
        $("#total").html(response[count-1]['total']);
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
</body>
</html>
<?php
}
else {
  header("Location:login.php");
}
?>
