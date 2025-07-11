
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/collection_report_script')  ?>

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
                                <?=  session('Company_name') ?> Collection Report
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
                                            <label class="fw-bold" for="from">Date From: </label>
                                            <input type="date" class="form-control" name="from" id="from" value="<?php echo date('Y-m-01', strtotime($currentdate)) ;?>">
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="fw-bold" for="to">Date To: </label>
                                            <input type="date" class="form-control" name="to" id="to" value="<?php echo date('Y-m-t', strtotime($currentdate)) ;?>">
                                        </div> 
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <a id="generate_collection_report" href="#!" class="mt-7 btn btn-sm btn-success"><i class="fa-regular fa-paper-plane"></i> Generate</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-lg-12">
                                            <div class="form-group table-responsive">
                                                <table id="collection_rpt_tbl" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="mainlabel fw-bold text-center">Billing No.</th>
                                                            <th class="mainlabel fw-bold text-center">Date</th>
                                                            <th class="mainlabel fw-bold text-center">Client Name</th>
                                                            <!-- <th class="mainlabel fw-bold text-center">Billing Amount</th> -->
                                                            <th class="mainlabel fw-bold text-center">Amount Paid</th>
                                                            <th class="mainlabel fw-bold text-center">OR No.</th>
                                                            <!-- <th class="mainlabel fw-bold text-center">Outstanding Balance</th> -->
                                                            <th class="mainlabel fw-bold text-center">Mode of Payment</th>
                                                            <th class="mainlabel fw-bold text-center">Bank/Company</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th class=" fw-bold text-end"></th>
                                                            <th class=" fw-bold" colspan="2"><span class="ms-2">Total Amount:</span></th> 
                                                            <!-- <th class=" fw-bold text-end"><span id="totalbillingamount"></span></th> -->
                                                            <th class=" fw-bold text-end"><span id="totalamountpaid"></span></th>
                                                            <th class=" fw-bold text-end"></th>
                                                            <!-- <th class=" fw-bold text-end"><span id="totalbalance"></span></th> -->
                                                            <th class=" fw-bold text-end"></th>
                                                            <th class=" fw-bold text-end"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2" class="mainlabel fw-bold text-center">Summary per Mode of Payment</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><span class="ms-3 fw-bold">Cash</span></td>
                                                            <td><span id="cash_count"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ms-3 fw-bold">Debit Card</span></td>
                                                            <td><span id="debit_count"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ms-3 fw-bold">Credit Card</span></td>
                                                            <td><span id="credit_count"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ms-3 fw-bold">HMO</span></td>
                                                            <td><span id="hmo_count"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ms-3 fw-bold">Online Payment</span></td>
                                                            <td><span id="online_count"></span></td>
                                                        </tr>
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
            </div>
        </div>
    </div>
</div>