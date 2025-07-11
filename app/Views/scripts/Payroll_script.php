<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 
<script> 

$(document).ready(function(){

    // getpayrollperiods();
    
    getcompanylist(); 



});

    $(document).on('click', '#PayrollPeriod', function() {
        const opt = $(this).find('option:selected');
        const startDate = opt.data('start'); 
        const endDate   = opt.data('end');
        
        $('#ifrom').val(startDate);
        $('#ito').val(endDate);
         
    });
    
    function getpayrollperiods(cutoff1_from, cutoff1_to, cutoff2_from, cutoff2_to) {
        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        const year = new Date().getFullYear();
        const pad = (val) => val.toString().padStart(2, '0');

        if (!cutoff1_from || !cutoff1_to || !cutoff2_from || !cutoff2_to) {
            alert("Please fill in all cutoff inputs.");
            return;
        }

        $('#PayrollPeriod').empty().append(`<option value="">- Select Period -</option>`);

        months.forEach((month, i) => {
            const monthIndex = i + 1;
            const monthStr = pad(monthIndex);
            const yearStr = year.toString();

            // ------------------------
            // Cutoff 1 (same month)
            // ------------------------
            const start1 = `${yearStr}-${monthStr}-${pad(cutoff1_from)}`;
            const end1 = `${yearStr}-${monthStr}-${pad(cutoff1_to)}`;
            const label1 = `${months[i]} ${cutoff1_from} – ${months[i]} ${cutoff1_to}, ${year}`;

            $('#PayrollPeriod').append(`
                <option value="${start1} ${end1}" data-start="${start1}" data-end="${end1}">
                    ${label1}
                </option>
            `);

            // ------------------------
            // Cutoff 2 (may cross month)
            // ------------------------
            let endMonthIndex = monthIndex;
            let endMonthYear = year;
            let cutoff2_to_final = cutoff2_to;

            if ((cutoff2_to + '').toUpperCase() === 'EOM') {
                cutoff2_to_final = new Date(year, monthIndex, 0).getDate(); // end of current month
            } else if (parseInt(cutoff2_to) < parseInt(cutoff2_from)) {
                // crosses to next month
                endMonthIndex = monthIndex === 12 ? 1 : monthIndex + 1;
                endMonthYear = monthIndex === 12 ? year + 1 : year;
            }

            const start2 = `${yearStr}-${monthStr}-${pad(cutoff2_from)}`;
            const end2 = `${endMonthYear}-${pad(endMonthIndex)}-${pad(cutoff2_to_final)}`;
            const label2 = `${months[i]} ${cutoff2_from} – ${months[endMonthIndex - 1]} ${cutoff2_to_final}, ${year}`;

            $('#PayrollPeriod').append(`
                <option value="${start2} ${end2}" data-start="${start2}" data-end="${end2}">
                    ${label2}
                </option>
            `);
        });
    }





    function getcompanylist(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getcompanylist');?>", 
            success:function(data){ 
                data = JSON.parse(data); 
                $('#iCompany').empty();  
                $('#iCompany').append(`<option value="">- Select Company -</option>`);  
                
                data.forEach(row => {   

                    if(row.CCL_Status=='Active'){
                        option = `<option data-cutoff1_from="${row.CCL_Cutoff1_From}" data-cutoff1_to="${row.CCL_Cutoff1_To}" data-cutoff2_from="${row.CCL_Cutoff2_From}" data-cutoff2_to="${row.CCL_Cutoff2_To}" value="${row.CCL_Company_Code}">${row.CCL_Company_Name}</option>`;
                        $('#iCompany').append(option); 
                        
                    } 
                    
                });
            }
        });
    }
    
    $(document).on('change', '#iCompany', function(){
        const selected = $(this).find(':selected');

        const cutoff1_from = selected.data('cutoff1_from');
        const cutoff1_to   = selected.data('cutoff1_to');
        const cutoff2_from = selected.data('cutoff2_from');
        const cutoff2_to   = selected.data('cutoff2_to');
        // console.log(cutoff1_from,cutoff1_to,cutoff2_from,cutoff2_to);
        getpayrollperiods(cutoff1_from,cutoff1_to,cutoff2_from,cutoff2_to);

    });
    $(document).on('click', '#GeneratePayroll', function() {
        iCompany = $('#iCompany').val();
        ifrom = $('#ifrom').val();
        ito = $('#ito').val(); 
        
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Payroll/getvalidatedlogs');?>", 
            data:{
                iCompany:iCompany,
                ifrom:ifrom,
                ito:ito
            },
            success:function(data){ 
                data = JSON.parse(data); 

                $('#Payroll_tbl').DataTable().destroy();
                $('#Payroll_tbl tbody').empty(); 
                var i = 1;
                data.forEach(row => { 
                    payslip_btn = `<a title="Print Employee Payslip" href="#!" class="btn btn-sm btn-info generate_payslip" data-id="${row.CUT_Client_ID}"><i class="fa-regular fa-file-pdf"></i></a>`;
                    tr = `  <tr> 
                                <td class="text-start">${i}</td>
                                <td class="text-start">${row.CUT_Company_Code}</td>
                                <td class="text-start">${row.CUT_From}</td>
                                <td class="text-start">${row.CUT_To}</td>
                                <td class="text-start">${row.CUT_Client_ID}</td>
                                <td class="text-start">${row.CUT_Emp_Name}</td>
                                <td class="text-start">${row.CUT_Position}</td>
                                <td class="text-start">${row.CUT_Dept}</td>

                                <td class="text-end">${row.CUT_Late}</td>
                                <td class="text-end">${row.CUT_Undertime}</td>
                                <td class="text-end">${row.CUT_Absent}</td>
                                <td class="text-end">${row.CUT_LHrs}</td>
                                <td class="text-end">${row.CUT_WHrs}</td>
                                <td class="text-end">${row.CUT_NP}</td>
                                <td class="text-end">${row.CUT_NP_Amount}</td>
                                <td class="text-end">${row.CUT_Ovrbreak}</td>
                                <td class="text-end">${row.CUT_Ovrbreak_Amount}</td>

                                <td class="text-end">${row.CUT_RWD_Ovt}</td>
                                <td class="text-end">${row.CUT_RWD_Ovt_Amount}</td>
                                <td class="text-end">${row.CUT_RWD_Ovt8}</td>
                                <td class="text-end">${row.CUT_RWD_Ovt8_Amount}</td>
                                <td class="text-end">${row.CUT_RWD_NP}</td>
                                <td class="text-end">${row.CUT_RWD_NP_Amount}</td>
                                <td class="text-end">${row.CUT_RWD_NP8}</td>
                                <td class="text-end">${row.CUT_RWD_NP8_Amount}</td> 

                                <td class="text-end">${row.CUT_RD_Ovt}</td>
                                <td class="text-end">${row.CUT_RD_Ovt_Amount}</td>
                                <td class="text-end">${row.CUT_RD_Ovt8}</td>
                                <td class="text-end">${row.CUT_RD_Ovt8_Amount}</td>
                                <td class="text-end">${row.CUT_RD_NP}</td>
                                <td class="text-end">${row.CUT_RD_NP_Amount}</td>
                                <td class="text-end">${row.CUT_RD_NP8}</td>
                                <td class="text-end">${row.CUT_RD_NP8_Amount}</td>  

                                <td class="text-end">${row.CUT_RHNR_Ovt}</td>
                                <td class="text-end">${row.CUT_RHNR_Ovt_Amount}</td>
                                <td class="text-end">${row.CUT_RHNR_Ovt8}</td>
                                <td class="text-end">${row.CUT_RHNR_Ovt8_Amount}</td>
                                <td class="text-end">${row.CUT_RHNR_NP}</td>
                                <td class="text-end">${row.CUT_RHNR_NP_Amount}</td>
                                <td class="text-end">${row.CUT_RHNR_NP8}</td> 
                                <td class="text-end">${row.CUT_RHNR_NP8_Amount}</td> 

                                <td class="text-end">${row.CUT_RHRD_Ovt}</td>
                                <td class="text-end">${row.CUT_RHRD_Ovt_Amount}</td>
                                <td class="text-end">${row.CUT_RHRD_Ovt8}</td>
                                <td class="text-end">${row.CUT_RHRD_Ovt8_Amount}</td>
                                <td class="text-end">${row.CUT_RHRD_NP}</td>
                                <td class="text-end">${row.CUT_RHRD_NP_Amount}</td>
                                <td class="text-end">${row.CUT_RHRD_NP8}</td> 
                                <td class="text-end">${row.CUT_RHRD_NP8_Amount}</td> 

                                <td class="text-end">${row.CUT_SHNR_Ovt}</td>
                                <td class="text-end">${row.CUT_SHNR_Ovt_Amount}</td>
                                <td class="text-end">${row.CUT_SHNR_Ovt8}</td>
                                <td class="text-end">${row.CUT_SHNR_Ovt8_Amount}</td>
                                <td class="text-end">${row.CUT_SHNR_NP}</td>
                                <td class="text-end">${row.CUT_SHNR_NP_Amount}</td>
                                <td class="text-end">${row.CUT_SHNR_NP8}</td> 
                                <td class="text-end">${row.CUT_SHNR_NP8_Amount}</td> 

                                <td class="text-end">${row.CUT_SHRD_Ovt}</td>
                                <td class="text-end">${row.CUT_SHRD_Ovt_Amount}</td>
                                <td class="text-end">${row.CUT_SHRD_Ovt8}</td>
                                <td class="text-end">${row.CUT_SHRD_Ovt8_Amount}</td>
                                <td class="text-end">${row.CUT_SHRD_NP}</td>
                                <td class="text-end">${row.CUT_SHRD_NP_Amount}</td>
                                <td class="text-end">${row.CUT_SHRD_NP8}</td> 
                                <td class="text-end">${row.CUT_SHRD_NP8_Amount}</td> 

                                <td class="text-start">${row.CUT_Remarks ?? ''}</td>
                                <td class="text-center">${payslip_btn}</td>
                            </tr>`;
                    $('#Payroll_tbl tbody').append(tr); 
                    i++;
                }); 

                $('#Payroll_tbl').DataTable({
                    responsive: true,
                    autoWidth: false,
                    columnDefs: [
                        {
                            targets: 2,  
                            width: '150px'  
                        },
                        {
                            targets: 3,  
                            width: '150px'  
                        },
                        {
                            targets: 5,  
                            width: '150px' 
                        }
                    ], 
                    paging: false,
                    info : true, 
                    ordering: true,
                    searching: true,
                    dom: 'Bfrtip',  
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            title: 'TimeLogs_Export',
                            text: 'Export to Excel',
                            className: 'fw-bold btn btn-sm btn-success'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'TimeLogs_Export',
                            orientation: 'landscape',
                            pageSize: 'A4'
                        } 
                    ]
 
                }).draw();
            }
        });

    });

    $(document).on('click','.generate_payslip', function(){
        Company = $('#iCompany').val();
        From = $('#ifrom').val();
        To = $('#ito').val();
        Client = $(this).data('id');

        console.log(Company,From,To,Client);

        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Payroll/generate_payslip');?>",
            data: 
            {
                Company:Company,
                From:From,
                To:To,
                Client:Client 
            },
            success:function(data){
                window.open('<?= base_url('Payroll/payslip_pdf') ?>', '_blank');   
            }
        });
        
    })

    $(document).on('click','#print_register',function(){
        Company = $('#iCompany').val();
        From = $('#ifrom').val();
        To = $('#ito').val(); 
  

        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Payroll/print_register');?>",
            data: 
            {
                Company:Company,
                From:From,
                To:To 
            },
            success:function(data){
                window.open('<?= base_url('Payroll/print_register_pdf') ?>', '_blank');   
            }
        });
    });
</script>