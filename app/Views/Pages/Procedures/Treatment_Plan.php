
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/treatment_plan_script')  ?>

<style>
    input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
         -webkit-appearance: none;
      }
    .treatment_tdata{
        background-color: #12293d !important;
        color:white !important;
    }

    .bordered-div {
        border: 2px solid black; /* Change the border size, style, and color as needed */
        padding: 10px;          /* Optional: adds space inside the border */
        margin: 10px;           /* Optional: adds space outside the border */
    }

    .note_label{
        background-color: yellow;
        color:red;
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
                                Treatment Plan
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
                                <form id="submit_treatmentplan" action="#!" method="POST">
                                    <div class="d-flex flex-column">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="client_name" class="fw-bold">Client:</label>
                                                    <input type="text" class="form-control" name="client_name" id="client_name" readonly>
                                                    <input type="hidden" name="accrefno" id="accrefno" value="<?php echo $acc_refno;?>">
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="treatment_date" class="fw-bold">Date :</label>
                                                    <input type="date" class="form-control" name="treatment_date" id="treatment_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mt-5"> 
                                                <div class="form-group text-end">
                                                    <a id="generate_pdf" href="#!" class="btn btn-sm btn-info"><i class="fa-solid fa-print"></i> Generate PDF</a>
                                                </div>
                                                <div class="form-group text-start"> 
                                                    <a id="add_proc" href="#!" class="btn btn-sm btn-danger"><i class="fa-solid fa-plus"></i> Add Procedure</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mt-5">
                                                <div class="form-group table-striped">
                                                    <input type="hidden" id="ctr" value="0">
                                                    <table class="table" id="treatment_tbl">
                                                        <thead class="treatment_tdata">
                                                            <tr> 	 
                                                                <th class="fw-bold text-center">Procedure</th>
                                                                <th class="fw-bold text-center">Date</th>
                                                                <th class="fw-bold text-center">Duration</th>
                                                                <th class="fw-bold text-center">Tooth No.</th>
                                                                <th class="fw-bold text-center">Tooth Description</th>
                                                                <th class="fw-bold text-center">Regular Price</th>
                                                                <th class="fw-bold text-center">Discounted Price</th>
                                                                <th class="fw-bold text-center">Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center"> 
                                                                    <input type="hidden" name="refno[]" id="refno0">
                                                                    <select required name="procedure[]" id="procedure0" class="form-control">
                                                                        <option value="">- Select -</option>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input required type="date" class="form-control" name="effective_date[]" id="effective_date0">
                                                                </td>
                                                                <td class="text-center">
                                                                    <input required type="number" class="form-control" name="duration[]" id="duration0">
                                                                </td>
                                                                <td class="text-center">
                                                                    <input required type="text" class="form-control" name="tooth[]" id="tooth0">
                                                                </td>
                                                                <td class="text-center">
                                                                    <input required type="text" class="form-control" name="desc[]" id="desc0">
                                                                </td>
                                                                <td class="text-end pe-5">
                                                                    <input required type="number" class="form-control" name="price[]" id="price0">
                                                                </td>
                                                                <td class="text-end pe-5">
                                                                    <input required type="number" class="form-control" name="disc_price[]" id="disc_price0">
                                                                </td>
                                                                <td class="text-center"><a href="#!" class="mt-1 remove btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                                                            </tr> 
                                                        </tbody>
                                                        <tfoot class="treatment_tdata">
                                                            <tr>
                                                                <th class="fw-bold text-start ps-5" colspan="5">Total Price Estimated</th>
                                                                <th class="fw-bold text-end pe-5"><span id="total_price"></span></th>
                                                                <th class="fw-bold text-end pe-5"><span id="total_discprice"></span></th>
                                                                <th></th>
                                                            </tr>
                                                        </tfoot>   
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-lg-12">
                                                <div class="form-group bordered-div">
                                                    <h5 class="pt-2 pb-2 text-center note_label fw-bold">NOTE</h5>
                                                    <ol>
                                                        <li><p>A 50% down payment is required for multiple appointment procedure (i.e. the fabrication of dentures, crowns & bridges and placement of implants) prior to scheduling of appointments</p></li>
                                                        <li><p>Cost estimate indicated above, is exclusive of x-rays and temporary fillings.</p></li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="form-group text-center">
                                                <button id="submit_changes" class="btn btn-sm btn-success" type="submit">Submit Changes</button>
                                                <button id="generate_plan" class="btn btn-sm btn-primary" type="button">Generate Schedule</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
