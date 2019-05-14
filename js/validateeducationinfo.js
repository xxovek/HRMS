$(document).ready(function() {

      $("#myTab a").click(function(e){
      	e.preventDefault();
      	$(this).tab('show');
      });
var ruleSet1 = {
                  required: true
               };


      var ruleSet2= {
                    required: "This field is required"

                  };




        $("#education").validate({
               rules: {
                 degreename:ruleSet1,
                 yearofpassing:ruleSet1,
                 university:ruleSet1,
                 cgpa:ruleSet1
               },
               messages: {
                 degreename:ruleSet2,
                 yearofpassing:ruleSet2,
                 university:ruleSet2,
                 cgpa:ruleSet2
               }
           })

});
// jQuery.validator.setDefaults({
//   debug: true,
//   success: "valid"
// });
// var form = $( "#education" );
// form.validate();
// $( "#addeducationinfo" ).click(function() {
//   alert( "Valid: " + form.valid() );
// });
