<?= $this->include('core/header') ?>
<?= $this->include('core/toolbar') ?>
<?= $this->include('core/sidebar') ?>


<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
                <div class="page-title d-flex flex-column justify-content-start flex-wrap me-3 ">
                    <div class="card">
                        <div class="card-body p-md-3">
                            <h1
                                class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-start my-0">
                                Menu & Roles
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn-shadow btn btn-primary" onclick="openModal()">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        List of Menu
                    </button>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container  container-fluid ">
                <!--begin::Row-->
                <div id="loadRolesList" class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">


                </div>
            </div>
        </div>
    </div>
</div>




<?= $this->include('Pages/Maintenance/Menu/modal/listofmenu') ?>
<?= $this->include('Pages/Maintenance/Menu/modal/createMenuModal') ?>
<?= $this->include('Pages/Maintenance/Menu/modal/updateMenuModal') ?>

<?= $this->include('Pages/Maintenance/Menu/rolesModal/updateRoleModal') ?>
<?= $this->include('Pages/Maintenance/Menu/rolesModal/addRoleModal') ?>

<?= $this->include('core/footer') ?>


<script>

    updateParentMenu();
    updateGetIcon();
    loadListOfRoles();

    function openModal() {
        $('#CompanyModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '98%');

        loadListOfMenu();

    }

    function createModal() {

        $('#createMenuModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '30%');
        $('#CompanyModal').modal('hide')

        loadParentMenu();
        loadGetIcon();
    }


    function updateRoleModal(rolesId, AccessName) {
        $('#updateRoleModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '60%');

        loadParentMenuByRoles(rolesId);
        $('#roleId').val(rolesId)
        $('#roleNameId').val(AccessName)

    }

    function addRoleModal() {
        $('#addRoleModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '30%');
    }

    function loadListOfRoles() {
        get('<?= route_to('getRoles'); ?>', function (res) {
            rolesListExtract(res)
            Swal.close();
        });
    }

    function rolesListExtract(res) {
        $('#loadRolesList').empty();
        $('#loadRolesList').append(`
                        <div class="ol-md-4">
                            <!--begin::Card-->
                            <div class="card h-md-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-clear d-flex flex-column flex-center" onclick="addRoleModal()">
                                        <!--begin::Illustration-->
                                        <img src="assets/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7"/>
                                        <!--end::Illustration-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                                        <!--end::Label-->
                                    </button>
                                    <!--begin::Button-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--begin::Add new card-->`
        );
        res.forEach(item => {
            $('#loadRolesList').append(
                `  <!--begin::Col-->
                        <div class="col-md-4">
                            <!--begin::Card-->
                            <div class="card card-flush h-md-100">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>${item.grp_name}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-clear d-flex flex-column flex-center" onclick="updateRoleModal('${item.RecID}','${item.grp_name}')">
                                        <!--begin::Illustration-->
                                        <img src="assets/media/illustrations/sketchy-1/22.png" alt="" class="mw-100 mh-150px mb-7"/>
                                        <!--end::Illustration-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Update Role</div>
                                        <!--end::Label-->
                                    </button>
                                    <!--begin::Button-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->`
            )
        })

    }


</script>