<script>
    
    $(document).ready(function(){
        
        gethmocompany(); 
        $('#submit_company').on('click',function(){ 
            CompanyDesc      = $('#CompanyDesc').val(); 
            // Branch          = $('#Branch').val();
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/addhmocompany');?>",
                data: 
                {
                    CompanyDesc:CompanyDesc
                    // Branch:Branch
                },
                success:function(data){  
                    $("input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    $("#hmo_modal").modal('hide');
                    // alert('Successfully Submitted');
                    
                    gethmocompany(); 
                }
            });

        });
    });

    function gethmocompany(){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/gethmocompany');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#hmo_tbl tbody').empty();
                // <td class="text-center">${row.RL_Ref_No}</td>
                data.forEach(row => {
                    
                    // <td class="text-center">${row.BL_Branch_Desc}</td> 
                    if(row.HCL_Status=='Active'){
                        status_action = `<a data-com="${row.HCL_Ref_No}" data-desc="${row.HCL_Description}" href="#!" class="deletehmo_btn btn btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.HCL_Status}</span>`;
                    }else{
                        status_action = `<a data-com="${row.HCL_Ref_No}" data-desc="${row.HCL_Description}" href="#!" class="restorehmo_btn btn btn-sm btn-primary"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.HCL_Status}</span>`;
                    }
                    tr = `  <tr> 
                                <td class="text-center">${row.HCL_Description}</td> 
                                <td class="text-center">${status}</td> 
                                <td class="text-center">${status_action}</td> 
                            </tr>`;
                    $('#hmo_tbl tbody').append(tr); 
                });
                hmo_btns();
            }
        });
    }

    function hmo_btns(){
        $('.deletehmo_btn').on('click',function(){
            com = $(this).attr("data-com");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to delete '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/deletehmocom');?>", 
                    data: 
                    {
                        com:com, 
                    },
                    success:function(data){
                        alert("Successfully Deleted");
                        gethmocompany(); 
                    }
                });
            } 
        });

        $('.restorehmo_btn').on('click',function(){
            com = $(this).attr("data-com");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to restore '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/restorehmocom');?>", 
                    data: 
                    {
                        com:com, 
                    },
                    success:function(data){
                        alert("Successfully Restored");
                        gethmocompany(); 
                    }
                });
            } 
        }); 
    } 
</script>