
<?php
session_start();
include_once '../config/connection.php';
if(isset($_SESSION['a_id'])){
  $id=$_SESSION['a_id'];
  $uname=$_SESSION['uname'];

  $employeeid=$_REQUEST['empid'];
   $sql="SELECT joining_date FROM Employees t WHERE  EmpId=$employeeid AND UserId=$id";
   $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result);
  $Joinyear=date("Y",strtotime($row[0]));
  $Joinmonth=date("m",strtotime($row[0]));
  $Joindate=date("d",strtotime($row[0]));

  $sql1="SELECT E.EmpId,E.ProfilePic,E.contactNumber,E.EmailId,EmpName,DATE_FORMAT(E.joining_date,'%e %M %Y') as
  joining_date,DesigName,DeptName FROM Employees E LEFT JOIN EmployeeDesignations ED ON E.EmpId = ED.EmpId LEFT JOIN EmployeeDepartments ED1
   ON ED1.EmpId = E.EmpId LEFT JOIN Designations D ON D.DesigId = ED.DesigId LEFT JOIN Departments D1 ON D1.DeptId = ED1.DeptId WHERE E.UserId='$id' AND E.EmpId='$employeeid' ";
   $result1=mysqli_query($con,$sql1);
  $row=mysqli_fetch_array($result1);
  $Emp_name=$row['EmpName'];
  $Emp_contact=$row['contactNumber'];
  $Emp_emailid=$row['EmailId'];
  $Emp_pic=$row['ProfilePic'];
  $Emp_date=$row['joining_date'];
  $Emp_designation=$row['DesigName'];
  $Emp_department=$row['DeptName'];
  $img='<img src="../images/'.$row['ProfilePic'].'" alt=" " style="float:left;width:100px;height:150px;margin-right:10px;">';

  ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Payroll | Attendance</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<style media="screen">
.dot {
  border-radius: 50%;
   behavior: url(PIE.htc);
   /* remove if you don't care about IE8 */
   width: 26px;
   height: 26px;
   padding: 8px;
   background: #fff;
   border: 2px solid #666;
   color: #666;
   text-align: center;
   font: 12px Arial, sans-serif;
}
/* .vl {
  border-left: 1px solid gray;
    height: 170px;
  position: absolute;
  left: 35%;
  margin-left: -3px;
  top: 0;
}
.yl {
  border-left: 1px solid gray;
    height: 170px;
  position: absolute;
  left: 55%;
  margin-left: -3px;
  top: 0;
} */
</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'MainHeader.php';?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include 'MainSidebar.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Attendance
        <small></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data tables</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- <div class="row">
        <div class="col-xs-12"> -->

          <div class="box">
            <div class="box-header">
    <!-- <div id="header"> -->
    <div class="row">
      <div class="col-md-4">
      <?php echo $img?>
        <table>
            <tr><td ><b><?php echo strtoupper($Emp_name); ?></b></td></tr>
              <tr><td style="width:150px;"><b>Joining Date</b></td> <td style="width:300px;">:<?php echo $Emp_date ?></td></tr>
              <tr><td style="width:150px;"><b> Designation</b></td> <td>:<?php echo $Emp_designation ?></td></tr>
              <tr><td style="width:150px;"><b> Department</b></td><td> :<?php echo $Emp_department ?></td></tr>
              <tr><td style="width:150px;"><b> Contact No</b></td><td> :<?php echo $Emp_contact ?></td></tr>
              <tr><td style="width:150px;"><b> Email Id</b></td><td> :<?php echo $Emp_emailid ?></td></tr>
        </table>
  </div>

  <div class="col-md-2">
    <div class="vl" >
      <form class="forms-sample" id="attendance">
        <div class="form-group">
          <h4 ><b>  Login/Logout Time </b></h4>
          <select  name="status">
            <option value="in">Time In</option>
            <option value="out">Time Out</option>
          </select>
        </div>

        <div class="form-group">
          <input type="hidden" class="form-control" id="employee" name="employee" placeholder="Employee Id" value="<?php echo $employeeid ?>" readonly>
          <button type="submit" class="btn btn-success mr-2" ><i class="fa fa-sign-in"></i>Click</button>
        </div>
        <div class="alert alert-success alert-dismissible text-center" style="display:none;height:30px;width:300px" >
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <span class="result"><i class="icon fa fa-check"></i> <span class="message" ></span></span>
        </div>
        <div class="alert alert-danger alert-dismissible text-center" style="display:none;height:30px;width:300px" >
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
        </div>
  </form>
</div>
</div>

<div class="col-md-6">

      <div class="yl">
        <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-2"></div>

                <div class="col-sm-4">
            <div class="form-group">
        <!-- <div class="col-sm-1"><h4 >  year </h4></div> -->
        <!-- <div class="col-sm-5"> -->
        <label>Year</label>

        <select class="select2 form-control" name="year" id="year" onchange="fetch_month(this.value);">
          <option value="">Select Year</option>
          <?php
          $yearArray = range($Joinyear, 2050);
          foreach ($yearArray as $year) {
            // if you want to select a particular year
            $selected = ($year == date("Y")) ? 'selected' : '';
            echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
          }
          ?>
        </select>
        <!-- </div> -->
      </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
          <!-- <div class="col-sm-1"><h4 >  Month </h4></div> -->
          <!-- <div class="col-sm-5"> -->
            <label>Month</label>
        <select class="select2 form-control" name="month" id="months" onchange="fetchattendence()">
          <option value="">Select Month</option>
          <?php

          $monthArray = range(1, date("m"));

          foreach ($monthArray as $month) {
            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
            $fdate = date("F", strtotime("2015-$monthPadding-01"));
            $month_name =  ucfirst(strftime("%B", strtotime(date("Y-m-d"))));
            $selected = $month_name ? 'selected' : '';
            echo '<option '.$selected.'value="'.$monthPadding.'">'.$fdate.'</option>';
          }
          ?>
        </select>
        <!-- </div> -->
        </div>

        </div>
        <div class="col-sm-2"></div>

    </div>
  </div>
  </div>

  <section class="content-header">
                  <h1 class="text-center row">
                  <div class="col-sm-1"></div>
                    <div class="col-sm-5">
                <button class="btn btn-sm btn-success" type="button" onclick="salaryTotalAttendanceWise();" id="salaryDays" name="button">Calculate Salary</button>
              </div>  <div class="col-sm-4">
                    <small>Salary(Including Taxes)  : <b><span id="sal"></span></b></small>
                      </div>
                  </h1>
                  <br>
  </section>
