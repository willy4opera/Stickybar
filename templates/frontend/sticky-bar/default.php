<?php if (!defined('ABSPATH')) exit; ?>

<!-- WhatsApp Modal -->
<div id="whatsapp-modal">
    <div class="modal-overlay"></div>
    <div class="modal-container">
        <div class="modal-header">
            <h3>Contact Us via WhatsApp</h3>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-content">
            <?php
            $whatsapp_api = new Stickybar_WhatsApp_API();
            $accounts = $whatsapp_api->get_active_accounts();
            
            if (!empty($accounts)) :
                foreach ($accounts as $account) :
                    $current_title = wp_strip_all_tags(get_the_title());
                    $current_url = get_permalink();
                    $message = $account['message'] ?: sprintf(
                        __('Hello! I have a question about: %s - %s', 'stickybar'), 
                        $current_title, 
                        $current_url
                    );
                    $whatsapp_url = $whatsapp_api->generate_whatsapp_url($account['phone'], $message);
            ?>
                    <a href="<?php echo esc_url($whatsapp_url); ?>" 
                       class="whatsapp-account" 
                       target="_blank"
                       data-name="<?php echo esc_attr($account['name']); ?>"
                       data-phone="<?php echo esc_attr($account['phone']); ?>">
                        <div class="account-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="account-info">
                            <span class="account-name"><?php echo esc_html($account['name']); ?></span>
                            <span class="account-status">Online</span>
                        </div>
                    </a>
            <?php
                endforeach;
            else:
            ?>
                <div class="no-accounts">
                    <p><?php _e('No WhatsApp accounts available.', 'stickybar'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Auth Modal -->
<div id="auth-modal" style="display: none;">
    <?php echo do_shortcode('[biwillz_auth_modal]'); ?>
</div>

<!-- Sticky Bar -->
<div class="bottom-sticky-bar1">
    <a href="<?php echo home_url('/'); ?>" class="bar-item <?php echo is_front_page() ? 'active' : ''; ?>">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="<?php echo home_url('/my-account'); ?>" class="bar-item <?php echo is_page('my-account') ? 'active' : ''; ?>">
        <i class="fas fa-user"></i>
        <span>Account</span>
    </a>
    <a href="#" class="bar-item whatsapp-button" id="whatsapp-trigger">
        <i class="fab fa-whatsapp" style="font-size: 2.5em; color: #25D366;"></i>
    </a>
    <a href="<?php echo home_url('/shop'); ?>" class="bar-item <?php echo is_shop() ? 'active' : ''; ?>">
        <i class="fas fa-th"></i>
        <span>Categories</span>
    </a>
    <a href="#" class="bar-item" id="auth-trigger">
        <i class="fas fa-sign-in-alt"></i>
        <span>Login</span>
    </a>
</div>

<script>
(function($) {
    // Function to handle modal toggle
    function toggleAuthModal(show) {
        if (show) {
            $('#auth-modal').fadeIn(300);
            $('body').addClass('modal-open');
        } else {
            $('#auth-modal').fadeOut(300);
            $('body').removeClass('modal-open');
        }
    }

    // Initialize event handlers
    function initializeAuthModal() {
        // Remove previous event handlers to prevent duplicate bindings
        $(document).off('click.authModal keyup.authModal');

        // Use delegated event binding to ensure it works for dynamically added elements
        $(document).on('click.authModal', '#auth-trigger', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Ensure only direct clicks trigger the modal
            if (!$(this).data('modal-open')) {
                toggleAuthModal(true);
                $(this).data('modal-open', true); // Prevent duplicate clicks
            }
        });

        // Add close button handler
        $(document).on('click.authModal', '#auth-modal .modal-close', function(e) {
            e.preventDefault();
            toggleAuthModal(false);
            $('#auth-trigger').data('modal-open', false); // Reset state
        });

        // Handle clicks outside the modal
        $(document).on('click.authModal', function(e) {
            if ($('#auth-modal').is(':visible') &&
                !$(e.target).closest('#auth-modal .modal-content').length &&
                !$(e.target).closest('#auth-trigger').length) {
                toggleAuthModal(false);
                $('#auth-trigger').data('modal-open', false); // Reset state
            }
        });

        // Add ESC key handler
        $(document).on('keyup.authModal', function(e) {
            if (e.key === 'Escape') {
                toggleAuthModal(false);
                $('#auth-trigger').data('modal-open', false); // Reset state
            }
        });

        // Prevent modal from closing when clicking inside it
        $(document).on('click', '#auth-modal .modal-content', function(e) {
            e.stopPropagation();
        });
    }

    // Initialize when document is ready
    $(document).ready(function() {
        initializeAuthModal();
    });

    // Reinitialize on ajax complete
    $(document).ajaxComplete(function() {
        initializeAuthModal();
    });
})(jQuery);



</script>
