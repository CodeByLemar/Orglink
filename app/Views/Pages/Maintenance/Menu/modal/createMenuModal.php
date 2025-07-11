 
<div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyHeaderId">Create Menu</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 450px;overflow: scroll;">


                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-12"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Parent Name</label>
                            <select  class="form-select form-control-sm form-select-solid" data-control="select2"  id="parentNameID">

                            </select>
                        </div>
                        <div class="col-12 mt-3"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Menu Name</label>
                            <input type="text" id="menuNameId"  class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-12 mt-3"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Url</label>
                            <input type="text" id="urlID"  class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-12 mt-3"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Icon</label>

                            <select class="form-select form-control-sm form-select-solid" data-control="select2"  id="iconId">
                            </select> 
                        </div>
                        <div class="col-12 mt-3"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Sort Order</label>
                            <input type="text" id="sortId" class="form-control form-control-sm form-control-solid">
                        </div>


                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="backButton()">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" id="SubmitCreate">Submit <span class="fas fa-save"></span></button>
            </div>
        </div>
    </div>
</div>



<script>

    $(document).ready(function() {
        $('#createMenuModal').on('shown.bs.modal', function () {

            $('#iconId').select2({
                placeholder: "Select Icon",
                dropdownParent: $('#createMenuModal'),
                templateSelection: function(data) {
                    var $option = $('<span></span>');
                    if (data.element && data.element.dataset.icon) {
                        $option.append('<i class="' + data.element.dataset.icon + '"></i>');
                    }
                    $option.append(data.text);
                    return $option;
                }
            });

            $('#parentNameID').select2({
                placeholder: "Select Parent Menu",
                dropdownParent: $('#createMenuModal')
            });

        });
    });

    function loadParentMenu(){
        get('<?= route_to('getParentName'); ?>', function(res) {

            $('#parentNameID').empty();
            $('#parentNameID').append(`<option value="0">No parent</option>`);

                res.forEach(row => {
                    $('#parentNameID').append(
                        `<option value="${row.menu_id}">${row.name}</option>`
                    );

                })

            Swal.close();
        });
    }

    function backButton(){
        $('#createMenuModal').modal('hide')
        openModal();
    }

    function loadGetIcon(){
        get('<?= route_to('geticons'); ?>', function(res) {
            $('#iconId').empty();
            res.forEach(row => {
                $('#iconId').append(
                    `<option value="${row.iconName}" data-icon="ki-solid ki-${row.iconName}"> ${row.iconName}</option>`
                );
            })
        })

    }

    $( "#SubmitCreate" ).on( "click", function() {

        const ValidationCheck = validateAndDisplayFormResults();

        if(ValidationCheck === true){

            const data = {
                parentNameID: $('#parentNameID').val(),
                menuNameId: $('#menuNameId').val(),
                urlID: $('#urlID').val(),
                iconId: $('#iconId').val(),
                sortId: $('#sortId').val(),
            }

            post("<?= route_to('createMenu'); ?>",data, function(res) {

                if(res.status == 200){
                     $('#parentNameID').val()
                     $('#menuNameId').val(null)
                     $('#urlID').val(null)
                     $('#sortId').val(null)
                    loadGetIcon()
                    loadParentMenu();
                    $('#createMenuModal').modal('hide')
                    openModal();
                }

                var AlertResult = {
                    'tittle' : res.title,
                    'icon'   : res.status == 200 ? 'success' : 'warning',
                    'Message': res.Message
                };
                Message_Result(AlertResult)
            });

        }


    });


    function getValue(elementId) {
        return $(`#${elementId}`).val();
    }


    function isNotEmpty(value) {
        return value !== undefined && value !== null && value.trim() !== '' ;
    }


    function validateAndDisplayFormResults() {
        const fields = [
            { id: 'menuNameId', name: 'Menu Name' },
            { id: 'urlID', name: 'URL' },
            { id: 'iconId', name: 'Icon Name' },
            { id: 'sortId', name: 'Sort ID' }
        ];

        let message = '';

        for (const field of fields) {
            const value = getValue(field.id);
            if (!isNotEmpty(value)) {
             // Stop checking further if one field is invalid
                Message_Result({
                    'tittle': 'Validation Error',
                    'icon': 'warning',
                    'Message':  `${field.name} is invalid or empty`
                })

                return false;

            }
        }



        return true;


    }





</script>