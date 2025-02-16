<?php
// Test data setup
function stickybar_setup_test_accounts() {
    // Test WhatsApp accounts
    $test_accounts = array(
        array(
            'name' => 'Sales Team',
            'phone' => '+234123456789', // Replace with your test number
            'message' => 'Hi! I have a question about: ',
            'active' => true
        ),
        array(
            'name' => 'Customer Support',
            'phone' => '+234987654321', // Replace with your test number
            'message' => 'Hello! I need help with: ',
            'active' => true
        ),
        array(
            'name' => 'Technical Support',
            'phone' => '+234567891234', // Replace with your test number
            'message' => 'Technical question about: ',
            'active' => true
        )
    );

    // Save test accounts
    update_option('stickybar_whatsapp_accounts', $test_accounts);
    
    // Enable WhatsApp integration
    update_option('stickybar_whatsapp_enabled', '1');
    
    // Set display style to modal
    update_option('stickybar_whatsapp_display_style', 'modal');
    
    error_log('StickyBar: Test accounts set up successfully');
    error_log('StickyBar Accounts: ' . print_r($test_accounts, true));
}

// Add debug functions
function stickybar_debug_info() {
    error_log('StickyBar Debug Info:');
    error_log('WhatsApp Enabled: ' . get_option('stickybar_whatsapp_enabled'));
    error_log('Display Style: ' . get_option('stickybar_whatsapp_display_style'));
    error_log('Accounts: ' . print_r(get_option('stickybar_whatsapp_accounts'), true));
}

// Add menu item for test setup
add_action('admin_menu', function() {
    add_submenu_page(
        null, // Hidden from menu
        'Setup Test Data',
        'Setup Test Data',
        'manage_options',
        'stickybar-test-setup',
        function() {
            if (isset($_POST['setup_test_data'])) {
                stickybar_setup_test_accounts();
                echo '<div class="notice notice-success"><p>Test accounts have been set up successfully!</p></div>';
            }
            ?>
            <div class="wrap">
                <h1>StickyBar Test Setup</h1>
                <form method="post">
                    <p>Click the button below to set up test WhatsApp accounts.</p>
                    <input type="submit" name="setup_test_data" class="button button-primary" value="Set Up Test Data">
                </form>
            </div>
            <?php
        }
    );
});

// Add test setup link to plugin action links
add_filter('plugin_action_links_' . plugin_basename(STICKYBAR_PLUGIN_FILE), function($links) {
    $setup_link = '<a href="' . admin_url('admin.php?page=stickybar-test-setup') . '">Setup Test Data</a>';
    array_unshift($links, $setup_link);
    return $links;
});
