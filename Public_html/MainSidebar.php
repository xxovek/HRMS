<?php

 ?>

 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" id="userPanel">

      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <br>
        <li class="header">MAIN NAVIGATION</li>

    <li class="treeview">
         <a href="#">
           <i class="fa fa-gear"></i>
           <span>Settings</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="settings.php"><i class="fa fa-gear"></i>Configurations</a></li>
           <li><a href="department.php"><i class="fa fa-building-o"></i>Department</a></li>
           <li><a href="Designation.php"><i class="fa fa-at"></i>Designation</a></li>
           <li><a href="holiday.php"><i class="fa fa-calendar"></i>Holiday Settings</a></li>
           <li><a href="assignleaves.php"><i class="fa fa-calendar-o"></i>Leave Types</a></li>
           <!-- <li><a href="SalaryStructByDesignations.php"><i class="fa fa-file"></i>Salary Structure</a></li> -->

         </ul>
        </li>


        <!-- <li>
          <a href="settings.php">
            <i class="fa fa-gear"></i>
              <span>Settings</span>
          </a>
        </li> -->

        <li class="active">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
       
        <!-- <li>
          <a href="department.php">
            <i class="fa fa-building-o" aria-hidden="true"></i>
            <span>Department</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li> -->
        <!-- <li>
          <a href="Designation.php">
            <i class="fa fa-at"></i> <span>Designation</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li> -->
        <!-- <li>
          <a href="holiday.php">
            <i class="fa fa-calendar"></i>
              <span>Holiday</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li> -->
        
         <!-- <li>
          <a href="assignleaves.php">
            <i class="fa fa-calendar-o"></i>
              <span>Leave Types</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li> -->

        
        <!-- <li class="treeview">-->
        <!--  <a href="#">-->
        <!--    <i class="fa fa-calendar-minus-o"></i>-->
        <!--    <span>Leaves Settings</span>-->
        <!--    <span class="pull-right-container">-->
        <!--      <i class="fa fa-angle-left pull-right"></i>-->
        <!--    </span>-->
        <!--  </a>-->
        <!--  <ul class="treeview-menu">-->
        <!--    <li><a href="assignleaves.php"><i class="fa fa-users"></i>Leave Type</a></li>-->
           
        <!--  </ul>-->
        <!--</li>-->
        
        <li class="treeview" >
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Employees</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="Employees.php"><i class="fa fa-users"></i>All Employees</a></li>
             <li><a href="addLeavesForSpecificEmp.php"><i class="fa fa-calendar-minus-o"></i>Employees Extra Leaves</a></li>
            <li><a href="Attendance.php"><i class="fa fa-calendar"></i>Attendance</a></li>
              <li><a href="leaves.php"><i class="fa fa-calendar-minus-o"></i>Leave Request</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Payroll</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="salaryheads.php"><i class="fa fa-bookmark"></i>Salary Components</a></li>
            <!-- <li><a href="SalaryStructByDesignations.php"><i class="fa fa-file"></i>Salary Structures</a></li>             -->
            <li><a href="empsalarymenu.php"><i class="fa fa-file"></i>Employee Salary Structure</a></li>
            <li><a href="PayslipMainPage.php"><i class="fa fa-file-pdf-o"></i>Payslips</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  <script type="text/javascript">
  fetch_adminPersonalInfo();
  $('li').removeClass('active');

    var regex = /[A-Za-z _]+.php/g;
    var input = location.pathname;

    if(regex.test(input)) {
       var matches = input.match(regex);
       $('a[href="'+matches[0]+'"]').closest('li').addClass('treeview active');
       $('a[href="'+matches[0]+'"]').closest('ul').closest('li').addClass('active');
    }

    function fetch_adminPersonalInfo(){
      $.ajax({
            url:'../src/fetch_adminPersonalInfo.php',
            type:'POST',
            dataType:'json',
            success:function(response){
              // alert("ok");
              let ProfileImageName = response.ProfilePic;
              let LogoImageName = response.logoImage;

                let header = '<div class="pull-left image"><a href=""><img src="../images/'+ProfileImageName+'" width="50" height="50" class="img-circle" alt="User Image" ></a></div><div class="pull-left info"><a href="#"><p>'+response.fname+" "+response.lname+'</p></a><a href="#"><i class="fa fa-circle text-success"></i>Online</a></div>';
                $('#userPanel').append(header);

            }
      });
    }
  </script>
