<?php

class Custom_Admin_Pro_Admin {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Enfileira a folha de estilos principal e única.
     */
    public function enqueue_styles() {
        wp_enqueue_style(
            $this->plugin_name . '-admin',
            CUSTOM_ADMIN_PRO_PLUGIN_URL . 'admin/css/admin.css',
            array(),
            time() // Força o navegador a sempre carregar a versão mais recente
        );
    }

    /**
     * Enfileira o arquivo JS.
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            $this->plugin_name . '-admin',
            CUSTOM_ADMIN_PRO_PLUGIN_URL . 'admin/js/admin.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    /**
     * Remove os widgets padrão do WordPress e adiciona os customizados.
     */
    public function customize_dashboard() {
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
        remove_meta_box('dashboard_primary', 'dashboard', 'side');
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
        remove_meta_box('dashboard_welcome', 'dashboard', 'normal');

        // Mantém apenas o widget de Status do Diagnóstico e adiciona o nosso
        wp_add_dashboard_widget(
            'zazo_teams_widget',
            'Equipe do Site',
            array($this, 'render_teams_widget')
        );
    }

    /**
     * Renderiza o HTML do widget de equipe.
     */
    public function render_teams_widget() {
        $users = get_users(['orderby' => 'display_name', 'order' => 'ASC']);
        echo '<div class="teams-table-wrapper"><table class="teams-table"><thead><tr><th>USUÁRIO</th><th>FUNÇÃO</th><th>DATA DE REGISTRO</th></tr></thead><tbody>';
        foreach ($users as $user) {
            $user_data = get_userdata($user->ID);
            $role = !empty($user_data->roles) ? ucfirst(str_replace('_', ' ', $user_data->roles[0])) : 'N/A';
            $registered_date = date_i18n(get_option('date_format'), strtotime($user_data->user_registered));
            echo '<tr><td><div class="team-member">' . get_avatar($user->ID, 32) . '<span class="name">' . esc_html($user_data->display_name) . '</span></div></td><td>' . esc_html($role) . '</td><td>' . esc_html($registered_date) . '</td></tr>';
        }
        echo '</tbody></table></div>';
    }
}
