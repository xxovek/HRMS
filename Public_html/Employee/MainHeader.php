  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b>RM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Hrm</b>Management</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu" id="listUser1">

            <ul class="dropdown-menu" id="listUser">
              <!-- User image -->


              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="employeeLogout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>

          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <script type="text/javascript">
  $(document).ready(function(){
  });
  $.ajax({
    url:'displayEmployeeProfile.php',
    type:'GET',
    dataType:'json',
    success:function(response){
      // alert(response);
      var EmpName = response[0].EmpName.split("-");


      var header = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
      header += '<img src="../../images/'+response[0].ProfilePic+'" class="user-image" alt="User Image">';
      header += '<span class="hidden-xs">'+EmpName[0]+" "+EmpName[1]+'</span></a>';
      $('#listUser1').prepend(header);
      $('#listUser').prepend('<li class="user-header"><img src="../../images/'+response[0].ProfilePic+'" class="img-circle" alt="User Image"><p> '+EmpName[0]+" "+EmpName[1]+' - Web Developer<small>Employee Since '+response[0].joining_date+'</small></p></li>');
    }
  });
    </script>
