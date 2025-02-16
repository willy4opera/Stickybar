<?php
/**
 * Plugin Name: StickyBar Test Setup
 * Description: Adds test data for WhatsApp Sticky Bar
 * Version: 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Add menu item under tools
add_action('admin_menu', function() {
    add_submenu_page(
        'tools.php',
        'StickyBar Test Setup',
        'StickyBar Test',
        'manage_options',
        'stickybar-test-setup',
        'stickybar_test_setup_page'
    );
});

function stickybar_test_setup_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // Save test data if form is submitted
    if (isset($_POST['setup_test_data']) && check_admin_referer('stickybar_test_setup')) {
        // Test WhatsApp accounts
        $test_accounts = array(
            array(
                'name' => 'Sales Team',
                'phone' => '+2348123456789',
                'message' => 'I have a question about: ',
                'active' => true
            ),
            array(
                'name' => 'Support Team',
                'phone' => '+2348234567890',
                'message' => 'I need help with: ',
                'active' => true
            ),
            array(
                'name' => 'Technical Support',
                'phone' => '+2348345678901',
                'message' => 'Technical question about: ',
                'active' => true
            )
        );

        // Save test accounts
        update_option('stickybar_whatsapp_accounts', $test_accounts);
        update_option('stickybar_whatsapp_enabled', '1');
        update_option('stickybar_whatsapp_display_style', 'modal');

        echo '<div class="notice notice-success"><p>Test data has been added successfully!</p></div>';
    }

    // Display the setup form
    ?>
    <div class="wrap">
        <h1>StickyBar Test Setup</h1>
        <form method="post">
            <?php wp_nonce_field('stickybar_test_setup'); ?>
            <p>Click the button below to add test WhatsApp accounts:</p>
            <input type="submit" name="setup_test_data" class="button button-primary" value="Set Up Test Data">
        </form>

        <h2>Current Settings</h2>
        <h3>WhatsApp Accounts:</h3>
        <pre><?php print_r(get_option('stickybar_whatsapp_accounts')); ?></pre>

        <h3>Other Settings:</h3>
        <p>WhatsApp Enabled: <?php echo get_option('stickybar_whatsapp_enabled') ? 'Yes' : 'No'; ?></p>
        <p>Display Style: <?php echo get_option('stickybar_whatsapp_display_style'); ?></p>
    </div>
    <?php
}
