// getCountry_name();
getCountry_name();


function getCountry_name() {
    $.ajax({
        type: "POST",
        url: "../src/get_countryNames.php",
        success: function(msg) {
          $("#scountry").html(msg);
               document.getElementById('scountry2').innerHTML =msg;

        }
    });
}


function getStateemp(country)
{
  $.ajax({
      type: "POST",
      url: "../src/get_statenames.php",
      data: ({
          user_id:country
      }),
      success: function(msg) {
        $("#sstate").html(msg);

          document.getElementById('sstate2').innerHTML =msg;
      }
  });
}
function getCityemp(state)
{
  $.ajax({
      type: "POST",
      url: "../src/get_cityNames.php",
      data: ({
          user_id:state
      }),
      success: function(msg) {
        $("#scity").html(msg);

        document.getElementById('scity2').innerHTML =msg;

      }
  });
}
