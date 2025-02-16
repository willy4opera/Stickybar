<?php
// Load WordPress
require_once('../../../wp-load.php');

// Check if user is an administrator
if (!current_user_can('manage_options')) {
    die('Access denied');
}

// Initialize WhatsApp API
$whatsapp_api = new Stickybar_WhatsApp_API();

// Debug output
echo "<pre>";
echo "WhatsApp Settings:\n";
echo "=================\n\n";

echo "Enabled: " . ($whatsapp_api->is_enabled() ? 'Yes' : 'No') . "\n";
echo "Display Style: " . $whatsapp_api->get_display_style() . "\n\n";

echo "Active Accounts:\n";
echo "===============\n\n";
$active_accounts = $whatsapp_api->get_active_accounts();
print_r($active_accounts);

echo "\nAll Accounts:\n";
echo "============\n\n";
$all_accounts = $whatsapp_api->get_accounts();
print_r($all_accounts);

echo "\nOptions in Database:\n";
echo "==================\n\n";
echo "stickybar_whatsapp_accounts: \n";
print_r(get_option('stickybar_whatsapp_accounts'));

echo "\nstickybar_whatsapp_enabled: \n";
print_r(get_option('stickybar_whatsapp_enabled'));

echo "\nstickybar_whatsapp_display_style: \n";
print_r(get_option('stickybar_whatsapp_display_style'));

echo "</pre>";
