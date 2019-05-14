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
  <title>HRM MANAGEMENT | PROFILE SETTINGS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">


  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style media="screen">
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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'MainHeader.php';?>

  <?php include 'MainSidebar.php';?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee Profile
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Employee profile</li>
      </ol> --><br>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-5">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <span id="imagep"></span>

              <h3 class="profile-username text-center"><span id="empname"></span></h3>

              <p class="text-muted text-center">Software Engineer</p>
              <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                <p class="text-muted" id="education">
                  <!-- B.S. in Computer Science from the University of Tennessee at Knoxville -->
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                <p class="text-muted" id="address"></p>

                <hr>

                <strong><i class="fa fa-star margin-r-5"></i> Skills</strong>

                <p id="skills1">
                </p>


              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->


        <div class="col-md-7">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
              <li ><a href="#UploadImageTab" data-toggle="tab">Profile Image</a></li>

            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="UploadImageTab">
                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <span id="msgUploadimage"></span>
                  </div>
                </div>
                <form class="form-horizontal"  method="post" enctype="multipart/form-data" id="profileImageForm">
                  <div class="box box-success">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-1"></div>
                          <div class="col-md-10">
                            <div class="col-sm-4">
                                <label for="imgnameProfile">Upload New Profile Image :</label>
                              <div class="upload-image">
                                <input type="file" name="imgnameProfile" id="imgnameProfile" value="Upload Image" />
                                <span id="profileImgSpan" ></span>
                              </div>
                          </div>
                            <div class="col-sm-4">
                              <div class="img-responsive"  id="profile"></div>
                            </div>
                      </div>
                    </div>
                    <hr>

                        <div class="row">
                          <div class="col-sm-8"></div>
                          <button  type="submit" class="btn btn-success" value="add" >Upload</button>&nbsp;
                          <button class="btn btn-default" type="reset" >Reset</button>
                        </div>

                      </div>
                    </div>
                </form>
              </div>

              <div class="active tab-pane" id="settings">
                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <span id="msg"></span>
                  </div>
                </div>

                <form class="form-horizontal" id="profileEmp">
                    <div class="box box-success">
                        <div class="box-body">
                  <div class="form-group">
                    <label for="inputFName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="First Name" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputLName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="Last Name" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">E-mail</label>

                    <div class="col-sm-5">
                      <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="Email" required>
                    </div>
                  </div>

                  <div class="form-group">

                <label class="col-sm-2 control-label">Change Password</label>
                  <div class="col-sm-5">
                    <input type="checkbox" id="CPass_checkbox" onclick="checkboxTick();" class="minimal">
                  </div>

                  </div>


                  <div style="display:none" id="ChangePassDiv">
                    <div class="form-group " id="CurrentPWDiv" >
                      <input type="hidden" id="oldPass">
                      <label for="inputName" class="col-sm-2 control-label">Current Password</label>
                      <div class="col-sm-5 pass_show">
                        <span id="wrongPWMsg" style="float:right"></span>
                        <input type="password" class="form-control" onblur="return CheckPass(this.value);" name="oldpwd" id="oldpwd" autocomplete="off" placeholder="Enter Current Password" required>
                      </div>
                    </div>
                    <div class="form-group " id="cpDiv" style="display:none">
                      <label for="inputName" class="col-sm-2 control-label">New Password</label>
                      <div class="col-sm-5 pass_show">
                        <input type="password" class="form-control" name="pwd" id="pwd" autocomplete="off" placeholder="Enter New password" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Contact Number</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" placeholder="contact number" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" onclick="saveEmpBasicDetail();" class="btn btn-success">Save</button>
                    </div>
                  </div>

                </div>
              </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

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

  <!-- Control Sidebar -->
  <?php include "RightSidebar.php"; ?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>

<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function(){
fetchProfile();
fetchSkills();
$('.pass_show').append('<span class="ptxt">Show</span>');
});

// $("#CPass_checkbox").on("click",function(){
//   $("#ChangePassDiv").show();
// });

