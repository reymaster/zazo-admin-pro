(function($) {
    'use strict';

    window.customAdminPro = {
        init: function() {
            this.bindEvents();
            this.setupThemeToggle();
        },
        bindEvents: function() {
            // ... (seu código de eventos aqui)
        },
        setupThemeToggle: function() {
            const currentTheme = customAdminPro.current_theme || 'light';
            document.documentElement.setAttribute('data-theme', currentTheme);
        },
        toggleTheme: function() {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            $.ajax({
                url: customAdminPro.ajax_url, type: 'POST',
                data: { action: 'toggle_admin_theme', nonce: customAdminPro.nonce },
                success: function(response) {
                    if (response.success) {
                        document.documentElement.setAttribute('data-theme', response.data.theme);
                    }
                }
            });
        }
    };
    $(document).ready(function() {
        customAdminPro.init();
    });
})(jQuery);
