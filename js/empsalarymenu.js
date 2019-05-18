setSelectOptionsForEmp();
setSelectOptions();
DiplayTblData();

$("#startdatepicker").daterangepicker();

$('.select2').select2();

function setSelectOptions(){

  $.ajax({
    url : '../src/fetch_optValforSalHeadsSelect.php',
    method : 'POST',
    success : function(data){
      $("#optId").html(data);
      $("#options").html(data);
    }
  });
}

function setSelectOptionsForEmp(){
$.ajax({
  url : '../src/fetch_emp.php',
  method : 'POST',
  success : function(data){
    // alert(data);
    $("#EmpOptId").html(data);
  }
});
}

// $("#")
//  onkeypress="return isInteger(event);
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
     return true;
}

function storeTblValuesItem2() {
    var TableData = new Array();
    $('#sampleTbl2 tr').each(function(row, tr) {
      let cmt = $(tr).find('td:eq(0)').data('id');
      let amt = $(tr).find('td:eq(2)').data('id');
      let perc = $(tr).find('td:eq(1)').data('id')
      TableData[row] = {
                     "compo": cmt,
                     "amt": amt,
                     "perc": perc,
                 }
    });
    return TableData;
}

function addrow2(){
  // $("#options").trigger('change').val("");
  var CTC_Val = document.getElementById('CTC_input').value;

  if (CTC_Val === "") {
    $("#CTC_error_msg").html("<font color='red' size='2'>Please Enter CTC Amount First</font>");
    setTimeout(function(){
    $("#CTC_error_msg").html("");
  },3000);
}
else{

  var Component_val = $("#cm").val();

  var Component_id = document.getElementById('cm').getAttribute("name");
  var percentVal = $("#Percent").val();
   if(percentVal === ""){
      $('#FillPerc_err').html("<font color='red' size='2'>Please Select Component</font>");
    setTimeout( function(){
      $('#FillPerc_err').html("");
    },1000);
   }
else{
  var Amount_val = parseFloat(parseFloat(percentVal/100) * CTC_Val);
 // alert(Component_txt);
  if(Component_val ===""){
    $('#CompoSel_err').html("<font color='red' size='2'>Please Select Component</font>");
    setTimeout( function(){
      $('#CompoSel_err').html("");
    },3000);
  }
// else if (Amount_val ==="") {
//   $('#FillAmt_err').html("<font color='red' size='2'>Please Enter Amount</font>");
//   setTimeout( function(){
//     $('#FillAmt_err').html("");
//   },3000);
// }
  else {

    var markup = "<tr ><td contenteditable='false'  data-id='"+ Component_id +"'>" + Component_val + "</td><td contenteditable='false' data-id='"+ percentVal +"'>"+percentVal+"</td><td onkeypress='return isNumberKey(event);' style='background-color:#eee;opacity:1'  data-id='"+ Amount_val +"'>" + Amount_val
    + "</td><td class=''><button type='button' class='btn btn-danger' id='remove' onclick='remove_item(this);'><i class='fa fa-minus'></i></button></td></tr>";
    $("#Tab_logic").append(markup);
    $("#cm").val("");
    $("#Percent").val("");
    $("#amt").val("");

    var myTab = document.getElementById('Tab_logic');
    var a, sum = 0;
    for (var i = 0; i < myTab.rows.length; i++) {
        var objCells = myTab.rows.item(i).cells;
      }
   }
 }
}
}



$("#options").on('change',function(){
  // $("#footerTotalAmt").val("0.00");
        var arr = $(this).val() || "";
        str = arr.split('-');

        var TableData1;
        TableData1 = storeTblValuesItem2();
          // alert(TableData1.[0]['compo']);
        for (let i = 0; i < TableData1.length; i++) {
          //alert(TableData1[i]['compo']);
          if(TableData1[i]['compo'] == str[0] ){
            str[0] = "";
          }
        }

        if(str[0] === ""){
          $('#CompoSel_err').html("<font color='red' size='2'>Already Selected</font>");
          setTimeout( function(){
            $("#options").trigger('change').val("");
            $('#CompoSel_err').html("");
          },3000);
        }else {
          $("#cm").val(str[1]);
        //  $("#cm").text(str[1]);
        // $("#options").trigger('change').val("");
        $('#cm').attr('name', str[0]);
        }
        // debugger
});

function remove_item(param) {
  var row = param.parentNode.parentNode;
  row.parentNode.removeChild(row);
}

$("#EmpOptId").on('change' , function() {
  let emp_id = $(this).val() || "";
  fetchEmpDetails(emp_id);
});

