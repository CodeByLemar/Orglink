
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/Timekeeping_script')  ?>

<style>  
    table, th, td {
        border: 2px solid black;
    }
    
    #TimeLogs_tbl {
        font-size: 10px !important;
        border: 2px solid black;
        border-collapse: collapse; /* Ensures borders merge properly */
    }

    #TimeLogs_tbl th, 
    #TimeLogs_tbl td {
        border: 1px solid black; /* Adds borders to table cells */
        padding: 4px; /* Adjust padding for better spacing */
    }

    #selected_logs_tbl {
        font-size: 10px !important;
        border: 2px solid black;
        border-collapse: collapse; /* Ensures borders merge properly */
   }

    #selected_logs_tbl th, 
    #selected_logs_tbl td {
        border: 1px solid black; /* Adds borders to table cells */
        padding: 4px; /* Adjust padding for better spacing */
    }

    #ProcessedTimeLogs_tbl {
        font-size: 10px !important;
        border: 2px solid black;
        border-collapse: collapse; /* Ensures borders merge properly */
    }

    #ProcessedTimeLogs_tbl th, 
    #ProcessedTimeLogs_tbl td {
        border: 1px solid black; /* Adds borders to table cells */
        padding: 4px; /* Adjust padding for better spacing */
    }

    .table-wrapper {
        height: 400px;       /* desired fixed height */
        overflow-y: auto;    /* enable vertical scrolling */
        overflow-x: auto;    /* optional: enable horizontal scrolling */
    }

    table.dataTable {
        width: 100% !important;
    }
    
    .hover-bg-gray:hover {
        background-color: #e0e0e0; /* or any gray tone you prefer */
    }


    .thead_blue {
        background-color: #00eaff !important;
        position: sticky; 
        top: 0;
        z-index: 1;
    }

    .thead_gray {
        background-color: #dfdfdf !important;
        position: sticky; 
        top: 0; 
        z-index: 1;
    }

    .thead_orange {
        background-color: #f2ba2b !important;
        position: sticky; 
        top: 0; 
        z-index: 1;
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
                                Timekeeping
                            </h1>
                        </div>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div> 
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
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="text-start">
                                                    <h1>Process Time Logs</h1>
                                                </div>
                                                <div class="text-end">
                                                    <a href="#!" id="upload_modal_btn" title="Upload Timelogs" data-bs-toggle="modal" data-bs-target="#upload_modal">
                                                        <div class="btn btn-icon btn-custom btn-icon-dark w-30px h-30px w-md-40px h-md-40px hover-bg-gray">
                                                            <i class="ki-duotone ki-folder-up fs-3x"><span class="path1"></span><span class="path2"></span></i>
                                                        </div> 
                                                    </a> 
                                                    <a href="#!" id="filter_modal_btn" title="Filter Data" data-bs-toggle="modal"  data-bs-target="#filter_modal">
                                                        <div class="btn btn-icon btn-custom btn-icon-dark w-30px h-30px w-md-40px h-md-40px hover-bg-gray">
                                                            <i class="ki-duotone ki-filter-search fs-3x"><span class="path1"></span><span class="path2"></span></i>
                                                        </div>
                                                    </a>  

                                                    <a href="#" id="validate_logs" class="btn btn-primary font-weight-bold mr-2">
                                                        <i class="flaticon2-check-mark"></i> Validate Selected Logs
                                                    </a>
                                                </div> 
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- <div class="timelogsdiv row mt-5">
                                        <div class="col-sm-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th class="fw-bold ps-5">Employee Name:</th>
                                                        <td>Jayvee T. Javier <i style="color:red;">(Sample Data)</i></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fw-bold ps-5">Employee ID:</th>
                                                        <td>EMP-HO-001 <i style="color:red;">(Sample Data)</i></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fw-bold ps-5">Date:</th>
                                                        <td>March 29,2025 <i style="color:red;">(Sample Data)</i></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fw-bold ps-5">Cut Off Period:</th>
                                                        <td>March 16,2025 - March 31,2025 <i style="color:red;">(Sample Data)</i></td>
                                                    </tr> 
                                                    <tr>
                                                        <th class="fw-bold ps-5">Monthly Rate:</th>
                                                        <td>15,000.00 <i style="color:red;">(Sample Data)</i></td>
                                                    </tr> 
                                                    <tr>
                                                        <th class="fw-bold ps-5">Hourly Rate:</th>
                                                        <td>71.00 <i style="color:red;">(Sample Data)</i></td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>  -->
                                    <div class="timelogsdiv row mt-5">
                                        <div class="col-sm-12"  >
                                            <h4 class="text-center">Uploaded Data</h4>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 mb-10">
                                                <div class="form-group mb-3">
                                                    <!-- <label for="icompanycode" class="fw-bold">Company Code</label> -->
                                                    <input type="hidden" class="form-control" name="icompanycode" id="icompanycode" value="EO">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <!-- <label for="idatefrom" class="fw-bold">Date From</label> -->
                                                    <input type="hidden" class="form-control" name="idatefrom" id="idatefrom" value="2025-02-01">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <!-- <label for="idateto" class="fw-bold">Date To</label> -->
                                                    <input type="hidden" class="form-control" name="idateto" id="idateto" value="2025-02-15">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 table-responsive table-wrapper">
                                            <table id="TimeLogs_tbl" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="18"></th>
                                                        <th colspan="8" class="thead_blue text-center fw-bold">RWD (Regular OT)</th>
                                                        <th colspan="8" class="thead_blue text-center fw-bold">RD (Rest day OT)</th>
                                                        <!-- <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;" colspan="5" class="text-center fw-bold">ROT</th> -->
                                                        <th colspan="8" class="thead_blue text-center fw-bold">RHNR</th>
                                                        <th colspan="8" class="thead_blue text-center fw-bold">RHRD</th>
                                                        <th colspan="8" class="thead_blue text-center fw-bold">SHNR (Special Hol OT)</th>
                                                        <th colspan="8" class="thead_blue text-center fw-bold">SHRD (Special Hol OT-RD)</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="thead_gray text-center fw-bold ps-5">No.</th>
                                                        <th class="thead_gray text-center fw-bold">Company</th>
                                                        <th class="thead_gray text-center fw-bold">Date From</th>
                                                        <th class="thead_gray text-center fw-bold">Date To</th>
                                                        <th class="thead_gray text-center fw-bold">Employee No.</th> 
                                                        <th class="thead_gray text-center fw-bold">Employee Name</th>
                                                        <th class="thead_gray text-center fw-bold">Position</th>
                                                        <th class="thead_gray text-center fw-bold">Department</th>
                                                        <th class="thead_gray text-center fw-bold">Late</th>
                                                        <th class="thead_gray text-center fw-bold">Under</th> 
                                                        <th class="thead_gray text-center fw-bold">Abs</th>
                                                        <th class="thead_gray text-center fw-bold">LHrs</th>
                                                        <th class="thead_gray text-center fw-bold">WHrs</th>
                                                        <th class="thead_gray text-center fw-bold">NP</th> 
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">OverBreak</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Total Overbreak</i></th>  

                                                        <th class="thead_gray text-center fw-bold">Ovt</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">Ovt8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">NP</th> 
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <th class="thead_gray text-center fw-bold">NP8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <!-- <th class="text-center fw-bold">NPOT</th> -->

                                                        <th class="thead_gray text-center fw-bold">Ovt</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">Ovt8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">NP</th> 
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <th class="thead_gray text-center fw-bold">NP8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <!-- <th class="text-center fw-bold">NPOT</th> -->

                                                        <th class="thead_gray text-center fw-bold">Ovt</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">Ovt8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">NP</th> 
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <th class="thead_gray text-center fw-bold">NP8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <!-- <th class="text-center fw-bold">NPOT</th> -->

                                                        <th class="thead_gray text-center fw-bold">Ovt</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">Ovt8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">NP</th> 
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <th class="thead_gray text-center fw-bold">NP8</th>
                                                        <th class="thead_orangetext-center fw-bold"><i>Amount</i></th> 
                                                        <!-- <th class="text-center fw-bold">NPOT</th> -->

                                                        <th class="thead_gray text-center fw-bold">Ovt</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">Ovt8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">NP</th> 
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <th class="thead_gray text-center fw-bold">NP8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <!-- <th class="text-center fw-bold">NPOT</th> -->

                                                        <th class="thead_gray text-center fw-bold">Ovt</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">Ovt8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                                        <th class="thead_gray text-center fw-bold">NP</th> 
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <th class="thead_gray text-center fw-bold">NP8</th>
                                                        <th class="thead_orange text-center fw-bold"><i>Amount</i></th> 
                                                        <!-- <th class="text-center fw-bold">NPOT</th> -->

                                                        <!-- <th class="text-center fw-bold">Ovt</th>
                                                        <th class="text-center fw-bold">Ovt8</th>
                                                        <th class="text-center fw-bold">NP</th>
                                                        <th class="text-center fw-bold">NP8</th> -->
                                                        <!-- <th class="text-center fw-bold">NPOT</th> -->
                                                        
                                                        <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;color:red;" class="text-center fw-bold">Remarks</th> 
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                </tbody>
                                                <tfoot></tfoot>
                                            </table>
                                        </div>
                                        <!-- <div class="col-sm-12 mt-20">
                                            <h4 class="text-center">Final Computation from Validated DTR</h4>
                                            <hr>
                                        </div>
                                        <div class="col-sm-12 table-responsive table-wrapper">
                                            <table id="ProcessedTimeLogs_tbl" class="table table-striped display nowrap" style="width:100%">
                                            <thead>
                                                    <tr>
                                                        <th colspan="15"> <i class="fw-bold">(In Minutes)</i></th>
                                                        <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;" colspan="5" class="text-center fw-bold">RWD (Regular OT)</th>
                                                        <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;" colspan="5" class="text-center fw-bold">RD (Rest day OT)</th>
                                                        <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;" colspan="5" class="text-center fw-bold">ROT</th>
                                                        <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;" colspan="5" class="text-center fw-bold">RHNR</th>
                                                        <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;" colspan="5" class="text-center fw-bold">RHRD</th>
                                                        <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;" colspan="5" class="text-center fw-bold">SHNR (Special Hol OT)</th>
                                                        <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;" colspan="5" class="text-center fw-bold">SHRD (Special Hol OT-RD)</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center fw-bold ps-5">No.</th>
                                                        <th class="text-center fw-bold">Company</th>
                                                        <th class="text-center fw-bold">Date From</th>
                                                        <th class="text-center fw-bold">Date To</th>
                                                        <th class="text-center fw-bold">Employee No.</th>

                                                        <th class="text-center fw-bold">Employee Name</th>
                                                        <th class="text-center fw-bold">Position</th>
                                                        <th class="text-center fw-bold">Department</th>
                                                        <th class="text-center fw-bold">Late</th>
                                                        <th class="text-center fw-bold">Under</th>

                                                        <th class="text-center fw-bold">Abs</th>
                                                        <th class="text-center fw-bold">LHrs</th>
                                                        <th style="background-color:#b7e487;position: sticky; top: 0; z-index: 1;" class="text-center fw-bold">WHrs</th> 
                                                        <th class="text-center fw-bold">OvrBreak</th>
                                                        <th class="text-center fw-bold">NP</th>

                                                        <th class="text-center fw-bold">Ovt</th>
                                                        <th class="text-center fw-bold">Ovt8</th>
                                                        <th class="text-center fw-bold">NP</th>
                                                        <th class="text-center fw-bold">NP8</th>
                                                        <th class="text-center fw-bold">NPOT</th>

                                                        <th class="text-center fw-bold">Ovt</th>
                                                        <th class="text-center fw-bold">Ovt8</th>
                                                        <th class="text-center fw-bold">NP</th>
                                                        <th class="text-center fw-bold">NP8</th>
                                                        <th class="text-center fw-bold">NPOT</th>

                                                        <th class="text-center fw-bold">Ovt</th>
                                                        <th class="text-center fw-bold">Ovt8</th>
                                                        <th class="text-center fw-bold">NP</th>
                                                        <th class="text-center fw-bold">NP8</th>
                                                        <th class="text-center fw-bold">NPOT</th>

                                                        <th class="text-center fw-bold">Ovt</th>
                                                        <th class="text-center fw-bold">Ovt8</th>
                                                        <th class="text-center fw-bold">NP</th>
                                                        <th class="text-center fw-bold">NP8</th>
                                                        <th class="text-center fw-bold">NPOT</th>

                                                        <th class="text-center fw-bold">Ovt</th>
                                                        <th class="text-center fw-bold">Ovt8</th>
                                                        <th class="text-center fw-bold">NP</th>
                                                        <th class="text-center fw-bold">NP8</th>
                                                        <th class="text-center fw-bold">NPOT</th>

                                                        <th class="text-center fw-bold">Ovt</th>
                                                        <th class="text-center fw-bold">Ovt8</th>
                                                        <th class="text-center fw-bold">NP</th>
                                                        <th class="text-center fw-bold">NP8</th>
                                                        <th class="text-center fw-bold">NPOT</th>

                                                        <th class="text-center fw-bold">Ovt</th>
                                                        <th class="text-center fw-bold">Ovt8</th>
                                                        <th class="text-center fw-bold">NP</th>
                                                        <th class="text-center fw-bold">NP8</th>
                                                        <th class="text-center fw-bold">NPOT</th>
                                                        
                                                        <th style="background-color:#00eaff;color:red;position: sticky; top: 0; z-index: 1;" class="text-center fw-bold">Remarks</th> 
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                </tbody>
                                                <tfoot></tfoot>
                                            </table>
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
 
<div class="modal fade" id="upload_modal">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <h4 class="modal-title">Upload Timelog</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> 
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="timelog" class="fw-bold">Upload Time Logs (CSV): </label>
                            <input type="file" class="form-control" name="timelog" id="timelog"> 
                        </div>
                    </div>
                </div>
            </div> 
            <div class="modal-footer"> 
                <a id="uploadlogs" href="#!" class="btn btn-sm btn-success">Upload</a>
                <a id="download_timelogs_template" class="btn btn-sm btn-info" href="<?php base_url();?>/assets/templates/TimekeepingTemplate.xlsx" download>Download Template</a>
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
            </div> 
        </div>
    </div>
</div>
 
<div class="modal fade" id="filter_modal">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <h4 class="modal-title">Filter Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> 
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="iCompany" class="fw-bold">Company : </label>
                            <select name="iCompany" id="iCompany" class="form-control">
                                <option value="">- Select -</option>
                                <option value="EO">Executive Optical</option>
                            </select>
                                
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="PayrollPeriod" class="fw-bold">Payroll Period : </label>
                            <select name="PayrollPeriod" id="PayrollPeriod" class="form-control">
                                <option value="">- Select -</option> 
                            </select> 
                            <input type="hidden" id="ifrom" name="ifrom">
                            <input type="hidden" id="ito" name="ito">
                        </div>
                    </div> 
                </div> 
            </div> 
            <div class="modal-footer"> 
                <a id="GeneratePayroll" href="#!" class="btn btn-success">Generate</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div> 
        </div>
    </div>
</div>

<div class="modal fade" id="validate_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="EditDept">Confirm Selected Logs</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row mt-3">
                  <div class="col-lg-12">
                     <div class="col-sm-12 table-responsive table-wrapper">
                        <table id="selected_logs_tbl" class="table table-striped">
                           <thead>
                              <tr>
                                 <th colspan="17"></th>
                                 <th colspan="8" class="thead_blue text-center fw-bold">RWD (Regular OT)</th>
                                 <th colspan="8" class="thead_blue text-center fw-bold">RD (Rest day OT)</th>
                                 <th colspan="8" class="thead_blue text-center fw-bold">RHNR</th>
                                 <th colspan="8" class="thead_blue text-center fw-bold">RHRD</th>
                                 <th colspan="8" class="thead_blue text-center fw-bold">SHNR (Special Hol OT)</th>
                                 <th colspan="8" class="thead_blue text-center fw-bold">SHRD (Special Hol OT-RD)</th>
                                 <th></th>
                              </tr>
                              <tr>
                                 <th class="thead_gray text-center fw-bold ps-5">No.</th>
                                 <th class="thead_gray text-center fw-bold">Company</th>
                                 <th class="thead_gray text-center fw-bold">Date From</th>
                                 <th class="thead_gray text-center fw-bold">Date To</th>
                                 <th class="thead_gray text-center fw-bold">Employee No.</th>
                                 <th class="thead_gray text-center fw-bold">Employee Name</th>
                                 <th class="thead_gray text-center fw-bold">Position</th>
                                 <th class="thead_gray text-center fw-bold">Department</th>
                                 <th class="thead_gray text-center fw-bold">Late</th>
                                 <th class="thead_gray text-center fw-bold">Under</th>
                                 <th class="thead_gray text-center fw-bold">Abs</th>
                                 <th class="thead_gray text-center fw-bold">LHrs</th>
                                 <th class="thead_gray text-center fw-bold">WHrs</th>
                                 <th class="thead_gray text-center fw-bold">NP</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">OverBreak</th>
                                 <th class="thead_orange text-center fw-bold"><i>Total Overbreak</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP8</th>
                                 <th class="thead_orangetext-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">Ovt8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>
                                 <th class="thead_gray text-center fw-bold">NP8</th>
                                 <th class="thead_orange text-center fw-bold"><i>Amount</i></th>

                                 <th style="background-color:#00eaff;position: sticky; top: 0; z-index: 1;color:red;" class="text-center fw-bold">Remarks</th>
                              </tr>
                           </thead>
                           <tbody> 
                           </tbody>
                           <tfoot></tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="references">
               <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" id="confirm_validate_logs" class="btn btn-sm btn-success">Validate logs</button>
               <button type="submit" id="hold_payroll" class="btn btn-sm btn-danger">Pay Hold</button>
            </div>
      </div>
   </div>
</div>