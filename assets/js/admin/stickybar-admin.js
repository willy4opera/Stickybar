(function($) {
    'use strict';

    $(document).ready(function() {
        // Initialize color pickers
        $('.stickybar-color-picker').wpColorPicker({
            change: updatePreview
        });

        // Handle adding new WhatsApp number fields
        $('.add-whatsapp-number').on('click', function() {
            const index = $('.whatsapp-number-entry').length;
            const template = `
                <div class="whatsapp-number-entry">
                    <input type="text" 
                        name="stickybar_settings[whatsapp_numbers][${index}][number]" 
                        placeholder="WhatsApp Number">
                    <input type="text" 
                        name="stickybar_settings[whatsapp_numbers][${index}][title]" 
                        placeholder="Title (e.g., Customer Support)">
                    <input type="text" 
                        name="stickybar_settings[whatsapp_numbers][${index}][hours]" 
                        placeholder="Available Hours">
                    <button type="button" class="button remove-whatsapp-number">Remove</button>
                </div>
            `;
            $('#whatsapp-numbers').append(template);
        });

        // Handle removing WhatsApp number fields
        $(document).on('click', '.remove-whatsapp-number', function() {
            $(this).closest('.whatsapp-number-entry').remove();
            updateWhatsappNumbersIndexes();
        });

        // Update preview on settings change
        $('input, select').on('change', updatePreview);

        // Initial preview update
        updatePreview();

        function updateWhatsappNumbersIndexes() {
            $('.whatsapp-number-entry').each(function(index) {
                $(this).find('input').each(function() {
                    const name = $(this).attr('name');
                    $(this).attr('name', name.replace(/\[\d+\]/, `[${index}]`));
                });
            });
        }

        function updatePreview() {
            const startColor = $('input[name="stickybar_settings[gradient_start]"]').val() || '#2e08f4';
            const endColor = $('input[name="stickybar_settings[gradient_end]"]').val() || '#cf13e4';
            
            $('.stickybar-preview').css({
                'background': `linear-gradient(45deg, ${startColor}, ${endColor})`,
                'height': '60px',
                'border-radius': '5px',
                'margin-top': '10px'
            });
        }
    });
})(jQuery);
