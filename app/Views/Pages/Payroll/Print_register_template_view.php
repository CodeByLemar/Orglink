<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payroll Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
        }
        .center {
            text-align: center; 
        }
        .right {
            text-align: end; 
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
            font-size:9px;
        }
        
        .payrollheader{
            font-size:5px;
        }
    </style>
</head>
<body>

    
    
    
    <table class="section">
        <tr>
            <td><p class="center bold company_text">ORGLINK</p></td>
        </tr>
        <tr>
            <td><p class="center bold payslip_text">Payroll Register</p></td>
        </tr>
        <tr>
            <td><p class="center payroll_period"><i>Covering Period <?= esc(date('F d, Y',strtotime($from))) ?> to <?= esc(date('F d, Y',strtotime($to))) ?></i></p></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table> 
    <p class="right payroll_period"><i>Date Generated : <?php echo date("F d, Y");?></i></p>
    <!-- <p class="payroll_period"><i>For the Month of : January 2025</i></p> -->
    <p class="payroll_period bold">Project/Client : <?= esc($Company) ?> - <?= esc($emp->CCL_Company_Name) ?></p>
    
    <table>
        <tr>
            <td>
                <table cellspacing="0" cellpadding="3" style="border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; width: 50px;"><p class="center payrollheader">Employee</p></th>  
                            <th style="border: 1px solid black;"><p class="center payrollheader">Basic Pay</p></th> 
                            <th style="border: 1px solid black;"><p class="center payrollheader">Absent</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Lates</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Allowance</p></th>

                            <th style="border: 1px solid black;"><p class="center payrollheader">Reg. OT</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Night Diff.</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">SP Hol Pay</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Reg Hol Pay</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">SP Restday</p></th>

                            <th style="border: 1px solid black;"><p class="center payrollheader">Reg Restday</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Leave</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">O Earnings</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Total Earnings</p></th> 
                            <th style="border: 1px solid black;"><p class="center payrollheader">W/Tax</p></th> 

                            <th style="border: 1px solid black;"><p class="center payrollheader">SSS Cont.</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Philhealth</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">HDMF Cont.</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">SSS Loan</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">HDMF Loan</p></th>

                            <th style="border: 1px solid black;"><p class="center payrollheader">Co. Loan</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Other Adv.</p></th> 
                            <th style="border: 1px solid black;"><p class="center payrollheader">Tot. Dedn.</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">O Allowance</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">Adjustments</p></th>

                            <th style="border: 1px solid black;"><p class="center payrollheader">Net Pay</p></th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php 
                            foreach($row as $row){
                                ?>
                                <tr>
                                    <td><p class="payrollheader"><?= esc($row->CEL_Last_Name)?>, <?= esc($row->CEL_First_Name)?></p></td>  
                                    <td><p class="right payrollheader"><?= number_format((float)$row->CEL_Basic_Rate * 14, 2, '.', '') ?> </p></td> 
                                    <td><p class="right payrollheader"><?= $row->VPDL_Abs; ?></p></td>
                                    <td><p class="right payrollheader"><?= $row->VPDL_Late; ?></p></td>
                                    <td><p class="right payrollheader"><?= $row->CEL_Allowance ?? '0.00'; ?></p></td>

                                    <?php 
                                    // REGULAR OT
                                        $rwd_total = 0.00;
                                        $rwd_overtime = $row->VPDL_RWD_Ovt_Amount ?? 0.00;
                                        $rwd_overtime8 = $row->VPDL_RWD_Ovt8_Amount ?? 0.00;
                                        $rwd_np = $row->VPDL_RWD_NP_Amount ?? 0.00;
                                        $rwd_np8 = $row->VPDL_RWD_NP8_Amount ?? 0.00;
                                        $rwd_total = $rwd_overtime + $rwd_overtime8 + $rwd_np + $rwd_np8;

                                        // SP HOLIDAY
                                        $shnr_total = 0.00;
                                        $shnr_overtime = $row->VPDL_SHNR_Ovt_Amount ?? 0.00;
                                        $shnr_overtime8 = $row->VPDL_SHNR_Ovt8_Amount ?? 0.00;
                                        $shnr_np = $row->VPDL_SHNR_NP_Amount ?? 0.00;
                                        $shnr_np8 = $row->VPDL_SHNR_NP8_Amount ?? 0.00;
                                        $shnr_total = $shnr_overtime + $shnr_overtime8 + $shnr_np + $shnr_np8;

                                        // REG HOLIDAY 
                                        $rhnr_total = 0.00;
                                        $rhnr_overtime = $row->VPDL_RHNR_Ovt_Amount ?? 0.00;
                                        $rhnr_overtime8 = $row->VPDL_RHNR_Ovt8_Amount ?? 0.00;
                                        $rhnr_np = $row->VPDL_RHNR_NP_Amount ?? 0.00;
                                        $rhnr_np8 = $row->VPDL_RHNR_NP8_Amount ?? 0.00;
                                        $rhnr_total = $rhnr_overtime + $rhnr_overtime8 + $rhnr_np + $rhnr_np8;

                                        // SP HOLIDAY RESTDAY 
                                        $rd_total = 0.00;
                                        $rd_overtime = $row->VPDL_RD_Ovt_Amount ?? 0.00;
                                        $rd_overtime8 = $row->VPDL_RD_Ovt8_Amount ?? 0.00;
                                        $rd_np = $row->VPDL_RD_NP_Amount ?? 0.00;
                                        $rd_np8 = $row->VPDL_RD_NP8_Amount ?? 0.00;
                                        $rd_total = $rd_overtime + $rd_overtime8 + $rd_np + $rd_np8;

                                        // REGULAR RESTDAY PAY
                                        $rhrd_total = 0.00;
                                        $rhrd_overtime = $row->VPDL_RHRD_Ovt_Amount ?? 0.00;
                                        $rhrd_overtime8 = $row->VPDL_RHRD_Ovt8_Amount ?? 0.00;
                                        $rhrd_np = $row->VPDL_RHRD_NP_Amount ?? 0.00;
                                        $rhrd_np8 = $row->VPDL_RHRD_NP8_Amount ?? 0.00;
                                        $rhrd_total = $rhrd_overtime + $rhrd_overtime8 + $rhrd_np + $rhrd_np8;


                                        $daily_gross = 0.00;
                                        $gross_earnings = 0.00;
                                        $rate_per_day = $row->CEL_Basic_Rate / 8;
                                        $Lhrs = $row->VPDL_LHrs;
                                        $Whrs = $row->VPDL_WHrs;
                                        $total_overbreak = $row->VPDL_Total_Overbreak;
                                        $daily_gross = number_format((float)($Lhrs + $Whrs) * $rate_per_day, 2, '.', '');
                                        $gross_earnings = ($rwd_total + $shnr_total + $rhnr_total + $rd_total + $rhrd_total + $daily_gross) - $total_overbreak;

                                    // GOVERNMENT DUES
                                        $sss = $row->VPDL_SSS_Employee_Contribution ?? 0.00;
                                        $philhealth = $row->VPDL_Philhealth_Employee_Contribution ?? 0.00;
                                        $hdmf = $row->VPDL_HDMF_Employee_Contribution ?? 0.00;
                                        $tax = $row->VPDL_Withholding_Tax ?? 0.00;
                                        $total_deductions = 0.00;
                                        
                                        $total_deductions = $sss + $philhealth + $hdmf + $tax;

                                        $Netpay = $gross_earnings - $total_deductions;
                                    ?>


                                    <td><p class="right payrollheader"><?= number_format((float)$rwd_total, 2, '.', ''); ?></p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader"><?= number_format((float)$shnr_total, 2, '.', ''); ?></p></td>
                                    <td><p class="right payrollheader"><?= number_format((float)$rhnr_total, 2, '.', ''); ?></p></td>
                                    <td><p class="right payrollheader"><?= number_format((float)$rd_total, 2, '.', ''); ?></p></td>

                                    <td><p class="right payrollheader"><?= number_format((float)$rhrd_total, 2, '.', ''); ?></p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader"><?= number_format((float)$gross_earnings, 2, '.', ''); ?></p></td> 
                                    <td><p class="right payrollheader"><?= $tax ?></p></td> 

                                    <td><p class="right payrollheader"><?= $sss ?></p></td>
                                    <td><p class="right payrollheader"><?= $philhealth ?></p></td>
                                    <td><p class="right payrollheader"><?= $hdmf ?></p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>

                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td> 
                                    <td><p class="right payrollheader"><?= number_format((float)$total_deductions, 2, '.', ''); ?></p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>

                                    <td><p class="right payrollheader"><?= number_format((float)$Netpay, 2, '.', ''); ?></p></td>
                                </tr>
                                <?php
                            }
                        ?> 
                    </tbody>
                </table>
            </td> 
        </tr>
    </table>    
</body>
</html>
