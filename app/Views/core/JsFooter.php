<script type="text/javascript">

    var url = '<?= base_url() ?>'
    //RENDER Menu
     loadSystemMenu();

    function loadSystemMenu(){



        if (localStorage.getItem('MenuList')) {
            // Value exists
            let res =  JSON.parse (localStorage.getItem('MenuList'));
            loadSideMenu(res);

        }else{

            get('<?= route_to('getMenu'); ?>', function(res) {
                localStorage.setItem('MenuList',JSON.stringify(res));
                loadSideMenu(res);
                Swal.close();
            });
        }
    }

    function btnmenu(urls, name) {

        httpGet(urls);

        history.pushState({ prevUrl: window.location.href }, '', urls);

        document.title = name;
    }

    function httpGet(theUrl) {

        window.location.href = theUrl;

    }

    function loadSideMenu(res) {

        res.forEach(function(row, index) {
            if (row.child != null) {
                $('.MenuLoad').append(`<div data-kt-menu-trigger="click"  class="menu-item here menu-accordion" >
                          <!--begin:Menu link-->
                              <span class="menu-link" >
                                  <span  class="menu-icon" >
                                      <i class="ki-duotone ${row.icon == '' ? 'ki-element-11' : 'ki-'+row.icon} fs-2">
                                  <span class="path1"></span><span class="path2">
                                  </span><span class="path3">
                                  </span><span class="path4">
                                  </span></i></span>
                                  <span  class="menu-title" >${row.Name}</span><span class="menu-arrow" ></span>
                                  </span>
                                  <div class="menu-sub menu-sub-accordion" id="MenuLoad${row.RecID}">
                              </div>
                       </div>`);

                let childjson = row.child

                childjson.forEach(function(res) {

                                document.querySelector('#MenuLoad'+res.ParentID).innerHTML += `
                                              <div  class="menu-item" >
                                                  <a class="menu-link" href="javascript:void(0)" onclick="btnmenu('${url}${res.Val}','${res.Name}')" >
                                                  <span  class="menu-bullet" >
                                                  <span class="bullet bullet-dot">
                                                  </span></span><span  class="menu-title" >${res.Name}</span></a>
                                                </div>
                                          `;

                });
            }else{
                $('.MenuLoad').append(`<div data-kt-menu-trigger="click"  class="menu-item here menu-accordion" >
                          <a  href="javascript:void(0)" onclick="btnmenu('${url}${row.Val}','${row.Name}')" >
                          <span class="menu-link" >
                          <span  class="menu-icon" >
                          <i class="ki-duotone ${row.icon == '' ? 'ki-element-11' : 'ki-'+row.icon} fs-2">
                          <span class="path1"></span><span class="path2">
                          </span><span class="path3">
                          </span><span class="path4">
                          </span></i></span>
                          <span  class="menu-title" >${row.Name}</span>
                          </span>
                        </a>
                       </div>`);
            }
        })

    }

    function SignOut(){
        Swal.fire({
            icon: 'info',
            title: 'Are you sure want to logout!',
            showCancelButton: true,
            confirmButtonColor: "#dd000d",
            confirmButtonText: 'Logout',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                get('<?= route_to('Logout'); ?>', function(res) {

                    if(res.status === 200){
                        history.pushState({ prevUrl: window.location.href }, '', ' <?= route_to('LoginForm'); ?>');
                        window.location.href = '<?= route_to('LoginForm'); ?>';
                         localStorage.removeItem('MenuList');
                    }

                    var AlertResult = {
                        'tittle' : res.title,
                        'icon'   : res.status === 200 ? 'success' : 'warning',
                        'Message': res.Message
                    };
                    Message_Result(AlertResult)

                })

            }
        })

    }
    // $(document).ready(function(){
    //     $('#SearchID').on('keyup', function() {
    //         // Get the search term
    //         $.ajax({
    //             type: 'POST',
    //             url: '{{ route('searchMenu') }}',
    //             data: {
    //                 query: $('#SearchID').val()
    //             },
    //             dataType: 'json',
    //             success: function (data) {
    //
    //                 $('#ResultSearchMenu').empty()
    //                 if(data === undefined || data.length == 0){
    //                     $('#ResultSearchMenu').empty()
    //                     $('#ResultSearchMenu').append(`
    //                                     <div class="d-flex align-items-center mb-5">
    //                                             <div class="pt-10 pb-10">
    //                                                             <i class="ki-duotone ki-search-list fs-4x opacity-50"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
    //                                                         </div>
    //                                                 <div class="d-flex flex-column">
    //                                                    <h3 class="text-gray-600 fs-5 mb-2">No result found</h3>
    //                                                    <div class="text-muted fs-7">Please try again with a different query</div>
    //                                               </div>
    //                                       </div>
    //                                `);
    //
    //                 }
    //                 $.map(data, function(items){
    //                     $('#ResultSearchMenu').append(`
    //                                     <div class="d-flex align-items-center mb-5">
    //                                           <!--begin::Symbol-->
    //                                           <div class="symbol symbol-40px me-4">
    //                                              <span class="symbol-label bg-light">
    //                                              <i class="ki-duotone ki-laptop fs-2 text-primary"><span class="path1"></span><span class="path2"></span></i>
    //                                              </span>
    //                                           </div>
    //                                           <!--end::Symbol-->
    //                                           <!--begin::Title-->
    //                                           <div class="d-flex flex-column">
    //                                              <a href="" class="fs-6 text-gray-800 text-hover-primary fw-semibold">${items.Name}</a>
    //                                              <span class="fs-7 text-muted fw-semibold"></span>
    //                                           </div>
    //                                           <!--end::Title-->
    //                                        </div>
    //
    //                               `);
    //                 });
    //             }
    //
    //
    //         });
    //     });
    // });




</script>
