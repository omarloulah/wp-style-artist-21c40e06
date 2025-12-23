/**
 * TechPolse Theme JavaScript
 *
 * @package TechPolse
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initThemeToggle();
        initSearchToggle();
        initSmoothScroll();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const toggle = document.querySelector('.mobile-menu-toggle');
        const menu = document.querySelector('.mobile-menu');
        const menuIcon = toggle?.querySelector('.menu-icon');
        const closeIcon = toggle?.querySelector('.close-icon');

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function() {
            const isOpen = menu.classList.toggle('active');
            toggle.setAttribute('aria-expanded', isOpen);
            
            if (menuIcon && closeIcon) {
                menuIcon.style.display = isOpen ? 'none' : 'block';
                closeIcon.style.display = isOpen ? 'block' : 'none';
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                menu.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
                if (menuIcon && closeIcon) {
                    menuIcon.style.display = 'block';
                    closeIcon.style.display = 'none';
                }
            }
        });

        // Close menu when clicking a link
        menu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                menu.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
                if (menuIcon && closeIcon) {
                    menuIcon.style.display = 'block';
                    closeIcon.style.display = 'none';
                }
            });
        });
    }

    /**
     * Theme Toggle (Dark/Light Mode)
     */
    function initThemeToggle() {
        const toggle = document.querySelector('.theme-toggle');
        const sunIcon = toggle?.querySelector('.sun-icon');
        const moonIcon = toggle?.querySelector('.moon-icon');

        if (!toggle) return;

        // Check for saved theme preference or system preference
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            document.body.classList.add('dark');
            updateThemeIcons(true);
        }

        toggle.addEventListener('click', function() {
            const isDark = document.body.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcons(isDark);
        });

        function updateThemeIcons(isDark) {
            if (sunIcon && moonIcon) {
                sunIcon.style.display = isDark ? 'block' : 'none';
                moonIcon.style.display = isDark ? 'none' : 'block';
            }
        }
    }

    /**
     * Search Toggle
     */
    function initSearchToggle() {
        const toggle = document.querySelector('.search-toggle');
        const modal = document.querySelector('.search-modal');
        const searchField = modal?.querySelector('.search-field');

        if (!toggle || !modal) return;

        toggle.addEventListener('click', function() {
            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
            if (searchField && modal.style.display === 'block') {
                searchField.focus();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'block') {
                modal.style.display = 'none';
            }
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!modal.contains(e.target) && !toggle.contains(e.target)) {
                modal.style.display = 'none';
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    /**
     * Lazy Load Images (for browsers that don't support native lazy loading)
     */
    if ('loading' in HTMLImageElement.prototype) {
        // Native lazy loading supported
        document.querySelectorAll('img[data-src]').forEach(function(img) {
            img.src = img.dataset.src;
        });
    } else {
        // Fallback for older browsers
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        imageObserver.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

})();
