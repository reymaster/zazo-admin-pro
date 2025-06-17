<?php

class Custom_Admin_Pro_Security {

    public static function sanitize_input($input, $type = 'text') {
        switch ($type) {
            case 'email':
                return sanitize_email($input);
            case 'url':
                return esc_url_raw($input);
            case 'textarea':
                return sanitize_textarea_field($input);
            case 'key':
                return sanitize_key($input);
            case 'int':
                return absint($input);
            case 'text':
            default:
                return sanitize_text_field($input);
        }
    }

    public static function verify_nonce($nonce, $action) {
        return wp_verify_nonce($nonce, $action);
    }

    public static function check_user_capability($capability = 'manage_options') {
        return current_user_can($capability);
    }

    public static function secure_redirect($location) {
        wp_safe_redirect($location);
        exit;
    }
}
