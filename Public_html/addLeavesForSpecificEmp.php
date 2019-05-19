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
  <title>HRM MANAGEMENT | Employee Additioal Leaves</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
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
  <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Google Font -->

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
          Employees Leaves
        </h1>

        <br>
      </section>
      <div class="row">

      <div class="col-md-12" style="display:none;" id="empleave">

        <div class="box" id="new" >
            <div class="box-body">
              <form  id="submitformdata" method="post" >
                  <div class="row">
                    <!-- <div class="col-sm-12"> -->
                    <input type="hidden" name="e_id" id="e_id" />

                          <div class="col-md-4">
                            <label  class="col-md-5 control-label"><h6>Leave Type:<font color="red">*</font></h6></label>
                            <div class="form-group">
                              <select class="form-control select2" id="leavetype1" name="leavetype" placeholder="leavetype"  style="width:100%" required>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <label  class="col-md-4 control-label"><h6>Signs:<font color="red">*</font></h6></label>
                          <select class="form-control select2" id="signs" name="signs" placeholder="signs" style="width:100%" required>
                            <option value=""></option>
                            <option value="+">+</option>
                            <option value="-">-</option>
                          </select>
                        </div>
                          <div class="col-md-2">
                            <label for="numdays" class="col-md-4 control-label"><h6>Days:<font color="red">*</font></h6></label>
                            <div class="form-group">
                              <input type="number"  style="margin-top:10px;" name="numdays" id="numdays" class="form-control"  placeholder="Enter Days" autocomplete="off" required>
                            </div>
                          </div>

                          <!-- <div class="col-sm-2">
                            <label  class="col-sm-4 control-label"><h5></h5></label>

                            <div class="" id="add">
                              <div class="form-group">
                                <div id="addleave"  ></div>
                              <button class="btn btn-success" type="submit" name="button">Add</button>
                            </div>
                          </div>
                          </div> -->

                          <!-- <div class="col-sm-4">
                            <label for="button" class="col-sm-4 control-label"><h5></h5></label>
                            <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Add" name="button".>
                            <input class="btn btn-default" type="button" id="btnCancel" value="Cancel" onclick="clear_all1()" name="button">
                          </div>
                        </div> -->
                        <div class="col-md-1">
                          <div class="form-group">
                            <div style="margin-top:40px;"></div>
                          <button class="btn btn-success" type="submit" name="button">Add</button>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <div style="margin-top:40px;"></div>
                        <button class="btn btn-default" type="button" id="btnCancel" onclick="clear_all1()" name="button">Cancel</button>
                      </div>
                    </div>
                          <!-- <div class="col-sm-2">
                            <label  class="col-sm-4 control-label"><h5></h5></label>

                            <div class="" id="cancel">
                              <div class="form-group">
                                <div id="cancelleave"></div>
                              <button class="btn btn-default" type="reset" name="button" onclick="clear_all1()">Cancel</button>
                            </div>
                            </div>
                          </div> -->
                          <!-- <div class="col-sm-2" >
                            <div class="form-group">
                          </div>
                        </div> -->

                        <!-- </div> -->


                              <!-- <br>
                          <div class="col-md-12">

                      <div class="col-sm-4" style="float:right" >
                        <div class="row" >
                      <div class="col-sm-2" id="add">
                        <div class="form-group">
                          <div id="addleave"  ></div>
                        <button class="btn btn-success" type="submit" name="button">Add</button>
                      </div>
                    </div>

                    <div class="col-sm-1" id="cancel">
                      <div class="form-group">
                        <div id="cancelleave"></div>
                      <button class="btn btn-default" type="reset" name="button" onclick="clear_all1()">Cancel</button>
                    </div>
                  </div>

                </div>
              </div>

                  </div> -->
          </div>
        </form>
        </div>

        <div class="row" >
          <div class="col-md-12">
            <div class="box" >

              <div class="box-body">
                <div class="table-responsive">
                <table id="leavesTypeTable" class="table table-bordered table-striped">
                  <thead class="tableHeader">
                    <tr>
                      <th class="text-center">#</th>
                      <th >Leave Type</th>
                      <th class="text-center">Official Leaves</th>
                      <th class="text-center">Additional Leaves</th>
                      <th class="text-center">Total Leaves</th>
                    </tr>
                  </thead>
                  <tbody id="leavesTypeTblBody"></tbody>
                </table>
              </div>
              </div>
            </div>
        </div>
        </div>
      </div>


</div>
    </div>

    <div class="col-md-12">
      <div class="jumbotron text-center" id="nodata" style="display:none;">
          <span class="text-center" style="color:green">
            <h2>No Employee Added Yet !!</h2>
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
                    <th >Employee</th>
                    <th class="text-center">Department</th>
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

      <!-- /.row -->
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
    <!-- Select2 -->
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
    <!-- bootstrap datepicker -->
    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>

    <!-- <script  src="../js/validate.js"></script> -->
    <script src="../js/addLeavesForSpecificEmp.js"></script>

    <!-- <script src="../js/validateempleaves.js"></script> -->
    <!-- page script -->
    <script>
    // alert('its working');
    // $("#datble").DataTable();

    // $(document).ready(function(){
    //
    //
    // });




    </script>
    </body>
    </html>
    <?php
    }
    else {
    header("Location:login.php");
    }
    ?>
