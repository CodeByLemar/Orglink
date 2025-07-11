<script> 
    $(document).ready(function(){ 
        $('#generate_plan').hide();
        accrefno = $('#accrefno').val();

        getprocbreakdown(accrefno);
        gettreatmentplan(accrefno);
        populate_procs('',0);
        
        
        $('#generate_plan').on('click',function(){
           
            var confirmed = confirm('Are you sure you want to generate the treatment plan?');
            if (confirmed) {
                acc_refno = $('#accrefno').val();  
                console.log(acc_refno)
                // $.ajax({
                //     type: "POST",
                //     url:"<?php echo base_url('Procedures/generate_plan');?>",
                //     data:
                //     { 
                //         acc_refno:acc_refno 
                //     },
                //     success:function(data){ 
                //         alert('Successfully Generated'); 
                //     }
                // })
            }

        });

        $('#generate_pdf').on('click',function(){
            window.open('<?= base_url('Procedures/treatmentplan_pdf') ?>', '_blank'); 

        });

        $('#add_proc').on('click',function(){ 
            ctr = $('#ctr').val();
            ctr++;
            var newRow = `  <tr>
                                <td class="text-center"> 
                                    <input type="hidden" name="refno[]" id="refno${ctr}">
                                    <select required name="procedure[]" id="procedure${ctr}" class="form-control">
                                        <option value="">- Select -</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <input required type="date" class="form-control" name="effective_date[]" id="effective_date${ctr}">
                                </td>
                                <td class="text-center">
                                    <input required type="number" class="form-control" name="duration[]" id="duration${ctr}">
                                </td>
                                <td class="text-center">
                                    <input required type="text" class="form-control" name="tooth[]" id="tooth${ctr}">
                                </td>
                                <td class="text-center">
                                    <input required type="text" class="form-control" name="desc[]" id="desc${ctr}">
                                </td>
                                <td class="text-end pe-5">
                                    <input required type="number" class="form-control" name="price[]" id="price${ctr}">
                                </td>
                                <td class="text-end pe-5">
                                    <input required type="number" class="form-control" name="disc_price[]" id="disc_price${ctr}">
                                </td>
                                <td class="text-center"><a href="#!" class="mt-1 remove btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>`;
            // $('#treatment_tbl').find('tbody').append(newRow); 
            $('#treatment_tbl tbody').append(newRow);
            populate_procs('',ctr);
            $('#ctr').val(ctr);

        });

        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });

        
        $("#submit_treatmentplan").submit(function(e){
            e.preventDefault();

            
            var refno = $('input[name="refno[]"]').map(function() {
                return $(this).val();
            }).get();

            var procedure = $('select[name="procedure[]"]').map(function() {
                return $(this).val();
            }).get();
            
            var effective_date = $('input[name="effective_date[]"]').map(function() {
                return $(this).val();
            }).get();

            var tooth = $('input[name="tooth[]"]').map(function() {
                return $(this).val();
            }).get();

            var duration = $('input[name="duration[]"]').map(function() {
                return $(this).val();
            }).get();

            var desc = $('input[name="desc[]"]').map(function() {
                return $(this).val();
            }).get();
            
            var price = $('input[name="price[]"]').map(function() {
                return $(this).val();
            }).get();

            var disc_price = $('input[name="disc_price[]"]').map(function() {
                return $(this).val();
            }).get();

            acc_refno = $('#accrefno').val();  
             
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/submit_treatmentplan');?>",
                data:
                {
                    refno:refno,
                    acc_refno:acc_refno,
                    procedure:procedure,
                    effective_date:effective_date,
                    tooth:tooth,
                    duration:duration,
                    desc:desc,
                    price:price,
                    disc_price:disc_price 
                },
                success:function(data){
                    // $("input[type=text], input[type=date],input[type=number],select").val("");
                    $("#treatment_tbl tbody").empty();
                    alert('Successfully Submitted');
                    gettreatmentplan(acc_refno);
                }
            })
        });

    });

    function populate_procs(val,ctr){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getSubProcedures');?>",  
            success:function(data){ 
                data = JSON.parse(data);
                $('#procedure'+ctr+'').empty();
                if(data.length != 0){
                    var option = ``;
                    
                    $('#procedure'+ctr+'').append(`<option value="">- Select -</option>`);
                    for(index in data){
                        if(val==data[index].SPL_Ref_No){
                            option = `<option selected value="${data[index].SPL_Ref_No}">${data[index].SPL_SubProcedure_Desc}</option>`;
                        }else{
                            option = `<option value="${data[index].SPL_Ref_No}">${data[index].SPL_SubProcedure_Desc}</option>`;
                        }
                        
                        
                        $('#procedure'+ctr+'').append(option);
                    }
                }
            }
        }); 
    }

    
    function gettreatmentplan(refno){
        subtotal = 0;
        discount_amount = 0;
        ctr=0;
        procs ='';
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/gettreatmentplan');?>", 
            data: 
            {
                refno:refno 
            },
            success:function(data){ 
                data = JSON.parse(data);
                
                if(data.length!=0){
                    
                    $('#generate_plan').show(); 
                    
                    $('#treatment_tbl tbody').empty();
                    price = 0;
                    disc_price = 0;
                    data.forEach(row => { 
                        tr = `  <tr>
                                    <td class="text-center">
                                        <input type="hidden" name="refno[]" id="refno${ctr}" value="${row.TPL_Ref_No}">
                                        <select name="procedure[]" id="procedure${ctr}" class="form-control">
                                            <option value="">- Select -</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="date" class="form-control" name="effective_date[]" id="effective_date${ctr}" value="${row.TPL_Date}">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="duration[]" id="duration${ctr}" value="${row.TPL_Duration}">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="tooth[]" id="tooth${ctr}" value="${row.TPL_Tooth}">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="desc[]" id="desc${ctr}" value="${row.TPL_Tooth_Description}">
                                    </td>
                                    <td class="text-end pe-5">
                                        <input type="number" class="form-control" name="price[]" id="price${ctr}" value="${row.TPL_Price}">
                                    </td>
                                    <td class="text-end pe-5">
                                        <input type="number" class="form-control" name="disc_price[]" id="disc_price${ctr}" value="${row.TPL_Discounted_Price}">
                                    </td>
                                    <td class="text-center"><a href="#!" class="mt-1 remove btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                                </tr>`;
                                $('#treatment_tbl tbody').append(tr);
                                price = +price + +row.TPL_Price;
                                disc_price = +disc_price + +row.TPL_Discounted_Price;
                                populate_procs(row.TPL_SPL_Ref_No,ctr);
                                ctr++;
                    });

                    $('#ctr').val(ctr);
                    // console.log(number_format(price,2),number_format(disc_price,2));
                    $('#total_price').html(number_format(price,2));
                    $('#total_discprice').html(number_format(disc_price,2));
                }

                
            }
        })
    }
    function getprocbreakdown(refno){
        subtotal = 0;
        discount_amount = 0;
        procs ='';
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getprocbreakdown');?>", 
            data: 
            {
                refno:refno 
            },
            success:function(data){ 
                data = JSON.parse(data);
                $('#procedure_billing_tbl tbody').empty();
                data.forEach(row => { 
                    proc_date = new Date(row.CSL_Date);
                    $('#client_name').val(row.CLI_LName+', '+row.CLI_FName+' '+row.CLI_MName);
                    $('#treatment_date').val(proc_date.toISOString().split('T')[0]);
                    // tr = `  <tr>
                    //             <td class="text-center">${row.SPL_SubProcedure_Desc}</td>
                    //             <td class="pe-10 text-end">${number_format(row.SPL_Price,2)}</td>
                    //         </tr>`;
                    // subtotal = subtotal + +row.SPL_Price;
                    // $('#procedure_billing_tbl tbody').append(tr);

                    // procs = procs+', '+row.SPL_SubProcedure_Desc; 
                    
                    // discount = row.CLI_Discount;
                    
                    // $('#clientcode_hid').val(row.CSL_Client_Code);
                    // $('#incharge_hid').val(row.CSL_Action_Needed_By);
                });
                 
                // if(discount=='PWD' || discount=='Senior Citizen'){  
                //     discount_amount = (+subtotal * .2);
                //     $('#discount').html(discount);
                //     $('#pwd_senior').html(number_format(discount_amount,2));
                    
                //     $('#pwd_senior_hid').val(discount_amount);
                // }


                // totalbilling = subtotal - discount_amount;
                // $('#procedure').val(trimCharacterFromStart(procs,', '));
                // $('#subtotal').html(number_format(subtotal,2));
                
                // $('#total_billing').html(number_format(totalbilling,2));
                
                // $('#subtotal_hid').val(subtotal);
                // $('#total_billing_hid').val(totalbilling);
                
                
            }
        });
    } 

    
    function trimCharacterFromStart(str, charToTrim) {
        const regex = new RegExp(`^${charToTrim}+`);
        return str.replace(regex, '');
    }

    function nulltoblank(x){
        if(x==null){
            x= '';
        }
        return x;
    }

    function nulltozero(x){
        if(x==null){
            x= 0;
        }
        return x;
    }

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