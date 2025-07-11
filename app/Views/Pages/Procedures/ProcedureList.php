
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/ProcedureList_script')  ?>

<!--begin::Main-->
<style>
    th {
        font-size: 13px !important;
    }

    td{
        font-size:12px !important;
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
                                Procedure List
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
                                                <button data-bs-toggle="modal" data-bs-target="#add_pro_modal" type="button" class="btn-shadow btn btn-sm btn-primary">
                                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i class="fa fa-plus fa-w-20"></i>
                                                    </span>
                                                    Add New Procedure
                                                </button>
                                                <button data-bs-toggle="modal" data-bs-target="#add_subpro_modal" type="button" class="btn-shadow btn btn-sm btn-primary">
                                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i class="fa fa-plus fa-w-20"></i>
                                                    </span>
                                                    Add New Sub-Procedure
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="d-flex flex-column">
                                    <!--begin::Number-->
                                    <span class="text-center fw-bold fs-2x text-gray-800 lh-1 ls-n2 mb-3">Procedure List</span>
                                    <hr>
                                    <!--center::Number-->
                                </div> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group table-responsive">
                                            <table id="Procedure_tbl" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="fw-bold text-center">Procedure ID</th>
                                                        <th class="fw-bold text-center">Procedure Description</th>
                                                        <th class="fw-bold text-center">Sub-Procedure ID</th>
                                                        <th class="fw-bold text-center">Sub-Procedure Description</th>
                                                        <th class="fw-bold text-center">Standard No. of Hours</th>
                                                        <th class="fw-bold text-center">Cost</th>
                                                        <th class="fw-bold text-center">Price</th>
                                                        <th class="fw-bold text-center">Status</th>
                                                        <th class="fw-bold text-center">Action</th>
                                                        <!-- <th class="fw-bold text-center">Prioritization</th> -->
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
    <form id="addprocedure" action="<?php echo base_url('Procedures/addProcedure');?>" method="POST">
        <div class="modal fade" id="add_pro_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Procedure</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="fw-bold" for="ProcedureID">Procedure ID:</label>
                                    <input type="text" class="form-control" name="ProcedureID" id="ProcedureID">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="fw-bold" for="ProcedureDesc">Procedure Description:</label>
                                    <input type="text" class="form-control" name="ProcedureDesc" id="ProcedureDesc">
                                </div>
                            </div>
                        </div>   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="submit_op" type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="addsubprocedure" action="<?php echo base_url('Procedures/addSubProcedure');?>" method="POST">
        <div class="modal fade" id="add_subpro_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Sub-Procedure</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="fw-bold" for="sub_ProcedureID">Procedure ID:</label>
                                    <select class="form-control" name="sub_ProcedureID" id="sub_ProcedureID">
                                        <option value="">- Select -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="fw-bold" for="sub_subProcedureID">Sub-Procedure ID:</label>
                                    <input type="text" class="form-control" id="sub_subProcedureID" name="sub_subProcedureID">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="fw-bold" for="sub_ProcedureDesc">Sub-Procedure Description:</label>
                                    <input type="text" class="form-control" name="sub_ProcedureDesc" id="sub_ProcedureDesc">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="fw-bold" for="sub_Cost">Cost:</label>
                                    <input type="number" class="form-control" name="sub_Cost" id="sub_Cost">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="fw-bold" for="sub_Price">Price</label>
                                    <input type="number" class="form-control" name="sub_Price" id="sub_Price">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="fw-bold" for="sub_StandardHrs">Standard No. of Hours:</label>
                                    <input type="number" class="form-control" name="sub_StandardHrs" id="sub_StandardHrs">
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


