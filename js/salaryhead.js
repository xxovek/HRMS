
DiplayTblData();

function DiplayTblData(){
    var response=[];
  $.ajax({
    type:'POST',
    url:'../src/displaySalaryHeads.php',
    success:function(data){
      response=JSON.parse(data);
      var count=Object.keys(response).length;
        var creditType = '';
      if(count>0){

      for(var i=0;i<count;i++)
      {

        if (response[i]['CredDebit'] === 'C') {
          creditType = 'Credit';
        }
        else {
          creditType = 'Debit';
        }

      $("#loadtable").append('<tr><td  class="text-center">'
      +(i + 1)+'</td><td class="text-center">'
      +response[i]['HeadName']+
      '</td><td class="text-center">'
      +creditType+
      '</td><td class="text-center"><div class="btn-group"><button class="label label-primary pull-right" title="Edit LeaveType" onClick="edit_update(\''+ response[i]['SalaryHeadId'] +'\',\''+response[i]['HeadName']+'\',\''+response[i]['CredDebit']+'\')"><i class="fa fa-edit"></i></button><button class="label label-danger pull-right" title="Remove Leavetype" onClick="remove_SalaryHeads('+response[i]['SalaryHeadId']+')"><i class="fa fa-trash"></i></button></div></td></tr>');
    }



    $('#tbldata').show();

    $("#datble").DataTable({
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
  // table.buttons().container()
  // .appendTo( '#datble_wrapper .col-md-6:eq(0)');

  }else {
      $('#nodata').show();
  }
    }
  });
}

function edit_update(id,salaryhead,creditType){

  $("#add").hide();
  $("#update").show();
    $("#SalaryHead_id").val(id);
    $("#ip_salaryhead").val(salaryhead);
  if (creditType === 'C')
     document.getElementById("type1").checked = true;
  else
    document.getElementById("type2").checked = true;
}

$("#btnCancel").on("click", function(){
$("#add").show();
$("#update").hide();
$("#submitformdata")[0].reset();
});

$('#submitformdata').on('submit',function(e){
  e.preventDefault();
  $.ajax({
    type:'POST',
    url:'../src/insertSalaryHeads.php',
    data: $('#submitformdata').serialize(),
    success:function(data){
      response=JSON.parse(data);
      if(response['true'])
     window.location.reload();
    }
  })
});

function remove_SalaryHeads(param)
{
            $.ajax({
            url:"../src/remove.php",
            method:"POST",
            data:({id:param,tblName:'SalaryHeads',colName:'SalaryHeadId'}),
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
