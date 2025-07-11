<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
        }
        .center {
            text-align: center; 
        }
        .bold {
            font-weight: bold;
        }
        .underline {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            vertical-align: top;
            padding: 2px 4px;
        }
        .section {
            margin-top: 15px;
        }
        .border-top {
            border-top: 1px solid #000;
        }
        .border-bottom {
            border-bottom: 1px solid #000;
        }
        .signature {
            margin-top: 30px;
        }
        .right {
            text-align: right;
        }

        .emp_details{
            font-size: 12px;
        }

        .adjustments{
            font-size:7px;
        }

        .underline{ 
            text-decoration:underline;
            border-bottom: 1px solid #000;
        }

        .semiunderline{
            border-bottom: 1px solid #000; 
        }

        .emp_details_footer{
            font-size:8px;
        }

        .payslip_text{
            font-size:12px;
        }

        .company_text{
            font-size:14px;
        }

        .payroll_period{
            font-size:10px;
        }
    </style>
</head>
<body>

    
    
    
    <table class="section">
        <tr>
            <td><p class="center bold payslip_text">Payslip</p></td>
        </tr>
        <tr>
            <td><p class="center bold company_text">ORGLINK</p></td>
        </tr>
        <tr>
            <td><p class="center bold payroll_period">From <?= esc(date('m/d/Y',strtotime($from))) ?> to <?= esc(date('m/d/Y',strtotime($to))) ?></p></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
    <br>
    <table class="section">
        <tr>
            <td>
                <table>
                    <tr>
                        <td><p class="bold emp_details">Employee No: <?= esc($emp->CEL_Client_ID) ?></p></td>
                    </tr>
                </table>
            </td>
            <td colspan="2">
                <table>
                    <tr>
                        <td><p class="bold emp_details"><?= esc($emp->CEL_Last_Name) ?>, <?= esc($emp->CEL_First_Name) ?></p></td>
                    </tr>
                </table>
             </td>
        </tr> 
    </table> 

    <table>
        <tr>
            <td>
                <table class="section">
                    <tr>
                        <td colspan="2"><p class="bold center"><u><br>Earnings</u></p></td> 
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Basic Pay</td>
                        <td class="right">(14 days) 0.00</td>
                    </tr>
                    <tr>
                        <td>Less Absent </td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Lates </td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Allowance</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Reg. OT</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Night Diff. Pay</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Sun/SP Hol Pay</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Leg Holiday Pay</td>
                        <td class="right">(16 hr/s) 0.00</td>
                    </tr>
                    <tr>
                        <td>SP Restday Pay</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Leg Restday Pay</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Leave Amount</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Other Earnings</td>
                        <td class="right semiunderline">0.00</td>
                    </tr>
                    <tr>
                        <td>Gross Earnings</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Other Allowances</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Adjustment</td>
                        <td class="right">0.00</td>
                    </tr> 
                </table>
            </td>
            <td>
                <table class="section">
                    <tr> 
                        <td colspan="2"><p class="bold center"><u><br>Deductions</u></p></td> 
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr> 
                        <td>Withholding Tax</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr> 
                        <td>SSS Contribution </td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr> 
                        <td>HDMF Contribution </td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr> 
                        <td>PhilHealth Cont.</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr> 
                        <td>SSS Loan</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr> 
                        <td>HDMF Loan</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr> 
                        <td>Other Advances</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td >&nbsp;</td>
                        <td class="semiunderline">&nbsp;</td>
                    </tr>
                   
                    <tr> 
                        <td  >Total Deductions</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="bold">Net Pay &gt;&gt;&gt;&gt;&gt;</td>
                        <td class="bold right underline">0.00</td> 
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td rowspan="16">
                <table>
                    <tr> 
                        <td colspan="2"><p class="bold center"><br>&nbsp;</p></td> 
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>YTD Basic(13th)</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>YTD Income</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>YTD Tax Income</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>YTD Tax</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">Adjustments/Deductions:</td> 
                    </tr>
                    <tr>
                        <td>&nbsp; ALLOW 1/15</td>
                        <td class="right">0.00</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>   
    

    <hr class="section">
        <table class="section">
            <tr>
                <td>
                    <table>
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        <tr>
                            <td><p class="bold emp_details_footer" ><?= esc($emp->CEL_Client_ID) ?></p></td>
                            <td colspan="2"><p class="bold emp_details_footer"><?= esc($emp->CEL_Last_Name) ?>, <?= esc($emp->CEL_First_Name) ?></p></td> 
                        </tr> 
                        <tr>
                            <td><p class="bold emp_details_footer">Payroll Period: </p></td>
                            <td colspan="2"><p class="bold emp_details_footer"><?= esc(date('F d, Y',strtotime($from))) ?> to <?= esc(date('F d, Y',strtotime($to))) ?></p></td> 
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        <tr>
                            <td><p class="bold emp_details_footer">Net Pay:</p></td>
                            <td class="bold right underline emp_details_footer">0.00</td> 
                        </tr>
                    </table>
                </td>
            </tr>  
        </table> 
        <table>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td colspan="3">&nbsp;</td> 
                        </tr>
                        <tr>
                            <td colspan="2"><p>I acknowledge to have received the amount stated below and have no further claims for services rendered.</p></td>
                            <td class="signature center">
                                <br>_________________________________<br>Signature
                            </td>
                        </tr> 
                    </table>
                </td>
            </tr>
        </table> 
</body>
</html>
