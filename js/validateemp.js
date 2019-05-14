
var ruleSet1 = {
                  required: true,
                  minlength: 2,
                  lettersonly: true
               };
var ruleSet2 = {
                 required: true
               };
var ruleSet3 = {
                required: true,
                digits:true,
                minlength:10,
                maxlength: 10,
                pattern:"[789][0-9]{9}"
              };
var  ruleSet4 = {
                 required:"This field is required",
                 minlength:"Name must be at least 2 Alphabets long",
                 lettersonly:"This field can only contain Alphabets"
              };
var ruleSet5 = {
                required: "This field is required"
              };
 var ruleSet6 = {
                   required:"This field is required",
                   digits:"Please enter only digits",
                   minlength:"Please enter at least 10 digits",
                   maxlength:"Please do not enter more than 10 digit",
                   pattern:"Mobile Number Should start with 7,8,or 9"
                };

  var ruleSet7= {
                  required: true,
                  minlength:6,
                  maxlength: 6,
                  digits:true
                };
  var ruleSet8={
                required: "Please enter pincode",
                digits:"Please enter only digits",
                minlength: "Please enter at least 6 digits",
                maxlength: "Please do not enter more than 6 digits"
              };
      var ruleSet9=   {
                          required: true,
                          email: true,
                          maxlength:255
            };
      var ruleSet10= {
                    required: "This field is required",
                    email:"Please enter e-mail in a proper format ex;abc@gmail.com ",
                    maxlength:"E-mail should contain upto 255 characters"
        }



          $("#emp_reg").validate({
           rules: {
             fname:ruleSet1,
             lname:ruleSet1,
             gender:ruleSet2,
             birthdate:ruleSet2,
             addr:ruleSet2,
             scountry:ruleSet2,
             sstate:ruleSet2,
             scity:ruleSet2,
             pincode:ruleSet7,
             email:ruleSet9,
             phone:ruleSet3,
             jdate:ruleSet2
           },
           messages: {
             fname:ruleSet4,
             lname:ruleSet4,
             gender:ruleSet5,
             birthdate:ruleSet5,
             addr:ruleSet5,
             scountry:ruleSet5,
             sstate:ruleSet5,
             scity:ruleSet5,
             pincode:ruleSet8,
             email:ruleSet10,
             phone:ruleSet6,
             jdate:ruleSet5

           }
        });
