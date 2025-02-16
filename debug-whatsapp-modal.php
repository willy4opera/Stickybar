<?php
/**
 * Debug WhatsApp Modal Functionality
 * This file helps debug the WhatsApp modal implementation
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check
if (!current_user_can('manage_options')) {
    wp_die('Access denied');
}

// Get WhatsApp API instance
$whatsapp_api = new Stickybar_WhatsApp_API();

// Debug information
echo "<h2>WhatsApp Modal Debug Information</h2>";
echo "<pre>";

echo "Plugin Settings:\n";
echo "===============\n";
echo "WhatsApp Enabled: " . ($whatsapp_api->is_enabled() ? 'Yes' : 'No') . "\n";
echo "Display Style: " . $whatsapp_api->get_display_style() . "\n\n";

echo "Active WhatsApp Accounts:\n";
echo "=======================\n";
$active_accounts = $whatsapp_api->get_active_accounts();
print_r($active_accounts);

echo "\nAll WhatsApp Accounts:\n";
echo "====================\n";
$all_accounts = $whatsapp_api->get_accounts();
print_r($all_accounts);

echo "\nDatabase Options:\n";
echo "================\n";
echo "stickybar_whatsapp_accounts:\n";
print_r(get_option('stickybar_whatsapp_accounts'));
echo "\nstickybar_whatsapp_enabled: " . get_option('stickybar_whatsapp_enabled') . "\n";
echo "stickybar_whatsapp_display_style: " . get_option('stickybar_whatsapp_display_style') . "\n";

echo "\nModal Template Test:\n";
echo "==================\n";
echo "Template file exists: " . (file_exists(STICKYBAR_PLUGIN_PATH . 'templates/frontend/modals/whatsapp.php') ? 'Yes' : 'No') . "\n";
echo "Template path: " . STICKYBAR_PLUGIN_PATH . 'templates/frontend/modals/whatsapp.php' . "\n";

echo "\nScript Loading:\n";
echo "=============\n";
echo "Frontend JS exists: " . (file_exists(STICKYBAR_PLUGIN_URL . 'assets/js/frontend.js') ? 'Yes' : 'No') . "\n";
echo "Frontend CSS exists: " . (file_exists(STICKYBAR_PLUGIN_URL . 'assets/css/frontend.css') ? 'Yes' : 'No') . "\n";

echo "</pre>";

// Add test modal display
echo "<h3>Test Modal Display</h3>";
echo "<p>Click the button below to test the WhatsApp modal:</p>";
echo '<button onclick="jQuery(\'#whatsapp-modal\').addClass(\'active\');">Test WhatsApp Modal</button>';

// Include modal template
include STICKYBAR_PLUGIN_PATH . 'templates/frontend/modals/whatsapp.php';

// Add necessary styles and scripts
wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
wp_enqueue_style('stickybar-frontend', STICKYBAR_PLUGIN_URL . 'assets/css/frontend.css');
wp_enqueue_script('jquery');
wp_enqueue_script('stickybar-frontend', STICKYBAR_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'));
wp_footer();
