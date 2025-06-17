<?php
/**
 * Plugin Name: Custom Admin Pro
 * Plugin URI: https://zazo.com.br/zazo-custom-admin
 * Description: Complete WordPress admin area customization with modern UI, dark/light themes, and secure licensing
 * Version: 1.0.2
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Reinaldo Nascimento
 * Author URI: https://zazo.com.br
 * License: GPL v2 or later
 * Text Domain: custom-admin-pro
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CUSTOM_ADMIN_PRO_VERSION', '1.0.2');
define('CUSTOM_ADMIN_PRO_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CUSTOM_ADMIN_PRO_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CUSTOM_ADMIN_PRO_PLUGIN_FILE', __FILE__);

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once CUSTOM_ADMIN_PRO_PLUGIN_PATH . 'includes/class-custom-admin-pro.php';

/**
 * Begins execution of the plugin.
 */
function run_custom_admin_pro() {
    $plugin = new Custom_Admin_Pro();
    $plugin->run();
}

/**
 * The code that runs during plugin activation.
 */
function custom_admin_pro_activate() {
    // A lógica de ativação pode ser colocada aqui.
}

/**
 * The code that runs during plugin deactivation.
 */
function custom_admin_pro_deactivate() {
    // A lógica de desativação pode ser colocada aqui.
}

register_activation_hook(__FILE__, 'custom_admin_pro_activate');
register_deactivation_hook(__FILE__, 'custom_admin_pro_deactivate');


// Inicia o plugin.
run_custom_admin_pro();
