
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/BankList_script')  ?>

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
                                Bank List
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
                                            <button data-bs-toggle="modal" data-bs-target="#bank_modal" type="button" class="btn-shadow btn btn-primary">
                                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                                        <i class="fa fa-plus fa-w-20"></i>
                                                </span>
                                                Add New
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="d-flex flex-column">
                                    <!--begin::Number-->
                                    <span class="text-center fw-bold fs-2x text-gray-800 lh-1 ls-n2 mb-3">Bank List</span>
                                    <hr>
                                    <!--center::Number-->
                                </div> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group table-responsive">
                                            <table id="bank_tbl" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="fw-bold text-center">Bank</th>  
                                                        <th class="fw-bold text-center">Status </th> 
                                                        <th class="fw-bold text-center">Action </th> 
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

<div class="modal fade" id="bank_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="fw-bold" for="BankDesc">Bank Description:</label>
                            <input type="text" class="form-control" name="BankDesc" id="BankDesc">
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="submit_bank" type="button" class="btn btn-sm btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>

 <?= $this->include('core/footer')  ?>


