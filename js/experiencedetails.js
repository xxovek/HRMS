
function resetexperiencemodal(){
$("#employeername").val("");
$("#Noofyear").val("");
  $("#Noofmonth").select2("val"," ");
  $("#deleteExpBtn").hide();
}


$('#experience').on('submit', function(e) {
    e.preventDefault();
    var empid=document.getElementById("empid").value;
    $.ajax({
        type: "POST",
        url: "../src/experienceinfo.php",
        data: $('form.tagForm').serialize()+ "&empexpid="+empid,
        dataType:'json',
        success: function(data) {
          // response=JSON.parse(data);
          if(data['add'] === true){
            var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Experience details added successfully</strong></font></div>";
            $('#msg2').html(msg2);
            window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove();
              });
          }, 3000);

        }
        else  if(data['update'] === true)
          {
          var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Experience details updated successfully</strong></font></div>";
          $('#msg2').html(msg2);
          window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
         }
         else {
           alert("Error");
         }
         $('#modal-default').modal('toggle');
resetexperiencemodal();
fetch_experiencedetails();
        }
    });
});


function fetch_experiencedetails(){
  var empexperience = $("#empid").val();
  $("#showexperienceinfo").empty();

  $.ajax({
    url:'../src/fetch_experience.php',
    method:'POST',
    data:{empexperience:empexperience},
    success:function(data){
      response=JSON.parse(data);
      var count=Object.keys(response).length;
      // var htmlData = '<ul class="list-group">';
          for (var i = 0; i < count; i++){
            // $("#showexperienceinfo").append('<li class="list-group-item "></li>');
         // htmlData += '<li class="list-group-item ">'+response[i]['ExperienceId']+'</li>';
         // htmlData += '<li class="list-group-item ">'+response[i]['EmployerName']+'</li>';
         // htmlData += '<li class="list-group-item ">'+response[i]['NoOfYear']+'-Year,'+response[i]['NoOfMonth']+'-Month';
         // htmlData += '<input type="hidden" id="passempexpid" value='+response[i]['ExperienceId']+'></input></li>';
         // htmlData += '<li class="list-group-item "><a href="#"><i class="fa fa-edit" style="padding-left:50px;" onclick="editExpInfo('+response[i]['ExperienceId']+');"></i></a></li>';
         //

              $("#showexperienceinfo").append('<div class="col-sm-4" id="'
              +response[i]['ExperienceId']+'"><b>'
              +response[i]['EmployerName']+'</b><a href="#"><i class="fa fa-edit" style="padding-left:50px;" onclick="editExpInfo('
              +response[i]['ExperienceId']+');"></i></a><a href="#"><i class="fa fa-trash" style="padding-left:10px;" onclick="deleteEmpExpDetails('
              +response[i]['ExperienceId']+');"></i></a><br><div class="col-sm-4">'
              +response[i]['NoOfYear'] +'-Year,'
              +response[i]['NoOfMonth']+'-Month<input type="hidden" id="passempexpid" value='
              +response[i]['ExperienceId']+'></input></div><div class="col-sm-4" id="abc" style="padding-bottom:20px"></div></div>');
        }

        // deleteEmpExpDetails()
        // htmlData += '</ul>';
        // $("#showexperienceinfo").append(htmlData);
      }

  });
}


function editExpInfo(param){
var getdivinfo = document.getElementById(param);
var showdivinfo = getdivinfo.innerHTML;
var StrippedString = showdivinfo.replace(/(<([^>]+)>)/ig,",");
var convertstrtoarr=  StrippedString.split(",");
var geteleminfo=convertstrtoarr.filter(Boolean);
var getcompanyname = geteleminfo[0];
var NoOfYear = geteleminfo[1];
var NoOfMonth= geteleminfo[2];
var getNoOfYear = NoOfYear[0].split('-');
var getNoOfMonth= NoOfMonth[0].split('-');
 $("#experienceid").val(param);
$("#employeername").val(getcompanyname);
$("#Noofyear").val(getNoOfYear);
// $("#NoOfMonth").val(NoOfMonth);
$("#Noofmonth").append("<option value="
+ getNoOfMonth + " selected>"
+ getNoOfMonth + "</option>");

$('#modal-default').modal('show');
$("#deleteExpBtn").show();
$("#update_empExpBtn").show();
$("#emexperiencedetails").hide();

}


