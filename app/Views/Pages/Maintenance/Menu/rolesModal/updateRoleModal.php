<div class="modal fade" id="updateRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            <div class="modal-body" style="height: 450px;overflow: scroll;">

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
                        <input id="roleId" type="hidden">
                        <input class="form-control form-control-solid" id="roleNameId" readonly />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Permissions-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bold form-label mb-2">Access Rights</label>
                        <!--end::Label-->

                        <div class="table-responsive">

                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold" id="tableBodyAccessRights">

                                </tbody>
                            </table>
                        </div>




                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Permissions-->
                </div>
                <!--end::Scroll-->

                <!--end::Form-->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                <button type="button" class="btn btn-primary" id="BtnupdateRolesAccess">Submit <span
                        class="fas fa-save"></span></button>
            </div>
        </div>
    </div>
</div>





<!--accessRightMenuModal-->

<script>

    $(document).ready(function () {

        $('#BtnupdateRolesAccess').click(function () {
            // Array to store checked values
            let checkedValues = [];

            // Iterate over each checkbox
            $('.form-check-input').each(function () {
                if ($(this).prop('checked')) {
                    checkedValues.push($(this).val());
                }
            });

            const data = {
                'AccessGrantedList': checkedValues,
                'rolesId': $('#roleId').val()
            }


            post('<?= route_to('updateRoleAccessRight'); ?>', data, function (res) {
                if (res.status == 200) {
                    $('#updateRoleModal').modal('hide')
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



    function checkParentAndChildAccord(id) {

        if ($('#parent-menu-' + id).is(':checked')) {
            var target = $('#parent-menu-' + id).data('bs-target');
            $(target).collapse('toggle');
            $('.child-menu-' + id).prop('disabled', false); // Enable child menu checkbox
        } else {
            $('.child-menu-' + id).prop('checked', false);
            var target = $('#parent-menu-' + id).data('bs-target');
            $(target).collapse('toggle');
        }


    }


    function openAccessRightUpdate(parentId) {

        $('#accessRightMenuModal').modal('show')
        $('.modal').css({
            'width': '100vw',
            'height': '100vh'
        });
        $('.modal-dialog').css('max-width', '25%');
        $('#updateRoleModal').modal('hide')

        const roleId = $('#roleId').val()

        loadChildrenMenuByRole(roleId, parentId)
        $('#parentIdSaved').val(parentId);

    }

    function loadParentMenuByRoles(rolesId) {

        const data = {
            'rolesId': rolesId
        }

        post("<?= route_to('getParentMenuListByRole'); ?>", data, function (res) {

            extractParentMenuByRoles(res);
            Swal.close();
        });
    }

    function extractParentMenuByRoles(res) {
        $('#tableBodyAccessRights').empty();

        res.forEach(row => {

            if (row.child != null) {

                $('#tableBodyAccessRights').append(

                    `<div class="accordion" id="kt_accordion_1">
                            <div class="accordion-item" >
                                <h2 class="accordion-header" id="kt_accordion_${row.menu_id}" onchange="checkParentAndChildAccord('${row.menu_id}')">
                            

                                <label class="d-flex flex-stack mb-5 cursor-pointer">
                                        <span class="d-flex align-items-center me-2">
                                            <span class="d-flex flex-column">
                                                <span class="fw-bold text-gray-800 text-hover-primary fs-5">${row.Name}</span>
                                            </span>
                                        </span>
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input parent-menu" type="checkbox" id="parent-menu-${row.menu_id}" data-bs-target="#kt-body-${row.menu_id}" aria-controls="kt-body-${row.menu_id}" ${row.RecID == null ? '' : 'checked'} value="${row.menu_id}"/>
                                            <span class="form-check-label">Grant</span>
                                        </label>
                                </h2>
                            
                                <div id="kt-body-${row.menu_id}" class="accordion-collapse collapse ${row.RecID == null ? '' : 'show'}" data-bs-parent="#kt_accordion_1">
                                    
                                </div>
                            </div>
                        </div>`


                );

                let childjson = row.child

                childjson.forEach(function (item) {

                    $('#kt-body-' + row.menu_id).append(

                        `
                        <div class="accordion-body">
                           <label class="d-flex flex-stack mb-5 cursor-pointer">
                                <span class="d-flex align-items-center me-2">
                                    <span class="d-flex flex-column">
                                        <span class="fw-bold text-gray-800 text-hover-primary fs-5">${item.Name}</span>
                                    </span>
                                </span>
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input child-menu-${row.menu_id}"  type="checkbox" ${item.RecID == null ? '' : 'checked'}  value="${item.menu_id}"  ${row.RecID == null ? 'disabled' : ''}/>
                                        <span class="form-check-label">Grant</span>
                                    </label>
                            </label>
                        </div>
                        `
                    );

                });

            } else {

                $('#tableBodyAccessRights').append(

                    `<div class= "accordion" id = "kt_accordion_1" >
                            <div class="accordion-item" >
                                <h2 class="accordion-header" id="kt_accordion_${row.menu_id}" >
                                    <label class="d-flex flex-stack mb-5 cursor-pointer">
                                        <span class="d-flex align-items-center me-2">
                                            <span class="d-flex flex-column">
                                                <span class="fw-bold text-gray-800 text-hover-primary fs-5">${row.Name}</span>
                                            </span>
                                        </span>
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input" type="checkbox" id="ParentAccessRightId"  ${row.RecID == null ? '' : 'checked'} value="${row.menu_id}" />
                                            <span class="form-check-label">Grant</span>
                                        </label>
                                    </label>
                                </h2>
                            </div>
                        </div>`


                );

            }


        });
    }

</script>