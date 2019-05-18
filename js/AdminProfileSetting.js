function BasicSettingsTab(){
  fetch_adminPersonalInfo();
}
function CompanySettingsTab(){
   fetchCompanyDetails();
}
function ProfilePicSettingsTab(){
 fetchUplodedImages();
}
function HolidaySettingTab(){
   fetchWeekOffDays();
}
function TaxSettingTab(){
 fetchAllTaxes();
}
function TimeSettingTab(){
   // fetchCompanyDetails();
}
function OtherSettingTab(){
fetchPFSettings();
}
function TdsTab(){
  fetchAllTDS();
}
$('#InTime').timepicker({
  showInputs: false,
  dateFormat: "mm/dd/yy"
})
$('#OutTime').timepicker({
  showInputs: false,
  dateFormat: "mm/dd/yy"
});


function timeSummation(id1, id2) {
  var t1 = document.getElementById(id1).value;
  var t2 = document.getElementById(id2).value;
  var startTime = moment(t1, 'hh:mm:ss a');
  var endTime = moment(t2, 'hh:mm:ss a');
  var totalHours = (endTime.diff(startTime, 'hours'));
  var totalMinutes = endTime.diff(startTime, 'minutes');
  var clearMinutes = totalMinutes % 60;
  if(totalHours >= 24){
    totalHours = totalHours %24;
    totalHours = totalHours < 0 ? 24 + totalHours : +totalHours;
    }

    if(totalHours > 0){
      return totalHours;
    }
    else{
      totalHours = 0;
      return totalHours;     
    }
}

function SaveWorkHours(){
  alert('ok');
//  if(document.getElementById('workHours').value > 0){
//    $.ajax({
//     url:'',

//    });
//  }
}

  $("#startdatepicker").daterangepicker({
    dateFormat: "dd/mm/yyyy"
  });

  $('.pass_show').append('<span class="ptxt">Show</span>');

  $("#weekdaysInput").select2({
    placeholder: "Select day",
     allowClear: true,
  });
  $("#WeekNumberInput").select2({
    placeholder: "Select Week Number",
     allowClear: true,
  });

  $("#scountry").select2({
    placeholder: "Select Country",
     allowClear: true,
  });



  $("#sstate").select2({
    placeholder: "Select State",
     allowClear: true,
  });

  $("#scity").select2({
    placeholder: "Select City",
     allowClear: true,
  });

function isNumberKey(event) {
   var charCode = (window.event) ? event.keyCode  : event.which ;
  if (charCode > 31 && (charCode < 48|| charCode > 57) && charCode!=46 )
  return false;
  return true;
}

function getCountry_name() {
    $.ajax({
        type: "POST",
        url: "../src/get_countryNames.php",
        success: function(msg) {
          $("#scountry").html(msg);
        }
    });
}

function getStateemp(country){
  $.ajax({
      type: "POST",
      url: "../src/get_statenames.php",
      data: ({
          user_id:country
      }),
      success: function(msg) {
        $("#sstate").html(msg);
      }
  });
}

function getCityemp(state){
  $.ajax({
      type: "POST",
      url: "../src/get_cityNames.php",
      data: ({
          user_id:state
      }),
      success: function(msg) {
        $("#scity").html(msg);
      }
  });
}

function resetWeekOffForm(){
  $("#weekdaysInput").trigger('change').val([]);
  $("#WeekNumberInput").trigger('change').val([]);
}

function SaveWeekOffForm(){
let inputFlag = 0;
let dayVal = document.getElementById('weekdaysInput').value;
let weekVal = document.getElementById('WeekNumberInput').value;
if(dayVal === ""){
  inputFlag = 1;
}else if (weekVal === "") {
  inputFlag = 1;
}
if (inputFlag === 0) {
  $.ajax({
    url:'../src/weekOffSettingFormSave.php',
    type:'POST',
    data:$("#weekOffSettingForm").serialize(),
    dataType:'json',
    success:function(response){
    $("#weekOffSettingForm")[0].reset();
    fetchWeekOffDays();
    $("#weekdaysInput").html('<option value="">Select Day</option><option value="Sunday">Sunday</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option>');
    $("#WeekNumberInput").html('<option value="">Select Week</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>');
    }
  })
}
}

