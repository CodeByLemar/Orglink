<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.css');?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Datatable/buttons.dataTables.min.css');?>"> 

<script src="<?php echo base_url('assets/js/Datatable/jquery-3.5.1.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/Datatable/buttons.html5.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/spinners.js');?>"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    $(function(){
        OnloadDiscrepancyReportist();
    });

   $(document).on('click', '#upload_dispute', function(e){
       e.preventDefault();
       $("#dispute_model").modal('toggle');
   });
   
    
   $(document).on('click', '#upload_dtr', function (e) {
      e.preventDefault();
         try {
            const file = $("#dtr")[0].files[0];
   
            if (!file) {
                  alert('No file selected!');
                  return;
            }
   
       
               let formData = new FormData();
               formData.append('file', file);
   
               $.ajax({
                  url : "<?= base_url('Reports/upload_dtr') ?>",
                  type: "POST",
                  data: formData,
                  processData: false,  
                  contentType: false,  
                  dataType: "JSON",   
                  success: (response) => { 
                     if (response.status === 'success') {
                        $("#dispute_model").modal('hide');
                        Swal.fire({
                           title: response.status,
                           text: response.message,
                           icon: response.status
                        }).then((result) => {
                           if (result.isConfirmed) {
                              OnloadDiscrepancyReportist(); 
                           }
                        });
                     } else {

                        Swal.fire({
                           title: 'Oooops....',
                           text: response.message,
                           icon: response.status
                        });
                        
                     }
                  }
            });
   
         } catch (error) {
            console.log(error);
         }
      });


   function OnloadDiscrepancyReportist() {
      $.ajax({
         url: "<?= base_url('Reports/loadDisputeList') ?>",
         type: "GET",
         dataType: "JSON",
         success: (data) => {
            if (data.length > 0) {
               if ($.fn.DataTable.isDataTable('#disputes_tbl')) {
                  $('#disputes_tbl').DataTable().clear().destroy();
                  $('#disputes_tbl tbody').empty();
               }

               let i = 1;
               data.forEach(row => {
                  const tr = `
                     <tr>
                        <td class="text-start">${i}</td>
                        <td class="text-start">${row.CCL_Company_Name}</td>
                        <td class="text-center">${row.CDR_Date_From}</td>
                        <td class="text-center">${row.CDR_Date_To}</td>
                        <td class="text-center">${row.CDR_Client_ID}</td>
                        <td class="text-start">${row.CDR_Full_Name}</td>
                        <td class="text-start">${row.CPL_Position_Name ?? ''}</td>
                        <td class="text-end">${row.CDR_WHrs}</td>
                        <td class="text-end">${row.CDR_LHrs}</td>
                        <td class="text-end">${row.CDR_OT}</td>
                        <td class="text-end">${row.CDR_RDOT}</td>
                        <td class="text-end">${row.CDR_Regular_Hol_OT}</td>
                        <td class="text-end">${row.CDR_Special_Hol_OT}</td>
                        <td class="text-end">${row.CDR_OT8}</td>
                        <td class="text-end">${row.CDR_NPOT}</td>
                        <td class="text-end">${row.CDR_NP}</td>
                        <td class="text-end">${row.CDR_NP8}</td>
                     </tr>
                  `;
                  $('#disputes_tbl tbody').append(tr);
                  i++;
               });

               $('#disputes_tbl').DataTable({
                  responsive: true,
                  autoWidth: false,
                  columnDefs: [
                     { targets: 2, width: '80px' },
                     { targets: 3, width: '80px' },
                     { targets: 5, width: '150px' }
                  ],
                  paging: false,
                  info: true,
                  ordering: true,
                  searching: true
               }).draw();
            }
         }
      });
   }



</script>