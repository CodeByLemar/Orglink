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
                            <th style="border: 1px solid black;"><p class="center payrollheader">Leg Hol Pay</p></th>
                            <th style="border: 1px solid black;"><p class="center payrollheader">SP Restday</p></th>

                            <th style="border: 1px solid black;"><p class="center payrollheader">Leg Restday</p></th>
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
                                    <td><p class="right payrollheader">0.00</p></td> 
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>

                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>

                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td> 
                                    <td><p class="right payrollheader">0.00</p></td> 

                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>

                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td> 
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>
                                    <td><p class="right payrollheader">0.00</p></td>

                                    <td><p class="right payrollheader">0.00</p></td>
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