function fetchWeekOffDays(){
  $("#WeekOffDaysTblBody").empty();
  $.ajax({
    url:'../src/fetchWeekOffSettingFormSave.php',
    type:'POST',
    data:"",
    dataType:'json',
    success:function(response){
      let weeknumberstring = "";
      for (var i = 0; i < response.length; i++) {
        if (response[i].weeknumber == 1) {
          weeknumberstring = "First";
        }
        else if (response[i].weeknumber == 2) {
          weeknumberstring = "Second";

        }
        else if (response[i].weeknumber == 3) {
          weeknumberstring = "Third";

        }
        else if (response[i].weeknumber == 4) {
          weeknumberstring = "Fourth";

        }
        else if (response[i].weeknumber == 5) {
          weeknumberstring = "Fifth";

        }
        $("#WeekOffDaysTblBody").append('<tr><td class="text-center">'+response[i].day+'</td><td class="text-center">'+weeknumberstring+
        '</td><td class="text-center"><div class="btn-group"><button type="button" onclick="DeleteWeekOffDay(\''+ response[i].weeknumber +'\',\''+response[i].day+'\')" class="label label-danger pull-right"><i class="fa fa-trash"></i></button></div></td></tr>');
      }
    }
  });
}

function DeleteWeekOffDay(weekNumber,day){
  $.ajax({
    url:'../src/DeleteWeekOffDay.php',
    type:'POST',
    data:{weekNumber:weekNumber,day:day},
    dataType:'json',
    success:function(response){
      if (response.msg){
        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Week Day Off Deleted Successfully</strong></font></div>";
        $('#msgHoliday').html(msg2);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
      fetchWeekOffDays();
    }
    }
  });
}


function checkboxTick(){
if(document.getElementById("CPass_checkbox").checked === true){
  $("#ChangePassDiv").show();
}
else{
  $("#ChangePassDiv").hide();
}
}

function CheckPass(pw){
  let oldPass = document.getElementById('oldPass').value;
  let password = pw.trim();
  if(password === oldPass){
      $("#cpDiv").show();
      $("#CurrentPWDiv").hide();
  }else {
    $("#wrongPWMsg").html("Incorrect Password");
  }
}

//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
});


$("#CompanyInfoForm").on("submit",function(event){
  event.preventDefault();
  $.ajax({
    url:'../src/insertCompanyDetails.php',
    type:'POST',
    data:$("#CompanyInfoForm").serialize(),
    dataType:'json',
    success:function(response){
      if(response.add === true){

        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Company Details Added Successfully</strong></font></div>";
        $('#msgCompanyInfo').html(msg2);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);

      }else if (response.update === true){

        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Company Details Updated Successfully</strong></font></div>";
        $('#msgCompanyInfo').html(msg2);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
      }else{

      }
    }

  });
});

$("#AdminBasicInfoForm").on('submit',function(e){
  e.preventDefault();
  $.ajax({
      type: "POST",
      url: "../src/UpdateAdminBasicPersonalInfo.php",
      data:$("#AdminBasicInfoForm").serialize(),
      dataType:'json',
      success: function(response) {
        if(response.true === true){
          var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Basic Personal Details Updated Successfully</strong></font></div>";
          $('#msgBasicInfo').html(msg2);
          window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
        window.location.reload();
      }
      else if(response.true === 'noChange'){

      }
      else{
        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Update Failed</strong></font></div>";
        $('#msgBasicInfo').html(msg2);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
      }
}
});
});

function fetchAllTaxes(){
  $("#TaxListTblBody").empty();
  $.ajax({
    url:'../src/fetchTaxes.php',
    type:'POST',
    dataType:'json',
    success:function(response){
      for (var i = 0; i < response.length; i++) {
        var d = new Date(response[i].createdDate);
        var cdate = d.toDateString();
       $("#TaxListTblBody").append('<tr><td class="text-center">'+(i + 1)+'</td><td class="text-center">'+response[i].taxname+'</td><td class="text-center">'+response[i].taxvalue+
        '</td><td class="text-center">'+cdate+'</td><td class="text-center"><div class="btn-group"><button type="button" onclick="EditTax(\''+ response[i].t_id +'\',\''+response[i].taxname+'\',\''+response[i].taxvalue+'\')" class="label label-warning pull-left"><i class="fa fa-edit"></i></button><button type="button" onclick="DeleteTax('+response[i].t_id+')" class="label label-danger pull-right"><i class="fa fa-trash"></i></button></div></td></tr>');
      }
     }
  });
}

