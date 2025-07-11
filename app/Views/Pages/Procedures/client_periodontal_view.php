
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('scripts/periodontal_script')  ?>   
<style>
    input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
         -webkit-appearance: none;
      }
      
    .maintoothlabel{
        font-size:15px;
        color:white !important;
    }

    .text-center input {
        display: block; /* Ensures the input behaves like a block element */
        margin: 0 auto; /* Horizontally centers the input inside the td */
        text-align: center; /* Centers the number inside the input */
    }
    
    .bleed,.plaque {
        max-width: 10px !important; 
        padding: 1.2rem 0.4rem  !important; 
        margin: 0 !important;
    } 
    
    input {
        border: none; /* Removes the border */
        outline: none; /* Removes the outline when focused */
        
    }

    .furcation {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 20px; /* Button width */
        height: 20px; /* Button height */
        border: 1px solid #000;
        padding: 0;
        background: none;
        cursor: pointer;
    }

    .furcation svg {
        width: 40px; /* Set the width of the SVG */
        height: 40px; /* Set the height of the SVG */
        display: block; /* Remove space below SVG */
    }

    .teethtop, .teethbot{
        height:80px;
    }

    input[type="number"] {
        border: none;   
        /* Remove border /
        outline: none; / Remove outline /
        padding: 10px;  / Add padding for appearance /
        font-size: 16px; / Font size /
        background-color: transparent; / Optional: Make the background transparent /
        width: 50px;    / Resize the width of the input /
        text-align: center; / Center the digit */
    }

    input[type="number"]:focus {
        border: none; /* No border on focus /
        outline: none; / No outline on focus */
    } 

    .gingivalmargin-buccal, 
    .gingivalmargin-palatal, 
    .gingivalmargin-lingual, 
    .gingivalmargin-buccal-bot, 
    .probingdepth-buccal, 
    .probingdepth-palatal, 
    .probingdepth-lingual, 
    .probingdepth-buccal-bot  {
        padding : 0px;
        
    }
  
