<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyHeaderId">Access Rights</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 150px;">

                <!--begin::Form-->
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll">
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bold form-label mb-2">
                            <span class="required">Role name</span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="form-control form-control-solid" id="createRoleNameId" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                </div>
                <!--end::Scroll-->

                <!--end::Form-->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light me-3 btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary me-3 btn-sm" id="btnCreateRole">Submit</button>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#btnCreateRole').click(function () {

            const data = {
                'RoleName': $('#createRoleNameId').val()
            }


            post('<?= route_to('createRole'); ?>', data, function (res) {

                if (res.status == 200) {
                    $('#addRoleModal').modal('hide')
                    loadListOfRoles();
                }

                const AlertResult = {
                    'tittle': res.title,
                    'icon': res.status == 200 ? 'success' : 'warning',
                    'Message': res.Message
                };
                Message_Result(AlertResult)


            });
        });





    });
</script>