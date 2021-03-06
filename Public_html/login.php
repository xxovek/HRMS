<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | ADMIN LOGIN</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<style>
body{
/* background-image: url("../images/images.jpeg"); */
  background-repeat: no-repeat;
   background-size: cover;
   /* opacity:0.2; */

}
</style>

<body>
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>LOGIN</a>
  </div>
  <!-- /.login-logo -->
    <div class="login-box-body"  >
    <p class="login-box-msg">Payroll Admin Signin</p>

    <form id="login_form" method="post">
      <div class="box box-default">
          <div class="box-body">
      <span id="msg"></span>

      <div class="form-group has-feedback">
            <label>Username</label>
        <input type="text" name="uname" class="form-control" placeholder="Enter E-mail" autocomplete="off" required/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Password</label>
        <input type="password" name="pwd" class="form-control" placeholder="Enter Password" autocomplete="off" required/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        <!-- /.col -->
        <div class="form-group">
          <button type="submit"  id="login1" class="btn btn-primary btn-block ">Sign In</button>
        </div>
        <div class="row">

        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Keep me signed in
            </label>
          </div>
        </div>
        <div class="col-xs-4">
      </div>
    </div>
        <div class="login-box-msg">
          <span class="text-small font-weight-semibold">Log in As a</span>
          <a href="./Employee/EmpLogin.php" class="text-black text-small">Employee</a>
        </div>
        <div class="login-box-msg">
          <span class="text-small font-weight-semibold">New Register As a</span>
          <a href="./Register.php" class="text-black text-small">Admin</a>
        </div>
        <!-- /.col -->
      </div>
    </div>

    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>

<script>
  $('#login_form').on('submit', function(e){
     e.preventDefault();
    $.ajax({
      url:'../src/login_db.php',
      method:'POST',
      data:$('#login_form').serialize(),
      success:function(data){
        response=JSON.parse(data);
        if(response['success'])
        {
          window.location.href="index.php";
        }
        else {
          var msg= "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='white'>Please Enter Correct Username or Password</strong></font></div>";
            $('#msg').html(msg);
            window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove();
              });
          }, 3000);
        }
      }
    });
  });


  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '10%' /* optional */
    });
  });
</script>
</body>
</html>
