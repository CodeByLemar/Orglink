
<div class="modal fade" id="accessRightMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyHeaderId">Access Rights</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 250px;overflow: scroll;">
                <input id="roleId" type="hidden">
                <input id="parentIdSaved" type="hidden">

                <div class="mb-0" id="TableaccessRight">

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="backtoUpdateRole()">Cancel</button>
                <button type="button" class="btn btn-primary" id="BtnupdateRolesAccess">Submit <span class="fas fa-save"></span></button>
            </div>
        </div>
    </div>
</div>

<script>


    $(document).ready(function() {
        $('#BtnupdateRolesAccess').click(function() {
            // Array to store checked values
            let checkedValues = [];

            // Iterate over each checkbox
            $('.form-check-input').each(function() {
                if ($(this).prop('checked')) {
                    checkedValues.push($(this).val());
                }
            });


            const data = {
                'AccessGrantedList' : checkedValues,
                'parentId' : $('#parentIdSaved').val(),
                'rolesId' : $('#roleId').val()
            }


            post('<?= route_to('updateRoleAccessRight'); ?>',data, function(res) {
                console.log(res)
                Swal.close();

            });
        });





    });

    function checkAccessRightParent(){
        if ($('#ParentAccessRightId').is(':checked')) {
            $('.child-menu').prop('disabled', false); // Enable child menu checkbox
        } else {
            $('.child-menu').prop('disabled', true); // Disable child menu checkbox
            $('.child-menu').prop('checked', false);
        }
    }


    function backtoUpdateRole (){
        $('#accessRightMenuModal').modal('hide')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '30%');

        loadParentMenuByRoles($('#roleId').val());
        $('#updateRoleModal').modal('show')
    }

    function loadChildrenMenuByRole(roleId,parentId)
    {

        const data = {
            'parentId' : parentId,
            'rolesId' : roleId
        }
        post('<?= route_to('getChildMenuListByRole'); ?>',data, function(res) {
            extractChildMenu(res)
            Swal.close();

        });

    }

    function extractChildMenu(res)
    {
        $('#TableaccessRight').empty();

        res.forEach(row => {

            if (row.child != null) {

                $('#TableaccessRight').append(

                    `<label class="d-flex flex-stack mb-5 cursor-pointer" onclick="checkAccessRightParent()">
                        <span class="d-flex align-items-center me-2">
                            <span class="d-flex flex-column">
                                <span class="fw-bold text-gray-800 text-hover-primary fs-5">${row.Name}</span>
                            </span>
                        </span>
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                <input class="form-check-input parent-menu" type="checkbox" id="ParentAccessRightId" ${row.RecID == null ? '' : 'checked'} value="${row.menu_id}"  name="user_management_read" />
                                <span class="form-check-label">Grant</span>
                            </label>
                    </label>`
                );

                let childjson = row.child

                childjson.forEach(function(item) {

                    $('#TableaccessRight').append(

                        `<label class="d-flex flex-stack mb-5 cursor-pointer">
                        <span class="d-flex align-items-center me-2">
                            <span class="d-flex flex-column">
                                <span class="fw-bold text-gray-800 text-hover-primary fs-5">${item.Name}</span>
                            </span>
                        </span>
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                <input class="form-check-input child-menu" type="checkbox" ${item.RecID == null ? '' : 'checked'}  value="${item.menu_id}"  ${row.RecID == null ? 'disabled' : ''}/>
                                <span class="form-check-label">Grant</span>
                            </label>
                    </label>`
                    );

                });

            }else{

             $('#TableaccessRight').append(

                 `<label class="d-flex flex-stack mb-5 cursor-pointer">
                        <span class="d-flex align-items-center me-2">
                            <span class="d-flex flex-column">
                                <span class="fw-bold text-gray-800 text-hover-primary fs-5">${row.Name}</span>
                            </span>
                        </span>
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                <input class="form-check-input" type="checkbox"  ${row.RecID == null ? '' : 'checked'} value="${row.menu_id}" name="user_management_read"/>
                                <span class="form-check-label">Grant</span>
                            </label>
                    </label>`
             );

            }


        });

    }


</script>