function addTblList1(event){
  // alert("ok");
  event.preventDefault();
  var funCall = 0;
  var ctcValue = document.getElementById('CTC_input').value;
  
  var emp_id = document.getElementById('EmpidTxt').value;
  var DateRange = document.getElementById('startdatepicker').value;
  var S_Edate = DateRange.split('-');
  var S_Date = moment(new Date(S_Edate[0])).format("YYYY-MM-DD");
  var E_Date = moment(new Date(S_Edate[1])).format("YYYY-MM-DD");
  var TableValues;
  TableValues = storeTblValuesItem2();

  if (emp_id === "" || emp_id === null) {
    $("#EmpId_error").html("<font color='red' size='2'>Select Employee First</font>");
    setTimeout(function(){
    $("#EmpId_error").html("");
  },3000);
}else if (DateRange === "" || DateRange === null) {
 $("#startDate_err").html("<font color='red' size='2'>Enter Date Range</font>");
 setTimeout(function(){
   $("#startDate_err").html("");
 },3000);
}else if( Date.parse(S_Edate[0]) == Date.parse(S_Edate[1]) || Date.parse(S_Edate[0]) > Date.parse(S_Edate[1]) ){
$("#startDate_err").html("<font color='red' size='2'>End Date Required Greater</font>");
setTimeout(function(){
  $("#startDate_err").html("");
},3000);
}else if (TableValues.length <= 0) {
  $('#CompoSel_err').html("<font color='red' size='2'>Select Components</font>");
  setTimeout( function(){
    $('#CompoSel_err').html("");
  },3000);
}
else {
  $.ajax({
    url : '../src/salaryHeadTblComponentSdata.php',
    method : 'POST',
    dataType:'json',
    data: {emp_id:emp_id,ctcValue:ctcValue,TableValues:TableValues,enddate:E_Date,startdate:S_Date,funCall:funCall},
    success:function(response){
      alert(response.add);
      $("#EmpOptId").val("");
    //  window.location.reload();
    },
  })
}
// debugger
}

function updateTblList1(event){
  event.preventDefault();
  var funCall = 1;
  // alert(funCall);
  var ctcValue = document.getElementById('CTC_input').value;
  var emp_id = document.getElementById('EmpidTxt').value;
  var DateRange = document.getElementById('startdatepicker').value;
  var S_Edate = DateRange.split('-');
  // alert(DateRange);
  var S_Date = moment(new Date(S_Edate[0])).format("YYYY-MM-DD");
  var E_Date = moment(new Date(S_Edate[1])).format("YYYY-MM-DD");
  var TableValues;
  TableValues = storeTblValuesItem2();

  if (emp_id === "" || emp_id === null) {
    $("#EmpId_error").html("<font color='red' size='2'>Select Employee First</font>");
    setTimeout(function(){
    $("#EmpId_error").html("");
  },3000);
}else if (DateRange === "" || DateRange === null) {
 $("#startDate_err").html("<font color='red' size='2'>Enter Date Range</font>");
 setTimeout(function(){
   $("#startDate_err").html("");
 },3000);
}else if( Date.parse(S_Edate[0]) == Date.parse(S_Edate[1]) || Date.parse(S_Edate[0]) > Date.parse(S_Edate[1]) ){
$("#startDate_err").html("<font color='red' size='2'>End Date Required Greater</font>");
setTimeout(function(){
  $("#startDate_err").html("");
},3000);
}else if (TableValues.length <= 0) {
  $('#CompoSel_err').html("<font color='red' size='2'>Select Components</font>");
  setTimeout( function(){
    $('#CompoSel_err').html("");
  },3000);
}
else {
  $.ajax({
    url : '../src/salaryHeadTblComponentSdata.php',
    method : 'POST',
    data: {emp_id:emp_id,ctcValue:ctcValue,TableValues:TableValues,enddate:E_Date,startdate:S_Date,funCall:funCall},
    success:function(data){
      // alert("done");
      $("#EmpOptId").val("");
      $("#submitformdata").trigger("reset");
    //  window.location.reload();
    },
  })
}

}


function fetchEmpDetails(emp_id){
// alert(emp_id);
if(emp_id != "" || emp_id != null)
{
  $("#newFormDiv").show();
  $('#tbldata').hide();


let response = [];
  $.ajax({
    url : '../src/edit_emp.php',
    method : 'POST',
    // dataType : 'json',
    data : {Emp_id:emp_id},
    success: function(data){
      // alert(data);
      $("#EmpInfoDiv").show();
    response = JSON.parse(data);
      $("#EmpidTxt").val(emp_id);
      $("#Ename").val(response['name']);
      $("#Edesi").val(response['DesigName']);
      $("#Email").val(response['useremail']);
      $("#Ebdate").val(response['birthdate']);
      $("#EJoinDate").val(response['Joiningdate']);
      $("#gen").val(response['gender']);
      $("#mob").val(response['userphone']);
      $("#dept").val(response['DeptName']);
    }

  });
}else {
}
}


function addSalCompo(){
$('#newFormDiv').show();
$('#tbldata').hide();
$('#addSalaryCompo').hide();
$('#nodata').hide();
}


