
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>
<?= $this->include('scripts/EmployeeInfo_script')  ?>

<style> 
    .search-results {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        display: none;
        background: white;
    }
    .search-results div {
        padding: 5px;
        cursor: pointer;
    }
    .search-results div:hover {
        background-color: #f0f0f0;
    }

    .DependentsTr {
        background-color: lightblue;
        font-weight: bold;
        padding-left: 5px;
        padding-right: 5px;
    }

    .HeaderFill{
        background-color: #2a9bc0 !important;
        color: white !important;
        font-weight: bold;
        padding: 5px;
    }
</style>

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
                <!--begin::Page title-->
                <div  class="page-title d-flex flex-column justify-content-start flex-wrap me-3 ">
                    <!--begin::Title-->
                    <div class="card">
                        <div class="card-body p-sm-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-start my-0">
                                Employee
                            </h1>
                        </div>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row gy-5 g-xl-9">
                    <!--begin::Col-->
                    <div class="col-sm-6 col-xl-12 mb-xl-10">
                        <!--begin::Card widget 2-->
                        <div class="card h-lg-100 shadow-lg">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between flex-column">
                                <!--begin::Section--> 
                                <div class="d-flex flex-column">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <h1>Employee Information</h1>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-check mb-5">
                                                    <input type="radio" class="EmpType form-check-input" id="NewEmployee" name="EmpType" value="New">New Employee 
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="EmpType form-check-input" id="ExistingEmployee" name="EmpType" value="Existing">Existing Employee 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="SearchEmpDiv" class="row mt-5">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="SearchEmp" class="fw-bold">Search Employee: </label>
                                                <input class="form-control" type="text" name="SearchEmp" id="SearchEmp"> 
                                                <div id="searchResults" class="search-results mt-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <img class="img-fluid" src="<?php echo base_url();?>assets/images/EmpDefault.png" alt="">
                                            </div>
                                        </div>
                                        <div class="col-sm-10">  
                                            <div class="row mt-5">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label class="fw-bold" for="EmpID">Upload ID Picture:</label>
                                                        <input type="file" name="EmpID" id="EmpID" class="form-control">
                                                        <input type="hidden" name="Client_Ref_No" id="Client_Ref_No">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="fw-bold" for="firstName">First Name: </label>
                                                        <input class="form-control" name="firstName" id="firstName" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="fw-bold" for="middleName">Middle Name: </label>
                                                        <input class="form-control" name="middleName" id="middleName" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="fw-bold" for="lastName">Last Name: </label>
                                                        <input class="form-control" name="lastName" id="lastName" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-12">
                                            <ul class="nav nav-tabs" id="employeeTabs">
                                                <li class="nav-item">
                                                    <a class="fw-bold nav-link active" data-bs-toggle="tab" href="#employeeInfo">Employee Info</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="fw-bold nav-link" data-bs-toggle="tab" href="#personalInfo">Personal Info</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="fw-bold nav-link " data-bs-toggle="tab" href="#miscInfo">Miscellaneous Info</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-3">
                                                <div class="tab-pane fade show active" id="employeeInfo">
                                                    <h5 class="HeaderFill text-center">Employee Information</h5>

                                                    <div id="NewEmpInfo_div"> 
                                                        <div class="row mt-5">
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="NewClientID">Client Employee ID Number:</label>
                                                                <input type="text" class="form-control" name="NewClientID" id="NewClientID">
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="Newbioclock_id">BioClock ID Number:</label>
                                                                <input type="text" class="form-control" name="Newbioclock_id" id="Newbioclock_id">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="NewCompanyDesc">Company:</label>
                                                                <select name="NewCompanyDesc" id="NewCompanyDesc" class="form-control">
                                                                    <option value="">- Select -</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="NewDepartmentDesc">Department:</label>
                                                                <select name="NewDepartmentDesc" id="NewDepartmentDesc" class="form-control">
                                                                    <option value="">- Select Company First -</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="NewSectionDesc">Section:</label>
                                                                <select name="NewSectionDesc" id="NewSectionDesc" class="form-control">
                                                                    <option value="">- Select Department First -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="NewPositionDesc">Job Position:</label>
                                                                <select name="NewPositionDesc" id="NewPositionDesc" class="form-control">
                                                                    <option value="">- Select Department First -</option>
                                                                </select>
                                                            </div> 
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="NewLevelDesc">Job Level:</label>
                                                                <input readonly type="text" class="form-control" name="NewLevelDesc" id="NewLevelDesc">
                                                            </div>
                                                        </div>    
                                                    </div>

                                                    <div id="ExistingEmpInfo_div">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="text-end">
                                                                    <a id="change_info" href="#!" data-bs-toggle="modal" data-bs-target="#changeinfo_modal" class="btn btn-sm btn-success"><i class="fa-solid fa-file-pen"></i> Change Info</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="ClientID">Client Employee ID Number:</label>
                                                                <input type="text" class="form-control" name="ClientID" id="ClientID">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="bioclock_id">BioClock ID Number:</label>
                                                                <input type="text" class="form-control" name="bioclock_id" id="bioclock_id">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="CompanyDesc">Company:</label>
                                                                <input readonly type="text" class="form-control" name="CompanyDesc" id="CompanyDesc">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="DepartmentDesc">Department:</label>
                                                                <input readonly type="text" class="form-control" name="DepartmentDesc" id="DepartmentDesc">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="SectionDesc">Section:</label>
                                                                <input readonly type="text" class="form-control" name="SectionDesc" id="SectionDesc">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="PositionDesc">Job Position:</label>
                                                                <input readonly type="text" class="form-control" name="PositionDesc" id="PositionDesc">
                                                            </div> 
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-sm-4">
                                                                <label class="fw-bold" for="LevelDesc">Job Level:</label>
                                                                <input readonly type="text" class="form-control" name="LevelDesc" id="LevelDesc">
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="row mt-5">
                                                        <div class="col-sm-12">
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="EmpStatus">Employment Status:</label>
                                                            <!-- <input type="text" class="form-control" name="EmpStatus" id="EmpStatus"> -->
                                                            <select class="form-control" name="EmpStatus" id="EmpStatus">
                                                                <option value="Probationary">Probationary</option>
                                                                <option value="Project-Based">Project-Based</option>
                                                                <option value="Regular">Regular</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="DateHired">Date Hired:</label>
                                                            <input type="date" class="form-control" name="DateHired" id="DateHired">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="DateRegular">Date of Regularization:</label>
                                                            <input type="date" class="form-control" name="DateRegular" id="DateRegular">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="DateExpiry">Contract Expiry Date:</label>
                                                            <input type="date" class="form-control" name="DateExpiry" id="DateExpiry">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="Rate">Basic Rate:</label>
                                                            <input type="number" class="form-control" name="Rate" id="Rate">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="Allowance">Allowance:</label>
                                                            <input type="number" class="form-control" name="Allowance" id="Allowance">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="RateType">Rate Type:</label>
                                                            <!-- <input type="text" class="form-control" name="RateType" id="RateType"> -->
                                                            <select name="RateType" id="RateType" class="form-control">
                                                                <option value="Monthly">Monthly</option>
                                                                <option value="Daily">Daily</option>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="PayrollProcessing">Payroll Processing:</label>
                                                            <!-- <input type="text" class="form-control" name="PayrollProcessing" id="PayrollProcessing"> -->
                                                            <select name="PayrollProcessing" id="PayrollProcessing" class="form-control">
                                                                <option value="Semi-monthly">Semi-monthly</option>
                                                                <option value="Weekly">Weekly</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="PayrollStatus">Payroll Status:</label>
                                                            <!-- <input type="text" class="form-control" name="PayrollStatus" id="PayrollStatus"> -->
                                                            <select name="PayrollStatus" id="PayrollStatus" class="form-control">
                                                                <option value="Active">Active</option>
                                                                <option value="Inactive">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="PremiumShare">Premium Share:</label>
                                                            <!-- <input type="text" class="form-control" name="PremiumShare" id="PremiumShare"> -->
                                                            <select name="PremiumShare" id="PremiumShare" class="form-control">
                                                                <option value="Individual">Individual</option> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-12">
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="SSS">SSS No.:</label>
                                                            <input type="text" class="form-control" name="SSS" id="SSS">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="Philhealth">Philhealth No.:</label>
                                                            <input type="text" class="form-control" name="Philhealth" id="Philhealth">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="HDMFNo">HDMF No.:</label>
                                                            <input type="text" class="form-control" name="HDMFNo" id="HDMFNo">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="HDMFContribution">HDMF Contribution:</label>
                                                            <input readonly type="text" class="form-control" name="HDMFContribution" id="HDMFContribution">
                                                        </div>
                                                    </div> -->
                                                    <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="TIN">Tax ID No.:</label>
                                                            <input type="text" class="form-control" name="TIN" id="TIN">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-12">
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="Bank">Bank:</label>
                                                            <input type="text" class="form-control" name="Bank" id="Bank">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="ATMNo">ATM Account No.:</label>
                                                            <input type="text" class="form-control" name="ATMNo" id="ATMNo">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5"> 
                                                        <div class="col-sm-4">
                                                            <label class="fw-bold" for="COLA">Cost of Living Allowance (COLA):</label>
                                                            <input type="number" class="form-control" name="COLA" id="COLA" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-center">
                                                                <button id="submit_empInfo" class="btn btn-success"><i class="fa-solid fa-paper-plane"></i> Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="personalInfo">
                                                    <h5 class="HeaderFill text-center">Personal Information</h5>
                                                    <div class="row mt-5">
                                                        <!-- <div class="col-sm-12">
                                                            <label class="fw-bold" for="Address">Address:</label>
                                                            <input readonly type="text" class="form-control" name="Address" id="Address">
                                                        </div>  -->
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="Province">Province:</label>
                                                            <!-- <input readonly type="text" class="form-control" name="Province" id="Province"> -->
                                                            <select class="form-control" name="Province" id="Province">
                                                                <option value="">- Select Province-</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="City">City:</label>
                                                            <!-- <input readonly type="text" class="form-control" name="City" id="City"> -->
                                                            <select class="form-control" name="City" id="City">
                                                                <option value="">- Select Province First-</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="Barangay">Barangay:</label>
                                                            <!-- <input readonly type="text" class="form-control" name="Barangay" id="Barangay"> -->
                                                            <select class="form-control" name="Barangay" id="Barangay">
                                                                <option value="">- Select City -</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="Street">Street:</label>
                                                            <input type="text" class="form-control" name="Street" id="Street">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="ZIPCode">ZIP Code:</label>
                                                            <input type="number" class="form-control" name="ZIPCode" id="ZIPCode">
                                                        </div> 
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="BirthDate">Birth Date:</label>
                                                            <input type="date" class="form-control" name="BirthDate" id="BirthDate">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="Gender">Gender:</label>
                                                            <!-- <input readonly type="text" class="form-control" name="Gender" id="Gender"> -->
                                                            <select required class="form-control" name="Gender" id="Gender">
                                                                <option value="">- Select -</option>
                                                                <option value="MALE">MALE</option>
                                                                <option value="FEMALE">FEMALE</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="CivilStatus">Civil Status:</label>
                                                            <!-- <input readonly type="text" class="form-control" name="CivilStatus" id="CivilStatus"> -->
                                                            <select required class="form-control" name="CivilStatus" id="CivilStatus">
                                                                <option value="">- Select -</option>
                                                                <option value="SINGLE">SINGLE</option>
                                                                <option value="MARRIED">MARRIED</option>
                                                                <option value="WIDOWED">WIDOWED</option>
                                                                <option value="DIVORCED">DIVORCED</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="EmailAdd">E-mail Address:</label>
                                                            <input required type="email" class="form-control" name="EmailAdd" id="EmailAdd">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="EmpContactNo">Contact No.:</label>
                                                            <input required type="number" class="form-control" name="EmpContactNo" id="EmpContactNo">
                                                        </div> 
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="Height">Height (Ft):</label>
                                                            <input type="text" class="form-control" name="Height" id="Height">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="Weight">Weight (Kg):</label>
                                                            <input type="text" class="form-control" name="Weight" id="Weight">
                                                        </div> 
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="Religion">Religion:</label>
                                                            <input type="text" class="form-control" name="Religion" id="Religion">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="Citizenship">Citizenship:</label>
                                                            <input type="text" class="form-control" name="Citizenship" id="Citizenship">
                                                        </div> 
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-12">
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="FatherName">Father's Name:</label>
                                                            <input  type="text" class="form-control" name="FatherName" id="FatherName">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="FatherBdate">Birth Date:</label>
                                                            <input  type="date" class="form-control" name="FatherBdate" id="FatherBdate">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="FatherOccupation">Occupation:</label>
                                                            <input  type="text" class="form-control" name="FatherOccupation" id="FatherOccupation">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="MotherName">Mother's Name:</label>
                                                            <input  type="text" class="form-control" name="MotherName" id="MotherName">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="MotherBdate">Birth Date:</label>
                                                            <input  type="date" class="form-control" name="MotherBdate" id="MotherBdate">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="MotherOccupation">Occupation:</label>
                                                            <input  type="text" class="form-control" name="MotherOccupation" id="MotherOccupation">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="SpouseName">Spouse's Name:</label>
                                                            <input  type="text" class="form-control" name="SpouseName" id="SpouseName">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="SpouseBdate">Birth Date:</label>
                                                            <input  type="date" class="form-control" name="SpouseBdate" id="SpouseBdate">
                                                        </div> 
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="SpouseOccupation">Occupation:</label>
                                                            <input  type="text" class="form-control" name="SpouseOccupation" id="SpouseOccupation">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <label class="fw-bold" for="ChildCount">No. of Children:</label>
                                                            <input type="number" class="form-control" name="ChildCount" id="ChildCount" value="0">
                                                        </div>  
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-12">
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-8"> 
                                                            <input type="hidden" id="DependentCtr" value="0">
                                                            <table id="dependents_tbl" class="table table-striped mb-5">
                                                                <thead>
                                                                    <tr class="HeaderFill">
                                                                        <th class="ps-5 fw-bold">Dependent/s</th>
                                                                        <th class="ps-5 fw-bold">Relation</th>
                                                                        <th class="ps-5 fw-bold">Birth Date</th>
                                                                        <th class="text-center fw-bold">Delete</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="text" class="form-control" name="DependentName[]" id="DependentName0">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" name="DependentRelation[]" id="DependentRelation0">
                                                                        </td>
                                                                        <td>
                                                                            <input type="date" class="form-control" name="DependentBdate[]" id="DependentBdate0">
                                                                        </td>
                                                                        <td>

                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <a id="AddDependent" href="#!" class="btn btn-danger btn-sm"><i class="fa-solid fa-plus"></i> Add More</a>
                                                        </div>  
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-center">
                                                                <button id="submit_PersonalInfo" class="btn btn-success"><i class="fa-solid fa-paper-plane"></i> Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="miscInfo">
                                                    <h5 class="HeaderFill text-center">Miscellaneous Information</h5>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                               <h3>Primary Education</h3> 
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Primary_School" class="fw-bold">School/University:</label>
                                                                <input class="form-control" type="text" name="Primary_School" id="Primary_School">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Primary_School_Degree" class="fw-bold">Degree:</label>
                                                                <input class="form-control" type="text" name="Primary_School_Degree" id="Primary_School_Degree">
                                                            </div>
                                                        </div> -->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Primary_School_From" class="fw-bold">From:</label>
                                                                <input class="form-control" type="date" name="Primary_School_From" id="Primary_School_From">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Primary_School_To" class="fw-bold">To:</label>
                                                                <input class="form-control" type="date" name="Primary_School_To" id="Primary_School_To">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-8">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                               <h3>Secondary Education</h3> 
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Secondary_School" class="fw-bold">School/University:</label>
                                                                <input class="form-control" type="text" name="Secondary_School" id="Secondary_School">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Primary_School_Degree" class="fw-bold">Degree:</label>
                                                                <input class="form-control" type="text" name="Primary_School_Degree" id="Primary_School_Degree">
                                                            </div>
                                                        </div> -->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Secondary_School_From" class="fw-bold">From:</label>
                                                                <input class="form-control" type="date" name="Secondary_School_From" id="Secondary_School_From">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Secondary_School_To" class="fw-bold">To:</label>
                                                                <input class="form-control" type="date" name="Secondary_School_To" id="Secondary_School_To">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-8">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                               <h3>Tertiary Education</h3> 
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Tertiary_School" class="fw-bold">School/University:</label>
                                                                <input class="form-control" type="text" name="Tertiary_School" id="Tertiary_School">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Tertiary_School_Degree" class="fw-bold">Degree:</label>
                                                                <input class="form-control" type="text" name="Tertiary_School_Degree" id="Tertiary_School_Degree">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Tertiary_School_From" class="fw-bold">From:</label>
                                                                <input class="form-control" type="date" name="Tertiary_School_From" id="Tertiary_School_From">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Tertiary_School_To" class="fw-bold">To:</label>
                                                                <input class="form-control" type="date" name="Tertiary_School_To" id="Tertiary_School_To">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row mt-5">
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <label for="Other_Trainings" class="fw-bold">Other Trainings:</label>
                                                                <input type="text" class="form-control" name="Other_Trainings" id="Other_Trainings">
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="row mt-8">
                                                        <div class="col-sm-12">
                                                            <div class="form-group"> 
                                                               <hr>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row mt-8">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                               <h3>Employment History</h3>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <input type="hidden" id="EmpCtr" value="0">
                                                            <table id="Emp_tbl" class="table table-striped mb-5">
                                                                <thead>
                                                                    <tr class="HeaderFill">
                                                                        <th class="ps-5 fw-bold">Company</th>
                                                                        <th class="ps-5 fw-bold">Position</th>
                                                                        <th class="ps-5 fw-bold">From</th>
                                                                        <th class="ps-5 fw-bold">To</th>
                                                                        <th class="text-center fw-bold">Delete</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <input class="form-control" type="text" name="EmpCompany[]" id="EmpCompany0">
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" type="text" name="EmpPosition[]" id="EmpPosition0">
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" type="date" name="CompanyFrom[]" id="CompanyFrom0"> 
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" type="date" name="CompanyTo[]" id="CompanyTo0"> 
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <a id="AddEmp" href="#!" class="btn btn-danger btn-sm"><i class="fa-solid fa-plus"></i> Add More</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-8">
                                                        <div class="col-sm-12">
                                                            <div class="form-group"> 
                                                               <hr>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row mt-8">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                               <h3>Character Reference</h3>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <input type="hidden" id="CharCtr" value="0">
                                                            <table id="Char_tbl" class="table table-striped mb-5">
                                                                <thead>
                                                                    <tr class="HeaderFill">
                                                                        <th class="ps-5 fw-bold">Name</th>
                                                                        <th class="ps-5 fw-bold">Position</th>
                                                                        <th class="ps-5 fw-bold">Company</th>
                                                                        <th class="ps-5 fw-bold">Contact No.</th>
                                                                        <th class="text-center fw-bold">Delete</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <input class="form-control" type="text" name="CharName[]" id="CharName0">
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" type="text" name="CharPosition[]" id="CharPosition0">
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" type="text" name="CharCompany[]" id="CharCompany0"> 
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" type="number" name="CharContactNo[]" id="CharContactNo0"> 
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <a id="AddChar" href="#!" class="btn btn-danger btn-sm"><i class="fa-solid fa-plus"></i> Add More</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-center">
                                                                <button id="submit_MiscInfo" class="btn btn-success"><i class="fa-solid fa-paper-plane"></i> Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row mt-5">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="Character_Reference" class="fw-bold">Character Reference:</label>
                                                                <input class="form-control" type="text" name="Character_Reference" id="Character_Reference">
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="row mt-5">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="Skills" class="fw-bold">Skills:</label>
                                                                <input class="form-control" type="text" name="Skills" id="Skills">
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="changeinfo_modal" tabindex="-1" aria-labelledby="changeinfo_modal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form id="NewCompanyForm" action="#!" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ChangeInfo_label">Change Employment Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"> 
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <h6 class="HeaderFill">Current Information</h6> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label for="curCompany" class="fw-bold">Company:</label>
                                                <input readonly class="form-control" name="curCompany" id="curCompany" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label for="curDept" class="fw-bold">Department:</label>
                                                <input readonly class="form-control" name="curDept" id="curDept" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label for="curSection" class="fw-bold">Section:</label>
                                                <input readonly class="form-control" name="curSection" id="curSection" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label for="curPosition" class="fw-bold">Job Position:</label>
                                                <input readonly class="form-control" name="curPosition" id="curPosition" type="text">
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="form-group">
                                                <h6 class="HeaderFill">New Information</h6> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="form-group">
                                                <label for="NewCompany" class="fw-bold">Company:</label>
                                                <select name="NewCompany" id="NewCompany" class="form-control">
                                                    <option value="">- Select Company -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="form-group">
                                                <label for="NewDept" class="fw-bold">Department:</label>
                                                <select name="NewDept" id="NewDept" class="form-control">
                                                    <option value="">- Select Company First -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="form-group">
                                                <label for="NewSection" class="fw-bold">Section:</label>
                                                <select name="NewSection" id="NewSection" class="form-control">
                                                    <option value="">- No Section -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="form-group">
                                                <label for="NewPosition" class="fw-bold">Job Position:</label>
                                                <select name="NewPosition" id="NewPosition" class="form-control">
                                                    <option value="">- Select Department First -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button id="submit_company" type="button" class="btn btn-sm btn-success">Submit</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
 <?= $this->include('core/footer')  ?>


