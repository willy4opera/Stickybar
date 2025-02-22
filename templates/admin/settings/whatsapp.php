<?php
if (!defined('ABSPATH')) exit;

$accounts = get_option('stickybar_whatsapp_accounts', array());
?>

<div class="wrap stickybar-whatsapp-settings">
    <h1><?php _e('WhatsApp Integration Settings', 'stickybar'); ?></h1>
    
    <form method="post" action="options.php">
        <?php settings_fields('stickybar_options'); ?>
        
        <div class="card">
            <h2><?php _e('Sticky Bar Settings', 'stickybar'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('Enable WhatsApp Integration', 'stickybar'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="stickybar_whatsapp_enabled" 
                                   value="1" <?php checked(get_option('stickybar_whatsapp_enabled'), '1'); ?>>
                            <?php _e('Show WhatsApp button in sticky bar', 'stickybar'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Display Style', 'stickybar'); ?></th>
                    <td>
                        <select name="stickybar_whatsapp_display_style">
                            <option value="modal" <?php selected(get_option('stickybar_whatsapp_display_style'), 'modal'); ?>>
                                <?php _e('Modal with Account List', 'stickybar'); ?>
                            </option>
                            <option value="direct" <?php selected(get_option('stickybar_whatsapp_display_style'), 'direct'); ?>>
                                <?php _e('Direct Link to Primary Account', 'stickybar'); ?>
                            </option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <h2><?php _e('WhatsApp Accounts', 'stickybar'); ?></h2>
            <div id="whatsapp-accounts-container">
                <?php if (!empty($accounts)) : ?>
                    <?php foreach ($accounts as $index => $account) : ?>
                        <div class="whatsapp-account-item">
                            <div class="account-header">
                                <h3><?php _e('Account', 'stickybar'); ?> #<?php echo $index + 1; ?></h3>
                                <button type="button" class="button remove-account"><?php _e('Remove', 'stickybar'); ?></button>
                            </div>
                            <table class="form-table">
                                <tr>
                                    <th scope="row"><?php _e('Name', 'stickybar'); ?></th>
                                    <td>
                                        <input type="text" 
                                               name="stickybar_whatsapp_accounts[<?php echo $index; ?>][name]" 
                                               value="<?php echo esc_attr($account['name']); ?>"
                                               class="regular-text">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Phone Number', 'stickybar'); ?></th>
                                    <td>
                                        <input type="text" 
                                               name="stickybar_whatsapp_accounts[<?php echo $index; ?>][phone]" 
                                               value="<?php echo esc_attr($account['phone']); ?>"
                                               class="regular-text">
                                        <p class="description"><?php _e('Include country code (e.g., +1234567890)', 'stickybar'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Default Message', 'stickybar'); ?></th>
                                    <td>
                                        <textarea name="stickybar_whatsapp_accounts[<?php echo $index; ?>][message]"
                                                  class="large-text" 
                                                  rows="3"><?php echo esc_textarea($account['message']); ?></textarea>
                                    </td>
                                </tr>
                                <input type="hidden" 
                                       name="stickybar_whatsapp_accounts[<?php echo $index; ?>][active]" 
                                       value="1">
                            </table>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <button type="button" class="button button-secondary" id="add-whatsapp-account">
                <?php _e('Add New Account', 'stickybar'); ?>
            </button>
        </div>

        <?php submit_button(); ?>
    </form>
</div>

<style>
.stickybar-whatsapp-settings .card {
    background: #fff;
    border: 1px solid #ccd0d4;
    border-radius: 4px;
    padding: 20px;
    margin: 20px 0;
}

.whatsapp-account-item {
    background: #f8f9fa;
    border: 1px solid #e2e4e7;
    border-radius: 4px;
    padding: 15px;
    margin-bottom: 20px;
}

.account-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
</style>

<script>
jQuery(document).ready(function($) {
    // Add new account
    $('#add-whatsapp-account').on('click', function() {
        const accountsContainer = $('#whatsapp-accounts-container');
        const accountCount = $('.whatsapp-account-item').length;
        const accountTemplate = `
            <div class="whatsapp-account-item">
                <div class="account-header">
                    <h3><?php _e('Account', 'stickybar'); ?> #${accountCount + 1}</h3>
                    <button type="button" class="button remove-account"><?php _e('Remove', 'stickybar'); ?></button>
                </div>
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php _e('Name', 'stickybar'); ?></th>
                        <td>
                            <input type="text" 
                                   name="stickybar_whatsapp_accounts[${accountCount}][name]" 
                                   value="" 
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('Phone Number', 'stickybar'); ?></th>
                        <td>
                            <input type="text" 
                                   name="stickybar_whatsapp_accounts[${accountCount}][phone]" 
                                   value="" 
                                   class="regular-text">
                            <p class="description"><?php _e('Include country code (e.g., +1234567890)', 'stickybar'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('Default Message', 'stickybar'); ?></th>
                        <td>
                            <textarea name="stickybar_whatsapp_accounts[${accountCount}][message]" 
                                      class="large-text" 
                                      rows="3"></textarea>
                        </td>
                    </tr>
                    <input type="hidden" 
                           name="stickybar_whatsapp_accounts[${accountCount}][active]" 
                           value="1">
                </table>
            </div>
        `;
        accountsContainer.append(accountTemplate);
    });

    // Remove account
    $(document).on('click', '.remove-account', function() {
        $(this).closest('.whatsapp-account-item').remove();
        // Renumber remaining accounts
        $('.whatsapp-account-item').each(function(index) {
            $(this).find('h3').text(`<?php _e('Account', 'stickybar'); ?> #${index + 1}`);
        });
    });
});
</script>
