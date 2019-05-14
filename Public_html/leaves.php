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
  <title>HRM MANAGEMENT | LEAVE REQUEST</title>
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


  <!-- <link rel="stylesheet" href="../dist/css/edit_employee.css"> -->

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
          Leave Request
        </h1>
        <ol class="breadcrumb">
          <button class="btn btn-success" type="button" name="button" id="addleave" onclick="add_leave()">Add Leave</button>

        </ol>
        <br>
      </section>

        <div class="row" >
        <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="box " id="new" style="display:none">
          <!-- <div class="box-header with-border">
          </div> -->
            <div class="box-body">
              <form id="employeeleave"  method="post">
                <div class="row">
                      <div class="col-md-1"></div>
                      <input type="hidden" id="empid" name="empid"/>
                      <input type="hidden" id="leaveid" name="leaveid"/>


                        <div class="col-md-10">
                          <h3 class="box-title center">Create Leave Request</h3>
                      <hr>
                  <div class="col-md-4" id="empemail" style="display:none;" >
                    <div class="form-group">
                     <label><h5>Employee E-mail :&nbsp;<font color="red">*</font></h5></label>
                    <select  id="email" name="email"  class="form-control select2" style="width: 100%;"  required >
                    </select>
                  </div>
                   </div>

                <div class="col-md-4" >
                    <div id="email11" style="display:none;">
                      <div class="form-group">
                      <label><h5>Employee E-mail:&nbsp;<font color="red">*</font></h5></label>
                      <input type="text" id="email1" name="email1" class="form-control" readonly required >
                    </div>
                  </div>
               </div>

                  <div class="col-md-8">
                    <div class="form-group">
                      <label ><h5>Leave Type :&nbsp;<font color="red">*</font></h5></label>
                    <select class="form-control select2" id="leavetype" name="leavetype" style="width: 100%;" onchange="fetchBalance(this.value);"  required >
                    </select>
                    <span style="color:green;float:right" id="balance1"></span>

                  </div>
                </div>
                </div>
              </div>

                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10">

                  <div class="col-md-4">
                    <div class="form-group">
                    <label ><h5>From Date :&nbsp;<font color="red">*</font></h5></label>
                    <input type="date" min=<?php echo date("Y-m-d");?> id="from_date" name="from_date" class="form-control" placeholder="From Date" autocomplete="off" required >
                  </div>
                </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="pwd1"><h5>Upto Date :&nbsp;<font color="red">*</font></h5></label>
                    <input type="date" id="upto_date" min=<?php echo date("Y-m-d");?> name="upto_date" class="form-control" placeholder="Upto Date" autocomplete="off" onchange="find_days();" required >
                    <span style="float:right;color:red" id="leave_bal1"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                  <label for="email"><h5>Days :&nbsp;<font color="red">*</font></h5></label>
                  <input type="text" id="numberofdays" name="numberofdays" class="form-control" placeholder="Total Days" autocomplete="off" readonly required >
                </div>
              </div>

              </div>
            </div>

                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10">

                  <div class="col-md-12">
                    <div class="form-group">
                    <label for="email"><h5>Reason :&nbsp;<font color="red">*</font></h5></label>
                    <textarea type="text" id="Reason" name="Reason" rows="2" class="form-control" placeholder="Reason" autocomplete="off" required ></textarea>
                  </div>
                </div>
              </div>

              </div>

                <!--<div class="row">-->
                <!--  <div class="col-md-5"></div>-->
                <!--  <button id="leaveedit" type="submit" class="btn btn-success ">Submit</button>&nbsp;-->
                <!--  <button class="btn btn-default " type="reset" onclick="clear_all()">Cancel</button>-->

                <!--</div>-->
                
                 <br>
          <div class="row">
             
             <div class="col-sm-1"></div>
            
             <div class="col-sm-10">
                 <div class=" col-sm-6">
                     <button id="leaveedit" type="submit" class="btn btn-success ">Submit</button>&nbsp;
                  <button class="btn btn-default " type="reset" onclick="clear_all()">Cancel</button>

                </div>
            </div>
        </div>
              </form>
            </div>

            </div>

          </div>
        <!-- <div class="col-md-2"></div> -->
      </div>



          <div class="col-md-2"></div>

          <div class="col-md-8" style="display:none;" id="empleave">

            <div class="box" id="new" >
                <div class="box-body">
                  <form  id="submitformdata" method="post" >
                      <div class="row">
                        <!-- <div class="col-md-2"></div> -->
                        <!-- <input type="hidden" name="leave_id" id="leave_id" /> -->

                        <div class="col-md-12">

                              <div class="col-md-5">
                                <label for="leavetype1"   class="col-md-6 control-label "><h5>Add New Leave type</h5></label>
                                <input type="hidden" name="e_id" id="e_id" />
                                <div class="form-group">
                                  <select class="form-control select2" id="leavetype1" name="leavetype" placeholder="leavetype"  style="width:100%" required>
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-2">
                                <label for="signs" class="col-md-4 control-label "><h5>Signs</h5></label>
                              <select class="form-control select2" id="signs" name="signs" placeholder="signs" style="width:100%" required>
                                <option value="" ></option>
                                <option value="+" >+</option>
                                <option value="-">-</option>
                              </select>
                            </div>
                              <div class="col-md-5">
                                <label for="numdays" class="col-md-4 control-label "><h5>Number Of Days</h5></label>
                                <div class="form-group">
                                  <input type="number"  style="margin-top:10px;" name="numdays" id="numdays" class="form-control"  placeholder="Days" autocomplete="off" required>
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
                              <div id="addleave"  ></div>
                            <button class="btn btn-success" type="submit" name="button">Add </button>
                          </div>
                        </div>

                        <div class="col-md-1" id="cancel">
                          <div class="form-group">
                            <div id="cancelleave"  ></div>
                          <button class="btn btn-default" type="reset" name="button" onclick="clear_all1()">Cancel </button>
                        </div>
                      </div>

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
            <span class="text-center" style="color:green"><h2>No Leaves Request Added Yet !!</h2>
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
                    <th class="text-center">Employee</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Leave Type</th>
                    <th class="text-center">Particular Leave Dates</th>
                    <th class="text-center">Reason</th >
                    <th class="text-center">Days</th>
                    <th class="text-center">Status</th>
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
      <!-- /.row -->
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
<script src="../js/leaves.js"></script>

<!-- <script src="../js/validateempleaves.js"></script> -->
<!-- page script -->
<script>
// alert('its working');
  // $("#datble").DataTable();

  // $(document).ready(function(){
  //
  //
  // });



function fetchBalance(param){
  var employeeid = $("#email").val();
$.ajax({
  url:"../src/fetchLeaveBalance.php",
  method:"POST",
  data:{l_id:param,emp_id:employeeid},
  dataType:'json',
  success:function(response){
    // response=JSON.parse(data);
    $("#balance1").html("Your Balance Leaves are : "+response.NoOfDays);
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
