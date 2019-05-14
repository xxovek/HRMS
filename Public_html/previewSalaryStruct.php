<?php
include_once('../config/connection.php');
session_start();
if(isset($_SESSION['a_id']))
{
  $adminid =$_SESSION['a_id'];
  $uname=$_SESSION['uname'];
}

$emp_id=$_REQUEST['emp_id'];
$fromDate = $_REQUEST['fromDate'];
$uptoDate = $_REQUEST['uptoDate'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="../js/previewSalaryStruct.js"></script>

    <style>
        /* *
        {
            font-size: 12px;
            font-family: SourceSansPro;
              color: #555555;
        }
        body
        {
            width:100%;
            font-size: 14px;
            font-family: SourceSansPro;
            color: #555555;
            margin:0;
            padding:0;
        }

        p
        {
            margin:0;
            padding:0;
        }

        #wrapper
        {
            width:180mm;
            margin:0 3mm;
        }

        .page
        {
            height:297mm;
            width:210mm;
            page-break-after:always;
        } */

        table
        {
            border-spacing:0;
            border-collapse: collapse;

        }

        table td
        {
            padding: 2mm;
        }

        table.heading
        {
            height:20mm;
        }

        h1.heading
        {
            font-size:16pt;
            color:#000;
            font-weight:normal;
        }

        h2.heading
        {
            font-size:9pt;
            color:#000;
            font-weight:normal;
        }
        table td h3{
          color: #000000;
          font-size: 1.2em;
          font-weight: normal;
          margin: 0 0 0.2em 0;
        }
        hr
        {
            color:#ccc;
            background:#ccc;
        }
        #invoice_body
        {
            height: 150mm;
        }
        #invoice_body , #invoice_total
        {
            width:100%;
        }
        #invoice_body table , #invoice_total table
        {
            width:50%;
            border-top: 1px solid #ccc; */
            border-spacing:0;
            border-collapse: collapse;
        }
        #invoice_body table td , #invoice_total table td
        {
            text-align:center;
            font-size:9pt;

        }

        #invoice_body table td.mono  , #invoice_total table td.mono
        {
            font-family:monospace;
            text-align:right;
            padding-right:3mm;
            font-size:10pt;
        }

        #footer
        {
            width:180mm;
            margin:0 15mm;
            padding-bottom:3mm;
        }
        #footer table
        {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;

            background:#eee;

            border-spacing:0;
            border-collapse: collapse;
        }
        #footer table td
        {
            width:25%;
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
        #logo {
          float: left;
          margin-top: 8px;
        }

        #logo img {
          height: 40px;
        }
        .floatedTable {
                   float:left;
               }
    </style>

  </head>
  <body>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">

        <table class="heading" style="width:100%;">
            <tr>
                <td style="width:35mm;">

                </td>
                <td style="">
                <h1 class="heading"><strong>
                <div style="color: Black;font-size: 22px;font-family: SourceSansPro;text-align:center;">Company Name</div></strong></h1>
                <h2 class="heading">
                    <div style="color: black;font-family: Arial, sans-serif;font-size: 14px;font-family: SourceSansPro;text-align:center;">
                    368/2 Nana Peth, Behind kirad Hospital ,Pune 411002,near prakash takies deopur dhule<br/>
                    Mobile no. 8483888585
                    </div>


                </h2>
                <h1 class="heading">
                <strong>
                <div style="font-size: 17px;font-family: Arial;color: Black;text-align:center;">
                Salary Slip Structure
                </div>
                </strong>
                </h1>
                </td>
                <td style="width:30mm;">
                <strong>
                <div style="font-size: 14px;font-family: Arial;color: #000;padding-top:130px;">

                </div>
                </strong>
                </td>
            </tr>
        </table>

      <table  style="width:100%;padding:0;">
          <tr>
              <td style="width:75mm;">

              <strong>
              <div style="font-size: 14px;font-family: Arial;color: Black;text-align:left;">
              Employee Name:&nbsp;<span id="Ename" ></span>
              </div>
              </strong>

              </td>
              <td style="width:15mm;">
              </td>
              <td style="width:30mm;">
              </td>
          </tr>
          <tr>
              <td style="width:75mm;">

              <strong>
              <div style="font-size: 14px;font-family: Arial;color: Black;text-align:left;">
              Designation:&nbsp;<span id="Edesi" ></span>
              </div>
              </strong>

              </td>
              <td style="width:15mm;">
              </td>
              <td style="width:30mm;">
              </td>
          </tr>
          <tr>
              <td style="width:75mm;">

              <strong>
              <div style="font-size: 14px;font-family: Arial;color: Black;text-align:left;">
              From-Upto Years: <span id="fuDate" ></span>

              </div>
              </strong>

              </td>
              <td style="width:15mm;">
              </td>
              <td style="width:30mm;">
              </td>
          </tr>
      </table>

      <div id="content">
          <div id="invoice_body">
              <table border="1" id="CreditTbl" class="floatedTable" style="width:50%">
              <tr style="background:#fff;">
                  <td style="font-size: 14px;font-family: Arial;color: Black;width:25%;font-weight:bold;">Earnings</td>
                  <td style="font-size: 14px;font-family: Arial;color: Black;width:25%;font-weight:bold;">Amount</td>
              </tr>

              </table>
              <!-- <div id="invoice_body"> -->
              <table border="1" id="DebitTbl" class="floatedTable" style="width:50%">
              <tr style="background:#fff;">
                  <td style="font-size: 14px;font-family: Arial;color: Black;width:25%;font-weight:bold;">Deductions</td>
                  <td style="font-size: 14px;font-family: Arial;color: Black;width:25%;font-weight:bold;">Amount</td>
              </tr>

              </table>

      <!-- </div> -->



      </div>


      <!-- <div style="font-size: 14px;font-family: Arial;color: Black;text-align:left;"> Total Earnings:<span id="totSalCredit" ></span></div>
      <div style="font-size: 14px;font-family: Arial;color: Black;text-align:left;">Total Deductions:<span id="totSalDeb" ></span></div> -->
      <!-- <table  style="width:50%;padding:0;float:right;">
      <tr>
          <td style="width:75mm;">
          <strong>
          <div style="font-size: 14px;font-family: Arial;color: Black;text-align:left;" >Total Earnings:<span id="totSalCredit" >
          </div>
          </strong>
          </td>
      </tr>
      </table> -->
      <!-- <table  style="width:50%;padding:0;float:right;">
      <tr>
          <td style="width:75mm;">
            <strong>
            <div style="font-size: 14px;font-family: Arial;color: Black;text-align:left;">Total Deductions:<span id="totSalDeb" ></span>
            </div>
            </strong>
          </td>
      </tr>
      </table> -->


      </div>
      <div class="" id="invoice_total">
        <table style="width:50%;padding:0;float:right;">
        <tr>
          <td style="font-size: 14px;font-family: Arial;color: Black;width:25%;font-weight:bold;">Total Earnings:</td>
          <td style="font-size: 14px;font-family: Arial;color: Black;width:25%;font-weight:bold;" id="totSalCredit" ></td>
        </tr>

        </table>
        <table  style="width:50%;padding:0;float:right;;">
        <tr>
          <td style="font-size: 14px;font-family: Arial;color: Black;width:25%;font-weight:bold;">Total Deductions:</td>
          <td style="font-size: 14px;font-family: Arial;color: Black;width:25%;font-weight:bold;" id="totSalDeb" ></td>
        </tr>

        </table>
      </div>
      <footer>
      <table  style="width:100%;padding:0;">
      <tr>
          <td style="width:75mm;">
            Total Earnings:

          </td>
          <td style="width:15mm;">
          </td>
          <td style="width:75mm;">
            <strong>
            <div style="font-size: 14px;font-family: Arial;color: Green;text-align:left;" id="totSalInWords">
            </div>
            </strong>
          </td>
      </tr>
      </table>
      <table  style="width:100%;padding:0;">
      <tr>
          <td style="width:45%;text-align:left;">
          Cheque No. ______________________________
          <td style="width:5%;">
          </td>
          <td style="width:50%;">
            Name of Bank. ___________________________
          </td>
      </tr>
      <tr>
          <td style="width:45%;text-align:left;">
          Date. ___________________________________
          <td style="width:5%;">
          </td>
          <td style="width:50%;">

          </td>
      </tr>
      <br/>
      <tr>
          <td style="width:45%;text-align:left;">
          Signature of the Employee: ___________________
          <td style="width:5%;">
          </td>
          <td style="width:50%;">
          Director: ___________________
          </td>
      </tr>
      </table>
      </footer>

    </div>
    <div class="col-md-1"></div>

    </div>


    <script type="text/javascript">
      var $emp_id = '<?php echo $_REQUEST['emp_id']; ?>';
      var $fromDate = '<?php echo $_REQUEST['fromDate']; ?>';
      var $uptoDate = '<?php echo $_REQUEST['uptoDate']; ?>';

      DisplayPreviewData($emp_id,$fromDate,$uptoDate);
    </script>
    </body>
  </html>
