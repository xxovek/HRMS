function open_modal() {

    var form = document.getElementById("add_new_client");
    form.reset();
    $("#new_client").show();
}

function getinvoicetc(){
  $.ajax({
  type: "POST",
  url: "../fetchtermcondition.php",
  success: function(data) {
    response = JSON.parse(data);
    $("#terms").val(response['invoicetc']);
  },
  error: function(data, errorThrown) {
      alert('request failed :' + errorThrown);
  }
  });
}

function get_item_name() {
            $("#error_select_item_msg").html("");
            var item_name = document.getElementById('select_item').value;
            if(item_name===""){
            }
            else if(item_name==="#ITEM"){

                $("#t3").empty();
                $("#new_item").modal();
                document.getElementById('select_item').value="";

            }
            else{
            $.ajax({
                url: "../fetch_itemname.php",
                async: false,
                cache: false,
                method: "POST",
                data: ({
                    item_name: item_name
                }),
                success: function(data) {

                    response = JSON.parse(data);
                    show_specification_table(response['item_id']);
                    $("#item_desc").val(response['item_desc']);
                    $("#tax").append("<option value=" + response['item_tax'] + " selected=selected>" + response['item_tax'] + "</option>").trigger('change');
                    $("#units").append("<option value=" + response['item_unit'] + " selected=selected>" + response['item_unit'] + "</option>").trigger('change');
                    $("#price").val(response['item_uprice']);
                    $("#quantity").val(1);
                    $("#quantity_chk").val(response['item_quantity']);
                    $("#quantity_chk").html('available:'+response['item_quantity']);

                }

            });
          }
}
function get_specific_item(){
    $("#error_select_item_msg").html("");
    var item_name = document.getElementById('select_specific_item').value;

   if(item_name===""){
   }
    else{
    $.ajax({
        url: "../fetch_specificitemname.php",
        async: false,
        cache: false,
        method: "POST",
        data: ({
            item_name: item_name
        }),
        success: function(data) {
            response = JSON.parse(data);
            show_specification_table(response['item_id']);

            $("#item_desc").val(response['item_desc']);
            $("#tax").append("<option value=" + response['item_tax'] + " selected=selected>" + response['item_tax'] + "</option>").trigger('change');
            $("#units").append("<option value=" + response['item_unit'] + " selected=selected>" + response['item_unit'] + "</option>").trigger('change');
            $("#price").val(response['item_uprice']);
            $("#quantity").val(1);
            $("#quantity_chk").val(response['item_quantity']);
            $("#quantity_chk").html('available:'+response['item_quantity']);
        }

    });
  }

}
function show_specifications(param)
{

$.ajax({
  url:"../show_specifications.php",
  method:"POST",
  data:({
    item_id:param
  }),
  success:function(data){
      response = JSON.parse(data);
      var count = Object.keys(response).length;

      $("#t2").html("");
      $("#specificationmodelitemname").html(response[0]['item_name']);
      $("#specificationmodelitem_id").val(response[0]['item_id']);
      $("#specification_modal").modal();

      for (var i = 1; i < count; i++) {
        var markup1main = "<tr><td class='text-center' style='padding-top: 5px;padding-bottom: 5px;background-color: #f3f3f3;font-weight:bold;font-size: 15px;' >"+ response[i]['item_parameter']+"</td><td class='text-center' style='padding-top: 5px;padding-bottom: 5px;font-weight:bold;font-size: 15px;'>"+response[i]['item_value']+"</td></tr>";
        $("#t2").append(markup1main);
      }

  }
});
}
function getSpecificItem_name(param) {

    $.ajax({
        type: "POST",
        url: "../getSpecificItem_name1.php",
        data: ({
            client_name: param
         }),
        success: function(msg) {

            $("#select_specific_item").html(msg);
        }
    });
}
function getItem_name1() {
      var item_name = document.getElementById('select_item').value;
      if(item_name==="#ITEM"){
          document.getElementById('select_item').value="";
      }
      else{
        $.ajax({
            type: "POST",
            url: "../getAllitems.php",
            success: function(msg) {
                $("#select_item").html(msg);
            }
        });
      }
}


function getquotationtc(){
  $.ajax({
  type: "POST",
  url: "../fetchtermcondition.php",
  success: function(data) {
    response = JSON.parse(data);
    $("#terms").val(response['quotationtc']);
  },
  error: function(data, errorThrown) {
      alert('request failed :' + errorThrown);
  }
  });
}
function getcredittc(){
  $.ajax({
  type: "POST",
  url: "../fetchtermcondition.php",
  success: function(data) {
    response = JSON.parse(data);
    $("#terms").val(response['credittc']);
  },
  error: function(data, errorThrown) {
      alert('request failed :' + errorThrown);
  }
  });
}
function getdeliverytc(){
  $.ajax({
  type: "POST",
  url: "../fetchtermcondition.php",
  success: function(data) {
    response = JSON.parse(data);
    $("#terms").val(response['deliverytc']);
  },
  error: function(data, errorThrown) {
      alert('request failed :' + errorThrown);
  }
  });
}
function getpurchasetc(){
  $.ajax({
  type: "POST",
  url: "../fetchtermcondition.php",
  success: function(data) {
    response = JSON.parse(data);
    $("#terms").val(response['purchasetc']);
  },
  error: function(data, errorThrown) {
      alert('request failed :' + errorThrown);
  }
  });
}

