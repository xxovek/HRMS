

var ruleSet1 = {
                 required: true
               };


var ruleSet2= {
                required: "This field is required"
              };



          $("#employeeleave").validate({
           rules: {
             email:ruleSet1,
             leavetype:ruleSet1,
             from_date:ruleSet1,
             upto_date:ruleSet1,
             numberofdays:ruleSet1,
             Reason:ruleSet1
           },
           messages: {

             email:ruleSet2,
             leavetype:ruleSet2,
             from_date:ruleSet2,
             upto_date:ruleSet2,
             numberofdays:ruleSet2,
             Reason:ruleSet2
           }
        });
