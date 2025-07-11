<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyHeaderId">Reset Password</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 150px;overflow: scroll;">


                <div class="container">
                    <div class="row justify-content-between">
                        <div class="form-outline mb-4">
                            <label class="required fs-6 fw-semibold mb-2">Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control form-control-sm form-control-solid"  id="resetPasswordId"  type="text"  readonly />
                                <button class="btn btn-secondary btn-sm" type="button" id="generateResetPassword">Generate</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitResetPassword">Submit <span class="fas fa-save"></span></button>
            </div>
        </div>
    </div>
</div>

<script>
    $( "#generateResetPassword" ).on( "click", function() {

        const password = generatePassword(20)

        $('#resetPasswordId').val(password)

    });

    $( "#submitResetPassword" ).on( "click", function() {
        const dataInputs = getResetPasswordInputValues();

        if (!validateInputs(dataInputs)) {
            const AlertResult = {
                'tittle' : 'Opps',
                'icon'   : 'warning',
                'Message': 'Please Check All input'
            };

            Message_Result(AlertResult)
        } else {

            post("<?= route_to('resetPassword'); ?>",dataInputs, function(res) {

                if(res.status == 200){
                    $('#submitResetPassword').hide();
                    $('#generateResetPassword').prop('disabled', true);
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

    function getResetPasswordInputValues() {
        return {
            recId : $('#update_recId').val(),
            password: $('#resetPasswordId').val(),
        };
    }
</script>