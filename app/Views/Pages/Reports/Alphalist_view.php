
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/alphalist_script')  ?>

<!--begin::Main-->
<style>
    table{
        font-size: 12px; 

    }

    .mainlabel{
        background-color:#0f4a5e !important;
        color:white !important;
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
                                Alphalist (BIR)
                            </h1>
                        </div>
                    </div>
                    <!--center::Title-->
                </div>
                <!--center::Page title-->
            </div>
            <!--center::Toolbar container-->
        </div>
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
                                <div class="d-flex flex-column container-fluid">
                                    <?php 
                                        foreach($current_date as $tmp)
                                        {
                                            $currentdate = $tmp->currentdatetime;
                                        }
                                    ?>
                                    <div class="row mt-5">
                                        <div class="col-lg-3">
                                            <label class="fw-bold" for="iCompany">Company: </label>
                                            <select class="form-control" name="iCompany" id="iCompany">
                                                <option value="">- Select -</option>
                                            </select>
                                        </div> 
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <a id="generate_alphalist" href="#!" class="mt-7 btn btn-sm btn-success"><i class="fa-regular fa-paper-plane"></i> Generate</a>
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
</div>