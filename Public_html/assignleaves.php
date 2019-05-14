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
  <title>HRM MANAGEMENT | LEAVES TYPES</title>
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
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
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
           Leave Types
        </h1>
        <ol class="breadcrumb">
          <button class="btn btn-block btn-success" type="button" name="button" id="leaves" onclick="add_leaves()" style="display:none;">Add Leave Type</button>
        </ol>
        <br>
      </section>



      <div class="col-md-12">
        <div class="box" id="new" >
            <div class="box-body">
              <form  id="submitformdata" method="post" >
                  <div class="row">
                    <!-- <div class="col-md-2"></div> -->
                    <input type="hidden" name="leave_id" id="leave_id" />
                    <div class="col-md-12">
                      <div class="col-md-1">
                      </div>
                          <div class="col-md-2">

                            <div class="form-group">
                              <label for="Leavetype" ><h5>Leave Type Name</h5></label>
                              <input type="text"   name="leavetype" id="leavetype" class="form-control"  placeholder="Enter Leave Type Name" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <label for="fromdate" class="col-md-2 control-label "><h5>From</h5></label>
                            <div class="form-group">
                              <input type="text"  name="fromdate" id="fromdate" class="form-control" readonly autocomplete="off" required>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <label for="uptodate" class="col-md-2 control-label "><h5>Upto</h5></label>
                            <div class="form-group">
                              <input type="text"  name="uptodate" id="uptodate" readonly class="form-control"  autocomplete="off" required>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <label for="numdays" ><h5>Number Of Days</h5></label>
                            <div class="form-group">
                              <input type="number"  name="numdays" id="numdays" min="1" max="180" class="form-control"  placeholder="Enter Total Leaves In Year" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check-inline">
                              <label for="type1"><h5>Type</h5></label>

                              <br>
                                <label >
                                <input type="radio" id="type1" name="type" value="1"  class="minimal" checked>Paid
                              </label>
                              <label >
                                <input type="radio" id="type2" name="type" value="0" class="minimal">Unpaid
                              </label>
                            </div>
                          </div>
                        </div>
                          <div class="col-md-12">
                            <div class="col-sm-5">
                            </div>

                      <div class="col-md-4">
                        <div class="row">
                      <div class="col-md-2" id="add">
                        <div class="form-group">
                          <div id="addleave"  style="margin-top:10px;" ></div>
                        <button class="btn btn-success" type="submit" name="button">Add </button>
                      </div>
                    </div>
                    <div class="col-md-3" id="update" style="display:none;">
                      <div class="form-group">
                        <div id="updateleave" style="margin-top:10px;"></div>
                      <button class="btn btn-success" type="submit" name="button">Update </button>
                    </div>
                  </div>
                    <div class="col-md-1" id="cancel">
                      <div class="form-group">
                        <div id="cancelleave"  style="margin-top:10px;" ></div>
                      <button class="btn btn-default" type="reset" name="button" onclick="window.location.reload();">Cancel </button>
                    </div>
                  </div>
                  <!-- <div class="col-md-1" id="cancel1" style="display:none;">
                    <div class="form-group">
                      <div id="cancelleave1"  style="margin-top:10px;" ></div>
                    <button class="btn btn-default" type="button" name="button" onclick="window.location.reload();">Cancel </button>
                  </div>
                </div> -->

                </div>
              </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-sm-3">
                    </div>

                      <div class="col-md-4">
                        <span id="msgErrorForDays"></span>

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
            <h2>No Leave Type Added Yet !!</h2>
          </span>
      </div>
    <div class="row" id="tbldata" style="display:none;">
      <div class="col-md-12">

        <div class="box" id="emp">

          <div class="box-body">
            <div class="table-responsive">
            <table id="datble" class="table table-bordered table-striped">
              <thead class="tableHeader" >
                <tr>
                  <th class="text-center">#</th>
                  <th >Leave Type Name</th>
                  <th >From Date</th>
                  <th >Upto Date</th>
                  <th >Number Of Days</th>
                  <th>Type</th>
                  <th >Action</th>
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

    </div>
  </section>
  </div>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <?php include "RightSidebar.php"; ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>  </div>
<!-- ./wrapper -->

<!-- Datatables -->
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
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/leavesassign.js"></script>

<!-- page script -->
</body>
</html>

<?php
}
else {
  header("Location:login.php");
}
?>
