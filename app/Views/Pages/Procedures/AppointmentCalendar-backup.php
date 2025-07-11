
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/AppointmentCalendar_script')  ?>

<!-- Include Chosen.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Chosen.js JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js"></script>

<!--begin::Main-->
<style>
    .teeth_td{
        padding-bottom:20px;
    }
    th {
        font-size: 15px !important;
    }
    
    input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
         -webkit-appearance: none;
      }

    #test{
        margin-bottom:20px;
    }

    .chosen-container{
    width:100% !important;
    }


    /* Optional: Custom styles for Chosen.js */
    .chosen-container {
        width: 100%;
        max-width: 800px; /* Example of setting a maximum width */
    }

    #procedure_billing_tbl {
        border-collapse: collapse; /* Ensures borders are collapsed */
        width: 100%; /* Optional: makes the table take up full width */
    }

    #procedure_billing_tbl, 
    #procedure_billing_tbl th, 
    #procedure_billing_tbl td {
        border: 1px solid black; /* Border color and style */
    } 

    #client_history_tbl, 
    #client_history_tbl th, 
    #client_history_tbl td {
        font-size:12px !important;  
        border: 1px solid black; /* Border color and style */
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
                                Appointment Calendar
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
                                <div class="d-flex flex-column">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-end">
                                                <button data-bs-toggle="modal" data-bs-target="#app_calendar_modal" type="button" class="btn-shadow btn btn-primary btn-sm">
                                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i class="fa fa-plus fa-w-20"></i>
                                                    </span>
                                                    Create Appointment
                                                </button> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-6">
                                        <div class="form-group">
                                            <div id="calendar"></div>
                                        </div>   
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>

<!-- Add New Appointment -->
<div class="modal fade" id="app_calendar_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Apointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="fw-bold" for="app_client">Client:</label>
                            <select name="app_client" id="app_client" class="form-control">
                                <option value="">- Select -</option>
                                <!-- <option value="Client 1">Client 1</option>
                                <option value="Client 2">Client 2</option>
                                <option value="Client 3">Client 3</option> -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="text-center mb-3"><label class="fw-bold" for="client_history">Client History</label></div>
                            <div class="table-responsive" >
                                <table id="client_history_tbl" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="tblfont fw-bold text-center">Date</th>  
                                            <th class="tblfont fw-bold text-center">Person In Charge</th>  
                                            <th class="tblfont fw-bold text-center">Procedure</th>  
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><hr></div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="fw-bold" for="app_operation">Operation:</label> 

                            <select name="app_operation" id="app_operation" multiple class="chosen-select form-control">
                                <option value="">- Select -</option>
                                <!-- <option value="Operation1-3">Operation 1</option>
                                <option value="Operation2-2">Operation 2</option>
                                <option value="Operation5-3">Operation 3</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="fw-bold" for="app_duration">Duration (Hrs):</label>
                            <input type="number" class="form-control" name="app_duration" id="app_duration">
                        </div> 
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="fw-bold" for="app_dentist">Dentist in charge:</label>
                            <select name="app_dentist" id="app_dentist" class="form-control">
                                <option value="">- Select -</option>
                                <!-- <option value="Mariano Gomez">Mariano Gomez</option>
                                <option value="Jose Burgos">Jose Burgos</option>
                                <option value="Jacinto Zamora">Jacinto Zamora</option>
                                <option value="Severino Mallari">Severino Mallari</option> -->
                            </select>
                        </div>
                    </div> 
                </div>  
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="fw-bold" for="app_date">Date:</label>
                            <input type="date" class="form-control" name="app_date" id="app_date">
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="fw-bold" for="app_time">Time:</label>
                            <input type="time" class="form-control" name="app_time" id="app_time">
                        </div>
                    </div> 
                </div>
                <div class="row mt-3">
                    <!-- <div class="col-lg-6">
                        <div class="form-group">
                            <label class="fw-bold" for="app_branch">Branch:</label>
                            <select class="form-control" name="app_branch" id="app_branch">
                                <option value="">- Select -</option> 
                            </select>
                        </div> 
                    </div>  -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="fw-bold" for="app_room">Room:</label>
                            <select class="form-control" name="app_room" id="app_room">
                                <option value="">- Select Branch First-</option>
                            </select>
                        </div> 
                    </div> 
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="fw-bold" for="app_remarks">Remarks:</label>
                            <textarea name="app_remarks" id="app_remarks" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="submit_app" href="#!" class="btn btn-sm btn-success">Submit</a>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Add New Appointment -->

