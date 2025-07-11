<div class="modal fade" id="CompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyHeaderId"></h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 450px;overflow: scroll;">


                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-3"> <!-- Change col-15 to col-12 for larger input field -->
                            <label>Company Code:</label>
                            <input type="text" id="companyCodeId" class="form-control form-control-solid">
                        </div>
                        <div class="col-8"> <!-- Change col-15 to col-12 for larger input field -->
                            <label>Company Name:</label>
                            <input type="text" id="CompanyNameId" class="form-control form-control-solid">
                        </div>
                        <div class="col-12"> <!-- Change col-15 to col-12 for larger input field -->
                            <label>Address :</label>
                            <textarea class="form-control form-control-solid" id="CompanyAddressId" name="CompanyAddressId" rows="4" cols="50"></textarea>

                        </div>
                    </div>
                </div>

                <div class="container">
                    <!--begin::Navs-->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 " id="visualAppearanceID" onclick="DocumentLoader('visualAppearance')">
                                Visual Appearance
                            </a>
                        </li>

                    </ul>
                    <div id="loadDetails"></div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="SubmitCreate">Submit <span class="fas fa-save"></span></button>
            </div>
        </div>
    </div>
</div>



<script>
    function createNewCompanyModal(){
    $('#companyHeaderId').text('CREATE COMPANY')

    }

    function updateCompanyModal(){
        $('companyHeaderId').text('UPDATE COMPANY')

    }

    $( "#SubmitCreate" ).on( "click", function() {

        var formData = new FormData();
        formData.append('companyCode',$('#companyCodeId').val());
        formData.append('companyName',$('#CompanyNameId').val());
        formData.append('companyAddress',$('#CompanyAddressId').val());

        formData.append('companyLogo', $('#companyLogoId')[0].files[0]);
        formData.append('companySystem', $('#companySystemId')[0].files[0]);
        formData.append('sideMenuMax', $('#sideMenuMaxId')[0].files[0]);
        formData.append('sideMenuMin', $('#sideMenuMinId')[0].files[0]);

        formData.append('primaryColor', $('#primaryColorId').val());
        formData.append('secondaryColor', $('#secondaryColorId').val());

        $.ajax({
            url: '<?= route_to('createCompany'); ?>',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function () {
                Swal.fire({
                    allowOutsideClick: false,
                    imageUrl: 'assets/img/Loading/loading.gif',
                    imageHeight: 170,
                    title: "Loading Data ...",
                    html: "Please Wait while Data is being loaded.",
                    showConfirmButton: false,
                });
            },
            success: function(res) {


                const AlertResult = {
                    'tittle' : res.title,
                    'icon'   : res.status == 200 ? 'success' : 'warning',
                    'Message': res.Message
                };
                Message_Result(AlertResult)
                $('#CompanyModal').modal('hide')
                loadCompany()
            }
        });

    });
</script>