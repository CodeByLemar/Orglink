 
<script>
    $(document).ready(function(){
        $('#company_btn').trigger('click');
        getdeptlist();
        getcompanylist();
        getarealist('#area', '#edit_area');
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
            case 'branch': 
                CBL_Ref_No = $(this).attr("data-CBL_Ref_No");
                CBL_CCL_Ref_No = $(this).attr("data-CBL_CCL_Ref_No");
                CBL_Branch_Code = $(this).attr("data-CBL_Branch_Code");
                CBL_Branch_Name = $(this).attr("data-CBL_Branch_Name");
                CBL_Area = $(this).attr("data-CBL_Area");
                CBL_Municipality = $(this).attr("data-CBL_Municipality");
                CBL_Street_Brgy = $(this).attr("data-CBL_Street_Brgy");

                details = [
                    CBL_Ref_No, CBL_CCL_Ref_No, CBL_Branch_Code, CBL_Branch_Name, CBL_Area, CBL_Municipality, CBL_Street_Brgy
                ];

                PopulateBranch(details);
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
                    $("#add_company_modal,#add_dept_modal,#add_pos_modal, #add_branch_modal").modal('hide');
                    getcompanylist();
                    getdeptlist();
                    getposlist(); 
                    getseclist();
                    getbranchlist();
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
                    $("#add_company_modal,#add_dept_modal,#add_pos_modal, #add_branch_modal").modal('hide');
                    getcompanylist();
                    getdeptlist();
                    getposlist(); 
                    getseclist(); 
                    getbranchlist();
                }
            });

        }
    });

    $(document).on('click', '#company_btn, #branch_btn, #dept_btn,#pos_btn,#sec_btn', function() { 
        $('.refbtns').removeClass('btn-primary').addClass('btn-dark');
        $(this).toggleClass('btn-primary btn-dark');
        val = $(this).val();

        $("#company_div, #branch_div, #dept_div, #pos_div, #sec_div").hide();
        
        switch (val) {
            case 'company':
                getcompanylist();
                $('#company_div').fadeIn();
                break;
            case 'branch': 
                getbranchlist();
                $('#branch_div').fadeIn();
            break;
            
            case 'dept':
                
                getdeptlist();
                $('#dept_div').fadeIn();
                break;
            case 'pos':
                
                getposlist();
                $('#pos_div').fadeIn();
                break;
            case 'sec':
                
                getseclist();
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

                $('#b_company').empty().append(`<option value="">Select a company</option>`);
                $('#EditBranchCompany').empty().append(`<option value="">Select a company</option>`);
                
                
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
                        $('#b_company').append(option);
                        $('#EditBranchCompany').append(option);
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


    function getarealist(element, element2){
        $.ajax({
            url: "<?= base_url('ReferenceMaintenance/getarealist') ?>",
            type: "GET",
            dataType: "JSON",
            success:(data)=>{
                if (data.length > 0) {
                    $(element).empty().append(`<option value="">Select an area</option>`);
                    $(element2).empty().append(`<option value="">Select an area</option>`);

                    data.forEach((row)=>{
                        $(element).append(`<option value="${row.AL_Ref_No}">${row.AL_Area_Desc}</option>`);
                        $(element2).append(`<option value="${row.AL_Ref_No}">${row.AL_Area_Desc}</option>`);
                    });
                }
            }
        });
    }

    function getcitylist(element, value, editValue=''){
        $.ajax({
            url: "<?= base_url('ReferenceMaintenance/getcitylist') ?>",
            type: "POST",
            data:JSON.stringify({areacode: value}),
            dataType: "JSON",
            success:(data)=>{
                if (data.length > 0) {
                    $(element).empty().append(`<option value="">Select a municipality</option>`);

                    data.forEach((row)=>{
                        $(element).append(`<option value="${row.CM_Ref_No}" ${editValue === row.CM_Ref_No ? 'selected' : ''}>${row.CM_City_Municipality_Name}</option>`);
                    });
                }
            }
        });
    }

    function getbrgylist(element, value, editValue=''){
        $.ajax({
            url: "<?= base_url('ReferenceMaintenance/getbrgylist') ?>",
            type: "POST",
            data:JSON.stringify({citycode: value}),
            dataType: "JSON",
            success:(data)=>{
                if (data.length > 0) {
                    $(element).empty().append(`<option value="">Select a brgy</option>`);

                    data.forEach((row)=>{
                        $(element).append(`<option value="${row.BL_Ref_No}" ${editValue === row.BL_Ref_No ? 'selected' : ''}>${row.BL_Barangay_Name}</option>`);
                    });
                }
            }
        });
    }

    function getbranchlist () {
        $.ajax({
            url: "<?= base_url('ReferenceMaintenance/getbranchlist') ?>",
            type: "GET",
            dataType: "JSON",
            success:(data)=> {
                $('#branch_table tbody').empty();
                data.forEach(row => { 
                    edit_action = `<a href="#!" class="Edit_btn btn btn-sm btn-link"

                                        data-CBL_Ref_No="${row.CBL_Ref_No}"
                                        data-CBL_CCL_Ref_No="${row.CBL_CCL_Ref_No}"
                                        data-CBL_Branch_Code="${row.CBL_Branch_Code}"
                                        data-CBL_Branch_Name="${row.CBL_Branch_Name}",
                                        data-CBL_Area="${row.CBL_Area}",
                                        data-CBL_Municipality="${row.CBL_Municipality}",
                                        data-CBL_Street_Brgy="${row.CBL_Street_Brgy}",

                                        data-type="branch"
                                    ><i class="fa-solid fa-pencil"></i></a>`;
                    if(row.CBL_Status=='Active'){
                        status_action = `<a data-refno="${row.CBL_Ref_No}" data-desc="${row.CBL_Branch_Name}" data-type="branch" href="#!" class="Delete_btn"><i class="fa-solid fa-xmark"></i></a>`;
                        status = `<span class="badge bg-success">${row.CBL_Status}</span>`;
                    }else{
                        status_action = `<a data-refno="${row.CBL_Ref_No}" data-desc="${row.CBL_Branch_Name}" data-type="branch" href="#!" class="Restore_btn"><i class="fa-solid fa-rotate-left"></i></a>`;
                        status = `<span class="badge bg-danger">${row.CBL_Status}</span>`;
                    }

                    tr = `  <tr> 
                                <td class="text-center">${edit_action} ${status_action}</td> 
                                <td class="text-center">${row.CCL_Company_Name}</td>
                                <td class="text-start">${row.CBL_Branch_Code}</td> 
                                <td class="text-center">${row.CBL_Branch_Name}</td> 
                                <td class="text-center">${status}</td>
                            </tr>`;

                    $('#branch_table tbody').append(tr); 
                });
            }
        });
    }

    $("#NewBranchForm").submit(function(e){
        e.preventDefault();

        b_company = $('#b_company').val();
        branch_code = $('#branch_code').val();
        branch_name = $('#branch_name').val();
        b_area = $("#area").val();
        b_city = $("#city").val();
        b_brgy = $("#brgy").val();

        if (confirm('Are you sure you want to submit?')) { 
            $("#submit_branch").prop('disabled', true);
            $.ajax({
                type: "POST",
                url:"<?= base_url('ReferenceMaintenance/addbranch')?>",
                data: 
                {
                    b_company: b_company,
                    branch_code: branch_code,
                    branch_name: branch_name,
                    b_area: b_area,
                    b_city: b_city,
                    b_brgy: b_brgy
                },
                dataType: "JSON",
                success:function(data){   
                    if (data.status === 'success') {
                        alert(data.message);
                        $('#NewBranchForm')[0].reset();
                        $("#add_branch_modal").modal('hide');
                        getbranchlist(); 
                    } else {
                        alert(data.message);
                        $("#submit_branch").prop('disabled', false);
                    }
                }
            });
        }

    });

    function PopulateBranch(){
        CBL_Ref_No = details[0];
        CBL_CCL_Ref_No = details[1];
        CBL_Branch_Code = details[2];
        CBL_Branch_Name = details[3];
        CBL_Area = details[4];
        CBL_Municipality = details[5];
        CBL_Street_Brgy = details[6];

        $('#CBL_Ref_No').val(CBL_Ref_No);
        $('#EditBranchCompany').val(CBL_CCL_Ref_No);
        $('#EditBranchCode').val(CBL_Branch_Code);
        $('#EditBranchName').val(CBL_Branch_Name);
        $('#edit_area').val(CBL_Area);
        getcitylist('#edit_city', CBL_Area, CBL_Municipality);
        getbrgylist('#edit_brgy', CBL_Municipality, CBL_Street_Brgy);

        $('#edit_branch_modal').modal('toggle');
    }

    $('#EditBranchForm').submit(function(e){
        e.preventDefault();

        CBL_Ref_No      = $('#CBL_Ref_No').val();
        company   = $('#EditBranchCompany').val();
        branch_code     = $('#EditBranchCode').val(); 
        branch_name    = $('#EditBranchName').val(); 
        area    = $('#edit_area').val();
        city    = $('#edit_city').val();
        brgy = $("#edit_brgy").val();

        if (confirm('Are you sure you want to submit?')) {  
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('ReferenceMaintenance/EditBranch');?>",
                data: 
                {
                    CBL_Ref_No: CBL_Ref_No,
                    company: company,
                    branch_code: branch_code,
                    branch_name: branch_name,
                    area: area,
                    city: city,
                    brgy: brgy
                },
                success:function(data){
                    $('#EditBranchForm')[0].reset();
                    $("#edit_branch_modal").modal('hide');
                    getbranchlist(); 
                }
            });
        }
    });
</script>