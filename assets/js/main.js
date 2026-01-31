/**
 * HydrogenWaterHQ Theme JavaScript
 *
 * @package HydrogenWaterHQ
 */

(function() {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.main-navigation');

        if (menuToggle && navigation) {
            menuToggle.addEventListener('click', function() {
                navigation.classList.toggle('toggled');

                const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
                menuToggle.setAttribute('aria-expanded', !expanded);
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!navigation.contains(event.target) && !menuToggle.contains(event.target)) {
                    navigation.classList.remove('toggled');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                if (href === '#') return;

                const target = document.querySelector(href);
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
     * Add 'scrolled' class to header on scroll
     */
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');

        if (header) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        }
    }

    /**
     * Lazy load images (fallback for older browsers)
     */
    function initLazyLoad() {
        if ('loading' in HTMLImageElement.prototype) {
            // Browser supports native lazy loading
            return;
        }

        // Fallback for older browsers
        const images = document.querySelectorAll('img[loading="lazy"]');

        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        }
    }

    /**
     * Table of Contents Auto-generation
     */
    function initTableOfContents() {
        const content = document.querySelector('.entry-content');
        const tocContainer = document.querySelector('.table-of-contents');

        if (!content || !tocContainer) return;

        const headings = content.querySelectorAll('h2, h3');

        if (headings.length < 3) {
            tocContainer.style.display = 'none';
            return;
        }

        const toc = document.createElement('ul');

        headings.forEach((heading, index) => {
            // Add ID to heading if not present
            if (!heading.id) {
                heading.id = 'section-' + index;
            }

            const li = document.createElement('li');
            li.className = heading.tagName.toLowerCase();

            const a = document.createElement('a');
            a.href = '#' + heading.id;
            a.textContent = heading.textContent;

            li.appendChild(a);
            toc.appendChild(li);
        });

        tocContainer.appendChild(toc);
    }

    /**
     * Copy to Clipboard for Code Blocks
     */
    function initCodeCopy() {
        document.querySelectorAll('pre code').forEach(block => {
            const button = document.createElement('button');
            button.className = 'copy-code-btn';
            button.textContent = 'Copy';

            button.addEventListener('click', function() {
                navigator.clipboard.writeText(block.textContent).then(() => {
                    button.textContent = 'Copied!';
                    setTimeout(() => {
                        button.textContent = 'Copy';
                    }, 2000);
                });
            });

            block.parentNode.style.position = 'relative';
            block.parentNode.appendChild(button);
        });
    }

    /**
     * External Link Handler
     */
    function initExternalLinks() {
        document.querySelectorAll('a[href^="http"]').forEach(link => {
            if (!link.href.includes(window.location.hostname)) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'nofollow noopener');
            }
        });
    }

    /**
     * Initialize all functions on DOM ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initSmoothScroll();
        initHeaderScroll();
        initLazyLoad();
        initTableOfContents();
        initCodeCopy();
        initExternalLinks();
    });

})();
