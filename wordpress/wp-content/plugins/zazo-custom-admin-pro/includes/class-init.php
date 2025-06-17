<?php

class Custom_Admin_Pro_Init {

    public $menu_manager;
    public $dashboard_widgets;

    public function run() {
        $this->menu_manager = new Custom_Admin_Pro_Menu_Manager();
        $this->dashboard_widgets = new Custom_Admin_Pro_Dashboard_Widgets();

        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'), 999);
        add_action('login_enqueue_scripts', array($this, 'enqueue_login_assets'));

        add_action('admin_menu', array($this->menu_manager, 'capture_and_remove_admin_menu'), 9999);

        add_action('wp_dashboard_setup', array($this->dashboard_widgets, 'setup_dashboard'), 999);

        // Injeta o layout do Metronic
        add_action('in_admin_header', array($this, 'inject_metronic_layout_start'));
        add_action('admin_footer', array($this, 'inject_metronic_layout_end'));

        // Limpa a UI padrão
        add_action('admin_bar_menu', array($this, 'remove_admin_bar_nodes'), 999);
        add_filter('admin_footer_text', '__return_empty_string');
        add_filter('update_footer', '__return_empty_string', 11);
    }

    public function enqueue_admin_assets($hook_suffix) {
        // Aplica o novo design apenas na página do painel principal
        if ('index.php'!== $hook_suffix) {
            return;
        }

        // Desregistra estilos padrão para evitar conflitos
        $styles_to_remove = array('wp-admin', 'colors', 'admin-bar', 'dashboard', 'forms');
        foreach ($styles_to_remove as $handle) {
            wp_dequeue_style($handle);
            wp_deregister_style($handle);
        }

        // Enfileira ativos do Metronic
        wp_enqueue_style('metronic-plugins', CAP_PLUGIN_URL. 'assets/plugins/global/plugins.bundle.css', array(), CAP_VERSION);
        wp_enqueue_style('metronic-style', CAP_PLUGIN_URL. 'assets/css/style.bundle.css', array('metronic-plugins'), CAP_VERSION);

        // Enfileira ativos personalizados
        wp_enqueue_style('custom-admin-style', CAP_PLUGIN_URL. 'assets/css/custom-admin.css', array('metronic-style'), CAP_VERSION);

        // Enfileira scripts do Metronic
        wp_enqueue_script('metronic-plugins-bundle', CAP_PLUGIN_URL. 'assets/plugins/global/plugins.bundle.js', array('jquery'), CAP_VERSION, true);
        wp_enqueue_script('metronic-scripts-bundle', CAP_PLUGIN_URL. 'assets/js/scripts.bundle.js', array('metronic-plugins-bundle'), CAP_VERSION, true);

        // Enfileira script personalizado e passa dados para ele
        wp_enqueue_script('custom-admin-script', CAP_PLUGIN_URL. 'assets/js/custom-admin.js', array('metronic-scripts-bundle'), CAP_VERSION, true);

        // Passa dados do PHP para o JavaScript para os gráficos
        $chart_data = array(
            'salesData' => array(30, 40, 35, 50, 49, 60, 70, 91, 125),
            'visitorsData' => array(55, 65, 60, 72, 70, 78, 85, 99, 110),
            'worldSales' => array('US' => 300, 'AU' => 250, 'BR' => 450, 'DE' => 200, 'CN' => 500, 'FR' => 150),
            'categories' => array(
                'series' => array(array('data' => array(13, 11, 9, 8, 7, 6, 5))),
                'categories' => array('Phones', 'Laptops', 'Headsets', 'Games', 'Keyboards', 'Monitors', 'Speakers')
            )
        );
        wp_localize_script('custom-admin-script', 'capChartData', $chart_data);
    }

    public function enqueue_login_assets() {
        wp_enqueue_style('custom-login-style', CAP_PLUGIN_URL. 'assets/css/custom-login.css', array(), CAP_VERSION);
    }

    public function inject_metronic_layout_start() {
        if (get_current_screen()->id!== 'dashboard') return;

        // Adiciona classes ao body
        add_filter('admin_body_class', function($classes) {
            return $classes. ' header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed';
        });

        echo '<div class="d-flex flex-column flex-root">';
        echo '<div class="page d-flex flex-row flex-column-fluid">';

        // Passa a instância do menu manager para a view
        $menu_manager = $this->menu_manager;
        require_once CAP_PLUGIN_DIR. 'views/layout-sidebar.php';

        echo '<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">';
        require_once CAP_PLUGIN_DIR. 'views/layout-header.php';
    }

    public function inject_metronic_layout_end() {
        if (get_current_screen()->id!== 'dashboard') return;

        require_once CAP_PLUGIN_DIR. 'views/layout-footer.php';
        echo '</div>'; // fecha #kt_wrapper
        echo '</div>'; // fecha.page
        echo '</div>'; // fecha.d-flex
    }

    public function remove_admin_bar_nodes($wp_admin_bar) {
        $all_nodes = $wp_admin_bar->get_nodes();
        foreach ($all_nodes as $node) {
            $wp_admin_bar->remove_node($node->id);
        }
    }
}
