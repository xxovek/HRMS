<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['a_id']))
{
  $adminid =$_SESSION['a_id'];
  $uname=$_SESSION['uname'];
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | EMPLOYEES PAYSLIPS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="../datatables/CSS/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="../datatables/CSS/dataTables.bootstrap4.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- <link rel="stylesheet" href="../bower_components/select2/dist/css/editselect2.min.css"> -->
  <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
           Employee Payslips
        </h1>

        <br>
      </section>

<div class="row" style="display:none" id="previewRowDiv">

  <div class="col-md-12" >
    <div class="" id="data">

    </div>

<div class="col-md-5" >
<button type="button" class="btn btn-default" onclick="javascript:window.location.reload();">Back</button>
<!-- <button type="button" class="btn btn-default" id="gobackBtn">Back</button> -->
<!-- <button type="button" class="btn btn-success" id="btn_download" title="Download Payslip" style="display:none"  onClick="download_payslip();"><i class="fa fa-download"></i></button> -->
</div>
</div>
  <div class="col-md-1"></div>

</div>


      <div class="col-md-12">
        <div class="jumbotron text-center" id="nodata" style="display:none;">
          <span class="text-center" style="color:green"><h2>No Salary Slips Generated For Employees Yet !!</h2>
          </span>
          </div>
          <div class="row" id="tbldata" style="display:none;" >
            <div class="col-md-12">


              <div class="box"  id="emp">
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="SalaryTable" class="table table-bordered table-striped">
                      <thead class="tableHeader">
                      <tr>
                        <th class="text-center">Employee Name</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Contact</th>
                        <th class="text-center">From To </th>
                        <!-- <th class="text-center">Total Salary</th> -->
                        <!-- <th class="text-center"> Year</th> -->
                        <th class="text-center">Actions</th>
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

      <!-- <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
      </footer> -->
  <?php include "MainFooter.php"; ?>
      <?php include "RightSidebar.php"; ?>
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->

    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="../bower_components/moment/min/moment.min.js"></script>
    <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- DataTables -->
    <script src="../datatables/jquery.dataTables.min.js"></script>
    <script src="../datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../datatables/dataTables.buttons.min.js"></script>
    <script src="../datatables/buttons.bootstrap4.min.js"></script>
    <script src="../datatables/jszip.min.js"></script>
    <!--<script src="../datatables/pdfmake.min.js"></script>-->
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

    <script src="../js/PayslipMainPage.js"></script>

  </body>
  </html>

  <?php
  }
  else {
    header("Location:login.php");

  }
  ?>
