(function($) {
    'use strict';

    class WhatsAppSettings {
        constructor() {
            this.accountsContainer = $('#whatsapp-accounts-container');
            this.addAccountButton = $('#add-whatsapp-account');
            this.accountCount = $('.whatsapp-account-item').length;

            this.initializeEventListeners();
        }

        initializeEventListeners() {
            // Add new account
            this.addAccountButton.on('click', () => this.addNewAccount());

            // Remove account
            $(document).on('click', '.remove-account', (e) => this.removeAccount(e));

            // Form validation
            $('form').on('submit', (e) => this.validateForm(e));

            // Phone number validation
            $(document).on('input', 'input[name*="[phone]"]', (e) => this.validatePhoneNumber(e));

            // Time input handling
            $(document).on('change', 'input[type="time"]', (e) => this.handleTimeInput(e));

            // Availability toggle
            $(document).on('change', 'input[name*="[availability]"][type="checkbox"]', (e) => this.toggleAvailability(e));
        }

        addNewAccount() {
            const template = `
                <div class="whatsapp-account-item" data-account="${this.accountCount}">
                    <div class="account-header">
                        <h3>${this.accountCount + 1}. WhatsApp Account</h3>
                        <button type="button" class="button remove-account">Remove</button>
                    </div>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Name</th>
                            <td>
                                <input type="text" 
                                       name="stickybar_whatsapp_accounts[${this.accountCount}][name]" 
                                       class="regular-text"
                                       required>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Phone Number</th>
                            <td>
                                <input type="text" 
                                       name="stickybar_whatsapp_accounts[${this.accountCount}][phone]" 
                                       class="regular-text"
                                       placeholder="+1234567890"
                                       required>
                                <p class="description">Include country code (e.g., +1234567890)</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Default Message</th>
                            <td>
                                <textarea name="stickybar_whatsapp_accounts[${this.accountCount}][message]" 
                                          class="large-text" 
                                          rows="3"></textarea>
                                <p class="description">This message will be pre-filled when users click this account.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Availability</th>
                            <td>
                                ${this.getAvailabilityScheduleHtml(this.accountCount)}
                            </td>
                        </tr>
                    </table>
                </div>
            `;

            this.accountsContainer.append(template);
            this.accountCount++;
        }

        removeAccount(event) {
            const accountItem = $(event.target).closest('.whatsapp-account-item');
            
            if (confirm('Are you sure you want to remove this account?')) {
                accountItem.slideUp(300, function() {
                    $(this).remove();
                    this.reindexAccounts();
                }.bind(this));
            }
        }

        reindexAccounts() {
            $('.whatsapp-account-item').each((index, element) => {
                const item = $(element);
                item.attr('data-account', index);
                item.find('h3').text(`${index + 1}. WhatsApp Account`);
                
                item.find('input, textarea, select').each(function() {
                    const name = $(this).attr('name');
                    if (name) {
                        $(this).attr('name', name.replace(/\[\d+\]/, `[${index}]`));
                    }
                });
            });

            this.accountCount = $('.whatsapp-account-item').length;
        }

        validatePhoneNumber(event) {
            const input = $(event.target);
            let number = input.val().replace(/[^\d+]/g, '');
            
            if (number.charAt(0) !== '+') {
                number = '+' + number;
            }
            
            input.val(number);
            
            const isValid = /^\+\d{10,15}$/.test(number);
            input.toggleClass('error', !isValid);
            
            const description = input.siblings('.description');
            if (!isValid && number.length > 0) {
                description.addClass('error').text('Please enter a valid phone number with country code');
            } else {
                description.removeClass('error').text('Include country code (e.g., +1234567890)');
            }
        }

        validateForm(event) {
            let isValid = true;
            
            // Validate phone numbers
            $('input[name*="[phone]"]').each(function() {
                if (!/^\+\d{10,15}$/.test($(this).val())) {
                    isValid = false;
                    $(this).addClass('error');
                }
            });
            
            if (!isValid) {
                event.preventDefault();
                alert('Please correct the invalid phone numbers before saving.');
                return false;
            }
            
            return true;
        }

        getAvailabilityScheduleHtml(accountIndex) {
            const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            let html = '<div class="availability-schedule">';
            
            days.forEach(day => {
                const dayLower = day.toLowerCase();
                html += `
                    <div class="schedule-day">
                        <label>
                            <input type="checkbox" 
                                   name="stickybar_whatsapp_accounts[${accountIndex}][availability][${dayLower}][enabled]" 
                                   value="1">
                            ${day}
                        </label>
                        <div class="time-range">
                            <input type="time" 
                                   name="stickybar_whatsapp_accounts[${accountIndex}][availability][${dayLower}][start]" 
                                   value="09:00">
                            <span>to</span>
                            <input type="time" 
                                   name="stickybar_whatsapp_accounts[${accountIndex}][availability][${dayLower}][end]" 
                                   value="17:00">
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
            return html;
        }

        toggleAvailability(event) {
            const checkbox = $(event.target);
            const timeRange = checkbox.closest('.schedule-day').find('.time-range');
            timeRange.toggle(checkbox.is(':checked'));
        }
    }

    // Initialize on document ready
    $(document).ready(() => {
        new WhatsAppSettings();
    });

})(jQuery);
