// alert('working');
fetch_department();
fetch_designation();
fetch_employees();
fetch_departmentemp();
fetch_designationemp();
// fetch_educationdetails();
// fetch_experiencedetails();

function checkEmailAvailability(){
  
}

function ValidatePAN(){
  var panVal = $('#panNum').val();
  if(panVal)
  {
  var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
  if(regpan.test(panVal))
  {
    $("#invalidPAN__ip").html(" ");
    }
   else {
    $("#invalidPAN__ip").html("<font color='red'>Invalid Pan Card number</font>");
    $('#panNum').val('');
  }
}
}

$("#scountry").select2({
  placeholder: "Select Country",
   allowClear: true,
});

$("#sstate").select2({
  placeholder: "Select State",
   allowClear: true,
});


$("#Noofmonth").select2({
  placeholder: "Select No of Month",
   allowClear: true,
});

$("#scity").select2({
  placeholder: "Select City",
   allowClear: true,
});

  $('#scountry2').select2({
    placeholder: "Select Country",
    allowClear: true,
    });

    $('#sstate2').select2({
      placeholder: "Select State",
      allowClear: true,
    });

    $('#scity2').select2({
      placeholder: "Select City",
        allowClear: true,
        });

        $('#empdepartment').select2({
          // placeholder: "Select department",
          allowClear: true,
        });

        $('#empdesignation').select2({
          // placeholder: "Select designation",
          allowClear: true,
        });

        $('#department').select2({
          placeholder: "Select Department",
          allowClear: true,
        });

        $('#designation').select2({
          placeholder: "Select Designation",
          allowClear: true,
        });

        $("#yearofpassing").select2({
           allowClear: true,
        });


        var a = (new Date()).getFullYear();
        for(y = a; y >=1947 ; y--) {
                var optn = document.createElement("OPTION");
                optn.text = y;
                optn.value = y;
                document.getElementById('yearofpassing').options.add(optn);
        }
function new_emp() {
  $('#nodata').hide();
$('#new').show();
$('#emp').hide();
$('#emp1').hide();
$('#update').hide();
$('#new1').show();
}

function fetch_department(){
  $.ajax({
    url:"../src/fetch_department.php",
    method:"POST",
    success:function(data){
      $("#department").html(data);
         // document.getElementById('empdepartment').innerHTML =data;
      // $("#empdepartment").html(data);
    }
  });
}
function fetch_departmentemp(){

  $.ajax({
    url:"../src/fetch_department.php",
    method:"POST",
    success:function(data){
      // $("#department").html(data);
         document.getElementById('empdepartment').innerHTML =data;
      // $("#empdepartment").html(data);
    }
  });
}
function getGrade(param){
  $("#getmarks").show();
  if(param === 'Course Requires a pass')
  $("#getmarks").hide();
}
function fetch_designation()
{
  $.ajax({
    url:"../src/fetch_designation.php",
    method:"POST",
    success:function(data){
      $("#designation").html(data);
          // $("#empdesignation").html(data);
          // document.getElementById('empdesignation').innerHTML =data;
    }
  });
}
function fetch_designationemp(){
  $.ajax({
    url:"../src/fetch_designation.php",
    method:"POST",
    success:function(data){
      // $("#designation").html(data);
          // $("#empdesignation").html(data);
          document.getElementById('empdesignation').innerHTML =data;
    }
  });
}


function fetch_employees(){
    $.ajax({
      url:'../src/fetchEmployees.php',
      method:'POST',
      success:function(data){
        response=JSON.parse(data);
        var count=Object.keys(response).length;
        if(count>0){
            for (var i = 0; i < count; i++){
            if(response[i]['designation'] === null)
            {
              response[i]['designation']='-';
            }
            if(response[i]['department'] === null)
            {
              response[i]['department']='-';
            }
            if(response[i]['img'] === '')
            {
              var img='<img class="img-circle" src="../images/user.png" alt="" style="float:left;width:40px;height:40px;margin-right:10px;">';
            }
            else {
              var img='<img class="img-circle" src="../images/'+response[i]['img']+'" alt="" style="float:left;width:40px; height:40px;margin-right:15px;">';
            }
            var str = response[i]['name'];
            var resultantstr = str.replace("-", " ");

            $('#loadtable').append('<tr><td>'+img+'<big>'
            +resultantstr+'</big><p><small>'
            +response[i]['designation']+'</small></p></td><td class="text-center"> '
            +response[i]['department'] +'</td><td class="text-center">'
            +response[i]['Joining_date'] +'</td><td class="text-center">'
            +response[i]['address'] + '</td><td class="text-center"><div class="btn-group"><button type="button" class="label label-primary pull-right" title="Edit Employee" name="edit" onClick="edit_emp('+response[i]['Empid']+');"><i class="fa fa-edit"></i></button><button type="button" name="remove" class="label label-danger pull-right" title="Delete Employee"  onClick="remove_emp('+response[i]['Empid']+');"><i class="fa fa-trash"></i></button></div></td></tr>');
          }
          $('#tbldata').show();
      $("#datble").DataTable({
        bPaginate: $('#datble tbody tr').length>10,
        order: [],
        columnDefs: [ { orderable: false, targets: [0,1,2,3,4] } ],
        dom: 'Bfrtip',
            buttons: [
              {
                 extend: 'collection',
                 text: 'Export',
                 buttons: ['copy', 'excel', 'pdf','print']
              }
           ]
         });
         // table.buttons().container()
         // .appendTo( '#datble_wrapper .col-md-6:eq(0)' );
      }
      else {
          $('#nodata').show();
        }
      }
    });
  }


