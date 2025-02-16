<?php
if (!defined('ABSPATH')) exit;

$whatsapp_api = new Stickybar_WhatsApp_API();
$accounts = $whatsapp_api->get_active_accounts();

// Get current page info
$current_title = wp_strip_all_tags(get_the_title());
$current_url = get_permalink();
?>

<div id="whatsapp-modal" class="whatsapp-modal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="modal-container">
        <div class="modal-header">
            <h3><?php _e('Chat with Us', 'stickybar'); ?></h3>
            <button type="button" class="modal-close">&times;</button>
        </div>
        
        <div class="modal-content">
            <?php if (!empty($accounts)) : ?>
                <div class="whatsapp-accounts-list">
                    <?php foreach ($accounts as $account) : 
                        // Prepare default message with current page info
                        $message = $account['message'];
                        if (empty($message)) {
                            $message = sprintf(
                                __('Hi! I have a question about: %s', 'stickybar'),
                                $current_title
                            );
                        }
                        $message .= "\n" . $current_url;
                        
                        $whatsapp_url = $whatsapp_api->generate_whatsapp_url(
                            $account['phone'],
                            $message
                        );
                    ?>
                        <a href="<?php echo esc_url($whatsapp_url); ?>" 
                           class="whatsapp-account" 
                           target="_blank"
                           rel="noopener noreferrer"
                           data-phone="<?php echo esc_attr($account['phone']); ?>"
                           data-name="<?php echo esc_attr($account['name']); ?>">
                            
                            <div class="account-avatar">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            
                            <div class="account-info">
                                <span class="account-name">
                                    <?php echo esc_html($account['name']); ?>
                                </span>
                                <span class="account-status">
                                    <?php _e('Online', 'stickybar'); ?>
                                </span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="no-accounts">
                    <p><?php _e('No WhatsApp accounts are currently available.', 'stickybar'); ?></p>
                    <p><?php _e('Please try again during business hours.', 'stickybar'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


