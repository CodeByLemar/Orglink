<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 
<script>
    
    $(document).ready(function(){ 
        
        $('#generate_collection_report').on('click',function(){
            
            from     = $('#from').val();
            to     = $('#to').val();  
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Reports/getcollection_report');?>", 
                data: 
                {
                    from:from,
                    to:to 
                },
                success:function(data){ 
                    data = JSON.parse(data);
                    $('#collection_rpt_tbl tbody').empty();
                    totalbillingamount=totalamountpaid=cashcount=debitcount=creditcount=hmocount=onlinecount=0;
                    data.forEach(row => { 
                        totalbillingamount = +totalbillingamount + +row.PL_Amount_Due;
                        totalamountpaid = +totalamountpaid + +row.PL_Amount_Paid;
                        tr = `  <tr>
                                    <td class="text-center">${row.PL_ARML_Ref_No}</td>
                                    <td class="text-center">${row.PL_Date}</td>
                                    <td class="text-center">${row.clientname}</td>  
                                    <td class="text-end">${number_format(row.PL_Amount_Paid,2)}</td>
                                    <td class="text-center">${row.PL_OR_Number}</td> 
                                    <td class="text-center">${row.PL_Mode_Of_Payment}</td>
                                    <td class="text-center">${row.BankCompanyReference}</td>
                                </tr>`;
                        $('#collection_rpt_tbl tbody').append(tr);
                        
                        switch (row.PL_Mode_Of_Payment) {
                            case 'Cash':
                                cashcount++;
                                break;
                            case 'Debit Card':
                                debitcount++;
                                break;
                            case 'Credit Card':
                                creditcount++;
                                break;
                            case 'HMO':
                                hmocount++;
                                break;
                            case 'Online Payment':
                                onlinecount++;
                                break;
                            default:
                                break;
                        }
                    }); 
                    totalbalance = +totalbillingamount - +totalamountpaid;
                    // $('#totalbillingamount').html(number_format(totalbillingamount,2));
                    $('#totalamountpaid').html(number_format(totalamountpaid,2));
                    // $('#totalbalance').html(number_format(totalbalance,2));

                    $('#cash_count').html(cashcount);
                    $('#debit_count').html(debitcount);
                    $('#credit_count').html(creditcount);
                    $('#hmo_count').html(hmocount);
                    $('#online_count').html(onlinecount);
                }
            });
        });
    });

    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>

<!-- tr = `  <tr>
    <td class="text-center">${row.PL_ARML_Ref_No}</td>
    <td class="text-center">${row.PL_Date}</td>
    <td class="text-center">${row.clientname}</td> 
    <td class="text-end">${number_format(row.PL_Amount_Due,2)}</td> 
    <td class="text-end">${number_format(row.PL_Amount_Paid,2)}</td>
    <td class="text-start">${row.PL_OR_Number}</td>
    <td class="text-end">${number_format(row.OustandingBal,2)}</td>
    <td class="text-center">${row.PL_Mode_Of_Payment}</td>
    <td class="text-center">${row.BankCompanyReference}</td>
</tr>`; -->