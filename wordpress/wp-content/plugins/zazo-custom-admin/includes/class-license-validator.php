<?php

class Custom_Admin_Pro_License_Validator {

    private $api_url = 'https://assets.virtuhosting.net/api/v1/';
    private $encryption_key;

    public function __construct() {
        $this->encryption_key = $this->get_or_create_encryption_key();
    }

    public function validate_license($license_key, $domain = null) {
        if (!$domain) {
            $domain = $this->get_current_domain();
        }

        $fingerprint = $this->generate_hardware_fingerprint();

        $validation_data = array(
            'action' => 'validate_license',
            'license_key' => $license_key,
            'domain' => hash('sha256', $domain),
            'fingerprint' => $fingerprint,
            'timestamp' => time(),
            'nonce' => wp_generate_uuid4(),
            'version' => CUSTOM_ADMIN_PRO_VERSION
        );

        $signature = $this->generate_signature($validation_data);
        $validation_data['signature'] = $signature;

        $status = $this->make_api_request('validate', $validation_data);

        if (isset($status['valid']) && $status['valid'] === false) {
            delete_option('custom_admin_pro_license_key');
            update_option('custom_admin_pro_license_status', 'invalid');
            delete_option('custom_admin_pro_last_license_check');
        }

        return $status;
    }

    public function check_license_status() {
        $license_key = get_option('custom_admin_pro_license_key');
        $last_check = get_option('custom_admin_pro_last_license_check', 0);
        $check_interval = 5000; //24 * HOUR_IN_SECONDS; // 24 hours

        if (!$license_key) {
            return false;
        }

        // if (time() - $last_check > $check_interval) {
        //     $this->periodic_license_check();
        // }
        $this->periodic_license_check();

        return get_option('custom_admin_pro_license_status', 'invalid') === 'valid';
    }

    public function periodic_license_check() {
        $license_key = get_option('custom_admin_pro_license_key');

        if (!$license_key) {
            return;
        }

        $validation_result = $this->validate_license($license_key);

        if ($validation_result && isset($validation_result['valid']) && $validation_result['valid']) {
            update_option('custom_admin_pro_license_status', 'valid');
            update_option('custom_admin_pro_last_license_check', time());
            delete_option('custom_admin_pro_license_grace_period');
        } else {
            $this->handle_invalid_license($validation_result);
        }
    }

    private function handle_invalid_license($result) {
        $grace_period = get_option('custom_admin_pro_license_grace_period');

        if (!$grace_period) {
            // Start 7-day grace period
            $grace_period = time() + (7 * 24 * HOUR_IN_SECONDS);
            update_option('custom_admin_pro_license_grace_period', $grace_period);
        }

        if (time() > $grace_period) {
            update_option('custom_admin_pro_license_status', 'expired');
            // Add admin notice
            add_action('admin_notices', array($this, 'license_expired_notice'));
        } else {
            update_option('custom_admin_pro_license_status', 'grace_period');
            add_action('admin_notices', array($this, 'license_grace_notice'));
        }
    }

    public function license_expired_notice() {
        echo '<div class="notice notice-error"><p>';
        echo __('Custom Admin Pro license has expired. Please renew your license to continue using all features.', 'custom-admin-pro');
        echo '</p></div>';
    }

    public function license_grace_notice() {
        $grace_end = get_option('custom_admin_pro_license_grace_period');
        $days_left = ceil(($grace_end - time()) / (24 * HOUR_IN_SECONDS));

        echo '<div class="notice notice-warning"><p>';
        printf(__('Custom Admin Pro license validation failed. You have %d days remaining in your grace period.', 'custom-admin-pro'), $days_left);
        echo '</p></div>';
    }

    private function generate_hardware_fingerprint() {
        $components = array(
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? '',
            'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? '',
            'server_name' => $_SERVER['SERVER_NAME'] ?? '',
            'php_version' => PHP_VERSION,
            'wp_version' => get_bloginfo('version'),
            'disk_space' => disk_total_space('/'),
            'memory_limit' => ini_get('memory_limit')
        );

        return hash('sha256', serialize($components));
    }

    private function generate_signature($data) {
        ksort($data);
        $query_string = http_build_query($data);
        return hash_hmac('sha256', $query_string, $this->get_client_secret());
    }

    private function make_api_request($endpoint, $data) {
        $response = wp_remote_post($this->api_url . $endpoint, array(
            'timeout' => 30,
            'headers' => array(
                'Content-Type' => 'application/json',
                'User-Agent' => 'Custom-Admin-Pro/' . CUSTOM_ADMIN_PRO_VERSION
            ),
            'body' => json_encode($data),
            'sslverify' => true
        ));

        if (is_wp_error($response)) {
            return array('error' => 'Network error: ' . $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        $decoded = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return array('error' => 'Invalid response format');
        }

        return $this->verify_response_signature($decoded);
    }

    private function verify_response_signature($response) {
        if (!isset($response['signature'])) {
            return array('error' => 'Missing response signature');
        }

        $signature = $response['signature'];
        unset($response['signature']);

        $expected_signature = hash_hmac('sha256', json_encode($response), $this->get_client_secret());

        if (!hash_equals($signature, $expected_signature)) {
            return array('error' => 'Invalid response signature');
        }

        return $response;
    }

    private function get_current_domain() {
        return $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
    }

    private function get_client_secret() {
        return '74dca9fa7f03464ef04e04bbad8566e6f061f6c4aa29ec74f4f230411a08a3b7';
    }

    private function get_or_create_encryption_key() {
        $key = get_option('custom_admin_pro_encryption_key');

        if (!$key) {
            if (function_exists('sodium_crypto_secretbox_keygen')) {
                $key = base64_encode(sodium_crypto_secretbox_keygen());
            } else {
                $key = base64_encode(openssl_random_pseudo_bytes(32));
            }
            update_option('custom_admin_pro_encryption_key', $key);
        }

        return base64_decode($key);
    }
}
