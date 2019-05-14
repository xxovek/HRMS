


$("#email").select2({
    allowClear: true,
placeholder:"Select Employee E-mail",
});
$("#leavetype").select2({
    allowClear: true,
    placeholder:"Select Leave Type",

});

fetch_leaves();
fetch_employees();
fetch_assign_leaves();


$('#employeeleave').on('submit', function(e){
e.preventDefault();
$.ajax({
  url:"../src/addLeaveRequest.php",
  method:"POST",
  data:$('#employeeleave').serialize(),
  success:function(data){
    // alert(data);
    response=JSON.parse(data);
    if(response['true'] || response['update'] )
    window.location.reload();
    else
    alert("Error");
  }
});
});

// function fetch_leaves() {
//   $.ajax({
//     url:'../src/displayLeaves.php',
//     method:'post',
//     success:function(data){
//       response=JSON.parse(data);
//       var count=Object.keys(response).length;
//       if(count>0){
//       for (var i = 0; i < count; i++){
//         var status=status1=status2=status3="";
//         if(response[i]['Leaves_status']=='New'){
//           status="selected";
//         }
//         else if (response[i]['Leaves_status']=='Approved') {
//           status1="selected";
//         }
//         else if (response[i]['Leaves_status']=='Hold') {
//           status3="selected";
//         }
//         else {
//           status2="selected";
//         }
//         $('#tbldata').show();
//         var str = response[i]['Emp_fname'];
//         if(response[i]['img'] === '')
//         {
//           var img='<img class="img-circle" src="../images/user.png" alt="" style="float:left;width:40px;height:40px;margin-right:10px;">';
//         }
//         else {
//           var img='<img class="img-circle" src="../images/'+response[i]['img']+'" alt="" style="float:left;width:40px; height:40px;margin-right:15px;">';
//         }
//         // var empname = str.charAt(0).toUpperCase() + str.slice(1);
//         var str = response[i]['Emp_fname'];
//         var resultantstr = str.replace("-", " ");
//         var empname = str.charAt(0).toUpperCase() + str.substr(1);
//       $('#loadtable').append('<tr><td><a href="#" title="Add Additional Leaves" onClick="additional_leave('+response[i]['EmpId']+');">'+img+'<big>'+resultantstr+'</big></a><p><small>'+response[i]['Emp_designation']+'</small></p></td><td class="text-center"> '+ response[i]['Emp_department'] +'</td><td class="text-center">'+ response[i]['Leaves_leave_type'] + '</td><td class="text-center">'+ response[i]['Leaves_date'] +
//       '</td><td class="text-center"> '+ response[i]['Leaves_reason'] + '</td><td class="text-center"> '+ response[i]['Leaves_no_of_days'] + '</td><td class="text-center"><select class="form-control select2"  id="empstatus" onchange="change_status('+ response[i]['leave_id'] +',this.value)"><option value="New" '+ status +'>New</option><option value="Approved" '+ status1 +
//       '>Approved</option><option value="Rejected" '+ status2 +'>Rejected</option><option value="Hold" '+ status3 +'>Hold</option></select></td><td class="text-center"><div class="btn-group"><button type="button" name="edit" class="label label-primary pull-right" title="Edit Leave" onClick="edit_leave('+response[i]['leave_id']+');"><i class="fa fa-edit"></i></button><button type="button" name="remove" class="label label-danger pull-right" onClick="remove_leave('+response[i]['leave_id']+');"><i class="fa fa-trash-o"></i></button></div></td></tr>');
//     }
//     // $('#tbldata').show();
//     var table = $("#datble").DataTable({
//       bPaginate: $('#datble tbody tr').length>10,
//       order: [],
//       columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5,6,7] } ],
//       dom: 'Bfrtip',
//           buttons: [
//             {
//                extend: 'collection',
//                text: 'Export',
//                buttons: ['copy', 'excel', 'pdf','print']
//             }
//          ]
//
//       });
//
// }else {
// $('#nodata').show();
// $('#tbldata').hide();
//
// }
//
//   }
//   });
// }