$('#new1').on('click', function(event) {
  event.preventDefault();
  // alert("inAdd");
    var formData = new FormData(this.form);
    var input_value = document.getElementById("imgname").value;
    var file_data = $("#imgname").prop("files")[0];
    formData.append('imgname', file_data);

  $.ajax({
    url:"../src/addEmployee.php",
    method:"POST",
    data:formData,
    cache:false,
   contentType: false,
     processData: false,
    success:function(data){
      response=JSON.parse(data);
      if(response['message'] === true){
        window.location.reload();
      }
      else
      alert("Fill All Details Currrectly");
    }
  });
});


$('#update').on('click', function(){
  var empid = $("#empid").val();
  var fname1=  document.getElementById("fnameemp").value;
  var lname1=  document.getElementById("lnameemp").value;
  var gender1 =document.getElementById("Male1").checked;
var gender2 =document.getElementById("Female1").checked;
var gender3 =document.getElementById("Others1").checked;
var empPan = document.getElementById('ePan').value;
if(gender1 === true)
  var gender =document.getElementById("Male1").value;
else if(gender2 === true)
var gender =document.getElementById("Female1").value;
else
var gender =document.getElementById("Others1").value;
var birthdate1=  document.getElementById("bdate").value;

// alert(empPan);
flag=0;
if(fname1!== "" && lname1!== "" && gender!== "" && birthdate1!== "" && empPan!== ""){
  var regex = /^[a-zA-Z ]{2,30}$/;
  var PanRegex = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
  if (!(regex.test(fname1))){
       document.getElementById("fnameemp").value=" ";
       $("#validatefn").html('Please Enter Valid Name');
       setTimeout(function(){
         $("#validatefn").html(" ");
       },2000);
       flag=1;
     }
     if (!(regex.test(lname1))){
          document.getElementById("lnameemp").value=" ";
          $("#validateln").html('Please Enter Valid Name');
          setTimeout(function(){
            $("#validateln").html(" ");

          },2000);
          flag=1;
        }
          if(!(PanRegex.test(empPan))){
            document.getElementById("ePan").value=" ";
            $("#validatePan").html('Please Enter Valid PAN');
            setTimeout(function(){
              $("#validatePan").html(" ");
            },2000);
            flag=1;
          }

 if(flag == 0){
  $.ajax({
    url:"../src/updateEmployee.php",
    method:"POST",
    data:{editempid:empid,editfname:fname1,editlname:lname1,editgender:gender,editbirthdate:birthdate1,empPan:empPan},
    success:function(data){
      response=JSON.parse(data);
      if(response['update'] ===  true){
        var msg= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee Info updated successfully</strong></font></div>";
        $('#msg').html(msg);

        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
        // window.location.reload();
      }
      else
      alert("Error");
    }
  });
}
}
else {
  alert("all fields are required");
}
});

  function isNumberKey(event) {
     var charCode = (window.event) ? event.keyCode  : event.which ;
    if (charCode > 31 && (charCode < 48|| charCode > 57) && charCode!=46 )
    return false;
    return true;
}
$('#updateemp1').on('click', function(){
  var empid = $("#empid").val();
  var country=  document.getElementById("scountry2").value;
  var state=  document.getElementById("sstate2").value;
  var city=  document.getElementById("scity2").value;
  var pincode1=  document.getElementById("pincodeemp").value;
  var email=  document.getElementById("emailidemp").value;
  var contactno=  document.getElementById("contactnoemp").value;
  var address=  document.getElementById("addressemp").value;
  flag=0;

  if(pincode1!== " " && contactno!== " " && country!== " " && state!== " " && city!== " "  && email!== " "  && address!== " " ){
    var regex =/[1-9][0-9]{5}/;
    if (!(regex.test(pincode1))){
      document.getElementById("pincodeemp").value="";
         $("#validatepin").html('please enter valid pincode');
         setTimeout(function(){
           $("#validatepin").html(" ");
         },2000);
         flag=1;
       }
       var mobile=/(7|8|9)\d{9}/;

       if (!(mobile.test(contactno))){
        document.getElementById("contactnoemp").value="";
            $("#validateno").html('please enter valid contact number');
            setTimeout(function(){
              $("#validateno").html(" ");
            },2000);
            flag=1;
          }

  if(flag == 0){
  $.ajax({
    url:"../src/updateEmployeeContactDetails.php",
    method:"POST",
    data:{editempid:empid,editcountry:country,editstate:state,editcity:city,editpincode:pincode1,editemail:email,editcontactno:contactno,editaddress:address},
    success:function(data){
      response=JSON.parse(data);
      if(response['update'] ===  true)
      {
        var msg= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee Info updated successfully</strong></font></div>";
        $('#msg').html(msg);

        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
      }
      else
      alert("Error");
    }
  });
}
}
else {
  alert("all fields are required");
}
});

