<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['a_id'])){
  $adminid =$_SESSION['a_id'];
  $uname=$_SESSION['uname'];
  //
  // $currently_selected = date('Y');
  // // Year to start available options at
  // $earliest_year = 1947;
  // // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
  // $latest_year = date('Y');
  //
  // print '<select>';
  // // Loops over each int[year] from current year, back to the $earliest_year [1950]
  // foreach ( range( $latest_year, $earliest_year ) as $i ) {
  //   // Prints the option with the next year in range.
  //   print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
  // }
  // print '</select>';
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>HRM MANAGEMENT | EMPLOYEES</title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <!-- Bootstrap 3.3.7 -->
   <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
   <!-- daterange picker -->
   <!-- <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
   <!-- bootstrap datepicker -->
   <!-- <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->

   <!-- DataTables -->
   <link rel="stylesheet" href="../datatables/CSS/buttons.bootstrap4.min.css" />
   <link rel="stylesheet" href="../datatables/CSS/dataTables.bootstrap4.min.css" />
   <!-- Theme style -->
   <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
   <link rel="stylesheet" href="../js/bootstrap-fileupload/bootstrap-fileupload.min.css" />

   <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
   <!-- <link rel="stylesheet" href="../bower_components/select2/dist/css/editselect2.min.css"> -->
   <!-- Select2 -->
   <!-- <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css"> -->
   <link rel="stylesheet" href="../bower_components/select2/dist/css/editselect2.min.css">

   <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <link rel="stylesheet" href="../dist/css/edit_employee.css">

   <!-- jQuery 3 -->
   <script src="../bower_components/jquery/dist/jquery.min.js"></script>
   <style>

   .modal-dialog {
           position: absolute;
           top: 50%;
           left: 50%;
           transform: translate(-50%, -50%) !important;
       }
     /* #employeername:focus,#Noofyear:focus{
       border-top: none !important;
       border-left: none !important;
       border-right: none !important;
       border-bottom: 1px solid green !important;
       background-color: transparent;
       padding-left: 0;
   } */

/* #AccountForm {
display:none
} */
   </style>
   </head>

   <body class="hold-transition skin-blue sidebar-mini">

   <div class="wrapper">
   <header class="main-header">
     <?php include "MainHeader.php"; ?>
   </header>
   <!-- Left side column. contains the logo and sidebar -->
   <aside class="main-sidebar">
     <?php include "MainSidebar.php" ; ?>
   </aside>


   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <!-- Main content -->
     <section class="content">
       <section class="content-header">
         <h1 >
            Employees Information
         </h1>
         <ol class="breadcrumb">
           <button class="btn btn-block btn-success" type="button" name="button" id="emp1" onclick="new_emp()">Add Employee</button>
         </ol>
         <br>
       </section>
       <div class="jumbotron text-center" id="nodata" style="display:none;">
         <span class="text-center" style="color:green">
         <h2>No Employee Added Yet !!</h2>
         </span>
       </div>
       <div id="editshow" style="display:none;">
       <div class="row">
         <div class="col-sm-10"></div>
         <div class="col-sm-2">
           <button id="savebtn" type="submit" class="btn btn-success" style="float: left;" value="save" >Save</button>
           <button id="cancelbtn" type="reset" class="btn btn-default" style="float: right;" value="cancel"
            onclick="window.location.reload();">Cancel</button>
     </div>
   </div>
   </div>


<div class="row" id="EmpFormRowDiv">
  <div class="col-md-1"></div>

  <div class="col-md-10">

    <div class="box " id="new" style="display:none">
   <div class="box-body">
      <form id="emp_reg"  method="post" enctype="multipart/form-data">

        <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-10">
          <h3 class="box-title center">Basic Details</h3>
            <hr>

          <div class="col-sm-4">
              <div class="form-group">
            <label for="fname">Firstname :<font color="red">*</font></label>
             <input type="hidden" id="empid" name="empid"/>
            <input type="text" id="fname" name="fname" minlength="2" class="form-control"  placeholder="Enter Employee First Name" autocomplete="off" required>
        </div>
        </div>
          <div class="col-sm-4">
              <div class="form-group">
            <label for="lname">Lastname :<font color="red">*</font></label>
            <input type="text" class="form-control" minlength="2"  id="lname" name="lname" placeholder="Enter Employee Last Name"  autocomplete="off" required>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
          <label for="gender">Gender :<font color="red">*</font></label><br>
          <input type="radio" name="gender"  id="Male" value="Male" > Male
          <input type="radio" name="gender" id="Female"  value="Female"> Female
          <input type="radio" name="gender" id="Others" value="Others"> Others
        </div>
        </div>
        </div>
      </div>


        <div class="row">
          <div class="col-sm-1"></div>
         <div class="col-sm-10">

          <div class="col-sm-4">
              <div class="form-group">
              <label for="pwd1">Date of birth :<font color="red">*</font></label>
            <input type="date" id="birthdate" name="birthdate" style="padding-top:0px;" class="form-control" placeholder="Enter Employee Date of Birth"  autocomplete="off"  required>
          </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
          <label for="email">Email :<font color="red">*</font></label>
          <span id="CheckEmailAvailability"><font color="red">Email Already Exists</font></span>
          <input type="email" id="email" name="email" class="form-control" maxlength="255" placeholder="Enter Employee E-mail"  autocomplete="off" required>
        </div>
      </div>

      <div class=" col-sm-4">
        <div class="form-group">
        <label for="phone">Phone :<font color="red">*</font></label>
        <input type="text" id="phone" name="phone" title="Mobile No should start with 7,8 or 9 containing 10 digits " pattern="^[789]\d{9}$"  minlength="10" maxlength="10" class="form-control" placeholder="Enter Employee Phone"  autocomplete="off" required>
      </div>
      </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-md-10">
          <div class="col-sm-4">
              <div class="form-group">
            <label for="jdate">Joining Date :<font color="red">*</font></label>
          <input type="date"  name="jdate" id="jdate" class="form-control" style="padding-top:0px;" placeholder="Enter Employee Joining Date"  autocomplete="off" required>
          </div>
          </div>
          <div class="col-sm-4">
            <input type="hidden" id="deptid" name="deptid"/>
            <label for="department">Department :</label>
            <select class="form-control select2" name="department" id="department" style="width:100%;"  ></select>
        </div>

          <div class="col-sm-4">
              <div class="form-group">
                <input type="hidden" id="desgnid" name="desgnid"/>
              <label for="designation">Designation :</label>
              <select name="designation" id="designation" class="form-control select2" style="width:100%;"  ></select>
          </div>
        </div>
      </div>
      </div>

        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-md-10">

          <div class="col-sm-4">
            <label for="country">Country :<font color="red">*</font></label>
            <select class="form-control select2" name="scountry" id="scountry" style="width:100%;padding-top:20px;" onchange="getStateemp(this.value);" required></select>
        </div>
          <div class="col-sm-4">
              <div class="form-group">
              <label for="state">State :<font color="red">*</font></label>
              <select name="sstate" id="sstate" class="form-control select2" style="width:100%;padding-top:0px;" onChange="getCityemp(this.value);" required></select>
          </div>
        </div>

        <div class="col-sm-4">
          <label for="city">City :<font color="red">*</font></label>
          <select name="scity" id="scity" class="form-control select2" style="width:100%;padding-top:0px;" required></select>
      </div>

        </div>
        </div>

        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-md-10">

          <div class="col-sm-4">
              <div class="form-group">
              <label for="Pincode">Pincode :<font color="red">*</font></label>
              <input type="text" id="pincode" name="pincode" maxlength="6" onkeypress="return isNumberKey(event);" class="form-control" placeholder="Enter Pincode"  autocomplete="off" required>
          </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
            <label for="panNum">Employee PAN Number :<font color="red">*</font></label>
            <input type="text" id="panNum" name="panNum" class="form-control" placeholder="Enter PAN Number" onblur="return ValidatePAN();"  autocomplete="off" required>
            <span id="invalidPAN__ip" ></span>
        </div>
      </div>
        <div class=" col-sm-4">
          <div class="form-group">
          <label for="des">Address :<font color="red">*</font></label>
          <textarea id="addr" name="addr" class="form-control"  autocomplete="off" required></textarea>
        </div>
        </div>

      </div>
        </div>

          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-md-10">

            </div>
          </div>

        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-md-10">
            <div class="col-sm-4">
                <label for="imgname">Employee Profile Image :</label>
              <div class="upload-image">
                <input type="file" name="file" id="imgname" value="Upload Image" />
                <span id="img" ></span>
              </div>
          </div>
            <div class="col-sm-4">
              <div class="img-responsive"  id="profile"></div>
            </div>
      </div>
        </div>

        <!--<div class="row">-->
        <!--  <div class="col-sm-5"></div>-->
        <!--  <button id="new1" type="submit" class="btn btn-success" value="add" >Submit</button>&nbsp;-->
        <!--  <button class="btn btn-default" onclick="clear_all()">Cancel</button>-->
        <!--</div>-->
        <br>
          <div class="row">
             
             <div class="col-sm-1"></div>
            
             <div class="col-sm-10">
                 <div class=" col-sm-6">
                      <button id="new1" type="submit" class="btn btn-success" value="add" >Submit</button>&nbsp;
                      <button class="btn btn-default" onclick="clear_all()">Cancel</button>
                </div>
            </div>
        </div>
        
      </form>
      </div>
    </div>

  </div>
</div>


 <div class="col-md-12">
 <div class="row" id="tbldata" style="display:none;">
   <div class="col-md-12">
     <div class="box" id="emp">
       <!-- <div class="box-header"></div> -->
       <div class="box-body">
         <div class="table-responsive">
         <table id="datble" class="table table-bordered table-striped">
           <thead class="tableHeader">
             <tr>
               <th >Employee Name</th>
               <th class="text-center">Department</th>
               <th class="text-center">Joining Date</th>
               <th class="text-center">Address</th>
               <th class="text-center">Action</th>
             </tr>
           </thead>
           <tbody id="loadtable">
           </tbody>
         </table>
       </div>
       </div>
     </div>
 </div>
 </div>
</div>






 <div class="row" id="loadCssDiv">
   <!-- <div class="col-sm-1"></div> -->
   <div class="col-sm-12" >
 <div class="box " id="editemp"  style="display:none;">
     <div class="box-body">
       <div class="jumbotron" style="height:150px;">
               <div class="img-responsive" style="float:left" id="profile2"></div>
               <div  id="empname"></div>
       </div>
       <span id="msg"></span>
       <span id="msg1"></span>
       <span id="msg2"></span>

       <div class="bs-example">
           <ul class="nav nav-tabs" id="myTab">
               <li class="active"><a href="#sectionA"> Personal details</a></li>
               <li><a href="#sectionB">Conatct Details</a></li>
               <li><a href="#sectionC">Corporate Details</a></li>
                <li><a href="#sectionH" onclick="loadBankDetails();">Bank Details</a></li>
                <li><a href="#sectionI" onclick="loadPFDetails();">PF Details</a></li>

               <li><a href="#sectionD">Profile/Cover Photo </a></li>

               <li><a href="#sectionE" onclick="loadEducationDetails();">Educational Details</a></li>
               <li><a href="#sectionF" onclick="loadExperienceDetails();">Experience Details</a></li>
               <li><a href="#sectionG" onclick="loadEmpSkillsDetails();"> Skill Details </a></li>
           </ul>
           <div class="tab-content">

               <div id="sectionA" class="tab-pane fade in active">
                 <div class="row" id="PersonalDetailTabDiv">
                   <div class="col-md-1"></div>
                   <div class="col-md-10">
                   <table>
                   <tr class="blank_row">
                     </tr>
                     <tr class="border_bottom">
                       <td class="label1"> First Name</td>
                       <td > : </td>
                       <td > </td>
                       <td id="fn" style="font-weight:bold" class="info text-center"></td>
                       <td class="editbtn" >
                         <a href="#">
                           <i class="fa fa-pencil"  style="margin-right:5px;"  title="edit"  id="editbtn" onclick="myFunction();">
                       </i></a></td>
                     </tr>

                       <tr class="blank_row">
                       </tr>
                         <tr class="border_bottom">
                            <td class="label1"> Last Name</td>
                            <td > : </td>
                            <td > </td>
                            <td id="ln" style="font-weight:bold" class="info text-center" ></td>
                            <td class="editbtn">
                              <a href="#">
                                <i class="fa fa-pencil" aria-hidden="true"  onclick="myFunction1();">
                            </i>
                          </a>
                        </td>
                          </tr>
                     <tr class="blank_row">  </tr>
                         <tr class="border_bottom">
                           <td class="label1"> Gender</td>
                           <td > : </td>
                           <td > </td>
                           <td id="empgender" style="font-weight:bold" class="info text-center">
                             <input type="radio" name="gender"  id="Male1" value="Male" > Male
                             <input type="radio" name="gender" id="Female1"  value="Female"> Female
                             <input type="radio" name="gender" id="Others1" value="Others"> Others
                            </td>
                           <td  class="editbtn" ><a href="#"><i class="fa fa-pencil" onclick="myFunction2();" aria-hidden="true"></i></a></td>
                         </tr>
                         <tr class="blank_row">
                           </tr>
                       <tr class="border_bottom">
                       <td class="label1" > Date of birth</td>
                         <td > : </td>
                         <td  ></td>
                         <td class="info text-center" style="font-weight:bold;" id="empbdate" ></td>
                         <td  class="editbtn"><a href="#"><i class="fa fa-pencil" onclick="myFunction3();" aria-hidden="true"></i></a></td>
                       </tr>

                          <tr class="blank_row"></tr>
                            <tr class="border_bottom">
                               <td class="label1">PAN Number</td>
                               <td > : </td>
                               <td > </td>
                               <td id="empPan" style="font-weight:bold" class="info text-center" ></td>
                               <td class="editbtn">
                                 <a href="#">
                                  <i class="fa fa-pencil" aria-hidden="true"  onclick="EmpPanFocus();"></i>
                                 </a>
                               </td>
                             </tr>
                             <tr class="blank_row"></tr>
                         <tr > <td class="label1" > </td>
                           <td></td>
                           <td></td>
                           <td><button id="update" type="submit" class="btn btn-primary" style="float:right;margin-right:10px" value="update" >Save </button></td>
                           <td><button id="cancelupdate" type="reset" class="btn btn-default"  value="cancel"
                              onclick="window.location.reload();">Cancel</button></td>
                         </tr>
                 </table>
               </div>
             </div>

               </div>



               <div id="sectionB" class="tab-pane fade">
                 <div class="row" id="contactDetailTabDiv">
                   <div class="col-md-1"></div>
                   <div class="col-md-10">
                  <table>

                   <tr class="blank_row"></tr>

                     <tr class="border_bottom">
                        <td class="label1"> Country</td>
                        <td > : </td>
                        <td> </td>
                        <td id="countryemp" class="info text-center">
                          <div class="row">
                          <div class="col-sm-1">
                          </div>
                          <div class="col-sm-9">
                       <select class="form-control select2" style="width:100%;font-weight:bold;" name="scountry2"   id="scountry2" disabled="true" onchange="getStateemp(this.value);" required>
                       </select>
                     </div>
                     <div class="col-sm-2">
                     </div>
                   </div>
                     </td>
                     <td class="editbtn"><a href="#"><i class="fa fa-pencil" aria-hidden="true" onclick="editcountry();">
                     </i></a></td>
                   </tr>

                   <tr class="blank_row">
                         </tr>
                         <tr class="border_bottom">
                            <td class="label1">State</td>
                            <td > : </td>
                            <td> </td>
                            <td class="info text-center">
                              <div class="row">
                              <div class="col-sm-1">
                              </div>
                              <div class="col-sm-9">
                              <select class="form-control select2" style="width:100%;font-weight:bold;" id="sstate2" name="sstate2" disabled="true" onchange="getCityemp(this.value);" required >
                              </select>
                            </div>
                            <div class="col-sm-2">
                            </div>
                          </div>
                            </td>
                           <td class="editbtn">
                           <a href="#"><i class="fa fa-pencil" aria-hidden="true"  onclick="editstate();" ></i></a></td>
                         </tr>
                         <tr class="blank_row">
                           </tr>

                         <tr class="border_bottom">
                            <td class="label1"> City</td>
                            <td > : </td>
                            <td> </td>
                            <td class="info text-center" >
                              <div class="row">
                              <div class="col-sm-1">
                              </div>
                              <div class="col-sm-9">
                              <select class="form-control select2" style="width:100%;font-weight:bold;" id="scity2" name="scity2" disabled="true" required >
                              </select>
                            </div>
                            <div class="col-sm-2">
                            </div>
                          </div>
                          </td>
                           <td  class="editbtn" >
                           <a href="#"><i class="fa fa-pencil" aria-hidden="true" onclick="editcity();"></i></a></td>
                         </tr>
                         <tr class="blank_row"></tr>
                       <tr class="border_bottom">
                         <td class="label1" >Pincode</td>
                         <td > : </td>
                         <td> </td>

                         <td class="info text-center" style="font-weight:bold;" id="emppincode"></td>
                         <td  class="editbtn"><a href="#"><i class="fa fa-pencil" aria-hidden="true" onclick="myFunction5();"></i></a></td>
                       </tr>
                       <tr class="blank_row">
                         </tr>
                       <tr  class="border_bottom">
                          <td class="label1" >Email</td>
                          <td > : </td>
                          <td> </td>
                          <td class="info text-center" style="font-weight:bold;" id="empemailid"></td><td  class="editbtn" >
                            <a href="#"><i class="fa fa-pencil" aria-hidden="true"  onclick="myFunction6();"></i></a></td>
                        </tr>
                       <tr class="blank_row">
                         </tr>
                       <tr  class="border_bottom">
                         <td class="label1" >Contact Number</td>
                         <td > : </td>
                         <td> </td>
                         <td class="info text-center" style="font-weight:bold;" id="empcontactno"></td>
                         <td  class="editbtn" ><a href="#"><i class="fa fa-pencil" aria-hidden="true" onclick="myFunction7();"></i></a></td>
                       </tr>
                       <tr class="blank_row">
                         </tr>
                         <tr  class="border_bottom">
                            <td class="label1" >Address</td>
                            <td > : </td>
                            <td> </td>
                            <td class="info text-center" style="font-weight:bold;" id="empaddress"></td>
                            <td  class="editbtn" ><a href="#"><i class="fa fa-pencil" aria-hidden="true" onclick="myFunction8();"></i></a></td>
                          </tr>
                         <tr class="blank_row">
                           </tr>
                           <tr><td class="label1"></td>
                             <td ></td>
                             <td ></td>
                             <td ><button id="updateemp1" type="submit" class="btn btn-primary" style="float: right;margin-right:10px" value="update" >Save </button></td>
                             <td ><button id="cancelupdate1" type="reset" class="btn btn-default"  value="cancel"
                                onclick="window.location.reload();">Cancel</button></td>
                           </tr>
                 </table>
               </div>

               </div>
             </div>
               <!-- </div> -->


               <div id="sectionC" class="tab-pane fade">
                 <div class="row" id="corporateDetailTabDiv">
                   <div class="col-md-1"></div>
                   <div class="col-md-10">
                  <table>

                   <tr class="blank_row"></tr>

                          <tr class="border_bottom"><td class="label1"> Joining Date</td><td > : </td><td> </td>
                            <td class="info text-center" style="font-weight:bold;" id="empjdate"></td>
                            <td class="editbtn"><a href="#"><i class="fa fa-pencil" aria-hidden="true" onclick="myFunction9();"></i></a></td>
                            </tr>

                       <tr class="blank_row"></tr>

                          <tr class="border_bottom"><td class="label1"> Department</td><td > : </td><td></td>
                           <td class="info text-center">
                             <div class="row">
                                <div class="col-sm-1"></div>

                                  <div class="col-sm-10">
                                    <select class="form-control select2" style="width:100%;font-weight:bold;" name="empdepartment"   id="empdepartment" disabled="true"  >
                                    </select>
                                  </div>

                                  <div class="col-sm-1"></div>
                           </div>
                           </td>

                           <td class="editbtn"><a href="#"><i class="fa fa-pencil" aria-hidden="true" onclick="editdepartment();"></i></a></td></tr>
                        
                           <tr class="blank_row"></tr>

                         <tr class="border_bottom"><td class="label1"> Designation</td><td > : </td><td></td>

                           <td class="info text-center" >

                             <div class="row">
                             <div class="col-sm-1"></div>
                             <div class="col-sm-10">
                             <select class="form-control select2" style="width:100%;font-weight:bold;" name="empdesignation" id="empdesignation" disabled="true">
                             </select>
                           </div>

                           <div class="col-sm-1"></div>

                         </div>
                           </td>
                           <td  class="editbtn" ><a href="#"><i class="fa fa-pencil" aria-hidden="true" onclick="editdesignation();"></i></a></td>
                         </tr>


                         <tr class="blank_row"></tr>
                           <tr>
                             <td class="label1" ></td>
                             <td></td><td></td>
                             <td><button id="updateemp2" type="submit" class="btn btn-primary" style="float:right;margin-right:10px" value="update" >Save </button></td>
                             <td><button id="cancelupdate2" type="reset" class="btn btn-default"  value="cancel"
                              onclick="window.location.reload();">Cancel</button></td>
                           </tr>
                 </table>
                 </div>
               </div>

             </div>




                <div id="sectionD" class="tab-pane fade">
                 <div class="row" id="uploadProfileTabDiv">
                   <div class="col-md-1"></div>
                   <div class="col-md-10">
                      <form name="upload_img" enctype="multipart/form-data" id="upload_img">
                        <div class="row">
                        <div class="col-sm-6">
                          <br>
                          <div class="upload-image">
                            <input type="file" name="file1" id="imgname1" value="Upload Image"/>
                            <span id="img1"></span>
                          </div>
                        </div>
                          <br>
                        <div class="col-sm-6">
                          <div class="img-responsive" id="profile1"></div>
                        </div>
                        </div>
                        <div class="row"><div class="col-sm-12"></div></div>
                          <div class="row" style="float:right">
                          <button id="updateemp3" type="button" class="btn btn-primary"  value="update" >Update</button>
                          <button id="cancelupdate3" type="reset" class="btn btn-default"
                          onclick="window.location.reload();">Cancel</button>
                        </div>
                      </form>
              
                    </div>
                   </div>
                </div>

             <div id="sectionE" class="tab-pane fade">
               <br>
               <!-- <class="btn btn-primary btn-lg pull-left"  data-toggle="modal" data-target="#exampleModal" > EDUCATION</button> -->

               <div class="row" id="educationDetailTabDiv">
                 <div class="col-md-1"></div>
                 <div class="col-md-10">
                <div class="col-sm-4">
               <b>  EDUCATION DETAILS</b>
               </div>
               
 <button type="button" class="btn btn-link btn-lg pull-right"  data-toggle="modal" data-target="#exampleModal" >Add New Education</button>
 <br>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
 <div class="modal-content">
 <div class="modal-header">
   <button type="button" class="close-outside pull-right" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
   <h5 class="modal-title" id="exampleModalLabel"><b>EDUCATION DETAILS</b>
     <!-- <button type="button" onclick="deleteEmpDetails();" id="deletebtn" style="display:none" class="btn btn-link pull-right">DELETE INFO</button></h5> -->
 </div>
 <div class="modal-body">
   <form id="education" name="education" class="noteform"  method="POST">
     <input type="hidden" id="educationid" name="educationid"/>

     <div  class="form-group">
       <label for="recipient-name" class="col-form-label">Degree:<font color="red">*<span id="d"></span></font></label>
       <input type="text" class="form-control" name="degreename" id="degreename" placeholder=" Degree"  autocomplete="of" required/>
     </div>
     <div class="form-group">
       <label for="message-text" class="col-form-label">Specialization:</label>
       <input type="text" class="form-control" name="specialization" id="specialization" placeholder="Specialization" autocomplete="off"/>
     </div>
     <div class="form-group">
       <label for="recipient-name" class="col-form-label">Passing Out Year:<font color="red">*<span id="p"></span></font></label>
       <!-- <input type="text" class="form-control"  name="yearofpassing" id="yearofpassing"  placeholder="Passing Out year" autocomplete="of" required/> -->
       <select class="form-control select2" name="yearofpassing" id="yearofpassing"  placeholder="Passing Out year"  style="width:100%;padding-top:20px;"  required>
         <option value="select year"> Select Year </option>
       </select>
     </div>
     <div class="form-group">
       <label for="message-text" class="col-form-label">University:<font color="red">*<span id="u"></span></font></label>
       <input type="text" class="form-control"  name="university" id="university"  placeholder="University" autocomplete="of" required/>
     </div>

     <div class="form-group"  >
       <label for="message-text" class="col-form-label">CGPA/Marks:<font color="red">*<span id="c"></span></font></label>
       <input type="text" class="form-control"  name="cgpa" id="cgpa" placeholder="CGPA/MARKS" autocomplete="of" onkeypress="return isNumberKey(event);"required/>
     </div>
   </form>

   <div class="modal-footer">
     <button type="button" id="addeducationinfo" class="btn btn-primary" onclick="submitContactForm();" >Add</button>
     <button type="submit" style="display:none" id="update_empEduBtn" onclick="submitContactForm();" class="btn btn-primary">Update</button>
     <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetmodal();">Close</button>
   </div>
 </div>
 </div>
 </div>
 </div>
 <br>
 <div  id="showeducationinfo">
 </div>
 <div class="row">
 <div class="col-sm-12"></div>
 </div>
 <button type="button" class="btn btn-default" style="float:right" onclick="window.location.reload()">Cancel</button>
</div>
</div>

  </div>

<div id="sectionH" class="tab-pane fade">
  <br>
  <div class="row" id="BankDetailTabDiv">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="col-sm-4">
  <b> SALARY ACCOUNT BANK DETAILS </b>
  </div>
  <button type="button" id="addBankInfoBtn" class="btn btn-primary pull-right" onclick="openForm($('#empid').val());">Account Details</button>
<br>

      <div class="row" id="AccountFormDiv" style="display:none">

      <form role="form" id="AccountForm"   method="POST">
        <div class="col-md-6" >
          <input type="hidden" id="BankInfoId" name="BankInfoId"/>

        <div class="box-body">
          <div class="form-group">
            <label for="EmpFullName">Account Holder Name<font color="red">*</font></label>
            <input type="text" class="form-control" name="EmpFullName" id="EmpFullName" placeholder="Enter Employee Full Name " autocomplete="off"required>
            <span id="Error_ipEmpFullName"></span>
          </div>
          <div class="form-group">
            <label for="bankName">Bank Name<font color="red">*</font></label>
            <input type="text" class="form-control" name="bankName" id="bankName" placeholder="Enter Bank Name" autocomplete="off"required>
            <span id="Error_ipBName"></span>
          </div>
          <div class="form-group">
            <label for="branchName">Branch Name<font color="red">*</font></label>
            <input type="text" class="form-control" id="branchName" name="branchName" placeholder="Enter Branch Name" autocomplete="off"required>
            <span id="Error_ipBranch"></span>
          </div>
          <div class="form-group">
            <label for="bifsc">IFSC Code<font color="red">*</font></label>
            <input type="text" class="form-control" id="bifsc" name="bifsc" placeholder="Enter IFSC Code" autocomplete="off" required>
            <span id="Error_ipIFSC"></span>
          </div>

          <div class="form-group">
            <label for="bname">Account Number <font color="red">*</font></label>
            <input type="text" class="form-control" id="AccNumber" name="AccNumber" onkeypress="return isNumberKey(event);" placeholder="Enter Account Number" autocomplete="off"required>
            <span id="Error_ipAcc"></span>

          </div>

        </div>
        <div class="box-footer">
          <button type="button" class="btn btn-primary" onclick="submitAccountInfo($('#empid').val());">Save</button>
          <button id="cancelupdate" type="reset" class="btn btn-default"  value="cancel"
             onclick="goback();">Cancel</button>
        </div>
    </div>
      </form>
    </div>

<br>
<div class="row" id="showAccountInfoDiv">
  <div  id="showAccountInfo">
 <div class="col-sm-6">
 <ul class="list-group">
   <li class="list-group-item ">Account Holder Name:&nbsp; <span id="ahnSpan"></span></li>
   <li class="list-group-item"> Bank Name:&nbsp;<span id="banknmSpan"></span></li>
   <li class="list-group-item">Branch Name:&nbsp; <span id="branchnmSpan"></span></li>
   <li class="list-group-item">IFSC Code:&nbsp; <span id="ifsccodeSpan"></span></li>
   <li class="list-group-item">Account Number:&nbsp; <span id="accnumSpan"></span></li>
 </ul>
</div>

    </div>
  </div>
</div>
</div>
</div>


<div id="sectionI" class="tab-pane fade">
  <br>
  <div class="row" id="PFDetailTabDiv">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="col-sm-4">
  <b>PF AND UAE ACCOUNT DETAILS</b>
  </div>
  <button type="button" id="addPFInfoBtn" class="btn btn-primary pull-right" onclick="openPFform($('#empid').val());">Add Details</button>
<br>
      <div class="row" id="PFInfoAccFormDiv" style="display:none">
      <form role="form" id="PFInfoAccForm"   method="POST">
        <div class="col-md-6" >
          <input type="hidden" id="PFInfoAccId" name="PFInfoAccId"/>

        <div class="box-body">
          <div class="form-group">
            <label for="EmpFullName">Employee PF Number<small>(Provident Fund Number)</small><font color="red">*</font></label>
            <input type="text" class="form-control" name="pfnum" id="pfnum" placeholder="Enter Employee PF Number " autocomplete="off"required>
            <span id="Error_ipEmpPFnum"></span>
          </div>
          <div class="form-group">
            <label for="bankName">Employee UAE Number<small>(Universal Account Number)</small> <font color="red">*</font></label>
            <input type="text" class="form-control" name="uaenum" id="uaenum" placeholder="Enter Employee UAE Number" autocomplete="off"required>
            <span id="Error_ipUAEnum"></span>
          </div>

        </div>
        <div class="box-footer">
          <button type="button" class="btn btn-primary" onclick="submitPFAccountInfo($('#empid').val());">Save</button>
          <button id="cancelupdate" type="reset" class="btn btn-default"  value="Cancel"
             onclick="gobackInPFForm();">Cancel</button>
        </div>
    </div>
      </form>
    </div>

<br>
<div class="row" id="showPFInfoRowDiv">
  <div  id="showPFInfo">
 <div class="col-sm-6">
 <ul class="list-group">
   <li class="list-group-item ">Employee PF Number:&nbsp; <span id="pfnumSpan"></span></li>
   <li class="list-group-item">Employee UAE Account Number:&nbsp; <span id="UAEaccnumSpan"></span></li>
 </ul>
</div>

    </div>
  </div>
</div>
</div>
</div>

             <div id="sectionF" class="tab-pane fade">
                 <br>
                 <div class="row" id="experienceDetailTabDiv">
                   <div class="col-md-1"></div>
                   <div class="col-md-10">

               <div class="col-sm-4">
               <b>  EXPERIENCE DETAILS </b>
               </div>
 <button type="button" class="btn btn-link btn-lg pull-right"  data-toggle="modal" data-target="#modal-default" >Add New Experience</button>
 <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close-outside pull-right" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><b>Experience Details</b>
   <!-- <button type="button" onclick="deleteEmpExpDetails();" id="deleteExpBtn" style="display:none" class="btn btn-link pull-right">DELETE INFO</button></h4> -->
       </div>
         <div class="modal-body">
       <form id="experience" name="experience" class="tagForm"  method="POST">
         <!-- <input type="hidden" id="experienceid" name="experienceid"/> -->
       <div class="modal-body">
           <input type="hidden" id="experienceid" name="experienceid"/>

         <div  class="form-group">
           <label for="company-name" class="col-form-label">Employeer Name:<font color="red">*<span id="company"></span></font></label>
           <input type="text" class="form-control" name="employeername" id="employeername" placeholder="Employeer Name/Company Name"  autocomplete="of" required/>
         </div>
         <div  class="form-group">
           <label for="year" class="col-form-label">No of Year:<font color="red">*<span id="year"></span></font></label>
           <input type="text" class="form-control" name="Noofyear" id="Noofyear" placeholder="No Of Year" maxlength="2" onkeypress="return isNumberKey(event);" autocomplete="of" required/>
         </div>
         <div  class="form-group">
           <label for="month" class="col-form-label">No of Month:<font color="red">*<span id="year"></span></font></label>
           <select class="form-control select2" name="Noofmonth" id="Noofmonth" style="width:100%" placeholder="No Of Month"  autocomplete="of" required/>
           <option vatlue=""> </option>
           <option> 0 </option>
           <option> 1 </option>
           <option> 2 </option>
           <option> 3 </option>
           <option> 4 </option>
           <option> 5 </option>
           <option> 6 </option>
           <option> 7 </option>
           <option> 8 </option>
           <option> 9 </option>
           <option> 10 </option>
           <option> 11 </option>
           <!-- <option> 12 </option> -->
         </select>
         </div>
       </div>
       <div class="modal-footer">
         <button type="submit" id="emexperiencedetails" class="btn btn-primary">Add</button>
         <button type="submit" style="display:none" id="update_empExpBtn" class="btn btn-primary">Update</button>
         <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetexperiencemodal();">Close</button>
       </div>
     </form>
     </div>
       </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
 <br>
 <br>
 <div class="row">
   <div  id="showexperienceinfo">
   </div>
 </div>
 <button type="button" class="btn btn-default" style="float:right" onclick="window.location.reload()">Cancel</button>
</div>
</div>

 </div>
             <div id="sectionG" class="tab-pane fade">
               <br>
               <div class="row" id="skillDetailTabDiv">
                 <div class="col-md-1"></div>
                 <div class="col-md-10">
              <div class="col-sm-4">
             <b>SKILLS DETAILS </b>
             </div>
 <button type="button" class="btn btn-link btn-lg pull-right"  data-toggle="modal" data-target="#modalAddNewSkill" >Add New Skill</button>
<br>
 <div class="modal fade" id="modalAddNewSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close-outside pull-right" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title"><b>Skill Details</b>
 <!-- <button type="button" onclick="deleteEmpSkill();" id="deleteskillBtn" style="display:none" class="btn btn-link pull-right">DELETE SKILL</button></h4> -->

     </div>
       <div class="modal-body">
     <form id="addSkillsForm" name="addSkillsForm" class="tagForm"  method="POST">
       <!-- <input type="hidden" id="experienceid" name="experienceid"/> -->

     <div class="modal-body">
         <input type="hidden" id="skillid" name="skillid"/>

       <div  class="form-group">
         <label for="skill_ip" class="col-form-label">Skill:<font color="red">*<span id="Skill_validateSpan"></span></font></label>
         <input type="text" class="form-control" name="skill_ip" id="skill_ip" placeholder="Skill Name"  autocomplete="off" required/>
       </div>

     </div>
     <div class="modal-footer">
       <button type="submit" id="add_empskillsBtn" class="btn btn-primary">Add</button>
       <button type="submit" style="display:none" id="update_empskillsBtn" class="btn btn-primary">Update</button>
       <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetSkillsmodal();">Close</button>

     </div>

   </form>

   </div>
     </div>
   <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
 </div>
 <br>
                 <div class="row">
                   <div class="col-sm-12" id="showSkillsinfo" >
                     <!-- <ul class="list-group">
                       <li class="list-group-item "></li>

                     </ul> -->
                   </div>
                 </div>
                 <button type="button" class="btn btn-default" style="float:right" onclick="window.location.reload()">Cancel</button>

                 </div>
               </div>

               </div>
<!-- EndTabs -->

           </div>
<!-- Tab Content Div End -->
       </div>
       <!-- Bs-ExampleDiv End -->

 </div>
 <!-- End Box Body Div -->
 </div>
 <!-- End of Box Div -->

 </div>
</div>
</section>
</div>

  <!-- /.content -->
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>
<?php include "RightSidebar.php"; ?>

<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script  src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Datatables -->
<script src="../datatables/jquery.dataTables.min.js"></script>
<script src="../datatables/dataTables.bootstrap4.min.js"></script>
<script src="../datatables/dataTables.buttons.min.js"></script>
<script src="../datatables/buttons.bootstrap4.min.js"></script>
<script src="../datatables/jszip.min.js"></script>
<script src="../datatables/pdfmake.min.js"></script>
<script src="../datatables/vfs_fonts.js"></script>
<script src="../datatables/buttons.html5.min.js"></script>
<script src="../datatables/buttons.print.min.js"></script>
<script src="../datatables/buttons.colVis.min.js"></script>
<!-- SlimScroll -->
<script  src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script  src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script  src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<script  src="../dist/js/adminlte.min.js"></script>
<script  src="../js/validate.js"></script>
<script  src="../js/additional-methods.js"></script>

<!-- AdminLTE for demo purposes -->
<script  src="../js/addemployee.js"></script>
<script  src="../js/edit_employeefunctions.js"></script>
<script src="../js/empPFInfo.js"></script>
<script  src="../dist/js/demo.js"></script>
<script  src="../js/state.js"></script>
<script  src="../js/validateemp.js"></script>


<!-- <script  src="../js/validateeducationinfo.js"></script> -->
<script src="../js/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script  src="../js/experiencedetails.js"></script>
<script  src="../js/EmpBankAccount.js"></script>


<script>
$(document).ready(function(){
// $("#scountry2").select2('destroy');
$("#myTab a").click(function(e){
e.preventDefault();
$(this).tab('show');
});
$('#exampleModal').on('hidden.bs.modal', function () {
  $(this).find("input,select2").val('').end();

});

});

function loadBankDetails(){
  fetch_BankAccountDetails($('#empid').val());
}
function loadPFDetails(){
 fetch_PFDetails($('#empid').val());
}

function loadEducationDetails(){
fetch_educationdetails();
}
function loadExperienceDetails(){
fetch_experiencedetails();
}
function loadEmpSkillsDetails(){
  fetch_SkillsDetails();
}


function openForm(empid){
  // alert(empid);
   $("#showAccountInfoDiv").hide();
   $("#AccountFormDiv").show();
   fetch_BankAccountDetails(empid);
}

function openPFform(empid){
  $("#showPFInfoRowDiv").hide();
     $("#PFInfoAccFormDiv").show();
     fetch_PFDetails(empid);

}
</script>
</body>
</html>
<?php
}
else {
header("Location:login.php");
}
?>
