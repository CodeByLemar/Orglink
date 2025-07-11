
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/InventoryList_script')  ?>

<!--begin::Main-->
<style>
    th {
        font-size: 15px !important;
    }
</style>
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
                                Inventory Master List
                            </h1>
                        </div>
                    </div>
                    <!--center::Title-->
                </div>
                <!--center::Page title-->
            </div>
            <!--center::Toolbar container-->
        </div>
        <!--center::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-fluid ">
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
                                            <div class="text-end">
                                                <button data-bs-toggle="modal" data-bs-target="#add_item_modal" type="button" class="btn-sm btn btn-secondary"> <i class="fa fa-plus"></i> Add New Item </button>
                                                
                                                <button data-bs-toggle="modal" data-bs-target="#config_proc_modal" class="btn btn-sm btn-secondary"><i class="fa-solid fa-file-waveform"></i> Config Procedures</button>
                                                <!-- <button data-bs-toggle="modal" data-bs-target="#branch_inv_modal" class="btn btn-sm btn-secondary"><i class="fa-solid fa-warehouse"></i> Branch Inventory</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="d-flex flex-column mt-5">
                                    <!--begin::Number-->
                                    <hr>
                                    <span class="text-center fw-bold fs-2x text-gray-800 lh-1 ls-n2 mb-3">Inventory Master List</span>
                                    <hr>
                                    <!--center::Number-->
                                </div> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group table-responsive">
                                            <table id="itemmaster_tbl">
                                                <thead>
                                                    <tr>
                                                        <th class="fw-bold text-center">Product Code</th>
                                                        <th class="fw-bold text-center">Barcode</th>
                                                        <th class="fw-bold text-center">Description</th>
                                                        <th class="fw-bold text-center">Unit</th>  
                                                        <th class="fw-bold text-center">Cost</th>  
                                                        <th class="fw-bold text-center">Status</th>
                                                        <th class="fw-bold text-center">Action</th>
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
                <!--center::Row-->

            </div>
        </div>
        <form id="addnewitem" action="<?php echo base_url('Operations/addnewitem');?>" method="POST">
            <div class="modal fade" id="add_item_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="fw-bold" for="item_no">Product No:</label>
                                        <input type="text" class="form-control" name="item_no" id="item_no">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="fw-bold" for="item_desc">Description:</label>
                                        <input type="text" class="form-control" name="item_desc" id="item_desc">
                                    </div>
                                </div>
                            </div> 
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="fw-bold" for="item_unit">Unit:</label>
                                        <input type="text" class="form-control" name="item_unit" id="item_unit">
                                    </div>
                                </div> 
                            </div>   
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="fw-bold" for="item_cost">Cost:</label>
                                        <input type="text" class="form-control" name="item_cost" id="item_cost">
                                    </div>
                                </div> 
                            </div>   
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-success">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="config_proc_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Configure Procedure</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="procedure" class="fw-bold">Procedure:</label>
                                    <select name="procedure" id="procedure" class="form-control">
                                        <option value="">- Select -</option>
                                    </select>
                                </div>
                            </div>  
                        </div>
                        
                        <div class="row mt-5">
                            <hr>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h5>Procedure: <span id="procedure_label"></span></h5>
                                    <ul id="proc_ul"> 
                                    </ul>
                                    <!-- <table id="config_tbl">
                                        <thead>
                                            <tr>
                                                <th colspan="4" class="fw-bold text-center">Configuration Table</th>
                                            </tr>
                                            <tr>
                                                <th class="fw-bold text-center">Branch</th>
                                                <th class="fw-bold text-center">Barcode</th>
                                                <th class="fw-bold text-center">Product</th>
                                                <th class="fw-bold text-center">On Hand</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table> -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select class="form-control" name="additemproc" id="additemproc">
                                        <option value="">- Select Item -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <a id="additemproc_btn" href="#!" class="btn btn btn-success">Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="branch_inv_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Branch Inventory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="fw-bold text-center">Branch</th>
                                                <th class="fw-bold text-center">Product</th>
                                                <th class="fw-bold text-center">Qty On Hand</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-sm btn-success">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>

        <form id="edititem" action="<?php echo base_url('Procedures/edititem');?>" method="POST">
            <div class="modal fade" id="edititem_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit New Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="fw-bold" for="edit_item_no">Product No:</label>
                                        <input readonly type="text" class="form-control" name="edit_item_no" id="edit_item_no">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="fw-bold" for="edit_item_desc">Description:</label>
                                        <input required type="text" class="form-control" name="edit_item_desc" id="edit_item_desc">
                                    </div>
                                </div>
                            </div> 
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="fw-bold" for="edit_item_unit">Unit:</label>
                                        <input required type="text" class="form-control" name="edit_item_unit" id="edit_item_unit">
                                    </div>
                                </div> 
                            </div>   
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="fw-bold" for="edit_item_cost">Cost:</label>
                                        <input required type="number" class="form-control" name="edit_item_cost" id="edit_item_cost">
                                    </div>
                                </div> 
                            </div>   
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-success">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
 <?= $this->include('core/footer')  ?>


