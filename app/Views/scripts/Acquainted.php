<script>
    
    $(document).ready(function(){
        
        // var selectedValue = $('input[name="agree"]:checked').val();
        getgender('');
        getprovince('');
        getdiscount('');
        getbloodtype('');

        $('#medhis2_div').hide(); 
        $("#Q2_Yes,#Q2_No").click(function() { 
            Q2_val = $(this).val();   
            if(Q2_val==1){ 
                $('#medhis2_div').show(); 
            } else{
                $('#medhis2_div').hide(); 
            }  
            
        });  

        $('#medhis3_div').hide();
        $("#Q3_Yes,#Q3_No").click(function() { 
            Q3_val = $(this).val(); 
            if(Q3_val=='1'){
                $('#medhis3_div').show();
            }else{
                $('#medhis3_div').hide();
            }
            
        });

        $('#medhis4_div').hide();
        $("#Q4_Yes,#Q4_No").click(function() { 
            Q4_val = $(this).val(); 
            if(Q4_val=='1'){
                $('#medhis4_div').show();
            }else{
                $('#medhis4_div').hide();
            }
            
        }); 

        $('#medhis5_div').hide();
        $("#Q5_Yes,#Q5_No").click(function() { 
            Q5_val = $(this).val(); 
            if(Q5_val=='1'){
                $('#medhis5_div').show();
            }else{
                $('#medhis5_div').hide();
            }
            
        });

        $(".female_div").hide();
        $('#Gender').change(function() { 
            var gender = $('#Gender').val();
            if(gender == 'Male')
            { $(".female_div").hide(); }
            else
            { $('.female_div').show(); }
        })



        $('#Province').on('change',function(){
            var province = $('#Province').val();
            getcities(province);
        })

        $('#City').on('change',function(){
            var City = $('#City').val();
            getbrgys(City);
        })
        
        $('.discount_ref_div').hide();
        $('#Discount').on('change',function(){
            var Discount = $('#Discount').val();
            if(Discount=='PWD'|| Discount=='Senior Citizen'){
                
                console.log('Show Discount: ',Discount)
                $('.discount_ref_div').show();
            }else{
                
            console.log('Hide Discount: ',Discount)
                $('.discount_ref_div').hide();
            }
        })
        

        $('#submit_client').on('click',function(){ 
            clientcode      = $('#clientcode').val();

            FirstName       = $('#FirstName').val();
            MiddleName      = $('#MiddleName').val();
            LastName        = $('#LastName').val();
            ExtName         = $('#ExtName').val();
            BirthDate       = $('#BirthDate').val();
            Gender          = $('#Gender').val();
            Religion        = $('#Religion').val();
            Nationality     = $('#Nationality').val();

            Province    = $('#Province').val();
            City        = $('#City').val();
            Barangay    = $('#Barangay').val();
            Street      = $('#Street').val();
            
            TelNo      = $('#TelNo').val();
            MobileNo      = $('#MobileNo').val();
            EmailAdd      = $('#EmailAdd').val();

            Occupation = $('#Occupation').val();
            OfficeAdd = $('#OfficeAdd').val();
            OfficeTelNo = $('#OfficeTelNo').val();

            ReferredBy = $('#ReferredBy').val();
            Guardian = $('#Guardian').val();
            GuardianOccupation = $('#GuardianOccupation').val();
            GuardianReason = $('#GuardianReason').val();  

            Discount = $('#Discount').val();
            disc_ref_no = $('#disc_ref_no').val();

            Q1 = $('#Q1').val();
            Q2 = $("input[name='Q2']:checked").val();
            Q2_Remarks = $('#Q2_Remarks').val();
            Q3 = $("input[name='Q3']:checked").val();
            Q3_Remarks = $('#Q3_Remarks').val(); 
            Q4 = $("input[name='Q4']:checked").val();
            Q4_Remarks = $('#Q4_Remarks').val();
            Q5 = $("input[name='Q5']:checked").val();
            Q5_Remarks = $('#Q5_Remarks').val();
            Q6 = $("input[name='Q6']:checked").val();
            Q7 = $("input[name='Q7']:checked").val();
            Q8 = $('#Q8').val();
            Q9 = $("input[name='Q9']:checked").val();
            Q9_1 = $("input[name='Q9_1']:checked").val();
            Q9_2 = $("input[name='Q9_2']:checked").val();
            Q10 = $('#Q10').val();
            Q11 = $('#Q11').val();
            Q12 = $('#Q12').val();

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Procedures/submit_clientinfo');?>",
                data: 
                {
                    clientcode:clientcode,

                    FirstName:FirstName,
                    MiddleName:MiddleName,
                    LastName:LastName,
                    ExtName:ExtName,
                    BirthDate:BirthDate,
                    Gender:Gender,
                    Religion:Religion,

                    Discount:Discount,
                    disc_ref_no:disc_ref_no,

                    Province:Province,
                    City:City,
                    Barangay:Barangay,
                    Street:Street,

                    TelNo:TelNo,
                    MobileNo:MobileNo,
                    EmailAdd:EmailAdd,

                    Occupation:Occupation,
                    OfficeAdd:OfficeAdd,
                    OfficeTelNo:OfficeTelNo,
                    
                    ReferredBy:ReferredBy,
                    Guardian:Guardian,
                    GuardianOccupation:GuardianOccupation,
                    GuardianReason:GuardianReason,

                    Q1:Q1,
                    Q2:Q2,
                    Q2_Remarks:Q2_Remarks,
                    Q3:Q3,
                    Q3_Remarks:Q3_Remarks,
                    Q4:Q4,
                    Q4_Remarks:Q4_Remarks,
                    Q5:Q5,
                    Q5_Remarks:Q5_Remarks,
                    Q6:Q6,
                    Q7:Q7,
                    Q8:Q8,
                    Q9:Q9,
                    Q9_1:Q9_1,
                    Q9_2:Q9_2,
                    Q10:Q10,
                    Q11:Q11,
                    Q12:Q12

                },
                success:function(data){  
                    $("input[type=text], input[type=radio], input[type=text], input[type=time],input[type=date],input[type=number],select").val("");
                    
                    alert('Successfully Submitted'); 
                }
            });

        });

        $('#search_patient').on('input',function(){
            searchstring = $(this).val(); 
            $('#results').empty();
            if(searchstring)
            {
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Procedures/searchpatient');?>",
                    data: 
                    {
                        searchstring:searchstring,
                    },
                    success:function(data){
                        data = JSON.parse(data);
                        $('#results').empty();
                        data.forEach(row => { 
                            $('#results').append(`<li><a href="#!" class="searchclient" data-code="${row.CLI_Code}">${row.CLI_Code+' - '+row.CLI_LName+', '+row.CLI_FName+' '+row.CLI_MName}</a></li>`);
                        });

                        $("input[type=date],input[type=number],select").val("").prop('checked', false);
                        $("select[multiple]").val(null);
                        generate_clientdetails();
                    }
                })
            }
            
        }); 
    });
    
    function getdiscount(val){
        discounts = ['N/A','PWD','Senior Citizen'];
        $('#Discount').empty(); 
        for (let i = 0; i < discounts.length; i++) {
            if(val!='' && val==discounts[i]){
                $('#Discount').append(`<option selected value="${discounts[i]}">${discounts[i]}</option>`);
            }else{
                $('#Discount').append(`<option value="${discounts[i]}">${discounts[i]}</option>`);
            }
            
            
        }
    }
    function getgender(val){ 
        genders = ['Male','Female'];
        $('#Gender').empty(); 
        for (let i = 0; i < genders.length; i++) {
            if(val!='' && val==genders[i]){
                $('#Gender').append(`<option selected value="${genders[i]}">${genders[i]}</option>`);
            }else{
                $('#Gender').append(`<option value="${genders[i]}">${genders[i]}</option>`);
            }
            
            
        }
        
    }
    function getbloodtype(val){
        types = ['A','B','AB','O','+A','+B','+O','-B','-O'];
        $('#Q10').empty(); 
        for (let i = 0; i < types.length; i++) {
            if(val!='' && val==types[i]){
                $('#Q10').append(`<option selected value="${types[i]}">${types[i]}</option>`);
            }else{
                $('#Q10').append(`<option value="${types[i]}">${types[i]}</option>`);
            }
            
            
        }
    }
    function generate_clientdetails(){
        $('.searchclient').on('click',function(){
            clientcode = $(this).attr("data-code"); 
            $('#clientcode').val(clientcode); 
            populateclientinfo(clientcode);
            populateclientaddress(clientcode);
            populateclientcontactinfo(clientcode);
            populateclientreference(clientcode);
            populateclientmedhistory(clientcode);

        });
    }
    function populateclientinfo(clientcode){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/populateclientinfo');?>",
            data: 
            {
                clientcode:clientcode,
            },
            success:function(data){  
                data = JSON.parse(data);
                data.forEach(row => { 
                        $('#FirstName').val(row.CLI_FName);
                        $('#MiddleName').val(row.CLI_MName);
                        $('#LastName').val(row.CLI_LName);
                        $('#ExtName').val(row.CLI_Ext_Name);
                        $('#BirthDate').val(row.CLI_Birthdate); 
                        $('#Religion').val(row.CLI_Religion);
                        $('#Nationality').val(row.CLI_Nationality);
                        getgender(row.CLI_Gender);
                        getdiscount(row.CLI_Discount);
                });
            }
        });
    }
    function populateclientaddress(clientcode){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/populateclientaddress');?>",
            data: 
            {
                clientcode:clientcode,
            },
            success:function(data){  
                data = JSON.parse(data);
                console.log(data);
                data.forEach(row => { 
                    getprovince(row.CLIAL_Area_Code);
                    getcities(row.CLIAL_Area_Code,row.CLIAL_City_Code);
                    getbrgys(row.CLIAL_City_Code,row.CLIAL_Barangay_Code);
                    $('#Street').val(row.CLIAL_Street);
                });
            }
        });
    }
    function populateclientcontactinfo(clientcode){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/populateclientcontactinfo');?>",
            data: 
            {
                clientcode:clientcode,
            },
            success:function(data){  
                data = JSON.parse(data);
                console.log(data);
                data.forEach(row => { 
                    $('#TelNo').val(row.TelNo);
                    $('#MobileNo').val(row.MobileNo);
                    $('#EmailAdd').val(row.EmailAdd);
                    $('#Occupation').val(row.CLIEL_Occupation);
                    $('#OfficeAdd').val(row.CLIEL_Address); 
                    $('#OfficeTelNo').val(row.CLIEL_Contact_No);   
                });
            }
        });
    }
    function populateclientreference(clientcode){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/populateclientreference');?>",
            data: 
            {
                clientcode:clientcode,
            },
            success:function(data){  
                data = JSON.parse(data);
                console.log(data);
                data.forEach(row => { 
                    $('#ReferredBy').val(row.Referrer);
                    $('#Guardian').val(row.CCR_Name);
                    $('#GuardianOccupation').val(row.CCR_Occupation);
                    $('#GuardianReason').val(row.CCR_Remarks); 
                });
            }
        });
    }
    function populateclientmedhistory(clientcode){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/populateclientmedhistory');?>",
            data: 
            {
                clientcode:clientcode,
            },
            success:function(data){  
                data = JSON.parse(data);
                console.log(data);
                data.forEach(row => { 
                    $('input[type="radio"][name="Q1"][value="'+row.CMH_Q1+'"]').prop('checked', true);
                    $('input[type="radio"][name="Q2"][value="'+row.CMH_Q2+'"]').prop('checked', true);
                    $('input[type="radio"][name="Q3"][value="'+row.CMH_Q3+'"]').prop('checked', true);
                    $('input[type="radio"][name="Q4"][value="'+row.CMH_Q4+'"]').prop('checked', true);
                    $('input[type="radio"][name="Q5"][value="'+row.CMH_Q5+'"]').prop('checked', true);
                    $('input[type="radio"][name="Q6"][value="'+row.CMH_Q6+'"]').prop('checked', true);
                    $('input[type="radio"][name="Q7"][value="'+row.CMH_Q7+'"]').prop('checked', true);

                    $('#Q2_Remarks').val(row.CMH_Q2_Remarks);
                    $('#Q3_Remarks').val(row.CMH_Q3_Remarks);
                    $('#Q4_Remarks').val(row.CMH_Q4_Remarks);
                    $('#Q5_Remarks').val(row.CMH_Q5_Remarks);
                     
                    Q8data = JSON.parse(row.CMH_Q8); 
                    $('#Q8').val(Q8data);
                    getbloodtype(row.Q10);
 
                    Q12data = JSON.parse(row.CMH_Q12); 
                    $('#Q12').val(Q12data); 
                });
            }
        });
    }



    function getprovince(val){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getprovince');?>",
            success:function(data){  
                data = JSON.parse(data);
                 
                $('#Province').empty();
                
                $('#Province').append(`<option value="">- Select -</option>`);
                data.forEach(row => { 
                    if(val!=''&&val==row.AL_Ref_No){
                        $('#Province').append(`<option selected value="${row.AL_Ref_No}">${row.AL_Area_Desc}</option>`);
                    }else{
                        $('#Province').append(`<option value="${row.AL_Ref_No}">${row.AL_Area_Desc}</option>`);
                    }
                    
                });
            }
        })
    }

    function getcities(province,val){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getcities');?>",
            data: 
            {
                province:province,
            },
            success:function(data){  
                data = JSON.parse(data);
                 
                $('#City').empty();
                
                $('#City').append(`<option value="">- Select City -</option>`);
                data.forEach(row => { 
                    if(val!=''&&val==row.CM_Ref_No){
                        $('#City').append(`<option selected value="${row.CM_Ref_No}">${row.CM_City_Municipality_Name}</option>`);
                    }else{
                        $('#City').append(`<option value="${row.CM_Ref_No}">${row.CM_City_Municipality_Name}</option>`);
                    }
                    
                });
            }
        })
    }

    function getbrgys(city,val){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Procedures/getbrgys');?>",
            data: 
            {
                city:city,
            },
            success:function(data){  
                data = JSON.parse(data);
                 
                $('#Barangay').empty();
                
                $('#Barangay').append(`<option value="">- Select Barangay -</option>`);
                data.forEach(row => { 
                    if(val!=''&&val==row.BL_Ref_No){
                        $('#Barangay').append(`<option selected value="${row.BL_Ref_No}">${row.BL_Barangay_Name}</option>`);
                    }else{
                        $('#Barangay').append(`<option value="${row.BL_Ref_No}">${row.BL_Barangay_Name}</option>`);
                    }
                    
                });
            }
        })
    }
</script>