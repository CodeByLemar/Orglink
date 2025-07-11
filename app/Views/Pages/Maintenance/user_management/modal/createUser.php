<style>
    input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
         -webkit-appearance: none;
      }
</style>


<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyHeaderId">
                    Create User
                </h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 400px;overflow: scroll;">


                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-4"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">First Name</label>
                            <input type="text" id="firstNameId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-4"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Middle Name</label>
                            <input type="text" id="middleNameId"
                                class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-4"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Last Name</label>
                            <input type="text" id="lastNameId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-6"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">UserName</label>
                            <input type="text" id="userNameId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-6">
                            <div class="form-outline mb-6">
                                <label class="required fs-6 fw-semibold mb-2">Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control form-control-sm form-control-solid" id="passwordId"
                                        type="text" readonly />
                                    <button class="btn btn-secondary btn-sm" type="button"
                                        id="generatePassword">Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Email Address</label>
                            <input type="text" id="emailId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-6"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Phone No.</label>
                            <input type="text" id="phoneId" class="form-control form-control-sm form-control-solid">
                        </div> 
                        <!--begin::Input group-->
                        <div class="mt-20">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6">Roles</label>
                            <!--end::Label-->

                            <!--begin::Roles-->
                            <!--begin::Input row-->
                            <div id="rolesGroupList">

                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" id="submitCreateUser">Submit <span class="fas fa-save"></span></button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>

    $("#generatePassword").on("click", function () {

        const password = generatePassword(20)

        $('#passwordId').val(password)

    });
    $("#submitCreateUser").on("click", function () {

        const dataInputs = getInputValues();

        if (!validateInputs(dataInputs)) {
            const AlertResult = {
                'tittle': 'Opps',
                'icon': 'warning',
                'Message': 'Please Check All input'
            };

            Message_Result(AlertResult)
        } else {


            post("<?= route_to('createUsers'); ?>", dataInputs, function (res) {

                if (res.status == 200) {

                    $('#firstNameId').val(null)
                    $('#middleNameId').val(null)
                    $('#lastNameId').val(null)
                    $('#userNameId').val(null)
                    $('#passwordId').val(null)
                    $('#emailId').val(null)
                    $('#phoneId').val(null) 
                    loadCreateListOfRoles()
                    loadUsers()
                }

                const AlertResult = {
                    'tittle': res.title,
                    'icon': res.status == 200 ? 'success' : 'warning',
                    'Message': res.Message
                };
                Message_Result(AlertResult)

            });

        }

    });
    function generatePassword(length) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%";
        let password = "";
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }
        return password;
    }

    function loadCreateListOfRoles() {
        get('<?= route_to('getRoles'); ?>', function (res) {
            parseRoles(res)
            Swal.close();
        });
    }

    function parseRoles(res) {
        $('#rolesGroupList').empty();
        res.forEach(item => {

            if (item.IsActive == 1) {

                $('#rolesGroupList').append(
                    `<div class='separator separator-dashed my-5'></div>
                    <div class="d-flex fv-row">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input me-3" name="user_role" type="radio" value="${item.RecID}" id="roles_${item.RecID}"  />
                            <label class="form-check-label" for="roles_${item.RecID}">
                                <div class="fw-bold text-gray-800">${item.grp_name}</div>
                            </label>
                        </div>
                    </div>
                `);
            }


        })
    }

    function getInputValues() {
        return {
            roleSelected: $('input[name="user_role"]:checked').val(),
            firstName: $('#firstNameId').val(),
            middleName: $('#middleNameId').val(),
            lastName: $('#lastNameId').val(),
            userName: $('#userNameId').val(),
            password: $('#passwordId').val(),
            email: $('#emailId').val(),
            phone: $('#phoneId').val(), 
        };
    }


    function validateInputs(inputs) {
        for (let key in inputs) {
            if (inputs[key] === '' || inputs[key] === undefined) {
                return false;
            }
        }
        return true;
    }



</script>