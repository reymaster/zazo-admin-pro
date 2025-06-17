<?php
/**
 * Página de licença com design Material.
 */
if (!defined('ABSPATH')) exit;
if (!current_user_can('manage_options')) return;

// Lógica de processamento do formulário (sem alterações)
// ...

$license_key = get_option('custom_admin_pro_license_key', '');
$license_status = get_option('custom_admin_pro_license_status', 'invalid');
?>

<div class="wrap">
    <h1><?php _e('Custom Admin Pro License', 'custom-admin-pro'); ?></h1>

    <div id="poststuff">
        <div class="postbox">
            <h2 class="hndle"><span><?php _e('License Management', 'custom-admin-pro'); ?></span></h2>
            <div class="inside">
                <div class="license-status">
                    <p>
                        <strong><?php _e('Status:', 'custom-admin-pro'); ?></strong>
                        <?php if ($license_status === 'valid'): ?>
                            <span class="status-badge status-valid">
                                <span class="material-icons-outlined">check_circle</span>
                                <?php _e('Active', 'custom-admin-pro'); ?>
                            </span>
                        <?php else: ?>
                            <span class="status-badge status-invalid">
                                 <span class="material-icons-outlined">cancel</span>
                                <?php _e('Inactive', 'custom-admin-pro'); ?>
                            </span>
                        <?php endif; ?>
                    </p>
                </div>

                <form method="post" action="">
                    <?php wp_nonce_field('custom_admin_pro_license_nonce'); ?>
                    <div class="form-group">
                        <label for="custom_admin_pro_license_key"><?php _e('License Key', 'custom-admin-pro'); ?></label>
                        <input type="text" name="custom_admin_pro_license_key" id="custom_admin_pro_license_key" value="<?php echo esc_attr($license_key); ?>" placeholder="XXXX-XXXX-XXXX-XXXX" <?php echo $license_status === 'valid' ? 'readonly' : ''; ?> class="regular-text">
                        <p class="description"><?php _e('Enter your license key to activate the plugin.', 'custom-admin-pro'); ?></p>
                    </div>

                    <?php if ($license_status !== 'valid'): ?>
                        <input type="submit" name="activate_license" class="button button-primary" value="<?php _e('Activate License', 'custom-admin-pro'); ?>">
                    <?php else: ?>
                        <input type="submit" name="deactivate_license" class="button button-secondary" value="<?php _e('Deactivate License', 'custom-admin-pro'); ?>">
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="postbox">
            <h2 class="hndle"><span><?php _e('License Features', 'custom-admin-pro'); ?></span></h2>
            <div class="inside">
                <ul class="license-features">
                    <li class="<?php echo $license_status === 'valid' ? 'active' : 'inactive'; ?>">
                        <span class="material-icons-outlined"><?php echo $license_status === 'valid' ? 'check_circle' : 'cancel'; ?></span>
                        <?php _e('Unlimited admin customizations', 'custom-admin-pro'); ?>
                    </li>
                    <li class="<?php echo $license_status === 'valid' ? 'active' : 'inactive'; ?>">
                        <span class="material-icons-outlined"><?php echo $license_status === 'valid' ? 'check_circle' : 'cancel'; ?></span>
                        <?php _e('Premium support', 'custom-admin-pro'); ?>
                    </li>
                    <li class="<?php echo $license_status === 'valid' ? 'active' : 'inactive'; ?>">
                        <span class="material-icons-outlined"><?php echo $license_status === 'valid' ? 'check_circle' : 'cancel'; ?></span>
                        <?php _e('Automatic updates', 'custom-admin-pro'); ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
