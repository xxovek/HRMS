<?php
include '../config/connection.php';
// include '../'
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
  <title>HRM MANAGEMENT | SALARY STRUCTURES</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
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
           Employee Salary Components
        </h1>
        <ol class="breadcrumb">
          <button class="btn btn-block btn-success" type="button"  id="addSalaryCompo" onclick="addSalCompo();">Add Salary Components</button>
        </ol>
        <br>
      </section>

<div class="row" style="display:none" id="previewRowDiv">

  <div class="col-md-1"></div>
  <div class="col-md-10" >
    <div class="box">
        <div class="box-body">
          <div class="" id="data"></div>
  </div>
</div>
<div class="col-md-5" >
<button type="button" class="btn btn-default" onclick="window.location.reload()">Back</button>
</div>
</div>
  <div class="col-md-1"></div>

</div>

      <div class="row" id="formrowDiv">
      <div class="col-md-2"></div>

      <div class="col-md-8" >
        <div class="box" id="newFormDiv" style="display:none" >
            <div class="box-body">
              <form  id="submitformdata" method="post">
                <div class="row">
                  <div class="col-md-1"></div>
                  <input type="hidden" name="SalaryHead_id" id="SalaryHead_id"/>
                  <div class="col-md-10">
                      <h3 class="box-title center">Employee Salary Details</h3>
                  <hr>
                  <div class="col-md-4" id="EmpOptIdDiv">
                    <div class="form-group">
                      <label><h5>Employee :<font color="red">*</font></h5></label>
                      <span id="EmpId_error" ></span>
                      <select class="form-control select2" id="EmpOptId" data-placeholder="Select Employee"
                              style="width: 100%;">
                      </select>
                    </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label><h5>Start To End Date :<font color="red">*</font></h5></label>
                    <span id="startDate_err" ></span>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" autocomplete="off" class="form-control pull-right" id="startdatepicker">
                    </div>
                  </div>
                </div>
                </div>
                </div>

                  <div class="row" id="EmpInfoDiv" style="display:none">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label><h5>Employee Id:&nbsp;</label></h5>
                          <input type="text"  id="EmpidTxt" value="" class="form-control" readonly/>
                          <label><h5>Employee Name:&nbsp;
                          </label></h5>
                          <input type="text"  id="Ename" value="" class="form-control" readonly/>
                          <label><h5>Employee Gender:&nbsp;
                          </label></h5>
                          <input type="text"  id="gen" value="" class="form-control" readonly/>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label><h5>Department:&nbsp;  </label></h5>
                            <input type="text"  id="dept" value="" class="form-control" readonly/>
                          <label><h5>Designation:&nbsp;
                            </label></h5>
                            <input type="text"  id="Edesi" value="" class="form-control" readonly/>
                          <label><h5>Employee Email:&nbsp;  </label></h5>
                            <input type="text"  id="Email" value="" class="form-control" readonly/>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label><h5>Birth Date:&nbsp;
                              </label></h5>
                            <input type="text"  id="Ebdate" value="" class="form-control" readonly/>
                          <label><h5>Joined Date:&nbsp;</label></h5>
                            <input type="text"  id="EJoinDate" value="" class="form-control" readonly/>
                            <label><h5>Contact:&nbsp;  </label></h5>
                              <input type="text"  id="mob" value="" class="form-control" readonly/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                      <!-- <div class="box">
                      <div class="box-header"> -->
                        <h3 class="box-title center"> Add Salary Components</h3>
                        <hr>
                      <!-- </div>
                    </div> -->


                    <div class="col-md-4" id="CTCDiv">
                    <div class="form-group">
                      <label>Enter Annual Salary (CTC) &nbsp;:<font color="red">*</font></label>
                      <span id="CTC_error_msg" ></span><br>
                      <input type="text" autocomplete="off" placeholder="Enter Annual Salary Amount" class="form-control pull-right" id="CTC_input">
                    </div>
                </div>

                        <div class="col-md-4">
                          <div class="form-group">
                           <label for="options">Components &nbsp;:<font color="red">*</font></label>
                           <span id="CompoSel_err" ></span><br>
                           <select class="form-control select2" id="options"  data-placeholder="Select Component" style="width: 100%;" required>
                          </select>
                        </div>
                    </div>





                  </div>
              </div>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">

    <div class="col-md-4" id="cmDiv">
      <div class="form-group">
      <label for="cm" >Component</label><br>
      <input type="text" class="form-control" name="" id="cm"  readonly/>
      </div>
    </div>

    <div class="col-md-2" id="cmDiv">
      <div class="form-group">
      <label for="cm" >% On CTC &nbsp;</label>
      <span id="FillPerc_err" ></span><br>
      <input type="text" class="form-control" name="Percent" id="Percent"  onblur="document.getElementById('amt').value = this.value / 100 * document.getElementById('CTC_input').value"  onkeypress="return isNumberKey(event);"  title="Percentage on CTC" minlength="2" maxlength="3" required />
      </div>
    </div>

    <div class="col-md-4" id="cmDiv">
      <div class="form-group">
      <label for="cm" >Amount &nbsp;</label>
      <span id="FillAmt_err" ></span><br>
      <input type="text" class="form-control" name="amt" id="amt" readonly  title="Amount = (%/100)  * CTC" />
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label for="cm" >Add &nbsp;</label><br>
      <button type="button"  id="add-row" onclick="addrow2();" class="btn btn-success"><i class="fa fa-plus"></i></button>
    </div>
    </div>
  </div>
