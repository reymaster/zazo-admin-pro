<?php

class Custom_Admin_Pro_Public {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        // Only enqueue if user is logged in and can access admin
        if (is_user_logged_in() && current_user_can('read')) {
            // Check if admin bar is showing
            if (is_admin_bar_showing()) {
                wp_enqueue_style(
                    $this->plugin_name . '-public',
                    CUSTOM_ADMIN_PRO_PLUGIN_URL . 'public/css/public.css',
                    array(),
                    $this->version,
                    'all'
                );

                // Add theme-specific styles for admin bar on frontend
                $current_theme = get_user_meta(get_current_user_id(), 'custom_admin_theme', true) ?: 'light';
                wp_enqueue_style(
                    $this->plugin_name . '-public-theme-' . $current_theme,
                    CUSTOM_ADMIN_PRO_PLUGIN_URL . 'public/css/theme-' . $current_theme . '.css',
                    array($this->plugin_name . '-public'),
                    $this->version,
                    'all'
                );
            }
        }
    }

    public function enqueue_scripts() {
        // Only enqueue if user is logged in and can access admin
        if (is_user_logged_in() && current_user_can('read')) {
            if (is_admin_bar_showing()) {
                wp_enqueue_script(
                    $this->plugin_name . '-public',
                    CUSTOM_ADMIN_PRO_PLUGIN_URL . 'public/js/public.js',
                    array('jquery'),
                    $this->version,
                    true
                );

                // Localize script for AJAX
                wp_localize_script($this->plugin_name . '-public', 'customAdminProPublic', array(
                    'ajax_url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('custom_admin_pro_public_nonce'),
                    'current_theme' => get_user_meta(get_current_user_id(), 'custom_admin_theme', true) ?: 'light'
                ));
            }
        }
    }

    /**
     * Add custom classes to body tag on frontend
     */
    public function add_body_classes($classes) {
        if (is_user_logged_in() && current_user_can('read')) {
            $current_theme = get_user_meta(get_current_user_id(), 'custom_admin_theme', true) ?: 'light';
            $classes[] = 'custom-admin-pro-active';
            $classes[] = 'custom-admin-theme-' . $current_theme;
        }

        return $classes;
    }

    /**
     * Customize admin bar on frontend
     */
    public function customize_frontend_admin_bar() {
        if (!is_admin() && is_admin_bar_showing()) {
            ?>
            <style>
                #wpadminbar {
                    transition: all 0.3s ease;
                }

                body.custom-admin-theme-dark #wpadminbar {
                    background: #1a1a1a;
                }

                body.custom-admin-theme-dark #wpadminbar a {
                    color: #ffffff;
                }

                body.custom-admin-theme-dark #wpadminbar .ab-item:before {
                    color: #b0b0b0;
                }
            </style>
            <?php
        }
    }
}

