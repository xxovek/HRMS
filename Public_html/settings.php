<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['a_id'])){
  $adminid =$_SESSION['a_id'];
  $uname=$_SESSION['uname'];

 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM MANAGEMENT | ADMIN PROFILE SETTINGS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <!-- bootstrap datepicker -->
   <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 <!-- Bootstrap time Picker -->
 <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
 
 <link rel="stylesheet" href="../bower_components/select2/dist/css/editselect2.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- jQuery 3 -->  
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>

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
        Admin Configurations Settings
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Employee profile</li>
      </ol> --><br>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- <div class="row">
        <div class="col-md-5">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <span id="imagep"></span>
              <h3 class="profile-username text-center"><span id="empname"></span></h3>
              <p class="text-muted text-center">Admin-<span id="Admin_CompanyName"></span></p>
              <div class="box-body"></div>
            </div>
          </div>
        </div> -->

        <!-- <div class="col-md-"></div> -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#BasicSettingsTab" data-toggle="tab">Personal Settings</a></li>
              <li ><a href="#CompanySettingsTab" data-toggle="tab">Company Detail Settings</a></li>
              <li ><a href="#ProfilePicSettingsTab" data-toggle="tab">Profile Image Settings</a></li>
              <li ><a href="#HolidaySettingTab" data-toggle="tab">Holiday(weekOff Day)</a></li>
              <li ><a href="#TaxSettingTab" data-toggle="tab">Tax Settings</a></li>
              <li ><a href="#TimeSettingTab" data-toggle="tab">Time Settings</a></li>
              <li ><a href="#OtherSettingTab" data-toggle="tab">Other Settings</a></li>



            </ul>
            <div class="tab-content">

           
              <div class="active tab-pane" id="BasicSettingsTab">
                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <span id="msgBasicInfo"></span>
                  </div>
                </div>
                <form class="form-horizontal" id="AdminBasicInfoForm">
                    <div class="box box-success">
                        <div class="box-body">
                  <div class="form-group">
                    <label for="inputFName" class="col-sm-3 control-label">Admin First Name:<font color="red">*</font></label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="Enter First Name" autocomplete="off" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputLName" class="col-sm-3 control-label">Admin Last Name:<font color="red">*</font></label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="Enter Last Name" autocomplete="off" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Admin Email:<font color="red">*</font></label>

                    <div class="col-sm-5">
                      <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="Enter Admin E-mail" required>
                    </div>
                  </div>

                  <div class="form-group">

                <label class="col-sm-3 control-label">Change Password</label>
                  <div class="col-sm-5">
                    <input type="checkbox" id="CPass_checkbox" onclick="checkboxTick();" class="minimal">
                  </div>

                  </div>

                <div style="display:none" id="ChangePassDiv">
                  <div class="form-group " id="CurrentPWDiv" >
                    <input type="hidden" id="oldPass">
                    <label for="oldpwd" class="col-sm-3 control-label">Current Password</label>
                    <div class="col-sm-5 pass_show">
                      <span id="wrongPWMsg" style="float:right"></span>
                      <input type="password" class="form-control" onblur="return CheckPass(this.value);" name="oldpwd" id="oldpwd" autocomplete="off" placeholder="Enter Current Password">
                    </div>
                  </div>
                  <div class="form-group " id="cpDiv" style="display:none">
                    <label for="inputName" class="col-sm-3 control-label">New Password</label>
                    <div class="col-sm-5 pass_show">
                      <input type="password" class="form-control" name="pwd" id="pwd" autocomplete="off" placeholder="Enter New password">
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                    <label for="phone" class="col-sm-3 control-label">Admin Contact Number:<font color="red">*</font></label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" onkeypress="return isNumberKey(event);" title="Mobile No should start with 7,8 or 9 containing 10 digits " pattern="^[789]\d{9}$"  minlength="10" maxlength="10" placeholder="Enter Admin Contact number" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                  </div>

                </div>
              </div>
                </form>
              </div>



              <div class="tab-pane" id="CompanySettingsTab">
                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <span id="msgCompanyInfo"></span>
                  </div>
                </div>
                  <form class="form-horizontal" id="CompanyInfoForm">
                    <input type="hidden" name="companyid" id="companyid">
                    <div class="box box-success">
                        <div class="box-body">

                          <div class="form-group">
                            <label for="inputCname" class="col-sm-3 control-label">Company Name:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="inputCname" id="inputCname" placeholder="Enter Company Name" autocomplete="off" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="inputCname" class="col-sm-3 control-label">financial_year:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <!-- <input type="text" class="form-control" name="inputCname" id="inputCname" placeholder="Enter Company Name" autocomplete="off" required> -->
                              <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" autocomplete="off" class="form-control pull-right" name="startdatepicker" id="startdatepicker" required>
                    </div>
                            </div>
                          </div>


                          <!-- <div class="col-md-8">
                  <div class="form-group">
                    <label><h5>Start To End Date :<font color="red">*</font></h5></label>
                    <span id="startDate_err" ></span>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" autocomplete="off" class="form-control pull-right" id="startdatepicker">
                    </div>
                  </div>
                </div>
                </div>
                </div> -->


                          
                          <div class="form-group">
                            <label for="inputContPersonName" class="col-sm-3 control-label">Contact Person:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="inputContPersonName" id="inputContPersonName" placeholder="Enter Contact Person Name" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputContNumber" class="col-sm-3 control-label">Contact Number:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <input type="text" class="form-control" onkeypress="return isNumberKey(event);" title="Mobile No should start with 7,8 or 9 containing 10 digits " pattern="^[789]\d{9}$"  minlength="10" maxlength="10"  name="inputContNumber" id="inputContNumber" placeholder="Enter Contact Number" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCompanyEmail" class="col-sm-3 control-label">Company Email:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <input type="email" class="form-control" name="inputCompanyEmail" maxlength="255" id="inputCompanyEmail" placeholder="Enter Compay E-mail" autocomplete="off" required>
                            </div>
                          </div>


                          <div class="form-group">
                            <label for="inputCompanyFax" class="col-sm-3 control-label">Company Fax</label>

                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="inputCompanyFax" id="inputCompanyFax" placeholder="Enter Company FAX" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCompanyWebUrl" class="col-sm-3 control-label">Company Website URL </label>

                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="inputCompanyWebUrl" id="inputCompanyWebUrl" placeholder="Enter Company URL" autocomplete="off">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="scountry" class="col-sm-3 control-label">Company Country:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <!-- <select class="form-control select2" name="scountry" id="scountry" style="width:100%;padding-top:20px;" onchange="getStateemp(this.value);" required></select> -->
                              <select class="form-control select2" name="scountry" id="scountry" style="width:100%;padding-top:20px;"  required></select>
                           
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="sstate" class="col-sm-3 control-label">Company State:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <!-- <select name="sstate" id="sstate" class="form-control select2" style="width:100%;padding-top:0px;" onChange="getCityemp(this.value);" required></select> -->
                              <select name="sstate" id="sstate" class="form-control select2" style="width:100%;padding-top:0px;"  required></select>

                            </div>
                          </div>

                          <div class="form-group">
                            <label for="scity" class="col-sm-3 control-label">Company City:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <select name="scity" id="scity" class="form-control select2" style="width:100%;padding-top:0px;" required></select>

                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPincode" class="col-sm-3 control-label">Pincode:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <input type="text" class="form-control" maxlength="6" onkeypress="return isNumberKey(event);" name="inputPincode" id="inputPincode" placeholder="Enter Pincode" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCompanyAddr" class="col-sm-3 control-label">Company Address:<font color="red">*</font></label>

                            <div class="col-sm-5">
                              <textarea id="inputCompanyAddr" name="inputCompanyAddr" class="form-control"  autocomplete="off" required></textarea>

                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                            <button  type="submit" class="btn btn-success" >Save</button>&nbsp;
                            <button class="btn btn-default" type="reset">Reset</button>
                          </div>
                          </div>
                        </div>
                      </div>
                  </form>
              </div>

              <div class="tab-pane" id="ProfilePicSettingsTab">
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
                                <label for="imgnameProfile">Upload New Profile:</label>
                              <div class="upload-image">
                                <input type="file" name="imgnameProfile" id="imgnameProfile" value="Upload Image" />
                                <span id="profileImgSpan" ></span>
                              </div>
                          </div>
                            <div class="col-sm-4">
                              <div class="img-responsive"  id="profile1"></div>
                            </div>
                      </div>
                    </div><hr>
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-md-10">
                        <div class="col-sm-4">
                            <label for="imgnameLogo">Upload New Company Logo:</label>
                          <div class="upload-image">
                            <input type="file" name="imgnameLogo" id="imgnameLogo" value="Upload Image" />
                            <span id="logoImageSpan" ></span>
                          </div>
                      </div>
                        <div class="col-sm-4">
                          <div class="img-responsive"  id="logo1"></div>
                        </div>
                  </div>
                    </div>
                 <hr>
                        <div class="row">
                       <div class="col-sm-2"></div>

                          <div class="col-sm-10">
                          <button  type="submit" class="btn btn-success" value="add" >Upload</button>&nbsp;
                          <button class="btn btn-default" type="reset" >Reset</button>
                        </div>
                        </div>
                      </div>
                    </div>
                </form>
              </div>

              <div class="tab-pane" id="HolidaySettingTab">
                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <span id="msgHoliday"></span>
                  </div>
                </div>
                <form class="form-horizontal"  method="post" id="weekOffSettingForm">
                  <input type="hidden" name="prevSetId" value="">
                  <div class="form-group">
                    <label for="weekdaysInput" class="col-sm-3 control-label">Day:<font color="red">*</font></label>

                    <div class="col-sm-5">
                      <select class="form-control select2" name="weekdaysInput" id="weekdaysInput" style="width:100%;padding-top:20px;" required>
                        <option value="">Select Day</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>

                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="WeekNumberInput" class="col-sm-3 control-label">Week Number:<font color="red">*</font></label>

                    <div class="col-sm-5">
                      <select name="WeekNumberInput" id="WeekNumberInput" class="form-control select2" style="width:100%;padding-top:0px;" required>

                        <option value="">Select Week</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
<!-- <span id=""></span> -->

                    </div>
                   
        <div class="col-md-1"></div>

                  </div>

                  <hr>
                  <div class="form-group">
                    <div class="col-sm-3"></div>
                        <div class="col-sm-5">
                    <button  type="button" class="btn btn-success" onclick="SaveWeekOffForm();" value="add" >Save</button>&nbsp;
                    <!-- <button class="btn btn-default" type="reset" onclick="resetWeekOffForm();" id="weekOffSettingFormResetBtn">Reset</button> -->
                  </div>
                </div>

                  <div class="row">
                    <!-- <label for="WeekNumberInput" class="col-sm-3 control-label">Previous Set</label> -->
                    <div class="col-sm-3"></div>
                    <div class="col-sm-5">
                      <div class="table-responsive">
                        <div class="box-header">Previous Setting Off Days</div>

                        <table id="weekDaysTbl" class="table table-bordered table-striped">
                            <tr>
                                  <th class="text-center">Day</th>
                                  <th class="text-center">Week Number</th>
                                  <th class="text-center">Action</th>

                            </tr>
                            <tbody id="WeekOffDaysTblBody">
                              <!-- <tr>
                                <td class="text-center">Sunday</td>
                                <td class="text-center">1st</td>
                                <td class="text-center">
                                  <div class="btn-group">
                                  <button type="button" class="label label-danger pull-right"><i class="fa fa-trash"></i></button>
                                </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="text-center">Sunday</td>
                                <td class="text-center">2nd</td>
                                <td class="text-center">
                                  <div class="btn-group">
                                  <button type="button" class="label label-danger pull-right"><i class="fa fa-trash"></i></button>
                                </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="text-center">Sunday</td>
                                <td class="text-center">3rd</td>
                                <td class="text-center">
                                  <div class="btn-group">
                                  <button type="button" class="label label-danger pull-right"><i class="fa fa-trash"></i></button>
                                </div>
                                </td>
                              </tr> -->

                            </tbody>
                        </table>
                      </div>

                    </div>
                  </div>


                </form>

              </div>

              <div class="tab-pane" id="TaxSettingTab">
            <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <span id="msgForTax"></span>
                  </div>
                </div>
                <form class="form-horizontal"  method="post" id="TaxSettingForm">
                    <input type="hidden" id="taxId" name="taxId">
                <div class="form-group">
                            <label for="taxName" class="col-sm-3 control-label">Tax Name:<font color="red">*</font></label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="taxName" id="taxName" placeholder="Enter Tax Name" minlength="4" maxlength="20" autocomplete="off" required>

                            </div>
                          </div>

                          <div class="form-group">
                            <label for="taxVal" class="col-sm-3 control-label">Tax Value:<font color="red">*</font><small>(In %)</small></label>

                            <div class="col-sm-5">
                            <input type="text" class="form-control"  name="taxVal" id="taxVal" onkeypress="return isNumberKey(event);" minlength="2" maxlength="2" placeholder="Enter Tax Value in %" autocomplete="off" required>

                            </div>
                          </div>
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                            <button  type="button" class="btn btn-success" id="saveBTN" onclick="SaveTaxForm();" >Save</button>&nbsp;
                            <button  type="button" class="btn btn-success" id="updateBTN" style="display:none" onclick="SaveTaxForm();" >Update</button>&nbsp;
                            <!-- <button class="btn btn-default"  type="reset">Reset</button> -->
                            <button class="btn btn-default" id="resetBTN" onclick="resetBTNClick();" type="button">Reset</button>
                          </div>
                          </div>

                          <hr>
                
                          <div class="row">
                    <!-- <label for="WeekNumberInput" class="col-sm-3 control-label">Previous Set</label> -->
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                      <div class="table-responsive">
                        <div class="box-header">All Taxes </div>

                        <table id="TaxListTbl" class="table table-bordered table-striped">
                            <tr>
                                  <th class="text-center">#</th>
                                  <th class="text-center">Tax Name</th>
                                  <th class="text-center">Tax Value <small>In %</small></th>
                                  <th class="text-center">Created Date</th>
                                  <th class="text-center">Action</th>

                            </tr>
                            <tbody id="TaxListTblBody">
                            </tbody>
                        </table>
                      </div>

                    </div>
                  </div>
                </form>
            </div>
            <div class="tab-pane" id="TimeSettingTab">
                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <span id="msgTimeInfo"></span>
                    <form class="form-horizontal"  method="post" id="TimeSettingForm">

                            <div class="form-group">
                              <label class="col-sm-3 control-label">In Time:<font color="red" >*</font></label>
                              <div class="col-sm-5">
                             <div class="bootstrap-timepicker">
                                <div class="input-group">
                                  <input type="text" class="form-control timepicker"  name="InTime"  id="InTime" autocomplete="off" required>
                                  <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                      </div>

                            <div class="form-group">
                              <label class="col-sm-3 control-label">Out Time:<font color="red" >*</font></label>
                              <div class="col-sm-5">
                             <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text"  class="form-control timepicker" onblur="document.getElementById('workHours').value = timeSummation('InTime','OutTime')" name="OutTime" id="OutTime"   autocomplete="off" required>
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                              </div>
                            </div>
                          </div>


                    <!-- <div class="form-group">
                            <label for="taxName" class="col-sm-3 control-label">In Time:<font color="red">*</font></label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="InTime" id="InTime"  placeholder="Enter Employee In Time" autocomplete="off" required>

                            </div>
                          </div>
                          <div class="form-group">
                            <label for="taxName" class="col-sm-3 control-label">Out Time:<font color="red">*</font></label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="OutTime" id="OutTime"  placeholder="Enter Employee Out Time" autocomplete="off" required>

                            </div>
                          </div> -->

                          <div class="form-group">
                            <label for="taxName" class="col-sm-3 control-label">Total Working Hours in a day:<font color="red">*</font></label>
                            <div class="col-sm-5">
                            <input type="text" readonly class="form-control"  name="workHours" id="workHours"  placeholder="Each day Working Hours" autocomplete="off" required>

                            </div>
                          </div>

                          <!-- <div class="bootstrap-timepicker">
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Time Picker:<font color="red" >*</font></label>
                              <div class="col-sm-5">
                              <div class="input-group">
                                <input type="text" id="timePicker" name="timePicker" class="form-control timepicker">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                              </div>
                            </div>
                          </div> -->


                          <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                  </div>


                    </form>
                  </div>
                </div>
              </div>


              <div class="tab-pane" id="OtherSettingTab">
                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                    <span id="msgOtherInfo"></span>
                    <form class="form-horizontal"  method="post" id="OtherSettingForm" >
                    <input type="hidden" id="PFRecordId" name="PFRecordId">
                   
                    <div class="form-group">
                            <label for="PFPercentVal" class="col-sm-3 control-label">PF in %:<font color="red">*</font></label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="PFPercentVal" id="PFPercentVal" onkeypress="return isNumberKey(event);" minlength="2" maxlength="2" placeholder="Enter PF Percentage on Salary Component" autocomplete="off" required>

                            </div>

                          </div>

                          <div class="form-group">
                 <label for="options" class="col-sm-3 control-label">Component On Which PF Applied &nbsp;:<font color="red">*</font></label>
                 <div class="col-sm-5">
                 <span id="CompoSel_err" ></span>
                  <select class="form-control select2" id="options" name="options"  data-placeholder="Select Component"  required>
                  </select>
                </div>
                </div>



                          <!-- <div class="col-md-4"> -->
            
                    <!-- </div> -->

                          <div class="form-group">
                            <label for="PTValue" class="col-sm-3 control-label">PT:<font color="red">*</font></label>
                            <div class="col-sm-5">
                            <input type="text" onkeypress="return isNumberKey(event);"  minlength="3" maxlength="3" class="form-control" name="PTValue" id="PTValue"  placeholder="Enter PT Professional Tax" autocomplete="off" required>

                            </div>
                          </div>

                          <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                      <button type="button" class="btn btn-success" onclick="OtherSettingFormFun();" >Save</button>
                    </div>
                  </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>




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
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script  src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="../bower_components/moment/min/moment.min.js"></script>

<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    
<script src="../bower_components/fastclick/lib/fastclick.js"></script>

<script src="../plugins/iCheck/icheck.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>


<!-- <script  src="../js/rulsetCompanyInfoForm.js"></script> -->
<script  src="../js/AdminProfileSetting.js"></script>
<script>
   setSelectOptions();   
   fetch_adminPersonalInfo();
   fetchWeekOffDays();
   fetchAllTaxes();
   getCountry_name();
   fetchUplodedImages();

// $( document ).ready(function() {
//    setSelectOptions();   
// });

function setSelectOptions(){
  $.ajax({
    url : '../src/fetch_optValforSalHeadsSelect.php',
    method : 'POST',
    success : function(data){
      // $("#optId").html(data);
      // alert("select");
      $("#options").html(data);
    }
  });
}

function OtherSettingFormFun(){
  // alert("OtherSettingFormFun");
  let inputFlag = 0;
  var PFPercentVal = document.getElementById('PFPercentVal').value;
  var option = document.getElementById('options').value;
  var PTValue = document.getElementById('PTValue').value;
  var PFRecordId = document.getElementById('PFRecordId').value;

  if(PFPercentVal === ""){
    inputFlag = 1;
}else if (option === "") {
  inputFlag = 1;
}else if (PTValue === "") {
  inputFlag = 1;
}

if(inputFlag === 0){
  $.ajax({
    url:'../src/OtherSettingForm.php',
    type:'POST',
    data:{PFPercentVal:PFPercentVal,PTValue:PTValue,option:option,PFRecordId:PFRecordId},
    dataType:'json',
    success:function(response){
      // alert(response.add);
      if(response.add === true){

     var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Added Successfully..</strong></font></div>";
     $('#msgOtherInfo').html(msg2);
     window.setTimeout(function() {
     $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
      });
     }, 3000);

    }else if(response.true === 'noChange'){}
    else if (response.update === true){

    var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Updated Successfully</strong></font></div>";
    $('#msgOtherInfo').html(msg2);
    window.setTimeout(function() {
     $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
     });
    }, 3000);
    }else{
 }
    }
  })
}else{}

}

