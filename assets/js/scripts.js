/**
 * SEO Expert Modern Website - Main JavaScript
 * ============================================
 */

(function() {
    'use strict';

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all);
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener));
            } else {
                selectEl.addEventListener(type, listener);
            }
        }
    };

    /**
     * Easy on scroll event listener 
     */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener);
    };

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active');
            } else {
                navbarlink.classList.remove('active');
            }
        });
    };
    window.addEventListener('load', navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Scrolls to an element with header offset
     */
    const scrollto = (el) => {
        let header = select('#header');
        let offset = header.offsetHeight;
        let elementPos = select(el).offsetTop;
        window.scrollTo({
            top: elementPos - offset,
            behavior: 'smooth'
        });
    };

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select('#header');
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add('header-scrolled');
            } else {
                selectHeader.classList.remove('header-scrolled');
            }
        };
        window.addEventListener('load', headerScrolled);
        onscroll(document, headerScrolled);
    }

    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top');
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('show');
            } else {
                backtotop.classList.remove('show');
            }
        };
        window.addEventListener('load', toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    /**
     * Mobile nav toggle
     */
    on('click', '.mobile-nav-toggle', function(e) {
        select('#navbar').classList.toggle('navbar-mobile');
        this.classList.toggle('bi-list');
        this.classList.toggle('bi-x');
    });

    /**
     * Mobile nav dropdowns activate
     */
    on('click', '.navbar .dropdown > a', function(e) {
        if (select('#navbar').classList.contains('navbar-mobile')) {
            e.preventDefault();
            this.nextElementSibling.classList.toggle('dropdown-active');
        }
    }, true);

    /**
     * Scroll with offset on links with a class name .scrollto
     */
    on('click', '.scrollto', function(e) {
        if (select(this.hash)) {
            e.preventDefault();
            let navbar = select('#navbar');
            if (navbar.classList.contains('navbar-mobile')) {
                navbar.classList.remove('navbar-mobile');
                let navbarToggle = select('.mobile-nav-toggle');
                navbarToggle.classList.toggle('bi-list');
                navbarToggle.classList.toggle('bi-x');
            }
            scrollto(this.hash);
        }
    }, true);

    /**
     * Scroll with offset on page load with hash links in the url
     */
    window.addEventListener('load', () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash);
            }
        }
    });

    /**
     * Hero typewriter effect
     */
    const initTypewriter = () => {
        const typewriterElement = select('.hero-title .text-gradient');
        if (typewriterElement) {
            const text = typewriterElement.textContent;
            typewriterElement.textContent = '';
            let i = 0;
            
            const typeWriter = () => {
                if (i < text.length) {
                    typewriterElement.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            };
            
            setTimeout(typeWriter, 1000);
        }
    };

    /**
     * Skills animation
     */
    const animateSkills = () => {
        let skillsContent = select('.skills-section');
        if (skillsContent) {
            let skillsProgress = select('.skill-progress', true);
            skillsProgress.forEach((progress) => {
                let width = progress.getAttribute('data-width');
                progress.style.width = width;
            });
        }
    };

    /**
     * Testimonials swiper
     */
    const initTestimonialsSwiper = () => {
        new Swiper('.testimonials-swiper', {
            speed: 600,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            slidesPerView: 'auto',
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 20
                }
            }
        });
    };

    /**
     * GLightbox
     */
    const initGLightbox = () => {
        const glightbox = GLightbox({
            selector: '.glightbox'
        });
    };

    /**
     * Animation on scroll
     */
    const initAOS = () => {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    };

    /**
     * PureCounter
     */
    const initPureCounter = () => {
        new PureCounter();
    };

    /**
     * Navbar scroll effect
     */
    const initNavbarScroll = () => {
        const navbar = select('.navbar');
        if (navbar) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        }
    };

    /**
     * Smooth scrolling for anchor links
     */
    const initSmoothScroll = () => {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    };

    /**
     * Contact form validation and submission
     */
    const initContactForm = () => {
        const form = select('.contact-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Basic form validation
                const name = select('input[name="name"]').value.trim();
                const email = select('input[name="email"]').value.trim();
                const message = select('textarea[name="message"]').value.trim();
                
                if (!name || !email || !message) {
                    alert('Please fill in all required fields.');
                    return;
                }
                
                if (!isValidEmail(email)) {
                    alert('Please enter a valid email address.');
                    return;
                }
                
                // Here you would typically send the form data to your server
                // For now, we'll just show a success message
                alert('Thank you for your message! I will get back to you soon.');
                form.reset();
            });
        }
    };

    /**
     * Email validation helper
     */
    const isValidEmail = (email) => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    };

    /**
     * Floating animation for hero cards
     */
    const initFloatingAnimation = () => {
        const floatingCards = select('.floating-card', true);
        floatingCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 2}s`;
        });
    };

    /**
     * Portfolio filter (if needed in future)
     */
    const initPortfolioFilter = () => {
        const portfolioContainer = select('.portfolio-container');
        if (portfolioContainer) {
            let portfolioIsotope = new Isotope(portfolioContainer, {
                itemSelector: '.portfolio-item'
            });

            let portfolioFilters = select('#portfolio-flters li', true);

            on('click', '#portfolio-flters li', function(e) {
                e.preventDefault();
                portfolioFilters.forEach(function(el) {
                    el.classList.remove('filter-active');
                });
                this.classList.add('filter-active');

                portfolioIsotope.arrange({
                    filter: this.getAttribute('data-filter')
                });
                portfolioIsotope.on('arrangeComplete', function() {
                    AOS.refresh();
                });
            }, true);
        }
    };

    /**
     * Initialize all functions
     */
    window.addEventListener('load', () => {
        initAOS();
        initNavbarScroll();
        initSmoothScroll();
        initContactForm();
        initFloatingAnimation();
        animateSkills();
        
        // Initialize Swiper if available
        if (typeof Swiper !== 'undefined') {
            initTestimonialsSwiper();
        }
        
        // Initialize GLightbox if available
        if (typeof GLightbox !== 'undefined') {
            initGLightbox();
        }
        
        // Initialize PureCounter if available
        if (typeof PureCounter !== 'undefined') {
            initPureCounter();
        }
        
        // Initialize portfolio filter if Isotope is available
        if (typeof Isotope !== 'undefined') {
            initPortfolioFilter();
        }
    });

    /**
     * Preloader
     */
    const preloader = select('#preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.remove();
        });
    }

    /**
     * Header scroll effect with better performance
     */
    let ticking = false;
    const updateHeader = () => {
        const header = select('.navbar');
        if (header) {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
        ticking = false;
    };

    const requestTick = () => {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    };

    window.addEventListener('scroll', requestTick);

    /**
     * Intersection Observer for animations
     */
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Trigger skill bars animation when skills section comes into view
                if (entry.target.classList.contains('skills-section')) {
                    animateSkills();
                }
                
                // Add animation class to service cards
                if (entry.target.classList.contains('service-card')) {
                    entry.target.style.animationDelay = '0.1s';
                    entry.target.classList.add('animate-in');
                }
            }
        });
    }, observerOptions);

    // Observe elements
    window.addEventListener('load', () => {
        const skillsSection = select('.skills-section');
        const serviceCards = select('.service-card', true);
        
        if (skillsSection) observer.observe(skillsSection);
        if (serviceCards) serviceCards.forEach(card => observer.observe(card));
    });

})();