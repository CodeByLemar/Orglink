<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 
<!-- Required for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(document).ready(function(){  
        PopulateMonthYear();


        
        $('#GenerateFilterGovConSummary').on('click',function(){ 
            filterby = $('#filterby').val();
            $('#filter_modal').modal('toggle');
            if ($.fn.DataTable.isDataTable('#Gov_Dues_Tbl')) {
                $('#Gov_Dues_Tbl').DataTable().clear().destroy();
            }


            let columns = [];

            if (filterby === 'SSS') {
                columns = [
                    { title: 'Client' },
                    { title: 'Code' },
                    { title: 'Employee Name' },
                    { title: 'SSS No.' },
                    { title: 'Loan Type' },
                    { title: 'Loan' },
                    { title: 'Total' }
                ];
            } else if (filterby === 'Philhealth') {
                columns = [
                    { title: 'Client' },
                    { title: 'Code' },
                    { title: 'Employee Name' },
                    { title: 'Philhealth ID' },
                    { title: 'PS' },
                    { title: 'ES' },
                    { title: 'Total' }
                ];
            } else if (filterby === 'HDMF') {
                columns = [
                    { title: 'Client' },
                    { title: 'Code' },
                    { title: 'Employee Name' },
                    { title: 'HDMF No.' },
                    { title: 'EE Share' },
                    { title: 'ER Share' },
                    { title: 'Total HDMF' }
                ];
            } else {
                columns = [
                    { title: 'No data selected' }
                ];
            }

            $('#Gov_Dues_Tbl').DataTable({ 
                columns: columns,
                dom: 'Bfrtip',      // Add buttons to the top
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Government Contribution Summary'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Government Contribution Summary',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    }, 
                ]

            });

        });
        
    });
    

    function PopulateMonthYear(){
        const dropdown = document.getElementById('imonth_year');
        const inputMonth = document.getElementById('imonth');
        const inputYear = document.getElementById('iyear');

        const startYear = 2023;
        const endYear = new Date().getFullYear();
        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        // Populate the dropdown
        for (let y = endYear; y >= startYear; y--) {
            for (let m = 0; m < 12; m++) {
            const value = `${y}-${(m + 1).toString().padStart(2, '0')}`;
            const text = `${months[m]} ${y}`;
            const option = document.createElement("option");
            option.value = value;
            option.textContent = text;
            dropdown.appendChild(option);
            }
        }

        // Set default hidden input values based on initial dropdown selection
        function updateHiddenFields(value) {
            const [year, month] = value.split("-");
            inputMonth.value = month;
            inputYear.value = year;
        }

        // Set initial values
        updateHiddenFields(dropdown.value);

        // Update values on change
        dropdown.addEventListener("change", function () {
            updateHiddenFields(this.value);
        });
    }
    

    
</script>