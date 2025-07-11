<script>
    
    $(document).ready(function(){
        
        getrooms();
        getbranches();
        $('#submit_room').on('click',function(){ 
            RoomDesc      = $('#RoomDesc').val(); 
            // Branch          = $('#Branch').val();
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/addroom');?>",
                data: 
                {
                    RoomDesc:RoomDesc
                    // Branch:Branch
                },
                success:function(data){  
                    $("input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    $("#room_modal").modal('hide');
                    // alert('Successfully Submitted');
                    
                    getrooms();
                    getbranches();
                }
            });

        });
    });

    function getrooms(){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getrooms');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#room_tbl tbody').empty();
                // <td class="text-center">${row.RL_Ref_No}</td>
                data.forEach(row => {
                    
                    // <td class="text-center">${row.BL_Branch_Desc}</td> 
                    if(row.RL_Status=='Active'){
                        status_action = `<a data-room="${row.RL_Ref_No}" data-desc="${row.RL_Description}" href="#!" class="deleteroom_btn btn btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.RL_Status}</span>`;
                    }else{
                        status_action = `<a data-room="${row.RL_Ref_No}" data-desc="${row.RL_Description}" href="#!" class="restoreroom_btn btn btn-sm btn-primary"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.RL_Status}</span>`;
                    }
                    tr = `  <tr> 
                                <td class="text-center">${row.RL_Description}</td> 
                                <td class="text-center">${status}</td> 
                                <td class="text-center">${status_action}</td> 
                            </tr>`;
                    $('#room_tbl tbody').append(tr); 
                });
                room_btns();
            }
        });
    }

    function room_btns(){
        $('.deleteroom_btn').on('click',function(){
            room = $(this).attr("data-room");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to delete '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/deleteroom');?>", 
                    data: 
                    {
                        room:room, 
                    },
                    success:function(data){
                        alert("Successfully Deleted");
                        getrooms();
                        getbranches();
                    }
                });
            } 
        });

        $('.restoreroom_btn').on('click',function(){
            room = $(this).attr("data-room");
            desc = $(this).attr("data-desc");
            if (confirm('Are you sure you want to restore '+desc+'?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/restoreroom');?>", 
                    data: 
                    {
                        room:room, 
                    },
                    success:function(data){
                        alert("Successfully Restored");
                        getrooms();
                        getbranches();
                    }
                });
            } 
        }); 
    }
    
    function getbranches(){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getbranches');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#Branch').empty();
                $('#Branch').append(`<option value="">- Select -</option>`);
                data.forEach(row => {
                    option =`<option value="${row.BL_Branch_Code}">${row.BL_Branch_Desc}</option>`;
                    $('#Branch').append(option);
                }); 
            }
        });
    }
</script>