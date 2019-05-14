<?php
session_start();
include_once '../../config/connection.php';
if(isset($_SESSION['Emp_id'])){
  $id=$_SESSION['Emp_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | lEAVE REQUEST</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../../datatables/CSS/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../datatables/CSS/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'MainHeader.php';?>

    <!-- Left side column. contains the logo and sidebar -->
   <?php include 'MainSidebar.php';?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 >
        Leave Requests
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Leave Request</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-success pull-right" id="addLeaveRequest">Request Leave</button>
        </div>

      </div><br>
      <div class="col-md-12">

        <div class="jumbotron text-center" id="nodata" style="display:none;">
          <span class="text-center" style="color:green">
          <h2>No Request You Created Yet !!</h2>
          </span>
        </div>
        <div class="row"  id="fstsection">
          <div class="col-md-12" id="tbldata" >

                <div class="box" id="emp">
                  <div class="box-header">
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- <div class="table-responsive"> -->
                    <table id="datble" class="table table-bordered table-striped">
                      <thead class="tableHeader">
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">LEAVE TYPE</th>
                        <th class="text-center">DATE</th>
                        <th class="text-center">NUMBER OF DAYS</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center" style="display:none">ACTION</th>
                      </tr>
                      </thead>
                      <tbody id="loadtable">
                      </tbody>
                    </table>
                  <!-- </div> -->

                  </div>

                </div>
          </div>
        </div>

      </div>



        <div class="row" id="leaveformRowDiv" style="display:none">

          <div class="col-sm-2">

          </div>
            <div class="col-sm-8" style="margin-top: 45px;">

                <div class="box" id="emp">
                  <!-- <div class="box-header">

                  </div> -->
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form id="leave">
                      <div class="row">
                        <div class="col-md-1"></div>

                        <input type="hidden" id="leaveid" name="leaveid"/>
                        <div class="col-md-10">
                          <h3 class="box-title center">Create Leave Request</h3>
                      <hr>
                        <div class="col-sm-4">
                          <label><h5>Leave Type :&nbsp;<font color="red">*</font></h5></label>
                          <select class="form-control select2" id="leavetype" name="leavetype" placeholder="leavetype"  onchange="fetchBalance(this.value);" style="width:100%" required>
                          </select>
                          <span style="float:right;color:green;" id="balance"></span>
                        </div>
                      </div>
                    </div>


                      <div class="row">
                        <div class="col-md-1"></div>

                        <div class="col-md-10">
                        <div class="col-sm-4">
                          <label ><h5>From Date :&nbsp;<font color="red">*</font></h5></label>
                          <input type="date" min=<?php echo date("Y-m-d");?> id="from_date" name="from_date" class="form-control" onchange="upto(this.value);" placeholder="from date" required>
                        </div>
                        <div class="col-sm-4">
                            <label ><h5>Upto Date :&nbsp;<font color="red">*</font></h5></label>
                            <span id="uptdate"></span>
                            <span style="float:right;color:red;" id="leave_bal"></span>
                        </div>
                        <div class="col-sm-4">
                          <label ><h5>Days :&nbsp;<font color="red">*</font></h5></label>
                          <input type="text" id="numberofdays" name="numberofdays" class="form-control" placeholder="numberofdays" readonly required >
                        </div>
                      </div>

                      </div>
                      <div class="form-group"></div>
                      <div class="row">
                        <div class="col-md-1"></div>

                        <div class="col-md-10">
                        <div class="col-sm-12">
                          <label ><h5>Reason :&nbsp;<font color="red">*</font></h5></label>
                          <textarea type="text" id="Reason" name="Reason" rows="4" class="form-control" placeholder="Reason" required></textarea>
                        </div>
                      </div>

                    </div>

                        <div class="form-group"></div>
                      <!-- <div class="row">
                        <div class="col-sm-5"></div>
                        <button id="new1" type="submit" class="btn btn-primary submit-btn ">Submit</button>&nbsp;
                        <button class="btn btn-danger submit-btn " onclick="clear_all()">Cancel</button>

                      </div> -->
                    </div>
                    <div class="box-footer text-center">
                      <button type="submit" class="btn btn-success" id="sendLeaveRequest">Send</button>

                      <button type="button" class="btn btn-default" id="cancelLeaveRequest" onclick="clear_all()">Cancel</button>
                    </div>
                  </div>
                    </form>
                </div>

            </div>
          <div class="col-sm-1">

          </div>
        </div>


      <!-- </div> -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>


    <?php include 'RightSidebar.php';?>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- DataTable -->
<script src="../../datatables/jquery.dataTables.min.js"></script>
<script src="../../datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../datatables/dataTables.buttons.min.js"></script>
<script src="../../datatables/buttons.bootstrap4.min.js"></script>
<script src="../../datatables/jszip.min.js"></script>
<script src="../../datatables/pdfmake.min.js"></script>
<script src="../../datatables/vfs_fonts.js"></script>
<script src="../../datatables/buttons.html5.min.js"></script>
<script src="../../datatables/buttons.print.min.js"></script>
<script src="../../datatables/buttons.colVis.min.js"></script>
<script>
$(document).ready(function(){
  // $('#leaveformRowDiv').hide();
    showLeaves();

});
// $('.select2').select2()

$("#leavetype").select2({
    allowClear: true,
    placeholder:"Select Leave Type",

});
// $('#reservation').daterangepicker()
// $('#reservation').val('');
//
// $('#reservation').on('change',function(){
//   var d = $('#reservation').val();
//   alert(d);
// });

$('#addLeaveRequest').on('click',function(){
  $('#leaveformRowDiv').show();
  $('#fstsection').hide();
  $('#addLeaveRequest').hide();
// $('#leaveformRowDiv').show();
    $('#leave').trigger("reset");

});

fetchLeaveNames();
$("#uptdate").html('<input type="date" id="upto_date" min=<?php echo date("Y-m-d");?> name="upto_date" class="form-control" placeholder="upto_date" onchange="find_days();" required>');
function fetchLeaveNames() {
  $.ajax({
    url:"fetchLeaveNames.php",
    method:"POST",
    success:function(data){
      $("#leavetype").html(data);
    }
  });
}
function edit_leave(param)
{
  $('#fstsection').hide();
    $('#leaveformRowDiv').show();

  $('#leaveid').val(param);
  $.ajax({
  url:"fetchLeave.php",
  method:"POST",
  data:({leave_id:param}),
  success:function(data){
    // alert(data);
    response=JSON.parse(data);
    // $("#leave_type").val(response['leave_type']);
    $("#from_date").val(response['fromDate']);
    $("#upto_date").val(response['uptoDate']);
    $("#numberofdays").val(response['NoOfDays']);
    $("#Reason").val(response['reason']);
    $("#leave_type").append("<option  value='"+response['LeaveId']+"' selected=selected >"+response['LeaveType']+"</option>").trigger("change");
  }
  });
}
function remove_leave(param){
            $.ajax({
            url:"removeLeave.php",
            method:"POST",
            data:({leave_id:param}),
            success:function(data)
            {
              response=JSON.parse(data);
              if(response['true'])
              {
                $("#"+param).closest('tr').remove();
                window.location.reload();
            }
          }
            });

          }
function showLeaves(){
$.ajax({
  type:'POST',
  url:'displayLeavesofEmployee.php',
  dataType:'json',
  success:function(response){
    // alert(response);
    var count=Object.keys(response).length;
    if(count>0){
    for(var i=0;i<count;i++){
      // alert(response[i]['LeaveStatus']);
    $("#loadtable").append('<tr><td  class="text-center">'+(i + 1)+'</td><td class="text-center">'+response[i]['LeaveType']+
    '</td><td class="text-center"> '+ response[i]['fromDate']+'-'+response[i]['uptoDate']+'</td></td><td class="text-center"> '+
     response[i]['NoOfDays'] +'</td><td class="text-center"> '+ response[i]['LeaveStatus'] +
     '</td><td class="text-center" style="display:none"><div class="btn-group"><button type="button" name="edit" class="btn btn-success" onClick="edit_leave('+response[i]['EmpLeaveId']+
     ');"><i class="fa fa-edit"></i></button><button type="button" name="remove" class="btn btn-danger" onClick="remove_leave('+response[i]['EmpLeaveId']+
     ');"><i class="fa fa-trash-o"></i></button></div></td></tr>');
    }
  $('#tbldata').show();

  var table = $("#datble").DataTable({
    // lengthChange: false,
    // buttons: ['copy', 'excel', 'pdf','print']
    bPaginate: $('#datble tbody tr').length>10,
    order: [],
    columnDefs: [ { orderable: false, targets: [0,1,2] } ],
    dom: 'Bfrtip',
        buttons: [
          {
             extend: 'collection',
             text: 'Export',
             buttons: ['copy', 'excel', 'pdf','print']
          }
       ]
  });
  table.buttons().container()
  .appendTo( '#datble_wrapper .col-md-6:eq(0)' );
  // $('#myInputTextField').keyup(function(){
  //       table.search($(this).val()).draw() ;
  // })

}else {
  $('#tbldata').hide();
    $('#nodata').show();
}
}
});
}

function find_days() {
  var oneDay = 24*60*60*1000;
  var firstDate = new Date($("#from_date").val());
var secondDate = new Date($("#upto_date").val());
var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)))+1;
$("#numberofdays").val(diffDays);
var param =$("#leavetype").val();
$.ajax({
  url:"fetchLeaveBalance.php",
  method:"POST",
  data:{l_id:param},
  success:function(data){
    // alert(data);
    response=JSON.parse(data);
    if(diffDays>response['NoOfDays'])
    {
      $("#numberofdays").val("");
      $("#from_date").val("");
      $("#upto_date").val("");
    $("#leave_bal").html("Not sufficent balance leaves..try for another type ");
    setTimeout(function() { $("#leave_bal").hide(); }, 3000);
  }
}
});
}

function clear_all() {
  $('#leaveformRowDiv').hide();
  $('#fstsection').show();
  $('#leave').trigger("reset");
    $('#addLeaveRequest').show();
}

$('#leave').on('submit',function(e){
// $('#leave').on('submit', function(e){
  // alert($('#leaveid').val());
e.preventDefault();
$.ajax({
  url:"addLeaveRequest.php",
  method:"POST",
  data:$('#leave').serialize(),
  success:function(data){
    // alert(data);
    response=JSON.parse(data);
    if(response['true'])
    window.location.reload();
    else
    alert("Error");
  }
});
});

function fetchBalance(param){
// alert(param);
$.ajax({
  url:"fetchLeaveBalance.php",
  method:"POST",
  data:{l_id:param},
  success:function(data){
    // alert(data);
    response=JSON.parse(data);
    $("#balance").html("Your Balance Leaves are : "+response['NoOfDays']);
  }
});
}

function upto(param) {
  $("#uptdate").html('<input type="date" id="upto_date" min='+param+' name="upto_date" class="form-control" placeholder="upto_date" onchange="find_days();" required>');
}
</script>
</body>
</html>
<?php }
else {
  header('LOCATION:../EmpLogin.php');
} ?>
