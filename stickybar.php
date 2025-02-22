<?php
/**
 * Plugin Name: Sticky Bar
 * Plugin URI: https://biwillz.com
 * Description: A WhatsApp sticky bar with multiple accounts support
 * Version: 2.0.0
 * Author: Biwillz
 * Author URI: https://biwillz.com
 * License: GPL v2 or later
 * Text Domain: stickybar
 */

if (!defined('ABSPATH')) exit;

define('STICKYBAR_VERSION', '1.0.0');
define('STICKYBAR_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('STICKYBAR_PLUGIN_URL', plugin_dir_url(__FILE__));
define('STICKYBAR_PLUGIN_FILE', __FILE__);

require_once STICKYBAR_PLUGIN_PATH . 'includes/integrations/whatsapp/class-whatsapp-api.php';
require_once STICKYBAR_PLUGIN_PATH . 'includes/admin/test-setup.php';

class Stickybar {
    private static $instance = null;
    private $whatsapp_api;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->whatsapp_api = new Stickybar_WhatsApp_API();
        $this->init_hooks();
    }

    private function init_hooks() {
        // Frontend
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'render_sticky_bar'));

        // Admin
        if (is_admin()) {
            add_action('admin_menu', array($this, 'add_admin_menu'));
            add_action('admin_init', array($this, 'register_settings'));
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        }
    }

    public function enqueue_scripts() {
        // Font Awesome
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            array(),
            '5.15.4'
        );

        // Plugin styles
        wp_enqueue_style(
            'stickybar-style',
            STICKYBAR_PLUGIN_URL . 'assets/css/frontend.css',
            array(),
            STICKYBAR_VERSION
        );

        // Plugin scripts
        wp_enqueue_script(
            'stickybar-script',
            STICKYBAR_PLUGIN_URL . 'assets/js/frontend.js',
            array('jquery'),
            STICKYBAR_VERSION,
            true
        );

        // Localize script
        wp_localize_script('stickybar-script', 'stickybarData', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('stickybar-nonce'),
            'currentPage' => array(
                'title' => wp_strip_all_tags(get_the_title()),
                'url' => get_permalink()
            )
        ));
    }

    public function admin_enqueue_scripts($hook) {
        if (strpos($hook, 'stickybar') === false) {
            return;
        }

        wp_enqueue_style(
            'stickybar-admin',
            STICKYBAR_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            STICKYBAR_VERSION
        );

        wp_enqueue_script(
            'stickybar-admin',
            STICKYBAR_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            STICKYBAR_VERSION,
            true
        );
    }

    public function render_sticky_bar() {
        if (!$this->whatsapp_api->is_enabled()) {
            return;
        }

        include STICKYBAR_PLUGIN_PATH . 'templates/frontend/sticky-bar/default.php';
    }

    public function add_admin_menu() {
        add_menu_page(
            'Sticky Bar Settings',
            'Sticky Bar',
            'manage_options',
            'stickybar-settings',
            array($this, 'render_settings_page'),
            'dashicons-share',
            30
        );
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        include STICKYBAR_PLUGIN_PATH . 'templates/admin/settings/whatsapp.php';
    }

    public function register_settings() {
        register_setting('stickybar_options', 'stickybar_whatsapp_accounts');
        register_setting('stickybar_options', 'stickybar_whatsapp_enabled');
        register_setting('stickybar_options', 'stickybar_whatsapp_display_style');
    }

    public static function activate() {
        // Set up test accounts on activation
        stickybar_setup_test_accounts();
        flush_rewrite_rules();
    }

    public static function deactivate() {
        flush_rewrite_rules();
    }
}

// Initialize plugin
function run_stickybar() {
    return Stickybar::get_instance();
}

// Hooks
register_activation_hook(__FILE__, array('Stickybar', 'activate'));
register_deactivation_hook(__FILE__, array('Stickybar', 'deactivate'));

// Start plugin
add_action('plugins_loaded', 'run_stickybar');
