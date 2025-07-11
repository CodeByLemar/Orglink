
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/gov_contribution_script')  ?>

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
                                Payroll Summary
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
                                                </div>
                                                <div class="text-end">
                                                    <a href="#!" id="filter_modal_btn" title="Filter Data" data-bs-toggle="modal"  data-bs-target="#filter_modal">
                                                        <div class="btn btn-icon btn-custom btn-icon-dark w-30px h-30px w-md-40px h-md-40px hover-bg-gray">
                                                            <i class="ki-duotone ki-filter-search fs-3x"><span class="path1"></span><span class="path2"></span></i>
                                                        </div>
                                                    </a>  
                                                </div> 
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="timelogsdiv row mt-5"> 
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
                                            <table id="Gov_Dues_Tbl" class="table table-striped"> 
                                            </table>
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
                <a id="download_timelogs_template" class="btn btn-sm btn-info" href="<?php base_url();?>/assets/templates/Timelogs_Upload_Template.csv" download>Download Template</a>
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
                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="filterby" class="fw-bold">Filter By : </label>
                            <select name="filterby" id="filterby" class="form-control">
                                <option value="">- Select -</option>
                                <option value="SSS">SSS Loan</option>
                                <option value="Philhealth">Philhealth</option>
                                <option value="HDMF">HDMF</option>
                            </select>  
                        </div>
                    </div> -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="imonth_year" class="fw-bold">Month Year : </label>
                            <select name="imonth_year" id="imonth_year" class="form-control">
                                <option value="">- Select -</option> 
                            </select> 
                            <input type="hidden" id="imonth" name="imonth">
                            <input type="hidden" id="iyear" name="iyear">
                        </div>
                    </div> 
                </div> 
            </div> 
            <div class="modal-footer"> 
                <a id="GenerateFilterGovConSummary" href="#!" class="btn btn-success">Generate</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div> 
        </div>
    </div>
</div>