$('#updateemp2').on('click', function(){

  var empid1= $("#empid").val();
  var empjoindate1=  document.getElementById("joindate").value;
  var empdepartment1=  document.getElementById("empdepartment").value;
  var empdesignation1=  document.getElementById("empdesignation").value;
  if(empjoindate1 === "" ){
    alert("All Fields are required");
  }
  else{
  $.ajax({
    url:"../src/updateEmployeecompanydetails.php",
    method:"POST",
    data:{editempid:empid1,editjoindate:empjoindate1,editdept:empdepartment1,empdesg:empdesignation1},
    success:function(data){
      response=JSON.parse(data);
      if(response['update'] ===  true)
      {
        var msg= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee Info updated successfully</strong></font></div>";
        $('#msg').html(msg);

        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
      }
      else
      alert("Error");
    }
  });
}
});

$('#updateemp3').on('click', function(){
  var formData = new FormData(this.form);
  var empid= $("#empid").val();
  var input_value = document.getElementById("imgname1").value;
  var file_data = $("#imgname1").prop("files")[0];
  formData.append('imgname1', file_data);
  formData.append('editempid', empid);

  $.ajax({
         url: "../src/updateEmployeeProfile.php",
         type: "POST",
         data:formData,
         cache: false,
         contentType: false, //must, tell jQuery not to process the data
         processData: false,
    success:function(data){
      response=JSON.parse(data);
      if(response['update'] ===  true)
      {
        var msg= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee Info updated successfully</strong></font></div>";
        $('#msg').html(msg);

        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
      }
      else
      alert("Error");
    }
  });
});

function clear_all(){
  var x = document.getElementById("loadtable").rows.length;
  if(x){
    $('#emp').show();
    $('#new').hide();
    $('#emp1').show();
    $('#emp_reg').trigger("reset");
  }
  else{
    $('#nodata').show();
    $('#new').hide();
  }
}

