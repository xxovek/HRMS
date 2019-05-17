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
  <title>HRM MANAGEMENT | DESIGANATIONS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../datatables/CSS/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="../datatables/CSS/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <?php include "MainHeader.php"; ?>
  </header>
  <aside class="main-sidebar">
    <?php include "MainSidebar.php" ; ?>
  </aside>
    <div class="content-wrapper">
    <section class="content">
      <section class="content-header">
        <h1 >
          Designations
        </h1>
      </section>
      <div class="col-md-12">
        <div class="form-group">
        <div class="box " id="new" >
            <div class="box-body">
              <form  id="submitformdata" method="post" >
                  <div class="row">

                    <input type="hidden" name="designation_id" id="designation_id" />

                        <div class="col-md-4">

                          <div class="form-group">
                              <label >Designation Name  </label>
                            <input type="text" name="designationname"   id="designationname" class="form-control"  placeholder="Enter Designation" autocomplete="off" required>
                          </div>
                        </div>

                        <div class="col-md-4">

                          <div class="form-group">
                              <label >Department </label>
                           <select class="form-control select2" name="department" id="department" data-placeholder="Select Department" style="width:100%;" required ></select>
                         </div>
                        </div>

                        <div class="col-md-1" id="adddesg">
                          <div class="form-group">
                            <div id="add" style="margin-top:25px;"></div>
                            <button class="btn btn-success form-control" type="submit" name="button">Add </button>
                          </div>
                        </div>

                        <div class="col-md-1" id="updatedesg" style="display:none">
                          <div class="form-group">
                            <div id="update" style="margin-top:25px;"></div>
                            <button class="btn btn-success form-control" type="submit" name="button">Save</button>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <div style="margin-top:25px;"></div>
                            <button class="btn btn-default form-control" id="btnCancel" type="button" name="button" >Cancel</button>
                          </div>
                        </div>

                    </div>
                </form>
              </div>
        </div>
      </div>
    </div>
<div class="col-md-12">
  <div class="jumbotron text-center" id="nodata" style="display:none;">
  <span class="text-center" style="color:green">
    <h2>No Designation Added Yet !!</h2>
  </span>
    </div>
    <div class="row" id="tbldata" style="display:none;">
      <div class="col-md-12">
        <div class="box" id="emp">
          <div class="box-body">
            <div class="table-responsive">
            <table id="datble" class="table table-bordered table-striped">
              <thead class="tableHeader">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Designation Name</th>
                  <th class="text-center">Department Name</th>
                  <th class="text-center">Action</th>
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
  <?php include 'MainFooter.php'; ?>

  <?php include "RightSidebar.php"; ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>

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
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/designations.js"></script>

</body>
</html>
<?php
}
else {
  header("Location:login.php");
}
?>
