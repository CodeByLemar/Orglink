<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 
<div class="modal fade" id="CompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">LIST OF MENU</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>
            <div class="modal-body" style="height: 450px;overflow: scroll;">

                <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
                    <div  class="page-title d-flex flex-column justify-content-start flex-wrap me-3 ">
                        <div class="card">
                            <div class="card-body p-md-3">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <button type="button" class="btn-shadow btn btn-primary" onclick="createModal()">
                           <span class="btn-icon-wrapper pr-2 opacity-7">
                                 <i class="fa fa-plus fa-w-20"></i>
                           </span>
                            Create Menu
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table style="width: 100%;" class="table table-hover table-striped table-bordered"
                           id="listofMenuTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ParentMenu</th>
                            <th>Menu Name</th>
                            <th>Url</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                    </table>
                </div>




            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>

    const listofMenuTable = $('#listofMenuTable').DataTable({ ordering: false,
        responsive: true,
        retrieve: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: "pdfHtml5",
                className: 'btn btn-danger',
                text: 'Generate PDF',
                init: function(api, node, config) {
                    $(node).removeClass('dt-button buttons-pdf buttons-html5')
                }
            },
            {
                extend: "copyHtml5",
                className: 'btn btn-secondary',
                init: function(api, node, config) {
                    $(node).removeClass('dt-button buttons-copy buttons-html5')
                }
            },
            {
                extend: "excelHtml5",
                className: 'btn btn-success',
                init: function(api, node, config) {
                    $(node).removeClass('dt-button buttons-excel buttons-html5')
                }
            },
            {
                extend: "csvHtml5",
                className: 'btn btn-warning',
                init: function(api, node, config) {
                    $(node).removeClass('dt-button buttons-csv buttons-html5')
                }
            }
        ]
    });

    function loadListOfMenu(){
        get('<?= route_to('getlistMenu'); ?>', function(res) {
            loadOfCompany(res)
            Swal.close();
        });
    }

    function loadOfCompany(res){
        listofMenuTable.clear().draw();
        if (res.length > 0) {
            const dataToAdd = res.map(row => [
                `<b>${row.menu_id}</b>`,
                `<span class="badge py-3 px-4 fs-7 badge-light-${row.parentName == null ? '' : 'success'}">${row.parentName == null ? '' : row.parentName}</span>`,
                `<b>${row.name}</b>`,
                `<b>${row.value}</b>`,
                `<button class="btn btn-primary btn-sm" onclick="updateModal('${row.menu_id}','${row.parent}','${row.name}','${row.value}','${row.icon}','${row.SortOrder}')"> View <span class="fas fa-eye"></span></button>`
            ]);

            listofMenuTable.rows.add(dataToAdd).draw();

            Swal.close();
        }else{
            listofMenuTable.draw();
        }
    }


    function updateModal(menuid,parentname,menuname,url,icons,sort){

        $('#updateMenuModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '30%');
        $('#CompanyModal').modal('hide')



        $('#editparentNameID').select2().val(parentname).trigger('change.select2');
        $('#editmenuNameId').val(menuname)
        $('#editurlID').val(url)
        $('#editiconId').select2().val(icons).trigger('change.select2');
        $('#editsortId').val(sort)
        $('#menuId').val(menuid)



    }

</script>