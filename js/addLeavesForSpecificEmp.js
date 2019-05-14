
$("#signs").select2({
    allowClear: true,
    placeholder: "Select sign",
});

$("#leavetype1").select2({
    allowClear: true,
    placeholder: "Select Leave Type",
});

fetch_leaves();
fetch_employees();
fetch_assign_leaves();

function fetch_employees() {
  $.ajax({
    url:"../src/fetch_emp.php",
    method:"POST",
    success:function(data){
      $("#email").html(data);
    }
  });
}

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
function additional_leave(param) {
  // $("#leavesTypeTable_Div").show();
fetchAllLeaveSpecificEmp(param);
$("#e_id").val(param);
$("#empleave").show();
$('#tbldata').hide();
// $('#addleave').hide();
}

function clear_all1() {
$("#empleave").hide();
$("#tbldata").show();
// $('#addleave').show();
$('#leavesTypeTable tbody').empty();

}

function fetch_leaves() {

  $.ajax({
    url:'../src/displayAditionLeavesForEmp.php',
    method:'post',
    dataType:'json',
    success:function(response){
      // response=JSON.parse(data);
      var count=Object.keys(response).length;
      if(count>0){
      $('#tbldata').show();;

      for (var i = 0; i < count; i++){
        //alert(i);

        var str = response[i].name;

        if(response[i].img === '')
        {
          var img='<img class="img-circle" src="../images/user.png" alt="" style="float:left;width:40px;height:40px;margin-right:10px;">';
        }
        else {
          var img='<img class="img-circle" src="../images/'+response[i].img+'" alt="" style="float:left;width:40px; height:40px;margin-right:15px;">';
        }
        var empname = str.charAt(0).toUpperCase() + str.slice(1);
        var str = response[i].name;
        var resultantstr = str.replace("-", " ");
        var empname = str.charAt(0).toUpperCase() + str.substr(1);

      $('#loadtable').append('<tr><td class="text-center">'+(i + 1)+'</td><td>'+img+'<big>'+resultantstr+'</big><p><small>'
      +response[i].designation+'</small></p></td><td class="text-center"> '
      + response[i].department +'</td><td ><div class="btn-group"><button type="button" name="edit" class="label label-primary pull-right" title="Edit Additional Leaves" onClick="additional_leave('+response[i].Empid+');"><i class="fa fa-edit"></i></button></div></td></tr>');
    }
    // $('#tbldata').show();
    var table = $("#datble").DataTable({
      bPaginate: $('#datble tbody tr').length>10,
      order: [],
      columnDefs: [ { orderable: false, targets: [0,1,2,3] } ],
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

function fetchAllLeaveSpecificEmp(empid){
// alert(empid);
$.ajax({
  url:'../src/fetchLeaveForadditionalTbl.php',
  type:'POST',
  dataType:'json',
  data:{empid:empid},
  success:function(response){
    // alert(response[0].EmpLeaveSum);
 let totalLeaves = 0;
 let additional_leave = 0;
for (var i = 0; i < response.length; i++) {
    totalLeaves = parseInt(response[i].EmpLeaveSum) + parseInt(response[i].NoOfDays);
    if(response[i].EmpLeaveSum <= 0){
      additional_leave = 0;
    }else {
      additional_leave = response[i].EmpLeaveSum;
    }
  $("#leavesTypeTblBody").append('<tr><td class="text-center">'+(i + 1)
      +'</td><td>'+response[i].LeaveType
      +'</td><td class="text-center">'+response[i].NoOfDays
      +'</td><td class="text-center">'+ additional_leave
      +'</td><td class="text-center">'+ totalLeaves
      +'</td></tr>');
}

  }
});




}
