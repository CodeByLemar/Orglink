
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('script/Acquainted')  ?>

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
                                Acquainted Sheet
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
        <!-- <form action="<?php echo base_url('Operations/submit_clientinfo');?>" method="POST"> -->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
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
                                        <!--begin::Number-->
                                        <span class="text-center fw-bold fs-2x text-gray-800 lh-1 ls-n2 mb-3">Acquainted Sheet</span>
                                        <hr>
                                        <!--end::Number-->
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-6">
                                            <label for="search_patient" class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2">Search (If existing patient) </label>
                                            <input type="text" class="form-control" name="search_patient" id="search_patient" placeholder="Search Patient Name">
                                        </div>    
                                        <div class="col-lg-12"><hr></div> 
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-3">
                                            <!--begin::Number-->
                                            <label for="FirstName" class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2">First Name </label>
                                            <input type="text" class="form-control" id="FirstName" name="FirstName">
                                            <!--end::Number-->
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-3">
                                            <!--begin::Number-->
                                            <label for="FirstName" class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2">Middle Name </label>
                                            <input type="text" class="form-control" id="MiddleName" name="MiddleName">
                                            <!--end::Number-->
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-3">
                                            <!--begin::Number-->
                                            <label for="LastName" class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2">Last Name </label>
                                            <input type="text" class="form-control" id="LastName" name="LastName">
                                            <!--end::Number-->
                                        </div>
                                        
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <!--begin::Number-->
                                            <label for="ExtName" class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2">Extension Name </label>
                                            <input type="text" class="form-control" id="ExtName" name="ExtName">
                                            <!--end::Number-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label for="BirthDate" class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="BirthDate">Birth Date </label>
                                            <input type="date" class="form-control" id="BirthDate" name="BirthDate">
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label for="Gender" class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="Gender">Gender </label>
                                            <select name="Gender" id="Gender" class="form-control">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="Religion">Religion </label>
                                            <input type="text" class="form-control" id="Religion" name="Religion">
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="Nationality">Nationality </label>
                                            <input type="text" class="form-control" id="Nationality" name="Nationality">
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex flex-column mt-4">
                                        <!--begin::Number-->
                                        <span class="text-gray-800 lh-1 ls-n2 fs-2 mt-2 fw-semibold">Home Address</span>
                                        <!--end::Number-->
                                    </div>

                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-3">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="Province">Province </label>
                                            <select class="form-control" name="Province" id="Province">
                                                <option value="">- Select -</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-3">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="City">City </label>
                                            <select class="form-control" name="City" id="City">
                                                <option value="">- Select -</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-3">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="Barangay">Barangay </label>
                                            <select class="form-control" name="Barangay" id="Barangay">
                                                <option value="">- Select -</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-3">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="Street">Street </label>
                                            <input type="text" class="form-control" name="Street" id="Street">
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column mt-4">
                                        <!--begin::Number-->
                                        <span class="text-gray-800 lh-1 ls-n2 fs-2 mt-2 fw-semibold">Contact Details</span>
                                        <!--end::Number-->
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="TelNo">Telephone No.</label>
                                            <input type="text" class="form-control" id="TelNo" name="TelNo">
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="MobileNo">Mobile No. </label>
                                            <input type="text" class="form-control" id="MobileNo" name="MobileNo">
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="EmailAdd">E-mail Address </label>
                                            <input type="email" class="form-control" id="EmailAdd" name="EmailAdd">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="Occupation">Occupation</label>
                                            <input type="text" class="form-control" id="Occupation" name="Occupation">
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="OfficeAdd">Office Address</label>
                                            <input type="text" class="form-control" id="OfficeAdd" name="OfficeAdd">
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="OfficeTelNo">Office Tel. No</label>
                                            <input type="text" class="form-control" id="OfficeTelNo" name="OfficeTelNo">
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-4">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="PersonResponsible">Person responsible for the account</label>
                                            <input type="text" class="form-control" id="PersonResponsible" name="PersonResponsible">
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-8">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="PersonResponsibleAdd">Address</label>
                                            <input type="text" class="form-control" id="PersonResponsibleAdd" name="PersonResponsibleAdd">
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-5">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="ReferredBy">Referred By</label>
                                            <input type="text" class="form-control" id="ReferredBy" name="ReferredBy">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4">
                                            <!--begin::Number-->
                                            <span class="text-gray-800 lh-1 ls-n2 fs-2 mt-2 fw-semibold">For minority</span>
                                            <!--end::Number-->
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-6">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="Guardian">Parent/Guardian Name</label>
                                            <input type="text" class="form-control" id="Guardian">
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-6">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="GuardianOccupation">Occupation</label>
                                            <input type="text" class="form-control" id="GuardianOccupation">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-12">
                                            <label class="fw-semibold text-gray-800 lh-1 ls-n2 mb-2" for="GuardianReason">What is your reason for dental consultation?</label>
                                            <input type="text" class="form-control" id="GuardianReason">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 2-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row gy-5 g-xl-9">
                        <!--begin::Col-->
                        <div class="col-sm-6 col-xl-12 mb-xl-10">
                            <!--begin::Card widget 2-->
                            <div class="card h-lg-100 shadow-lg">
                                <!--begin::Body-->
                                
                                <div class="card-body d-flex justify-content-between flex-column">
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Number-->
                                        <span class="text-center fw-bold fs-2x text-gray-800 lh-1 ls-n2 mb-3">Medical History</span>
                                        <hr>
                                        <!--end::Number-->
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-8">
                                            <p>1.) Are you in good general health?</p>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q1">
                                            <input class="form-check-input" type="radio" name="Q1" id="Q1" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q1">
                                            <input class="form-check-input" type="radio" name="Q1" id="Q1" value="0"> <span class="ms-2">No</span> </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-8">
                                            <p>2.) Are you under medical treatment now?</p>
                                            <div id="medhis2_div" class="mt-4 col-lg-5">
                                                <p for="Q2_Remarks">If yes, What is the condition being treated?</p>
                                                <input type="text" class="form-control" id="Q2_Remarks">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q2">
                                            <input class="form-check-input" type="radio" name="Q2" id="Q2" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q2">
                                            <input class="form-check-input" type="radio" name="Q2" id="Q2" value="0"> <span class="ms-2">No</span> </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-8">
                                            <p>3.) Have you ever had serious illness or surgical operation?</p>
                                            <div id="medhis3_div" class="mt-4 col-lg-5">
                                                <p for="Q3_Remarks">If yes, What illness or operation?</p>
                                                <input type="text" class="form-control" id="Q3_Remarks">
                                            </div>
                                        </div>  
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q3">
                                            <input class="form-check-input" type="radio" name="Q3" id="Q3" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q3">
                                            <input class="form-check-input" type="radio" name="Q3" id="Q3" value="0"> <span class="ms-2">No</span> </label>
                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-8">
                                            <p>4.) Have you ever had been hospitalized?</p>
                                            <div id="medhis4_div" class="mt-4 col-lg-5">
                                                <p for="MedHis4Specify">If yes, When and why?</p>
                                                <input type="text" class="form-control" id="Q4_Remarks">
                                            </div>
                                        </div>  
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q4">
                                            <input class="form-check-input" type="radio" name="Q4" id="Q4" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q4">
                                            <input class="form-check-input" type="radio" name="Q4" id="Q4" value="0"> <span class="ms-2">No</span> </label>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-8">
                                            <p>5.) Are you taking any prescription/ non-prescription medication?</p>
                                            <div id="medhis5_div" class="mt-4 col-lg-5">
                                                <p for="Q5_Remarks">If yes, Please specify</p>
                                                <input type="text" class="form-control" id="Q5_Remarks">
                                            </div>
                                        </div>  
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q5">
                                            <input class="form-check-input" type="radio" name="Q5" id="Q5" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q5">
                                            <input class="form-check-input" type="radio" name="Q5" id="Q5" value="0"> <span class="ms-2">No</span> </label>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-8">
                                            <p>6.) Do you use tabacco products?</p>
                                        </div>  
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q6">
                                            <input class="form-check-input" type="radio" name="Q6" id="Q6" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q6">
                                            <input class="form-check-input" type="radio" name="Q6" id="Q6" value="0"> <span class="ms-2">No</span> </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-8">
                                            <p>7.) Do you use alcohol, cocaine or other dangerous drugs?</p>
                                        </div>  
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q7">
                                            <input class="form-check-input" type="radio" name="Q7" id="Q7" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class="d-flex flex-column mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q7">
                                            <input class="form-check-input" type="radio" name="Q7" id="Q7" value="0"> <span class="ms-2">No</span> </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-6">
                                            <p>8.) Are you allergic to any of the following?</p> 
                                            <select multiple class="form-control" name="Q8" id="Q8"> 
                                                <option value="Local Anesthetic">Local Anesthetic</option>
                                                <option value="Sulfa Drugs">Sulfa Drugs</option>
                                                <option value="Aspirin">Aspirin</option>
                                                <option value="Antibiotics (ex. Penicillin)">Antibiotics (ex. Penicillin)</option>
                                                <option value="Latex">Latex</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="female_div mt-4">
                                        <!--begin::Number-->
                                        <hr>
                                        <span class="text-gray-800 lh-1 ls-n2 fs-2 mt-2 fw-semibold">For Women Only</span>
                                        
                                        <!--end::Number-->
                                    </div>
                                    <div class="female_div row">
                                        <div class="mt-4 col-lg-8">
                                            <p>9.) Are you pregnant? </p>  
                                        </div>
                                        <div class=" mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q9">
                                            <input class="form-check-input" type="radio" name="Q9" id="Q9" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class=" mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q9">
                                            <input class="form-check-input" type="radio" name="Q9" id="Q9" value="0"> <span class="ms-2">No</span> </label>
                                        </div>
                                    </div>
                                    <div class="female_div row">
                                        <div class="  mt-4 col-lg-8">
                                            <p>9.1) Are you nursing? </p>  
                                        </div>
                                        <div class="  mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q9_1">
                                            <input class="form-check-input" type="radio" name="Q9_1" id="Q9_1" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class=" mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q9_1">
                                            <input class="form-check-input" type="radio" name="Q9_1" id="Q9_1" value="0"> <span class="ms-2">No</span> </label>
                                        </div>
                                    </div>
                                    <div class="female_div row">
                                        <div class=" mt-4 col-lg-8">
                                            <p>9.2) Are you taking birth controls? </p>  
                                        </div>
                                        <div class=" mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q9_2">
                                            <input class="form-check-input" type="radio" name="Q9_2" id="Q9_2" value="1"> <span class="ms-2">Yes</span> </label>
                                        </div>
                                        <div class=" mt-4 col-lg-2">
                                            <label class="form-check-label fw-semibold text-gray-800 lh-1 ls-n2" for="Q9_2">
                                            <input class="form-check-input" type="radio" name="Q9_2" id="Q9_2" value="0"> <span class="ms-2">No</span> </label>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-4"> 
                                            <p>10.) Blood Type </p> 
                                            <select class="form-control" name="Q10" id="Q10">
                                                <option value="">- Select -</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                                <option value="+A">+A</option>
                                                <option value="+B">+B</option>
                                                <option value="+O">+O</option>
                                                <option value="-B">-B</option>
                                                <option value="-O">-O</option>
                                            </select> 
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-4"> 
                                            <p>11.) Blood Pressure </p> 
                                            <input type="text" class="form-control" id="Q11" name="Q11">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column mt-4 col-lg-6"> 
                                            <p>12.) Do you have or have you had any of the following? </p> 
                                            <select multiple class="form-control" name="Q12" id="Q12"> 
                                                <option value="High Blood Pressure">High Blood Pressure</option>
                                                <option value="Low Blood Pressure">Low Blood Pressure</option>
                                                <option value="Epilepsy/Convulsions">Epilepsy/Convulsions</option>
                                                <option value="AIDS or HIV Infection">AIDS or HIV Infection</option>
                                                <option value="Sexually Transmitted Disease">Sexually Transmitted Disease</option>
                                                <option value="Stomach Troubles/Ulcers">Stomach Troubles/Ulcers</option>
                                                <option value="Fainting Seizure">Fainting Seizure</option>
                                                <option value="Rapid Weight Loss">Rapid Weight Loss</option>
                                                <option value="Radiation Therapy">Radiation Therapy</option>
                                                <option value="Joint Replacement/Implant">Joint Replacement/Implant</option>
                                                <option value="Heart Surgery">Heart Surgery</option>
                                                <option value="Heart Attack">Heart Attack</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="d-flex flex-column">
                                        <!--begin::Number-->
                                        <hr>
                                        <div class="d-flex flex-column mt-4 offset-lg-3 col-lg-6">
                                            <button id="submit_client" type="submit" class="btn btn-success btn-lg mt-3">Submit Information</button>
                                        </div>
                                        
                                        <!--end::Number-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->

                </div>
            </div> 
        <!-- </form> -->
 <?= $this->include('core/footer')  ?>


