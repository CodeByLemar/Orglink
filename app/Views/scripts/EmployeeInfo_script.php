<script>
    $(document).ready(function(){  
        $('#SearchEmpDiv').hide(); 
        $('#NewEmpInfo_div').hide(); 
        $('#ExistingEmpInfo_div').hide(); 
        
        getcompanylist(); 
        // Search Employee

        $("#SearchEmp").on("keyup", function () {
            let SearchString = $(this).val().toLowerCase();
            let resultsDiv = $("#searchResults");

            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Employee/SearchEmployee');?>", 
                data:{SearchString:SearchString},
                success:function(data){ 
                    data = JSON.parse(data);
                    resultsDiv.empty();
 
                    let employees = data.map(emp => ({
                        fullName: `${emp.CEL_Client_ID} - ${emp.CEL_First_Name} ${emp.CEL_Middle_Name} ${emp.CEL_Last_Name}`,
                        clientID: emp.CEL_Ref_No
                    }));

                    if (SearchString.length > 0) {
                        let filteredEmployees = employees.filter(emp => emp.fullName.toLowerCase().includes(SearchString.toLowerCase()));

                        if (filteredEmployees.length > 0) {
                            $.each(filteredEmployees, function (index, emp) { 

                                let item = $("<div>")
                                    .text(emp.fullName)
                                    .addClass("border-bottom p-2")
                                    .attr("data-client-id", emp.clientID);  

                                item.click(function () {
                                    $("#SearchEmp").val(emp.fullName);
                                    resultsDiv.hide();

                                    let CEL_Ref_No = $(this).attr("data-client-id");   
                                    $('#Client_Ref_No').val(CEL_Ref_No);
                                    getEmployeeDetails(CEL_Ref_No);

                                    //Personal Information
                                    getEmployeeAddress(CEL_Ref_No);
                                    getEmployeeRelatives(CEL_Ref_No);
                                    getEmployeeDependents(CEL_Ref_No);
                                    //Personal Information
                                    
                                    //Miscellaneous Information
                                    getEmployeeEducBackground(CEL_Ref_No);
                                    getEmployeeEmployment(CEL_Ref_No);
                                    getEmployeeCharReference(CEL_Ref_No);
                                    //Miscellaneous Information




                                });

                                resultsDiv.append(item);
                            });
                            resultsDiv.show();
                        } else {
                            resultsDiv.hide();
                        }
                    } else {
                        resultsDiv.hide();
                    }

                }
            });

            
        });
        // Search Employee

 
        $(document).on('click', '#submit_empInfo', function(){
            
            const dataInputs = getEmpInputValues();  
            var EmpType = $("input[name='EmpType']:checked").val();  
            console.log(dataInputs);
            if (!validateInputs(dataInputs)) {
                const AlertResult = {
                    'tittle': 'Opps',
                    'icon': 'warning',
                    'Message': 'Please Check All input'
                }; 
                Message_Result(AlertResult); 
            }else{
                if(EmpType=='New'){
                    $.ajax({
                        type: "POST",
                        url:"<?php echo base_url('Employee/addNewEmployee');?>", 
                        data:JSON.stringify(getEmpInputValues()),
                        success:function(data){
                            const AlertResult = {
                                'title': 'Success',
                                'icon': 'success',
                                'Message': 'Successfully Added'
                            }; 
                            Message_Result(AlertResult);
                        }
                    });
                }else{ 
                    $.ajax({
                        type: "POST",
                        url:"<?php echo base_url('Employee/EditEmployee');?>", 
                        data:JSON.stringify(getEmpInputValues()),
                        success:function(data){
                            const AlertResult = {
                                'title': 'Success',
                                'icon': 'success',
                                'Message': 'Successfully Added'
                            }; 
                            Message_Result(AlertResult);
                        }
                    });
                }
                
            }
        });

        function getEmpInputValues() {
            var EmpType = $("input[name='EmpType']:checked").val();  
 
            var commonFields = {
                EmpType: $("input[name='EmpType']:checked").val(),


                firstName: $('#firstName').val(),
                middleName: $('#middleName').val(),
                lastName: $('#lastName').val(),
                EmpStatus: $('#EmpStatus').val(),
                DateHired: $('#DateHired').val(),
                DateRegular: $('#DateRegular').val(),
                DateExpiry: $('#DateExpiry').val(),
                Rate: $('#Rate').val(),
                Allowance: $('#Allowance').val(),
                RateType: $('#RateType').val(),
                PayrollProcessing: $('#PayrollProcessing').val(),
                PayrollStatus: $('#PayrollStatus').val(),
                PremiumShare: $('#PremiumShare').val(),

                SSS: $('#SSS').val(),
                Philhealth: $('#Philhealth').val(),
                HDMFNo: $('#HDMFNo').val(),
                TIN: $('#TIN').val(),

                Bank: $('#Bank').val(),
                ATMNo: $('#ATMNo').val(),
                COLA: $('#COLA').val(),

                DateExpiry: $('#DateExpiry').val(),
                DateRegular: $('#DateRegular').val()
            }; 
            
            if (EmpType === 'New') {
                return Object.assign(commonFields, {
                    NewClientID: $('#NewClientID').val(),
                    NewCompanyDesc: $('#NewCompanyDesc').val(),
                    NewDepartmentDesc: $('#NewDepartmentDesc').val(),
                    NewSectionDesc: $('#NewSectionDesc').val(),
                    NewPositionDesc: $('#NewPositionDesc').val(),
                    NewBioClockId: $('#Newbioclock_id').val()
                });
            }else{
                return Object.assign(commonFields, {
                    ClientID: $('#ClientID').val(),
                    Client_Ref_No: $('#Client_Ref_No').val(),
                    BioClockId: $('#bioclock_id').val()
                });
            }

            return commonFields;
        }






        $(document).on('click', '#submit_MiscInfo', function(){
            
            const dataInputs = getMiscInputValues();   
        
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Employee/SubmitMiscInfo');?>", 
                data:JSON.stringify(getMiscInputValues()),
                success:function(data){
                    const AlertResult = {
                        'title': 'Success',
                        'icon': 'success',
                        'Message': 'Successfully Submitted'
                    }; 
                    Message_Result(AlertResult);
                }
            }); 
        });

        function getMiscInputValues() {
            // Employment
            var EmpCompany = $("input[name='EmpCompany[]']")
            .map(function() {
                return $(this).val();
            }).get(); 
            var EmpPosition = $("input[name='EmpPosition[]']")
            .map(function() {
                return $(this).val();
            }).get(); 
            var CompanyFrom = $("input[name='CompanyFrom[]']")
            .map(function() {
                return $(this).val();
            }).get(); 
            var CompanyTo = $("input[name='CompanyTo[]']")
            .map(function() {
                return $(this).val();
            }).get();
            // Employment
            
            //Character Reference
            var CharName = $("input[name='CharName[]']")
            .map(function() {
                return $(this).val();
            }).get(); 
            var CharPosition = $("input[name='CharPosition[]']")
            .map(function() {
                return $(this).val();
            }).get();
            var CharCompany = $("input[name='CharCompany[]']")
            .map(function() {
                return $(this).val();
            }).get();
            var CharContactNo = $("input[name='CharContactNo[]']")
            .map(function() {
                return $(this).val();
            }).get();
            //Character Reference

            var Fields = { 
                Client_Ref_No: $('#Client_Ref_No').val(),

                Primary_School: $('#Primary_School').val(),
                Primary_School_From: $('#Primary_School_From').val(),
                Primary_School_To: $('#Primary_School_To').val(),

                Secondary_School: $('#Secondary_School').val(),
                Secondary_School_From: $('#Secondary_School_From').val(),
                Secondary_School_To: $('#Secondary_School_To').val(),

                Tertiary_School: $('#Tertiary_School').val(),
                Tertiary_School_From: $('#Tertiary_School_From').val(),
                Tertiary_School_To: $('#Tertiary_School_To').val(),
                Tertiary_School_Degree: $('#Tertiary_School_Degree').val(),
                  
                EmpCompany: EmpCompany,
                EmpPosition: EmpPosition,
                CompanyFrom: CompanyFrom,
                CompanyTo: CompanyTo,

                CharName: CharName,
                CharPosition: CharPosition,
                CharCompany: CharCompany,
                CharContactNo: CharContactNo
                
            };  

            return Fields;
        }

        function validateInputs(inputs) {
            for (let key in inputs) {
                if (inputs[key] === '' || inputs[key] === undefined) {
                    return false;
                }
            }
            return true;
        }
        

        $(document).on('click', '#submit_PersonalInfo', function(){
            
            const dataInputs = getPersonalInputValues();   
            // if (!validateInputs(dataInputs)) {
            //     const AlertResult = {
            //         'tittle': 'Opps',
            //         'icon': 'warning',
            //         'Message': 'Please Check All input'
            //     }; 
            //     Message_Result(AlertResult); 
            // }else{
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('Employee/SubmitPersonalInfo');?>", 
                    data:JSON.stringify(getPersonalInputValues()),
                    success:function(data){
                        const AlertResult = {
                            'tittle': 'Success',
                            'icon': 'Success',
                            'Message': 'Successfully Submitted'
                        }; 
                        Message_Result(AlertResult);
                    }
                });
                
            // }
        });

        function getPersonalInputValues() {
            var dependentNames = $("input[name='DependentName[]']")
            .map(function() {
                return $(this).val();
            }).get();

            var DependentRelation = $("input[name='DependentRelation[]']")
            .map(function() {
                return $(this).val();
            }).get();

            var DependentBdates = $("input[name='DependentBdate[]']")
            .map(function() {
                return $(this).val();
            }).get();

            var Fields = { 
                Client_Ref_No: $('#Client_Ref_No').val(),

                Province: $('#Province').val(),
                City: $('#City').val(),
                Barangay: $('#Barangay').val(),
                Street: $('#Street').val(),
                ZIPCode: $('#ZIPCode').val(),
                
                BirthDate: $('#BirthDate').val(),
                Gender: $('#Gender').val(),
                CivilStatus: $('#CivilStatus').val(),
                EmailAdd: $('#EmailAdd').val(),
                EmpContactNo: $('#EmpContactNo').val(),
                Height: $('#Height').val(),
                Weight: $('#Weight').val(),
                Religion: $('#Religion').val(), 
                Citizenship: $('#Citizenship').val(),

                FatherName: $('#FatherName').val(),
                FatherBdate: $('#FatherBdate').val(),
                FatherOccupation: $('#FatherOccupation').val(), 

                MotherName: $('#MotherName').val(),
                MotherBdate: $('#MotherBdate').val(),
                MotherOccupation: $('#MotherOccupation').val(), 

                SpouseName: $('#SpouseName').val(),
                SpouseBdate: $('#SpouseBdate').val(),
                SpouseOccupation: $('#SpouseOccupation').val(), 
                
                ChildCount: $('#ChildCount').val(),
                
                DependentName: dependentNames,
                DependentRelation:DependentRelation,
                DependentBdate: DependentBdates
                
            };  

            return Fields;
        }

        $(document).on('click', '.EmpType', function() { 
            val = $(this).val();
            if(val=='Existing'){
                $('#SearchEmpDiv').show(); 
                $('#NewEmpInfo_div').hide(); 
                $('#ExistingEmpInfo_div').show(); 
            }else{
                $('#SearchEmpDiv').hide(); 
                $('#NewEmpInfo_div').show(); 
                $('#ExistingEmpInfo_div').hide(); 
            }
        });

        $(document).on('click', '#AddDependent', function() {  
            ctr = $('#DependentCtr').val();
            ctr++;
            var newRow = `  <tr>
                                <td>
                                    <input type="text" class="form-control" name="DependentName[]" id="DependentName${ctr}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="DependentRelation[]" id="DependentRelation${ctr}">
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="DependentBdate[]" id="DependentBdate${ctr}">
                                </td>
                                <td class="text-center"><a href="#!" data-type="Dependent" class="mt-1 remove btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>`;
            // $('#treatment_tbl').find('tbody').append(newRow); 
            $('#dependents_tbl tbody').append(newRow); 
            $('#DependentCtr').val(ctr);

        });


        $(document).on('click', '#AddEmp', function() {  
            ctr = $('#EmpCtr').val();
            ctr++;
            var newRow = `  <tr>
                                <td>
                                    <input class="form-control" type="text" name="Company[]" id="Company${ctr}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="Position[]" id="Position${ctr}">
                                </td>
                                <td>
                                    <input class="form-control" type="date" name="CompanyFrom[]" id="CompanyFrom${ctr}"> 
                                </td>
                                <td>
                                    <input class="form-control" type="date" name="CompanyTo[]" id="CompanyTo${ctr}"> 
                                </td>
                                <td class="text-center"><a href="#!" data-type="Emp" class="mt-1 remove btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>`;
            // $('#treatment_tbl').find('tbody').append(newRow); 
            $('#Emp_tbl tbody').append(newRow); 
            $('#EmpCtr').val(ctr);

        });

        $(document).on('click', '#AddChar', function() {  
            ctr = $('#CharCtr').val();
            ctr++;
            var newRow = `  <tr>
                                <td>
                                    <input class="form-control" type="text" name="Name[]" id="Name${ctr}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="Position[]" id="Position${ctr}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="Company[]" id="Company${ctr}"> 
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="ContactNo[]" id="ContactNo${ctr}"> 
                                </td>
                                <td class="text-center"><a href="#!" data-type="Char" class="mt-1 remove btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>`;
            // $('#treatment_tbl').find('tbody').append(newRow); 
            $('#Char_tbl tbody').append(newRow); 
            $('#CharCtr').val(ctr);

        });


        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
            
            type = $(this).data('type');

            if(type=='Emp'){
                ctr = $('#EmpCtr').val();
                ctr--;
                $('#EmpCtr').val(ctr);
            }else if(type=='Dependent'){
                ctr = $('#DependentCtr').val();
                ctr--;
                $('#DependentCtr').val(ctr);
            }else if(type=='Char'){
                ctr = $('#CharCtr').val();
                ctr--;
                $('#CharCtr').val(ctr);
            }
        }); 


        $(document).on('change', '#NewCompanyDesc', function() {
            NewCompanyDesc = $(this).val();
            getcompanydeptlist(NewCompanyDesc,'NewDepartmentDesc');

        });

        $(document).on('change', '#NewDepartmentDesc', function() {
            NewCompanyDesc = $(this).val();
            getdeptsectionlist(NewCompanyDesc,'NewSectionDesc');
            getdeptpositionlist(NewCompanyDesc,'NewPositionDesc');

        });

        $(document).on('change', '#NewPositionDesc', function() {
            level = $(this).find('option:selected').attr("data-level"); 
            $('#NewLevelDesc').val(level);
        });
        
        // Address Functions
        getProvinceList(''); 
        $('#Province').on('change',function(){ 
            getCityList($(this).val(),'');
        });

        $('#City').on('change',function(){
            getBrgyList($(this).val(),'');
        });
        // Address Functions

        $(document).on('change', '#NewCompany', function() {
            NewCompanyDesc = $(this).val();
            console.log(NewCompanyDesc)
            getcompanydeptlist(NewCompanyDesc,'NewDept');

        });

        $(document).on('change', '#NewDept', function() {
            NewDept = $(this).val();
            getdeptsectionlist(NewDept,'NewSection');
            getdeptpositionlist(NewDept,'NewPosition');

        });

        $(document).on('change', '#NewPositionDesc', function() {
            level = $(this).find('option:selected').attr("data-level"); 
            $('#NewLevelDesc').val(level);
        });
    });








    function getcompanylist(){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getcompanylist');?>",  
            success:function(data){ 
                data = JSON.parse(data);  
                $('#NewCompanyDesc').empty();   
                $('#NewCompanyDesc').append(`<option value="">- Select Company -</option>`);
                
                
                $('#NewCompany').empty();   
                $('#NewCompany').append(`<option value="">- Select Company -</option>`);
                data.forEach(row => {   
                    if(row.CCL_Status=='Active'){
                        option = `<option value="${row.CCL_Ref_No}">${row.CCL_Company_Name}</option>`;

                        $('#NewCompanyDesc').append(option);  

                        $('#NewCompany').append(option);  
                    } 
                    
                });
            }
        });
    }

    function getcompanydeptlist(val,field){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getcompanydeptlist');?>", 
            data:{
                val:val 
            },
            success:function(data){ 
                data = JSON.parse(data);  
                $('#'+field+'').empty();   
                $('#'+field+'').append(`<option value="">- Select Department -</option>`);
                
                data.forEach(row => {   
                    if(row.CDL_Status=='Active'){
                        option = `<option value="${row.CDL_Ref_No}">${row.CompanyName} - ${row.CDL_Dept_Name}</option>`;
                        $('#'+field+'').append(option);  
                    }
                    
                });
            }
        });
    }

    function getdeptsectionlist(val,field){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getdeptsectionlist');?>", 
            data:{
                val:val 
            },
            success:function(data){ 
                data = JSON.parse(data);  
                $('#'+field+'').empty();   
                $('#'+field+'').append(`<option value="">- Select Section -</option>`);
                $('#'+field+'').append(`<option value="NA">- No Section -</option>`);
                
                data.forEach(row => {   
                    if(row.CDL_Status=='Active'){
                        option = `<option value="${row.CSL_Ref_No}">${row.CSL_Section}</option>`;
                        $('#'+field+'').append(option);  
                    }
                    
                });
            }
        });
    }

    function getdeptpositionlist(val,field){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('ReferenceMaintenance/getdeptpositionlist');?>", 
            data:{
                val:val 
            },
            success:function(data){ 
                data = JSON.parse(data);  
                $('#'+field+'').empty();   
                $('#'+field+'').append(`<option value="">- Select Position -</option>`);
                
                data.forEach(row => {   
                    if(row.CPL_Status=='Active'){
                        option = `<option data-level="${row.CPL_Level}" value="${row.CPL_Ref_No}">${row.CPL_Position_Name}</option>`;
                        $('#'+field+'').append(option);  
                    }
                    
                });
            }
        });
    }

    function getEmployeeDetails(CEL_Ref_No){ 
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getEmployeeDetails');?>",  
            data:{CEL_Ref_No:CEL_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);   
                populateEmpInfo(data);
            }
        });
    }

    function getEmployeeAddress(CEL_Ref_No){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getEmployeeAddress');?>",  
            data:{CEL_Ref_No:CEL_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);  
                populateEmpAddress(data); 
            }
        });
    }

    function populateEmpAddress(data){ 
        $('#Street').val(data[0].CAL_Street);
        $('#ZIPCode').val(data[0].CAL_Zip_Code);
        getProvinceList(data[0].CAL_Province);
        getCityList(data[0].CAL_Province,data[0].CAL_City);
        getBrgyList(data[0].CAL_City,data[0].CAL_Brgy);

    }

    function getEmployeeRelatives(CEL_Ref_No){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getEmployeeRelatives');?>",  
            data:{CEL_Ref_No:CEL_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);
                populateEmpRelatives(data); 
            }
        });
    }

    function populateEmpRelatives(data){
        $('#FatherName').empty();
        $('#FatherBdate').empty();
        $('#FatherOccupation').empty();
        
        $('#MotherName').empty();
        $('#MotherBdate').empty();
        $('#MotherOccupation').empty();

        $('#SpouseName').empty();
        $('#SpouseBdate').empty();
        $('#SpouseOccupation').empty();
        
        data.forEach(row => {
            if(row.CRL_Relation=='Father'){ 
                $('#FatherName').val(row.CRL_Name);
                $('#FatherBdate').val(row.CRL_Birth_Date);
                $('#FatherOccupation').val(row.CRL_Occupation);
            }

            if(row.CRL_Relation=='Mother'){ 
                $('#MotherName').val(row.CRL_Name);
                $('#MotherBdate').val(row.CRL_Birth_Date);
                $('#MotherOccupation').val(row.CRL_Occupation);
            }

            if(row.CRL_Relation=='Spouse'){ 
                $('#SpouseName').val(row.CRL_Name);
                $('#SpouseBdate').val(row.CRL_Birth_Date);
                $('#SpouseOccupation').val(row.CRL_Occupation);
            }
        });
        
    }

    function getEmployeeDependents(CEL_Ref_No){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getEmployeeDependents');?>",  
            data:{CEL_Ref_No:CEL_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);   
                populateEmpDependents(data); 
            }
        });
    }

    function populateEmpDependents(data){
        if(data.length!=0){
            ctr=0;
            $('#dependents_tbl tbody').empty();
            $('#DependentCtr').val((data.length-1));
            data.forEach(row => {   
                var newRow = `  <tr>
                                    <td>
                                        <input type="text" class="form-control" name="DependentName[]" id="DependentName${ctr}" value="${row.CDL_Name}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="DependentRelation[]" id="DependentRelation${ctr}" value="${row.CDL_Relationship}">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="DependentBdate[]" id="DependentBdate${ctr}" value="${row.CDL_Birth_Date}">
                                    </td>
                                    <td class="text-center"><a href="#!" data-type="Dependent" class="mt-1 remove btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                                </tr>`;  
                $('#dependents_tbl tbody').append(newRow); 
                ctr++;
            });
        }
        
    }

    function getEmployeeEducBackground(CEL_Ref_No){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getEmployeeEducBackground');?>",  
            data:{CEL_Ref_No:CEL_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);   
                populateEmpEducBackground(data); 
            }
        });
    }

    function populateEmpEducBackground(data){
        $('#Primary_School').empty();
        $('#Primary_School_From').empty();
        $('#Primary_School_To').empty();
        
        $('#Secondary_School').empty();
        $('#Secondary_School_From').empty();
        $('#Secondary_School_To').empty();
        
        $('#Tertiary_School').empty();
        $('#Tertiary_School_Degree').empty(); 
        $('#Tertiary_School_From').empty();
        $('#Tertiary_School_To').empty(); 
        
        data.forEach(row => {
            if(row.CEA_Level=='Primary'){ 
                $('#Primary_School').val(row.CEA_School);
                $('#Primary_School_From').val(row.CEA_From);
                $('#Primary_School_To').val(row.CEA_To);
            }

            if(row.CEA_Level=='Secondary'){ 
                $('#Secondary_School').val(row.CEA_School);
                $('#Secondary_School_From').val(row.CEA_From);
                $('#Secondary_School_To').val(row.CEA_To);
            }

            if(row.CEA_Level=='Tertiary'){ 
                $('#Tertiary_School').val(row.CEA_School);
                $('#Tertiary_School_Degree').val(row.CEA_Degree); 
                $('#Tertiary_School_From').val(row.CEA_From);
                $('#Tertiary_School_To').val(row.CEA_To); 
            }
        });
    }
    
    function getEmployeeEmployment(CEL_Ref_No){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getEmployeeEmployment');?>",  
            data:{CEL_Ref_No:CEL_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);   
                populateEmpEmployment(data); 
            }
        });
    }

    function populateEmpEmployment(data){
        if(data.length!=0){
            ctr=0;
            $('#Emp_tbl tbody').empty();
            $('#EmpCtr').val((data.length-1));
            data.forEach(row => {   
                var newRow = `  <tr>
                                    <td>
                                        <input class="form-control" type="text" name="EmpCompany[]" id="EmpCompany${ctr}" value="${row.CEMP_Company_Name}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="EmpPosition[]" id="EmpPosition${ctr}" value="${row.CEMP_Position}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="date" name="CompanyFrom[]" id="CompanyFrom${ctr}" value="${row.CEMP_From}"> 
                                    </td>
                                    <td>
                                        <input class="form-control" type="date" name="CompanyTo[]" id="CompanyTo${ctr}" value="${row.CEMP_To}"> 
                                    </td>
                                </tr>`;  
                $('#Emp_tbl tbody').append(newRow); 
                ctr++;
            });
        }
    }

    function getEmployeeCharReference(CEL_Ref_No){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getEmployeeCharReference');?>",  
            data:{CEL_Ref_No:CEL_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);   
                populateEmpCharReference(data); 
            }
        });
    }

    function populateEmpCharReference(data){
        if(data.length!=0){
            ctr=0;
            $('#Char_tbl tbody').empty();
            $('#CharCtr').val((data.length-1));
            data.forEach(row => {   
                var newRow = `  <tr>
                                    <td>
                                        <input class="form-control" type="text" name="CharName[]" id="CharName${ctr}" value="${row.CCR_Name}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="CharPosition[]" id="CharPosition${ctr}" value="${row.CCR_Position}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="CharCompany[]" id="CharCompany${ctr}" value="${row.CCR_Company}"> 
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" name="CharContactNo[]" id="CharContactNo${ctr}" value="${row.CCR_Contact_No}"> 
                                    </td>
                                </tr>`;  
                $('#Char_tbl tbody').append(newRow); 
                ctr++;
            });
        }
    }
    

    function getProvinceList(val){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getProvinceList');?>",   
            success:function(data){ 
                data = JSON.parse(data);    
                $('#Province').empty();   
                $('#Province').append(`<option value="">- Select Province -</option>`);
                
                data.forEach(row => {   
                    // if(row.CCL_Status=='Active'){
                        option = `<option value="${row.AL_Ref_No}">${row.AL_Area_Desc}</option>`;
                        $('#Province').append(option);  

                    // }  
                });

                val && $('#Province').val(val);

            }
        });
    }

    function getCityList(AL_Ref_No,val){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getCityList');?>",   
            data:{AL_Ref_No:AL_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);    
                $('#City').empty();   
                $('#City').append(`<option value="">- Select City -</option>`);
                
                data.forEach(row => {   
                    // if(row.CCL_Status=='Active'){
                        option = `<option value="${row.CM_Ref_No}">${row.CM_City_Municipality_Name}</option>`;
                        $('#City').append(option);  
                    // }  
                });
 
                val && $('#City').val(val);
            }
        });
    }

    function getBrgyList(CM_Ref_No,val){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url('Employee/getBrgyList');?>",   
            data:{CM_Ref_No:CM_Ref_No},
            success:function(data){ 
                data = JSON.parse(data);    
                $('#Barangay').empty();   
                $('#Barangay').append(`<option value="">- Select Barangay -</option>`);
                
                data.forEach(row => {   
                    // if(row.CCL_Status=='Active'){
                        option = `<option value="${row.BL_Ref_No}">${row.BL_Barangay_Name}</option>`;
                        $('#Barangay').append(option);  
                    // }  
                });

                val && $('#Barangay').val(val);
            }
        });
    }

    function populateEmpInfo(data){

        $('#firstName').empty();
        $('#middleName').empty();
        $('#lastName').empty(); 
        // $('#PayrollProcessing').empty();
        // $('#PayrollStatus').empty(); 
        $('#ClientID').empty();
        // $('#EmpStatus').empty();
        $('#Rate').empty();
        $('#Allowance').empty();
        
        // $('#PremiumShare').empty();

        $('#SSS').empty();
        $('#Philhealth').empty();
        $('#HDMFNo').empty();
        $('#TIN').empty(); 
        
        $('#Bank').empty(); 
        $('#ATMNo').empty(); 
        $('#COLA').empty();  
        
        $('#CompanyDesc').empty();
        $('#DepartmentDesc').empty();
        $('#SectionDesc').empty();
        $('#PositionDesc').empty();
        $('#LevelDesc').empty();

        $('#DateExpiry').empty();
        $('#DateHired').empty();
        $('#DateRegular').empty();
        
        $('#firstName').val(data[0].CEL_First_Name);
        $('#middleName').val(data[0].CEL_Middle_Name);
        $('#lastName').val(data[0].CEL_Last_Name); 
        $('#PayrollProcessing').val(data[0].CEL_Payroll_Processing);
        $('#PayrollStatus').val(data[0].CEL_Payroll_Status);
        $('#ClientID').val(data[0].CEL_Client_ID); 
        $('#EmpStatus').val(data[0].CEL_Emp_Status);
        
        $('#Rate').val(data[0].CEL_Basic_Rate);
        $('#Allowance').val(data[0].CEL_Allowance);
        $('#RateType').val(data[0].CEL_Rate_Type);
        $('#PremiumShare').val(data[0].CEL_Premium_Share);

        $('#SSS').val(data[0].CEL_SSS);
        $('#Philhealth').val(data[0].CEL_Philhealth);
        $('#HDMFNo').val(data[0].CEL_Pagibig);
        $('#TIN').val(data[0].CEL_TIN);
        
        $('#Bank').val(data[0].CEL_Bank);
        $('#ATMNo').val(data[0].CEL_Account_No);
        $('#COLA').val(data[0].CEL_COLA);

        $('#CompanyDesc').val(data[0].Company);
        $('#DepartmentDesc').val(data[0].Dept);
        $('#SectionDesc').val(data[0].Section);
        $('#PositionDesc').val(data[0].Position);
        $('#LevelDesc').val(data[0].Level); 
        $('#DateExpiry').val(data[0].CEL_Contract_End_Date);
        $('#DateHired').val(data[0].DateHired);
        $('#DateRegular').val(data[0].CEL_Regularization_Date);

        $('#BirthDate').empty(); 
        $('#EmailAdd').empty();
        $('#EmpContactNo').empty();
        $('#Height').empty();
        $('#Weight').empty();
        $('#Religion').empty();
        $('#Citizenship').empty();

        $('#BirthDate').val(data[0].CEL_Birth_Date);
        $('#Gender').val(data[0].CEL_Gender);
        $('#CivilStatus').val(data[0].CEL_Civil_Status);
        $('#EmailAdd').val(data[0].CEL_Email);
        $('#EmpContactNo').val(data[0].CEL_Contact_No);
        $('#Height').val(data[0].CEL_Height);
        $('#Weight').val(data[0].CEL_Weight);
        $('#Religion').val(data[0].CEL_Religion);
        $('#Citizenship').val(data[0].CEL_Citizenship);

        // Populate Change Info
        $('#curCompany').val(data[0].Company);
        $('#curDept').val(data[0].Dept); 
        $('#curSection').val(data[0].Section ? data[0].Section : '- No Section -');
        $('#curPosition').val(data[0].Position);
        // Populate Change Info

    }

    
    $(document).on('click', '#submit_company', function() {

        CEL_Ref_No = $('#Client_Ref_No').val();

        NewCompany  = $('#NewCompany').val();
        NewDept     = $('#NewDept').val();
        NewSection  = $('#NewSection').val();
        NewPosition = $('#NewPosition').val();
        
        if(NewCompany && NewDept && NewPosition){
            $.ajax({
                type: "POST",
                url:"<?php echo base_url('Employee/ChangeEmpDetails');?>", 
                data:{
                    CEL_Ref_No:CEL_Ref_No,
                    NewCompany:NewCompany,
                    NewDept:NewDept,
                    NewSection:NewSection,
                    NewPosition:NewPosition
                },
                success:function(data){ 
                    var AlertResult = {
                        'title': 'Success',
                        'icon': 'success',
                        'Message': 'Successfully Changed'
                    }; 
                    Message_Result(AlertResult);
                    
                    getEmployeeDetails(CEL_Ref_No);

                    //Personal Information
                    getEmployeeAddress(CEL_Ref_No);
                    getEmployeeRelatives(CEL_Ref_No);
                    getEmployeeDependents(CEL_Ref_No);
                    //Personal Information
                    
                    //Miscellaneous Information
                    getEmployeeEducBackground(CEL_Ref_No);
                    getEmployeeEmployment(CEL_Ref_No);
                    getEmployeeCharReference(CEL_Ref_No);
                    //Miscellaneous Information
                    
                }
            });
        }else{
            var AlertResult = {
                'title' : 'Please select Company, Department and Position',
                'icon'   : 'warning' ,
                'Message': 'Please select Company, Department and Position'
            };
            Message_Result(AlertResult)
        }
        
    });
</script>