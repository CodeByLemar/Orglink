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
            <td><p class="center bold payroll_period">From <?= esc(date('m/d/Y',strtotime($emp[0]['CUT_From']))) ?> to <?= esc(date('m/d/Y',strtotime($emp[0]['CUT_To']))) ?></p></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
    <br>
    <table class="section">
        <tr>
            <td>
                <table>
                    <tr>
                        <td><p class="bold emp_details">Employee No: <?= esc($emp[0]['CEL_Client_ID']) ?></p></td>
                    </tr>
                </table>
            </td>
            <td colspan="2">
                <table>
                    <tr>
                        <td><p class="bold emp_details"><?= esc($emp[0]['CEL_Last_Name']) ?>, <?= esc($emp[0]['CEL_First_Name']) ?></p></td>
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
                    <?php
                        $basic_pay = $emp[0]['CEL_Basic_Rate'] * 14;
                    ?>
                    <tr>
                        <td>Basic Pay</td>
                        <td class="right">(14 days) <?= number_format((float)$basic_pay, 2, '.', ''); ?></td>
                    </tr>
                    <tr>
                        <td>Less Absent </td>
                        <td class="right"><?= $emp[0]['VPDL_Abs'] ?? '0.00' ?></td>
                    </tr>
                    <tr>
                        <td>Lates </td>
                        <td class="right"><?= $emp[0]['VPDL_Late'] ?? '0.00' ?></td>
                    </tr>
                    <tr>
                        <td>Allowance</td>
                        <td class="right"><?= $emp[0]['CEL_Allowance'] ?? '0.00' ?></td>
                    </tr>

                    <?php 
                        $rwd_total = 0.00;
                        $rwd_overtime = $emp[0]['VPDL_RWD_Ovt_Amount'] ?? 0.00;
                        $rwd_overtime8 = $emp[0]['VPDL_RWD_Ovt8_Amount'] ?? 0.00;
                        $rwd_np = $emp[0]['VPDL_RWD_NP_Amount'] ?? 0.00;
                        $rwd_np8 = $emp[0]['VPDL_RWD_NP8_Amount'] ?? 0.00;
                        $rwd_total = $rwd_overtime + $rwd_overtime8 + $rwd_np + $rwd_np8;
                    ?>

                    <tr>
                        <td>Reg. OT</td>
                        <td class="right"><?= number_format((float)$rwd_total, 2, '.', ''); ?></td>
                    </tr>
                    <tr>
                        <td>Night Diff. Pay</td>
                        <td class="right">0.00</td>
                    </tr>
                    <?php 
                        $shnr_total = 0.00;
                        $shnr_overtime = $emp[0]['VPDL_SHNR_Ovt_Amount'] ?? 0.00;
                        $shnr_overtime8 = $emp[0]['VPDL_SHNR_Ovt8_Amount'] ?? 0.00;
                        $shnr_np = $emp[0]['VPDL_SHNR_NP_Amount'] ?? 0.00;
                        $shnr_np8 = $emp[0]['VPDL_SHNR_NP8_Amount'] ?? 0.00;
                        $shnr_total = $shnr_overtime + $shnr_overtime8 + $shnr_np + $shnr_np8;
                    ?>

                    <tr>
                        <td>Sun/SP Hol Pay</td>
                        <td class="right"><?= number_format((float)$shnr_total, 2, '.', ''); ?></td>
                    </tr>

                    <?php 
                        $rhnr_total = 0.00;
                        $rhnr_overtime = $emp[0]['VPDL_RHNR_Ovt_Amount'] ?? 0.00;
                        $rhnr_overtime8 = $emp[0]['VPDL_RHNR_Ovt8_Amount'] ?? 0.00;
                        $rhnr_np = $emp[0]['VPDL_RHNR_NP_Amount'] ?? 0.00;
                        $rhnr_np8 = $emp[0]['VPDL_RHNR_NP8_Amount'] ?? 0.00;
                        $rhnr_total = $rhnr_overtime + $rhnr_overtime8 + $rhnr_np + $rhnr_np8;
                    ?>

                    <tr>
                        <td>Reg Holiday Pay</td>
                        <td class="right">(16 hr/s) <?= number_format((float)$rhnr_total, 2, '.', ''); ?></td>
                    </tr>

                    <?php 
                        $rd_total = 0.00;
                        $rd_overtime = $emp[0]['VPDL_RD_Ovt_Amount'] ?? 0.00;
                        $rd_overtime8 = $emp[0]['VPDL_RD_Ovt8_Amount'] ?? 0.00;
                        $rd_np = $emp[0]['VPDL_RD_NP_Amount'] ?? 0.00;
                        $rd_np8 = $emp[0]['VPDL_RD_NP8_Amount'] ?? 0.00;
                        $rd_total = $rd_overtime + $rd_overtime8 + $rd_np + $rd_np8;
                    ?>
                    <tr>
                        <td>SP Restday Pay</td>
                        <td class="right"><?= number_format((float)$rd_total, 2, '.', ''); ?></td>
                    </tr>

                    <?php 
                        $rhrd_total = 0.00;
                        $rhrd_overtime = $emp[0]['VPDL_RHRD_Ovt_Amount'] ?? 0.00;
                        $rhrd_overtime8 = $emp[0]['VPDL_RHRD_Ovt8_Amount'] ?? 0.00;
                        $rhrd_np = $emp[0]['VPDL_RHRD_NP_Amount'] ?? 0.00;
                        $rhrd_np8 = $emp[0]['VPDL_RHRD_NP8_Amount'] ?? 0.00;
                        $rhrd_total = $rhrd_overtime + $rhrd_overtime8 + $rhrd_np + $rhrd_np8;
                    ?>
                    <tr>
                        <td>Reg Restday Pay</td>
                        <td class="right"><?= number_format((float)$rhrd_total, 2, '.', ''); ?></td>
                    </tr>
                    <tr>
                        <td>Leave Amount</td>
                        <td class="right">0.00</td>
                    </tr>
                    <tr>
                        <td>Other Earnings</td>
                        <td class="right semiunderline">0.00</td>
                    </tr>

                    <?php
                        $daily_gross = 0.00;
                        $gross_earnings = 0.00;
                        $rate_per_day = $emp[0]['CEL_Basic_Rate'] / 8;
                        $Lhrs = $emp[0]['VPDL_LHrs'];
                        $Whrs = $emp[0]['VPDL_WHrs'];
                        $total_overbreak = $emp[0]['VPDL_Total_Overbreak'];
                        $daily_gross = number_format((float)($Lhrs + $Whrs) * $rate_per_day, 2, '.', '');
                        $gross_earnings = ($rwd_total + $shnr_total + $rhnr_total + $rd_total + $rhrd_total + $daily_gross) - $total_overbreak;
                    ?>
                    <tr>
                        <td>Gross Earnings</td>
                        <td class="right"><?= number_format((float)$gross_earnings, 2, '.', '') ?></td>
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
                        <td class="right"><?= $emp[0]['VPDL_Withholding_Tax'] ?? '0.00' ?></td>
                    </tr>
                    <tr> 
                        <td>SSS Contribution </td>
                        <td class="right"><?= $emp[0]['VPDL_SSS_Employee_Contribution'] ?? '0.00' ?></td>
                    </tr>
                    <tr> 
                        <td>HDMF Contribution </td>
                        <td class="right"><?= $emp[0]['VPDL_HDMF_Employee_Contribution'] ?? '0.00' ?></td>
                    </tr>
                    <tr> 
                        <td>PhilHealth Cont.</td>
                        <td class="right"><?= $emp[0]['VPDL_Philhealth_Employee_Contribution'] ?? '0.00' ?></td>
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
                   <?php
                        $sss = $emp[0]['VPDL_SSS_Employee_Contribution'] ?? 0.00;
                        $philhealth = $emp[0]['VPDL_Philhealth_Employee_Contribution'] ?? 0.00;
                        $hdmf = $emp[0]['VPDL_HDMF_Employee_Contribution'] ?? 0.00;
                        $tax = $emp[0]['VPDL_Withholding_Tax'] ?? 0.00;
                        $total_deductions = 0.00;
                        
                        $total_deductions = $sss + $philhealth + $hdmf + $tax;
                   ?>
                    <tr> 
                        <td  >Total Deductions</td>
                        <td class="right"><?= number_format((float)$total_deductions, 2, '.', '') ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <?php
                        $Netpay = $gross_earnings - $total_deductions;
                    ?>
                    <tr>
                        <td class="bold">Net Pay &gt;&gt;&gt;&gt;&gt;</td>
                        <td class="bold right underline"><?= number_format((float)$Netpay, 2, '.', '') ?></td> 
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
                            <td><p class="bold emp_details_footer" ><?= esc($emp[0]['CEL_Client_ID']) ?></p></td>
                            <td colspan="2"><p class="bold emp_details_footer"><?= esc($emp[0]['CEL_Last_Name']) ?>, <?= esc($emp[0]['CEL_First_Name']) ?></p></td> 
                        </tr> 
                        <tr>
                            <td><p class="bold emp_details_footer">Payroll Period: </p></td>
                            <td colspan="2"><p class="bold emp_details_footer"><?= esc(date('F d, Y',strtotime($emp[0]['CUT_From']))) ?> to <?= esc(date('F d, Y',strtotime($emp[0]['CUT_To']))) ?></p></td> 
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        <tr>
                            <td><p class="bold emp_details_footer">Net Pay:</p></td>
                            <td class="bold right underline emp_details_footer"><?= number_format((float)$Netpay, 2, '.', '') ?> </td> 
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
