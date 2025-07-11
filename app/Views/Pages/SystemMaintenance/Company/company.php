

<?= $this->include('core/header')  ?>
<?= $this->include('core/toolbar')  ?>
<?= $this->include('core/sidebar')  ?>

<style>
    textarea.form-control {
        resize: none;
    }
</style>

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 " >
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
                <div  class="page-title d-flex flex-column justify-content-start flex-wrap me-3 ">
                    <div class="card">
                        <div class="card-body p-md-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-start my-0">
                                 Company
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn-shadow btn btn-primary" onclick="openModal(1)">
                           <span class="btn-icon-wrapper pr-2 opacity-7">
                                 <i class="fa fa-plus fa-w-20"></i>
                           </span>
                        Create Company
                    </button>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid " >
            <div id="kt_app_content_container" class="app-container  container-fluid ">
                <div class="card ">
                    <div class="card-body p-0">
                        <br>
                        <div class="card-px text-start py-1 my-1">
                            <h5 class="card-title">LIST OF COMPANY</h5>
                            <br>
                            <div class="table-responsive">
                                <table style="width: 100%;" class="table table-hover table-striped table-bordered"
                                       id="companyLoadTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CompanyCode</th>
                                        <th>CompanyName</th>
                                        <th>Status</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>



<?= $this->include('Pages/SystemMaintenance/Company/modal/companyModal') ?>



 <?= $this->include('core/footer')  ?>
<script>
    loadCompany();

    function openModal(typeofModal){
        $('#CompanyModal').modal('show')
        $('.modal').css('width', '100vw');
        $('.modal-dialog').css('max-width', '95%');

        if(typeofModal === 1){
            createNewCompanyModal();
        }else{

        }
    }
    const companyLoadTable = $('#companyLoadTable').DataTable({ ordering: false,
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


    function loadCompany(){
        get('<?= route_to('getCompany'); ?>', function(res) {
            loadOfCompany(res)
            Swal.close();
        });
    }

    function DocumentLoader(value){

        $('#LoanDocumentID').addClass('active');
        $('#visualAppearanceID').addClass('active');

        $.get('<?= route_to('visualAppearance'); ?>', function(data) {
                $('#loadDetails').html(data);
        });

    }

    function loadOfCompany(res){
        companyLoadTable.clear().draw();
        if (res.length > 0) {
            const dataToAdd = res.map(row => [
                `<b>${row.RecID}</b>`,
                `<b>${row.Company_code}</b>`,
                `<b>${row.Company_name}</b>`,
                `<span class="badge py-3 px-4 fs-7 badge-light-${row.IsActive == 1 ? 'success' : 'warning'}">${row.IsActive == 1 ? 'Active' : 'Deactivate'}</span>`,
                `<button class="btn btn-primary btn-sm">View <span class="fas fa-eye"></span></button>`
            ]);

            companyLoadTable.rows.add(dataToAdd).draw();

            Swal.close();
        }else{
            companyLoadTable.draw();
        }


    }

</script>


