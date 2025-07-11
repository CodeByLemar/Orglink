<script>
    
    $(document).ready(function(){
        
        getbank(); 
        $('#submit_bank').on('click',function(){ 
            BankDesc      = $('#BankDesc').val(); 
            // Branch          = $('#Branch').val();
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/addbank');?>",
                data: 
                {
                    BankDesc:BankDesc 
                },
                success:function(data){  
                    $("input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    $("#bank_modal").modal('hide');
                    // alert('Successfully Submitted');
                    
                    getbank(); 
                }
            });

        });
    });

    function getbank(){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getbanklist');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#bank_tbl tbody').empty();
                // <td class="text-center">${row.RL_Ref_No}</td>
                data.forEach(row => {
                    
                    // <td class="text-center">${row.BL_Branch_Desc}</td> 
                    if(row.BL_Status=='Active'){
                        status_action = `<a data-bank="${row.BL_Ref_No}" data-desc="${row.BL_Description}" href="#!" class="deletebank_btn btn btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.BL_Status}</span>`;
                    }else{
                        status_action = `<a data-bank="${row.BL_Ref_No}" data-desc="${row.BL_Description}" href="#!" class="restorebank_btn btn btn-sm btn-primary"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.BL_Status}</span>`;
                    }
                    tr = `  <tr> 
                                <td class="text-center">${row.BL_Description}</td> 
                                <td class="text-center">${status}</td> 
                                <td class="text-center">${status_action}</td> 
                            </tr>`;
                    $('#bank_tbl tbody').append(tr); 
                });
                bank_btns();
            }
        });
    }

    function bank_btns(){
        $('.deletebank_btn').on('click',function(){
            bank = $(this).attr("data-bank");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to delete '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/deletebank');?>", 
                    data: 
                    {
                        bank:bank, 
                    },
                    success:function(data){
                        alert("Successfully Deleted");
                        getbank(); 
                    }
                });
            } 
        });

        $('.restorebank_btn').on('click',function(){
            bank = $(this).attr("data-bank");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to restore '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/restorebank');?>", 
                    data: 
                    {
                        bank:bank, 
                    },
                    success:function(data){
                        alert("Successfully Restored");
                        getbank(); 
                    }
                });
            } 
        }); 
    } 
</script>