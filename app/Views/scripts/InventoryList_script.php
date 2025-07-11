<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 
<script>
    
    $(document).ready(function(){  
       
        getitemmaster();
        getSubProcedures();
        $("#addnewitem").submit(function(e){
            e.preventDefault();
            
            item_no = $('#item_no').val();
            item_desc = $('#item_desc').val();
            item_unit = $('#item_unit').val();
            item_cost = $('#item_cost').val();

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/addnewitem');?>",
                data: 
                {
                    item_no:item_no,
                    item_desc:item_desc,
                    item_unit:item_unit,
                    item_cost:item_cost
                },
                success:function(data){  
                    $("input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    $("#add_item_modal").modal('hide');
                    alert('Successfully Submitted');
                    
                    getitemmaster();
                }
            });
        });
        
        $("#edititem").submit(function(e){
            e.preventDefault();
            
            edit_item_no = $('#edit_item_no').val();
            edit_item_desc = $('#edit_item_desc').val();
            edit_item_unit = $('#edit_item_unit').val();
            edit_item_cost = $('#edit_item_cost').val();

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/edititem');?>",
                data: 
                {
                    edit_item_no:edit_item_no,
                    edit_item_desc:edit_item_desc,
                    edit_item_unit:edit_item_unit,
                    edit_item_cost:edit_item_cost
                },
                success:function(data){  
                    $("input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    $("#edititem_modal").modal('hide');
                    alert('Successfully Edited');
                    
                    getitemmaster();
                }
            });
        });

        $("#procedure").on('change',function(){ 
            procedure = $('#procedure').val();
            desc = $(this).find(':selected').attr('data-desc') 
            
            $('#procedure_label').html(desc);
            getproc_items(procedure);
        })

        $('#additemproc_btn').on('click',function(){
            item = $('#additemproc').val();
            proc = $('#procedure').val();

            if (item && proc) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/add_itemproc');?>", 
                    data: 
                    {
                        item:item, 
                        proc:proc
                    },
                    success:function(data){ 
                        procedure = $('#procedure').val(); 
                        getproc_items(procedure);
                    }
                });
            } 
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

    function item_btns(){
        $('.deleteitem_btn').on('click',function(){
            item = $(this).attr("data-item");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to delete '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/deleteitem');?>", 
                    data: 
                    {
                        item:item, 
                    },
                    success:function(data){
                        alert("Successfully Deleted");
                        getitemmaster();
                    }
                });
            } 
        });

        $('.restoreitem_btn').on('click',function(){
            item = $(this).attr("data-item");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to restore '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/restoreitem');?>", 
                    data: 
                    {
                        item:item, 
                    },
                    success:function(data){
                        alert("Successfully Restored");
                        getitemmaster();
                    }
                });
            } 
        });
        
        $('.edititem_btn').on('click',function(){
            itemno = $(this).attr("data-itemno");
            itemdesc = $(this).attr("data-itemdesc");
            itemunit = $(this).attr("data-itemunit");
            itemcost = $(this).attr("data-itemcost"); 

            $('#edit_item_no').val(itemno);
            $('#edit_item_desc').val(itemdesc);
            $('#edit_item_unit').val(itemunit); 
            $('#edit_item_cost').val(itemcost);

            // $('#itemmaster_tbl tbody').empty();  
        });
    }

    function getitemmaster(){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getitemmaster');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#itemmaster_tbl').DataTable().destroy();
                $('#itemmaster_tbl tbody').empty();
                $('#additemproc').empty();
                $('#additemproc').append(`<option value="">- Select Item -</option>`);

                for(index in data){
                    edit_action = `<a data-bs-toggle="modal" data-bs-target="#edititem_modal"
                                            data-itemno="${data[index].IM_Item_No}" 
                                            data-itemdesc="${data[index].IM_Item_Description}"  
                                            data-itemunit="${data[index].IM_Unit}" 
                                            data-itemcost="${data[index].IM_Cost}"
                                        href="#!" class="edititem_btn btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i></a>`;

                    if(data[index].IM_Status=='Active'){
                        status_action = `<a data-item="${data[index].IM_Item_No}" data-desc="${data[index].IM_Item_Description}" href="#!" class="deleteitem_btn btn btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${data[index].IM_Status}</span>`;


                        opt =`<option value="${data[index].IM_Item_No}">${data[index].IM_Item_Description}</option>`;
                        $('#additemproc').append(opt);
                    }else{
                        status_action = `<a data-item="${data[index].IM_Item_No}" data-desc="${data[index].IM_Item_Description}" href="#!" class="restoreitem_btn btn btn-sm btn-primary"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${data[index].IM_Status}</span>`;
                    }
                    
                    tr = `  <tr>
                                <td class="text-center">${data[index].IM_Item_No}</td>
                                <td class="text-center">${data[index].IM_Item_No}</td>
                                <td class="text-center">${data[index].IM_Item_Description}</td> 
                                <td class="text-center">${data[index].IM_Unit}</td>
                                <td class="text-end">${number_format(data[index].IM_Cost,2)}</td>
                                <td class="text-center">${status}</td>
                                <td class="text-center">${edit_action+' '+status_action}</td>
                            </tr>`;
  
                    $('#itemmaster_tbl').find('tbody').append(tr);
                } 
                $('#itemmaster_tbl').DataTable({
                    responsive: true,
                    autoWidth: true,
                    paging: true,
                    info : true, 
                    ordering: true,
                    searching: true 
                }).draw();

                


                item_btns();
            }
        });
    } 

    function getconfigprocs(branch){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getconfigprocs');?>", 
            data: 
            {
                branch:branch, 
            },
            success:function(data){
                 console.log(data)
            }
        });
    }

    function getbranches(){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getbranches');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#branch').empty(); 
                $('#branch').append(`<option value="">- Select Branch -</option>`);
                data.forEach(row => {
                    if(row.BL_Status=='Active'){
                        opt = `  <option value="${row.BL_Branch_Code}">${row.BL_Branch_Desc}</option> `;
                        $('#branch').append(opt);
                    }  
                    
                }); 
            }
        });
    } 

    function getSubProcedures(){ 
        
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getSubProcedures');?>", 
            success:function(data){ 
                data = JSON.parse(data); 
                $('#procedure').empty();
                $('#procedure').append(`<option value="">- Select Procedure -</option>`);
                data.forEach(row => {
                    if(row.SPL_Status=='Active'){
                        opt = `  <option data-desc="${row.SPL_SubProcedure_Desc}" value="${row.SPL_SubProcedure_ID}">${row.SPL_SubProcedure_Desc}</option> `; 
                        $('#procedure').append(opt);
                    }  
                });
            }
        });
    } 

    function getproc_items(proc){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getproc_items');?>", 
            data: 
            {
                proc:proc, 
            },
            success:function(data){ 
                data = JSON.parse(data);
                $('#proc_ul').empty();   
                if(data.length!=0){
                    data.forEach(row => {
                        // if(row.OL_Status=='Active'){
                            li = `<li>${row.IM_Item_Description}</li>`; 
                            $('#proc_ul').append(li);
                        // }  
                    });
                }else{
                    $('#proc_ul').html(`<li>No Configured Items Yet.</li>`);
                }
                // $('#proc_ul').append(`  <li>
                //                             <input type="text" class="form-control" id="additemproc">
                //                             <a href="#!" class="btn btn-sm btn-secondary">Add Item</a>
                //                         </li>`);
                
            }
        });
    }
</script>