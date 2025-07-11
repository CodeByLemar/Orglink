<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 
<script>
    
    $(document).ready(function(){
        
        getprocedurelist();
 
        $("#addprocedure").submit(function(e){
            e.preventDefault();
            ProcedureID      = $('#ProcedureID').val();
            ProcedureDesc   = $('#ProcedureDesc').val();
            // StandardHrs     = $('#StandardHrs').val();
            // Priority        = $('#Priority').val(); 
            // Price        = $('#Price').val(); 
            // Cost        = $('#Cost').val(); 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/addProcedure');?>",
                data: 
                {
                    ProcedureID:ProcedureID,
                    ProcedureDesc:ProcedureDesc,
                    // StandardHrs:StandardHrs,
                    // Priority:Priority,
                    // Price:Price, 
                    // Cost:Cost
                },
                success:function(data){  
                    $("input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    $("#add_pro_modal").modal('hide');
                    alert('Successfully Submitted');
                     
                }
            });

        });

        $("#addsubprocedure").submit(function(e){
            e.preventDefault();
            sub_ProcedureID     = $('#sub_ProcedureID').val();
            sub_subProcedureID  = $('#sub_subProcedureID').val();
            sub_ProcedureDesc   = $('#sub_ProcedureDesc').val();
            sub_Cost            = $('#sub_Cost').val();
            sub_Price           = $('#sub_Price').val();
            sub_StandardHrs     = $('#sub_StandardHrs').val();

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/addsubprocedure');?>",
                data: 
                {
                    sub_ProcedureID:sub_ProcedureID,
                    sub_subProcedureID:sub_subProcedureID,
                    sub_ProcedureDesc:sub_ProcedureDesc,
                    sub_Cost:sub_Cost,
                    sub_Price:sub_Price,
                    sub_StandardHrs:sub_StandardHrs
                },
                success:function(data){  
                    $("input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    $("#add_subpro_modal").modal('hide');
                    alert('Successfully Submitted');
                     
                }
            });
        });
        
    });
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

    function proc_btns(){
        $('.deleteproc_btn').on('click',function(){
            proc = $(this).attr("data-proc");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to delete '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/deleteproc');?>", 
                    data: 
                    {
                        proc:proc, 
                    },
                    success:function(data){
                        alert("Successfully Deleted");
                       
                    }
                });
            } 
        });

        $('.restoreproc_btn').on('click',function(){
            proc = $(this).attr("data-proc");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to restore '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/restoreproc');?>", 
                    data: 
                    {
                        proc:proc, 
                    },
                    success:function(data){
                        alert("Successfully Restored");
                       
                    }
                });
            } 
        }); 
    }

    function getprocedures(){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getProcedures');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#sub_ProcedureID').empty(); 
                $('#sub_ProcedureID').append(`<option value="">- Select Procedure -</option>`);
                data.forEach(row => {
                    option = `<option value="${row.PL_Procedure_ID}">${row.PL_Procedure_Desc}</option>`;
                    $('#sub_ProcedureID').append(option);
                }); 
            }
        });
    } 

    function getprocedurelist(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getprocedurelist');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#Procedure_tbl').DataTable().destroy();
                $('#Procedure_tbl tbody').empty(); 

                for(index in data){
                    edit_action = `<a       data-procid="${data[index].SPL_Procedure_ID}" 
                                            data-subprocid="${data[index].SPL_SubProcedure_ID}" 
                                            data-subprocdesc="${data[index].SPL_SubProcedure_Desc}" 
                                            data-hrs="${data[index].SPL_Standard_Hrs}"
                                            data-cost="${data[index].SPL_Cost}"
                                            data-price="${data[index].SPL_Price}"

                                            href="#!" class="edit_proclist btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i></a>`;

                    if(data[index].SPL_Status=='Active'){
                        
                        status = `<span class="badge bg-success">${data[index].SPL_Status}</span>`;

 
                    }else{
                         
                        status = `<span class="badge bg-danger">${data[index].SPL_Status}</span>`;
                    }
                    tr = `  <tr>
                                <td class="text-center">${data[index].SPL_Procedure_ID}</td>
                                <td class="text-center">${data[index].PL_Procedure_Desc}</td>
                                <td class="text-center">${data[index].SPL_SubProcedure_ID}</td>
                                <td class="text-center">${data[index].SPL_SubProcedure_Desc}</td>
                                <td class="text-end">${number_format(data[index].SPL_Standard_Hrs,2)}</td>
                                <td class="text-end">${number_format(data[index].SPL_Cost,2)}</td>
                                <td class="text-end">${number_format(data[index].SPL_Price,2)}</td>
                                <td class="text-center">${status}</td>
                                <td class="text-center">${edit_action}</td>
                            </tr>`;
                    $('#Procedure_tbl').find('tbody').append(tr);
                } ; 

                $('#Procedure_tbl').DataTable({
                    responsive: true,
                    autoWidth: true,
                    paging: true,
                    info : true, 
                    ordering: true,
                    searching: true 
                }).draw();
            }
        });
    }
</script>