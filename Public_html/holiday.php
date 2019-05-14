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
  <title>Payroll | Holidays</title>
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
</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <?php include "MainHeader.php"; ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php include "MainSidebar.php" ;?>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <section class="content-header">
        <h1 >
          Holiday's
        </h1>
        <!-- <ol class="breadcrumb">
          <button class="btn btn-block btn-success" type="button" name="button" id="holiday" onclick="add_holiday()" style="display:none;">New Holiday</button>
        </ol> -->
        <br>
      </section>

        <div class="col-md-12">
          <div class="box" id="new">
              <form  id="submitformdata" method="post" >
                <div class="row">
                  <div class="col-md-2"></div>
                    <input type="hidden" name="holiday_id" id="holiday_id" />
            <div class="col-md-10">
              <div class="col-md-3">
                      <div class="form-group">
                          <label >Holiday Date</label>
                            <input type="date" min=<?php echo date("Y-m-d");?> name="date1" style="padding-top:0px"  id="date1" class="form-control" required placeholder="Select Date" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label >Holiday Name</label>
                          <div class="form-group">
                              <input type="text" name="hname"  id="hname" class="form-control" placeholder="Name of holiday" autocomplete="off" required>
                        </div>
                      </div>

                      <div class="col-md-1" id="addBtnDiv">
                        <div class="form-group">
                          <div  style="margin-top:25px;"></div>
                          <button class="btn btn-success" type="submit" name="button">Add</button>
                        </div>
                      </div>

                      <div class="col-md-1" id="update" style="display:none">
                        <div class="form-group">
                          <div style="margin-top:25px;"></div>
                          <button class="btn btn-success" type="submit" name="button">Save</button>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <div style="margin-top:25px;"></div>
                          <button class="btn btn-default" id="btnCancel" type="reset" name="button" >Cancel</button>
                        </div>
                      </div>

                    <!-- <div class="col-md-4">
                      <div class="row">
                      <div class="col-md-2" id="add">
                            <div class="form-group" >
                          <div id="addholiday" style="margin-top:40px;"></div>
                        <button class="btn btn-success" type="submit" name="button">Add </button>
                      </div>
                    </div>

                      <div class="col-md-2" id="update" style="display:none;">
                        <div class="form-group" >
                          <div id="updateholiday"  style="margin-top:40px;"></div>
                          <button class="btn btn-success" type="submit" name="button">Save</button>
                        </div>
                    </div>
                    <div class="col-md-2" id="cancel">
                          <div class="form-group" >
                        <div id="cancelholiday" style="margin-top:40px;"></div>
                      <button class="btn btn-default" type="reset" name="button" >Cancel</button>
                    </div>
                  </div>
                  <div class="col-md-2" id="cancel1" id="cancel1" style="display:none;">
                        <div class="form-group" >
                      <div id="cancelholiday1" style="margin-top:40px;"></div>
                    <button class="btn btn-default" type="button" name="button" onclick="window.location.reload();" >Cancel</button>
                  </div>
                </div>
                  </div>
                </div> -->
            </div>
        </div>
      </form>
      </div>
    </div>

  <div class="col-md-12">

    <div class="jumbotron text-center" id="nodata" style="display:none;">
      <span class="text-center" style="color:green">
      <h2>There are No Holidays Added Yet !!</h2>
      </span>
    </div>
      <div class="row" id="tbldata" style="display:none;">
        <div class="col-md-12">
          <div class="box" id="emp">
            <!-- <div class="box-header">
            </div> -->
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="datble" class="table table-bordered table-striped">
                <thead class="tableHeader" >
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Holiday Name</th>
                  <th class="text-center">Date  </th>
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
<script src="../js/holiday.js"></script>


</body>
</html>

<?php
}
else {
  header("Location:login.php");
}
?>
