<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

// Get settings if they exist
$settings = get_option('stickybar_settings', array());
?>

<div id="stickybar-container" class="stickybar-container">
    <div class="stickybar-content">
        <div class="stickybar-text">
            <?php echo esc_html(isset($settings['message']) ? $settings['message'] : 'Welcome to our website!'); ?>
        </div>
        <?php if (isset($settings['button_text']) && isset($settings['button_url'])): ?>
            <a href="<?php echo esc_url($settings['button_url']); ?>" class="stickybar-button">
                <?php echo esc_html($settings['button_text']); ?>
            </a>
        <?php endif; ?>
        <span class="stickybar-close">&times;</span>
    </div>
</div>
