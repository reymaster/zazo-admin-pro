<?php

class Custom_Admin_Pro_Menu_Manager {
    private $menu;
    private $submenu;
    private $current_url;
    private $plugin_page;

    public function capture_and_remove_admin_menu() {
        global $menu, $submenu, $self, $plugin_page;

        $this->menu = $menu;
        $this->submenu = $submenu;
        $this->current_url = $self;
        $this->plugin_page = $plugin_page;

        // Remove todos os menus de nível superior para redesenhá-los
        foreach ($this->menu as $key => $item) {
            if (isset($item[1])) {
                remove_menu_page($item[1]);
            }
        }
    }

    public function render_metronic_menu() {
        if (empty($this->menu)) return;

        echo '<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">';

        foreach ($this->menu as $item) {
            if (empty($item)) continue; // Ignora itens sem título (separadores)

            $menu_slug = $item[1];
            $has_submenu =!empty($this->submenu[$menu_slug]);
            $is_active = $this->is_item_active($item, $has_submenu);
            $menu_title = preg_replace('/<span.*?>.*?<\/span>/', '', $item);
            $url = isset($item[1])? (strpos($item[1], '.php')!== false? admin_url($item[1]) : admin_url('admin.php?page='. $item[1])) : '#';
            $icon_class = $this->map_icon($item[2]);

            if ($has_submenu) {
                $active_class = $is_active? 'show' : '';
                echo '<div data-kt-menu-trigger="click" class="menu-item menu-accordion '. $active_class. '">';
                echo '<span class="menu-link"><span class="menu-icon"><i class="'. $icon_class. ' fs-2"></i></span><span class="menu-title">'. esc_html($menu_title). '</span><span class="menu-arrow"></span></span>';
                echo '<div class="menu-sub menu-sub-accordion menu-active-bg">';
                foreach ($this->submenu[$menu_slug] as $sub_item) {
                    $sub_is_active = ($this->current_url == $sub_item[1] || $this->plugin_page == $sub_item[1]);
                    $sub_active_class = $sub_is_active? 'active' : '';
                    $sub_url = isset($sub_item[1])? (strpos($sub_item[1], '.php')!== false? admin_url($sub_item[1]) : admin_url('admin.php?page='. $sub_item[1])) : '#';
                    echo '<div class="menu-item"><a class="menu-link '. $sub_active_class. '" href="'. esc_url($sub_url). '"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">'. esc_html($sub_item). '</span></a></div>';
                }
                echo '</div>';
                echo '</div>';
            } else {
                $active_class = $is_active? 'active' : '';
                echo '<div class="menu-item"><a class="menu-link '. $active_class. '" href="'. esc_url($url). '"><span class="menu-icon"><i class="'. $icon_class. ' fs-2"></i></span><span class="menu-title">'. esc_html($menu_title). '</span></a></div>';
            }
        }
        echo '</div>';
    }

    private function is_item_active($item, $has_submenu) {
        if ($this->current_url == $item[1]) return true;
        if ($has_submenu) {
            foreach ($this->submenu[$item[1]] as $sub_item) {
                if ($this->plugin_page == $sub_item[1]) return true;
            }
        }
        return false;
    }

    private function map_icon($class) {
        $map = array(
            'dashicons-dashboard'       => 'ki-duotone ki-element-11',
            'dashicons-admin-post'      => 'ki-duotone ki-pencil',
            'dashicons-admin-media'     => 'ki-duotone ki-file-up',
            'dashicons-admin-page'      => 'ki-duotone ki-document',
            'dashicons-admin-comments'  => 'ki-duotone ki-message-text-2',
            'dashicons-admin-appearance' => 'ki-duotone ki-brush',
            'dashicons-admin-plugins'   => 'ki-duotone ki-abstract-28',
            'dashicons-admin-users'     => 'ki-duotone ki-profile-circle',
            'dashicons-admin-tools'     => 'ki-duotone ki-wrench',
            'dashicons-admin-settings'  => 'ki-duotone ki-setting-2',
        );
        $class_name = str_replace('menu-icon-', '', $class);
        return isset($map[$class_name])? $map[$class_name] : 'ki-duotone ki-abstract-8';
    }
}
