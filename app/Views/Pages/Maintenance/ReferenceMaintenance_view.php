<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 

<style>
    table{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
</style>


<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 " >
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
                <div  class="page-title d-flex flex-column justify-content-start flex-wrap me-3 ">
                    <div class="card">
                        <div class="card-body p-md-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-start my-0">
                               Reference Lists Maintenance
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button id="company_btn" value="company" type="button" class="refbtns btn-shadow btn btn-sm btn-primary">
                           <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                 <i class="fa-solid fa-building fa-w-20"></i>
                           </span>
                       Company
                    </button>

                    <button id="branch_btn" value="branch" type="button" class="refbtns btn-shadow btn btn-sm btn-primary">
                           <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                 <i class="fa-solid fa-building fa-w-20"></i>
                           </span>
                       Branch
                    </button>

                    <button id="dept_btn" value="dept" type="button" class="refbtns btn-shadow btn btn-sm btn-dark">
                           <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                 <i class="fa-solid fa-people-group fa-w-20"></i>
                           </span>
                       Department
                    </button>

                    <button id="pos_btn" value="pos" type="button" class="refbtns btn-shadow btn btn-sm btn-dark">
                           <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                 <i class="fa-solid fa-user-tie fa-w-20"></i>
                           </span>
                       Position
                    </button>

                    <button id="sec_btn" value="sec" type="button" class="refbtns btn-shadow btn btn-sm btn-dark">
                           <span class="btn-icon-wrapper pr-2 opacity-7">
                                 <i class="fa-solid fa-users-rectangle fa-w-20"></i>
                           </span>
                       Section
                    </button>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid " >
            <div id="kt_app_content_container" class="app-container container-fluid ">
                <div class="card ">
                    <div class="card-body p-0">
                        <br>
                        <div id="company_div" class="card-px text-start py-1 my-1">
                            <div class="text-end mb-5">
                                <button id="add_company_btn" value="company" type="button" class="btn-shadow btn btn-sm btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#add_company_modal">
                                    <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                            <i class="fa-solid fa-plus fa-w-20"></i>
                                    </span> Add Company
                                </button>
                            </div>
                            <div class="table-responsive">
                                <h2 class="text-center mb-5">Company List</h2>
                                <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="company_tbl">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Company Code</th>
                                            <th class="text-start">Company Name</th> 
                                            <th class="text-center">Cutoff</th> 
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div id="branch_div" class="card-px text-start py-1 my-1">
                            <div class="text-end mb-5">
                                <button id="add_branch_btn" value="branch" type="button" class="btn-shadow btn btn-sm btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#add_branch_modal">
                                    <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                            <i class="fa-solid fa-plus fa-w-20"></i>
                                    </span> Add Branch
                                </button>
                            </div>
                            <div class="table-responsive">
                                <h2 class="text-center mb-5">Branch List</h2>
                                <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="branch_table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Company Name</th>
                                            <th class="text-start">Branch Code</th> 
                                            <th class="text-center">Branch Name</th> 
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div id="dept_div" class="card-px text-start py-1 my-1">
                            <div class="text-end mb-5">
                                <button id="add_dept_btn" value="company" type="button" class="btn-shadow btn btn-sm btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#add_dept_modal">
                                    <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                            <i class="fa-solid fa-plus fa-w-20"></i>
                                    </span> Add Dept
                                </button> 
                            </div> 
                            <div class="table-responsive">
                                <h2 class="text-center mb-5">Department List</h2>
                                <div class="d-flex justify-content-end">
                                    <div class="col-sm-3 mb-5">
                                        <select class="form-control" name="CompanyFilter" id="CompanyFilter">
                                            <option value="All">- All Companies -</option>
                                        </select>
                                    </div>
                                </div>
                                <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="dept_tbl">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Dept Code</th>
                                            <th class="text-center">Dept Name</th> 
                                            <th class="text-start">Company Name</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div id="pos_div" class="card-px text-start py-1 my-1">
                            <div class="text-end mb-5">
                                <button id="add_pos_btn" value="position" type="button" class="btn-shadow btn btn-sm btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#add_pos_modal">
                                    <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                            <i class="fa-solid fa-plus fa-w-20"></i>
                                    </span> Add Position
                                </button> 
                            </div>
                            <div class="table-responsive"> 
                                <h2 class="text-center mb-5">Position List</h2>
                                <div class="d-flex justify-content-end">
                                    <div class="col-sm-3 mb-5">
                                        <select class="form-control" name="PDeptFilter" id="PDeptFilter">
                                            <option value="All">- All Department -</option>
                                        </select>
                                    </div>
                                </div>
                                <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="pos_tbl">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Dept Name</th>
                                            <th class="text-start">Position Name</th>
                                            <th class="text-center">Level</th> 
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="sec_div" class="card-px text-start py-1 my-1">
                            <div class="text-end mb-5">
                                <button id="add_sec_btn" value="section" type="button" class="btn-shadow btn btn-sm btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#add_sec_modal">
                                    <span class="btn-icon-wrapper pr-2 opacity-7"> 
                                            <i class="fa-solid fa-plus fa-w-20"></i>
                                    </span> Add Section
                                </button>
                            </div>
                            <div class="table-responsive"> 
                                <h2 class="text-center mb-5">Section List</h2>
                                <div class="d-flex justify-content-end">
                                    <div class="col-sm-3 mb-5">
                                        <select class="form-control" name="SDeptFilter" id="SDeptFilter">
                                            <option value="All">- All Department -</option>
                                        </select>
                                    </div>
                                </div>
                                <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="sec_tbl">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Dept Name</th>
                                            <th class="text-start">Section Name</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="add_company_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="NewCompanyForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddNewCompany">Add New Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="CompanyCode">Company Code:</label>
                                <input type="text" class="form-control" name="CompanyCode" id="CompanyCode" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="CompanyName">Company Name:</label>
                                <input type="text" class="form-control" name="CompanyName" id="CompanyName" required>
                            </div>
                        </div>
                    </div> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="Cutoff">Cutoff:</label> 
                            </div>
                        </div>  
                    </div> 
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="fw-bold" for="Cutoff">1st Cutoff:</label>
                                <select class="form-control calendardays" name="Cutoff1_From" id="Cutoff1_From" required>
                                    <option value="">- Select -</option>
                                </select>
                                <!-- <input type="date" class="form-control calendardays" name="Cutoff1_From" id="Cutoff1_From" required>  -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mt-6"> 
                                <select class="form-control calendardays" name="Cutoff1_To" id="Cutoff1_To" required>
                                    <option value="">- Select -</option>
                                </select>
                                <!-- <input type="date" class="form-control calendardays" name="Cutoff1_To" id="Cutoff1_To" required> -->
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="fw-bold" for="Cutoff">2nd Cutoff:</label>
                                <select class="form-control calendardays" name="Cutoff2_From" id="Cutoff2_From" required>
                                    <option value="">- Select -</option>
                                </select>
                                <!-- <input type="date" class="form-control calendardays" name="Cutoff2_From" id="Cutoff2_From" required>  -->
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group mt-6"> 
                                <select class="form-control calendardays" name="Cutoff2_To" id="Cutoff2_To" required>
                                    <option value="">- Select -</option>
                                </select>
                                <!-- <input type="date" class="form-control calendardays" name="Cutoff2_To" id="Cutoff2_To" required> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_company" type="submit" class="btn btn-sm btn-success">Submit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_branch_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="NewBranchForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddNewBranch">Add New Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="b_company">Company:</label>
                                <input type="hidden" id="CBL_Ref_No"> 
                                <select class="form-control" name="b_company" id="b_company" required>
                                    <option value="">Select a company</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="branch_code">Branch Code:</label>
                                <input type="text" class="form-control" oninput="this.value = this.value.toUpperCase();" name="branch_code" id="branch_code" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="branch_name">Branch Name:</label>
                                <input type="text" class="form-control" oninput="this.value = this.value.toUpperCase();" name="branch_name" id="branch_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="area">Area/Province :</label>
                                <select name="area" id="area" class="form-control" onchange="getcitylist('#city', this.value)" required>
                                    <option value="">Select Province</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="city">City/Municipality :</label>
                                <select name="city" id="city" class="form-control" onchange="getbrgylist('#brgy', this.value)" required>
                                    <option value="">Select province first</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="brgy">Street/Brgy:</label>
                                <select name="brgy" id="brgy" class="form-control" required>
                                    <option value="">Select city first</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_branch" type="submit" class="btn btn-sm btn-success">Submit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_branch_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="EditBranchForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditDept">Edit Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditBranchCompany">Company:</label>
                                <!-- <input type="text" class="form-control" name="DCompanyCode" id="DCompanyCode" required> -->
                                <input type="hidden" class="form-control" name="CBL_Ref_No" id="CBL_Ref_No"> 
                                <select class="form-control" name="EditBranchCompany" id="EditBranchCompany" required>
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditBranchCode">Branch Code:</label>
                                <input type="text" class="form-control" name="EditBranchCode" id="EditBranchCode" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditBranchName">Department Name:</label>
                                <input type="text" class="form-control" name="EditBranchName" id="EditBranchName" required>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="edit_area">Area/Province :</label>
                                <select name="edit_area" id="edit_area" class="form-control" onchange="getcitylist('#edit_city', this.value)" required>
                                    <option value="">Select Province</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="edit_city">City/Municipality :</label>
                                <select name="edit_city" id="edit_city" class="form-control" onchange="getbrgylist('#edit_brgy', this.value)" required>
                                    <option value="">Select province first</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="edit_brgy">Street/Brgy:</label>
                                <select name="edit_brgy" id="edit_brgy" class="form-control" required>
                                    <option value="">Select city first</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Edit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="add_dept_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="NewDeptForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddNewDept">Add New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="DCompanyCode">Company:</label>
                                <!-- <input type="text" class="form-control" name="DCompanyCode" id="DCompanyCode" required> -->
                                <select class="form-control" name="DCompanyCode" id="DCompanyCode" required>
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="DeptCode">Department Code:</label>
                                <input type="text" class="form-control" name="DeptCode" id="DeptCode" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="DeptName">Department Name:</label>
                                <input type="text" class="form-control" name="DeptName" id="DeptName" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_dept" type="submit" class="btn btn-sm btn-success">Submit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_pos_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="NewPosForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddNewPos">Add New Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="PDeptCode">Department:</label>
                                <select class="form-control" name="PDeptCode" id="PDeptCode" required>
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="PosName">Position Name:</label>
                                <input type="text" class="form-control" name="PosName" id="PosName" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="Level">Level:</label>
                                <!-- <input type="text" class="form-control" name="Level" id="Level" required> -->
                                <select class="form-control" name="Level" id="Level" required>
                                    <option value="">- Select -</option>
                                    <option value="Rank and File">Rank and File</option>
                                    <option value="Officer">Officer</option>
                                    <option value="Supervisory">Supervisory</option>
                                    <option value="Managerial">Managerial</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_pos" type="submit" class="btn btn-sm btn-success">Submit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_sec_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="NewSecForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddNewSec">Add New Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="SDeptCode">Department:</label>
                                <select class="form-control" name="SDeptCode" id="SDeptCode" required>
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="SecName">Section :</label>
                                <input type="text" class="form-control" name="SecName" id="SecName" required>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button id="submit_sec" type="submit" class="btn btn-sm btn-success">Submit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_company_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="EditCompanyForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditCompany">Edit Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditCompanyCode">Company Code:</label>
                                <input type="hidden" class="form-control" name="CCL_Ref_No" id="CCL_Ref_No">
                                <input type="text" class="form-control" name="EditCompanyCode" id="EditCompanyCode" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditCompanyName">Company Name:</label>
                                <input type="text" class="form-control" name="EditCompanyName" id="EditCompanyName" required>
                            </div>
                        </div>
                    </div> 
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="fw-bold" for="EditCutoff">1st Cutoff:</label>
                                <select class="form-control calendardays" name="EditCutoff1_From" id="EditCutoff1_From" required>
                                    <option value="">- Select -</option>
                                </select>
                                <!-- <input type="date" class="form-control calendardays" name="Cutoff1_From" id="Cutoff1_From" required>  -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mt-6"> 
                                <select class="form-control calendardays" name="EditCutoff1_To" id="EditCutoff1_To" required>
                                    <option value="">- Select -</option>
                                </select>
                                <!-- <input type="date" class="form-control calendardays" name="Cutoff1_To" id="Cutoff1_To" required> -->
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="fw-bold" for="Cutoff">2nd Cutoff:</label>
                                <select class="form-control calendardays" name="EditCutoff2_From" id="EditCutoff2_From" required>
                                    <option value="">- Select -</option>
                                </select>
                                <!-- <input type="date" class="form-control calendardays" name="Cutoff2_From" id="Cutoff2_From" required>  -->
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group mt-6"> 
                                <select class="form-control calendardays" name="EditCutoff2_To" id="EditCutoff2_To" required>
                                    <option value="">- Select -</option>
                                </select>
                                <!-- <input type="date" class="form-control calendardays" name="Cutoff2_To" id="Cutoff2_To" required> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Edit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_dept_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="EditDeptForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditDept">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditDCompanyCode">Company:</label>
                                <!-- <input type="text" class="form-control" name="DCompanyCode" id="DCompanyCode" required> -->
                                <input type="hidden" class="form-control" name="CDL_Ref_No" id="CDL_Ref_No"> 
                                <select class="form-control" name="EditDCompanyCode" id="EditDCompanyCode" required>
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditDeptCode">Department Code:</label>
                                <input type="text" class="form-control" name="EditDeptCode" id="EditDeptCode" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditDeptName">Department Name:</label>
                                <input type="text" class="form-control" name="EditDeptName" id="EditDeptName" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Edit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_pos_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="EditPosForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditPos">Edit Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditPDeptCode">Department:</label>
                                <input type="hidden" class="form-control" name="CPL_Ref_No" id="CPL_Ref_No">
                                <select class="form-control" name="EditPDeptCode" id="EditPDeptCode" required>
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditPosName">Position Name:</label>
                                <input type="text" class="form-control" name="EditPosName" id="EditPosName" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditLevel">Level:</label>
                                <!-- <input type="text" class="form-control" name="EditLevel" id="EditLevel" required> -->
                                <select class="form-control" name="EditLevel" id="EditLevel" required>
                                    <option value="">- Select -</option>
                                    <option value="Rank and File">Rank and File</option>
                                    <option value="Officer">Officer</option>
                                    <option value="Supervisory">Supervisory</option>
                                    <option value="Managerial">Managerial</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Edit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_sec_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="EditSecForm" action="#!" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditSec">Edit Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditSDeptCode">Department:</label>
                                <input type="hidden" class="form-control" name="CSL_Ref_No" id="CSL_Ref_No">
                                <select class="form-control" name="EditSDeptCode" id="EditSDeptCode" required>
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="EditSecName">Section Name:</label>
                                <input type="text" class="form-control" name="EditSecName" id="EditSecName" required>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Edit</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->include('core/footer')  ?>


<?= $this->include('scripts/ReferenceMaintenance_script')  ?> 
 