fetchPFSettings();

function fetchPFSettings(){
 
 $.ajax({
  url:'../src/fetchPFSettings.php',
  type:'POST',
  dataType:'json',
  success:function(response){
  // alert(response.PT);

    $("#PFPercentVal").val(response.PFPercent);
    $("#PTValue").val(response.PT);
    $("#PFRecordId").val(response.id);
    if(response.id > 0){
    $("#options").append("<option  value='"+response.SalComponentId+"' selected=selected >"+response.compName+"</option>");
    }else{
      setSelectOptions();
  }
  
  }
 });

}
fetchCompanyDetails();

$(document).on('change','#scountry',function(){  
  var country_id = $(this).val();
  // alert(country_id);

  if(country_id != ''){
  getStateemp(country_id);
  }else{
  
    $("#sstate").html('<option value="">Select State</option>');
    $("#scity").html('<option value="">Select City</option>');
  }
});

$(document).on('change','#sstate',function(){
  var state_id = $(this).val();
  if(state_id != ''){
  // getCountry_name();
  getCityemp(state_id);
  }else{
    // $("#sstate").html('<option value="">Select State</option>');
    $("#scity").html('<option value="">Select City</option>');
  }
})

</script>
</body>
</html>
<?php }
else {
  header("Location:login.php");
} ?>
