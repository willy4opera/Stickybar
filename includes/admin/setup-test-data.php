<?php
/**
 * Add test WhatsApp accounts to the database
 */
function stickybar_add_test_accounts() {
    // Sample WhatsApp accounts
    $test_accounts = array(
        array(
            'name' => 'Customer Support',
            'phone' => '+1234567890',
            'message' => 'Hello! I have a question about: ',
            'active' => true
        ),
        array(
            'name' => 'Sales Team',
            'phone' => '+2345678901',
            'message' => 'Hi! I\'m interested in: ',
            'active' => true
        ),
        array(
            'name' => 'Technical Support',
            'phone' => '+3456789012',
            'message' => 'I need technical assistance with: ',
            'active' => true
        )
    );

    // Save test accounts
    update_option('stickybar_whatsapp_accounts', $test_accounts);

    // Enable WhatsApp integration
    update_option('stickybar_whatsapp_enabled', '1');

    // Set display style to modal
    update_option('stickybar_whatsapp_display_style', 'modal');

    return true;
}

// Add activation hook to set up test data
register_activation_hook(STICKYBAR_PLUGIN_FILE, 'stickybar_add_test_accounts');

// Add action to manually trigger test data setup
if (isset($_GET['setup_test_data']) && current_user_can('manage_options')) {
    stickybar_add_test_accounts();
    wp_redirect(admin_url('admin.php?page=stickybar-settings&test_data_added=1'));
    exit;
}
