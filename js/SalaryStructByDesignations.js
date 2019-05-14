
fetch_designation();
fetch_department();
setSelectOptions();
function CreateSalStruct(){
    // alert("created");
    $('#newFormDiv').show();
$('#tbldata').hide();
$('#addSalaryCompo').hide();
$('#nodata').hide();
}

// function setSelectOptionsForEmp(){
//     $.ajax({
//       url : '../src/fetch_emp.php',
//       method : 'POST',
//       success : function(data){
//         // alert(data);
//         $("#EmpOptId").html(data);
//       }
//     });
//     }

$('.select2').select2();



function calculate(){
  // alert("ok");
  let annualCTC = document.getElementById('CTC_input').value;
  alert(annualCTC);
  InvesmentAmtInput
  HRAamtInput
  EPFAmtInput
  HRentAmtInput
  basicSalAmtInput

  let grossSalary = 0;
  // -------------- LIST OF Formule ---------------//
  // CTC = Gross Salary + PF + Gratuity
  // Gross Salary = Basic Salary + HRA + Other Allowances
    // Net salary or take-home salary is obtained after 
  // deducting income tax at source (TDS) and other deductions 
  // as per the relevant company policy
  // Net Salary = Basic Salary + HRA + Allowances - Income Tax - Employer's Provident Fund - Professional Tax
  
  
  
  grossSalary = CTC - EPF - Gratuity;



}


function salaryStructFormData(){
  alert("ok");
}

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
function fetch_designation(){
  $.ajax({
    url:"../src/fetch_designation.php",
    method:"POST",
    success:function(data){
      $("#designation").html(data);
          // $("#empdesignation").html(data);
          // document.getElementById('empdesignation').innerHTML =data;
    }
  });
}
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