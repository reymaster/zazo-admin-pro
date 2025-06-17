<?php

class Custom_Admin_Pro_Theme_Manager {

    public function toggle_theme() {
        check_ajax_referer('custom_admin_pro_nonce', 'nonce');

        if (!current_user_can('read')) {
            wp_send_json_error('Insufficient permissions');
        }

        $current_theme = get_user_meta(get_current_user_id(), 'custom_admin_theme', true) ?: 'light';
        $new_theme = ($current_theme === 'light') ? 'dark' : 'light';

        update_user_meta(get_current_user_id(), 'custom_admin_theme', $new_theme);

        wp_send_json_success(array(
            'theme' => $new_theme,
            'message' => sprintf(__('Theme switched to %s mode', 'custom-admin-pro'), $new_theme)
        ));
    }

    /**
     * Adiciona o botão flutuante (FAB) com Material Icons.
     * O script inline foi removido para centralizar no admin.js.
     */
    public function add_theme_toggle_button() {
        $current_theme = get_user_meta(get_current_user_id(), 'custom_admin_theme', true) ?: 'light';
        ?>
        <div id="theme-toggle-button" class="theme-toggle-button" data-theme="<?php echo esc_attr($current_theme); ?>">
            <span class="theme-icon light-icon material-icons-outlined">light_mode</span>
            <span class="theme-icon dark-icon material-icons-outlined">dark_mode</span>
        </div>
        <?php
    }
}
