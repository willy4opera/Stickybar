(function($) {
    'use strict';

    class StickyBar {
        constructor() {
            this.bar = $('.bottom-sticky-bar1');
            this.whatsappButton = $('#whatsapp-trigger');
            this.modal = $('#whatsapp-modal');
            this.modalContainer = this.modal.find('.modal-container');
            this.modalOverlay = this.modal.find('.modal-overlay');
            this.closeButton = this.modal.find('.modal-close');
            this.lastScrollPosition = 0;
            this.scrollThreshold = 10;
            this.touchStart = 0;
            this.touchEnd = 0;

            this.init();
        }

        init() {
            this.initializeScrollHandling();
            this.initializeTouchHandling();
            this.initializeWhatsAppModal();
            this.initializeRippleEffect();
        }

        initializeScrollHandling() {
            $(window).on('scroll', () => {
                const currentScroll = $(window).scrollTop();
                
                if (Math.abs(currentScroll - this.lastScrollPosition) > this.scrollThreshold) {
                    if (currentScroll > this.lastScrollPosition && currentScroll > 100) {
                        this.bar.css('transform', 'translateY(100%)');
                    } else {
                        this.bar.css('transform', 'translateY(0)');
                    }
                    this.lastScrollPosition = currentScroll;
                }

                // Show bar at bottom of page
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                    this.bar.css('transform', 'translateY(0)');
                }
            });
        }

        initializeTouchHandling() {
            document.addEventListener('touchstart', (e) => {
                this.touchStart = e.changedTouches[0].screenY;
            }, false);

            document.addEventListener('touchend', (e) => {
                this.touchEnd = e.changedTouches[0].screenY;
                this.handleGesture();
            }, false);
        }

        handleGesture() {
            if (this.touchStart - this.touchEnd > 50) {
                this.bar.css('transform', 'translateY(100%)');
            } else if (this.touchEnd - this.touchStart > 50) {
                this.bar.css('transform', 'translateY(0)');
            }
        }

        initializeWhatsAppModal() {
            // Handle WhatsApp button click
            this.whatsappButton.on('click', (e) => {
                e.preventDefault();
                
                // Get current page info for message
                const pageTitle = document.title;
                const pageUrl = window.location.href;
                
                // Update all WhatsApp links in modal with current page info
                this.modal.find('.whatsapp-account').each((index, element) => {
                    const link = $(element);
                    const baseUrl = link.attr('href').split('?')[0];
                    const message = `${pageTitle}\n${pageUrl}`;
                    link.attr('href', `${baseUrl}?text=${encodeURIComponent(message)}`);
                });
                
                this.modal.css('display', 'block').addClass('active');
                this.modalContainer.addClass('active');
                $('body').addClass('modal-open');
            });

            // Close modal
            const closeModal = () => {
                this.modalContainer.removeClass('active');
                this.modal.removeClass('active');
                setTimeout(() => {
                    this.modal.css('display', 'none');
                }, 300);
                $('body').removeClass('modal-open');
            };

            this.closeButton.add(this.modalOverlay).on('click', closeModal);

            // Close modal on escape key
            $(document).on('keydown', (e) => {
                if (e.key === 'Escape' && this.modal.is(':visible')) {
                    closeModal();
                }
            });

            // Prevent modal content clicks from closing modal
            this.modalContainer.on('click', (e) => {
                e.stopPropagation();
            });

            // Track WhatsApp clicks
            this.modal.find('.whatsapp-account').on('click', function() {
                const accountName = $(this).data('name');
                const accountPhone = $(this).data('phone');
                
                // Optional: add analytics tracking
                console.log(`WhatsApp clicked: ${accountName} (${accountPhone})`);
            });
        }

        initializeRippleEffect() {
            this.bar.find('.bar-item').on('click', function(e) {
                const ripple = $('<div/>', { class: 'ripple' });
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                
                ripple.css({
                    width: size + 'px',
                    height: size + 'px',
                    left: (e.clientX - rect.left - size/2) + 'px',
                    top: (e.clientY - rect.top - size/2) + 'px'
                });
                
                $(this).append(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        }
    }

    // Initialize on document ready
    $(document).ready(() => {
        new StickyBar();
    });

})(jQuery);