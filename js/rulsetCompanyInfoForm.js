
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
                 minlength:"Name must be at least 2 characters long",
                 lettersonly:"This field can only contain characters"
              };
var ruleSet5 = {
                required: "This field is required"
              };
 var ruleSet6 = {
                   required: "This field is required",
                   digits:"please enter only digits",
                   minlength: "please enter at least 10 digits",
                   maxlength: "please do not enter more than 10 digit",
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
                digits:"please enter only digits",
                minlength: "please enter at least 6 digits",
                maxlength: "please do not enter more than 6 digits"
              };
      var ruleSet9=   {
                          required: true,
                          email: true,
                          maxlength:255
            };
      var ruleSet10= {
                    required: "This field is required",
                    email:"pleaase enter email in a proper format ex;abc@gmail.com ",
                    maxlength:"Email should contain upto 255 characters"
        }



          $("#CompanyInfoForm").validate({
           rules:{
             inputCname:ruleSet1,
             inputContPersonName:ruleSet1,
             inputCompanyAddr:ruleSet2,
             scountry:ruleSet2,
             sstate:ruleSet2,
             scity:ruleSet2,
             inputPincode:ruleSet7,
             inputCompanyEmail:ruleSet9,
             inputContNumber:ruleSet3
           },
           messages: {
             inputCname:ruleSet4,
             inputContPersonName:ruleSet4,
             inputCompanyAddr:ruleSet5,
             scountry:ruleSet5,
             sstate:ruleSet5,
             scity:ruleSet5,
             inputPincode:ruleSet8,
             inputCompanyEmail:ruleSet10,
             inputContNumber:ruleSet6
           }
        });
