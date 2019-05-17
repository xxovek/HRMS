
function fetch_BankAccountDetails(param){
  var empid = $("#empid").val();

  $.ajax({
    url:'../src/fetchEmpBankInfo.php',
    type:'POST',
    dataType:'json',
    data:{empid:empid},
    success:function(response){
      // alert("ok");
      $("#ahnSpan").html(response.AccHolderName);
      $("#banknmSpan").html(response.BankName);
      $("#branchnmSpan").html(response.BranchName);
      $("#ifsccodeSpan").html(response.ifsc);
      $("#accnumSpan").html(response.AccountNumber);

      $("#EmpFullName").val(response.AccHolderName);
      $("#bankName").val(response.BankName);
      $("#branchName").val(response.BranchName);
      $("#bifsc").val(response.ifsc);
      $("#AccNumber").val(response.AccountNumber);
      $("#BankInfoId").val(response.AccountNumber);

    }

  });

}
function goback(){
  $("#showAccountInfoDiv").show();
     $("#AccountFormDiv").hide();
}


function submitAccountInfo(empid){

  var statusFlag = 0;

  if((document.getElementById('EmpFullName').value) == ""){
  var statusFlag = 1;
   
  }
  else if((document.getElementById('bankName').value) == ""){
  var statusFlag = 1;
   
  }else if((document.getElementById('branchName').value) == ""){
  var statusFlag = 1;
   
  }
  else if((document.getElementById('bifsc').value) == ""){
  var statusFlag = 1;
   
  }
  else if((document.getElementById('AccNumber').value) == ""){
    var statusFlag = 1;
  }

if( statusFlag === 0){

  // alert(empid);
  $.ajax({
      type: "POST",
      url: "../src/addEmpBankAccInfo.php",
      data: $('#AccountForm').serialize()+ "&empid="+empid,
      // data:{};
      dataType:'json',
      success: function(response) {
        // alert(response.add);
        if(response.add === true){
          $("#showAccountInfoDiv").show();
          fetch_BankAccountDetails(empid);
          $("#AccountFormDiv").hide();

          var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Bank Account Details Added Successfully</strong></font></div>";
          $('#msg2').html(msg2);
          window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);

        }else if (response.update === true){
          $("#showAccountInfoDiv").show();
          fetch_BankAccountDetails(empid);
          $("#AccountFormDiv").hide();

          var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Bank Account Details Updated Successfully</strong></font></div>";
          $('#msg2').html(msg2);
          window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
        }else{

        }
      }
    });
  }
}
