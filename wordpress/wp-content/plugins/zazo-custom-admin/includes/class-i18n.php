<?php

class Custom_Admin_Pro_i18n {

    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'custom-admin-pro',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}

