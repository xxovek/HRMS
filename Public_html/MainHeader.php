  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b>RM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>HR Management</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav" id="navmenuUl">

          <!-- User Account: style can be found in dropdown.less -->

        </ul>
      </div>
    </nav>
  </header>


<script type="text/javascript">


fetch_adminPersonalInfo();

    function fetch_adminPersonalInfo(){
      $.ajax({
            url:'../src/fetch_adminPersonalInfo.php',
            type:'POST',
            dataType:'json',
            success:function(response){
              // alert("ok");
              let ProfileImageName = response.ProfilePic;
              let LogoImageName = response.logoImage;

                // let header = '<div class="pull-left image"><a href=""><img src="../images/'+ProfileImageName+'" width="50" height="50" class="img-circle" alt="User Image" ></a></div><div class="pull-left info"><a href="#"><p>'+response.fname+" "+response.lname+'</p></a><a href="#"><i class="fa fa-circle text-success"></i>Online</a></div>';
                // $('#userPanel').append(header);

                let header = '<li class="dropdown user user-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                    header += '<img src="../images/'+ProfileImageName+'" class="user-image" alt="User Image">';
                    header += '<span class="hidden-xs">'+response.fname+" "+response.lname+'</span></a><ul class="dropdown-menu"><li class="user-header">';
                    header += '<img src="../images/'+ProfileImageName+'" class="img-circle" alt="User Image"><p>Admin-'+response.firm+'</p></li><li class="user-footer"><div class="pull-left">';
                    header += '<a href="ProfileSetting.php" class="btn btn-default btn-flat">Profile</a></div><div class="pull-right">';
                    header += '<a href="login.php" class="btn btn-default btn-flat">Sign out</a></div></li></ul></li><li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>';
                    $('#navmenuUl').append(header);

            }
      });
    }
</script>