function checkboxTick(){
if(document.getElementById("CPass_checkbox").checked === true){
  $("#ChangePassDiv").show();
}
else{
  $("#ChangePassDiv").hide();
}
}

function CheckPass(pw){
  // alert(pw);
  let oldPass = document.getElementById('oldPass').value;
  let password = pw.trim();
  if(password === oldPass){
      $("#cpDiv").show();
      $("#CurrentPWDiv").hide();
  }else {
    // alert("Incorrect Password");
    $("#wrongPWMsg").html("Incorrect Password");
  }
}

//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
});

function fetchProfile() {
  $.ajax({
      type: "POST",
      url: "displayEmployeeProfile.php",
      dataType:'json',
      success: function(response) {
        //alert(response[0].EmpName);
        var EmpName = response[0].EmpName.split("-");
        $("#imagep").html('<img class="profile-user-img img-responsive img-circle" src="../../images/'+response[0]['ProfilePic']+'" alt="User profile picture">');
        $('#empname').html(EmpName[0]+" "+EmpName[1]);
        $('#education').html(response[0].education);
        $('#inputFName').val(EmpName[0]);
        $('#inputLName').val(EmpName[1]);

        // $('#pwd').val(response[0]['EPassword']);
        $('#oldPass').val(response[0].EPassword);
        $('#phone').val(response[0].contactNumber);
        $('#email').val(response[0].EmailId);
        $('#address').html(response[0].address);
        var count=response.length;

        for (var i = 1; i < count; i++) {
        $("#education").append(response[i].education+" from "+response[i].university+"<br>");
        }
}
});
}

function fetchSkills() {
  var class1=['label label-danger','label label-success','label label-primary','label label-warning','label label-info','label label-danger','label label-success','label label-primary','label label-warning','label label-info','label label-danger','label label-success','label label-primary','label label-warning','label label-info','label label-danger','label label-success','label label-primary','label label-warning','label label-info'];
  $.ajax({
      type: "POST",
      url: "displayEmpSkills.php",
      dataType:'json',
      success: function(response) {
        var count=response.length;
        for (var i = 0; i < count; i++) {
        $("#skills1").append('<span class="'+class1[i]+'">'+response[i]['skill']+'</span>&nbsp;');
        }
}
});
}

$("#profileImageForm").on("submit",function(e){
  e.preventDefault();
    var formData = new FormData(this.form);
    var Profilefile_data = $("#imgnameProfile").prop("files")[0];
    formData.append('imgnameProfile', Profilefile_data);

    $.ajax({
        url: "empProfileImageUpload.php",
        type: "POST",
        data:formData,
        dataType:'json',
        cache:false,
        contentType: false,
        processData: false,
        success: function(response) {
          if(response.msg){
          // alert("Updated Succesfully");
          var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Updated Successfully</strong></font></div>";
          $('#msgUploadimage').html(msg2);
          window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
         window.location.reload();
         // fetchProfile();
        }
  }
  });
});

// $("#profileEmp").on("submit",function(e){
//   alert("ok");
//   e.preventDefault();

function saveEmpBasicDetail(){
alert("ok");
  let fname = document.getElementById('inputFName').value;
  let lname = document.getElementById('inputLName').value;
  let contact = document.getElementById('phone').value;
  let email = document.getElementById('email').value;
  let pw = document.getElementById('pwd').value;
  if (pw =="") {
    pw = document.getElementById('oldPass').value;
  }

  $.ajax({
      url: "editProfile.php",
      type: "POST",
      // data:$("#profileEmp").serialize(),
      data:{inputFName:fname,inputLName:lname,phone:contact,email:email,pwd:pw},
      dataType:'json',
      success: function(response) {
        if(response.true){
        // alert("Updated Succesfully");
        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Updated Successfully</strong></font></div>";
        $('#msg').html(msg2);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
       window.location.reload();
      }
}
});

}


// });

$(document).on('click','.pass_show .ptxt', function(){

$(this).text($(this).text() == "Show" ? "Hide" : "Show");

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });

});
</script>
</body>
</html>
<?php }
else {
  header('LOCATION:../EmpLogin.php');
} ?>
