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
  <title>HRM MANAGEMENT | SALARYHEADS COMPONENTS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../datatables/CSS/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="../datatables/CSS/dataTables.bootstrap4.min.css" />
  <!-- <link rel="stylesheet" href="../assets/stylesheets/datatables/css/jquery.dataTables.min.css"> -->
  <!-- <link rel="stylesheet" href="../assets/stylesheets/datatables/css/buttons.dataTables.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
  <header class="main-header">
    <?php include "MainHeader.php"; ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php include "MainSidebar.php" ; ?>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <section class="content-header">
        <h1 >
           Salary Components
        </h1>
        <br>
      </section>

      <div class="col-md-12">
        <div class="box" id="new" >
            <div class="box-body">
              <form  id="submitformdata" method="post" >
                  <div class="row">
                    <div class="col-md-1"></div>
                    <input type="hidden" name="SalaryHead_id" id="SalaryHead_id" />
                    <div class="col-md-10">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="ip_salaryhead">Salary Component Name</label>
                              <input type="text" id="ip_salaryhead" name="ip_salaryhead" class="form-control" placeholder="Enter Salary Component" autocomplete="off" required>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-check-inline">
                              <label for="type1">Type</label>
                              <br>
                                <!-- <input type="checkbox" id="type" class="minimal-red" checked>Credit -->
                                <label >
                                <input type="radio" id="type1" name="type" value="C"  class="minimal" checked>Credit
                              </label>
                              <label >
                                <!-- <input type="checkbox" class="minimal-red">Debit -->
                                <input type="radio" id="type2" name="type" value="D" class="minimal">Debit
                              </label>
                            </div>
                          </div>

                      <div class="col-md-1" id="add">
                        <div class="form-group">
                          <div id="addleave"  style="margin-top:10px;" ></div>
                        <button class="btn btn-success" type="submit" name="button">Add</button>
                      </div>
                    </div>
                    <div class="col-md-1" id="update" style="display:none;">
                      <div class="form-group">
                        <div id="updateleave" style="margin-top:10px;"></div>
                      <button class="btn btn-success" type="submit" name="button">Save</button>
                    </div>
                  </div>
                  <div class="col-md-1" >
                    <div class="form-group">
                    <div  style="margin-top:10px;"></div>
                    <button class="btn btn-default" type="reset" id="btnCancel" name="button">Cancel</button>
                  </div>
                </div>


                  </div>
          </div>
        </form>
        </div>
      </div>
    </div>



  <div class="col-md-12">
    <div class="jumbotron text-center" id="nodata" style="display:none;">
      <span class="text-center" style="color:green">
      <h2>No Salary Component Added Yet !!</h2>
      </span>
    </div>
      <div class="row" id="tbldata" style="display:none;">
        <div class="col-md-12">
          <div class="box" id="emp">
            <div class="box-header"></div>
            <div class="box-body">
              <div class="table-responsive">
                <table id="datble" class="table table-bordered table-striped">
                  <thead class="tableHeader">
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Salary Component Name</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody id="loadtable"></tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </div>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer> -->
  <?php include "MainFooter.php"; ?>
  <?php include "RightSidebar.php"; ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- ./wrapper -->
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../datatables/jquery.dataTables.min.js"></script>
<script src="../datatables/dataTables.bootstrap4.min.js"></script>
<script src="../datatables/dataTables.buttons.min.js"></script>
<script src="../datatables/buttons.bootstrap4.min.js"></script>
<script src="../datatables/jszip.min.js"></script>
<script src="../datatables/pdfmake.min.js"></script>
<script src="../datatables/vfs_fonts.js"></script>
<script src="../datatables/buttons.html5.min.js"></script>
<script src="../datatables/buttons.print.min.js"></script>
<script src="../datatables/buttons.colVis.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/salaryhead.js"></script>

<!-- page script -->

<!-- <script>
$(document).ready(function()
{
});
</script> -->

</body>
</html>

<?php
}
else {
  header("Location:login.php");
}
?>
