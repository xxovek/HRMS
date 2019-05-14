<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Register</title>
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

.pass_show{position: relative}

.pass_show .ptxt {

position: sticky;

top: 50%;

right: 1px;

z-index: 3;

color: #f36c01;

/* margin-top: -10px; */

cursor: pointer;

transition: .3s ease all;

}

.pass_show .ptxt:hover{color: #333333;}
</style>

<body>
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>New Registration</a>
  </div>
  <!-- /.login-logo -->
    <div class="login-box-body"  >
    <p class="login-box-msg">Payroll Admin Registration</p>

    <!-- <form id="adminRegisterForm" method="post">
      <span id="msg"></span> -->
      <form class="form-horizontal" id="AdminBasicInfoForm" method="post">
        <div class="box box-default">
            <div class="box-body">
          <span id="msg"></span>
          <div class="form-group has-feedback">
                <label>First Name:<font color="red">*</font></label>
            <!-- <input type="text" name="uname" class="form-control" placeholder="Enter Email" autocomplete="off" required/> -->
            <input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="Enter First Name" autocomplete="off" required>

            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
                <label>Last Name:<font color="red">*</font></label>
            <!-- <input type="text" name="uname" class="form-control" placeholder="Enter Email" autocomplete="off" required/> -->
            <input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="Enter Last Name" autocomplete="off" required>

            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
                <label>Company Name:<font color="red">*</font></label>
            <!-- <input type="text" name="uname" class="form-control" placeholder="Enter Email" autocomplete="off" required/> -->
            <input type="text" class="form-control" name="inputFirmName" id="inputFirmName" placeholder="Enter Company Name" autocomplete="off" required>

            <span class="glyphicon glyphicon-home form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
                <label>Email:<font color="red">*</font></label>
                <font color="red"><span id="email-availability-status" style="float:right"></span></font>
                <input type="email" class="form-control" name="email" id="email" onblur="EmailAvailability();" autocomplete="off" placeholder="Enter E-mail" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
                <label>Password:<font color="red">*</font></label>
                <div class="pass_show">
                  <!-- <div class="pass_show" style="float:right" ></div> -->
                  <input type="password" class="form-control"  name="oldpwd" id="oldpwd" autocomplete="off" placeholder="Enter Password" >
                </div>
                <span class="glyphicon glyphicon-asterisk form-control-feedback" ></span>
        </div>


          <div class="form-group has-feedback">
                <label>Contact Number :<font color="red">*</font></label>
                <!-- <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="Enter Admin E-mail" required> -->
                <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" placeholder="Enter Contact number" required>

            <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
          </div>
          <div class="form-group">
            <button type="submit"  id="RegisterBtn" class="btn btn-primary btn-block ">Register</button>
          </div>
        </div>
        <div class="login-box-msg">
          <span class="text-small font-weight-semibold">Go</span>
          <a href="./login.php" class="text-black text-small">Back</a>
        </div>
      </div>


      </form>

    </div>




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
$('.pass_show').append('<span class="ptxt">Show</span>');


$(document).on('click','.pass_show .ptxt', function(){

$(this).text($(this).text() == "Show" ? "Hide" : "Show");

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });

});

  $('#AdminBasicInfoForm').on('submit', function(e){
     e.preventDefault();
    $.ajax({
      url:'../src/adminNewRegister.php',
      method:'POST',
      data:$('#AdminBasicInfoForm').serialize(),
      dataType:'json',
      success:function(response){
        if(response.success){
          window.location.href="login.php";
        }
        else {
          var msg= "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='white'>Registration Failed Try Again</strong></font></div>";

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

function EmailAvailability(){

let emailInputVal = document.getElementById('email').value;

$.ajax({
  url: "../src/check_email_availablity.php",
  type: "POST",
  data:'email='+emailInputVal,
  // dataType:"json",
  success:function(response){
    if(response =="<span class='status-not-available'> E-mail Id Already Exists</span>")
    {
    $("#email").val('');
    }
  	$("#email-availability-status").html(response);
  //	$("#loaderIcon_1").hide();
  },
  error:function (){}
});

}

</script>
</body>
</html>
