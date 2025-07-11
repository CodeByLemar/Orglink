 
<script>
    $(document).ready(function(){
        $('#company_btn').trigger('click');
        getdeptlist();
        getcompanylist();

        assigncalendardays();
    });
    
    function assigncalendardays(){
        for (let i = 1; i <= 31; i++) {
            $('.calendardays').append(`<option value="${i}">${i}</option>`);
        }

        // Add "End of Month"
            $('.calendardays').append(`<option value="EOM">End of Month</option>`);
    }

    $(document).on('click', '.Edit_btn', function() { 
        type = $(this).attr("data-type");

        switch (type) {
            case 'company': 

                CCL_Ref_No = $(this).attr("data-CCL_Ref_No");
                CCL_Company_Code = $(this).attr("data-CCL_Company_Code");
                CCL_Company_Name = $(this).attr("data-CCL_Company_Name");

                CCL_Cutoff1_From = $(this).attr("data-CCL_Cutoff1_From");
                CCL_Cutoff1_To = $(this).attr("data-CCL_Cutoff1_To");
                CCL_Cutoff2_From = $(this).attr("data-CCL_Cutoff2_From");
                CCL_Cutoff2_To = $(this).attr("data-CCL_Cutoff2_To");

                details = [CCL_Ref_No,CCL_Company_Code,CCL_Company_Name,CCL_Cutoff1_From,CCL_Cutoff1_To,CCL_Cutoff2_From,CCL_Cutoff2_To];
                PopulateCompany(details);

                break;
            case 'dept': 
             
                CDL_Ref_No = $(this).attr("data-CDL_Ref_No");
                CDL_CCL_Ref_No = $(this).attr("data-CDL_CCL_Ref_No");
                CDL_Dept_Code = $(this).attr("data-CDL_Dept_Code");
                CDL_Dept_Name = $(this).attr("data-CDL_Dept_Name");

                details = [CDL_Ref_No,CDL_CCL_Ref_No,CDL_Dept_Code,CDL_Dept_Name];
                PopulateDept(details);
                
                break;
            case 'pos': 
                
                CPL_Ref_No = $(this).attr("data-CPL_Ref_No");
                CPL_CDL_Ref_No = $(this).attr("data-CPL_CDL_Ref_No");
                CPL_Position_Name = $(this).attr("data-CPL_Position_Name");
                CPL_Level = $(this).attr("data-CPL_Level");
                
                details = [CPL_Ref_No,CPL_CDL_Ref_No,CPL_Position_Name,CPL_Level];
                PopulatePos(details);
                
                break;
            case 'sec': 
                
                csl_ref_no = $(this).attr("data-csl_ref_no");
                csl_cdl_ref_no = $(this).attr("data-csl_cdl_ref_no");
                csl_section = $(this).attr("data-csl_section"); 
                
                details = [csl_ref_no,csl_cdl_ref_no,csl_section];
                PopulateSec(details);
                
                break;
            default:
                break;
        }
    });
    
    $(document).on('click', '.Restore_btn', function() { 
        console.log('restore daw');
        
        refno = $(this).attr("data-refno");
        desc = $(this).attr("data-desc");
        type = $(this).attr("data-type");
        status = 'Active';
        if(confirm('Are you sure you want to restore '+desc+'?')){ 
            console.log(refno,desc,type);
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/UpdateRefList');?>",
                data: 
                {
                    refno:refno,
                    type:type,
                    status:status 
                },
                success:function(data){    
                    alert('Succesfully Submitted'); 
                    $("#add_company_modal,#add_dept_modal,#add_pos_modal").modal('hide');
                    getcompanylist();
                    getdeptlist();
                    getposlist(); 
                    getseclist();
                }
            });

        }
    });

    $(document).on('click', '.Delete_btn', function() { 
        console.log('restore daw');
        
        refno = $(this).attr("data-refno");
        desc = $(this).attr("data-desc");
        type = $(this).attr("data-type");
        status = 'Inactive';
        if(confirm('Are you sure you want to delete '+desc+'?')){ 
            console.log(refno,desc,type);
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/UpdateRefList');?>",
                data: 
                {
                    refno:refno,
                    type:type,
                    status:status 
                },
                success:function(data){    
                    alert('Succesfully Submitted'); 
                    $("#add_company_modal,#add_dept_modal,#add_pos_modal").modal('hide');
                    getcompanylist();
                    getdeptlist();
                    getposlist(); 
                    getseclist(); 
                }
            });

        }
    });

    $(document).on('click', '#company_btn,#dept_btn,#pos_btn,#sec_btn', function() { 
        $('.refbtns').removeClass('btn-primary').addClass('btn-dark');
        $(this).toggleClass('btn-primary btn-dark');
        val = $(this).val();
        
        switch (val) {
            case 'company':
                getcompanylist();
                $('#company_div').fadeIn();
                $('#dept_div').hide();
                $('#pos_div').hide(); 
                $('#sec_div').hide();

                break;
            case 'dept':
                
                getdeptlist();
                $('#company_div').hide();
                $('#dept_div').fadeIn();
                $('#pos_div').hide();
                $('#sec_div').hide();

                break;
            case 'pos':
                
                getposlist();
                $('#company_div').hide();
                $('#dept_div').hide();
                $('#pos_div').fadeIn();
                $('#sec_div').hide();

                break;
            case 'sec':
                
                getseclist();
                $('#company_div').hide();
                $('#dept_div').hide();
                $('#pos_div').hide();
                $('#sec_div').fadeIn();

                break;
            default:
                break;
        }
    });


    $(document).on('change','#PDeptFilter',function(){
        console.log('test');
    });

    $('#NewCompanyForm').submit(function(e){
        e.preventDefault();

        CompanyCode = $('#CompanyCode').val();
        CompanyName = $('#CompanyName').val();

        Cutoff1_From    = $('#Cutoff1_From').val();
        Cutoff1_To      = $('#Cutoff1_To').val();

        Cutoff2_From    = $('#Cutoff2_From').val();
        Cutoff2_To      = $('#Cutoff2_To').val();
        
        if (confirm('Are you sure you want to submit?')) { 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/addcompany');?>",
                data: 
                {
                    CompanyCode:CompanyCode,
                    CompanyName:CompanyName,
                    Cutoff1_From:Cutoff1_From, 
                    Cutoff1_To:Cutoff1_To,
                    Cutoff2_From:Cutoff2_From, 
                    Cutoff2_To:Cutoff2_To
                },
                success:function(data){   
                    data = JSON.parse(data);
                    alert(data[0].msg); 
                    $('#NewCompanyForm')[0].reset();
                    $("#add_company_modal").modal('hide');
                    getcompanylist(); 
                }
            });
        }
    });

    $('#NewDeptForm').submit(function(e){
        e.preventDefault();

        DCompanyCode = $('#DCompanyCode').val();
        DeptCode = $('#DeptCode').val();
        DeptName = $('#DeptName').val();
        
        if (confirm('Are you sure you want to submit?')) { 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/adddept');?>",
                data: 
                {
                    DCompanyCode:DCompanyCode,
                    DeptCode:DeptCode,
                    DeptName:DeptName 
                },
                success:function(data){   
                    data = JSON.parse(data); 
                    alert(data[0].msg);
                    $('#NewDeptForm')[0].reset();
                    $("#add_dept_modal").modal('hide');
                    getdeptlist(); 
                }
            });
        }
    });
    
    $('#NewPosForm').submit(function(e){
        e.preventDefault();

        PDeptCode = $('#PDeptCode').val();
        PosName = $('#PosName').val();
        Level = $('#Level').val();


        
        if (confirm('Are you sure you want to submit?')) { 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/addpos');?>",
                data: 
                {
                    PDeptCode:PDeptCode,
                    PosName:PosName,
                    Level:Level 
                },
                success:function(data){   
                    data = JSON.parse(data); 
                    alert(data[0].msg);
                    $('#NewPosForm')[0].reset();
                    $("#add_pos_modal").modal('hide');
                    getposlist(); 
                }
            });
        }
    });

    $('#NewSecForm').submit(function(e){
        e.preventDefault();

        SDeptCode = $('#SDeptCode').val();
        SecName = $('#SecName').val(); 


        
        if (confirm('Are you sure you want to submit?')) { 
            console.log(SDeptCode);
            console.log(SecName);
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/addsec');?>",
                data: 
                {
                    SDeptCode:SDeptCode,
                    SecName:SecName 
                },
                success:function(data){   
                    data = JSON.parse(data); 
                    alert(data[0].msg);
                    $('#NewSecForm')[0].reset();
                    $("#add_sec_modal").modal('hide');
                    getseclist(); 
                }
            });
        }
    });
    function getcompanylist(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getcompanylist');?>", 
            success:function(data){ 
                data = JSON.parse(data); 
                $('#company_tbl tbody').empty(); 
                $('#DCompanyCode').empty();  
                $('#EditDCompanyCode').empty(); 
                $('#DCompanyCode').append(`<option value="">- Select Company -</option>`);

                $('#CompanyFilter').empty(); 
                $('#CompanyFilter').append(`<option value="All">- All Companies -</option>`);
                
                
                data.forEach(row => {  
                    edit_action = `<a href="#!" class="Edit_btn btn btn-sm btn-link"
                                        data-CCL_Ref_No="${row.CCL_Ref_No}"
                                        data-CCL_Company_Code="${row.CCL_Company_Code}"
                                        data-CCL_Company_Name="${row.CCL_Company_Name}"
                                        data-CCL_Cutoff1_From="${row.CCL_Cutoff1_From}"
                                        data-CCL_Cutoff1_To="${row.CCL_Cutoff1_To}"
                                        data-CCL_Cutoff2_From="${row.CCL_Cutoff2_From}"
                                        data-CCL_Cutoff2_To="${row.CCL_Cutoff2_To}"
                                        data-type="company"
                                    ><i class="fa-solid fa-pencil"></i></a>`; 
                    if(row.CCL_Status=='Active'){
                        status_action = `<a data-refno="${row.CCL_Ref_No}" data-desc="${row.CCL_Company_Name}" data-type="company" href="#!" class="btn btn-sm btn-link Delete_btn"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.CCL_Status}</span>`;
                    }else{
                        status_action = `<a data-refno="${row.CCL_Ref_No}" data-desc="${row.CCL_Company_Name}" data-type="company" href="#!" class="btn btn-sm btn-link Restore_btn"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.CCL_Status}</span>`;
                    }
                    cutoff = row.CCL_Cutoff1_From ? `<span class="badge rounded-pill bg-primary text-white">${row.CCL_Cutoff1_From}-${row.CCL_Cutoff1_To}</span>   <span class="badge rounded-pill bg-primary text-white">${row.CCL_Cutoff2_From}-${row.CCL_Cutoff2_To}</span>` : `<span class="badge rounded-pill bg-danger text-white">No Setup Yet.</span>`;
                    tr = `  <tr> 
                                <td class="text-center">${edit_action} ${status_action}</td> 
                                <td class="text-center">${row.CCL_Company_Code}</td>
                                <td class="text-start">${row.CCL_Company_Name}</td> 
                                <td class="text-center">${cutoff}</td>
                                <td class="text-center">${status}</td> 
                            </tr>`;
                    
                    $('#company_tbl tbody').append(tr); 

                    if(row.CCL_Status=='Active'){
                        option = `<option value="${row.CCL_Ref_No}">${row.CCL_Company_Name}</option>`;
                        $('#DCompanyCode').append(option);
                        $('#EditDCompanyCode').append(option);
                        $('#CompanyFilter').append(option); 
                        
                    } 
                    
                });
            }
        });
    }
    
    function getdeptlist(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getdeptlist');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#dept_tbl tbody').empty(); 
                $('#PDeptCode').empty(); 
                $('#SDeptCode').empty(); 
                $('#EditPDeptCode').empty(); 
                $('#EditSDeptCode').empty(); 
                $('#PDeptFilter').empty();
                $('#PDeptFilter').append(`<option value="All">- All Department -</option>`); 

                $('#PDeptCode').append(`<option value="">- Select Department -</option>`); 
                $('#SDeptCode').append(`<option value="">- Select Department -</option>`); 
                data.forEach(row => { 
                    edit_action = `<a href="#!" class="Edit_btn btn btn-sm btn-link"

                                        data-CDL_Ref_No="${row.CDL_Ref_No}"
                                        data-CDL_CCL_Ref_No="${row.CDL_CCL_Ref_No}"
                                        data-CDL_Dept_Code="${row.CDL_Dept_Code}"
                                        data-CDL_Dept_Name="${row.CDL_Dept_Name}"

                                        data-type="dept"
                                    ><i class="fa-solid fa-pencil"></i></a>`; 
                    if(row.CDL_Status=='Active'){
                        status_action = `<a data-refno="${row.CDL_Ref_No}" data-desc="${row.CDL_Dept_Name}" data-type="dept" href="#!" class="Delete_btn"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.CDL_Status}</span>`;
                    }else{
                        status_action = `<a data-refno="${row.CDL_Ref_No}" data-desc="${row.CDL_Dept_Name}" data-type="dept" href="#!" class="Restore_btn"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.CDL_Status}</span>`;
                    }

                    tr = `  <tr> 
                                <td class="text-center">${edit_action} ${status_action}</td> 
                                <td class="text-center">${row.CDL_Dept_Code}</td>
                                <td class="text-center">${row.CDL_Dept_Name}</td> 
                                <td class="text-start">${row.CompanyName}</td> 
                                <td class="text-center">${status}</td>
                            </tr>`;

                    $('#dept_tbl tbody').append(tr);
                    
                    if(row.CDL_Status=='Active'){
                        option = `<option value="${row.CDL_Ref_No}">${row.CompanyName} - ${row.CDL_Dept_Name}</option>`;
                        $('#PDeptCode').append(option);
                        $('#SDeptCode').append(option);
                        $('#EditPDeptCode').append(option);  
                        $('#EditSDeptCode').append(option);  
                        $('#PDeptFilter').append(option);
                        
                    }
                });
            }
        });
    }
    function getposlist(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getposlist');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#pos_tbl tbody').empty();
                data.forEach(row => { 
                    edit_action = `<a href="#!" class="Edit_btn btn btn-sm btn-link"

                                        data-CPL_Ref_No="${row.CPL_Ref_No}"
                                        data-CPL_CDL_Ref_No="${row.CPL_CDL_Ref_No}"
                                        data-CPL_Position_Name="${row.CPL_Position_Name}"
                                        data-CPL_Level="${row.CPL_Level}"

                                        data-type="pos"
                                    ><i class="fa-solid fa-pencil"></i></a>`;
                    if(row.CPL_Status=='Active'){
                        status_action = `<a data-refno="${row.CPL_Ref_No}" data-desc="${row.CPL_Position_Name}" data-type="pos" href="#!" class="Delete_btn"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.CPL_Status}</span>`;
                    }else{
                        status_action = `<a data-refno="${row.CPL_Ref_No}" data-desc="${row.CPL_Position_Name}" data-type="pos" href="#!" class="Restore_btn"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.CPL_Status}</span>`;
                    }

                    tr = `  <tr> 
                                <td class="text-center">${edit_action} ${status_action}</td> 
                                <td class="text-center">${row.DeptName}</td>
                                <td class="text-start">${row.CPL_Position_Name}</td> 
                                <td class="text-center">${row.CPL_Level}</td> 
                                <td class="text-center">${status}</td>
                            </tr>`;

                    $('#pos_tbl tbody').append(tr); 
                });
            }
        });
    }

    function getseclist(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getseclist');?>", 
            success:function(data){ 
                data = JSON.parse(data);
                $('#sec_tbl tbody').empty();
                data.forEach(row => { 
                    edit_action = `<a href="#!" class="Edit_btn btn btn-sm btn-link"

                                        data-CSL_Ref_No="${row.CSL_Ref_No}"
                                        data-CSL_CDL_Ref_No="${row.CSL_CDL_Ref_No}"
                                        data-CSL_Section="${row.CSL_Section}" 

                                        data-type="sec"
                                    ><i class="fa-solid fa-pencil"></i></a>`;
                    if(row.CSL_Status=='Active'){
                        status_action = `<a data-refno="${row.CSL_Ref_No}" data-desc="${row.CSL_Section}" data-type="sec" href="#!" class="Delete_btn"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.CSL_Status}</span>`;
                    }else{
                        status_action = `<a data-refno="${row.CSL_Ref_No}" data-desc="${row.CSL_Section}" data-type="sec" href="#!" class="Restore_btn"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.CSL_Status}</span>`;
                    }

                    tr = `  <tr> 
                                <td class="text-center">${edit_action} ${status_action}</td> 
                                <td class="text-center">${row.DeptName}</td>
                                <td class="text-start">${row.CSL_Section}</td>  
                                <td class="text-center">${status}</td>
                            </tr>`;

                    $('#sec_tbl tbody').append(tr); 
                });
            }
        });
    }

    function PopulateCompany(details){
        CCL_Ref_No = details[0];
        CCL_Company_Code = details[1];
        CCL_Company_Name = details[2];
        CCL_Cutoff1_From = details[3];
        CCL_Cutoff1_To = details[4];
        CCL_Cutoff2_From = details[5];
        CCL_Cutoff2_To = details[6];

        $('#edit_company_modal').modal('toggle');

        console.log(CCL_Ref_No,CCL_Company_Code,CCL_Company_Name);
        $('#CCL_Ref_No').val(CCL_Ref_No);
        $('#EditCompanyCode').val(CCL_Company_Code);
        $('#EditCompanyName').val(CCL_Company_Name);
        $('#EditCutoff1_From').val(CCL_Cutoff1_From);
        $('#EditCutoff1_To').val(CCL_Cutoff1_To);
        $('#EditCutoff2_From').val(CCL_Cutoff2_From);
        $('#EditCutoff2_To').val(CCL_Cutoff2_To);
    }

    function PopulateDept(details){
        CDL_Ref_No = details[0];
        CDL_CCL_Ref_No = details[1];
        CDL_Dept_Code = details[2];
        CDL_Dept_Name = details[3];
        $('#edit_dept_modal').modal('toggle');

        console.log(CDL_Ref_No,CDL_CCL_Ref_No,CDL_Dept_Code,CDL_Dept_Name);

        $('#CDL_Ref_No').val(CDL_Ref_No);
        $('#EditDCompanyCode').val(CDL_CCL_Ref_No);
        $('#EditDeptCode').val(CDL_Dept_Code);
        $('#EditDeptName').val(CDL_Dept_Name);
    }
    
    function PopulatePos(details){ 
        CPL_Ref_No = details[0];
        CPL_CDL_Ref_No = details[1];
        CPL_Position_Name = details[2];
        CPL_Level = details[3];

        $('#edit_pos_modal').modal('toggle');
        
        $('#CPL_Ref_No').val(CPL_Ref_No);
        $('#EditPDeptCode').val(CPL_CDL_Ref_No);
        $('#EditPosName').val(CPL_Position_Name);
        $('#EditLevel').val(CPL_Level);
        
    }

    function PopulateSec(details){ 
        CSL_Ref_No = details[0];
        CSL_CDL_Ref_No = details[1];
        CSL_Section = details[2]; 

        $('#edit_sec_modal').modal('toggle');
        
        $('#CSL_Ref_No').val(CSL_Ref_No);
        $('#EditSDeptCode').val(CSL_CDL_Ref_No);
        $('#EditSecName').val(CSL_Section); 
        
    }

    $('#EditCompanyForm').submit(function(e){
        e.preventDefault();

        CCL_Ref_No = $('#CCL_Ref_No').val();
        EditCompanyCode = $('#EditCompanyCode').val();
        EditCompanyName = $('#EditCompanyName').val();
        
        EditCutoff1_From = $('#EditCutoff1_From').val();
        EditCutoff1_To = $('#EditCutoff1_To').val(); 
        EditCutoff2_From = $('#EditCutoff2_From').val();
        EditCutoff2_To = $('#EditCutoff2_To').val(); 

        if (confirm('Are you sure you want to submit?')) { 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/EditCompany');?>",
                data: 
                {
                    CCL_Ref_No:CCL_Ref_No,
                    EditCompanyCode:EditCompanyCode,
                    EditCompanyName:EditCompanyName,
                    EditCutoff1_From:EditCutoff1_From,
                    EditCutoff1_To:EditCutoff1_To,
                    EditCutoff2_From:EditCutoff2_From,
                    EditCutoff2_To:EditCutoff2_To
                },
                success:function(data){
                    $('#EditCompanyForm')[0].reset();
                    $("#edit_company_modal").modal('hide');
                    getcompanylist(); 
                }
            });
        }
    });

    $('#EditDeptForm').submit(function(e){
        e.preventDefault();

        CDL_Ref_No = $('#CDL_Ref_No').val();
        EditDCompanyCode = $('#EditDCompanyCode').val();
        EditDeptCode = $('#EditDeptCode').val();
        EditDeptName = $('#EditDeptName').val();

        if (confirm('Are you sure you want to submit?')) { 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/EditDept');?>",
                data: 
                {
                    CDL_Ref_No:CDL_Ref_No,
                    EditDCompanyCode:EditDCompanyCode,
                    EditDeptCode:EditDeptCode,
                    EditDeptName:EditDeptName
                },
                success:function(data){
                    $('#EditDeptForm')[0].reset();
                    $("#edit_dept_modal").modal('hide');
                    getdeptlist(); 
                }
            });
        }
    });

    $('#EditPosForm').submit(function(e){
        e.preventDefault();

        CPL_Ref_No      = $('#CPL_Ref_No').val();
        EditPDeptCode   = $('#EditPDeptCode').val();
        EditPosName     = $('#EditPosName').val();
        EditLevel       = $('#EditLevel').val();

        if (confirm('Are you sure you want to submit?')) { 

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/EditPos');?>",
                data: 
                {
                    CPL_Ref_No:CPL_Ref_No,
                    EditPDeptCode:EditPDeptCode,
                    EditPosName:EditPosName,
                    EditLevel:EditLevel
                },
                success:function(data){
                    $('#EditPosForm')[0].reset();
                    $("#edit_pos_modal").modal('hide');
                    getposlist(); 
                }
            });
        }
    });

    $('#EditSecForm').submit(function(e){
        e.preventDefault();

        CSL_Ref_No      = $('#CSL_Ref_No').val();
        EditSDeptCode   = $('#EditSDeptCode').val();
        EditSecName     = $('#EditSecName').val(); 

        if (confirm('Are you sure you want to submit?')) {  
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/EditSec');?>",
                data: 
                {
                    CSL_Ref_No:CSL_Ref_No,
                    EditSDeptCode:EditSDeptCode,
                    EditSecName:EditSecName
                },
                success:function(data){
                    $('#EditSecForm')[0].reset();
                    $("#edit_sec_modal").modal('hide');
                    getseclist(); 
                }
            });
        }
    });
</script>