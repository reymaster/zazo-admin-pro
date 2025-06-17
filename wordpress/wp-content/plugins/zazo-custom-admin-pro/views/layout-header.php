<?php
$current_user = wp_get_current_user();
?>
<div id="kt_header" class="header align-items-stretch">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                    <i class="ki-duotone ki-abstract-14 fs-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <a href="<?php echo admin_url();?>" class="d-lg-none">
                    <img alt="Logo" src="<?php echo CAP_PLUGIN_URL. 'assets/media/logos/default-small.svg';?>" class="h-30px" />
                </a>
            </div>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-center" id="kt_header_nav">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex text-dark fw-bold fs-3 align-items-center my-1">Dashboard</h1>
                </div>
            </div>
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="<?php echo esc_url(get_avatar_url($current_user->ID));?>" alt="user" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="<?php echo esc_url(get_avatar_url($current_user->ID));?>" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5"><?php echo esc_html($current_user->display_name);?></div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?php echo esc_html($current_user->user_email);?></a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="<?php echo esc_url(get_edit_profile_url($current_user->ID));?>" class="menu-link px-5">Meu Perfil</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="<?php echo esc_url(wp_logout_url());?>" class="menu-link px-5">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