</div>


<div class="row" >
    <div class="col-sm-1"></div>

      <div class="col-sm-10">
  <div class="table-responsive table-editable"  id="sampleTbl2">
      <table class="table table-bordered" id="Tab_logic">
        <!-- <thead>
          <tr><th class="text-center">Components</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Action</th>
          </tr>
        </thead> -->
              <div class="scrollcell">
                  <tbody id="fetchcellvalue2">
                  </tbody>
              </div>
      </table>
    </div>
    </div>


      <div class="col-sm-1"></div>

</div>

<!-- <div class="row">
<div class="col-sm-1"></div>

<div class="col-sm-10">
<div class="col-md-4">
<div class="form-group">
      <label for="cm" >TDS &nbsp;</label>
  <input type="text" id="tdsInput" class="form-control" readonly >
</div>
</div>

</div>

</div> -->


<div class="row">
  <div class="col-md-1"></div>
<div class="col-md-10">
    <div class="col-md-5"></div>

  <div class="col-md-4">
    <button type="submit" class="btn btn-success" id='updateList' onclick="updateTblList1(event);" style="display:none" title="Update Table Data">Update</button>

    <button type="button" class="btn btn-success" id='addList' onclick="addTblList1(event);" title="Submit Table Data">Submit</button>
    <button type="button" class="btn btn-default" onclick="window.location.reload();">Cancel</button>
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
          <span class="text-center" style="color:green"><h2>No Salary Component Added For Any Employee!!</h2>
          </span>
          </div>

          <div class="row" id="tbldata" style="display:none;" >
            <div class="col-md-12">
              <div class="box"  id="emp">
                <!-- <div class="box-header"></div> -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="SalaryTable" class="table table-bordered table-striped">
                      <thead class="tableHeader">
                      <tr>
                        <!-- <th class="text-center">Sr.No.</th> -->
                        <th class="text-center">Employee Name</th>
                        <!-- <th class="text-center">Designation</th> -->
                        <th class="text-center">Department</th>
                        <th class="text-center">Contact</th>
                        <th class="text-center">From To </th>
                        <!-- <th class="text-center">Total Salary</th> -->
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

    <script src="../js/empsalarymenu.js"></script>
    <!-- <script src="../js/temp.js"></script> -->
    <script src="../js/previewSalaryStruct.js"></script>


  </body>
  </html>

  <?php
  }
  else {
    header("Location:login_salesman.php");
  }
  ?>
