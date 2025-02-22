<?php
/**
 * Stickybar Admin Class
 */
class Stickybar_Admin {
    /**
     * Initialize the admin class
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            __('Sticky Bar Settings', 'stickybar'),
            __('Sticky Bar', 'stickybar'),
            'manage_options',
            'stickybar-settings',
            array($this, 'display_settings_page'),
            'dashicons-align-center',
            55
        );
    }

    /**
     * Register plugin settings
     */
    public function register_settings() {
        // WhatsApp Integration Settings
        register_setting(
            'stickybar_options',
            'stickybar_whatsapp_accounts',
            array(
                'type' => 'array',
                'sanitize_callback' => array($this, 'validate_whatsapp_accounts'),
                'default' => array()
            )
        );

        register_setting(
            'stickybar_options',
            'stickybar_whatsapp_enabled',
            array(
                'type' => 'string',
                'default' => '0'
            )
        );

        register_setting(
            'stickybar_options',
            'stickybar_whatsapp_display_style',
            array(
                'type' => 'string',
                'default' => 'modal'
            )
        );
    }

    /**
     * Validate WhatsApp accounts
     */
    public function validate_whatsapp_accounts($input) {
        $valid = array();
        
        if (!is_array($input)) {
            return $valid;
        }

        foreach ($input as $index => $account) {
            // Skip empty accounts
            if (empty($account['name']) || empty($account['phone'])) {
                continue;
            }

            $valid[] = array(
                'name' => sanitize_text_field($account['name']),
                'phone' => sanitize_text_field($account['phone']),
                'message' => sanitize_textarea_field($account['message']),
                'active' => isset($account['active']) ? 1 : 0
            );
        }

        return $valid;
    }

    /**
     * Display settings page
     */
    public function display_settings_page() {
        require_once STICKYBAR_PLUGIN_DIR . 'templates/admin/settings/whatsapp.php';
    }
}

// Initialize admin
new Stickybar_Admin();
