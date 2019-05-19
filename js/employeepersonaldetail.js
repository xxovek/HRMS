getCountry_name();
getStateemp();
getCityemp();
function getCountry_name()
{
    $.ajax({
        type: "POST",
        url: "../src/get_countryNames.php",
        success: function(msg) {
          $("#countrynew").html(msg);
        }
    });
}
function getStateemp()
{
  $.ajax({
      type: "POST",
      url: "../src/get_statenames1.php",
      success: function(msg) {
        $("#statenew").html(msg);
      }
  });
}
function getCityemp()
{
  $.ajax({
      type: "POST",
      url: "../src/get_cityNames1.php",
      success: function(msg) {
        $("#citynew").html(msg);
      }
  });
}
