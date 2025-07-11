<div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
    <div id="kt_app_sidebar" class="app-sidebar  flex-column " style="background-color: <?=  session('companydetails')[0]['SecondColor'] ?>;"
         data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"
    >
        <!--begin::Logo-->
        <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
            <!--begin::Logo image-->
            <a href="#">
                
                <img alt="Logo" src="<?php echo base_url('assets/images/System/'.session('companydetails')[0]['SideMenuLogoMax']);?>" width="90%" class="app-sidebar-logo-default"/>
                <img alt="Logo" src="<?php echo base_url('assets/images/System/'.session('companydetails')[0]['logoSideMenuMin']);?>" class="h-30px app-sidebar-logo-minimize"/>
                <!-- <img alt="Logo" src="assets/images/System/<?=  session('companydetails')[0]['SideMenuLogoMax'] ?>" width="90%" class="app-sidebar-logo-default"/>
                <img alt="Logo" src="assets/images/System/<?=  session('companydetails')[0]['logoSideMenuMin'] ?>" class="h-30px app-sidebar-logo-minimize"/> -->
            </a>
            <!--end::Logo image-->
            <div
                id="kt_app_sidebar_toggle"
                class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate "
                data-kt-toggle="true"
                data-kt-toggle-state="active"
                data-kt-toggle-target="body"
                data-kt-toggle-name="app-sidebar-minimize"
            >
                <i class="ki-duotone ki-double-left fs-2 rotate-180"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Sidebar toggle-->
        </div>
        <!--end::Logo-->
        <!--begin::sidebar menu-->
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <!--begin::Menu wrapper-->
            <div
                id="kt_app_sidebar_menu_wrapper"
                class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
                data-kt-scroll="true"
                data-kt-scroll-activate="true"
                data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu"
                data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true"
            >
                <div  class="menu-item pt-2" >
                    <!--begin:Menu content-->
                    <div  class="menu-content" >
                        <span class="menu-heading fw-bold text-uppercase fs-7 text-light">Menus</span>
                    </div>
                </div>
                <div
                    class="menu menu-column menu-rounded menu-sub-indention px-3 MenuLoad"
                    id="#kt_app_sidebar_menu"
                    data-kt-menu="true"
                    data-kt-menu-expand="false"
                ></div>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

    <?= $this->include('core/JsFooter')  ?>

