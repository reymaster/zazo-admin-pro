<?php
/**
 * Plugin Name:       Custom Admin Pro
 * Plugin URI:        https://example.com/
 * Description:       Transforma completamente o painel de administração do WordPress com o tema Metronic.
 * Version:           1.0.0
 * Author:            Seu Nome
 * Author URI:        https://example.com/
 * License:           Proprietário - Requer licença Metronic
 * License URI:       https://themeforest.net/licenses/standard
 * Text Domain:       custom-admin-pro
 */

if (!defined('ABSPATH')) {
    exit; // Sair se acessado diretamente.
}

// Definir constantes do plugin
define('CAP_VERSION', '1.0.0');
define('CAP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CAP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Incluir classes
require_once CAP_PLUGIN_DIR. 'includes/class-init.php';
require_once CAP_PLUGIN_DIR. 'includes/class-menu-manager.php';
require_once CAP_PLUGIN_DIR. 'includes/class-dashboard-widgets.php';

// Iniciar o plugin
function custom_admin_pro_run() {
    $plugin = new Custom_Admin_Pro_Init();
    $plugin->run();
}
custom_admin_pro_run();
