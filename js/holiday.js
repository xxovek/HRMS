fetchholidays();

function fetchholidays(){
    var response=[];
  $.ajax({
    type:'POST',
    url:'../src/displayHolidays.php',
    success:function(data){
      response=JSON.parse(data);
      var count=Object.keys(response).length;
      if(count>0){

      for(var i=0;i<count;i++)
      {
      $("#loadtable").append('<tr><td  class="text-center">'+(i + 1)+'</td><td class="text-center">'+response[i]['holiday_name']+
      '</td><td class="text-center"> '+ response[i]['holiday_date'] +
      '</td><td class="text-center"><div class="btn-group"><button class="label label-primary pull-right" title="Edit Holiday" onClick="edit_holiday('+response[i]['h_id']+',\''+response[i]['holiday_date']+'\',\''+response[i]['holiday_name']+'\');"><i class="fa fa-edit"></i></button><button class="label label-danger pull-right"  title="Remove Holiday" onClick="remove_holiday('+response[i]['h_id']+')"><i class="fa fa-trash"></i></button></div></td></tr>');
    }
    $('#tbldata').show();
    $('#holiday').hide();

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

  }else {

      $('#nodata').show();
    //  $('#new').hide();
      $('#emp').hide();
      $('#holiday').show();
  }
    }
  });
}
function remove_holiday(param){
            $.ajax({
            url:"../src/remove.php",
            method:"POST",
            data:({id:param,tblName:'Holidays',colName:'HolidayId'}),
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


                    $("#btnCancel").on("click", function(){
                      // alert("OK");
                      $("#addBtnDiv").show();
                      $("#update").hide();
                    $("#submitformdata")[0].reset();
                    });

          function edit_holiday(id,date,name){
            $("#hname").val(name);
            $("#date1").val(date);
            $("#holiday_id").val(id);
            $("#addBtnDiv").hide();
            $("#update").show();

          }

$('#submitformdata').on('submit',function(e){
  e.preventDefault();
  $.ajax({
    url:'../src/addHoliday.php',
    type:'POST',
    data: $('#submitformdata').serialize(),
    dataType:'json',
    success:function(response){
      // response=JSON.parse(data);
      if(response.true){
        window.location.reload();
      }
    }
  })
});