</div>
</div>

<div class="box">
              <h3 class="box-title"></h3>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table id="datble" class="table table-bordered table-striped">
                <thead class="tableHeader">
                <tr>
                  <th class="text-center ">DATE</th>
                  <th class="text-center ">IN TIME</th>
                  <th class="text-centerDate ">OUT TIME</th>
                  <th class="text-center ">WORK HOURS</th>
                  <th class="text-center ">STATUS</th>
                </tr>
                </thead>
                <tbody id="loadtable">
                </tbody>
              </table>
            </div>
            </div>
          </div>
          <button type="button" class="btn btn-default" onclick="window.history.go(-1);">Back</button>

        </section>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
  <!-- Control Sidebar -->
  <?php include 'RightSidebar.php';?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- <script src="../js/displayattendance.js"></script> -->

<!-- page script -->
<script>
$('.select2').select2();
fetchattendence();
  // $(function () {
  //   $('#example1').DataTable()
  //   $('#example2').DataTable({
  //     'paging'      : true,
  //     'lengthChange': false,
  //     'searching'   : false,
  //     'ordering'    : true,
  //     'info'        : true,
  //     'autoWidth'   : false
  //   })
  // })
  var statusarr=[];
  var cnt=0;
  function fetchattendence(){
    cnt=0;
    statusarr=[];
    var table=$("#datble").DataTable();
    table.destroy();
    $("#loadtable").empty();
    var yr = document.getElementById('year').value;
    var month=document.getElementById('months').value;
  $.ajax({
    type:'POST',
    url:'../src/displayAttendance.php',
    data:{empattendanceid:<?php echo $employeeid ?>,yr:yr,month:month,jdate:<?php echo $Joindate; ?>,jmonth:<?php echo $Joinmonth; ?>,jyr:<?php echo $Joinyear; ?>},
    // dataType :'json',
    success:function(data){
      // alert(response);
      var response=JSON.parse(data);
      var count=Object.keys(response).length;
      // if(count>0){
      // alert(response[count-1]['weeknumber']);
      for(var i=0;i<count;i++){
        // alert(response[i]['status']);
        var status="PRESENT";
        color1='style="color:green"';

        if (!(response[i]['time_in'])) {
          response[i]['time_in']='----';
          response[i]['time_out']='----';
          response[i]['hour']='----';

        if (response[i]['status']=='LEAVE') {
          status=response[i]['status'];
          color1='style="color:blue"';
        }
        else if (response[i]['status']=='HOLIDAY'){
          status = response[i]['status'];
          color1='style="color:orange"';
        }
        else if (response[i]['status']=='WEEK-OFF'){
          status = response[i]['status'];
          color1='style="color:black"';
        }
          else {
            // status=response[i]['status'];
            status="ABSENT";
            color1='style="color:red"';
          }

        }
        statusarr.push(status);
      $("#loadtable").append('<tr><td  class="text-center"><span class="dot">'+response[i]['date1']+'</span><br><br>'+response[i]['day']+'</td><td class="text-center">'+response[i]['time_in']+
      '</td><td class="text-center"> '+ response[i]['time_out'] +'</td><td class="text-center"> '+ response[i]['hour'] +'&nbsp; Hours</td><td class="text-center"'+color1+'> '+status+'</td></tr>');
      }
      cnt=count;
      // salaryDays(statusarr,cnt);
    // $('#tbldata').show();
    var table = $("#datble").DataTable({                          
      lengthChange: false,
      // destroy:true,
      columnDefs: [ { orderable: false, targets: [0,1,2,3,4] } ],
      buttons: ['copy', 'excel', 'pdf','print']
    });
  // table.buttons().container()
  // .appendTo( '#datble_wrapper .col-md-6:eq(0)' );

  // }else {
  //   $('#tbldata').hide();
  //     $('#nodata').show();
  //
  // }
  }
  });
  }

  function fetch_month(param) {
    // alert(param);
    $("#months").html("");
    $.ajax({
        type: "POST",
        url: "../src/fetch_month.php",
        data:{yr:param,month:<?php echo $Joinmonth; ?>,Jyr:<?php echo $Joinyear; ?>},
        success: function(msg) {
          // alert(msg);
          $("#months").html('<option value="">Select Month</option>'+msg);
  }
  });
  }
function salaryTotalAttendanceWise() {
  var yr=$("#year").val();
  var month=$("#months").val();
if(!month){
alert("Please Select Month");
}
else{
$.ajax({
  url:'../src/getSalary.php',
  dataType:'json',
  data:{arr:statusarr,days:cnt,yr:yr,month:month,empattendanceid:<?php echo $employeeid ?>},
  success:function(response){
    $('#sal').html(response.sal);
  }
});
}
}
  $('#attendance').submit(function(e)
  {
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '../src/addAttendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          window.location.reload();

          //$('#employee').val('');
        }
      }
    });
  });
</script>
</body>
</html>
<?php
}
else {
  header("Location:login.php");
}
?>