function clear_client_data()
{
    var form = document.getElementById("add_new_client");
    form.reset();
    $("#bcountry1").append("<option value='' selected=selected>Select here</option>").trigger('change');
    $("#bstate1").append("<option value='' selected=selected>Select here</option>").trigger('change');
    $("#bcity1").append("<option value='' selected=selected>Select here</option>").trigger('change');
  }
  function clear_client_data1()
  {
      var form = document.getElementById("add_new_client");
      form.reset();
      $("#bcountry1").append("<option value='' selected=selected>Select here</option>").trigger('change');
      $("#bstate1").append("<option value='' selected=selected>Select here</option>").trigger('change');
      $("#bcity1").append("<option value='' selected=selected>Select here</option>").trigger('change');
    }


function clear_item_data() {
    var form = document.getElementById("add_new_item");
    form.reset();
    $("#tax1").append("<option value='' selected=selected>Select here</option>").trigger('change');
    $("#units1").append("<option value='' selected=selected>Select here</option>").trigger('change');
    $("#t3").empty();
}

function clear_specification(){
  var form = document.getElementById("work_speci_form");
  form.reset();
}


function clear_unit_data() {
    var form = document.getElementById("add_new_unit");
    form.reset();
}

function clear_tax_data() {
    var form = document.getElementById("add_new_tax");
    form.reset();
}


function HideAddNewItemInformation()
{
  $("#new_item .close").click();
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
    return true;
}
function getClient_name() {
        $.ajax({
            type: "POST",
            url: "../getClient_values.php",
            success: function(msg) {
                $("#users").html(msg);
            }
        });
}

function getClient_name1() {
        $.ajax({
            type: "POST",
            url: "../getClient_values1.php",
            success: function(msg) {
                $("#specificusers").html(msg);
            }
        });
}

function getVendor_name() {
    $.ajax({
        type: "POST",
        url: "../get_vendorNames.php",
        success: function(msg) {
            $("#users").html(msg);
        }
    });
}
function getVendor_name1() {
    $.ajax({
        type: "POST",
        url: "../get_vendorNames1.php",
        success: function(msg) {
            $("#specificusers").html(msg);
        }
    });
}
function getItem_name() {
      var item_name = document.getElementById('select_item').value;
      if(item_name==="#ITEM"){
          $("#new_item").modal();
          document.getElementById('select_item').value="";
      }
      else{
        $.ajax({
            type: "POST",
            url: "../getItem_name.php",
            success: function(msg) {
              // alert(msg);
                $("#select_item").html(msg);
            }
        });
      }
}



function getUnit_name() {
        $.ajax({
            type: "POST",
            url: "../getUnit_values.php",
            success: function(msg) {
                $("#units").html(msg);
            }
        });
}

function getUnit_name1() {
        $.ajax({
            type: "POST",
            url: "../getUnit_values1.php",
            success: function(msg) {
              //alert(msg);
                $("#units1").html(msg);
                $("#specificunits").html(msg);
            }
        });
}

function getTax_values1() {

        $.ajax({
            type: "POST",
            url: "../getTax_values1.php",
            success: function(msg) {
                //alert(msg);
                $("#tax1").html(msg);
                $("#specifictax").html(msg);
            }
        });
}

function getTax_values() {
        $.ajax({
            type: "POST",
            url: "../getTax_values.php",
            success: function(msg) {
                $("#tax").html(msg);
            }
        });
}

function getPayTerm_values() {
        $.ajax({
            type: "POST",
            url: "../getPayTerm_values.php",
            success: function(msg) {
                $("#payterms").html(msg);
            }
        });
}

function clear_payterms_data() {
    var form = document.getElementById("add_new_payterm");
    form.reset();
}

function getItem_name_for_purchase() {
    $.ajax({
        type: "POST",
        url: "../get_purchase_itemName.php",
        success: function(msg) {
            $("#select_item").html(msg);
        }
    });
}

function getItem_name_for_purchase1() {
    $.ajax({
        type: "POST",
        url: "../get_purchase_itemName5.php",
        data: "row",
        success: function(msg) {
            $("#select_item1").html(msg);
        }
    });
}