</style>
<div class="app-main flex-column flex-row-fluid" id="kt_app_main"> 
    <div class="d-flex flex-column flex-column-fluid"> 
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 "> 
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack "> 
                <div  class="page-title d-flex flex-column justify-content-start flex-wrap me-3 "> 
                    <div class="card">
                        <div class="card-body p-sm-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-start my-0">
                                Periodontal Chart
                            </h1>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div>
        <?php
            foreach($getcurrentdate as $tmp)
            {
                $currentdatetime = $tmp->currentdatetime;
            }
        ?>
        <div id="kt_app_content" class="app-content flex-column-fluid"> 
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row gy-5 g-xl-9"> 
                    <div class="col-sm-6 col-xl-12 mb-xl-10"> 
                        <div class="card h-lg-100 shadow-lg"> 
                            <div class="card-body d-flex justify-content-between flex-column"> 
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="fw-bold" for="">Date : </label>
                                            <input readonly type="date" class="form-control currentdate" value="<?php echo date('Y-m-d',strtotime($currentdatetime));?>">
                                            <input type="hidden" id="acc_refno" value="<?php echo $acc_refno; ?>">
                                            <input type="hidden" id="clientcode" value="">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mt-5">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="fw-bold" for="">Client Name : </label>
                                            <input readonly type="text" class="form-control" id="client_name">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div id="perio_div"> 
                                    <div class="row mt-10">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="text-center fw-bold fs-3">Periodontal Chart</div>
                                                <div class="text-start fs-6">Client: <span class="fw-bold" id="client_name">N/A</span></div>
                                                <div class="text-end fst-italic me-2 fs-7">Last Modified Date: <span class="fw-bold" id="CPL_Date">N/A</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-sm-12 mt-6">
                                            <div class="form-group table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="1" data-value="0"> 1 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="2" data-value="0"> 2 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="3" data-value="0"> 3 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="4" data-value="0"> 4 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="5" data-value="0"> 5 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="6" data-value="0"> 6 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="7" data-value="0"> 7 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="8" data-value="0"> 8 </a> </th>
                                                            <th></th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="9" data-value="0"> 9 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="10" data-value="0"> 10 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="11" data-value="0"> 11 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="12" data-value="0"> 12 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="13" data-value="0"> 13 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="14" data-value="0"> 14 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="15" data-value="0"> 15 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="16" data-value="0"> 16 </a> </th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Mobility</span></td>
                                                            
                                                            <td class="text-center cellno-1">
                                                                <input value="0" class="mobility form-control" data-no="1" type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-2">
                                                                <input value="0" class="mobility form-control" data-no="2"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <input value="0" class="mobility form-control" data-no="3"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                <input value="0" class="mobility form-control" data-no="4"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <input value="0" class="mobility form-control" data-no="5"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                <input value="0" class="mobility form-control" data-no="6"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                <input value="0" class="mobility form-control" data-no="7"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-8">
                                                                <input value="0" class="mobility form-control" data-no="8"  type="number" min="0" max="3" step="1">
                                                            </td>

                                                            <td></td>

                                                            <td class="text-center cellno-9">
                                                                <input value="0" class="mobility form-control" data-no="9"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-10">
                                                                <input value="0" class="mobility form-control" data-no="10"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                <input value="0" class="mobility form-control" data-no="11"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <input value="0" class="mobility form-control" data-no="12"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                <input value="0" class="mobility form-control" data-no="13"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <input value="0" class="mobility form-control" data-no="14"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <input value="0" class="mobility form-control" data-no="15"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <input value="0" class="mobility form-control" data-no="16"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                        </tr>
                                                        <tr id="implants">
                                                            <td class="text-center"><span class="mt-10 fw-bold">Implant</span></td>
                                                            <td class="text-center cellno-1">
                                                                <button class="btn btn-light implant" data-no="1" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-2">
                                                                <button class="btn btn-light implant" data-no="2" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <button class="btn btn-light implant" data-no="3" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                <button class="btn btn-light implant" data-no="4" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <button class="btn btn-light implant" data-no="5" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                <button class="btn btn-light implant" data-no="6" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                <button class="btn btn-light implant" data-no="7" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-8">
                                                                <button class="btn btn-light implant" data-no="8" value="0"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-9">
                                                                <button class="btn btn-light implant" data-no="9" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-10">
                                                                <button class="btn btn-light implant" data-no="10" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                <button class="btn btn-light implant" data-no="11" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <button class="btn btn-light implant" data-no="12" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                <button class="btn btn-light implant" data-no="13" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <button class="btn btn-light implant" data-no="14" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <button class="btn btn-light implant" data-no="15" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <button class="btn btn-light implant" data-no="16" value="0"></button>
                                                            </td> 
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Furcation</span></td>
                                                            <td class="text-center cellno-1">
                                                                <button value="0" data-no="1" data-type="buccal-top" class="furcation">
                                                                    <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-2">
                                                                <button value="0" data-no="2" data-type="buccal-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <button value="0" data-no="3" data-type="buccal-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                            
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-8"> 
                                                            </td>
                                                            <td></td> 
                                                            <td class="text-center cellno-9">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-10">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <button value="0" data-no="14" data-type="buccal-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <button value="0" data-no="15" data-type="buccal-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <button value="0" data-no="16" data-type="buccal-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Bleeding on Probing</span></td>
                                                            <td class="text-center cellno-1"> 
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="1-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="1-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="1-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-2"> 
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="2-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="2-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="2-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="3-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="3-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="3-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="4-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="4-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="4-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="5-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="5-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="5-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="6-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="6-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="6-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="7-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="7-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="7-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-8">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="8-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="8-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="8-3"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-9">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="9-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="9-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="9-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-10">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="10-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="10-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="10-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="11-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="11-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="11-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="12-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="12-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="12-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="13-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="13-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="13-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="14-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="14-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="14-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="15-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="15-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="15-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="16-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="16-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal" value="0" data-no="16-3"></button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Plaque</span></td>
                                                            <td class="text-center cellno-1"> 
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="1-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="1-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="1-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-2"> 
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="2-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="2-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="2-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="3-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="3-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="3-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="4-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="4-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="4-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="5-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="5-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="5-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="6-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="6-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="6-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="7-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="7-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="7-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-8">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="8-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="8-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="8-3"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-9">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="9-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="9-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="9-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-10">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="10-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="10-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="10-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="11-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="11-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="11-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="12-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="12-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="12-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="13-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="13-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="13-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="14-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="14-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="14-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="15-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="15-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="15-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="16-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="16-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal" value="0" data-no="16-3"></button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Gingival Margin</span></td>
                                                            <td class="text-center cellno-1">
                                                                <input data-no="1-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="1-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="1-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-2">
                                                                <input data-no="2-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="2-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="2-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <input data-no="3-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="3-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="3-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                <input data-no="4-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="4-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="4-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <input data-no="5-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="5-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="5-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                <input data-no="6-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="6-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="6-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                <input data-no="7-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="7-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="7-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-8">
                                                                <input data-no="8-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="8-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="8-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-9">
                                                                <input data-no="9-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="9-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="9-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-10">
                                                                <input data-no="10-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="10-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="10-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                <input data-no="11-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="11-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="11-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <input data-no="12-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="12-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="12-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                <input data-no="13-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="13-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="13-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <input data-no="14-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="14-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="14-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <input data-no="15-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="15-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="15-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <input data-no="16-1" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="16-2" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="16-3" value="0" class="gingivalmargin-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Probing Depth</span></td> 
                                                            <td class="text-center cellno-1">
                                                                <input data-no="1-1" value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="1-2" value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="1-3" value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-2">
                                                                <input data-no="2-1" value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="2-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="2-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <input data-no="3-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="3-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="3-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                <input data-no="4-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="4-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="4-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <input data-no="5-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="5-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="5-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                <input data-no="6-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="6-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="6-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                <input data-no="7-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="7-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="7-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-8">
                                                                <input data-no="8-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="8-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="8-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-9">
                                                                <input data-no="9-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="9-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="9-2"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-10">
                                                                <input data-no="10-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="10-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="10-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                <input data-no="11-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="11-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="11-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <input data-no="12-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="12-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="12-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                <input data-no="13-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="13-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="13-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <input data-no="14-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="14-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="14-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <input data-no="15-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="15-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="15-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <input data-no="16-1"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="16-2"  value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="16-3"   value="0" class="probingdepth-buccal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Buccal</span></td>
                                                            <td class="cellno-1"> 
                                                                <a href="#!" class="remarks_btn" data-no="1" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">  
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:7px;">
                                                                        <div class="buccal-top-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethtop buccal-top" data-no="1" src="<?php base_url();?>/assets/images/teeth_set/teethtop-1.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-2">
                                                                <a href="#!" class="remarks_btn" data-no="2" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:7px;">
                                                                        <div class="buccal-top-2"></div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="buccal-top-2" style="position:absolute;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"> 
                                                                        <circle cx="14" cy="40" r="5" stroke="black" stroke-width="1" fill="none" />
                                                                    </svg>
                                                                </div> -->
                                                                <img class="teethtop buccal-top" data-no="2" src="<?php base_url();?>/assets/images/teeth_set/teethtop-2.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-3">
                                                                <a href="#!" class="remarks_btn" data-no="3" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:9px;">
                                                                        <div class="buccal-top-3"></div>
                                                                    </div>
                                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"> 
                                                                        <circle cx="14" cy="40" r="5" stroke="black" stroke-width="1" fill="none" />
                                                                    </svg> -->
                                                                </div>
                                                                <img class="teethtop buccal-top" data-no="3" src="<?php base_url();?>/assets/images/teeth_set/teethtop-3.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-4">
                                                                <a href="#!" class="remarks_btn" data-no="4" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="4" src="<?php base_url();?>/assets/images/teeth_set/teethtop-4.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-5">
                                                                <a href="#!" class="remarks_btn" data-no="5" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="5" src="<?php base_url();?>/assets/images/teeth_set/teethtop-5.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-6">
                                                                <a href="#!" class="remarks_btn" data-no="6" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="6" src="<?php base_url();?>/assets/images/teeth_set/teethtop-6.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-7">
                                                                <a href="#!" class="remarks_btn" data-no="7" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="7" src="<?php base_url();?>/assets/images/teeth_set/teethtop-7.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-8">
                                                                <a href="#!" class="remarks_btn" data-no="8" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="8" src="<?php base_url();?>/assets/images/teeth_set/teethtop-8.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-9"> 
                                                                <a href="#!" class="remarks_btn" data-no="9" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="9" src="<?php base_url();?>/assets/images/teeth_set/teethtop-9.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-10">
                                                                <a href="#!" class="remarks_btn" data-no="10" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="10" src="<?php base_url();?>/assets/images/teeth_set/teethtop-10.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-11">
                                                                <a href="#!" class="remarks_btn" data-no="11" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="11" src="<?php base_url();?>/assets/images/teeth_set/teethtop-11.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-12">
                                                                <a href="#!" class="remarks_btn" data-no="12" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="12" src="<?php base_url();?>/assets/images/teeth_set/teethtop-12.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-13">
                                                                <a href="#!" class="remarks_btn" data-no="13" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop buccal-top" data-no="13" src="<?php base_url();?>/assets/images/teeth_set/teethtop-13.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-14">
                                                                <a href="#!" class="remarks_btn" data-no="14" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position:absolute;">
                                                                        <div style="position: absolute;top:30px;left:9px;">
                                                                            <div class="buccal-top-14"> </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"> 
                                                                        <circle cx="14" cy="40" r="5" stroke="black" stroke-width="1" fill="none" />
                                                                    </svg> -->
                                                                </div>
                                                                <img class="teethtop buccal-top" data-no="14" src="<?php base_url();?>/assets/images/teeth_set/teethtop-14.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-15">
                                                                <a href="#!" class="remarks_btn" data-no="15" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position:absolute;">
                                                                        <div style="position: absolute;top:30px;left:8px;">
                                                                            <div class="buccal-top-15"> </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"> 
                                                                        <circle cx="14" cy="40" r="5" stroke="black" stroke-width="1" fill="none" />
                                                                    </svg> -->
                                                                </div>
                                                                <img class="teethtop buccal-top" data-no="15" src="<?php base_url();?>/assets/images/teeth_set/teethtop-15.png" alt="">
                                                                </a>
                                                                
                                                            </td>
                                                            <td class="cellno-16">
                                                                <a href="#!" class="remarks_btn" data-no="16" data-type="buccal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position:absolute;">
                                                                        <div style="position: absolute;top:30px;left:7px;">
                                                                            <div class="buccal-top-16"> </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"> 
                                                                        <circle cx="14" cy="40" r="5" stroke="black" stroke-width="1" fill="none" />
                                                                    </svg> -->
                                                                </div>
                                                                <img class="teethtop buccal-top" data-no="16" src="<?php base_url();?>/assets/images/teeth_set/teethtop-16.png" alt="">
                                                                </a>
                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Palatal</span></td>
                                                            <td class="cellno-1"> 
                                                                <a href="#!" class="remarks_btn" data-no="1" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:-2px;">
                                                                        <div class="palatal-bot-1-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:33px;left:12px;">
                                                                        <div class="palatal-bot-1-2"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethbot palatal-bot" data-no="1" src="<?php base_url();?>/assets/images/teeth_set/teethbot-1.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-2">
                                                                <a href="#!" class="remarks_btn" data-no="2" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:-2px;">
                                                                        <div class="palatal-bot-2-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:33px;left:12px;">
                                                                        <div class="palatal-bot-2-2"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethbot palatal-bot" data-no="2" src="<?php base_url();?>/assets/images/teeth_set/teethbot-2.png" alt="">
                                                                </a>
                                                                
                                                            </td>
                                                            <td class="cellno-3">
                                                                <a href="#!" class="remarks_btn" data-no="3" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:38px;left:0px;">
                                                                        <div class="palatal-bot-3-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:17px;">
                                                                        <div class="palatal-bot-3-2"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethbot palatal-bot" data-no="3" src="<?php base_url();?>/assets/images/teeth_set/teethbot-3.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-4">
                                                                <a href="#!" class="remarks_btn" data-no="4" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot palatal-bot" data-no="4" src="<?php base_url();?>/assets/images/teeth_set/teethbot-4.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-5">
                                                                <a href="#!" class="remarks_btn" data-no="5" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:38px;left:0px;">
                                                                        <div class="palatal-bot-5-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:9px;">
                                                                        <div class="palatal-bot-5-2"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethbot palatal-bot" data-no="5" src="<?php base_url();?>/assets/images/teeth_set/teethbot-5.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-6">
                                                                <a href="#!" class="remarks_btn" data-no="6" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot palatal-bot" data-no="6" src="<?php base_url();?>/assets/images/teeth_set/teethbot-6.png" alt="">
                                                                </a>
                                                                
                                                            </td>
                                                            <td class="cellno-7">
                                                                <a href="#!" class="remarks_btn" data-no="7" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot palatal-bot" data-no="7" src="<?php base_url();?>/assets/images/teeth_set/teethbot-7.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-8">
                                                                <a href="#!" class="remarks_btn" data-no="8" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot palatal-bot" data-no="8" src="<?php base_url();?>/assets/images/teeth_set/teethbot-8.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-9"> 
                                                                <a href="#!" class="remarks_btn" data-no="9" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot palatal-bot" data-no="9" src="<?php base_url();?>/assets/images/teeth_set/teethbot-9.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-10">
                                                                <a href="#!" class="remarks_btn" data-no="10" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot palatal-bot" data-no="10" src="<?php base_url();?>/assets/images/teeth_set/teethbot-10.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-11">
                                                                <a href="#!" class="remarks_btn" data-no="11" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot palatal-bot" data-no="11" src="<?php base_url();?>/assets/images/teeth_set/teethbot-11.png" alt="">    
                                                                </a>
                                                            </td>
                                                            <td class="cellno-12">
                                                                <a href="#!" class="remarks_btn" data-no="12" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:0px;">
                                                                        <div class="palatal-bot-12-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:38px;left:9px;">
                                                                        <div class="palatal-bot-12-2"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethbot palatal-bot" data-no="12" src="<?php base_url();?>/assets/images/teeth_set/teethbot-12.png" alt="">
                                                                </a>
                                                                
                                                            </td>
                                                            <td class="cellno-13">
                                                                <a href="#!" class="remarks_btn" data-no="13" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot palatal-bot" data-no="13" src="<?php base_url();?>/assets/images/teeth_set/teethbot-13.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-14">
                                                                <a href="#!" class="remarks_btn" data-no="14" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:0px;">
                                                                        <div class="palatal-bot-14-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:38px;left:19px;">
                                                                        <div class="palatal-bot-14-2"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethbot palatal-bot" data-no="14" src="<?php base_url();?>/assets/images/teeth_set/teethbot-14.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-15">
                                                                <a href="#!" class="remarks_btn" data-no="15" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:35px;left:4px;">
                                                                        <div class="palatal-bot-15-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:35px;left:16px;">
                                                                        <div class="palatal-bot-15-2"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethbot palatal-bot" data-no="15" src="<?php base_url();?>/assets/images/teeth_set/teethbot-15.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-16">
                                                                <a href="#!" class="remarks_btn" data-no="16" data-type="palatal" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:32px;left:0px;">
                                                                        <div class="palatal-bot-16-1"> </div>
                                                                    </div>
                                                                </div>
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:29px;left:14px;">
                                                                        <div class="palatal-bot-16-2"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethbot palatal-bot" data-no="16" src="<?php base_url();?>/assets/images/teeth_set/teethbot-16.png" alt="">
                                                                </a> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Gingival Margin</span></td>
                                                            <td class="cellno-1">
                                                                <input data-no="1" value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="1" value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="1" value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-2">
                                                                <input data-no="2"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="2"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="2"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-3">
                                                                <input data-no="3"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="3"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="3"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-4">
                                                                <input data-no="4"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="4"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="4"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-5">
                                                                <input data-no="5"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="5"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="5"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-6">
                                                                <input data-no="6"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="6"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="6"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-7">
                                                                <input data-no="7"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="7"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="7"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-8">
                                                                <input data-no="8"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="8"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="8"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-9">
                                                                <input data-no="9"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="9"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="9"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-10">
                                                                <input data-no="10"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="10"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="10"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-11">
                                                                <input data-no="11"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="11"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="11"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-12">
                                                                <input data-no="12"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="12"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="12"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-13">
                                                                <input data-no="13"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="13"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="13"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-14">
                                                                <input data-no="14"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="14"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="14"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-15">
                                                                <input data-no="15"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="15"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="15"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-16">
                                                                <input data-no="16"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="16"  value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="16"   value="0" class="gingivalmargin-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Probing Depth</span></td> 
                                                            <td class="cellno-1">
                                                                <input data-no="1-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="1-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="1-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-2">
                                                                <input data-no="2-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="2-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="2-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-3">
                                                                <input data-no="3-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="3-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="3-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-4">
                                                                <input data-no="4-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="4-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="4-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-5">
                                                                <input data-no="5-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="5-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="5-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-6">
                                                                <input data-no="6-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="6-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="6-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-7">
                                                                <input data-no="7-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="7-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="7-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-8">
                                                                <input data-no="8-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="8-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="8-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-9">
                                                                <input data-no="9-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="9-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="9-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-10">
                                                                <input data-no="10-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="10-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="10-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-11">
                                                                <input data-no="11-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="11-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="11-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-12">
                                                                <input data-no="12-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="12-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="12-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-13">
                                                                <input data-no="13-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="13-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="13-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-14">
                                                                <input data-no="14-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="14-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="14-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-15">
                                                                <input data-no="15-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="15-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="15-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-16">
                                                                <input data-no="16-1"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="16-2"  value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="16-3"   value="0" class="probingdepth-palatal text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Plaque</span></td>
                                                            <td class="text-center cellno-1"> 
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="1-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="1-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="1-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-2"> 
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="2-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="2-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="2-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="3-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="3-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="3-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="4-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="4-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="4-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="5-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="5-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="5-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="6-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="6-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="6-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="7-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="7-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="7-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-8">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="8-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="8-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="8-3"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-9">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="9-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="9-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="9-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-10">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="10-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="10-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="10-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="11-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="11-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="11-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="12-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="12-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="12-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="13-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="13-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="13-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="14-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="14-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="14-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="15-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="15-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="15-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="16-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="16-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-palatal" value="0" data-no="16-3"></button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Bleeding on Probing</span></td>
                                                            <td class="text-center cellno-1"> 
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="1-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="1-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="1-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-2"> 
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="2-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="2-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="2-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="3-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="3-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="3-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="4-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="4-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="4-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="5-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="5-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="5-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="6-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="6-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="6-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="7-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="7-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="7-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-8">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="8-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="8-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="8-3"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-9">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="9-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="9-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="9-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-10">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="10-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="10-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="10-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="11-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="11-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="11-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="12-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="12-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="12-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="13-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="13-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="13-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="14-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="14-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="14-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="15-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="15-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="15-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="16-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="16-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-palatal" value="0" data-no="16-3"></button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Furcation</span></td>
                                                            <td class="text-center cellno-1">
                                                                <button value="0" data-no="1-1" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg"> 
                                                                    </svg>
                                                                </button>
                                                                <button value="0" data-no="1-2" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg"> 
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-2">
                                                                <button value="0" data-no="2-1" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                                <button value="0" data-no="2-2" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-3">
                                                                <button value="0" data-no="3-1" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                                <button value="0" data-no="3-2" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-4">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-5">
                                                                <button value="0" data-no="5-1" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                                <button value="0" data-no="5-2" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>  
                                                            </td>
                                                            <td class="text-center cellno-6">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-7">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-8"> 
                                                            </td>
                                                            <td ></td> 
                                                            <td class="text-center cellno-9">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-10">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-11">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-12">
                                                                <button value="0" data-no="12-1" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                                <button value="0" data-no="12-2" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>    
                                                            </td>
                                                            <td class="text-center cellno-13">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-14">
                                                                <button value="0" data-no="14-1" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                                <button value="0" data-no="14-2" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-15">
                                                                <button value="0" data-no="15-1" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                                <button value="0" data-no="15-2" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-16">
                                                                <button value="0" data-no="16-1" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                                <button value="0" data-no="16-2" data-type="palatal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="18">
                                                                <hr>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Furcation</span></td>
                                                            <td class="text-center cellno-48">
                                                                <button value="0" data-no="48" data-type="lingual-top" class="furcation">
                                                                    <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-47">
                                                                <button value="0" data-no="47" data-type="lingual-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-46">
                                                                <button value="0" data-no="46" data-type="lingual-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-45">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-44">
                                                            
                                                            </td>
                                                            <td class="text-center cellno-43">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-42">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-41"> 
                                                            </td>
                                                            <td></td> 
                                                            <td class="text-center cellno-31">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-32">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-33">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-34">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-35">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-36">
                                                                <button value="0" data-no="36" data-type="lingual-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-37">
                                                                <button value="0" data-no="37" data-type="lingual-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-38">
                                                                <button value="0" data-no="38" data-type="lingual-top" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Bleeding on Probing</span></td>
                                                            <td class="text-center cellno-48"> 
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="48-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="48-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="48-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-47"> 
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="47-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="47-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="47-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-46">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="46-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="46-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="46-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-45">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="45-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="45-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="45-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-44">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="44-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="44-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="44-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-43">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="43-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="43-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="43-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-42">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="42-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="42-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="42-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-41">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="41-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="41-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="41-3"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-31">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="31-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="31-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="31-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-32">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="32-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="32-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="32-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-33">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="33-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="33-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="33-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-34">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="34-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="34-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="34-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-35">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="35-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="35-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="35-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-36">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="36-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="36-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="36-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-37">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="37-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="37-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="37-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-38">
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="38-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="38-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-lingual" value="0" data-no="38-3"></button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Plaque</span></td>
                                                            <td class="text-center cellno-48"> 
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="48-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="48-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="48-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-47"> 
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="47-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="47-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="47-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-46">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="46-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="46-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="46-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-45">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="45-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="45-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="45-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-44">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="44-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="44-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="44-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-43">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="43-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="43-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="43-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-42">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="42-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="42-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="42-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-41">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="41-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="41-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="41-3"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-31">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="31-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="31-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="31-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-32">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="32-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="32-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="32-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-33">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="33-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="33-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="33-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-34">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="34-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="34-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="34-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-35">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="35-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="35-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="35-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-36">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="36-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="36-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="36-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-37">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="37-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="37-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="37-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-38">
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="38-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="38-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-lingual" value="0" data-no="38-3"></button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Gingival Margin</span></td> 
                                                            <td class="cellno-48">
                                                                <input data-no="48-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="48-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="48-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-47">
                                                                <input data-no="47-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="47-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="47-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-46">
                                                                <input data-no="46-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="46-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="46-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-45">
                                                                <input data-no="45-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="45-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="45-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-44">
                                                                <input data-no="44-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="44-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="44-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-43">
                                                                <input data-no="43-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="43-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="43-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-42">
                                                                <input data-no="42-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="42-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="42-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-41">
                                                                <input data-no="41-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="41-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="41-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-31">
                                                                <input data-no="31-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="31-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="31-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-32">
                                                                <input data-no="32-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="32-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="32-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-33">
                                                                <input data-no="33-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="33-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="33-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-34">
                                                                <input data-no="34-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="34-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="34-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-35">
                                                                <input data-no="35-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="35-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="35-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-36">
                                                                <input data-no="36-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="36-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="36-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-37">
                                                                <input data-no="37-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="37-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="37-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-38">
                                                                <input data-no="38-1" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="38-2" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="38-3" value="0" class="gingivalmargin-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Probing Depth</span></td> 
                                                            <td class="cellno-48">
                                                                <input data-no="48-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="48-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="48-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-47">
                                                                <input data-no="47-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="47-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="47-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-46">
                                                                <input data-no="46-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="46-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="46-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-45">
                                                                <input data-no="45-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="45-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="45-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-44">
                                                                <input data-no="44-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="44-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="44-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-43">
                                                                <input data-no="43-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="43-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="43-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-42">
                                                                <input data-no="42-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="42-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="42-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-41">
                                                                <input data-no="41-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="41-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="41-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-31">
                                                                <input data-no="31-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="31-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="31-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-32">
                                                                <input data-no="32-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="32-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="32-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-33">
                                                                <input data-no="33-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="33-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="33-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-34">
                                                                <input data-no="34-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="34-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="34-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-35">
                                                                <input data-no="35-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="35-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="35-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-36">
                                                                <input data-no="36-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="36-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="36-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-37">
                                                                <input data-no="37-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="37-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="37-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-38">
                                                                <input data-no="38-1" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="38-2" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="38-3" value="0" class="probingdepth-lingual text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Lingual</span></td>
                                                            
                                                            <td class="cellno-48">
                                                                <a href="#!" class="remarks_btn" data-no="48" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:26px;left:10px;">
                                                                        <div class="lingual-top-48"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethtop lingual-top" data-no="48" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-1.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-47">
                                                                <a href="#!" class="remarks_btn" data-no="47" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:26px;left:12px;">
                                                                        <div class="lingual-top-47"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethtop lingual-top" data-no="47" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-2.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-46">
                                                                <a href="#!" class="remarks_btn" data-no="46" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:11px;">
                                                                        <div class="lingual-top-46"> </div>
                                                                    </div>
                                                                </div>
                                                                <img class="teethtop lingual-top" data-no="46" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-3.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-45">
                                                                <a href="#!" class="remarks_btn" data-no="45" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="45" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-4.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-44">
                                                                <a href="#!" class="remarks_btn" data-no="44" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="44" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-5.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-43">
                                                                <a href="#!" class="remarks_btn" data-no="43" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="43" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-6.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-42">
                                                                <a href="#!" class="remarks_btn" data-no="42" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="42" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-7.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-41">
                                                                <a href="#!" class="remarks_btn" data-no="41" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="41" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-8.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-31"> 
                                                                <a href="#!" class="remarks_btn" data-no="31" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="31" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-9.png" alt="">
                                                                </a>
                                                                
                                                            </td>
                                                            <td class="cellno-32">
                                                                <a href="#!" class="remarks_btn" data-no="32" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="32" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-10.png" alt="">
                                                                </a>
                                                                
                                                            </td>
                                                            <td class="cellno-33">
                                                                <a href="#!" class="remarks_btn" data-no="33" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="33" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-11.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-34">
                                                                <a href="#!" class="remarks_btn" data-no="34" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="34" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-12.png" alt="">
                                                                </a>  
                                                            </td>
                                                            <td class="cellno-35">
                                                                <a href="#!" class="remarks_btn" data-no="35" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethtop lingual-top" data-no="35" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-13.png" alt="">
                                                                </a>
                                                                
                                                            </td>
                                                            <td class="cellno-36">
                                                                <a href="#!" class="remarks_btn" data-no="36" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:30px;left:15px;">
                                                                        <div class="lingual-top-36"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethtop lingual-top" data-no="36" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-14.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-37">
                                                                <a href="#!" class="remarks_btn" data-no="37" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:25px;left:11px;">
                                                                        <div class="lingual-top-37"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethtop lingual-top" data-no="37" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-15.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-38">
                                                                <a href="#!" class="remarks_btn" data-no="38" data-type="lingual" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:26px;left:17px;">
                                                                        <div class="lingual-top-38"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethtop lingual-top" data-no="38" src="<?php base_url();?>/assets/images/teeth_set/teethtop2-16.png" alt="">
                                                                </a> 
                                                            </td> 
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Buccal</span></td>
                                                            <td class="cellno-48">
                                                                <a href="#!" class="remarks_btn" data-no="48" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:37px;left:9px;">
                                                                        <div class="buccal-bot-48"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethbot buccal-bot" data-no="48" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-1.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-47">
                                                                <a href="#!" class="remarks_btn" data-no="47" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:37px;left:11px;">
                                                                        <div class="buccal-bot-47"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethbot buccal-bot" data-no="47" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-2.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-46">
                                                                <a href="#!" class="remarks_btn" data-no="46" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:35px;left:14px;">
                                                                        <div class="buccal-bot-46"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethbot buccal-bot" data-no="46" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-3.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-45">
                                                                <a href="#!" class="remarks_btn" data-no="45" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="45" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-4.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-44">
                                                                <a href="#!" class="remarks_btn" data-no="44" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="44" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-5.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-43">
                                                                <a href="#!" class="remarks_btn" data-no="43" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="43" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-6.png" alt="">
                                                                </a>
                                                            </td>
                                                            <td class="cellno-42">
                                                                <a href="#!" class="remarks_btn" data-no="42" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="42" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-7.png" alt="">
                                                                </a>
                                                                
                                                            </td>
                                                            <td class="cellno-41">
                                                                <a href="#!" class="remarks_btn" data-no="41" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="41" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-8.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-31"> 
                                                                <a href="#!" class="remarks_btn" data-no="31" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="31" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-9.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-32">
                                                                <a href="#!" class="remarks_btn" data-no="32" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="32" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-10.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-33">
                                                                <a href="#!" class="remarks_btn" data-no="33" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="33" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-11.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-34">
                                                                <a href="#!" class="remarks_btn" data-no="34" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="34" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-12.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-35">
                                                                <a href="#!" class="remarks_btn" data-no="35" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <img class="teethbot buccal-bot" data-no="35" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-13.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-36">
                                                                <a href="#!" class="remarks_btn" data-no="36" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:35px;left:11px;">
                                                                        <div class="buccal-bot-36"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethbot buccal-bot" data-no="36" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-14.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-37">
                                                                <a href="#!" class="remarks_btn" data-no="37" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:35px;left:11px;">
                                                                        <div class="buccal-bot-37"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethbot buccal-bot" data-no="37" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-15.png" alt="">
                                                                </a> 
                                                            </td>
                                                            <td class="cellno-38">
                                                                <a href="#!" class="remarks_btn" data-no="38" data-type="buccal-bot" data-bs-toggle="modal" data-bs-target="#remarks_modal">
                                                                <div style="position:absolute;">
                                                                    <div style="position: absolute;top:35px;left:13px;">
                                                                        <div class="buccal-bot-38"> </div>
                                                                    </div>
                                                                </div> 
                                                                <img class="teethbot buccal-bot" data-no="38" src="<?php base_url();?>/assets/images/teeth_set/teethbot2-16.png" alt="">
                                                                </a> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Gingival Margin</span></td> 
                                                            <td class="cellno-48">
                                                                <input data-no="48-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="48-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="48-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-47">
                                                                <input data-no="47-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="47-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="47-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-46">
                                                                <input data-no="46-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="46-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="46-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-45">
                                                                <input data-no="45-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="45-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="45-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-44">
                                                                <input data-no="44-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="44-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="44-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-43">
                                                                <input data-no="43-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="43-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="43-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-42">
                                                                <input data-no="42-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="42-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="42-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-41">
                                                                <input data-no="41-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="41-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="41-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-31">
                                                                <input data-no="31-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="31-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="31-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-32">
                                                                <input data-no="32-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="32-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="32-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-33">
                                                                <input data-no="33-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="33-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="33-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-34">
                                                                <input data-no="34-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="34-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="34-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-35">
                                                                <input data-no="35-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="35-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="35-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-36">
                                                                <input data-no="36-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="36-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="36-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-37">
                                                                <input data-no="37-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="37-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="37-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-38">
                                                                <input data-no="38-1" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="38-2" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="38-3" value="0" class="gingivalmargin-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Probing Depth</span></td> 
                                                            <td class="cellno-48">
                                                                <input data-no="48-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="48-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="48-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-47">
                                                                <input data-no="47-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="47-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="47-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-46">
                                                                <input data-no="46-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="46-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="46-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-45">
                                                                <input data-no="45-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="45-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="45-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-44">
                                                                <input data-no="44-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="44-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="44-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-43">
                                                                <input data-no="43-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="43-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="43-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-42">
                                                                <input data-no="42-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="42-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="42-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-41">
                                                                <input data-no="41-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="41-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="41-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td></td>
                                                            <td class="cellno-31">
                                                                <input data-no="31-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="31-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="31-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-32">
                                                                <input data-no="32-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="32-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="32-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-33">
                                                                <input data-no="33-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="33-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="33-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-34">
                                                                <input data-no="34-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="34-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="34-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-35">
                                                                <input data-no="35-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="35-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="35-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-36">
                                                                <input data-no="36-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="36-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="36-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-37">
                                                                <input data-no="37-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="37-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="37-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                            <td class="cellno-38">
                                                                <input data-no="38-1" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="38-2" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                                <input data-no="38-3" value="0" class="probingdepth-buccal-bot text-center form-control"  type="number" min="0" max="3" step="1"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Plaque</span></td>
                                                            <td class="text-center cellno-48"> 
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="48-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="48-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="48-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-47"> 
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="47-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="47-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="47-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-46">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="46-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="46-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="46-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-45">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="45-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="45-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="45-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-44">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="44-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="44-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="44-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-43">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="43-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="43-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="43-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-42">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="42-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="42-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="42-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-41">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="41-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="41-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="41-3"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-31">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="31-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="31-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="31-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-32">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="32-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="32-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="32-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-33">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="33-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="33-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="33-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-34">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="34-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="34-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="34-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-35">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="35-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="35-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="35-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-36">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="36-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="36-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="36-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-37">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="37-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="37-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="37-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-38">
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="38-1"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="38-2"></button>
                                                                <button class="mb-1 btn btn-light plaque plaque-buccal-bot" value="0" data-no="38-3"></button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Bleeding on Probing</span></td>
                                                            <td class="text-center cellno-48"> 
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="48-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="48-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="48-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-47"> 
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="47-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="47-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="47-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-46">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="46-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="46-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="46-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-45">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="45-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="45-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="45-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-44">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="44-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="44-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="44-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-43">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="43-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="43-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="43-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-42">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="42-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="42-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="42-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-41">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="41-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="41-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="41-3"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-31">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="31-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="31-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="31-3"></button>
                                                            </td> 
                                                            <td class="text-center cellno-32">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="32-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="32-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="32-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-33">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="33-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="33-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="33-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-34">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="34-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="34-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="34-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-35">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="35-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="35-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="35-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-36">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="36-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="36-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="36-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-37">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="37-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="37-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="37-3"></button>
                                                            </td>
                                                            <td class="text-center cellno-38">
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="38-1"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="38-2"></button>
                                                                <button class="mb-1 btn btn-light bleed bleed-buccal-bot" value="0" data-no="38-3"></button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Furcation</span></td>
                                                            <td class="text-center cellno-48">
                                                                <button value="0" data-no="48" data-type="buccal-bot" class="furcation">
                                                                    <svg class="circle-svg" xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-47">
                                                                <button value="0" data-no="47" data-type="buccal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-46">
                                                                <button value="0" data-no="46" data-type="buccal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-45">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-44">
                                                            
                                                            </td>
                                                            <td class="text-center cellno-43">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-42">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-41"> 
                                                            </td>
                                                            <td></td> 
                                                            <td class="text-center cellno-31">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-32">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-33">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-34">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-35">
                                                                
                                                            </td>
                                                            <td class="text-center cellno-36">
                                                                <button value="0" data-no="36" data-type="buccal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-37">
                                                                <button value="0" data-no="37" data-type="buccal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <td class="text-center cellno-38">
                                                                <button value="0" data-no="38" data-type="buccal-bot" class="furcation">
                                                                    <svg class="circle-svg"  xmlns="http://www.w3.org/2000/svg">
                                                                        <!-- Blank SVG with no content -->
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr id="implants">
                                                            <td class="text-center"><span class="mt-10 fw-bold">Implant</span></td>
                                                            <td class="text-center cellno-48">
                                                                <button class="btn btn-light implant-bot" data-no="48" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-47">
                                                                <button class="btn btn-light implant-bot" data-no="47" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-46">
                                                                <button class="btn btn-light implant-bot" data-no="46" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-45">
                                                                <button class="btn btn-light implant-bot" data-no="45" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-44">
                                                                <button class="btn btn-light implant-bot" data-no="44" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-43">
                                                                <button class="btn btn-light implant-bot" data-no="43" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-42">
                                                                <button class="btn btn-light implant-bot" data-no="42" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-41">
                                                                <button class="btn btn-light implant-bot" data-no="41" value="0"></button>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-center cellno-31">
                                                                <button class="btn btn-light implant-bot" data-no="31" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-32">
                                                                <button class="btn btn-light implant-bot" data-no="32" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-33">
                                                                <button class="btn btn-light implant-bot" data-no="33" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-34">
                                                                <button class="btn btn-light implant-bot" data-no="34" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-35">
                                                                <button class="btn btn-light implant-bot" data-no="35" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-36">
                                                                <button class="btn btn-light implant-bot" data-no="36" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-37">
                                                                <button class="btn btn-light implant-bot" data-no="37" value="0"></button>
                                                            </td>
                                                            <td class="text-center cellno-38">
                                                                <button class="btn btn-light implant-bot" data-no="38" value="0"></button>
                                                            </td> 
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><span class="mt-10 fw-bold">Mobility</span></td>
                                                            
                                                            <td class="text-center cellno-48">
                                                                <input value="0" class="mobility form-control" data-no="48"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-47">
                                                                <input value="0" class="mobility form-control" data-no="47"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-46">
                                                                <input value="0" class="mobility form-control" data-no="46"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-45">
                                                                <input value="0" class="mobility form-control" data-no="45"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-44">
                                                                <input value="0" class="mobility form-control" data-no="44"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-43">
                                                                <input value="0" class="mobility form-control" data-no="43"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-42">
                                                                <input value="0" class="mobility form-control" data-no="42"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-41">
                                                                <input value="0" class="mobility form-control" data-no="41"  type="number" min="0" max="3" step="1">
                                                            </td>

                                                            <td></td>

                                                            <td class="text-center cellno-31">
                                                                <input value="0" class="mobility form-control" data-no="31"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-32">
                                                                <input value="0" class="mobility form-control" data-no="32"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-33">
                                                                <input value="0" class="mobility form-control" data-no="33"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-34">
                                                                <input value="0" class="mobility form-control" data-no="34"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-35">
                                                                <input value="0" class="mobility form-control" data-no="35"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-36">
                                                                <input value="0" class="mobility form-control" data-no="36"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-37">
                                                                <input value="0" class="mobility form-control" data-no="37"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                            <td class="text-center cellno-38">
                                                                <input value="0" class="mobility form-control" data-no="38"  type="number" min="0" max="3" step="1">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="48" data-value="0"> 48 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="47" data-value="0"> 47 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="46" data-value="0"> 46 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="45" data-value="0"> 45 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="44" data-value="0"> 44 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="43" data-value="0"> 43 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="42" data-value="0"> 42 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="41" data-value="0"> 41 </a> </th>
                                                            <th></th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="31" data-value="0"> 31 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="32" data-value="0"> 32 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="33" data-value="0"> 33 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="34" data-value="0"> 34 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="35" data-value="0"> 35 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="36" data-value="0"> 36 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="37" data-value="0"> 37 </a> </th>
                                                            <th class="text-center"> <a href="#!" class="maintoothlabel badge text-bg-primary" data-no="38" data-value="0"> 38 </a> </th>
                                                        </tr>
                                                    </tbody>
                                                </table> 
                                                
                                            </div>   
                                        </div>
                                    </div>
                                </div> 
                                <div class="row mt-5">
                                    <div class="col-lg-12">
                                        <div class="form-group text-end">
                                            <!-- btn btn-info btn-sm -->
                                            <a class="btn btn-sm btn-dark" href="#!" id="download-img">Download as Image</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-5">
                                        <div class="form-group text-end">
                                            
                                            <a class="btn btn-sm btn-dark" href="#!" data-bs-toggle="modal" data-bs-target="#treatmentnotes_modal">Generate Treatment Notes</a>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row mt-5">
                                    <div class="col-lg-12">
                                        <div class="form-group text-center">
                                            <a id="submit_periodontalchart" href="#!" class="btn btn-success btn-sm">Submit</a>
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

<div class="modal fade" id="remarks_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remarks for <span class="type_label"></span> #<span class="tooth_no_label">1</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="submit_remarks" action="#!" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <textarea rows="10" name="i_remarks" id="i_remarks" class="form-control"></textarea>
                                <input type="hidden" class="form-control" name="i_tooth_no" id="i_tooth_no">
                                <input type="hidden" class="form-control" name="i_type" id="i_type">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="treatmentnotes_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Treatment Notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="generate_treatmentnotes" action="#!" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tn_date_from" class="fw-bold">From : </label>
                                <input type="date" name="tn_date_from" id="tn_date_from" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <label for="tn_date_to" class="fw-bold">To : </label>
                                <input type="date" name="tn_date_to" id="tn_date_to" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm">Generate</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('core/footer')  ?>
