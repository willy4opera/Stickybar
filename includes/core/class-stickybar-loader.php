<?php

class Stickybar {
    private $version;
    private $plugin_name;

    public function __construct() {
        $this->version = STICKYBAR_VERSION;
        $this->plugin_name = 'stickybar';
    }

    public function run() {
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        // Load template file
        require_once STICKYBAR_PLUGIN_DIR . 'includes/templates/sticky-bar-template.php';
    }

    private function set_locale() {
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
    }

    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'stickybar',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }

    private function define_admin_hooks() {
        // Add menu to WordPress admin
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // Register settings
        add_action('admin_init', array($this, 'register_settings'));
    }

    private function define_public_hooks() {
        // Enqueue styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        
        // Add sticky bar to footer
        add_action('wp_footer', array($this, 'render_sticky_bar'));
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            $this->plugin_name,
            STICKYBAR_PLUGIN_URL . 'css/stickybar.css',
            array(),
            $this->version,
            'all'
        );
    }

    public function enqueue_scripts() {
        wp_enqueue_script(
            $this->plugin_name,
            STICKYBAR_PLUGIN_URL . 'js/stickybar.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    public function add_admin_menu() {
        add_options_page(
            __('Sticky Bar Settings', 'stickybar'),
            __('Sticky Bar', 'stickybar'),
            'manage_options',
            $this->plugin_name,
            array($this, 'display_plugin_admin_page')
        );
    }

    public function register_settings() {
        register_setting(
            'stickybar_options',
            'stickybar_settings',
            array($this, 'validate_settings')
        );
    }

    public function validate_settings($input) {
        return $input;
    }

    public function display_plugin_admin_page() {
        include_once STICKYBAR_PLUGIN_DIR . 'admin/admin-display.php';
    }

    public function render_sticky_bar() {
        include_once STICKYBAR_PLUGIN_DIR . 'includes/templates/sticky-bar-template.php';
    }
}