function remove_emp(param){
  var response=[];
            $.ajax({
            url:"../src/remove.php",
            method:"POST",
            data:({id:param,tblName:'Employees',colName:'EmpId'}),
            success:function(data)
            {
             response=JSON.parse(data);
              if(response['true'])
              {
                $("#"+param).closest('tr').remove();
                window.location.reload();
            }
          }
            });
  }

          function edit_emp(param){

            $('#editemp').show();
            $('#new1').hide();
            $('#update').show();
            $('#emp').hide();
            $('#emp1').hide();
            $('#empid').val(param);
            $("#empidInBAccForm").val(param);
            $.ajax({
            url:"../src/edit_emp.php",
            method:"POST",
            data:({Emp_id:param}),
            // dataType:'json',
            success:function(data){
                response=JSON.parse(data);
              var a=(response['name']).split("-");
              var a1=a[0];
              var a2= a[1];
              var selectcountry = response['country'];

                document.getElementById('fn').innerHTML ="<span id='validatefn' style='color:red;'></span><input type='text' class='removeborder' name='fnameemp' id='fnameemp' value='"+a1+" '  readonly  required > ";
                document.getElementById('ln').innerHTML ="<span id='validateln' style='color:red;'></span><input type='text' class='removeborder' name='lnameemp'  id='lnameemp' value='"+a2+" ' readonly required>";
                document.getElementById('empbdate').innerHTML ="<input type='date' id='bdate' name='birthdate' value='"+response['birthdate']+" ' readonly required>";
                document.getElementById('empPan').innerHTML ="<span id='validatePan' style='color:red;'></span><input type='text' class='removeborder' id='ePan' name='ePan' value='"+response['empPan']+"' readonly required>";
                var selectgender = response['gender'];

                if(selectgender == 'Male')
                 document.getElementById("Male1").checked = true;
                 else if(selectgender == 'Female')
                 document.getElementById("Female1").checked = true;
                 else
                 document.getElementById("Others1").checked = true;
                var empbdate =response['birthdate'];
                document.getElementById('bdate').value = empbdate;

                $("#scountry2").append("<option value=" + response['country'] + " selected=selected>" + response['country'] + "</option>");
                $("#sstate2").append("<option  value='"+response['state']+"' selected=selected >"+response['state']+"</option>");
                $("#scity2").append("<option  value='"+response['city']+"' selected=selected >"+response['city']+"</option>");
                document.getElementById('emppincode').innerHTML ="<span id='validatepin' style='color:red;'></span><input type='text' class='removeborder' name='pincodeemp' id='pincodeemp' value='" + response['pincode'] + " ' readonly required>";
                document.getElementById('empemailid').innerHTML ="<input type='email'  class='removeborder' name='emailidemp' id='emailidemp' value='" + response['useremail'] + " ' readonly required>";
                document.getElementById('empcontactno').innerHTML ="<span id='validateno' style='color:red;'></span><input type='text' class='removeborder' name='contactnoemp' id='contactnoemp' value='" + response['userphone'] + " ' readonly required>";
                document.getElementById('empaddress').innerHTML ="<input type='text' class='removeborder' name='addressemp' id='addressemp' value='" + response['Addr'] + " ' readonly required>";
                document.getElementById('empjdate').innerHTML ="<input type='date'  id='joindate' name='joining_date' value='"+response['Joiningdate']+" ' readonly required>";
                var empjdate =response['Joiningdate'];
                document.getElementById('joindate').value = empjdate;
                // DeptId DesigId
                $("#empdepartment").append("<option value=" + response['DeptId'] + " selected=selected>" + response['DeptName'] + "</option>");
                $("#empdesignation").append("<option value=" + response['DesigId'] + " selected=selected >" + response['DesigName'] + "</option>");
                var x = response['ProfilePic'];
                  var filename = x.replace(/^.*[\\\/]/, '');

                    // $("#imgname1").val(filename);
                  // $("#img1").html(filename);

                  var dummyName = "EmpProfile.jpeg";
                  $("#img1").html(dummyName);
                  // $("#img1").html("EmpProfile.jpeg");
                 
                  document.getElementById('profile1').innerHTML = '<img src= "../images/'+filename+'" class="img-responsive"  style="width:30%;height:auto;">';
                  document.getElementById('profile2').innerHTML = '<img src= "../images/'+filename+'"  class="img-circle"  style="height:100px;width:120px;padding-bottom:10px;">';
                  document.getElementById('empname').innerHTML ="<input type='text' class='removeborder' name='empname' id='empname' style='position: relative;top:20px;left:10px;font-weight:bold' value='"+a1+" "+a2+" ' readonly required >";
            }
            });
          }

          $("input[name=file]").change(function () {
              if (this.files && this.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function (e) {
                      var img = $('<img>').attr('src', e.target.result);
                      $('.img-responsive').html(img);
                  };

                  reader.readAsDataURL(this.files[0]);
              }
              $("#img").html(' ');
          });
                    $("input[name=file1]").change(function () {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                var img1 = $('<img>').attr('src', e.target.result);
                                // $('.img-responsive').html(img1);
                                $(".img-responsive").html(img1);
                              };

                            reader.readAsDataURL(this.files[0]);
                        }
                        $("#img1").html(' ');
                    });

function validate(param){
    var regex = /^[a-zA-Z ]{2,30}$/;
    var ctrl =  document.getElemetnById(param);

    if (regex.test(ctrl.value)) {
        return true;
    }
    else {
        return false;
    }
}


