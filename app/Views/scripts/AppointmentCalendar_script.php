
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>

<script>
    $(document).ready(function(){  
        $('.chosen-select').chosen({
            disable_search_threshold: 10, // Show search field only if there are more than 10 options
            no_results_text: "Oops, nothing found!", // Text to display when no results found
            placeholder_text_single: "Select an option", // Placeholder for single select boxes
            placeholder_text_multiple: "Select some options" // Placeholder for multiple select boxes
        });

        populate_calendar();

        getclients(); 
        getprocedures();
        getdentists();
        getbranches();
        getrooms();
        getmodeofpayments();

        $('#create_treatmentplan').on('click',function(){
            acc_refno      = $('#acc_refno').val(); 
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/setclienttreatmentplan');?>",
                data: 
                {
                    acc_refno:acc_refno, 
                },
                success:function(data){ 
                    window.location.href = '<?= site_url('Procedures/treatmentplan') ?>';           
                }
            });
        });

        $('#periodontal_chart').on('click',function(){
            acc_refno      = $('#acc_refno').val(); 
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/setclientperiodontal');?>",
                data: 
                {
                    acc_refno:acc_refno, 
                },
                success:function(data){ 
                    window.location.href = '<?= site_url('Procedures/client_periodontal') ?>';           
                }
            });
        });

        $('#modeofpayment').on('change',function(){
            mop = $(this).val();
            if(mop=='Debit Card' || mop=='Credit Card'){ 
                $('#bankcompany_div').show(); 
                populate_bank('bank_company');
                $('#refno_div').hide();
            }else if(mop=='HMO'){
                $('#refno_div').show();
                $('#bankcompany_div').show(); 
                populate_company('bank_company');
            }else if(mop=='Online Payment'){
                $('#refno_div').show();
                $('#bankcompany_div').show(); 
                populate_bank('bank_company');
            }else{
                $('#refno_div').hide();
                $('#bankcompany_div').hide();
            }
        });

        $('#payment_btn').on('click',function(){  
            refno = $('#acc_refno').val();
            getarpaymentschedule(refno);
            $('#app_accomplishment_modal').modal('toggle');
            $('#payment_modal').modal('toggle');

            $('#refno_div').hide();
            $('#bankcompany_div').hide(); 
        });

        $('#billing_btn').on('click',function(){  
            $('#app_accomplishment_modal').modal('toggle');
            $('#billing_modal').modal('toggle');
        });

        $('#app_operation').on('change',function(){
           operation = $('#app_operation').val(); 
           totalhrs = 0;
           for(var i=0;i<operation.length;i++){
                op = operation[i].split("-");  
                totalhrs = +totalhrs + +op[1];
           }
           $('#app_duration').val(totalhrs);
        })

        $('#app_branch').on('change',function(){
            var branch = $("#app_branch").val();
            getrooms(branch);
        })

        $('#others_disc').on('change',function(){
            var others_disc = $("#others_disc").val();

            var subtotal_hid = $('#subtotal_hid').val();
            var pwd_senior_hid = $('#pwd_senior_hid').val();
            console.log('others_disc',others_disc);
            console.log('subtotal_hid',subtotal_hid);
            console.log('pwd_senior_hid',pwd_senior_hid);
            totalbilling = +subtotal_hid - (+pwd_senior_hid + +others_disc);
            
            $('#total_billing').html(number_format(totalbilling,2));
            $('#total_billing_hid').val(totalbilling);
        })

        $('#app_client').on('change',function(){
            app_client = $(this).val();
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/getclienthistory');?>", 
                data:{
                    app_client:app_client
                },
                success:function(data){
                    data = JSON.parse(data); 
                    $('#client_history_tbl tbody').empty();
                    if(data.length>0)
                    {
                        data.forEach(row => {
                            procdate = row.CSL_Date;
                            tr = `  <tr>
                                        <td><span class="ms-5">${procdate.substr(0,10)}</span></td>
                                        <td>${row.InCharge}</td>
                                        <td>${row.SPL_SubProcedure_Desc}</td>
                                    </tr>`;
                            
                            $('#client_history_tbl tbody').append(tr);
                        //     if(row.BL_Status=='Active'){
                        //         opt = `<option value="${row.BL_Branch_Code}">${row.BL_Branch_Desc}</option>`;
                        //         $('#app_branch').append(opt);
                        //     } 
                        });
                    }else{
                        $('#client_history_tbl tbody').append(`<tr><td colspan="3" class="text-center"><i>No Client History</i></td></tr>`);
                    }
                    
                }
            });
        });

        $('#submit_app').on('click',function(){
            app_client      = $('#app_client').val();
            app_operation   = $('#app_operation').val();
            app_dentist     = $('#app_dentist').val();
            app_date        = $('#app_date').val();
            app_time        = $('#app_time').val();
            app_room        = $('#app_room').val();
            app_remarks     = $('#app_remarks').val();
            app_duration    = $('#app_duration').val();
 
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/create_new_app');?>",
                data: 
                {
                    app_client:app_client,
                    app_operation:app_operation,
                    app_dentist:app_dentist,
                    app_date:app_date,
                    app_time:app_time,
                    app_room:app_room,
                    app_remarks:app_remarks,
                    app_duration:app_duration 
                },
                success:function(data){ 
                    $("input[type=text], input[type=date],input[type=number],select").val("");
                    $("#app_calendar_modal").modal('hide');
                    alert('Successfully Submitted');
                    
                    populate_calendar(); 
                    getclients();
                    
                    getprocedures();
                    getdentists();
                    getbranches();
                }
            });

        });

        $('#complete_app').submit(function(e){
            e.preventDefault(); 

            refno = $('#acc_refno').val();
            remarks = $('#acc_remarks').val();
            ToothArray = [];
            $("input:checkbox[name=tooth_no]:checked").each(function(){
                ToothArray.push($(this).val());5
            });

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/complete_app');?>", 
                data: 
                {
                    refno:refno, 
                    remarks:remarks,
                    ToothArray:ToothArray
                },
                success:function(data){ 
                    $("input[type=text], input[type=date],input[type=number],select").val("");
                    $("#app_accomplishment_modal").modal('hide');
                    alert('Successfully Submitted');
                    populate_calendar();
                }
            }); 
        });

        $('#create_billing').submit(function(e){
            e.preventDefault();

            acc_refno = $('#acc_refno').val();
            others_disc = $('#others_disc').val();
            pwd_senior_hid = $('#pwd_senior_hid').val();
            incharge_hid = $('#incharge_hid').val();
            clientcode_hid = $('#clientcode_hid').val();
            total_billing_hid = $('#total_billing_hid').val();
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/submit_billing');?>", 
                data: 
                {
                    acc_refno:acc_refno,
                    others_disc:others_disc,
                    pwd_senior_hid:pwd_senior_hid,
                    incharge_hid:incharge_hid,
                    clientcode_hid:clientcode_hid,
                    total_billing_hid:total_billing_hid
                },
                success:function(data){ 
                    $("input[type=text], input[type=date],input[type=number],select").val("");
                    $("#billing_modal").modal('hide');
                    alert('Successfully Created');
                    populate_calendar();
                }
            });
        });

        $('#submit_payment').submit(function(e){
            e.preventDefault();

            arrefno = $('#arrefno').val();
            modeofpayment = $('#modeofpayment').val();
            ornumber = $('#ornumber').val();
            amount_due = $('#amount_due').val();
            amount_paid = $('#amount_paid').val(); 

            bank_company = $('#bank_company').val();
            approvedrefno = $('#approvedrefno').val();

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/submit_payment');?>", 
                data: 
                {
                    arrefno:arrefno,
                    modeofpayment:modeofpayment,
                    ornumber:ornumber,
                    amount_due:amount_due,
                    amount_paid:amount_paid,
                    
                    bank_company:bank_company,
                    approvedrefno:approvedrefno
                },
                success:function(data){ 
                    $("input[type=text], input[type=date],input[type=number],select").val("");
                    $("#payment_modal").modal('hide');
                    alert('Successfully Submitted');
                    populate_calendar();
                }
            });
        });

        $('#add_payment').on('click',function(){
            const newRow = `
                            <tr>
                                <td>
                                    <select class="form-control" name="modeofpayment" id="modeofpayment">
                                        <option value="">- Select -</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="HMO">HMO</option>
                                        <option value="Online Payment">Online Payment</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="amount_paid"> 
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bank_company"> 
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="approvedrefno"> 
                                </td>
                            </tr> `;
            $('#payment_tbl tbody').append(newRow);
        });

        $('#resched_btn').on('click',function(){
            $('#app_accomplishment_modal').modal('toggle');
            $('#resched_modal').modal('toggle'); 
        });
        
        $('#cancel_btn').on('click',function(){
            $('#app_accomplishment_modal').modal('toggle');
            $('#cancel_modal').modal('toggle'); 
        });

        $('#submit_resched').submit(function(e){
            e.preventDefault();

            acc_refno = $('#acc_refno').val();
            new_date = $('#new_date').val();
            resched_reason = $('#resched_reason').val();

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/submit_resched');?>", 
                data: 
                {
                    acc_refno:acc_refno,
                    new_date:new_date,
                    resched_reason:resched_reason
                },
                success:function(data){ 
                    $("input[type=text], input[type=date],input[type=number],select").val("");
                    $("#resched_modal").modal('toggle');
                    alert('Successfully Submitted');
                    populate_calendar();
                }
            }); 
        });

        $('#submit_cancel').submit(function(e){
            e.preventDefault();

            acc_refno = $('#acc_refno').val();
            cancel_reason = $('#cancel_reason').val(); 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/submit_cancel');?>", 
                data: 
                {
                    acc_refno:acc_refno,
                    cancel_reason:cancel_reason 
                },
                success:function(data){ 
                    $("input[type=text], input[type=date],input[type=number],select").val("");
                    $("#cancel_modal").modal('toggle');
                    alert('Successfully Submitted');
                    populate_calendar();
                }
            }); 
        });
        
    });

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

    function getbranches(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getbranches');?>", 
            success:function(data){
                data = JSON.parse(data);
                $('#app_branch').empty();
                $('#app_branch').append(`<option value="">- Select -</option>`);
                data.forEach(row => {
                    if(row.BL_Status=='Active'){
                        opt = `<option value="${row.BL_Branch_Code}">${row.BL_Branch_Desc}</option>`;
                        $('#app_branch').append(opt);
                    } 
                });
            }
        });
    }

    function getclients(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getclients');?>", 
            success:function(data){
                data = JSON.parse(data);
                $('#app_client').empty();
                $('#app_client').append(`<option value="">- Select -</option>`);
                data.forEach(row => {   
                    opt = `<option value="${row.CLI_Code}">${row.CLI_LName}, ${row.CLI_FName} ${row.CLI_MName}</option>`;
                    $('#app_client').append(opt); 
                });
            }
        });
    }

    function getrooms(branch){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getrooms');?>", 
            data: 
            {
                branch:branch 
            },
            success:function(data){ 
                data = JSON.parse(data);
                $('#app_room').empty();
                $('#app_room').append(`<option value="">- Select -</option>`);
                data.forEach(row => {   
                    opt = `<option value="${row.RL_Ref_No}">${row.RL_Description}</option>`;
                    $('#app_room').append(opt); 
                });
            }
        });
    }

    function getprocedures(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getSubProcedures');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#app_operation').empty();
                $('#app_operation').append(`<option value="">- Select -</option>`);
                data.forEach(row => {
                    opt = `<option value="${row.SPL_Ref_No}-${row.SPL_Standard_Hrs}">${row.ProcDesc}</option>`;
                    $('#app_operation').append(opt); 
                });
                $('#app_operation').trigger("chosen:updated"); 
            }
        });
    }

    function getdentists(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getdentists');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#app_dentist').empty();
                $('#app_dentist').append(`<option value="">- Select -</option>`);
                data.forEach(row => {
                    opt = `<option value="${row.DID}">${row.FULLNAME}</option>`;
                    $('#app_dentist').append(opt); 
                });
            }
        });
    }
     
    function populate_calendar() {
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getschedule');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay' // user can switch between the two
                    },
                    eventDisplay:'block',
                    showNonCurrentDates: false, 
                    eventClick: function(info) {
                        
                        event = info.event.title; 
                        myArray = event.split("-"); 
                         
                        let refno  = myArray[0].trim();
                        let clientname = myArray[1].trim();
                        let incharge = myArray[2].trim();
                        // let incharge = myArray[3].trim();
                        $('#client_name').val(clientname);
                        // $('#procedure').val(procedure);
                        $('#incharge').val(incharge);

                        getbreakdown(refno);
                        $('#app_accomplishment_modal').modal('toggle');

                        // Billing Form
                        $('#client_label').html(clientname);
                        $('#incharge_label').html(incharge);

                        getprocbreakdown(refno);
                        // Billing Form

                    },
                    views: {
                        timeGridFourDay: {
                            type: 'timeGrid',
                            dayCount: 4
                        }
                    } ,
                    events: data
                    ,eventDidMount: function (info) {
                        //month, week and day timeview
                        var _title = info.el.querySelectorAll('.fc-event-title')[0];
                        if (_title) {
                            _title.innerHTML = info.event.title;
                        }
                        else {
                            //listview/agenda
                            var _list_event_title = info.el.querySelectorAll('.fc-list-event-title')[0];
                            if (_list_event_title) {
                                var _a = $('a', _list_event_title)[0];
                                if(_a) {
                                _a.innerHTML = info.event.title;
                                }
                            }
                        
                        }

                    } 
                });
                calendar.render();
            }
        });

        
    };  

    function getbreakdown(refno){ 
        // CSL_Result_Remarks,Billing_Date,Payment
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getbreakdown');?>", 
            data: 
            {
                refno:refno 
            },
            success:function(data){ 
                data = JSON.parse(data); 
                // console.log(data);
                $('#items_used tbody').empty();
                
                $("#acc_remarks").val("");
                TotalDue = 0;
                data.forEach(row => { 
                    CSL_Result_Remarks  = row.CSL_Result_Remarks;
                    Billing_Date        = row.Billing_Date;
                    Payment             = row.Payment;
                    AmountDue             = row.AmountDue;
                    TotalDue = +AmountDue - +Payment;
                    acc_date = new Date(row.start);
                    $('#acc_refno').val(refno);
                    $('#acc_branch').val(row.Branch);
                    $('#acc_room').val(row.RL_Description);
                    $('#acc_date').val(acc_date.toISOString().split('T')[0]);
                    // $('#procedure').val(row.Procs);
                    if(row.IM_Item_Description!=null){
                        tr =`<tr>
                                <td class="text-start"><span class="ms-5">${row.IM_Item_Description}</span></td>
                                <td class="text-center">1</td>
                            </tr>`;
                        $('#items_used tbody').append(tr);
                    } 
                    $('.form-check-input').attr('checked', false);
                    $('.form-check-input').attr('checked', false);
                    if(row.CSL_Result_Remarks!=null){  
                        $('#acc_remarks').val(row.CSL_Result_Remarks); 
                        row.CSL_Teeth = row.CSL_Teeth.replace(/[\[\]"]/g, ''); 
                        Teeth = row.CSL_Teeth.split(',');
                        
                        for(i=0;i<Teeth.length;i++){ 
                            $('input:checkbox[value="'+Teeth[i]+'"]').attr('checked', true);
                        } 
                        $('#appsubmit_btn').hide();
                    }else{
                        $('#appsubmit_btn').show();
                    }


                    // Billing Form 
                    $('#date_label').html(acc_date.toISOString().split('T')[0]);
                    if(row.Full_Address){ $('#add_label').html(row.Full_Address.toUpperCase()); }
                    
                    // Billing Form

                    //Show / Hide Divs
                    (CSL_Result_Remarks!=null) ? $('#billing_btn').show() : $('#payment_btn').hide() ;
                    
                    if (Billing_Date!=null) {
                        $('#payment_btn').show();
                        $('#billing_btn').hide();
                    } 
                    else{ 
                        $('#billing_btn').show();
                    } 
                    
                    if (Billing_Date!=null && TotalDue == 0) {
                        $('#billing_btn').hide();
                        $('#payment_btn').hide();
                    } 

                    if(Billing_Date!=null || CSL_Result_Remarks!=null){
                        $('#resched_btn').hide();
                        $('#cancel_btn').hide();
                    }else{
                        $('#resched_btn').show();
                        $('#cancel_btn').show();
                    }
                    //Show / Hide Divs
                })
                
            }
        });
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
                    tr = `  <tr>
                                <td class="text-center">${row.SPL_SubProcedure_Desc}</td>
                                <td class="pe-10 text-end">${number_format(row.SPL_Price,2)}</td>
                            </tr>`;
                    subtotal = subtotal + +row.SPL_Price;
                    $('#procedure_billing_tbl tbody').append(tr);

                    procs = procs+', '+row.SPL_SubProcedure_Desc; 
                    
                    discount = row.CLI_Discount;
                    
                    $('#clientcode_hid').val(row.CSL_Client_Code);
                    $('#incharge_hid').val(row.CSL_Action_Needed_By);
                });
                 
                if(discount=='PWD' || discount=='Senior Citizen'){  
                    discount_amount = (+subtotal * .2);
                    $('#discount').html(discount);
                    $('#pwd_senior').html(number_format(discount_amount,2));
                    
                    $('#pwd_senior_hid').val(discount_amount);
                }


                totalbilling = subtotal - discount_amount;
                $('#procedure').val(trimCharacterFromStart(procs,', '));
                $('#subtotal').html(number_format(subtotal,2));
                
                $('#total_billing').html(number_format(totalbilling,2));
                
                $('#subtotal_hid').val(subtotal);
                $('#total_billing_hid').val(totalbilling);
                
                
            }
        });
    }

    function getmodeofpayments(){
        modes = ['Cash','Debit Card','Credit Card','HMO','Online Payment'];
        $('#modeofpayment').empty();
        for(var i=0;i<modes.length;i++)
        {
            tr = `<option value="${modes[i]}">${modes[i]}</option>`;
            $('#modeofpayment').append(tr);
        }
    }

    function getarpaymentschedule(refno){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getarpaymentschedule');?>", 
            data: 
            {
                refno:refno 
            },
            success:function(data){ 
                data = JSON.parse(data); 
                data.forEach(row => {
                    $('#arrefno').val(row.ARML_Ref_No);
                    $('#amount_due').val( (+row.ARPS_Amount - +row.AmountPaid) );
                });
            }
        });
    }

    function populate_bank(field){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/populate_bank');?>",  
            success:function(data){ 
                data = JSON.parse(data);
                $('#'+field+'').empty();
                $('#'+field+'').append(`<option value="">- Select -</option>`);
                data.forEach(row => {
                    opt = `<option value="${row.BL_Ref_No}">${row.BL_Description}</option>`;
                    $('#'+field+'').append(opt); 
                }); 
            }
        });
    }

    function populate_company(field){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/populate_company');?>",  
            success:function(data){ 
                data = JSON.parse(data);
                $('#'+field+'').empty();
                $('#'+field+'').append(`<option value="">- Select -</option>`);
                data.forEach(row => {
                    opt = `<option value="${row.HCL_Ref_No}">${row.HCL_Description}</option>`;
                    $('#'+field+'').append(opt); 
                });
            }
        });
    }
