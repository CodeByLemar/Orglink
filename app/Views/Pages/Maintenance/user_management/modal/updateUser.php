<div class="modal fade" id="createUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyHeaderId">Update User</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 500px;overflow: scroll;">


                <div class="container">
                    <div class="row justify-content-between">
                        <input type="hidden" id="update_recId">
                        <div class="col-4 mt-5"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">First Name</label>
                            <input type="text" id="update_firstNameId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-4 mt-5"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Middle Name</label>
                            <input type="text" id="update_middleNameId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-4 mt-5"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Last Name</label>
                            <input type="text" id="update_lastNameId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-6 mt-5"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">UserName</label>
                            <input type="text" id="update_userNameId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-6 mt-5"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Email Address</label>
                            <input type="text" id="update_emailId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-6 mt-5"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Phone No.</label>
                            <input type="text" id="update_phoneId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-6 mt-5"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Status</label>
                            <select class="form-control form-control-sm form-control-solid" id="update_statusId">
                                <option value="">**Select Status***</option>
                                <option value="1">Active</option>
                                <option value="0">Deactivate</option>
                            </select>
                        </div> 
                        
                        <!--begin::Input group-->
                        <div class="mt-20">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6">Roles</label>
                            <!--end::Label-->

                            <!--begin::Roles-->
                            <!--begin::Input row-->
                            <div id="UpdaterolesGroupList">

                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" id="submitUpdateUser">Submit <span class="fas fa-save"></span></button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>

    $( "#submitUpdateUser" ).on( "click", function() {
        const dataInputs = getUpdateInputValues();

        if (!validateInputs(dataInputs)) {
            const AlertResult = {
                'tittle' : 'Opps',
                'icon'   : 'warning',
                'Message': 'Please Check All input'
            };

            Message_Result(AlertResult)
        } else {

            post("<?= route_to('updateUsers'); ?>",dataInputs, function(res) {

                if(res.status == 200){
                    $('#createUpdateModal').modal('hide')
                    loadUsers()
                }

                const AlertResult = {
                    'tittle' : res.title,
                    'icon'   : res.status == 200 ? 'success' : 'warning',
                    'Message': res.Message
                };
                Message_Result(AlertResult)

            });
        }

    });


    function updateLoadListOfRoles(rolesId){
        get('<?= route_to('getRoles'); ?>', function(res) {
            parseUpdateRoles(res,rolesId)
            Swal.close();
        });
    }

    function parseUpdateRoles(res,rolesId){
        $('#UpdaterolesGroupList').empty();
        res.forEach(item => {

            if(item.IsActive == 1){

                $('#UpdaterolesGroupList').append(
                    `<div class='separator separator-dashed my-5'></div>
                    <div class="d-flex fv-row">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input me-3" name="update_user_role" type="radio" value="${item.RecID}" id="update_roles_${item.RecID}" ${rolesId == item.RecID ? 'checked' : ''}/>
                            <label class="form-check-label" for="update_roles_${item.RecID}">
                                <div class="fw-bold text-gray-800">${item.grp_name}</div>
                            </label>
                        </div>
                    </div>
                `);
            }


        })
    }

    function getUpdateInputValues() {
        return {
            recId : $('#update_recId').val(),
            firstname : $('#update_firstNameId').val(),
            middlename : $('#update_middleNameId').val(),
            lastname : $('#update_lastNameId').val(),
            roleSelected: $('input[name="update_user_role"]:checked').val(),
            userName: $('#update_userNameId').val(),
            email: $('#update_emailId').val(),
            phone: $('#update_phoneId').val(),
            status: $('#update_statusId').val(), 
        };
    }





</script>