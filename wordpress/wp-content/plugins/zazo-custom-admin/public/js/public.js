(function($) {
    'use strict';

    window.customAdminProPublic = {

        init: function() {
            // Only initialize if user is logged in
            if ($('#wpadminbar').length) {
                this.setupFrontendFeatures();
                this.bindEvents();
            }
        },

        setupFrontendFeatures: function() {
            // Apply current theme
            const currentTheme = customAdminProPublic.current_theme || 'light';
            this.applyTheme(currentTheme);
        },

        bindEvents: function() {
            // Handle theme toggle from admin bar
            $(document).on('click', '#wp-admin-bar-custom-admin-pro-theme-toggle', function(e) {
                e.preventDefault();
                customAdminProPublic.toggleTheme();
            });
        },

        toggleTheme: function() {
            const currentTheme = $('body').hasClass('custom-admin-theme-dark') ? 'dark' : 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            $.ajax({
                url: customAdminProPublic.ajax_url,
                type: 'POST',
                data: {
                    action: 'toggle_admin_theme',
                    nonce: customAdminProPublic.nonce
                },
                success: function(response) {
                    if (response.success) {
                        customAdminProPublic.applyTheme(response.data.theme);
                    }
                }
            });
        },

        applyTheme: function(theme) {
            $('body').removeClass('custom-admin-theme-light custom-admin-theme-dark');
            $('body').addClass('custom-admin-theme-' + theme);

            // Update admin bar theme toggle icon
            const iconElement = $('#wp-admin-bar-custom-admin-pro-theme-toggle .ab-icon');
            if (iconElement.length) {
                iconElement.attr('title', theme === 'light' ? 'Switch to Dark Mode' : 'Switch to Light Mode');
            }
        }
    };

    // Initialize when document is ready
    $(document).ready(function() {
        customAdminProPublic.init();
    });

})(jQuery);

