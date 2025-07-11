
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>
<?= $this->include('scripts/dashboard_script')  ?>


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
                                Dashboard
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
        <div id="kt_app_content" class="app-content  flex-column-fluid " > 
            <div id="kt_app_content_container" class="app-container container-fluid ">
                <!-- <div class="row mt-3">
                    <div class="offset-lg-3 col-lg-3">
                        <div class="card shadow-lg card-company">
                            <div class="fw-semibold card-header-black" style="background-color:#12293d;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center" >
                                            <h4 style="color:white !important;" class="mt-3 card-header-black">Appointments for the Month</h4> 
                                            <?php 
                                                foreach($current_date as $tmp)
                                                {
                                                    $currentdate = $tmp->currentdatetime;
                                                }
                                            ?>
                                            <input type="hidden" id="from" value="<?php echo date('Y-m-1',strtotime($currentdate));?>">
                                            <input type="hidden" id="to" value="<?php echo date('Y-m-t',strtotime($currentdate));?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <h1 id="proccount" style="font-size:300%;" class="card-title text-center">5</h1>
                                <p class="card-text"></p>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-3">
                        <div class="card shadow-lg card-company">
                            <div class="fw-semibold card-header-black" style="background-color:#12293d;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center" >
                                            <h4 style="color:white !important;" class="mt-3 card-header-black">Unaccomplished Appointments</h4> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1 id="unaccomcount" style="font-size:300%;" class="card-title text-center">5</h1>
                                <p class="card-text"></p>
                            </div>
                        </div> 
                    </div> 
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        <div class="card shadow-lg card-company">
                            <div class="fw-semibold card-header-black" style="background-color:#12293d;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center" >
                                            <h4 style="color:white !important;" class="mt-3 card-header-black">Dentist - Appointments for the Month</h4> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="container-fluid" id="dentist_bar"></div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-lg card-company">
                            <div class="fw-semibold card-header-black" style="background-color:#12293d;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center" >
                                            <h4 style="color:white !important;" class="mt-3 card-header-black">Procedures for the Month</h4> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="container-fluid" id="procedures_pie" style="width:100% !important;"></div>
                            </div>
                        </div> 
                    </div>  
                    <div class="col-lg-4">
                        <div class="card shadow-lg card-company">
                            <div class="fw-semibold card-header-black" style="background-color:#12293d;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center" >
                                            <h4 style="color:white !important;" class="mt-3 card-header-black">Professional Fee for the Month</h4> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h1 style="font-size:300%;" class="card-title text-center">50,000</h1>
                                <p class="card-text"></p>
                            </div>
                        </div> 
                    </div>
                </div> 
                <div class="row mt-5">
                    <div class="offset-lg-1 col-lg-10">
                        <div class="card card-company">
                            <div class="fw-semibold card-header-black" style="background-color:#f7e851;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center" >
                                            <h4 style="color:#000000 !important;" class="mt-3 card-header-black"><i class="fa-solid fa-thumbtack"></i> Reminders/Notes</h4> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <textarea class="form-control" name="notes" id="notes"></textarea>
                            </div>
                        </div> 
                    </div> 
                </div>  -->
            </div>
        </div>
 <?= $this->include('core/footer')  ?>


