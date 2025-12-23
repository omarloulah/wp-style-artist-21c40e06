/**
 * TechPolse Theme JavaScript
 * Advanced animations and interactions
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
        initScrollAnimations();
        initCardHoverEffects();
        initProgressBar();
        initParallaxEffects();
        initTypingEffect();
    });

    /**
     * Mobile Menu Toggle with Animation
     */
    function initMobileMenu() {
        const toggle = document.querySelector('.mobile-menu-toggle');
        const menu = document.querySelector('.mobile-menu');
        const menuIcon = toggle?.querySelector('.menu-icon');
        const closeIcon = toggle?.querySelector('.close-icon');
        const body = document.body;

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function() {
            const isOpen = menu.classList.toggle('active');
            toggle.setAttribute('aria-expanded', isOpen);
            
            // Animate icons
            if (menuIcon && closeIcon) {
                menuIcon.style.display = isOpen ? 'none' : 'block';
                closeIcon.style.display = isOpen ? 'block' : 'none';
                
                // Add rotation animation
                toggle.style.transform = isOpen ? 'rotate(90deg)' : 'rotate(0deg)';
            }

            // Prevent body scroll when menu is open
            body.style.overflow = isOpen ? 'hidden' : '';
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                closeMenu();
            }
        });

        // Close menu when clicking a link
        menu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', closeMenu);
        });

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menu.classList.contains('active')) {
                closeMenu();
            }
        });

        function closeMenu() {
            menu.classList.remove('active');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.style.transform = 'rotate(0deg)';
            body.style.overflow = '';
            if (menuIcon && closeIcon) {
                menuIcon.style.display = 'block';
                closeIcon.style.display = 'none';
            }
        }
    }

    /**
     * Theme Toggle with Smooth Animation
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
            // Add transition class for smooth color change
            document.body.style.transition = 'background-color 0.3s ease, color 0.3s ease';
            
            const isDark = document.body.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcons(isDark);

            // Add a ripple effect
            createRipple(toggle);
            
            // Remove transition after animation
            setTimeout(() => {
                document.body.style.transition = '';
            }, 300);
        });

        function updateThemeIcons(isDark) {
            if (sunIcon && moonIcon) {
                sunIcon.style.display = isDark ? 'block' : 'none';
                moonIcon.style.display = isDark ? 'none' : 'block';
                
                // Animate icon
                const activeIcon = isDark ? sunIcon : moonIcon;
                activeIcon.style.animation = 'none';
                activeIcon.offsetHeight; // Trigger reflow
                activeIcon.style.animation = 'spin 0.5s ease';
            }
        }
    }

    /**
     * Search Toggle with Focus
     */
    function initSearchToggle() {
        const toggle = document.querySelector('.search-toggle');
        const modal = document.querySelector('.search-modal');
        const searchField = modal?.querySelector('.search-field');

        if (!toggle || !modal) return;

        toggle.addEventListener('click', function() {
            const isVisible = modal.style.display === 'block';
            modal.style.display = isVisible ? 'none' : 'block';
            
            if (!isVisible && searchField) {
                setTimeout(() => searchField.focus(), 100);
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
     * Scroll-triggered Animations
     */
    function initScrollAnimations() {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-visible');
                    
                    // Stagger children animations
                    const children = entry.target.querySelectorAll('.animate-child');
                    children.forEach((child, index) => {
                        child.style.animationDelay = `${index * 0.1}s`;
                        child.classList.add('animate-visible');
                    });
                }
            });
        }, observerOptions);

        // Observe elements
        document.querySelectorAll('.article-card, .sidebar-widget, .featured-section').forEach(el => {
            el.classList.add('animate-on-scroll');
            observer.observe(el);
        });

        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            .animate-on-scroll {
                opacity: 0;
                transform: translateY(30px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }
            .animate-on-scroll.animate-visible {
                opacity: 1;
                transform: translateY(0);
            }
            .animate-child {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.5s ease, transform 0.5s ease;
            }
            .animate-child.animate-visible {
                opacity: 1;
                transform: translateY(0);
            }
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * Card Hover Effects
     */
    function initCardHoverEffects() {
        const cards = document.querySelectorAll('.article-card');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });

            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
        });

        // Add gradient follow effect CSS
        const style = document.createElement('style');
        style.textContent = `
            .article-card::after {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(
                    600px circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
                    rgba(59, 130, 246, 0.06),
                    transparent 40%
                );
                pointer-events: none;
                opacity: 0;
                transition: opacity 0.3s ease;
                border-radius: inherit;
            }
            .article-card:hover::after {
                opacity: 1;
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * Reading Progress Bar
     */
    function initProgressBar() {
        const article = document.querySelector('.article-body');
        if (!article) return;

        const progressBar = document.createElement('div');
        progressBar.className = 'reading-progress';
        document.body.appendChild(progressBar);

        const style = document.createElement('style');
        style.textContent = `
            .reading-progress {
                position: fixed;
                top: 0;
                left: 0;
                width: 0%;
                height: 3px;
                background: linear-gradient(90deg, #3b82f6, #8b5cf6);
                z-index: 9999;
                transition: width 0.1s ease;
            }
        `;
        document.head.appendChild(style);

        window.addEventListener('scroll', function() {
            const articleRect = article.getBoundingClientRect();
            const articleStart = articleRect.top + window.scrollY;
            const articleHeight = article.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrolled = window.scrollY;
            
            if (scrolled < articleStart) {
                progressBar.style.width = '0%';
            } else if (scrolled > articleStart + articleHeight - windowHeight) {
                progressBar.style.width = '100%';
            } else {
                const progress = ((scrolled - articleStart) / (articleHeight - windowHeight)) * 100;
                progressBar.style.width = `${Math.min(100, Math.max(0, progress))}%`;
            }
        });
    }

    /**
     * Parallax Effects for Featured Section
     */
    function initParallaxEffects() {
        const featured = document.querySelector('.featured-section');
        if (!featured) return;

        const featuredImage = featured.querySelector('.featured-image img');
        if (!featuredImage) return;

        let ticking = false;

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const rect = featured.getBoundingClientRect();
                    const scrollPercent = rect.top / window.innerHeight;
                    
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        const translateY = scrollPercent * 50;
                        featuredImage.style.transform = `translateY(${translateY}px) scale(1.1)`;
                    }
                    
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

    /**
     * Typing Effect for Headlines (Optional)
     */
    function initTypingEffect() {
        const headlines = document.querySelectorAll('.typing-effect');
        
        headlines.forEach(headline => {
            const text = headline.textContent;
            headline.textContent = '';
            headline.style.visibility = 'visible';
            
            let i = 0;
            const typeWriter = () => {
                if (i < text.length) {
                    headline.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                }
            };
            
            // Start typing when element is in view
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    typeWriter();
                    observer.disconnect();
                }
            });
            observer.observe(headline);
        });
    }

    /**
     * Create Ripple Effect
     */
    function createRipple(element) {
        const ripple = document.createElement('span');
        ripple.className = 'ripple';
        element.appendChild(ripple);

        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        
        ripple.style.width = ripple.style.height = `${size}px`;
        ripple.style.left = `${rect.width / 2 - size / 2}px`;
        ripple.style.top = `${rect.height / 2 - size / 2}px`;

        // Add ripple CSS if not exists
        if (!document.querySelector('#ripple-style')) {
            const style = document.createElement('style');
            style.id = 'ripple-style';
            style.textContent = `
                .ripple {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.3);
                    transform: scale(0);
                    animation: ripple-animation 0.6s ease-out;
                    pointer-events: none;
                }
                @keyframes ripple-animation {
                    to {
                        transform: scale(2);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        // Remove ripple after animation
        setTimeout(() => ripple.remove(), 600);
    }

    /**
     * Lazy Load Images
     */
    if ('loading' in HTMLImageElement.prototype) {
        document.querySelectorAll('img[data-src]').forEach(function(img) {
            img.src = img.dataset.src;
        });
    } else {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Copy to Clipboard with Toast
     */
    window.copyToClipboard = function(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                showToast('Link copied to clipboard!');
            });
        }
    };

    /**
     * Show Toast Notification
     */
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.textContent = message;
        document.body.appendChild(toast);

        // Add toast CSS if not exists
        if (!document.querySelector('#toast-style')) {
            const style = document.createElement('style');
            style.id = 'toast-style';
            style.textContent = `
                .toast-notification {
                    position: fixed;
                    bottom: 2rem;
                    left: 50%;
                    transform: translateX(-50%) translateY(100px);
                    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
                    color: white;
                    padding: 1rem 2rem;
                    border-radius: 0.75rem;
                    font-weight: 500;
                    box-shadow: 0 10px 40px -10px rgba(59, 130, 246, 0.5);
                    z-index: 10000;
                    animation: toast-in 0.3s ease forwards;
                }
                @keyframes toast-in {
                    to {
                        transform: translateX(-50%) translateY(0);
                    }
                }
                .toast-notification.hide {
                    animation: toast-out 0.3s ease forwards;
                }
                @keyframes toast-out {
                    to {
                        transform: translateX(-50%) translateY(100px);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        // Remove toast after delay
        setTimeout(() => {
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

})();
