


function fetch_PFDetails(empid){
  var empid = $("#empid").val();

  $.ajax({
    url:'../src/fetchEmpPFInfo.php',
    type:'POST',
    dataType:'json',
    data:{empid:empid},
    success:function(response){
      // alert("ok");
      //showed in list
      $("#pfnumSpan").html(response.pfnumber);
      $("#UAEaccnumSpan").html(response.UAENumber);

//form id set fetched values
      $("#PFInfoAccId").val(response.PFInfoId);
      $("#pfnum").val(response.pfnumber);
      $("#uaenum").val(response.UAENumber);

    }
  });
}


function submitPFAccountInfo(empid){
let checkInput = 0;
let pfnum = document.getElementById('pfnum').value;
let uaenum = document.getElementById('uaenum').value;
if(pfnum == "" ){
  checkInput = 1;
  $("#Error_ipEmpPFnum").html("<font color='red'>Enter PF Number</font>");
}
else if (uaenum == "") {
  checkInput = 1;
  $("#Error_ipEmpPFnum").html("");
  $("#Error_ipUAEnum").html("<font color='red'>Enter UAE Number</font>");
}
if(checkInput === 0 ){
  $("#Error_ipEmpPFnum").html("");

    $("#Error_ipUAEnum").html("");
$.ajax({
    type: "POST",
    url: "../src/addEmpPFAccInfo.php",
    data: $('#PFInfoAccForm').serialize()+ "&empid="+empid,
    // data:{pfnum:pfnum,uaenum:uaenum,empid:empid},
    dataType:'json',
    success: function(response) {
      // alert(response.add);
      if(response.add === true){
        $("#showPFInfoRowDiv").show();
        fetch_PFDetails(empid);
        $("#PFInfoAccFormDiv").hide();

        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>PF Details Added Successfully</strong></font></div>";
        $('#msg2').html(msg2);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);

      }else if (response.update === true){
        $("#showPFInfoRowDiv").show();
        fetch_PFDetails(empid);
        $("#PFInfoAccFormDiv").hide();

        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>PF Details Updated Successfully</strong></font></div>";
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

function gobackInPFForm(){
  $("#showPFInfoRowDiv").show();
  $("#PFInfoAccFormDiv").hide();
  $("#Error_ipEmpPFnum").html("");
  $("#Error_ipUAEnum").html("");
}
