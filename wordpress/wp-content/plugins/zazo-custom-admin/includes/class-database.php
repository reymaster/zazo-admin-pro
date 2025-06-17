<?php

class Custom_Admin_Pro_Database {

    public static function create_tables() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'custom_admin_pro_licenses';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            license_hash varchar(64) NOT NULL,
            encrypted_data text NOT NULL,
            fingerprint_hash varchar(64) NOT NULL,
            domain varchar(255) NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            last_validated datetime DEFAULT CURRENT_TIMESTAMP,
            validation_count int(11) DEFAULT 0,
            status enum('active','inactive','expired','suspended') DEFAULT 'active',
            PRIMARY KEY (id),
            UNIQUE KEY license_hash (license_hash),
            KEY fingerprint_hash (fingerprint_hash),
            KEY status (status),
            KEY domain (domain)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function drop_tables() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'custom_admin_pro_licenses';
        $wpdb->query("DROP TABLE IF EXISTS $table_name");
    }
}
