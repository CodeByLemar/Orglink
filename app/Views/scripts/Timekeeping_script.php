<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 

<script src="https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    $(document).ready(function(){ 
        // getpayrollperiods();
        
        getcompanylist();   

        function isValidDate(str) {
            // Check format: yyyy-mm-dd
            const regex = /^\d{4}-\d{2}-\d{2}$/;
            if (!regex.test(str)) return false;

            const [year, month, day] = str.split('-').map(Number);

            // Basic logical validation
            const date = new Date(str);
            return (
                date.getFullYear() === year &&
                date.getMonth() + 1 === month &&
                date.getDate() === day
            );
        }
 
        $(document).on('click', '#uploadlogs', function (e) {
            e.preventDefault();

            var fileInput = $('#timelog')[0];
            if (fileInput.files.length === 0) {
                alert('Please select an XLSX file to upload.');
                return;
            }

            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, { type: 'array' });

                var sheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[sheetName];
                var sheetData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

                if (sheetData.length < 13) {
                    alert("XLSX file is too short or malformed.");
                    return;
                }

                let CompanyCode = sheetData[0][1];
                let dateFromRaw = sheetData[1][1];
                let dateToRaw = sheetData[2][1];

                if(dateFromRaw==''||dateToRaw==''){
                    
                    alert("Date From and Date To is required.");
                    return;
                }
                function excelSerialToJSDate(serial) {
                    const utc_days = serial - 25569;
                    const utc_value = utc_days * 86400;
                    return new Date(utc_value * 1000);
                }

                function formatDate(date) {
                    return date.toISOString().split('T')[0];
                }

                let dateFrom = typeof dateFromRaw === 'number' ? formatDate(excelSerialToJSDate(dateFromRaw)) : dateFromRaw;
                let dateTo = typeof dateToRaw === 'number' ? formatDate(excelSerialToJSDate(dateToRaw)) : dateToRaw;
                 
                console.log(sheetData);
                if (!isValidDate(dateFrom) || !isValidDate(dateTo)) {  
                    alert("Invalid 'Date From' or 'Date To' in rows 8/9.");
                    return;
                }

                for (let i = 5; i < sheetData.length; i++) {
                    const row = sheetData[i];
                    if (!row || row.length < 76) continue;

                    const CUT_Client_ID = row[0];
                    const CUT_Emp_Name = row[1];
                    const CUT_Position = row[2];
                    const CUT_Dept = row[3];
                    if(CUT_Client_ID==undefined){
                        break;
                    }
                    if (!/^[0-9]+$/.test(CUT_Client_ID)) {
                        alert(`Invalid Employee No. on row ${i + 1}. Employee No. should be numeric.`); 
                        console.log(CUT_Client_ID);
                        console.log(sheetData.length);
                        return;
                    }

                    if (CUT_Emp_Name.trim() === '') {
                        alert(`Invalid Employee Name on row ${i + 1}. Employee Name should not be blank.`);
                        return;
                    }

                    const numericFields = row.slice(6, 26);
                    for (let j = 0; j < numericFields.length; j++) {
                        if (numericFields[j] && isNaN(numericFields[j])) { 
                            alert(`Invalid number in row ${i + 1}, column ${j + 6}. Field should be numeric.`);
                            return;
                        }
                    }
                }

                // If all validation passed, send to backend
                var formData = new FormData();
                formData.append('timelog', file);

                $.ajax({
                    url: "<?php echo base_url('Payroll/uploadtimelogs');?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        alert('File uploaded successfully!');

                        retrieveuploadedlogs(CompanyCode, dateFrom, dateTo);
                        // retrieveconvertedlogs(CompanyCode, dateFrom, dateTo);
                    },
                    error: function (xhr, status, error) {
                        alert('Error uploading file.');
                        console.error(error);
                    }
                });

                $('#upload_modal').modal('toggle');
                $('.timelogsdiv').fadeIn();
            };

            reader.onerror = function (err) {
                alert("Error reading the XLSX file.");
                console.error(err);
            };

            reader.readAsArrayBuffer(file);
        });


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


        retrieveuploadedlogs(iCompany,ifrom,ito);
        // retrieveconvertedlogs(iCompany,ifrom,ito);

        $('#filter_modal').modal('toggle');
    });

    function retrieveuploadedlogs(iCompany,ifrom,ito){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Payroll/retrieveuploadedlogs');?>", 
            data:{
                iCompany:iCompany,
                ifrom:ifrom,
                ito:ito
            },
            success:function(data){ 
                data = JSON.parse(data); 

                $('#TimeLogs_tbl').DataTable().destroy();
                $('#TimeLogs_tbl tbody').empty(); 
                var i = 1;
                data.forEach(row => { 
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
                            </tr>`;
                    $('#TimeLogs_tbl tbody').append(tr); 
                    i++;
                }); 

                $('#TimeLogs_tbl').DataTable({
                    responsive: true,
                    autoWidth: false,
                    columnDefs: [
                        {
                            targets: 2,  
                            width: '80px'  
                        },
                        {
                            targets: 3,  
                            width: '80px'  
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
    }

    // function retrieveconvertedlogs(iCompany,ifrom,ito){
    //     company = iCompany;
    //     from = ifrom;
    //     to = ito;

    //     $.ajax({
    //         type: "POST",
    //         url:"<?php echo base_url('Payroll/retrieveconvertedlogs');?>", 
    //         data:{
    //             company:company,
    //             from:from,
    //             to:to,
    //         },
    //         success:function(data){ 
    //             data = JSON.parse(data); 

    //             $('#ProcessedTimeLogs_tbl').DataTable().destroy();
    //             $('#ProcessedTimeLogs_tbl tbody').empty(); 
    //             var i = 1;
    //             data.forEach(row => { 
    //                 tr = `  <tr> 
    //                             <td class="text-start">${i}</td>
    //                             <td class="text-start">${row.CUT_Company_Code}</td>
    //                             <td class="text-start">${row.CUT_From}</td>
    //                             <td class="text-start">${row.CUT_To}</td>
    //                             <td class="text-start">${row.CUT_Client_ID}</td>
    //                             <td class="text-start">${row.CUT_Emp_Name}</td>
    //                             <td class="text-start">${row.CUT_Position}</td>
    //                             <td class="text-start">${row.CUT_Dept}</td>
    //                             <td class="text-end">${row.CUT_Late}</td>
    //                             <td class="text-end">${row.CUT_Undertime}</td>
    //                             <td class="text-end">${row.CUT_Absent}</td>
    //                             <td class="text-end">${row.CUT_LHrs}</td>
    //                             <td class="text-end">${row.CUT_WHrs}</td>
    //                             <td class="text-end">${row.CUT_Ovrbreak}</td>
    //                             <td class="text-end">${row.CUT_NP}</td>

    //                             <td class="text-end">${row.CUT_RWD_Ovt}</td>
    //                             <td class="text-end">${row.CUT_RWD_Ovt8}</td>
    //                             <td class="text-end">${row.CUT_RWD_NP}</td>
    //                             <td class="text-end">${row.CUT_RWD_NP8}</td>
    //                             <td class="text-end">${row.CUT_RWD_NPOT}</td>

    //                             <td class="text-end">${row.CUT_RD_Ovt}</td>
    //                             <td class="text-end">${row.CUT_RD_Ovt8}</td>
    //                             <td class="text-end">${row.CUT_RD_NP}</td>
    //                             <td class="text-end">${row.CUT_RD_NP8}</td>
    //                             <td class="text-end">${row.CUT_RD_NPOT}</td>
                                
    //                             <td class="text-end">${row.CUT_ROT_Ovt}</td>
    //                             <td class="text-end">${row.CUT_ROT_Ovt8}</td>
    //                             <td class="text-end">${row.CUT_ROT_NP}</td>
    //                             <td class="text-end">${row.CUT_ROT_NP8}</td>
    //                             <td class="text-end">${row.CUT_ROT_NPOT}</td>

    //                             <td class="text-end">${row.CUT_RHNR_Ovt}</td>
    //                             <td class="text-end">${row.CUT_RHNR_Ovt8}</td>
    //                             <td class="text-end">${row.CUT_RHNR_NP}</td>
    //                             <td class="text-end">${row.CUT_RHNR_NP8}</td>
    //                             <td class="text-end">${row.CUT_RHNR_NPOT}</td>

    //                             <td class="text-end">${row.CUT_RHRD_Ovt}</td>
    //                             <td class="text-end">${row.CUT_RHRD_Ovt8}</td>
    //                             <td class="text-end">${row.CUT_RHRD_NP}</td>
    //                             <td class="text-end">${row.CUT_RHRD_NP8}</td>
    //                             <td class="text-end">${row.CUT_RHRD_NPOT}</td>

    //                             <td class="text-end">${row.CUT_SHNR_Ovt}</td>
    //                             <td class="text-end">${row.CUT_SHNR_Ovt8}</td>
    //                             <td class="text-end">${row.CUT_SHNR_NP}</td>
    //                             <td class="text-end">${row.CUT_SHNR_NP8}</td>
    //                             <td class="text-end">${row.CUT_SHNR_NPOT}</td>

    //                             <td class="text-end">${row.CUT_SHRD_Ovt}</td>
    //                             <td class="text-end">${row.CUT_SHRD_Ovt8}</td>
    //                             <td class="text-end">${row.CUT_SHRD_NP}</td>
    //                             <td class="text-end">${row.CUT_SHRD_NP8}</td>
    //                             <td class="text-end">${row.CUT_SHRD_NPOT}</td>
    //                             <td class="text-start">${row.CUT_Remarks ?? ''}</td>
    //                         </tr>`;
    //                 $('#ProcessedTimeLogs_tbl tbody').append(tr); 
    //                 i++;
    //             }); 

    //             $('#ProcessedTimeLogs_tbl').DataTable({
    //                 responsive: true,
    //                 autoWidth: false,
    //                 columnDefs: [
    //                     {
    //                         targets: 2,
    //                         width: '80px'
    //                     },
    //                     {
    //                         targets: 3,
    //                         width: '80px'
    //                     },
    //                     {
    //                         targets: 5,
    //                         width: '150px'
    //                     }
    //                 ], 
    //                 paging: false,
    //                 info : true, 
    //                 ordering: true,
    //                 searching: true,
    //                 dom: 'Bfrtip',
    //                 buttons: [
    //                     {
    //                         extend: 'excelHtml5',
    //                         title: 'TimeLogs_Export',
    //                         text: 'Export to Excel',
    //                         className: 'fw-bold btn btn-sm btn-success'
    //                     },
    //                     {
    //                         extend: 'pdfHtml5',
    //                         title: 'TimeLogs_Export',
    //                         orientation: 'landscape',
    //                         pageSize: 'A4'
    //                     } 
    //                 ],
    //                 // scrollY: '400px',  // 👈 Fixed height here
    //                 // scrollX: true,
    //                 // scrollCollapse: true,
 
    //             }).draw();
                
    //         }
    //     });
    // }
    
</script>