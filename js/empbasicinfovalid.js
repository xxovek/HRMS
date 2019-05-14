
var ruleSet1 = {
                  required: true,
                  minlength: 2,
                  lettersonly: true
               };
var ruleSet2 = {
                 required: true
               };

var  ruleSet4 = {
                 required:"This field is required",
                 minlength:"Name must be at least 2 Alphabets long",
                 lettersonly:"This field can only contain Alphabets"
              };
var ruleSet5 = {
                required: "this field is required"
              };


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