function fetch_leaves() {
  $.ajax({
    url:'../src/displayLeaves.php',
    method:'post',
    success:function(data){
      response=JSON.parse(data);
      var count=Object.keys(response).length;
      if(count>0){
      for (var i = 0; i < count; i++){
        var status=status1=status2=status3="";
        if(response[i]['Leaves_status']=='New'){
          status="selected";
        }
        else if (response[i]['Leaves_status']=='Approved') {
          status1="selected";
        }
        else if (response[i]['Leaves_status']=='Hold') {
          status3="selected";
        }
        else {
          status2="selected";
        }
        $('#tbldata').show();
        var str = response[i]['Emp_fname'];
        if(response[i]['img'] === ''){
          var img='<img class="img-circle" src="../images/user.png" alt="" style="float:left;width:40px;height:40px;margin-right:10px;">';
        }
        else {
          var img='<img class="img-circle" src="../images/'+response[i]['img']+'" alt="" style="float:left;width:40px; height:40px;margin-right:15px;">';
        }
        // var empname = str.charAt(0).toUpperCase() + str.slice(1);
        var str = response[i]['Emp_fname'];
        var resultantstr = str.replace("-", " ");
        var empname = str.charAt(0).toUpperCase() + str.substr(1);
      $('#loadtable').append('<tr><td><a href="#" title="Add Additional Leaves" onClick="additional_leave('+response[i]['EmpId']+');">'+img+'<big>'+resultantstr+'</big></a><p><small>'+response[i]['Emp_designation']+'</small></p></td><td class="text-center"> '+ response[i]['Emp_department'] +'</td><td class="text-center">'+ response[i]['Leaves_leave_type'] + '</td><td class="text-center">'+ response[i]['Leaves_date'] +
      '</td><td class="text-center"> '+ response[i]['Leaves_reason'] + '</td><td class="text-center"> '+ response[i]['Leaves_no_of_days'] + '</td><td class="text-center"><select class="form-control select2"  id="empstatus" onchange="change_status('+response[i]['EmpId']+","+ response[i]['leave_id'] +',this.value)"><option value="New" '+ status +'>New</option><option value="Approved" '+ status1 +
      ' >Approved</option><option value="Rejected" '+ status2 +'>Rejected</option><option value="Hold" '+ status3 +'>Hold</option></select></td><td class="text-center"><div class="btn-group"><button type="button" name="edit" class="label label-primary pull-right" title="Edit Leave" onClick="edit_leave('+response[i]['leave_id']+');"><i class="fa fa-edit"></i></button><button type="button" name="remove" class="label label-danger pull-right" onClick="remove_leave('+response[i]['leave_id']+');"><i class="fa fa-trash-o"></i></button></div></td></tr>');
    }
    // $('#tbldata').show();
    var table = $("#datble").DataTable({
      bPaginate: $('#datble tbody tr').length>10,
      order: [],
      columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5,6,7] } ],
      dom: 'Bfrtip',
          buttons: [
            {
               extend: 'collection',
               text: 'Export',
               buttons: ['copy', 'excel', 'pdf','print']
            }
         ]

      });

}else {
$('#nodata').show();
$('#tbldata').hide();

}

  }
  });
}



$('#submitformdata').on('submit', function(e){

e.preventDefault();
$.ajax({
  url:"../src/addAdditionalLeave.php",
  method:"POST",
  data:$('#submitformdata').serialize(),
  success:function(data){
    response=JSON.parse(data);
    if(response['true']  ){
      window.location.reload();
    }
    else{
      alert("Error");
    }
  }
});
});

function fetch_assign_leaves(){
  $.ajax({
    url:"../src/fetch_assign_leaves.php",
    method:"POST",
    success:function(data){
      $("#leavetype").html(data);
      $("#leavetype1").html(data);
    }
  });
}

function add_leave() {
$('#new').show();
// $("#balance1").html(" ");
$("#empemail").show();
$("#email11").hide();
$('#addleave').hide();
$('#emp').hide();
$('#nodata').hide();
$("#email").select2("val", " ");
$("#leavetype").select2("val", " ");
$("#leavetype1").select2("val", " ");
$("#signs").select2("val", " ");
}

