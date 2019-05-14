 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" id="list1" >

      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <br>

        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="Holidays.php">
            <i class="fa fa-calendar"></i> <span>Holidays</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="LeaveRequest.php">
            <i class="fa fa-calendar-minus-o"></i> <span>Leave Request</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="Attendance.php">
            <i class="fa fa-calendar-check-o"></i> <span>Attendance</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <li>
          <a href="EmployeeSalaryStructure.php">
            <i class="fa fa-file-pdf-o"></i> <span>Payslips</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
        <!-- <li>
          <a href="EmployeePayslips.php">
            <i class="fa fa-credit-card"></i> <span>Payslips1</span>
          </a>
        </li> -->


        <li>

    </section>
    <!-- /.sidebar -->
  </aside>
<script type="text/javascript">
$.ajax({
  url:'displayEmployeeProfile.php',
  type:'GET',
  dataType:'json',
  success:function(response){
    // alert(response);
    var EmpName = response[0].EmpName.split("-");

var header1 = '<div class="pull-left image"><img src="../../images/'+response[0].ProfilePic+'" class="img-circle" alt="User Image"></div>';
header1 += '<div class="pull-left info"><p><a href="index.php">'+EmpName[0]+" "+EmpName[1]+'</a></p><a href="index.php"><i class="fa fa-circle text-success"></i> Online</a></div>';
$('#list1').append(header1);
}
});


$('li').removeClass('active');

  var regex = /[A-Za-z _]+.php/g;
  var input = location.pathname;

  if(regex.test(input)) {
     var matches = input.match(regex);
     $('a[href="'+matches[0]+'"]').closest('li').addClass('treeview active');
     $('a[href="'+matches[0]+'"]').closest('ul').closest('li').addClass('active');
  }
</script>
