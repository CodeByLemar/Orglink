
<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<?= $this->include('script/AppointmentCalendar_script')  ?>

<!--begin::Main-->
<style>
    th {
        font-size: 15px !important;
    }
    
    input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
         -webkit-appearance: none;
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

<div class="modal fade" id="app_calendar_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                                <option value="Client 1">Client 1</option>
                                <option value="Client 2">Client 2</option>
                                <option value="Client 3">Client 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="fw-bold" for="app_operation">Operation:</label> 

                            <select name="app_operation" id="app_operation" class="form-control">
                                <option value="">- Select -</option>
                                <option value="Operation1-3">Operation 1</option>
                                <option value="Operation2-2">Operation 2</option>
                                <option value="Operation5-3">Operation 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="fw-bold" for="app_dentist">Dentist in charge:</label>
                            <select name="app_dentist" id="app_dentist" class="form-control">
                                <option value="">- Select -</option>
                                <option value="Mariano Gomez">Mariano Gomez</option>
                                <option value="Jose Burgos">Jose Burgos</option>
                                <option value="Jacinto Zamora">Jacinto Zamora</option>
                                <option value="Severino Mallari">Severino Mallari</option>
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="fw-bold" for="app_duration">Duration (Hrs):</label>
                            <input type="number" class="form-control" name="app_duration" id="app_duration">
                        </div> 
                    </div> 
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="fw-bold" for="app_room">Room:</label>
                            <select class="form-control" name="app_room" id="app_room">
                                <option value="">- Select -</option>
                                <option value="Room1">Room1</option>
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

 <?= $this->include('core/footer')  ?>


