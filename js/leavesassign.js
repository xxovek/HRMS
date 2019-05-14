fetchleaves();
fetch_financialYear();

function fetch_financialYear(){
$.ajax({
 url:'../src/FetchCompanyDetails.php',
 type:'POST',
 dataType:'json',
 success:function(response){
  //  alert(response.finaYear);
   var finYearArr = response.finaYear.split('-'); 
  // alert(finYearArr[0]);
  $("#fromdate").val(finYearArr[0]);
  $("#uptodate").val(finYearArr[1]);
 }
})
}

function fetchleaves(){
  $("#loadtable").empty();

    var response=[];
  $.ajax({
    type:'POST',
    url:'../src/displayAssignLeaves.php',
    success:function(data){

       // alert(data);
      response = JSON.parse(data);
      // alert(response[0]['paidFlag']);
      var paidFlagStr = '';
      var count=Object.keys(response).length;
      if(count>0){

      for(var i=0;i<count;i++){
        if(response[i]['paidFlag'] === "1"){
          paidFlagStr = "Paid";
        }else {
          paidFlagStr = "Unpaid";

        }

      $("#loadtable").append('<tr><td  class="text-center">'
      +(i + 1)+'</td><td >'
      +response[i]['leave_type']+'</td><td >'
      +response[i]['fdate']+'</td><td >'
      +response[i]['udate']+
      '</td><td>'
      +response[i]['numdays']+'</td><td>'+paidFlagStr+'</td><td><div class="btn-group"><button class="label label-primary pull-right" title="EDit LeaveType" onClick="edit_leavetype('
      +response[i]['leave_id']+',\''+response[i]['leave_type']+'\',\''+response[i]['fromdate']+'\',\''+response[i]['uptodate']+'\',\''+response[i]['numdays']+'\','+response[i]['paidFlag']+');"><i class="fa fa-edit"></i></button><button class="label label-danger pull-right" title="Remove Leavetype" onClick="remove_leavetype('
      +response[i]['leave_id']+')"><i class="fa fa-trash"></i></button></div></td></tr>');
    }
    $('#tbldata').show();

  $("#datble").DataTable({
    bPaginate: $('#datble tbody tr').length>10,
    order: [],
    columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5] } ],
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

      //$('#nodata').show();
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

          function edit_leavetype(id,leavetype,fromdate,uptodate,numdays,paidUnpaidFlag){
            $('#submitformdata')[0].reset();
            $("#leavetype").val(leavetype);
            $("#leave_id").val(id);
            $("#fromdate").val(fromdate);
            $("#uptodate").val(uptodate);
            $("#numdays").val(numdays);

            if (paidUnpaidFlag == "1") {
                 document.getElementById("type1").checked = true;
            }
            else if(paidUnpaidFlag == "0"){
                 document.getElementById("type2").checked = true;
            }
            else {
              document.getElementById("type1").checked = true;
            }
            $("#add").hide();
            $("#update").show();
            // $("#cancel").hide();
            $("#cancel1").show();
          }

$('#submitformdata').on('submit',function(e){
  e.preventDefault();

    $.ajax({
      type:'POST',
      url:'../src/addLeaves.php',
      data: $('#submitformdata').serialize(),
      success:function(data){
        response=JSON.parse(data);
        if(response['add']){

        var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Leaves Type Added Successfully..!!</strong></font></div>";
        $('#msgErrorForDays').html(msg2);
        window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove();
          });
      }, 3000);
      $('#submitformdata')[0].reset();

      // fetchleaves();

        window.location.reload();
      }
    else if(response['update']){

      var msg2= "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong><font color='black'>Leaves Type Updated Successfully..!!</strong></font></div>";
      $('#msgErrorForDays').html(msg2);
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3000);
    $('#submitformdata')[0].reset();

    // fetchleaves();

      window.location.reload();
    }
    }

    });

});

function add_leaves(){
$('#nodata').hide();
$('#new').show();
$('#emp').hide();
$('#leaves').hide();
$('#update').hide();
$('#add').show();
}
