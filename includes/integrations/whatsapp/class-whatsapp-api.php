<?php
if (!defined('ABSPATH')) exit;

class Stickybar_WhatsApp_API {
    private $accounts;
    private $settings;

    public function __construct() {
        $this->init();
    }

    private function init() {
        // Load or create default accounts
        $this->accounts = get_option('stickybar_whatsapp_accounts', array());
        if (empty($this->accounts)) {
            $this->create_default_accounts();
        }

        // Load or set default settings
        $this->settings = array(
            'enabled' => get_option('stickybar_whatsapp_enabled', '1'),
            'display_style' => get_option('stickybar_whatsapp_display_style', 'modal')
        );
    }

    private function create_default_accounts() {
        $default_accounts = array(
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

        update_option('stickybar_whatsapp_accounts', $default_accounts);
        update_option('stickybar_whatsapp_enabled', '1');
        update_option('stickybar_whatsapp_display_style', 'modal');

        $this->accounts = $default_accounts;
    }

    public function get_accounts() {
        return $this->accounts;
    }

    public function get_active_accounts() {
        return array_filter($this->accounts, function($account) {
            return isset($account['active']) && $account['active'];
        });
    }

    public function generate_whatsapp_url($phone, $message = '') {
        // Remove any non-numeric characters except plus sign
        $phone = preg_replace('/[^\d+]/', '', $phone);
        
        // Remove plus sign for URL
        if (substr($phone, 0, 1) === '+') {
            $phone = substr($phone, 1);
        }
        
        $url = 'https://wa.me/' . $phone;
        if (!empty($message)) {
            $url .= '?text=' . urlencode($message);
        }
        
        return $url;
    }

    public function is_enabled() {
        return $this->settings['enabled'] === '1';
    }

    public function get_display_style() {
        return $this->settings['display_style'];
    }

    public function save_accounts($accounts) {
        $this->accounts = $accounts;
        return update_option('stickybar_whatsapp_accounts', $accounts);
    }

    public function get_current_page_info() {
        return array(
            'title' => wp_strip_all_tags(get_the_title()),
            'url' => get_permalink()
        );
    }
}