function submitContactForm(){

  var degreename = $('#degreename').val();
     var specialization = $('#specialization').val();
     var yearofpassing = $('#yearofpassing').val();
     var university = $('#university').val();
        var cgpa = $('#cgpa').val();
        var empid1 = $('#empid').val();
        var eduid = $('#educationid').val();

if(degreename === ""  ||  university==="" || cgpa === "")
  alert("All fields are required");
else if(yearofpassing === "select year" )
  alert("Select Passout Year");

else {
  $.ajax({
   url: "../src/educationinfo.php",
   type: "POST",
   data:{degreename:degreename,specialization:specialization,yearofpassing:yearofpassing,university:university,cgpa:cgpa,empid1:empid1,eduid1:eduid} ,
   success: function(data){
     response=JSON.parse(data);
     if(response['add'] === true){

     var msg1= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee details added successfully</strong></font></div>";
     $('#msg1').html(msg1);
     window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
           $(this).remove();
       });
   }, 3000);
   resetEduModal();

   fetch_educationdetails();
    }
  else  if(response['update'] === true){

    var msg1= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee details updated successfully</strong></font></div>";
    $('#msg1').html(msg1);
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
  }, 3000);
  
  resetEduModal();

  fetch_educationdetails();
   }
   else {
     alert("Error");
   }

   $('#exampleModal').modal('toggle');

   }
 });
}
}

function resetEduModal(){

$("#deletebtn").hide();
$('#education').find("input,select").val('').end();
}

function fetch_educationdetails(){
  var empeducation = $("#empid").val();
  $("#showeducationinfo").empty();

  $.ajax({
    url:'../src/fetch_education.php',
    method:'POST',
    data:{empeducation:empeducation},
    success:function(data)
    {
      response=JSON.parse(data);
      var count=Object.keys(response).length;
      if(count>0){
          for (var i = 0; i < count; i++){

            $("#showeducationinfo").append('<div class="col-sm-12" id="'
            +response[i]['Empeduid']+'"><b>'
            + response[i]['Empdegree']+' - ('+response[i]['specialization']+')</b><a href="#"><i class="fa fa-edit" style="padding-left:20px;" onclick="editEmpInfo('+response[i]['Empeduid']+');"></i></a><a href="#"><i class="fa fa-trash" style="padding-left:10px;" onclick="deleteEmpDetails('+response[i]['Empeduid']+');"></i></a><div class="col-sm-12">'+response[i]['university']+'<input type="hidden" id="passempid" value='+response[i]['Empeduid']+'></input></div><div class="col-sm-12">'+response[i]['passoutyear']+
            '<input type="hidden" id="passcgpa" value='+response[i]['CGPA']+'></input></div><div class="col-sm-12" id="abc" style="padding-bottom:20px"></div></div>');
    }
  }
}
  });
}

function editEmpInfo(param){
  // alert(param);
var getdivinfo = document.getElementById(param);
var showdivinfo = getdivinfo.innerHTML;
var StrippedString = showdivinfo.replace(/(<([^>]+)>)/ig,",");
var convertstrtoarr=  StrippedString.split(",");
var geteleminfo=convertstrtoarr.filter(Boolean);
var geteducationinfo = geteleminfo[0].split('-');
var getcgpa = document.getElementById("passcgpa").value;
 $("#educationid").val(param);

var degree = geteducationinfo[0];
var specialization = geteducationinfo[1];
 var s = specialization.substring(2, specialization.length-1);
var university = geteleminfo[1];
var passingyear = geteleminfo[2];

$("#degreename").val(degree);
$("#specialization").val(s);
$("#yearofpassing").append("<option value=" + passingyear + " selected>" + passingyear + "</option>");
$("#university").val(university);
$("#cgpa").val(getcgpa);

$('#exampleModal').modal('show');
$("#deletebtn").show();
$("#update_empEduBtn").show();
$("#addeducationinfo").hide();

}


function deleteEmpDetails(deleteedudetails){
// var deleteedudetails = $("#educationid").val();
$.ajax({
  url:'../src/deleteEduDetails.php',
  method:'POST',
  data:{edudetails:deleteedudetails},
  success:function(data){
    $('#exampleModal').modal('hide');
 $("#"+deleteedudetails).html(' ');
 var msg1= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee details deleted successfully</strong></font></div>";
 $('#msg1').html(msg1);
 window.setTimeout(function() {
   $(".alert").fadeTo(500, 0).slideUp(500, function(){
       $(this).remove();
   });
}, 3000);
$("#update_empEduBtn").hide();
$("#addeducationinfo").show();
resetEduModal();

fetch_educationdetails();
  }
});
}
