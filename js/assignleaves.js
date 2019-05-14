
fetchleaves();

function fetchleaves(){
    // var response=[];
    alert('fetchleaves');
  $.ajax({
    type:'POST',
    dataType:'json',
    url:'../src/displayAssignLeaves.php',
    success:function(response){
      // response = JSON.parse(data);
      // var count=Object.keys(response).length;
      var count=response.length;
alert(count);
      if(count>0){

      for(var i=0;i<count;i++){
        alert(response[i].paidFlag);
      $("#loadtable").append('<tr><td  class="text-center">'+(i + 1)+'</td><td class="text-center">'+response[i].leave_type+'</td><td class="text-center">'+response[i].fromdate+'</td><td class="text-center">'+response[i].uptodate+
      '</td><td class="text-center">'+response[i].numdays+'</td><td class="text-center"><div class="btn-group"><button class="label label-primary pull-right" title="EDit LeaveType" onClick="edit_leavetype('
      +response[i].leave_id+',\''+response[i].leave_type+'\',\''+response[i].fromdate+'\',\''+response[i].uptodate+'\','+response[i].numdays+'\','+response[i].paidFlag+');"><i class="fa fa-edit"></i></button><button class="label label-danger pull-right" title="Remove Leavetype" onClick="remove_leavetype('+response[i].leave_id+')"><i class="fa fa-trash"></i></button></div></td></tr>');
    }
    $('#tbldata').show();

    var table = $("#datble").DataTable({
      // lengthChange: false,
      // buttons: ['copy', 'excel', 'pdf','print']
      dom: 'Bfrtip',
          buttons: [
            {
               extend: 'collection',
               text: 'Export',
               buttons: ['copy', 'excel', 'pdf','print']
            }
         ]
    });
  table.buttons().container()
  .appendTo( '#datble_wrapper .col-md-6:eq(0)');

  }else {
      $('#nodata').show();
      $('#nodata').show();
      $('#new').hide();
      $('#emp').hide();
      $('#leaves').show();
  }
    }
  });
}
function remove_leavetype(param){
            $.ajax({
            url:"../src/remove.php",
            method:"POST",
            data:({id:param,tblName:'Leaves',colName:'LeaveId'}),
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

          function edit_leavetype(id,leavetype,fromdate,uptodate,numdays,paidFlag){
            alert(flag);
            $("#leavetype").val(leavetype);
            $("#leave_id").val(id);
            $("#fromdate").val(fromdate);
            $("#uptodate").val(uptodate);
            $("#numdays").val(numdays);
            $("#add").hide();
            $("#update").show();
            if (paidFlag === "1")
               document.getElementById("type1").checked = true;
            else
              document.getElementById("type2").checked = true;



          }

$('#submitformdata').on('submit',function(e){
  e.preventDefault();
  // alert($('#submitformdata').serialize());
  $.ajax({
    type:'POST',
    url:'../src/addLeaves.php',
    data: $('#submitformdata').serialize(),
    success:function(data){
      response=JSON.parse(data);
      if(response['true'])
      window.location.reload();
    }
  })
});

function add_leaves() {
  $('#nodata').hide();
$('#new').show();
$('#emp').hide();
$('#leaves').hide();
$('#update').hide();
$('#add').show();

}
