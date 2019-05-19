<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['a_id'])){
  $adminid =$_SESSION['a_id'];
  $uname=$_SESSION['uname'];

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | ADMIN PROFILE SETTINGS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="../bower_components/select2/dist/css/editselect2.min.css">

  <script src="../bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style media="screen">
.pass_show{position: relative}

.pass_show .ptxt {

position: sticky;

top: 50%;

right: 1px;

z-index: 3;

color: #f36c01;

/* margin-top: -10px; */

cursor: pointer;

transition: .3s ease all;

}

.pass_show .ptxt:hover{color: #333333;}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'MainHeader.php';?>

  <?php include 'MainSidebar.php';?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Employee profile</li>
      </ol> --><br>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-5">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <span id="imagep"></span>

              <h3 class="profile-username text-center"><span id="empname"></span></h3>

              <p class="text-muted text-center">Admin-<span id="Admin_CompanyName"></span></p>
              <div class="box-body">
                <!-- <strong><i class="fa fa-user margin-r-5"></i>Personal Information</strong>
                <p class="text-muted" id="admindetails">
                </p>
                <hr> -->
                <!-- <strong><i class="fa fa-user margin-r-5"></i>Company Information</strong>
                <p class="text-muted" id="AdminCompanyName">
                </p>
                <hr> -->
                <!-- <strong><i class="fa fa-user margin-r-5"></i>Personal Information</strong>
                <p class="text-muted" id="admindetails">
                </p>
                <hr>
                <strong><i class="fa fa-user margin-r-5"></i>Company Information</strong>
                <p class="text-muted" id="admindetails">
                </p>
                <hr> -->
                <!-- <strong><i class="fa fa-map-marker margin-r-5"></i>Location</strong>
                <p class="text-muted" id="address"></p>
                <hr>
                <strong><i class="fa fa-star margin-r-5"></i>Skills</strong>

                <p id="skills1"></p> -->
              </div>
            </div>
          </div>

        </div>



          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer> -->
  <?php include "MainFooter.php"; ?>
  <!-- Control Sidebar -->
  <?php include "RightSidebar.php"; ?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>

<script src="../plugins/iCheck/icheck.min.js"></script>
<script  src="../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- <script  src="../js/rulsetCompanyInfoForm.js"></script> -->
<script  src="../js/AdminProfileSetting.js"></script>

</body>
</html>
<?php }
else {
  header("Location:login.php");
} ?>