function  deleteEmpExpDetails(deleteedudetails){
  // var deleteedudetails = $("#experienceid").val();
  // alert(deleteedudetails);
  $.ajax({
    url:'../src/deleteEmpExpDetails.php',
    method:'POST',
    data:{ExpId:deleteedudetails},
    success:function(data){
    $('#modal-default').modal('hide');
   $("#"+deleteedudetails).html(' ');
   var msg1= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee Experience Details Deleted Successfully</strong></font></div>";
   $('#msg1').html(msg1);
   window.setTimeout(function() {
     $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove();
     });
  }, 3000);
  resetexperiencemodal();
fetch_experiencedetails();
    }
  })
}

function resetSkillsmodal(){
    $("#skill_ip").val("");
    $("#skillid").val("");
    $("#deleteskillBtn").hide();
    $("#update_empskillsBtn").hide();
    $("#add_empskillsBtn").show();

}

$('#addSkillsForm').on('submit', function(e) {
    e.preventDefault();
    var empid=document.getElementById("empid").value;

    $.ajax({
        type: "POST",
        url: "../src/addUpdateSkill.php",
        data: $('#addSkillsForm').serialize()+ "&empskillid="+empid,
        dataType:'json',
        success: function(data) {
          // response=JSON.parse(data);
          if(data['add'] === true){
            var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Skill Added Successfully</strong></font></div>";
            $('#msg2').html(msg2);
            window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove();
              });
          }, 3000);
          // alert(data);
          // $('#modal-default').modal('toggle');
        }
        else  if(data['update'] === true)
          {
          var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Skill Updated Successfully</strong></font></div>";
          $('#msg2').html(msg2);
          window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
         }
         else {
           alert("Error");
         }
         $('#modalAddNewSkill').modal('toggle');
         resetSkillsmodal();
         fetch_SkillsDetails();
        }
    });

});


// functionname(\''+ response[i]['SkillId'] +'\',\''+response[i]['SkillName']+'\')
function fetch_SkillsDetails(){
  var empskillid = $("#empid").val();
  $("#showSkillsinfo").empty();
  $.ajax({
    url:'../src/fetch_EmpSkills.php',
    method:'POST',
    data:{empskillid:empskillid},
    success:function(data)
    {
// alert(data);
      response=JSON.parse(data);
      var count=Object.keys(response).length;
      if(count>0){
              for (var i = 0; i < count ; i++) {
                $("#showSkillsinfo").append('<div class="col-sm-3" id="'+response[i]['EmpSkillId']+'"><b>'
                +response[i]['SkillName']+'</b><a href="#"><i class="fa fa-edit" style="padding-left:50px;" onclick="editSkillInfo(\''+ response[i]['SkillId'] +'\',\''+response[i]['SkillName']+'\');"></i></a><a href="#"><i class="fa fa-trash" style="padding-left:10px;" onclick="deleteEmpSkill('+
                response[i]['SkillId']+');"></i></a><div class="col-sm-4"><input type="hidden" id="passempskillid" value='
                +response[i]['SkillId']+'></input></div><div class="col-sm-5" id="abc" style="padding-bottom:20px"></div></div>');
            }
    }
}
  });

}

function editSkillInfo(SkillId,SkillName) {
// alert(SkillId);
$('#modalAddNewSkill').modal('show');
$("#skill_ip").val(SkillName);
$("#skillid").val(SkillId);
$("#add_empskillsBtn").hide();
$("#update_empskillsBtn").show();
$("#deleteskillBtn").show();
}



function deleteEmpSkill(SkillId){
  // var SkillId = document.getElementById('skillid').value;
  // alert(SkillId);
  $.ajax({
    url:'../src/deleteEmpSkill.php',
    method:'POST',
    data:{SkillId:SkillId},
    success:function(data){
      $('#modalAddNewSkill').modal('hide');
       // $("#"+SkillId).html('');
       $("#"+SkillId).html(' ');

      var msg1= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Employee Skill Deleted Successfully</strong></font></div>";
      $('#msg1').html(msg1);
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
     }, 3000);
     resetSkillsmodal();
     fetch_SkillsDetails();

    }
  })
}
