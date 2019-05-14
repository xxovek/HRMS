
fetchattendence();
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  function fetchattendence()
  {
    $("#loadtable").empty();
    // $("#datble > tbody").html("");
    var yr=$("#year").val();
    // var month=$("select[id='months'] option:selected").index();
    var month=$("#months").val();

  $.ajax({
    type:'POST',
    url:'../src/displayAttendance.php',
    data:{yr:yr,month:month},
    dataType :'json',
    success:function(response){
      // alert(response)
      var count=Object.keys(response).length;
      // if(count>0){
      for(var i=0;i<count;i++)
      {
        var status="PRESENT";
        color1='style="color:green"';

        if (!(response[i]['time_in'])) {
          response[i]['time_in']='----';
          response[i]['time_out']='----';
          response[i]['hour']='----';
          if(!(response[i]['status'])){
          status="ABSENT";
          color1='style="color:red"';
        }
          else {
            status=response[i]['status'];
            color1='style="color:orange"';
          }
        }
      $("#loadtable").append('<tr><td  class="text-center"><span class="dot">'+response[i]['date1']+'</span><br><br>'+response[i]['day']+'</td><td class="text-center">'+response[i]['time_in']+
      '</td><td class="text-center"> '+ response[i]['time_out'] +'</td><td class="text-center"> '+ response[i]['hour'] +'&nbsp; Hours</td><td class="text-center"'+color1+'> '+status+'</td></tr>');
      }
    // $('#tbldata').show();

    var table = $("#datble").DataTable({
      lengthChange: false,
      // destroy:true,
      buttons: ['copy', 'excel', 'pdf','print']
    });
  table.buttons().container()
  .appendTo( '#datble_wrapper .col-md-6:eq(0)' );

  // }else {
  //   $('#tbldata').hide();
  //     $('#nodata').show();
  //
  // }
  }
  });
  }
  function fetch_month(param) {
    $("#months").html("");
    $.ajax({
        type: "POST",
        url: "../src/fetch_month.php",
        data:{yr:param,month:<?php echo $Joinmonth; ?>,Jyr:<?php echo $Joinyear; ?>},
        success: function(msg) {
          // alert(msg);
          $("#months").html('<option value="">Select Month</option>'+msg);
  }
  });
  }