</script>

<!-- [{ 
                "title": "Client 1 - Operation 1", // Required
                "start": "2024-10-21", // Required  
                "end": "2024-10-21", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 3 - Operation 3", // Required
                "start": "2024-10-17", // Required  
                "end": "2024-10-17", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 2 - Operation 2", // Required
                "start": "2024-10-23", // Required  
                "end": "2024-10-23", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 1 - Operation 2", // Required
                "start": "2024-10-23", // Required  
                "end": "2024-10-23", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 3 - Operation 2", // Required
                "start": "2024-10-23", // Required  
                "end": "2024-10-23", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "white", // Optional
                "textColor": "black" // Optional
            },{ 
                "title": "Client 1 - Operation 3", // Required
                "start": "2024-10-25", // Required  
                "end": "2024-10-25", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 3 - Operation 2", // Required
                "start": "2024-10-25", // Required  
                "end": "2024-10-25", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "white", // Optional
                "textColor": "black" // Optional
            },{ 
                "title": "Client 1 - Operation 1", // Required
                "start": "2024-10-27", // Required  
                "end": "2024-10-27", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "green", // Optional
                "textColor": "white" // Optional
            },{ 
                "title": "Client 1 - Consultation", // Required
                "start": "2024-10-29", // Required  
                "end": "2024-10-29", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "green", // Optional
                "textColor": "white" // Optional
            },{ 
                "title": "Client 2 - Consultation", // Required
                "start": "2024-10-29", // Required  
                "end": "2024-10-29", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "green", // Optional
                "textColor": "white" // Optional
            },{ 
                "title": "Client 3 - Consultation", // Required
                "start": "2024-10-29", // Required  
                "end": "2024-10-29", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "green", // Optional
                "textColor": "white", // Optional,
                "tooltip": "test"
            }] -->