<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Stickybar
 * @subpackage Stickybar/admin
 */

class Stickybar_Admin {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    public function add_plugin_admin_menu() {
        add_menu_page(
            'Sticky Bar Settings',
            'Sticky Bar',
            'manage_options',
            'stickybar-settings',
            array($this, 'display_plugin_admin_page'),
            'dashicons-align-center',
            100
        );
    }

    public function register_settings() {
        register_setting('stickybar_options', 'stickybar_settings', array($this, 'validate_settings'));

        // General Settings
        add_settings_section(
            'stickybar_general',
            'General Settings',
            array($this, 'general_section_callback'),
            'stickybar-settings'
        );

        // Add settings fields
        add_settings_field(
            'enable_stickybar',
            'Enable Sticky Bar',
            array($this, 'enable_stickybar_callback'),
            'stickybar-settings',
            'stickybar_general'
        );

        // WhatsApp Settings
        add_settings_section(
            'stickybar_whatsapp',
            'WhatsApp Settings',
            array($this, 'whatsapp_section_callback'),
            'stickybar-settings'
        );

        // Style Settings
        add_settings_section(
            'stickybar_style',
            'Style Settings',
            array($this, 'style_section_callback'),
            'stickybar-settings'
        );

        // Menu Items Settings
        add_settings_section(
            'stickybar_menu',
            'Menu Items',
            array($this, 'menu_section_callback'),
            'stickybar-settings'
        );
    }

    public function validate_settings($input) {
        $valid = array();

        // Sanitize and validate each setting
        $valid['enable_stickybar'] = isset($input['enable_stickybar']) ? 1 : 0;
        $valid['gradient_start'] = sanitize_hex_color($input['gradient_start']);
        $valid['gradient_end'] = sanitize_hex_color($input['gradient_end']);
        
        // WhatsApp numbers validation
        $valid['whatsapp_numbers'] = array();
        if (isset($input['whatsapp_numbers']) && is_array($input['whatsapp_numbers'])) {
            foreach ($input['whatsapp_numbers'] as $number) {
                if (!empty($number['number'])) {
                    $valid['whatsapp_numbers'][] = array(
                        'number' => sanitize_text_field($number['number']),
                        'title' => sanitize_text_field($number['title']),
                        'hours' => sanitize_text_field($number['hours'])
                    );
                }
            }
        }

        return $valid;
    }

    public function display_plugin_admin_page() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/views/admin-display.php';
    }

    public function enqueue_admin_styles($hook) {
        if ('toplevel_page_stickybar-settings' !== $hook) {
            return;
        }
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style(
            'stickybar-admin',
            plugin_dir_url(__FILE__) . 'css/stickybar-admin.css',
            array(),
            $this->version,
            'all'
        );
    }

    public function enqueue_admin_scripts($hook) {
        if ('toplevel_page_stickybar-settings' !== $hook) {
            return;
        }
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script(
            'stickybar-admin',
            plugin_dir_url(__FILE__) . 'js/stickybar-admin.js',
            array('jquery', 'wp-color-picker'),
            $this->version,
            false
        );
    }
}
