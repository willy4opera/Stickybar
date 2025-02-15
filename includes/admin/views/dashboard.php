<?php
/**
 * Admin settings page template
 *
 * @package Stickybar
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="stickybar-admin-container">
        <div class="stickybar-admin-main">
            <form method="post" action="options.php">
                <?php
                settings_fields('stickybar_options');
                do_settings_sections('stickybar-settings');
                ?>

                <div class="stickybar-settings-section">
                    <h2>General Settings</h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Enable Sticky Bar</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="stickybar_settings[enable_stickybar]" value="1" 
                                        <?php checked(1, get_option('stickybar_settings')['enable_stickybar'] ?? 0); ?>>
                                    Enable mobile sticky bar
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="stickybar-settings-section">
                    <h2>Style Settings</h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Gradient Colors</th>
                            <td>
                                <label>
                                    Start Color:
                                    <input type="text" class="stickybar-color-picker" 
                                        name="stickybar_settings[gradient_start]" 
                                        value="<?php echo esc_attr(get_option('stickybar_settings')['gradient_start'] ?? '#2e08f4'); ?>">
                                </label>
                                <br><br>
                                <label>
                                    End Color:
                                    <input type="text" class="stickybar-color-picker" 
                                        name="stickybar_settings[gradient_end]" 
                                        value="<?php echo esc_attr(get_option('stickybar_settings')['gradient_end'] ?? '#cf13e4'); ?>">
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="stickybar-settings-section">
                    <h2>WhatsApp Settings</h2>
                    <div id="whatsapp-numbers">
                        <?php
                        $whatsapp_numbers = get_option('stickybar_settings')['whatsapp_numbers'] ?? array();
                        if (empty($whatsapp_numbers)) {
                            $whatsapp_numbers[] = array('number' => '', 'title' => '', 'hours' => '');
                        }
                        foreach ($whatsapp_numbers as $index => $number) :
                        ?>
                            <div class="whatsapp-number-entry">
                                <input type="text" 
                                    name="stickybar_settings[whatsapp_numbers][<?php echo $index; ?>][number]" 
                                    value="<?php echo esc_attr($number['number']); ?>"
                                    placeholder="WhatsApp Number">
                                <input type="text" 
                                    name="stickybar_settings[whatsapp_numbers][<?php echo $index; ?>][title]" 
                                    value="<?php echo esc_attr($number['title']); ?>"
                                    placeholder="Title (e.g., Customer Support)">
                                <input type="text" 
                                    name="stickybar_settings[whatsapp_numbers][<?php echo $index; ?>][hours]" 
                                    value="<?php echo esc_attr($number['hours']); ?>"
                                    placeholder="Available Hours">
                                <button type="button" class="button remove-whatsapp-number">Remove</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="button add-whatsapp-number">Add WhatsApp Number</button>
                </div>

                <div class="stickybar-settings-section">
                    <h2>Preview</h2>
                    <div class="stickybar-preview">
                        <!-- Preview will be updated via JavaScript -->
                    </div>
                </div>

                <?php submit_button(); ?>
            </form>
        </div>

        <div class="stickybar-admin-sidebar">
            <div class="stickybar-admin-box">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="https://williamsobi.com.ng" target="_blank">Developer Website</a></li>
                    <li><a href="https://git.com/willy4opera" target="_blank">GitHub</a></li>
                    <li><a href="tel:08030756350">Support: 08030756350</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