function clear_all() {
  var x = document.getElementById("loadtable").rows.length;

  if(x){
    $('#emp').show();
    $('#new').hide();
    $('#addleave').show();
    $('#leave').trigger("reset");
  }
  else
  {
    $('#nodata').show();
    $('#new').hide();
    $('#addleave').show();
  }


}
function clear_all1() {
$("#empleave").hide();
$("#tbldata").show();
$('#addleave').show();
}
function fetch_employees() {
  $.ajax({
    url:"../src/fetch_emp.php",
    method:"POST",
    success:function(data){
      $("#email").html(data);
    }
  });
}
function remove_leave(param){
            $.ajax({
            url:"../src/remove.php",
            method:"POST",
              data:({id:param,tblName:'EmployeeLeaves',colName:'EmpLeaveId'}),
            success:function(data)  {
              response=JSON.parse(data);
              if(response['true'])
              {
                $("#"+param).closest('tr').remove();
                window.location.reload();
            }
          }
            });

          }


function edit_leave(param){
  $('#new').show();
  $('#emp').hide();
  $('#addleave').hide();
  $('#empemail').hide();
  $('#leaveid').val(param);
  // $('#empid').val(param1);
  $.ajax({
  url:"../src/updateLeaveRequest.php",
  method:"POST",
  data:({leave_id:param}),
  success:function(data){
    response=JSON.parse(data);
    $("#from_date").val(response['from_date']);
    $("#upto_date").val(response['upto_date']);
    $("#numberofdays").val(response['numOfDays']);
    $("#Reason").val(response['reason']);
      $("#email").attr('required', false);
    $("#email11").show();
    $("#email1").val(response['useremail']);
    $("#leavetype").append("<option  value='"+response['leave_id']+"' selected=selected >"+response['leave_type']+"</option>").trigger("change");
  }
  });
}

function find_days(){
  var oneDay = 24*60*60*1000;
  var firstDate = new Date($("#from_date").val());
var secondDate = new Date($("#upto_date").val());
// alert(secondDate);
if(firstDate.getDate() > secondDate.getDate()) {
  $("#numberofdays").val("");
  $("#upto_date").val("");

  $("#leave_bal1").html("Upto Date Require Gratter Than Form Date.. ");
  setTimeout(function() { $("#leave_bal1").hide(); }, 3000);

}else {
  // $("#leave_bal1").html("");

  var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay))) +1;
  $("#numberofdays").val(diffDays);
  var param =$("#leavetype").val();
  var employeeid = $("#email").val();

  $.ajax({
    url:"../src/fetchLeaveBalance.php",
    method:"POST",
    data:{l_id:param,emp_id:employeeid},
    success:function(data){
      response=JSON.parse(data);
      if(diffDays>response['NoOfDays']){
        $("#numberofdays").val("");
        $("#from_date").val("");
        $("#upto_date").val("");
      $("#leave_bal1").html("Not sufficent balance leaves..try for another type ");
      setTimeout(function() { $("#leave_bal1").hide(); }, 3000);
    }
  }
  });
}

}



function change_status(empid,leaveid,status) {
  // alert(status);
  // alert(empid);
  // alert(leaveid);

  $.ajax({
  url:"../src/change_leave_status.php",
  method:"POST",
  data:({empid:empid,leave_id:leaveid,status:status}),
  success:function(data){
    response=JSON.parse(data);
      }
  });
}

function additional_leave(param) {
  $("#e_id").val(param);
$("#empleave").show();
$('#tbldata').hide();
$('#addleave').hide();
}




// $('#leaveedit').on('submit', function() {
//   $("#employeeleave").valid();
//   // e.preventDefault();
// var formdata = $('#employeeleave').serialize();
//   $.ajax({
//     url:"../src/addLeaveRequest.php",
//     method:"POST",
//     data:formdata,
//     success:function(data){
//       alert(data);
//       response=JSON.parse(data);
//       if(response['true'] || response['update'] )
//       window.location.reload();
//       else
//       {
//         alert("Error");
//
//       }
//     }
//   });
// });
