<script>
    $(document).ready(function(){  
        getcompanylist();  
    });

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
                        option = `<option value="${row.CCL_Ref_No}">${row.CCL_Company_Name}</option>`;
                        $('#iCompany').append(option);  
                    }  
                });
            }
        });
    }

    $(document).on('click', '#generate_alphalist', function() {
        iCompany = $('#iCompany').val();  

        // Create a form and submit it to download the Excel
        const form = $('<form>', {
            method: 'POST',
            action: '<?php echo base_url("Reports/Generate_Alphalist"); ?>'
        });

        const input = $('<input>', {
            type: 'hidden',
            name: 'iCompany',
            value: iCompany
        });

        form.append(input);
        $('body').append(form);
        form.submit();
    });
</script>