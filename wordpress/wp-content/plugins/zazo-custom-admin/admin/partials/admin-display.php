<?php
/**
 * Página de configurações do admin com layout de cards.
 */

if (!defined('ABSPATH')) exit;
if (!current_user_can('manage_options')) return;

$license_status = get_option('custom_admin_pro_license_status', 'invalid');
$current_theme = get_user_meta(get_current_user_id(), 'custom_admin_theme', true) ?: 'light';
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <?php if ($license_status !== 'valid'): ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php _e('Please activate your license to unlock all features.', 'custom-admin-pro'); ?></p>
        </div>
    <?php endif; ?>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="postbox">
                    <h2 class="hndle"><span><?php _e('General Settings', 'custom-admin-pro'); ?></span></h2>
                    <div class="inside">
                        <form method="post" action="options.php">
                            <?php settings_fields('custom_admin_pro_settings'); ?>
                            <div class="form-group">
                                <label for="custom_admin_pro_theme"><?php _e('Default Theme', 'custom-admin-pro'); ?></label>
                                <select name="custom_admin_pro_theme" id="custom_admin_pro_theme">
                                    <option value="light" <?php selected($current_theme, 'light'); ?>><?php _e('Light', 'custom-admin-pro'); ?></option>
                                    <option value="dark" <?php selected($current_theme, 'dark'); ?>><?php _e('Dark', 'custom-admin-pro'); ?></option>
                                </select>
                                <p class="description"><?php _e('Select the default theme for the admin area.', 'custom-admin-pro'); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="custom_admin_pro_dashboard_layout"><?php _e('Dashboard Layout', 'custom-admin-pro'); ?></label>
                                <select name="custom_admin_pro_dashboard_layout" id="custom_admin_pro_dashboard_layout">
                                    <option value="default"><?php _e('Default', 'custom-admin-pro'); ?></option>
                                    <option value="minimal"><?php _e('Minimal', 'custom-admin-pro'); ?></option>
                                </select>
                                <p class="description"><?php _e('Choose your preferred dashboard layout.', 'custom-admin-pro'); ?></p>
                            </div>
                            <?php submit_button(__('Save Settings', 'custom-admin-pro'), 'primary'); ?>
                        </form>
                    </div>
                </div>
            </div>

            <div id="postbox-container-1" class="postbox-container">
                <div class="postbox">
                     <h2 class="hndle"><span><?php _e('Features', 'custom-admin-pro'); ?></span></h2>
                     <div class="inside">
                         <div class="feature-grid">
                             <div class="feature-item">
                                 <span class="material-icons-outlined">palette</span>
                                 <h3><?php _e('Theme Switching', 'custom-admin-pro'); ?></h3>
                                 <p><?php _e('Toggle between light and dark themes instantly.', 'custom-admin-pro'); ?></p>
                             </div>
                             <div class="feature-item">
                                 <span class="material-icons-outlined">dashboard</span>
                                 <h3><?php _e('Custom Dashboard', 'custom-admin-pro'); ?></h3>
                                 <p><?php _e('Personalized dashboard with custom widgets.', 'custom-admin-pro'); ?></p>
                             </div>
                             <div class="feature-item">
                                 <span class="material-icons-outlined">verified_user</span>
                                 <h3><?php _e('Secure Licensing', 'custom-admin-pro'); ?></h3>
                                 <p><?php _e('Advanced license protection system.', 'custom-admin-pro'); ?></p>
                             </div>
                             <div class="feature-item">
                                 <span class="material-icons-outlined">tune</span>
                                 <h3><?php _e('Full Customization', 'custom-admin-pro'); ?></h3>
                                 <p><?php _e('Customize every aspect of your admin area.', 'custom-admin-pro'); ?></p>
                             </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
