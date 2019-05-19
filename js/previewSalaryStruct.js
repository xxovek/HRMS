
// alert("ok");
function number2text(value) {
  // alert(value);
    var fraction = Math.round(frac(value)*100);
    var f_text  = "";

    if(fraction > 0) {
        f_text = "AND "+convert_number(fraction)+" PAISE";
    }

    return convert_number(value)+" RUPEE "+f_text+" ONLY";
}

function frac(f) {
    return f % 1;
}

function convert_number(number)
{
    if ((number < 0) || (number > 999999999))
    {
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */
    number -= Gn * 10000000;
    var kn = Math.floor(number / 100000);     /* lakhs */
    number -= kn * 100000;
    var Hn = Math.floor(number / 1000);      /* thousand */
    number -= Hn * 1000;
    var Dn = Math.floor(number / 100);       /* Tens (deca) */
    number = number % 100;               /* Ones */
    var tn= Math.floor(number / 10);
    var one=Math.floor(number % 10);
    var res = "";

    if (Gn>0)
    {
        res += (convert_number(Gn) + " CRORE");
    }
    if (kn>0)
    {
            res += (((res=="") ? "" : " ") +
            convert_number(kn) + " LAKH");
    }
    if (Hn>0)
    {
        res += (((res=="") ? "" : " ") +
            convert_number(Hn) + " THOUSAND");
    }

    if (Dn)
    {
        res += (((res=="") ? "" : " ") +
            convert_number(Dn) + " HUNDRED");
    }


    var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX","SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN","FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN","NINETEEN");
var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY","SEVENTY", "EIGHTY", "NINETY");

    if (tn>0 || one>0)
    {
        if (!(res==""))
        {
            res += " AND ";
        }
        if (tn < 2)
        {
            res += ones[tn * 10 + one];
        }
        else
        {

            res += tens[tn];
            if (one>0)
            {
                res += ("-" + ones[one]);
            }
        }
    }

    if (res=="")
    {
        res = "zero";
    }
    return res;
}



function DisplayPreviewData(emp_id,fromDate,uptoDate){
// alert(emp_id);
  $.ajax({
          type: "post",
          url: "../src/edit_emp.php",
          // data: 'page=' + btn_page,
          data : {Emp_id:emp_id},
          success: function (data) {
               dt = data; // This line shows error.
              $.ajax({
                  type: "post",
                  url: "../src/fetchComponents.php",
                  data:{emp_id:emp_id,fromDate:fromDate,uptoDate:uptoDate},
                  success: function (data) {

                    response1 = JSON.parse(dt);
                    response2 = JSON.parse(data);
                    //alert(response1);
                    var totEarn = 0.0,totDeb = 0.0;
                    for (var i = 0; i < response2.length; i++) {

                      if(response2[i]['CredDebitType'] == "C" ){
                        $("#CreditTbl").append('<tr><td style="width:25%;">'+response2[i]['HeadName']+'</td><td style="width:25%;">'+response2[i]['Amount']+'</td></tr>');
                        totEarn += parseFloat(response2[i]['Amount']);
                      }
                      else{
                        $("#DebitTbl").append('<tr><td style="width:25%;">'+response2[i]['HeadName']+'</td><td style="width:25%;">'+response2[i]['Amount']+'</td></tr>');
                        totDeb += parseFloat(response2[i]['Amount']);
                      }
                    }
                   // alert(response2['HeadName']);
                  $("#Ename").html(response1['name']);
                  $("#Edesi").html(response1['DesigName']);
                  $("#fuDate").html(fromDate + "-" + uptoDate);

                  $("#CreditTbl").append('<tr style="background:#c1cacc;"><td style="color: Black;width:25%;font-weight:bold;">Total Earnings</td><td style="color: Black;width:25%;font-weight:bold;">'+totEarn+'</td></tr>');
                  $("#DebitTbl").append('<tr style="background:#c1cacc;"><td style="color: Black;width:25%;font-weight:bold;">Total Deductions</td><td style="color: Black;width:25%;font-weight:bold;">'+totDeb+'</td></tr>');
                  // $("#totSalCredit").html(totEarn);
                  // $("#totSalDeb").html(totDeb);
                  let TotalEarnings = parseFloat(totEarn) - parseFloat(totDeb);
// alert(TotalEarnings);
                  let salInWords = number2text(TotalEarnings);
// alert(salInWords);
                  $("#totSalInWords").html(salInWords);
                  $("#totSalInDigit1").html(TotalEarnings+"/-");

                }
              } );
          }
      });
}
