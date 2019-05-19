<?php
session_start();
include '../config/connection.php';

if(isset($_SESSION['a_id'])){
  $adminid =$_SESSION['a_id'];
  $uname=$_SESSION['uname'];
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | ADMIN DASHBOARD</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
  .animated{-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both}.animated.infinite{-webkit-animation-iteration-count:infinite;animation-iteration-count:infinite}.animated.hinge{-webkit-animation-duration:2s;animation-duration:2s
  }@-webkit-keyframes zoomIn{0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}50%{opacity:1}}@keyframes zoomIn{0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}50%{opacity:1}}.zoomIn{-webkit-animation-name:zoomIn;animation-name:zoomIn}
  @-webkit-keyframes zoomOut{0%{opacity:1}50%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}100%{opacity:0}}@keyframes zoomOut{0%{opacity:1}50%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}100%{opacity:0}}.zoomOut{-webkit-animation-name:zoomOut;animation-name:zoomOut}

  #accordion .panel-title i.glyphicon{
      -moz-transition: -moz-transform 0.5s ease-in-out;
      -o-transition: -o-transform 0.5s ease-in-out;
      -webkit-transition: -webkit-transform 0.5s ease-in-out;
      transition: transform 0.5s ease-in-out;
  }

  .rotate-icon{
      -webkit-transform: rotate(-225deg);
      -moz-transform: rotate(-225deg);
      transform: rotate(-225deg);
  }

  /* .panel{
      border: 0px;
      border-bottom: 1px solid #30bb64;
  } */
  .panel-group .panel+.panel{
      margin-top: 0px;
  }
  .panel-group .panel{
      border-radius: 0px;
  }
  .panel-heading{
      border-radius: 0px;
      color: white;
      padding: 25px 15px;
  }
  .panel-custom>.panel-heading{
      background-color: #221d59;
  }
  /* .panel-group .panel:last-child{
      border-bottom: 5px solid #2ba659;
  } */

  panel-collapse .collapse.in{
      border-bottom:0;
  }
  </style>
  <script type="text/javascript">
  $(function() {


    function toggleChevron(e) {
        // alert(e.target.find("i"));
        $(e.target)
                .prev('.panel-heading')
                .find("i")
                .toggleClass('rotate-icon');
        $('.panel-body.animated').toggleClass('zoomIn zoomOut');
    }

     $('#accordion').on('hide.bs.collapse', toggleChevron);
     $('#accordion').on('show.bs.collapse', toggleChevron);
})


  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'MainHeader.php';?>

  <!-- Left side column. contains the logo and sidebar -->
 <?php include 'MainSidebar.php';?>
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Dashboard
       <!-- <small>Control panel</small> -->
     </h1>
     <!-- <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">Dashboard</li>
     </ol> -->
   </section>
  <!-- Content Wrapper. Contains page content -->
      <div class="row" style="padding:5px;">
          <div class="col-md-12" >
          <div class="form-group">

          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-custom">
                  <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <i class="glyphicon glyphicon-plus"></i>
                               Employee Personal Detail / Employee Contact Detail
                          </a>
                      </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body animated zoomOut">
                       <div class="row">
                       <div class="col-sm-4">
                        <div class="form-group">
                        <label>First Name</label><font color="red">*</font>
                        <input type="text" class="form-control" name="firstname" id="firstname" required/>
                       </div>
                       </div>
                       <div class="col-sm-4">
                        <div class="form-group">
                        <label>Last Name</label><font color="red">*</font>
                        <input type="text" class="form-control" name="lastname" id="lastname" required/>
                       </div>
                       </div>
                       <div class="col-sm-4">
                        <div class="form-group">
                          <label>Gender</label><font color="red">*</font>
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                          </select>
                       </div>
                       </div>
                      </div>
                      <div class="row">
                      <div class="col-sm-4">
                       <div class="form-group">
                       <label>Contact Number</label><font color="red">*</font>
                       <input type="text" class="form-control" name="contactnumber" id="contactnumber" required/>
                      </div>
                      </div>
                      <div class="col-sm-4">
                       <div class="form-group">
                       <label>Email</label><font color="red">*</font>
                       <input type="text" class="form-control" name="empemail" id="empemail" required/>
                      </div>
                      </div>
                      <div class="col-sm-4">
                       <div class="form-group">
                         <label>Date of Birth</label><font color="red">*</font>
                         <div class="input-group date">
                           <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control pull-right" id="datepicker" style="line-height:20px;">
                         </div>
                      </div>
                      </div>
                     </div>
                     <div class="row">
                     <div class="col-sm-4">
                      <div class="form-group">
                      <label>Address</label><font color="red">*</font>
                      <input type="text" class="form-control" name="address" id="address" required/>
                     </div>
                     </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                      <label>Pincode</label><font color="red">*</font>
                      <input type="text" class="form-control" name="pincode" id="pincode" required/>
                     </div>
                     </div>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label>Pan Number</label><font color="red">*</font>
                        <input type="text" class="form-control" name="pannumber" id="pannumber" required/>
                     </div>
                     </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-4">
                     <div class="form-group">
                     <label>Country</label><font color="red">*</font>
                     <select class="form-control select2" style="width: 100%;" id="countrynew">
                     </select>
                    </div>
                    </div>
                    <div class="col-sm-4">
                     <div class="form-group">
                     <label>State</label><font color="red">*</font>
                     <select class="form-control select2" style="width: 100%;" id="statenew">
                     </select>
                    </div>
                    </div>
                    <div class="col-sm-4">
                     <div class="form-group">
                       <label>City</label><font color="red">*</font>
                       <select class="form-control select2" style="width: 100%;" id="citynew">
                       </select>
                    </div>
                    </div>
                   </div>
                   <div class="row">
                   <div class="col-sm-2">
                    <div class="form-group">
                    <button class="btn btn-success form-control" >Save</button>
                   </div>
                   </div>

                  </div>
                  </div>
              </div>
              <div class="panel panel-custom">
                  <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <i class="glyphicon glyphicon-plus"></i>
                              Coporate Detail
                          </a>
                      </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body animated zoomOut">
                        <div class="row">
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Joining Date</label><font color="red">*</font>
                         <input type="date" class="form-control" name="joiningdate" id="joiningdate"  style="line-height:20px;" required/>
                        </div>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Department</label><font color="red">*</font>
                         <select class="form-control select2" style="width: 100%;" id="departmentname">
                         </select>
                        </div>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                           <label>Designation</label><font color="red">*</font>
                           <select class="form-control select2" style="width: 100%;" id="designationname">
                           </select>
                        </div>
                        </div>
                       </div>
                       <div class="row">
                       <div class="col-sm-2">
                        <div class="form-group">
                        <button class="btn btn-success form-control" >Save</button>
                       </div>
                       </div>

                      </div>
                      </div>
                  </div>
              </div>
              <div class="panel panel-custom">
                  <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title">
                      <i class="glyphicon glyphicon-plus"></i>
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Employee Bank Details / Bank Account Information
                          </a>
                      </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body animated zoomOut">
                        <div class="row">
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Account Holder Name</label><font color="red">*</font>
                         <input type="text" class="form-control" name="contactnumber" id="contactnumber" required/>
                        </div>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Account Number</label><font color="red">*</font>
                         <input type="text" class="form-control" name="empemail" id="empemail" required/>
                        </div>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                           <label>Bank Name</label><font color="red">*</font>
                            <input type="text" class="form-control" name="empemail" id="empemail" required/>
                        </div>
                        </div>
                       </div>
                       <div class="row">
                       <div class="col-sm-4">
                        <div class="form-group">
                        <label>Branch Name</label><font color="red">*</font>
                        <input type="text" class="form-control" name="address" id="address" required/>
                       </div>
                       </div>
                       <div class="col-sm-4">
                        <div class="form-group">
                        <label>IFSC Code</label><font color="red">*</font>
                        <input type="text" class="form-control" name="pincode" id="pincode" required/>
                       </div>
                       </div>
                       <div class="col-sm-2">
                        <div class="form-group">
                          <label>&nbsp;</label>
                            <button class="btn btn-success form-control" >Save</button>
                       </div>
                       </div>
                      </div>
                      </div>
                  </div>
              </div>
              <div class="panel panel-custom">
                  <div class="panel-heading" role="tab" id="headingFour">
                      <h4 class="panel-title">
                      <i class="glyphicon glyphicon-plus"></i>
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              PF & UAE ACCOUNT DETAILS
                          </a>
                      </h4>
                  </div>
                  <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                      <div class="panel-body animated zoomOut">
                        <div class="row">
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Employee PF Number(Provident Fund Number)</label><font color="red">*</font>
                         <input type="text" class="form-control" name="address" id="address" required/>
                        </div>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Employee UAE Number(Universal Account Number)</label><font color="red">*</font>
                         <input type="text" class="form-control" name="pincode" id="pincode" required/>
                        </div>
                        </div>
                        <div class="col-sm-2">
                         <div class="form-group">
                           <label>&nbsp;</label>
                             <button class="btn btn-success form-control" >Save</button>
                        </div>
                        </div>
                       </div>
                       </div>
                  </div>
              </div>
              <div class="panel panel-custom">
                  <div class="panel-heading" role="tab" id="headingFive">
                      <h4 class="panel-title">
                      <i class="glyphicon glyphicon-plus"></i>
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              Employee Educational Detail
                          </a>
                      </h4>
                  </div>
                  <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                      <div class="panel-body animated zoomOut">
                        <div class="row">
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Degree</label><font color="red">*</font>
                         <input type="text" class="form-control" name="contactnumber" id="contactnumber" required/>
                        </div>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Specialization:</label>
                         <!-- <font color="red">*</font> -->
                         <input type="text" class="form-control" name="empemail" id="empemail" required/>
                        </div>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                           <label>Passing Out Year:</label><font color="red">*</font>
                            <input type="text" class="form-control" name="empemail" id="empemail" required/>
                        </div>
                        </div>
                       </div>
                       <div class="row">
                       <div class="col-sm-4">
                        <div class="form-group">
                        <label>University Name:</label><font color="red">*</font>
                        <input type="text" class="form-control" name="address" id="address" required/>
                       </div>
                       </div>
                       <div class="col-sm-4">
                        <div class="form-group">
                        <label>CGPA/Marks:</label><font color="red">*</font>
                        <input type="text" class="form-control" name="pincode" id="pincode" required/>
                       </div>
                       </div>
                       <div class="col-sm-2">
                        <div class="form-group">
                          <label>&nbsp;</label>
                            <button class="btn btn-success form-control" >Save</button>
                       </div>
                       </div>
                      </div>
                      </div>
                  </div>
              </div>
              <div class="panel panel-custom">
                  <div class="panel-heading" role="tab" id="headingSix">
                      <h4 class="panel-title">
                      <i class="glyphicon glyphicon-plus"></i>
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                             Experience Details
                          </a>
                      </h4>
                  </div>
                  <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                      <div class="panel-body animated zoomOut">
                        <div class="row">
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Company Name</label><font color="red">*</font>
                         <input type="text" class="form-control" name="address" id="address" required/>
                        </div>
                        </div>
                        <div class="col-sm-3">
                         <div class="form-group">
                         <label>No of Years</label><font color="red">*</font>
                         <input type="text" class="form-control" name="pincode" id="pincode" required/>
                        </div>
                        </div>
                        <div class="col-sm-3">
                         <div class="form-group">
                         <label>No of Month</label><font color="red">*</font>
                         <select class="form-control select2" name="Noofmonth" id="Noofmonth" style="width:100%" placeholder="No Of Month"  autocomplete="of" required/>
                         <option value=""> </option>
                         <option> 0 </option>
                         <option> 1 </option>
                         <option> 2 </option>
                         <option> 3 </option>
                         <option> 4 </option>
                         <option> 5 </option>
                         <option> 6 </option>
                         <option> 7 </option>
                         <option> 8 </option>
                         <option> 9 </option>
                         <option> 10 </option>
                         <option> 11 </option>

                       </select>
                        </div>
                        </div>
                        <div class="col-sm-2">
                         <div class="form-group">
                           <label>&nbsp;</label>
                             <button class="btn btn-success form-control" >Save</button>
                        </div>
                        </div>
                       </div>
                       </div>
                  </div>
              </div>
              <div class="panel panel-custom">
                  <div class="panel-heading" role="tab" id="headingSeven">
                      <h4 class="panel-title">
                      <i class="glyphicon glyphicon-plus"></i>
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Skill Sets
                          </a>
                      </h4>
                  </div>
                  <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                      <div class="panel-body animated zoomOut">
                        <div class="row">
                        <div class="col-sm-4">
                         <div class="form-group">
                         <label>Skill:</label><font color="red">*</font>
                         <input type="text" class="form-control" name="address" id="address" required/>
                        </div>
                        </div>

                        <div class="col-sm-2">
                         <div class="form-group">
                           <label>&nbsp;</label>
                             <button class="btn btn-success form-control" >Save</button>
                        </div>
                        </div>
                       </div>
                       </div>
                  </div>
              </div>
          </div>
      </div>
      </div>

  </div>
  <!-- /.content-wrapper -->



<?php require_once 'RightSidebar.php'; ?>

  <div class="control-sidebar-bg"></div>

</div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../dist/js/demo.js"></script> -->
<script  src="../js/employeepersonaldetail.js"></script>
<script  src="../js/employeecoporatedetail.js"></script>
<script>
$('.select2').select2()

</script>
</body>
</html>

<?php
}
else {
  header("Location:login.php");
}
?>
