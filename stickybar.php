<?php
/**
 * Plugin Name: Stickybar
 * Plugin URI: https://williamsobi.com.ng/plugins/stickybar
 * Description: A customizable sticky bar for WordPress websites
 * Version: 0.1.0
 * Author: Williams Obi
 * Author URI: https://williamsobi.com.ng
 * License: GPL v2 or later
 * Text Domain: stickybar
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('STICKYBAR_VERSION', '0.1.0');
define('STICKYBAR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('STICKYBAR_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once STICKYBAR_PLUGIN_DIR . 'includes/class-stickybar.php';

// Initialize the plugin
function run_stickybar() {
    $plugin = new Stickybar();
    $plugin->run();
}
add_action('plugins_loaded', 'run_stickybar');
