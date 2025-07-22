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
    $(function(){
        loadPayholdlist();
    });

    function loadPayholdlist(){
        $.ajax({
            url: "<?= base_url('Reports/getpayholdlist') ?>",
            type: "GET",
            dataType: "JSON",
            success:(data)=>{
                if (data.length > 0) {
                    $('#payhold_table').DataTable().destroy();
                    $('#payhold_table tbody').empty(); 
                    var i = 1;
                    data.forEach(row => { 
                        let rowClass = row.CUT_Status === 'Pay Hold' ? 'table-danger' : '';
                        tr = `  <tr class="${rowClass}"> 
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
                        $('#payhold_table tbody').append(tr); 
                        i++;
                    }); 

                    $('#payhold_table').DataTable({
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
            }
        });
    }
</script>