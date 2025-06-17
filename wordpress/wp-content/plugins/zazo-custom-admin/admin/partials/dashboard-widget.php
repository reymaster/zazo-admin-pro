<?php
/**
 * Conteúdo do widget do dashboard com ícones e botões atualizados.
 */

if (!defined('ABSPATH')) exit;

$current_user = wp_get_current_user();
$theme = get_user_meta(get_current_user_id(), 'custom_admin_theme', true) ?: 'light';
?>

<div class="custom-admin-welcome-widget">
    <h3><?php printf(__('Welcome, %s!', 'custom-admin-pro'), esc_html($current_user->display_name)); ?></h3>
    <p><?php _e('Thank you for using Custom Admin Pro. Your admin area is now enhanced with modern features.', 'custom-admin-pro'); ?></p>

    <div class="quick-actions">
        <h4><?php _e('Quick Actions', 'custom-admin-pro'); ?></h4>
        <div class="action-buttons">
            <a href="#" onclick="customAdminPro.toggleTheme(); return false;" class="button button-secondary">
                <span class="material-icons-outlined" style="font-size: 18px; margin-right: 8px;">
                    <?php echo $theme === 'light' ? 'dark_mode' : 'light_mode'; ?>
                </span>
                <?php echo $theme === 'light' ? __('Switch to Dark Mode', 'custom-admin-pro') : __('Switch to Light Mode', 'custom-admin-pro'); ?>
            </a>
            <a href="<?php echo admin_url('admin.php?page=custom-admin-pro'); ?>" class="button button-primary">
                <?php _e('Settings', 'custom-admin-pro'); ?>
            </a>
        </div>
    </div>
</div>
