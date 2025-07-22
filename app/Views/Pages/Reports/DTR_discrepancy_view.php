
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/dispute_script')  ?>

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
    
    #disputes_tbl {
        font-size: 10px !important;
        border: 2px solid black;
        border-collapse: collapse; /* Ensures borders merge properly */
    }

    #disputes_tbl th, 
    #disputes_tbl td {
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
                                DTR DISCREPANCY SUMMARY
                            </h1>
                        </div>
                    </div>
                    <!--center::Title-->
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
                                    <div class="timelogsdiv row mt-5">
                                        <div class="col-sm-12"  >
                                            <h4 class="text-center">DTR DISCREPANCY SUMMARY LIST</h4>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mb-10">
                                                <div class="form-group mb-3">
                                                    <a id="upload_dispute" href="#!" class="btn btn-sm btn-danger dt-button"><i class="fa-solid fa-upload"></i> Upload DTR</a>
                                                </div>
                                            </div>
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
                                            <table id="disputes_tbl" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="thead_gray"></th>
                                                        <th class="thead_gray text-center fw-bold" style="min-width: 100px;">Company</th>
                                                        <th class="thead_gray text-center fw-bold" style="min-width: 90px;">Date From</th>
                                                        <th class="thead_gray text-center fw-bold" style="min-width: 90px;">Date To</th>
                                                        <th class="thead_gray text-center fw-bold" style="min-width: 90px;">Employee No.</th>
                                                        <th class="thead_gray text-center fw-bold" style="min-width: 130px;">Full Name</th>
                                                        <th class="thead_gray text-center fw-bold" style="min-width: 150px;">Position</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">Working Hrs</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">Leave Hrs</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">OT</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">RDOT</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">Regular Hol OT</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">Special Hol OT</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">OT8</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">NPOT</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">NP</th>
                                                        <th class="thead_orange text-center fw-bold" style="min-width: 90px;">NP8</th>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="dispute_model">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Upload Discrepancy</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="form-group">
                     <label for="timelog" class="fw-bold">Upload Discrepancy (EXCEL): </label>
                     <input type="file" class="form-control" name="dtr" id="dtr"> 
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer"> 
            <a id="upload_dtr" href="#!" class="btn btn-sm btn-success">Upload</a>
            <a id="download_timelogs_template" class="btn btn-sm btn-info" href="<?php base_url();?>/assets/templates/Upload_Discrepancy_Template.xlsx" download>Download Template</a>
            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>