<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 " >
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
                <div  class="page-title d-flex flex-column justify-content-start flex-wrap me-3 ">
                    <div class="card">
                        <div class="card-body p-md-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-start my-0">
                               User Management
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn-shadow btn btn-primary" onclick="openCreateModal()">
                           <span class="btn-icon-wrapper pr-2 opacity-7">
                                 <i class="fa fa-user-plus fa-w-20"></i>
                           </span>
                       Create User
                    </button>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid " >
            <div id="kt_app_content_container" class="app-container  container-fluid ">
                <div class="card ">
                    <div class="card-body p-0">
                        <br>
                        <div class="card-px text-start py-1 my-1">
                            <div class="table-responsive">
                                <table style="width: 100%;" class="table table-hover table-striped table-bordered"
                                       id="userManagementTable">
                                    <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Full Name</th>
                                        <th>User Group</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<?= $this->include('core/footer')  ?>
<?= $this->include('Pages/Maintenance/user_management/modal/createUser') ?>
<?= $this->include('Pages/Maintenance/user_management/modal/updateUser') ?>
<?= $this->include('Pages/Maintenance/user_management/modal/resetPasswordModal') ?>
<script>
    loadUsers();
    
    function openCreateModal(){
        $('#createUserModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '60%');
        loadCreateListOfRoles()

    }

    function openUpdateModal(id,username,rolesId,email,phone,status,firstname,middlename,lastname,comms,color){

        $('#createUpdateModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '60%');

        updateLoadListOfRoles(rolesId)

        $('#update_recId').val(id)
        $('#update_firstNameId').val(firstname)
        $('#update_middleNameId').val(middlename)
        $('#update_lastNameId').val(lastname)
        $('#update_userNameId').val(username)
        $('#update_emailId').val(email)
        $('#update_phoneId').val(phone)
        $('#update_statusId').val(status)
 
        $('#update_Comms').val(comms)
        $('#update_colorTagging').val(color)
    }



    function openResetPasswordModal(id){
        $('#resetPasswordModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '35%');

        $('#update_recId').val(id)

        $('#submitResetPassword').show();
        $('#resetPasswordId').val(null)
        $('#generateResetPassword').prop('disabled', false);
    }
    
    const userManagementTable = $('#userManagementTable').DataTable({ ordering: false,
        responsive: true,
        retrieve: true,
        dom: 'Bfrtip',
        buttons: [
             
            // {
            //     extend: "pdfHtml5",
            //     className: 'btn btn-danger',
            //     text: 'Generate PDF',
            //     init: function(api, node, config) {
            //         $(node).removeClass('dt-button buttons-pdf buttons-html5')
            //     }
            // },
            // {
            //     extend: "copyHtml5",
            //     className: 'btn btn-secondary',
            //     init: function(api, node, config) {
            //         $(node).removeClass('dt-button buttons-copy buttons-html5')
            //     }
            // },
            // {
            //     extend: "excelHtml5",
            //     className: 'btn btn-success',
            //     init: function(api, node, config) {
            //         $(node).removeClass('dt-button buttons-excel buttons-html5')
            //     }
            // },
            // {
            //     extend: "csvHtml5",
            //     className: 'btn btn-warning',
            //     init: function(api, node, config) {
            //         $(node).removeClass('dt-button buttons-csv buttons-html5')
            //     }
            // }
        ]
    });
    function loadUsers(){
        get('<?= route_to('getUsers'); ?>', function(res) {
            parseUsers(res)
            console.log(res);
            Swal.close();
        });
    }

    function parseUsers(res){

        userManagementTable.clear().draw();
        if (res.length > 0) {
            const dataToAdd = res.map(row => [
                `<b>${row.USERNAME}</b>`,
                `<b>${row.FULLNAME}</b>`,
                `<b>${row.grp_name}</b>`,
                `<b>${row.EMAIL_ADD}</b>`,
                `<span class="badge py-3 px-4 fs-7 badge-light-${row.STATUS == 1 ? 'success' : 'danger'}">${row.STATUS == 1 ? 'Active' : 'Deactivate'}</span>`,
                `<button class="btn btn-primary btn-sm" onclick="openUpdateModal('${row.DID}','${row.USERNAME}','${row.RecID}','${row.EMAIL_ADD}','${row.PhoneNum}','${row.STATUS}','${row.FirstName}','${row.MiddleName}','${row.LastName}','${row.Commission_Percentage}','${row.Color_Tagging}')"><span class="fas fa-pencil"></span></button>
                <button class="btn btn-success btn-sm" onclick="openResetPasswordModal('${row.DID}')"><span class="fas fa-lock"></span></button>
                `
            ]);
            
            
            userManagementTable.rows.add(dataToAdd).draw();

            Swal.close();
        }else{
            userManagementTable.draw();
        }

    }
</script>