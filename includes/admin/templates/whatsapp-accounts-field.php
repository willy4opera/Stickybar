<?php
/**
 * Template for WhatsApp accounts management in admin settings
 *
 * @package Stickybar
 */

// Get saved accounts or initialize empty array
$accounts = get_option('stickybar_whatsapp_accounts', array());
?>

<div class="whatsapp-accounts-container">
    <div class="whatsapp-accounts-list" id="whatsapp-accounts-list">
        <?php
        if (!empty($accounts)) {
            foreach ($accounts as $index => $account) {
                ?>
                <div class="whatsapp-account-item" data-index="<?php echo esc_attr($index); ?>">
                    <h4>Account <?php echo $index + 1; ?> <span class="remove-account dashicons dashicons-trash"></span></h4>
                    <div class="account-fields">
                        <div class="field-group">
                            <label>Name:</label>
                            <input type="text" 
                                   name="stickybar_whatsapp_accounts[<?php echo $index; ?>][name]" 
                                   value="<?php echo esc_attr($account['name']); ?>" 
                                   placeholder="e.g., Customer Support"
                                   required />
                        </div>
                        <div class="field-group">
                            <label>Phone Number:</label>
                            <input type="text" 
                                   name="stickybar_whatsapp_accounts[<?php echo $index; ?>][phone]" 
                                   value="<?php echo esc_attr($account['phone']); ?>" 
                                   placeholder="e.g., +1234567890"
                                   required />
                        </div>
                        <div class="field-group">
                            <label>Default Message:</label>
                            <textarea name="stickybar_whatsapp_accounts[<?php echo $index; ?>][message]" 
                                      placeholder="e.g., Hello! I have a question about: "
                                      rows="2"><?php echo esc_textarea($account['message']); ?></textarea>
                        </div>
                        <div class="field-group">
                            <label>
                                <input type="checkbox" 
                                       name="stickybar_whatsapp_accounts[<?php echo $index; ?>][active]" 
                                       value="1" 
                                       <?php checked(!empty($account['active']), true); ?> />
                                Active
                            </label>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <button type="button" class="button button-secondary" id="add-whatsapp-account">
        <span class="dashicons dashicons-plus-alt2"></span> Add New WhatsApp Account
    </button>
</div>

<script type="text/template" id="whatsapp-account-template">
    <div class="whatsapp-account-item" data-index="{{index}}">
        <h4>Account {{number}} <span class="remove-account dashicons dashicons-trash"></span></h4>
        <div class="account-fields">
            <div class="field-group">
                <label>Name:</label>
                <input type="text" 
                       name="stickybar_whatsapp_accounts[{{index}}][name]" 
                       placeholder="e.g., Customer Support"
                       required />
            </div>
            <div class="field-group">
                <label>Phone Number:</label>
                <input type="text" 
                       name="stickybar_whatsapp_accounts[{{index}}][phone]" 
                       placeholder="e.g., +1234567890"
                       required />
            </div>
            <div class="field-group">
                <label>Default Message:</label>
                <textarea name="stickybar_whatsapp_accounts[{{index}}][message]" 
                          placeholder="e.g., Hello! I have a question about: "
                          rows="2"></textarea>
            </div>
            <div class="field-group">
                <label>
                    <input type="checkbox" 
                           name="stickybar_whatsapp_accounts[{{index}}][active]" 
                           value="1" 
                           checked />
                    Active
                </label>
            </div>
        </div>
    </div>
</script>

<style>
.whatsapp-accounts-container {
    max-width: 800px;
    margin: 20px 0;
}
.whatsapp-account-item {
    background: #fff;
    border: 1px solid #ccd0d4;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 4px;
}
.whatsapp-account-item h4 {
    margin: 0 0 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.field-group {
    margin-bottom: 15px;
}
.field-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}
.field-group input[type="text"],
.field-group textarea {
    width: 100%;
    max-width: 400px;
}
.field-group textarea {
    resize: vertical;
}
.remove-account {
    color: #dc3545;
    cursor: pointer;
}
.remove-account:hover {
    color: #c82333;
}
#add-whatsapp-account {
    margin-top: 10px;
}
</style>

<script>
jQuery(document).ready(function($) {
    let accountCount = $('.whatsapp-account-item').length;

    $('#add-whatsapp-account').on('click', function() {
        const template = $('#whatsapp-account-template').html();
        const newAccount = template
            .replace(/{{index}}/g, accountCount)
            .replace(/{{number}}/g, accountCount + 1);
        $('#whatsapp-accounts-list').append(newAccount);
        accountCount++;
    });

    $(document).on('click', '.remove-account', function() {
        $(this).closest('.whatsapp-account-item').remove();
        // Reindex remaining accounts
        $('.whatsapp-account-item').each(function(index) {
            $(this).find('h4').first().text('Account ' + (index + 1));
            $(this).attr('data-index', index);
            $(this).find('input, textarea').each(function() {
                const name = $(this).attr('name');
                $(this).attr('name', name.replace(/\[\d+\]/, '[' + index + ']'));
            });
        });
        accountCount--;
    });
});
</script>
