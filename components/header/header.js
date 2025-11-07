/**
 * Header Component JavaScript - SafePilot WordPress Theme
 * 
 * @package    SafePilot
 * @subpackage Components/Header
 * @version    2.0.0
 * @author     PB MEDIA
 * @since      1.0.0
 * 
 * Features:
 * - Sticky header with scroll detection
 * - Mobile menu with touch gestures
 * - Search overlay with focus trap
 * - Accessibility controls
 * - Smooth animations
 * - Performance optimized with throttling/debouncing
 */

(function (window, document) {
    'use strict';

    /**
     * SafePilot Header Controller
     * Main class handling all header functionality
     */
    class SafePilotHeader {
        /**
         * Constructor
         */
        constructor() {
            // Configuration
            this.config = {
                stickyOffset: 100,
                scrollThrottle: 10,
                resizeDebounce: 150,
                mobileBreakpoint: 992,
                animationDuration: 300,
                swipeThreshold: 50
            };

            // State management
            this.state = {
                isSticky: false,
                isMobileMenuOpen: false,
                isSearchOpen: false,
                scrollPosition: 0,
                lastScrollPosition: 0,
                scrollDirection: null,
                isMobile: false,
                touchStartX: null,
                touchStartY: null
            };

            // DOM Elements cache
            this.elements = {};
            
            // Bind methods
            this.handleScroll = this.throttle(this.handleScroll.bind(this), this.config.scrollThrottle);
            this.handleResize = this.debounce(this.handleResize.bind(this), this.config.resizeDebounce);
            
            // Initialize on DOM ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => this.init());
            } else {
                this.init();
            }
        }

        /**
         * Initialize header functionality
         */
        init() {
            this.cacheElements();
            this.checkMobile();
            this.bindEvents();
            this.initStickyHeader();
            this.initMobileMenu();
            this.initSearchOverlay();
            this.initAccessibility();
            this.initDropdowns();
            this.initReadingProgress();
            this.restoreAccessibilitySettings();
            this.initAnimations();
            
            // Announce to other scripts
            window.dispatchEvent(new CustomEvent('safepilot:header:initialized'));
            
            console.log('SafePilot Header initialized successfully');
        }

        /**
         * Cache DOM elements for performance
         */
        cacheElements() {
            this.elements = {
                // Main elements
                header: document.querySelector('.safepilot-header'),
                topbar: document.querySelector('.safepilot-topbar'),
                mainHeader: document.querySelector('.safepilot-header__main'),
                
                // Navigation
                nav: document.querySelector('.safepilot-header__nav'),
                navItems: document.querySelectorAll('.safepilot-nav > li'),
                dropdowns: document.querySelectorAll('.menu-item-has-children'),
                
                // Mobile menu
                mobileToggle: document.querySelector('.safepilot-header__mobile-toggle'),
                mobileMenu: document.querySelector('.safepilot-mobile-menu'),
                mobileOverlay: document.querySelector('.safepilot-mobile-menu__overlay'),
                mobileContent: document.querySelector('.safepilot-mobile-menu__content'),
                mobileClose: document.querySelector('.safepilot-mobile-menu__close'),
                mobileNav: document.querySelector('.safepilot-mobile-nav'),
                
                // Search
                searchToggle: document.querySelector('.safepilot-header__search-toggle'),
                searchOverlay: document.querySelector('.safepilot-search-overlay'),
                searchClose: document.querySelector('.safepilot-search-overlay__close'),
                searchInput: document.querySelector('.safepilot-search-form__input'),
                searchForm: document.querySelector('.safepilot-search-form--large'),
                popularSearches: document.querySelectorAll('.safepilot-search-tag'),
                
                // Cart
                cartToggle: document.querySelector('.safepilot-cart-toggle'),
                miniCart: document.querySelector('.safepilot-minicart'),
                cartCount: document.querySelector('.safepilot-cart-count'),
                
                // User
                userDropdown: document.querySelector('#userDropdown'),
                
                // Accessibility
                accessibilityToggle: document.querySelector('.safepilot-accessibility-toggle'),
                accessibilityModal: document.querySelector('#accessibilityModal'),
                fontSizeButtons: document.querySelectorAll('[data-font-size]'),
                contrastButtons: document.querySelectorAll('[data-contrast]'),
                accessibilityOptions: document.querySelectorAll('[data-accessibility]'),
                resetButton: document.querySelector('#resetAccessibility'),
                
                // Reading progress
                readingProgress: document.querySelector('.safepilot-reading-progress__bar'),
                
                // CTA
                ctaButton: document.querySelector('.safepilot-btn--gradient')
            };
        }

        /**
         * Bind all event listeners
         */
        bindEvents() {
            // Scroll events
            window.addEventListener('scroll', this.handleScroll);
            window.addEventListener('resize', this.handleResize);
            
            // Mobile menu events
            if (this.elements.mobileToggle) {
                this.elements.mobileToggle.addEventListener('click', () => this.toggleMobileMenu());
            }
            
            if (this.elements.mobileClose) {
                this.elements.mobileClose.addEventListener('click', () => this.closeMobileMenu());
            }
            
            if (this.elements.mobileOverlay) {
                this.elements.mobileOverlay.addEventListener('click', () => this.closeMobileMenu());
            }
            
            // Search events
            if (this.elements.searchToggle) {
                this.elements.searchToggle.addEventListener('click', () => this.toggleSearch());
            }
            
            if (this.elements.searchClose) {
                this.elements.searchClose.addEventListener('click', () => this.closeSearch());
            }
            
            // ESC key to close overlays
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (this.state.isSearchOpen) this.closeSearch();
                    if (this.state.isMobileMenuOpen) this.closeMobileMenu();
                }
            });
            
            // Touch events for mobile menu swipe
            if (this.elements.mobileContent) {
                this.elements.mobileContent.addEventListener('touchstart', (e) => this.handleTouchStart(e), { passive: true });
                this.elements.mobileContent.addEventListener('touchmove', (e) => this.handleTouchMove(e), { passive: true });
                this.elements.mobileContent.addEventListener('touchend', (e) => this.handleTouchEnd(e));
            }
            
            // Popular searches
            this.elements.popularSearches.forEach(tag => {
                tag.addEventListener('click', (e) => {
                    e.preventDefault();
                    const searchTerm = tag.textContent.trim();
                    if (this.elements.searchInput) {
                        this.elements.searchInput.value = searchTerm;
                        this.elements.searchForm.submit();
                    }
                });
            });
            
            // Accessibility events
            this.bindAccessibilityEvents();
            
            // Cart hover enhancement
            if (this.elements.cartToggle && this.elements.miniCart) {
                let cartTimeout;
                
                this.elements.cartToggle.addEventListener('mouseenter', () => {
                    clearTimeout(cartTimeout);
                    this.elements.miniCart.classList.add('show');
                });
                
                this.elements.cartToggle.addEventListener('mouseleave', () => {
                    cartTimeout = setTimeout(() => {
                        this.elements.miniCart.classList.remove('show');
                    }, 300);
                });
                
                this.elements.miniCart.addEventListener('mouseenter', () => {
                    clearTimeout(cartTimeout);
                });
                
                this.elements.miniCart.addEventListener('mouseleave', () => {
                    cartTimeout = setTimeout(() => {
                        this.elements.miniCart.classList.remove('show');
                    }, 300);
                });
            }
        }

        /**
         * Initialize sticky header functionality
         */
        initStickyHeader() {
            if (!this.elements.header || !this.elements.header.classList.contains('safepilot-header--sticky')) {
                return;
            }

            // Create placeholder to prevent layout jump
            this.createHeaderPlaceholder();
            
            // Initial check
            this.updateStickyState();
            
            // Intersection Observer for performance
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach(entry => {
                            if (!entry.isIntersecting && window.scrollY > this.config.stickyOffset) {
                                this.enableSticky();
                            } else if (entry.isIntersecting && window.scrollY <= this.config.stickyOffset) {
                                this.disableSticky();
                            }
                        });
                    },
                    {
                        threshold: 0,
                        rootMargin: `-${this.config.stickyOffset}px 0px 0px 0px`
                    }
                );
                
                if (this.elements.header) {
                    observer.observe(this.elements.header);
                }
            }
        }

        /**
         * Create header placeholder for smooth sticky transition
         */
        createHeaderPlaceholder() {
            if (!this.headerPlaceholder) {
                this.headerPlaceholder = document.createElement('div');
                this.headerPlaceholder.className = 'safepilot-header-placeholder';
                this.headerPlaceholder.style.display = 'none';
                this.elements.header.parentNode.insertBefore(this.headerPlaceholder, this.elements.header.nextSibling);
            }
        }

        /**
         * Enable sticky header
         */
        enableSticky() {
            if (this.state.isSticky) return;
            
            this.state.isSticky = true;
            this.elements.header.classList.add('scrolled');
            
            // Set placeholder height
            if (this.headerPlaceholder) {
                const headerHeight = this.elements.header.offsetHeight;
                this.headerPlaceholder.style.height = `${headerHeight}px`;
                this.headerPlaceholder.style.display = 'block';
            }
            
            // Animate in
            requestAnimationFrame(() => {
                this.elements.header.style.transform = 'translateY(0)';
            });
            
            // Dispatch event
            window.dispatchEvent(new CustomEvent('safepilot:header:sticky:enabled'));
        }

        /**
         * Disable sticky header
         */
        disableSticky() {
            if (!this.state.isSticky) return;
            
            this.state.isSticky = false;
            this.elements.header.classList.remove('scrolled');
            
            // Hide placeholder
            if (this.headerPlaceholder) {
                this.headerPlaceholder.style.display = 'none';
            }
            
            // Reset transform
            this.elements.header.style.transform = '';
            
            // Dispatch event
            window.dispatchEvent(new CustomEvent('safepilot:header:sticky:disabled'));
        }

        /**
         * Update sticky header state based on scroll
         */
        updateStickyState() {
            const scrollY = window.scrollY || window.pageYOffset;
            
            if (scrollY > this.config.stickyOffset && !this.state.isSticky) {
                this.enableSticky();
            } else if (scrollY <= this.config.stickyOffset && this.state.isSticky) {
                this.disableSticky();
            }
            
            // Hide/show on scroll direction (optional)
            if (this.state.isSticky) {
                if (this.state.scrollDirection === 'down' && scrollY > 200) {
                    this.elements.header.style.transform = 'translateY(-100%)';
                } else if (this.state.scrollDirection === 'up') {
                    this.elements.header.style.transform = 'translateY(0)';
                }
            }
        }

        /**
         * Handle scroll event
         */
        handleScroll() {
            const scrollY = window.scrollY || window.pageYOffset;
            
            // Update scroll direction
            if (scrollY > this.state.lastScrollPosition) {
                this.state.scrollDirection = 'down';
            } else if (scrollY < this.state.lastScrollPosition) {
                this.state.scrollDirection = 'up';
            }
            
            this.state.scrollPosition = scrollY;
            this.state.lastScrollPosition = scrollY;
            
            // Update sticky state
            this.updateStickyState();
            
            // Update reading progress
            this.updateReadingProgress();
        }

        /**
         * Initialize mobile menu functionality
         */
        initMobileMenu() {
            if (!this.elements.mobileMenu) return;
            
            // Handle dropdown toggles in mobile menu
            const dropdownToggles = this.elements.mobileNav?.querySelectorAll('.menu-item-has-children > a');
            
            dropdownToggles?.forEach(toggle => {
                // Add dropdown toggle button
                const dropdownButton = document.createElement('button');
                dropdownButton.className = 'safepilot-mobile-dropdown-toggle';
                dropdownButton.setAttribute('aria-label', 'Toggle submenu');
                dropdownButton.innerHTML = '<i class="fas fa-chevron-down"></i>';
                
                toggle.parentNode.insertBefore(dropdownButton, toggle.nextSibling);
                
                dropdownButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const parent = e.target.closest('.menu-item-has-children');
                    const submenu = parent.querySelector('.sub-menu');
                    
                    if (parent.classList.contains('open')) {
                        // Close submenu
                        parent.classList.remove('open');
                        submenu.style.maxHeight = '0';
                        dropdownButton.setAttribute('aria-expanded', 'false');
                    } else {
                        // Close other open submenus
                        this.elements.mobileNav.querySelectorAll('.menu-item-has-children.open').forEach(item => {
                            item.classList.remove('open');
                            const itemSubmenu = item.querySelector('.sub-menu');
                            if (itemSubmenu) itemSubmenu.style.maxHeight = '0';
                        });
                        
                        // Open this submenu
                        parent.classList.add('open');
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        dropdownButton.setAttribute('aria-expanded', 'true');
                    }
                });
            });
        }

        /**
         * Toggle mobile menu
         */
        toggleMobileMenu() {
            if (this.state.isMobileMenuOpen) {
                this.closeMobileMenu();
            } else {
                this.openMobileMenu();
            }
        }

        /**
         * Open mobile menu
         */
        openMobileMenu() {
            if (this.state.isMobileMenuOpen) return;
            
            this.state.isMobileMenuOpen = true;
            
            // Update classes and attributes
            this.elements.mobileMenu.classList.add('active');
            this.elements.mobileToggle?.classList.add('active');
            this.elements.mobileToggle?.setAttribute('aria-expanded', 'true');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            
            // Focus management
            this.trapFocus(this.elements.mobileContent);
            
            // Animate in
            requestAnimationFrame(() => {
                this.elements.mobileContent.style.transform = 'translateX(0)';
            });
            
            // Dispatch event
            window.dispatchEvent(new CustomEvent('safepilot:mobile-menu:opened'));
        }

        /**
         * Close mobile menu
         */
        closeMobileMenu() {
            if (!this.state.isMobileMenuOpen) return;
            
            this.state.isMobileMenuOpen = false;
            
            // Update classes and attributes
            this.elements.mobileMenu.classList.remove('active');
            this.elements.mobileToggle?.classList.remove('active');
            this.elements.mobileToggle?.setAttribute('aria-expanded', 'false');
            
            // Restore body scroll
            document.body.style.overflow = '';
            
            // Release focus trap
            this.releaseFocus();
            
            // Animate out
            this.elements.mobileContent.style.transform = '';
            
            // Return focus to toggle button
            this.elements.mobileToggle?.focus();
            
            // Dispatch event
            window.dispatchEvent(new CustomEvent('safepilot:mobile-menu:closed'));
        }

        /**
         * Initialize search overlay functionality
         */
        initSearchOverlay() {
            if (!this.elements.searchOverlay) return;
            
            // Auto-complete functionality
            if (this.elements.searchInput) {
                let searchTimeout;
                
                this.elements.searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    const query = e.target.value.trim();
                    
                    if (query.length >= 3) {
                        searchTimeout = setTimeout(() => {
                            this.performAutoComplete(query);
                        }, 300);
                    }
                });
            }
        }

        /**
         * Toggle search overlay
         */
        toggleSearch() {
            if (this.state.isSearchOpen) {
                this.closeSearch();
            } else {
                this.openSearch();
            }
        }

        /**
         * Open search overlay
         */
        openSearch() {
            if (this.state.isSearchOpen) return;
            
            this.state.isSearchOpen = true;
            
            // Update classes and attributes
            this.elements.searchOverlay.classList.add('active');
            this.elements.searchToggle?.setAttribute('aria-expanded', 'true');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            
            // Focus management
            setTimeout(() => {
                this.elements.searchInput?.focus();
                this.trapFocus(this.elements.searchOverlay);
            }, 100);
            
            // Dispatch event
            window.dispatchEvent(new CustomEvent('safepilot:search:opened'));
        }

        /**
         * Close search overlay
         */
        closeSearch() {
            if (!this.state.isSearchOpen) return;
            
            this.state.isSearchOpen = false;
            
            // Update classes and attributes
            this.elements.searchOverlay.classList.remove('active');
            this.elements.searchToggle?.setAttribute('aria-expanded', 'false');
            
            // Restore body scroll
            document.body.style.overflow = '';
            
            // Release focus trap
            this.releaseFocus();
            
            // Clear search input
            if (this.elements.searchInput) {
                this.elements.searchInput.value = '';
            }
            
            // Return focus to toggle button
            this.elements.searchToggle?.focus();
            
            // Dispatch event
            window.dispatchEvent(new CustomEvent('safepilot:search:closed'));
        }

        /**
         * Perform auto-complete search (AJAX)
         * @param {string} query - Search query
         */
        async performAutoComplete(query) {
            if (!window.safepilotAjax) return;
            
            try {
                const response = await fetch(window.safepilotAjax.ajaxUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'safepilot_autocomplete',
                        query: query,
                        nonce: window.safepilotAjax.nonce
                    })
                });
                
                if (response.ok) {
                    const data = await response.json();
                    this.displayAutoCompleteResults(data.results);
                }
            } catch (error) {
                console.error('Autocomplete error:', error);
            }
        }

        /**
         * Display auto-complete results
         * @param {Array} results - Search results
         */
        displayAutoCompleteResults(results) {
            // Implementation for displaying autocomplete results
            // This would create a dropdown below the search input
            console.log('Autocomplete results:', results);
        }

        /**
         * Initialize dropdown navigation enhancements
         */
        initDropdowns() {
            if (this.state.isMobile) return;
            
            this.elements.dropdowns.forEach(dropdown => {
                let timeout;
                
                // Enhanced hover with delay
                dropdown.addEventListener('mouseenter', () => {
                    clearTimeout(timeout);
                    dropdown.classList.add('hover');
                });
                
                dropdown.addEventListener('mouseleave', () => {
                    timeout = setTimeout(() => {
                        dropdown.classList.remove('hover');
                    }, 200);
                });
                
                // Keyboard navigation
                const link = dropdown.querySelector('> a');
                if (link) {
                    link.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            dropdown.classList.toggle('hover');
                        }
                    });
                }
            });
        }

        /**
         * Initialize accessibility features
         */
        initAccessibility() {
            // Skip link functionality
            const skipLink = document.querySelector('.skip-link');
            if (skipLink) {
                skipLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(skipLink.getAttribute('href'));
                    if (target) {
                        target.setAttribute('tabindex', '-1');
                        target.focus();
                    }
                });
            }
            
            // ARIA live regions for dynamic content
            this.createAriaLiveRegion();
        }

        /**
         * Bind accessibility control events
         */
        bindAccessibilityEvents() {
            // Font size controls
            this.elements.fontSizeButtons?.forEach(button => {
                button.addEventListener('click', () => {
                    const size = button.dataset.fontSize;
                    this.setFontSize(size);
                    
                    // Update active state
                    this.elements.fontSizeButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });
            
            // Contrast controls
            this.elements.contrastButtons?.forEach(button => {
                button.addEventListener('click', () => {
                    const contrast = button.dataset.contrast;
                    this.setContrast(contrast);
                    
                    // Update active state
                    this.elements.contrastButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });
            
            // Other accessibility options
            this.elements.accessibilityOptions?.forEach(option => {
                option.addEventListener('change', (e) => {
                    const feature = e.target.dataset.accessibility;
                    const enabled = e.target.checked;
                    this.toggleAccessibilityFeature(feature, enabled);
                });
            });
            
            // Reset button
            this.elements.resetButton?.addEventListener('click', () => {
                this.resetAccessibilitySettings();
            });
        }

        /**
         * Set font size
         * @param {string} size - Font size (small, normal, large)
         */
        setFontSize(size) {
            document.body.classList.remove('font-size-small', 'font-size-normal', 'font-size-large');
            
            if (size !== 'normal') {
                document.body.classList.add(`font-size-${size}`);
            }
            
            // Save preference
            localStorage.setItem('safepilot_font_size', size);
            
            // Announce change
            this.announceToScreenReader(`Font size changed to ${size}`);
        }

        /**
         * Set contrast mode
         * @param {string} contrast - Contrast mode (normal, high, dark)
         */
        setContrast(contrast) {
            document.body.classList.remove('high-contrast', 'dark-mode');
            
            switch (contrast) {
                case 'high':
                    document.body.classList.add('high-contrast');
                    break;
                case 'dark':
                    document.body.classList.add('dark-mode');
                    break;
            }
            
            // Save preference
            localStorage.setItem('safepilot_contrast', contrast);
            
            // Announce change
            this.announceToScreenReader(`Contrast changed to ${contrast}`);
        }

        /**
         * Toggle accessibility feature
         * @param {string} feature - Feature name
         * @param {boolean} enabled - Enable/disable
         */
        toggleAccessibilityFeature(feature, enabled) {
            const className = feature.replace('_', '-');
            
            if (enabled) {
                document.body.classList.add(className);
            } else {
                document.body.classList.remove(className);
            }
            
            // Save preference
            localStorage.setItem(`safepilot_${feature}`, enabled);
            
            // Announce change
            this.announceToScreenReader(`${feature.replace('-', ' ')} ${enabled ? 'enabled' : 'disabled'}`);
        }

        /**
         * Reset all accessibility settings
         */
        resetAccessibilitySettings() {
            // Remove all accessibility classes
            document.body.classList.remove(
                'font-size-small',
                'font-size-large',
                'high-contrast',
                'dark-mode',
                'underline-links',
                'readable-font',
                'stop-animations'
            );
            
            // Clear localStorage
            const keys = Object.keys(localStorage).filter(key => key.startsWith('safepilot_'));
            keys.forEach(key => localStorage.removeItem(key));
            
            // Reset UI controls
            this.elements.fontSizeButtons?.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.fontSize === 'normal');
            });
            
            this.elements.contrastButtons?.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.contrast === 'normal');
            });
            
            this.elements.accessibilityOptions?.forEach(option => {
                option.checked = false;
            });
            
            // Announce reset
            this.announceToScreenReader('Accessibility settings reset to defaults');
        }

        /**
         * Restore saved accessibility settings
         */
        restoreAccessibilitySettings() {
            // Font size
            const fontSize = localStorage.getItem('safepilot_font_size');
            if (fontSize && fontSize !== 'normal') {
                this.setFontSize(fontSize);
                this.elements.fontSizeButtons?.forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.fontSize === fontSize);
                });
            }
            
            // Contrast
            const contrast = localStorage.getItem('safepilot_contrast');
            if (contrast && contrast !== 'normal') {
                this.setContrast(contrast);
                this.elements.contrastButtons?.forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.contrast === contrast);
                });
            }
            
            // Other features
            this.elements.accessibilityOptions?.forEach(option => {
                const feature = option.dataset.accessibility;
                const enabled = localStorage.getItem(`safepilot_${feature}`) === 'true';
                
                if (enabled) {
                    option.checked = true;
                    this.toggleAccessibilityFeature(feature, true);
                }
            });
        }

        /**
         * Initialize reading progress bar
         */
        initReadingProgress() {
            if (!this.elements.readingProgress) return;
            
            // Only show on single posts
            if (!document.body.classList.contains('single-post')) return;
            
            this.updateReadingProgress();
        }

        /**
         * Update reading progress bar
         */
        updateReadingProgress() {
            if (!this.elements.readingProgress) return;
            
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight - windowHeight;
            const scrolled = window.scrollY;
            const progress = (scrolled / documentHeight) * 100;
            
            this.elements.readingProgress.style.width = `${Math.min(progress, 100)}%`;
        }

        /**
         * Handle touch start for swipe gestures
         * @param {TouchEvent} e - Touch event
         */
        handleTouchStart(e) {
            this.state.touchStartX = e.touches[0].clientX;
            this.state.touchStartY = e.touches[0].clientY;
        }

        /**
         * Handle touch move for swipe detection
         * @param {TouchEvent} e - Touch event
         */
        handleTouchMove(e) {
            if (!this.state.touchStartX || !this.state.touchStartY) return;
            
            const touchEndX = e.touches[0].clientX;
            const touchEndY = e.touches[0].clientY;
            
            const deltaX = touchEndX - this.state.touchStartX;
            const deltaY = touchEndY - this.state.touchStartY;
            
            // Prevent default if horizontal swipe
            if (Math.abs(deltaX) > Math.abs(deltaY)) {
                e.preventDefault();
            }
        }

        /**
         * Handle touch end for swipe action
         * @param {TouchEvent} e - Touch event
         */
        handleTouchEnd(e) {
            if (!this.state.touchStartX || !this.state.touchStartY) return;
            
            const touchEndX = e.changedTouches[0].clientX;
            const deltaX = touchEndX - this.state.touchStartX;
            
            // Swipe right to close mobile menu
            if (deltaX > this.config.swipeThreshold && this.state.isMobileMenuOpen) {
                this.closeMobileMenu();
            }
            
            // Reset touch coordinates
            this.state.touchStartX = null;
            this.state.touchStartY = null;
        }

        /**
         * Handle window resize
         */
        handleResize() {
            this.checkMobile();
            
            // Close mobile menu if resizing to desktop
            if (!this.state.isMobile && this.state.isMobileMenuOpen) {
                this.closeMobileMenu();
            }
        }

        /**
         * Check if mobile breakpoint
         */
        checkMobile() {
            this.state.isMobile = window.innerWidth < this.config.mobileBreakpoint;
        }

        /**
         * Initialize animations
         */
        initAnimations() {
            // Animate header elements on load
            if (!this.state.isMobile) {
                this.animateHeaderElements();
            }
            
            // Parallax effect for hero sections
            this.initParallax();
            
            // Button hover effects
            this.initButtonEffects();
        }

        /**
         * Animate header elements on page load
         */
        animateHeaderElements() {
            // Stagger animation for nav items
            this.elements.navItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.05}s`;
                item.classList.add('fade-in-up');
            });
            
            // Animate CTA button
            if (this.elements.ctaButton) {
                this.elements.ctaButton.classList.add('pulse');
            }
        }

        /**
         * Initialize parallax effects
         */
        initParallax() {
            if ('IntersectionObserver' in window) {
                const parallaxElements = document.querySelectorAll('[data-parallax]');
                
                const parallaxObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            window.addEventListener('scroll', () => {
                                const scrolled = window.scrollY;
                                const rate = scrolled * -0.5;
                                entry.target.style.transform = `translateY(${rate}px)`;
                            });
                        }
                    });
                });
                
                parallaxElements.forEach(element => {
                    parallaxObserver.observe(element);
                });
            }
        }

        /**
         * Initialize button hover effects
         */
        initButtonEffects() {
            const buttons = document.querySelectorAll('.safepilot-btn');
            
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function(e) {
                    const x = e.clientX - e.target.offsetLeft;
                    const y = e.clientY - e.target.offsetTop;
                    
                    const ripple = document.createElement('span');
                    ripple.className = 'ripple';
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        }

        /**
         * Trap focus within an element
         * @param {HTMLElement} element - Container element
         */
        trapFocus(element) {
            if (!element) return;
            
            const focusableElements = element.querySelectorAll(
                'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
            );
            
            const firstFocusable = focusableElements[0];
            const lastFocusable = focusableElements[focusableElements.length - 1];
            
            this.focusTrapHandler = (e) => {
                if (e.key === 'Tab') {
                    if (e.shiftKey) {
                        if (document.activeElement === firstFocusable) {
                            lastFocusable.focus();
                            e.preventDefault();
                        }
                    } else {
                        if (document.activeElement === lastFocusable) {
                            firstFocusable.focus();
                            e.preventDefault();
                        }
                    }
                }
            };
            
            element.addEventListener('keydown', this.focusTrapHandler);
        }

        /**
         * Release focus trap
         */
        releaseFocus() {
            if (this.focusTrapHandler) {
                document.removeEventListener('keydown', this.focusTrapHandler);
                this.focusTrapHandler = null;
            }
        }

        /**
         * Create ARIA live region for announcements
         */
        createAriaLiveRegion() {
            if (!this.ariaLiveRegion) {
                this.ariaLiveRegion = document.createElement('div');
                this.ariaLiveRegion.setAttribute('aria-live', 'polite');
                this.ariaLiveRegion.setAttribute('aria-atomic', 'true');
                this.ariaLiveRegion.className = 'sr-only';
                document.body.appendChild(this.ariaLiveRegion);
            }
        }

        /**
         * Announce to screen readers
         * @param {string} message - Message to announce
         */
        announceToScreenReader(message) {
            if (this.ariaLiveRegion) {
                this.ariaLiveRegion.textContent = message;
                
                // Clear after announcement
                setTimeout(() => {
                    this.ariaLiveRegion.textContent = '';
                }, 1000);
            }
        }

        /**
         * Throttle function calls
         * @param {Function} func - Function to throttle
         * @param {number} wait - Wait time in ms
         * @returns {Function} Throttled function
         */
        throttle(func, wait) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, wait);
                }
            };
        }

        /**
         * Debounce function calls
         * @param {Function} func - Function to debounce
         * @param {number} wait - Wait time in ms
         * @returns {Function} Debounced function
         */
        debounce(func, wait) {
            let timeout;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        /**
         * Destroy header instance and clean up
         */
        destroy() {
            // Remove event listeners
            window.removeEventListener('scroll', this.handleScroll);
            window.removeEventListener('resize', this.handleResize);
            
            // Clean up DOM modifications
            if (this.headerPlaceholder) {
                this.headerPlaceholder.remove();
            }
            
            // Release focus trap
            this.releaseFocus();
            
            // Remove ARIA live region
            if (this.ariaLiveRegion) {
                this.ariaLiveRegion.remove();
            }
            
            // Dispatch destroy event
            window.dispatchEvent(new CustomEvent('safepilot:header:destroyed'));
            
            console.log('SafePilot Header destroyed');
        }
    }

    /**
     * Initialize SafePilot Header
     * Export to global scope for external access
     */
    window.SafePilotHeader = SafePilotHeader;
    
    // Auto-initialize
    window.safepilotHeader = new SafePilotHeader();

})(window, document);

/**
 * jQuery integration (if jQuery is available)
 */
if (typeof jQuery !== 'undefined') {
    jQuery(function($) {
        // jQuery-specific enhancements
        
        /**
         * Smooth scroll for anchor links
         */
        $('a[href^="#"]').not('[href="#"]').on('click', function(e) {
            const target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800, 'swing');
            }
        });
        
        /**
         * Enhanced dropdown hover with hoverIntent
         */
        if ($.fn.hoverIntent) {
            $('.menu-item-has-children').hoverIntent({
                over: function() {
                    $(this).addClass('hover-intent');
                },
                out: function() {
                    $(this).removeClass('hover-intent');
                },
                timeout: 200
            });
        }
    });
}