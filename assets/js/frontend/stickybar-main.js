(function($) {
    'use strict';

    $(document).ready(function() {
        // Show the sticky bar if it hasn't been dismissed
        if (!getCookie('stickybar_dismissed')) {
            $('.stickybar-container').fadeIn();
        }

        // Handle close button click
        $('.stickybar-close').on('click', function() {
            $('.stickybar-container').fadeOut();
            // Set cookie to remember user's preference for 7 days
            setCookie('stickybar_dismissed', 'true', 7);
        });

        // Helper function to set cookie
        function setCookie(name, value, days) {
            var expires = '';
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = '; expires=' + date.toUTCString();
            }
            document.cookie = name + '=' + (value || '') + expires + '; path=/';
        }

        // Helper function to get cookie
        function getCookie(name) {
            var nameEQ = name + '=';
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1, c.length);
                }
                if (c.indexOf(nameEQ) === 0) {
                    return c.substring(nameEQ.length, c.length);
                }
            }
            return null;
        }

        // Add scroll event to show/hide sticky bar
        var lastScrollTop = 0;
        $(window).scroll(function() {
            var st = $(this).scrollTop();
            if (!getCookie('stickybar_dismissed')) {
                if (st > lastScrollTop && st > 200) {
                    // Scrolling down & past 200px
                    $('.stickybar-container').fadeIn();
                }
            }
            lastScrollTop = st;
        });
    });
})(jQuery);
