fetchdepartment();

function fetchdepartment(){
    var response=[];
    $.ajax({
          type:'POST',
          url:'../src/displayDepartment.php',
          success:function(data){
            // alert(data);
                  response=JSON.parse(data);
                  var count=Object.keys(response).length;
                  if(count>0){
                    for(var i=0;i<count;i++)
                    {
                      $("#loadtable").append('<tr><td  class="text-center">'+(i + 1)+'</td><td class="text-center">'+response[i]['dept_name']+
                      '</td><td class="text-center"><div class="btn-group"><button class="label label-primary pull-right" title="Edit Department" onClick="edit_dept('+response[i]['d_id']+',\''+response[i]['dept_name']+'\');"><i class="fa fa-edit"></i></button><button class="label label-danger pull-right" title="Remove Department" onClick="remove_department('+response[i]['d_id']+')"><i class="fa fa-trash"></i></button></div></td></tr>');
                    }
          $('#tbldata').show();
          $('#dept').hide();

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
    // table.buttons().container()
    // .appendTo( '#datble_wrapper .col-md-6:eq(0)' );
  }else {
      $('#nodata').show();
      //$('#new').hide();
      $('#emp').hide();
      $('#dept').show();
  }
    }
  });
}

function remove_department(param){
            $.ajax({
            url:"../src/remove.php",
            method:"POST",
            data:({id:param,tblName:'Departments',colName:'DeptId'}),
            success:function(data){
              response=JSON.parse(data);
              if(response['true']){
                $("#"+param).closest('tr').remove();
                window.location.reload();
            }
          }
            });
  }

          function edit_dept(id,deptname){
            $("#departmentadd").hide();
            $("#departmentupdate").show();
            $("#departmentname").val(deptname);
            $("#department_id").val(id);

            // $("#departmentcancel").hide();
            // $("#updatedepartmentcancel").show();
          }

          $("#btnCancel").on("click", function(){
            $("#departmentadd").show();
            $("#departmentupdate").hide();
          $("#submitformdata")[0].reset();
          });

$('#submitformdata').on('submit',function(e){
  e.preventDefault();
  $.ajax({
    type:'POST',
    url:'../src/addDepartment.php',
    data: $('#submitformdata').serialize(),
    success:function(data){
      response=JSON.parse(data);
      if(response['true'])
      window.location.reload();
    }
  })
});
// function new_dept() {
//   $('#nodata').hide();
// $('#new').show();
// $('#emp').hide();
// $('#dept').hide();
// $('#departmentupdate').hide();
// $('#departmentadd').show();
//
// }