function EditTds(tdsid,frombal,uptobal,percentage){
$("#updateTBTN").show();
$("#saveTBTN").hide();
$("#TdsId").val(tdsid);
$("#startingamount").val(frombal);
$("#endingamount").val(uptobal);
$("#tdspercentage").val(percentage);
}
function DeleteTds(taxid){
  $.ajax({
    url:'../src/DeleteTds.php',
    type:'POST',
    data:{taxid:taxid},
    dataType:'json',
    success:function(response){
      if(response.msg){
        fetchAllTDS();
      }else{
          alert("Error");
      }
    }
  });
}
function resetTDSBTNClick(){
  $("#TdsId").val("");
  $("#updateTBTN").hide();
  $("#saveTBTN").show();
  $("#TdsTaxSettingForm")[0].reset();
}

function fetchAllTDS(){
  $("#TdsTaxListTblBody").empty();
  $.ajax({
    url:'../src/fetchTds.php',
    type:'POST',
    dataType:'json',
    success:function(response){
      for (var i = 0; i < response.length; i++) {
        var d = new Date(response[i].createdDate);
        var cdate = d.toDateString();
       $("#TdsTaxListTblBody").append('<tr><td class="text-center">'+(i + 1)+'</td><td class="text-center">'+response[i].FromBal+'</td><td class="text-center">'+response[i].UptoBal+
        '</td><td class="text-center">'+response[i].Percentage+'</td><td class="text-center">'+cdate+'</td><td class="text-center"><div class="btn-group"><button type="button" onclick="EditTds(\''+ response[i].id +'\',\''+response[i].FromBal+'\',\''+response[i].UptoBal+'\',\''+response[i].Percentage+'\')" class="label label-warning pull-left"><i class="fa fa-edit"></i></button><button type="button" onclick="DeleteTds('+response[i].id+')" class="label label-danger pull-right"><i class="fa fa-trash"></i></button></div></td></tr>');
      }
     }
  });
}

function resetBTNClick(){
  $("#taxId").val("");
  $("#updateBTN").hide();
  $("#saveBTN").show();
  $("#TaxSettingForm")[0].reset();
}

function EditTax(taxid,tname,tval){
$("#updateBTN").show();
$("#saveBTN").hide();
$("#taxId").val(taxid);
$("#taxName").val(tname);
$("#taxVal").val(tval);
}
function DeleteTax(taxid){
  $.ajax({
    url:'../src/DeleteTax.php',
    type:'POST',
    data:{taxid:taxid},
    dataType:'json',
    success:function(response){
      if(response.msg){
        fetchAllTaxes();
      }else{
          alert("Error");
      }
    }
  });
}

function SaveTaxForm(){
  let inputFlag = 0;
  let TaxVal = document.getElementById('taxVal').value;
  let TaxNameVal = document.getElementById('taxName').value;

  if(TaxNameVal === ""){
    inputFlag = 1;
  }else if (TaxVal === "") {
    inputFlag = 1;
  }
  if (inputFlag < 1) {

    $.ajax({
      url:'../src/TaxSettingFormSave.php',
      type:'POST',
      data:$("#TaxSettingForm").serialize(),
      dataType:'json',
      success:function(response){

        if(response.add === true){

          var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>New Tax Added Successfully</strong></font></div>";
          $('#msgForTax').html(msg2);
          window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
        resetBTNClick();
        fetchAllTaxes();

        }else if(response.true === 'noChange'){

        }else if (response.update === true){

          var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Tax Details Updated Successfully</strong></font></div>";
          $('#msgForTax').html(msg2);
          window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
        resetBTNClick();
        fetchAllTaxes();

        }else{

        }

      }
    });

  }else{

  }

  }

  function SaveTdsTaxForm(){
    let startingamount = $('#startingamount').val();
    let endingamount =$('#endingamount').val();
    let tdspercentage = $('#tdspercentage').val();
    if(startingamount === "" ||  endingamount==="" ||  tdspercentage==="" ){
            
    }
    else
    {
      $.ajax({
        url:'../src/TdsTaxSettingForm.php',
        type:'POST',
        data:$("#TdsTaxSettingForm").serialize(),
        dataType:'json',
        success:function(response){
          if(response.add === true){

            var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>New TDS Added Successfully</strong></font></div>";
            $('#msgForTds').html(msg2);
            window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove();
              });
          }, 3000);
          resetTDSBTNClick();
          fetchAllTDS();

          }else if(response.true === 'noChange'){

          }else if (response.update === true){

            var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>TDS Details Updated Successfully</strong></font></div>";
            $('#msgForTds').html(msg2);
            window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove();
              });
          }, 3000);
          resetTDSBTNClick();
          fetchAllTDS();

          }else{

          }
        }
      });
    }
    }


   $("input[name=imgnameProfile]").change(function () {
      if (this.files && this.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              var img = $('<img>').attr('src', e.target.result);
              $('#profile1').html(img);
          };

          reader.readAsDataURL(this.files[0]);
      }
      $("#profile1").html('');
  });


  $("input[name=imgnameLogo]").change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var img = $('<img>').attr('src', e.target.result);
            $('#logo1').html(img);
        };

        reader.readAsDataURL(this.files[0]);
    }
    $("#logo1").html('');
});
function fetchUplodedImages(){
  $.ajax({
   url:'../src/fetchUplodedImages.php',
   type:'POST',
   dataType:'json',
   success:function(response){
   //  alert(response.ProfilePic);
    $("#profileImgSpan").html("YourProfile.jpeg");
    $("#logoImageSpan").html("YourLogo.jpeg");

       document.getElementById('profile1').innerHTML = '<img src= "../images/'+response.ProfilePic+'" class="img-responsive"  style="width:30%;height:auto;">';
       document.getElementById('logo1').innerHTML = '<img src= "../images/'+response.logoImage+'"  class="img-responsive"  style="height:100px;width:120px;padding-bottom:10px;">';

    }
  });
}

