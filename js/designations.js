fetchdesignation();
fetch_department();
$('.select2').select2();

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


function fetchdesignation(){
    var response=[];
  $.ajax({
    type:'POST',
    url:'../src/displayDesignation.php',
    dataType:'json',
    success:function(response){
      // response = JSON.parse(data);
      var count=response.length;
      // alert(response[0].deptId);
      if(count>0){
      for(var i=0;i<count;i++){
      $("#loadtable").append(
      '<tr><td class="text-center">'+(i + 1)
      +'</td><td class="text-center">'
      +response[i].design_name+'</td><td class="text-center">'
      +response[i].deptName+'</td><td class="text-center"><div class="btn-group"><button class="label label-primary pull-right" title="Edit Designation" onClick="edit_designationForm(\''+response[i].design_id+'\',\''+response[i].design_name+'\',\''+response[i].deptId+'\',\''+response[i].deptName+'\');"><i class="fa fa-edit"></i></button><button class="label label-danger pull-right" title="Remove Designation" onClick="remove_designation('+response[i].design_id+')"><i class="fa fa-trash"></i></button></div></td></tr>');
    }
    $('#tbldata').show();
    // $('#desg').hide();

     $("#datble").DataTable({
       bPaginate: $('#datble tbody tr').length>10,
       order: [],
       columnDefs: [ { orderable: false, targets: [0,1,2] } ],
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
      // $('#new').hide();
      $('#emp').hide();
      $('#desg').show();
  }
    }
  });
}

function edit_designationForm(desi_id,desi_name,dept_id,deptName){
  $("#designationname").val(desi_name);
  $("#designation_id").val(desi_id);
  $("#department").append("<option  value='"+dept_id+"' selected=selected >"+deptName+"</option>");
  $('#department').trigger('change').val(dept_id);
  $("#adddesg").hide();
  $("#updatedesg").show();
}

       $("#btnCancel").on("click", function(){
          $("#adddesg").show();
          $("#updatedesg").hide();
          $("#department").append("<option  value='' selected=selected >Select Department</option>");
          $('#department').trigger('change');
          $("#submitformdata")[0].reset();
        });

function remove_designation(param){
            $.ajax({
            url:"../src/remove.php",
            method:"POST",
            data:({id:param,tblName:'Designations',colName:'DesigId'}),
            success:function(data){
              response=JSON.parse(data);
              if(response['true'])
              {
                $("#"+param).closest('tr').remove();
                window.location.reload();
            }
          }
            });
          }

// function edit_designation(id,dept_Id,DeptName,designname){

//   alert(id);

// }

$('#submitformdata').on('submit',function(e){
  e.preventDefault();
  $.ajax({
    type:'POST',
    url:'../src/addDesignation.php',
    data: $('#submitformdata').serialize(),
    success:function(data){
      response=JSON.parse(data);
      if(response['true'])
      window.location.reload();
    }
  })
});
// function new_desg() {
//   $('#nodata').hide();
// $('#new').show();
// $('#emp').hide();
// $('#desg').hide();
// $('#updatedesg').hide();
// $('#adddesg').show();
//
// }
