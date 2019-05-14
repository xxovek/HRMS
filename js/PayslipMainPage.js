
DiplayTblData();
$('.select2').select2();

//edit_forUpdate(\''+ response[i]['Empid'] +'\',\''+response[i]['HeadName']+'\',\''+response[i]['CredDebit']+'\')
function DiplayTblData(){
    var response=[];
  $.ajax({
    type:'POST',
    url:'../src/FetchEmpSalTableData.php',
    success:function(data){
    //   alert(data);
      response = JSON.parse(data);
      // alert(response);

      var count=Object.keys(response).length;
        if(count>0){
          $('#tbldata').show();
         var img = '';
      for(var i=0;i<count;i++){
        if(response[i]['department'] === null || response[i]['department'] === "" )
        {
          response[i]['department'] = "-";
        }
        if(response[i]['designation'] === null || response[i]['designation'] === "" )
        {
          response[i]['designation'] = "-";
        }
        if(response[i]['img'] === '')
        {
           img='<img class="img-circle" src="../images/user.png" alt="" style="float:left;width:40px;height:40px;margin-right:10px;">';
        }
        else {
           img='<img class="img-circle" src="../images/'+response[i]['img']+'" alt="" style="float:left;width:40px; height:40px;margin-right:15px;">';
        }

        $("#loadtable").append('<tr><td>'+img+'<big>'+response[i]['name']+'</big><p><small>'
        +response[i]['designation']+'</small></p></td><td class="text-center">'
        +response[i]['department']+
        '</td><td class="text-center">'
        +response[i]['contactNumber']+
        '</td><td class="text-center">'
        +response[i]['formDate']+ " "+ 'To' + " "+response[i]['uptoDate']+
        '</td><td class="text-center"><div class="btn-group" ><button class="label label-warning pull-right" title="View All Payslips" onClick="SalarySlipsPage(\''+ response[i]['Empid']+'\',\''+response[i]['name']+'\')"><i class="fa fa-eye" ></i></button></td></tr>');
      }
      $("#SalaryTable").DataTable({
        bPaginate: $('#SalaryTable tbody tr').length>10,
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

  }else {
     $('#nodata').show();
     $('#tbldata').hide();
  }
    }
  });
}



// $("#gobackBtnforMontwiseListTblDiv").on("click",function(){
//   $("#nodata").hide();
//     $("#tbldata").show();
//   $("#previewRowDiv").hide();
// });

function SalarySlipsPage(emp_id,EmpName){
  // alert(EmpName);
  $("#previewRowDiv").show();
     $("#nodata").hide();
     $("#tbldata").hide();
     $("#data").load('AllEmployeyPayslips.php',{'id':emp_id,'EmpName':EmpName});
}
//
// function SalarySlips(emp_id,month){
//   var yr = document.getElementById('year').value;
// alert(month);
//     $("#previewRowDiv").show();
//     $("#nodata").hide();
//     $("#tbldata").hide();
//     // $("#data").load('PaymentSlip.php',{'id':emp_id,'fromDate':fromDate,'uptoDate':uptoDate});
//     $("#data").load('PaymentSlip.php',{'id':emp_id,'month':month,'yr':yr});
// }
