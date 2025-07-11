 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<div class="modal fade" id="updateMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyHeaderId">Update Menu</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 450px;overflow: scroll;">


                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-12"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Parent Name</label>
                            <select  class="form-select form-control-sm form-select-solid" data-control="select2"  id="editparentNameID">

                            </select>
                        </div>
                        <div class="col-12"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Menu Name</label>
                            <input type="text" id="editmenuNameId" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-12"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Url</label>
                            <input type="text" id="editurlID" class="form-control form-control-sm form-control-solid">
                        </div>
                        <div class="col-12"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Icon</label>

                            <select class="form-select form-control-sm form-select-solid" data-control="select2"  id="editiconId">
                            </select>

                        </div>
                        <div class="col-12"> <!-- Change col-15 to col-12 for larger input field -->
                            <label class="required fs-6 fw-semibold mb-2">Sort Order</label>
                            <input type="text" id="editsortId" class="form-control form-control-sm form-control-solid">
                        </div>

                        <input id="menuId" type="hidden">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="backButtonMenu()">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" id="SubmitUpdate">Update <span class="fas fa-save"></span></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#updateMenuModal').on('shown.bs.modal', function () {

            $('#editiconId').select2({
                placeholder: "Select Icon",
                dropdownParent: $('#updateMenuModal'),
                templateSelection: function(data) {
                    var $option = $('<span></span>');
                    if (data.element && data.element.dataset.icon) {
                        $option.append('<i class="' + data.element.dataset.icon + '"></i>');
                    }
                    $option.append(data.text);
                    return $option;
                }
            });

            $('#editparentNameID').select2({
                placeholder: "Select Parent Menu",
                dropdownParent: $('#updateMenuModal')
            });

        });
    });


    function updateParentMenu(){
        get('<?= route_to('getParentName'); ?>', function(res) {

            $('#editparentNameID').empty();
            $('#editparentNameID').append(`<option value="">***Select ParentName***</option>`);
            $('#editparentNameID').append(`<option value="0">No parent</option>`);

            res.forEach(row => {
                $('#editparentNameID').append(
                    `<option value="${row.menu_id}">${row.name}</option>`
                );

            })

            Swal.close();
        });
    }

    function backButtonMenu(){
        $('#updateMenuModal').modal('hide')
        openModal();
    }

    function updateGetIcon(){
        get('<?= route_to('geticons'); ?>', function(res) {
            $('#editiconId').empty();
            $('#editiconId').append(`<option value="">No Icon</option>`);
            $('#editiconId').empty();
            res.forEach(row => {
                $('#editiconId').append(
                    `<option value="${row.iconName}" data-icon="ki-solid ki-${row.iconName}"> ${row.iconName}</option>`
                );
            })
        })

    }

    $( "#SubmitUpdate" ).on( "click", function() {

        const ValidationCheck = UpdatevalidateAndDisplayFormResults();

        if(ValidationCheck === true){

            const data = {
                MenuNameID: $('#menuId').val(),
                parentNameID: $('#editparentNameID').val(),
                menuNameId: $('#editmenuNameId').val(),
                urlID: $('#editurlID').val(),
                iconId: $('#editiconId').val(),
                sortId: $('#editsortId').val(),
            }

            post("<?= route_to('updateMenu'); ?>",data, function(res) {

                if(res.status == 200){
                    $('#editparentNameID').val()
                    $('#editmenuNameId').val(null)
                    $('#editurlID').val(null)
                    $('#editsortId').val(null)
                    loadGetIcon()
                    loadParentMenu();
                    $('#updateMenuModal').modal('hide')
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
        return value !== undefined && value !== null && value.trim() !== '';
    }


    function UpdatevalidateAndDisplayFormResults() {
        const fields = [
            { id: 'editparentNameID', name: 'Parent' },
            { id: 'editmenuNameId', name: 'Menu Name' },
            { id: 'editurlID', name: 'URL' },
            { id: 'editiconId', name: 'Icon Name' },
            { id: 'editsortId', name: 'Sort ID' }
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