<!-- Accomplishment Form -->
<div class="modal fade" id="app_accomplishment_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?php echo base_url('Procedures/completeapp');?>" method="POST" id="complete_app">
                <div class="modal-header" style="background-color:white;">
                    <h5 class="modal-title" id="exampleModalLabel">Accomplishment Form</h5>
                    <button type="button" class="text-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-end">
                            <!-- billing_modal --> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="fw-bold" for="acc_date">Date:</label>
                                <input type="text" readonly class="form-control" name="acc_date" id="acc_date"> 
                                <input type="hidden" id="acc_refno" name="acc_refno" value="">

                                <input type="hidden" id="CSL_Result_Remarks" name="CSL_Result_Remarks" value="">
                                <input type="hidden" id="Billing_Date" name="Billing_Date" value="">
                                <input type="hidden" id="Payment" name="Payment" value="">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="fw-bold" for="client_name">Client:</label>
                                <input type="text" readonly id="client_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="fw-bold" for="acc_room">Room:</label>
                                <input type="text" readonly id="acc_room" name="acc_room" class="form-control">
                            </div> 
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="fw-bold" for="procedure">Procedure/s:</label> 
                                <input type="text" readonly id="procedure" class="form-control">
                            </div>
                        </div> 
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="fw-bold" for="incharge">Dentist in charge:</label>
                                <input type="text" readonly id="incharge" class="form-control">
                            </div>
                        </div> 
                    </div>  
                    <!-- <div class="row mt-3"> 
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="fw-bold" for="app_time">Time:</label>
                                <input type="time" class="form-control" name="app_time" id="app_time">
                            </div>
                        </div> 
                    </div> -->
                    <div class="row mt-3">
                        <!-- <div class="col-lg-6">
                            <div class="form-group">
                                <label class="fw-bold" for="acc_branch">Branch:</label>
                                <input type="text" readonly id="acc_branch" name="acc_branch" class="form-control">
                            </div> 
                        </div>  
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="fw-bold" for="acc_room">Room:</label>
                                <input type="text" readonly id="acc_room" name="acc_room" class="form-control">
                            </div> 
                        </div> -->
                    </div>
                    <!-- <div class="row mt-3">
                        <h5>Procedure items used:</h5>
                        <div class="offset-lg-2 col-lg-8">
                            <div class="form-group">
                                <table class="table table-light table-striped" id="items_used">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold text-center">Item/s</th>
                                            <th class="fw-bold text-center">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <div class="row mt-3">
                        <div class="offset-lg-2 col-lg-8">
                            <div class="form-group">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header text-center">
                                            <button class="btn btn-sm btn-info collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fa-solid fa-tooth"></i> View/Hide Mouth Representation
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <img src="<?php echo base_url();?>/assets/img/illustration.jpg" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php
                        $upperjaw = ['M-18','M-17','M-16','P-15','P-14','C-13','I-12','I-11','I-21','I-22','C-23','P-24','P-25','M-26','M-27','M-28'];
                        $lowerjaw = ['M-48','M-47','M-46','P-45','P-44','C-43','I-42','I-41','I-31','I-32','C-33','P-34','P-35','M-36','M-37','M-38'];
                    ?>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <table class="">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td colspan="16" class="text-center fw-bold">Upper Jaw</td>
                                    </tr>
                                    
                                    <tr>
                                        <?php
                                            for($i=0;$i<sizeof($upperjaw);$i++){
                                                ?>
                                                <td class="pe-2">
                                                    <div class="form-check"><input class="form-check-input <?php echo $upperjaw[$i];?>" type="checkbox" value="<?php echo $upperjaw[$i];?>" name="tooth_no"><label class=" " for="flexCheckDefault"><?php echo $upperjaw[$i];?></label></div>
                                                </td>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                    <!-- <tr> 
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input M-18" type="checkbox" value="M-18" name="tooth_no"><label class=" " for="flexCheckDefault">M-18</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input M-17" type="checkbox" value="M-17" name="tooth_no"><label class=" " for="flexCheckDefault">M-17</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input M-16" type="checkbox" value="M-16" name="tooth_no"><label class=" " for="flexCheckDefault">M-16</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input P-15" type="checkbox" value="P-15" name="tooth_no"><label class=" " for="flexCheckDefault">P-15</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input P-14" type="checkbox" value="P-14" name="tooth_no"><label class=" " for="flexCheckDefault">P-14</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input C-13" type="checkbox" value="C-13" name="tooth_no"><label class=" " for="flexCheckDefault">C-13</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input I-12" type="checkbox" value="I-12" name="tooth_no"><label class=" " for="flexCheckDefault">I-12</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input I-11" type="checkbox" value="I-11" name="tooth_no"> <label class=" " for="flexCheckDefault">I-11</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input I-21" type="checkbox" value="I-21" name="tooth_no"> <label class=" " for="flexCheckDefault">I-21</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input I-22" type="checkbox" value="I-22" name="tooth_no"> <label class=" " for="flexCheckDefault">I-22</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input C-23" type="checkbox" value="C-23" name="tooth_no"> <label class=" " for="flexCheckDefault">C-23</label>  </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input P-24" type="checkbox" value="P-24" name="tooth_no"> <label class=" " for="flexCheckDefault">P-24</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input P-25" type="checkbox" value="P-25" name="tooth_no"> <label class=" " for="flexCheckDefault">P-25</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input M-26" type="checkbox" value="M-26" name="tooth_no"> <label class=" " for="flexCheckDefault">M-26</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input M-27" type="checkbox" value="M-27" name="tooth_no"> <label class=" " for="flexCheckDefault">M-27</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input M-28" type="checkbox" value="M-28" name="tooth_no"> <label class=" " for="flexCheckDefault">M-28</label> </div>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="16" class="text-center">&nbsp;</td>
                                    </tr> 
                                    <tr>
                                        <td colspan="16" class="text-center"><span class="mt-3 fw-bold">Lower Jaw</span></td>
                                    </tr>
                                    <tr>
                                        <?php
                                            for($i=0;$i<sizeof($lowerjaw);$i++){
                                                ?>
                                                <td class="pe-2">
                                                    <div class="form-check"><input class="form-check-input <?php echo $lowerjaw[$i];?>" type="checkbox" value="<?php echo $lowerjaw[$i];?>" name="tooth_no"><label class=" " for="flexCheckDefault"><?php echo $lowerjaw[$i];?></label></div>
                                                </td>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                    <!-- <tr>   
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" value="M-48" name="tooth_no"><label class=" " for="flexCheckDefault">M-48</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" value="M-47" name="tooth_no"><label class=" " for="flexCheckDefault">M-47</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" value="M-46" name="tooth_no"><label class=" " for="flexCheckDefault">M-46</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" value="P-45" name="tooth_no"><label class=" " for="flexCheckDefault">P-45</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" value="P-44" name="tooth_no"><label class=" " for="flexCheckDefault">P-44</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" value="C-43" name="tooth_no"><label class=" " for="flexCheckDefault">C-43</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" value="I-42" name="tooth_no"><label class=" " for="flexCheckDefault">I-42</label></div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="I-41" name="tooth_no"> <label class=" " for="flexCheckDefault">I-41</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="I-31" name="tooth_no"> <label class=" " for="flexCheckDefault">I-31</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="I-32" name="tooth_no"> <label class=" " for="flexCheckDefault">I-32</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="C-33" name="tooth_no"> <label class=" " for="flexCheckDefault">C-33</label>  </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="P-34" name="tooth_no"> <label class=" " for="flexCheckDefault">P-34</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="P-35" name="tooth_no"> <label class=" " for="flexCheckDefault">P-35</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="M-36" name="tooth_no"> <label class=" " for="flexCheckDefault">M-36</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="M-37" name="tooth_no"> <label class=" " for="flexCheckDefault">M-37</label> </div>
                                        </td>
                                        <td class="pe-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="M-38" name="tooth_no"> <label class=" " for="flexCheckDefault">M-38</label> </div>
                                        </td> 
                                    </tr> -->
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="fw-bold" for="acc_remarks">Remarks:</label>
                                <textarea name="acc_remarks" id="acc_remarks" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="fw-bold" for="acc_file">Upload File:</label>
                                <input type="file" name="acc_file" id="acc_file" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="appsubmit_btn" type="submit" class="btn btn-sm btn-success">Submit Accomplishment</button>
                    <button id="billing_btn" type="button" class=" btn-shadow btn btn-info btn-sm">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa-solid fa-file-invoice"></i>
                        </span>
                        Create Billing
                    </button>
                    <button id="payment_btn" type="button" class="btn-shadow btn btn-primary btn-sm">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa-regular fa-credit-card"></i>
                        </span>
                        Receive Payment
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Accomplishment Form -->

<!-- Billing Form -->
<div class="modal fade" id="billing_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?php echo base_url('Procedures/submit_billing');?>" method="POST" id="create_billing">
                <div class="modal-header" style="background-color:white;">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">Billing Form</h5> -->
                    <button type="button" class="text-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h1 class="fw-bold text-center"> <?=  session('Company_name') ?></h1>
                                <p class="text-center"> <?=  session('Company_Address') ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <hr>
                                <h4 class="fw-bold"><u>BILLING FORM</u></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <table class="table">
                                    <thead></thead>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <p>Name : <span class="fw-bold" id="client_label"></span></p> 
                                                <input type="hidden" name="clientcode_hid" id="clientcode_hid">
                                            </th>
                                            <th>Date : <span class="fw-bold" id="date_label"></span></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Doctor In Charge : <span class="fw-bold" id="incharge_label"></span>
                                                <input type="hidden" name="incharge_hid" id="incharge_hid">
                                            </th>
                                            <th>Address : <span class="fw-bold" id="add_label"></span></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mt-5">
                                <div class="text-center container-fluid ps-20">
                                    <table id="procedure_billing_tbl" class="table" style="width:90%">
                                        <thead>
                                            <tr>
                                                <th class="text-center fw-bold">Procedure</th>
                                                <th class="text-center fw-bold">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="ps-5 text-start fw-bold">Sub-total :</th>
                                                <th class="pe-10 text-end">
                                                    <span id="subtotal"></span>
                                                    <input type="hidden" name="subtotal_hid" id="subtotal_hid">
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <table id="procedure_billing_disc_tbl" class="table" style="width:90%"> 
                                        <thead></thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td class="ps-5 text-start fw-bold">Professional Fee</td>
                                                <td class="pe-10 text-end">
                                                    <span id="professional_fee">0.00</span>
                                                    <input style="text-align: right;" type="number" class="form-control" name="pro_fee" id="pro_fee" value="0">
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td class="ps-5 text-start fw-bold">Less: Discount</td>
                                                <td class="pe-10 text-end">
                                                    <span id="discount"> </span> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-15 text-start fw-bold">PWD/Senior:</td>
                                                <td class="pe-10 text-end">
                                                    <span id="pwd_senior">0.00</span>
                                                    <input type="hidden" name="pwd_senior_hid" id="pwd_senior_hid">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-15 text-start fw-bold">Others:</td>
                                                <td class="pe-10 text-end">
                                                    <!-- <span id="others_disc">0.00</span> -->
                                                    <input style="text-align: right;" type="number" class="form-control" name="others_disc" id="others_disc" value="0">
                                                </td>
                                            </tr>
                                        </tbody> 
                                        <tfoot>
                                            <tr>
                                                <th colspan="2"><hr></th>
                                            </tr>
                                            <tr> 
                                                <th class="ps-5 text-start fw-bold"><h3>Total Billing :</h3></th>
                                                <th class="pe-10 text-end">
                                                    <span id="total_billing"></span>
                                                    <input type="hidden" name="total_billing_hid" id="total_billing_hid">
                                                </th> 
                                            </tr>     
                                            <tr>
                                                <th colspan="2"><hr></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-info btn-sm">Create Billing</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Billing Form -->




<!--  Payment Form -->
<div class="modal fade" id="payment_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('Procedures/submit_payment');?>" method="POST" id="submit_payment">
                <div class="modal-header" style="background-color:white;">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Form</h5>
                    <button type="button" class="text-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group"> 
                                <input type="hidden" id="arrefno" name="arrefno">
                                <label class="fw-bold" for="modeofpayment">Mode of Payment:</label> 
                                <select class="form-control" name="modeofpayment" id="modeofpayment">
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4" id="bankcompany_div">
                            <div class="form-group"> 
                                <label class="fw-bold" for="bank_company">Bank/Company:</label>  
                                <select class="form-control" name="bank_company" id="bank_company">
                                    <option value="">- Select -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4" id="refno_div">
                            <div class="form-group"> 
                                <label class="fw-bold" for="approvedrefno">Approved Ref No:</label>  
                                <input type="text" class="form-control" name="approvedrefno" id="approvedrefno">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ornumber" class="fw-bold">O.R. Number:</label>
                                <input type="number" class="form-control" name="ornumber" id="ornumber">
                            </div>
                        </div>
                    </div> 
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="amount_due" class="fw-bold">Amount Due:</label>
                                <input type="number" class="form-control" name="amount_due" id="amount_due">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="amount_paid" class="fw-bold">Amount Paid:</label>
                                <input type="number" class="form-control" name="amount_paid" id="amount_paid">
                            </div>
                        </div>
                    </div> 
                    <div class="row mt-15">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="receivedby" class="fw-bold">Received By:</label>
                                <input value="<?php echo session('name');?>" readonly type="text" class="form-control" name="receivedby" id="receivedby">
                            </div>
                        </div>
                    </div> 
                                            
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Receive Payment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 
<!--  Payment Form -->

 <?= $this->include('core/footer')  ?>


