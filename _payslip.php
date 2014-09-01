<style type="text/css" media="">

#payslip_container{
    width:670px;
    
}
table#ot-details{
    width:330px;
    font-size:8pt;
}
table#sdeductions{
    width:330px;
    font-size:8pt;
}
table{
    border-collapse:collapse;
    font-family:Arial, sans-seriff;
    font-size:10pt;
}
.underlined{
    border-bottom:1px solid black;
}
.caption{
  text-align:center;
  font-weight:bold;
  font-size:14pt;
  background:#ddd;
  border-bottom: 3px solid black;
}
td{
    
}
.label{
    font-weight:bold;
    text-align:left;
    padding-right:10px;
}
.left{
    text-align:left;
}
.center{
    text-align:center;
}
.right{
    text-align:right;
}

table#detail1{
  width:100%;
}
</style>
<table id="payslip_container">
    <thead>
       <tr>
            <th colspan="2">Logo</th>
            <th class="right" colspan="2"><h1>Company Name</h1></th>        
        </tr>
        <tr>
            <th class="label">Name</th><th class="underlined">Jane Doe</th><th class="label">Payroll Period</th><th class="underlined">1-Jan-2013 to 15-Jan-2013</th>
        </tr>
        <tr>
            <th class="label">Position</th><th class="underlined">Executive Producer</th><th class="label">Tax Status</th><th class="underlined">S3</th>
        </tr>
    </thead>
    <tbody>        
        <tr>
            <td colspan="4" class="has-table">              
              <table id="detail1">
                  <caption></caption>
                  <thead><tr><th class="caption" colspan="4">Earnings</th><th class="caption" colspan="2">Deductions</th></tr></thead>
                  <tbody>
                      <tr>
                          <td class="label" colspan="2">Monthly Basic</td><td>100,000.00</td><td>-</td>
                          <td class="label">Witholding Tax</td><td>-</td>
                      </tr>
                      <tr>
                          <td class="label" colspan="2">Days Worked</td><td class="sub-total">0.50</td><td>&nbsp;</td>
                          <td class="label">SSS Premium</td><td>-</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label" colspan="2">Basic for the Period</td><td>50,000.00</td><td>&nbsp;</td>
                          <td class="label">Medicard</td><td>-</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">Less:</td><td>LWOP / Late</td><td>-</td><td>50,000.00</td>
                          <td class="label">HDMF Premium</td><td>-</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">Add:</td><td>Overtime</td><td>-</td><td>&nbsp;</td>
                          <td class="label">Company Loan</td><td>-</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">&nbsp;</td><td>Night Shift Differential</td><td>-</td><td>&nbsp;</td>
                          <td class="label">Telephone Charges</td><td>-</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">&nbsp;</td><td>Holiday Pay</td><td>-</td><td>&nbsp;</td>
                          <td class="label">Cash Advances</td><td>-</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">&nbsp;</td><td>Transporation Allowance</td><td>-</td><td>&nbsp;</td>
                          <td class="label">&nbsp;</td><td>-</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">&nbsp;</td><td>Incentive</td><td>-</td><td>&nbsp;</td>
                          <td class="label">&nbsp;</td><td>&nbsp;</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">&nbsp;</td><td>Meal Allowance</td><td>-</td><td>&nbsp;</td>
                          <td class="label">&nbsp;</td><td>&nbsp;</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">&nbsp;</td><td>Leave Conversion</td><td>-</td><td>&nbsp;</td>
                          <td class="label">&nbsp;</td><td>&nbsp;</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">&nbsp;</td><td>Subtotal</td><td>-</td><td>&nbsp;</td>
                          <td class="label">&nbsp;</td><td>&nbsp;</td>
                      </tr><tr>
                      </tr><tr>
                          <td class="label">GROSS PAY</td><td>&nbsp;</td><td>-</td><td>50,000.00</td>
                          <td class="label">TOTAL DEDUCTIONS</td><td>&nbsp;</td>
                      </tr><tr>
                  </tr></tbody>                
              </table>            
            </td><!--detail1-->            
        </tr>
            <tr>
            <td colspan="2" class="has-table">
               <table id="ot-details">
                    <caption class="caption">OT Details</caption>
                    <thead><tr><th>Daily Rate:____</th><th>OT Hours</th><th>Amount</th></tr></thead>
                    <tbody>
                        <tr>
                            <td class="label">Regular Day (130%)</td><td>-</td><td>-</td>
                        </tr>
                        <tr>
                            <td class="label">Regular Day Excess (169%)</td><td>-</td><td>-</td>
                        </tr>
                        <tr>
                            <td class="label">Sunday / Rest Day (150%)</td><td>-</td><td>-</td>
                        </tr>
                        <tr>
                            <td class="label">Sunday / Rest Day Excess(225%)</td><td>-</td><td>-</td>
                        </tr>
                        <tr>
                            <td class="label">Legal Holiday (100%)</td><td>-</td><td>-</td>
                        </tr>
                        <tr>
                            <td class="label">Legal Holiday (200%)</td><td>-</td><td>-</td>
                        </tr>
                        <tr>
                            <td class="label"> Legal Holiday Excess (260%)</td><td>-</td><td>-</td>
                        </tr>
                        <tr>
                            <td class="label">Legal Holiday + Restday (300%)</td><td>-</td><td>-</td>
                        </tr>
                        <tr>
                            <td class="label">TOTAL</td><td>-</td><td>-</td>
                        </tr>
                    </tbody>
                </table>
            </td><!--OT Details-->
            <td colspan="2" class="has-table">
                <table id="sdeductions">
                    <caption class="caption">Deductions Schedule</caption>
                    <thead><tr><th>&nbsp;</th><th>Total Amount Payable</th><th>Deducted This Period</th><th>Balance To Date</th><th>Deduction Period</th></tr></thead>
                    <tbody>
                        <tr>
                            <td class="label">SSS Salary Loan</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="label">SSS CalamityLoan</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="label">HDMF Loan</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="label">Company Loan</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>  
            </td>
        </tr>
        <tr>
            <td class="label right" colspan="2">Date Credited to ATM Payroll Account</td><td class="right underlined" colspan="2">25-Jan-2013 02:52 PM</td>
        </tr>
    </tbody>
</table>