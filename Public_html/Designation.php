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
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
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
<!-- Select2 -->
<link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
 
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
          Designations
        </h1>
        <!-- <ol class="breadcrumb">
          <button class="btn btn-block btn-success" type="button" name="button" id="desg" onclick="new_desg()" style="display:none;">New Designation</button>
        </ol>--><br>
      </section>


      <div class="col-md-12">

        <div class="box " id="new" >
              <form  id="submitformdata" method="post" >
                  <div class="row">
                    <div class="col-md-2"></div>
                    <input type="hidden" name="designation_id" id="designation_id" />
                    <div class="col-md-10">
                        <div class="col-md-4">
                          <label >Designation Name  </label>
                          <div class="form-group">
                            <input type="text" name="designationname"   id="designationname" class="form-control"  placeholder="Enter Designation" autocomplete="off" required>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <label >Department </label>
                          <div class="form-group">
            <select class="form-control select2" name="department" id="department" data-placeholder="Select Department" style="width:100%;" required ></select>
                            <!-- <input type="text" name="designationname" style="margin-top:10px;"  id="designationname" class="form-control"  placeholder="Enter Designation" autocomplete="off" required> -->
                          </div>
                        </div>
                  
                        <div class="col-md-1" id="adddesg">
                          <div class="form-group">
                            <div id="add" style="margin-top:25px;"></div>
                            <button class="btn btn-success" type="submit" name="button">Add </button>
                          </div>
                        </div>

                        <div class="col-md-1" id="updatedesg" style="display:none">
                          <div class="form-group">
                            <div id="update" style="margin-top:25px;"></div>
                            <button class="btn btn-success" type="submit" name="button">Save</button>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group">
                            <div style="margin-top:25px;"></div>
                            <button class="btn btn-default" id="btnCancel" type="button" name="button" >Cancel</button>
                          </div>
                        </div>

                       
                        <!-- <div id="adddesg" style="margin-top:25px;" >
                        <button class="btn btn-success" type="submit" name="button">Add </button>
                        </div>

                        <div id="updatedesg" style="display:none;margin-top:25px;">
                        <button class="btn btn-success" type="submit" name="button">Save</button>
                        </div>

                        <div style="margin-top:25px;" >
                        <button class="btn btn-default" id="btnCancel" type="button" name="button" >Cancel</button>
                        </div> -->


                      </div>
                    </div>
                </form>
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
