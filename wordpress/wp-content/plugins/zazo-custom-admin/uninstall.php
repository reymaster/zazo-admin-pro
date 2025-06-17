<?php

// If uninstall not called from WordPress, then exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remove all plugin options
delete_option('custom_admin_pro_license_key');
delete_option('custom_admin_pro_license_status');
delete_option('custom_admin_pro_theme');
delete_option('custom_admin_pro_activated');
delete_option('custom_admin_pro_encryption_key');
delete_option('custom_admin_pro_client_secret');

// Remove user meta
global $wpdb;
$wpdb->delete(
    $wpdb->usermeta,
    array('meta_key' => 'custom_admin_theme')
);

// Drop custom tables
require_once plugin_dir_path(__FILE__) . 'includes/class-database.php';
Custom_Admin_Pro_Database::drop_tables();

// Clear any cached data
wp_cache_flush();

