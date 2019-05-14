fetch_employees();

// function fetch_month(param) {
//   $("#months").html("");
//   $.ajax({
//       type: "POST",
//       url: "../src/fetch_month.php",
//       data:{yr:param,month:<?php echo $Joinmonth; ?>,Jyr:<?php echo $Joinyear; ?>},
//       success: function(msg) {
//         // alert(msg);
//         $("#months").html('<option value="">Select Month</option>'+msg);
// }
// });
// }
var emp_arr=[];
  function fetch_employees(){
    emp_arr=[];
      $.ajax({
        url:'../src/fetchEmployees.php',
        method:'POST',
        success:function(data) {
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
                var img='<img class="img-circle" src="../images/user.png" alt="" style=float:left;width:40px;height:40px;margin-right:10px;">';
              }
              else {
                var img='<img class="img-circle" src="../images/'+response[i]['img']+'" alt="" style="float:left;width:40px; height:40px;margin-right:15px;">';
              }
              var str = response[i]['name'];
              var resultantstr = str.replace("-", " ");
              $('#loadtable').append('<tr><td >'+img+'<big><a href="#" onClick="edit_emp('+response[i]['Empid']+');">'+resultantstr+'</a></big><p><small>'+response[i]['designation']+'</small></p></td><td class="text-center"> '+ response[i]['department'] +
              '</td><td class="text-center">'+ response[i]['Joining_date'] + '</td><td class="text-center">'+ response[i]['address'] + '</td><td class="text-center"><div class="btn-group"><button type="button" class="label label-primary pull-right" title="Edit Attendance" name="edit" onClick="edit_emp('+response[i]['Empid']+');"><i class="fa fa-edit"></i></button><button type="button" name="remove" title="Remove Attendance" class="label label-danger pull-right"  onClick="remove_emp('+response[i]['Empid']+');"><i class="fa fa-trash"></i></button></div></td></tr>');
              emp_arr.push(response[i]['Empid']);
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
            $('#PageDataDiv').hide();
          }
        }
      });
    }

function edit_emp(param)
{
  window.location.href="displayAttendanceemp.php?empid="+param;
}


function remove_emp(param)
{
  var response=[];
            $.ajax({
            url:"../src/remove.php",
            method:"POST",
            data:({id:param,tblName:'EmployeeAttendance',colName:'EmpAtteId'}),
            success:function(data){
             response=JSON.parse(data);
              if(response['true']){
                $("#"+param).closest('tr').remove();
                window.location.reload();
            }
          }
            });
  }


  function salaryDays() {
    var yr=$("#year").val();
    var month=$("#months").val();
if(!month){
  alert("Please Select Month");
}
else{
  $.ajax({
    url:'../src/generateallSalaryslips.php',
    data:{arr:emp_arr,yr:yr,month:month},
    success:function(response){
           alert(" Salary Slips for all Employees Generated");
           // window.location.reload();
         }
       });
  }
}