//edit_forUpdate(\''+ response[i]['Empid'] +'\',\''+response[i]['HeadName']+'\',\''+response[i]['CredDebit']+'\')
function DiplayTblData(){
    var response=[];
  $.ajax({
    type:'POST',
    url:'../src/FetchEmpSalTableData.php',
    success:function(data){
      // alert(data);
      response = JSON.parse(data);
      // alert(response);

      var count=Object.keys(response).length;
        if(count>0){
          $('#tbldata').show();

      for(var i=0;i<count;i++)
      {
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
          var img='<img class="img-circle" src="../images/user.png" alt="" style="float:left;width:40px;height:40px;margin-right:10px;">';
        }
        else {
          var img='<img class="img-circle" src="../images/'+response[i]['img']+'" alt="" style="float:left;width:40px; height:40px;margin-right:15px;">';
        }


        $("#loadtable").append('<tr><td>'+img+'<big>'+response[i]['name']+'</big><p><small>'
        +response[i]['designation']+'</small></p></td><td class="text-center">'
        +response[i]['department']+
        '</td><td class="text-center">'
        +response[i]['contactNumber']+
        '</td><td class="text-center">'
        +response[i]['formDate']+ " "+ 'To' + " "+response[i]['uptoDate']+
        '</td><td class="text-center"><div class="btn-group"><button class="label label-warning pull-right" title="View Salary Structure" onClick="PreviewSalarySlip(\''+ response[i]['Empid']+'\',\''+response[i]['formDate']+'\',\''+response[i]['uptoDate']+'\',\''+response[i]['Tot_sal']+'\')"><i class="fa fa-eye" ></i></button><button class="label label-primary pull-right" title="Edit Salary Settings" onClick="edit_forUpdate(\''+ response[i]['Empid'] +'\',\''+response[i]['formDate']+'\',\''+response[i]['uptoDate']
        +'\')"><i class="fa fa-edit"></i></button><button class="label label-danger pull-right" title="Remove Row" onClick="remove_SalaryStruct(\''+
        response[i]['Empid'] +'\',\''+response[i]['formDate']+'\',\''+response[i]['uptoDate']+'\')"><i class="fa fa-trash"></i></button></div></td></tr>');
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

//<button class="btn btn-link" title="View Payslip Structure" onClick="PreviewSalarySlip(\''+ response[i]['Empid'] +'\',\''+response[i]['formDate']+'\',\''+response[i]['uptoDate']+'\')"><i class="fa fa-eye" ></i></button>
// <a href="../Public_html/salaryslip.php?id='+response[i]['Empid']+'" target="_blank" class="btn btn-primary btn-link" title="View Payslip Structure"><i class="fa fa-eye" ></i></a>
  }else {
     $('#nodata').show();
     $('#tbldata').hide();
  }
    }
  });
  // debugger
}

function remove_SalaryStruct(emp_id,fromDate,uptoDate){

  var response = [];
 $.ajax({
   url:'../src/deleteSalStruct.php',
   method:'POST',
   data:{emp_id:emp_id,fromDate:fromDate,uptoDate:uptoDate},
   success: function(data){
     response = JSON.parse(data);
     if(response['success'] === true){
       alert("Success");
        window.location.reload();
     }
     else {
       alert("Error");
     }

   },
 })
}



function PreviewSalarySlip(emp_id,fromDate,uptoDate,Salary){
  $("#addSalaryCompo").hide();
  $("#formrowDiv").hide();
  $("#previewRowDiv").show();
  $("#nodata").hide();
  $("#tbldata").hide();
  $("#data").load('salaryslip.php',{'emp_id':emp_id,'fromDate':fromDate,'uptoDate':uptoDate,'Salary':Salary});
}


function edit_forUpdate(emp_id,fromDate,uptoDate){
  // var funCall = 1;
  $("#EmpOptIdDiv").hide();

  // alert("edit");
  $("#addList").hide();
  $("#addSalaryCompo").hide();
  $("#updateList").show();
  var response = [];
  // alert(emp_id);
  $.ajax({
    url:'../src/fetchComponents.php',
    method:'POST',
    data:{emp_id:emp_id,fromDate:fromDate,uptoDate:uptoDate},
    success:function(data){
// alert(data);
response = JSON.parse(data);
var count=Object.keys(response).length;
for (var i = 0; i < count; i++) {
  // alert(response[i]['HeadName']);
  var fdate = moment(new Date(response[i]['formDate'])).format("MM/DD/YYYY");
  var edate = moment(new Date(response[i]['uptoDate'])).format("MM/DD/YYYY");

// $("#EmpOptId").append("<option value="+response[i]['Empid']+" selected=selected>"+response[i]['Empid']+"</option>");
// fetchEmpDetails(response[i]['Empid']);
fetchEmpDetails(emp_id);

$("#startdatepicker").val(fdate+"-"+edate);
$("#EmpidTxt").val(response[i]['Empid']);
$("#CTC_input").val(response[i]['ctc_value']);

var markup = "<tr ><td contenteditable='false'  data-id='"+ response[i]['SalaryHeadId'] +"'>" + response[i]['HeadName'] + "</td><td contenteditable='false' data-id='"+ response[i]['percentageVal'] +"'>"+response[i]['percentageVal']+"</td><td onkeypress='return isNumberKey(event);' style='background-color:#eee;opacity:1'  data-id='"+ response[i]['Amount'] +"'>" + response[i]['Amount']
+ "</td><td class=''><button type='button' class='btn btn-danger' id='remove' onclick='remove_item(this);'><i class='fa fa-minus'></i></button></td></tr>";
$("#Tab_logic").append(markup);

}

    }
  })
}
