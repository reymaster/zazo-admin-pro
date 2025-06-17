<?php

class Custom_Admin_Pro {

    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->plugin_name = 'custom-admin-pro';
        $this->version = '1.0.2';

        $this->load_dependencies();
        $this->define_admin_hooks();
    }

    private function load_dependencies() {
        require_once CUSTOM_ADMIN_PRO_PLUGIN_PATH . 'includes/class-loader.php';
        require_once CUSTOM_ADMIN_PRO_PLUGIN_PATH . 'includes/class-admin.php';

        $this->loader = new Custom_Admin_Pro_Loader();
    }

    private function define_admin_hooks() {
        $plugin_admin = new Custom_Admin_Pro_Admin($this->get_plugin_name(), $this->get_version());

        // Carrega os estilos e scripts de forma limpa
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        // Customiza o dashboard
        $this->loader->add_action('wp_dashboard_setup', $plugin_admin, 'customize_dashboard', 99);
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() { return $this->plugin_name; }
    public function get_version() { return $this->version; }
}