function fetchCompanyDetails(){
  $.ajax({
      type: "POST",
      url: "../src/FetchCompanyDetails.php",
      dataType:'json',
      success: function(response) {
        $("#inputCname").val(response.companyname);
        $("#Admin_CompanyName").html(response.companyname);
        $("#startdatepicker").val(response.finaYear);
        $("#inputContPersonName").val(response.contactperson);
        $("#inputContNumber").val(response.contactnumber);
        $("#inputCompanyEmail").val(response.email);
        $("#inputCompanyFax").val(response.fax);
        $("#inputCompanyWebUrl").val(response.websiteurl);
        $("#scountry").append("<option value=" + response.country + " selected=selected>"+response.country+"</option>");
        $("#sstate").append("<option  value='"+response.State+"' selected=selected >"+response.State+"</option>");
        $("#scity").append("<option  value='"+response.City+"' selected=selected >"+response.City+"</option>");
        $("#inputPincode").val(response.postalcode);
        $("#inputCompanyAddr").val(response.address);
        $("#companyid").val(response.companyid);
      }
    });
}

function fetch_adminPersonalInfo(){
  $.ajax({
        url:'../src/fetch_adminPersonalInfo.php',
        type:'POST',
        dataType:'json',
        success:function(response){
          let ProfileImageName = response.ProfilePic;
          let LogoImageName = response.logoImage;
            $("#inputFName").val(response.fname);
            $("#inputLName").val(response.lname);
            $("#email").val(response.email);
            $("#oldPass").val(response.upassword);
            $("#phone").val(response.contactNumber);
            $("#imagep").html('<img class="profile-user-img img-responsive img-circle" src="../images/'+response.ProfilePic+'" alt="User profile picture">');
            $("#empname").html(response.fname+" "+response.lname);
        }
  });
}

// function uploadImages(){
$("#profileImageForm").on("submit",function(e){

// alert("ok");
e.preventDefault();
  var formData = new FormData(this.form);
  // var input_value = document.getElementById("imgnameProfile").value;
  var Profilefile_data = $("#imgnameProfile").prop("files")[0];
  formData.append('imgnameProfile', Profilefile_data);

  var Logofile_data = $("#imgnameLogo").prop("files")[0];
  formData.append('imgnameLogo', Logofile_data);

  $.ajax({
    url:"../src/LogoProfileImage.php",
    method:"POST",
    data:formData,
    dataType:'json',
    cache:false,
    contentType: false,
    processData: false,
    success:function(response){
      //response=JSON.parse(response);
      if(response.msg === true){
        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Images Uploaded Successfully</strong></font></div>";
        $('#msgUploadimage').html(msg2);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
      window.location.reload();
    }

    }
  })

});

$(document).on('click','.pass_show .ptxt', function(){

$(this).text($(this).text() == "Show" ? "Hide" : "Show");

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });

});
