<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BECS - Bureau of Engineering & Contracting Services. Delivering world-class engineering, BIM-driven construction, GIS solutions, and finishing works across Lebanon and the region.">
    <meta name="keywords" content="engineering, contracting, BIM, GIS, construction, Lebanon, BECS">
    <meta property="og:title" content="BECS — Bureau of Engineering & Contracting Services">
    <meta property="og:description" content="From Vision to Reality — Delivering World-Class Engineering Solutions.">
    <title>@yield('title', 'BECS — Bureau of Engineering & Contracting Services')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @yield('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="nav-logo" id="nav-logo-link">
                <img src="{{ asset('assets/becs-logo.png') }}" alt="BECS - Bureau of Engineering & Contracting Services">
            </a>
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}" id="nav-home">Home</a></li>
                <li><a href="{{ url('/about') }}" class="nav-link {{ Request::is('about') ? 'active' : '' }}" id="nav-about">About</a></li>
                <li><a href="{{ url('/services') }}" class="nav-link {{ Request::is('services') ? 'active' : '' }}" id="nav-services">Services</a></li>
                <li><a href="{{ url('/projects') }}" class="nav-link {{ Request::is('projects') ? 'active' : '' }}" id="nav-projects">Projects</a></li>
                <li><a href="{{ url('/contact') }}" class="nav-link {{ Request::is('contact') ? 'active' : '' }}" id="nav-contact">Contact</a></li>
            </ul>
            <a href="{{ url('/contact') }}" class="nav-cta" id="nav-cta-btn">
                <i class="fas fa-arrow-right" style="font-size:0.7rem;"></i>
                Get in Touch
            </a>
            <button class="nav-hamburger" id="hamburger" aria-label="Open menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- MOBILE NAV -->
    <div class="nav-mobile" id="mobile-nav" role="dialog" aria-modal="true">
        <button class="nav-mobile-close" id="mobile-close" aria-label="Close menu"><i class="fas fa-times"></i></button>
        <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}" id="mnav-home">Home</a>
        <a href="{{ url('/about') }}" class="nav-link {{ Request::is('about') ? 'active' : '' }}" id="mnav-about">About</a>
        <a href="{{ url('/services') }}" class="nav-link {{ Request::is('services') ? 'active' : '' }}" id="mnav-services">Services</a>
        <a href="{{ url('/projects') }}" class="nav-link {{ Request::is('projects') ? 'active' : '' }}" id="mnav-projects">Projects</a>
        <a href="{{ url('/contact') }}" class="nav-link {{ Request::is('contact') ? 'active' : '' }}" id="mnav-contact">Contact</a>
        <a href="{{ url('/contact') }}" class="btn-primary" id="mnav-cta">Get in Touch</a>
    </div>

    <!-- MAIN CONTENT -->
    @yield('content')

    <!-- FOOTER -->
    <footer class="footer" id="footer">
        <div class="container">
            <div class="footer-grid" id="footer-grid">
                <div class="footer-brand" id="footer-brand">
                    <img src="{{ asset('assets/becs-logo.png') }}" alt="BECS Logo" id="footer-logo">
                    <p>Bureau of Engineering & Contracting Services — delivering world-class engineering and construction solutions since 2009.</p>
                    <div class="footer-social" id="footer-social">
                        <a href="#" aria-label="Facebook" id="social-fb"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram" id="social-ig"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn" id="social-li"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-col" id="footer-nav-col">
                    <h4>Navigation</h4>
                    <div class="footer-links">
                        <a href="{{ url('/') }}" id="flink-home">Home</a>
                        <a href="{{ url('/about') }}" id="flink-about">About Us</a>
                        <a href="{{ url('/services') }}" id="flink-services">Services</a>
                        <a href="{{ url('/projects') }}" id="flink-projects">Projects</a>
                        <a href="{{ url('/contact') }}" id="flink-contact">Contact</a>
                    </div>
                </div>

                <div class="footer-col" id="footer-contact-col">
                    <h4>Contact</h4>
                    <div class="footer-contact-item" id="footer-addr">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Abidjan<br>Côte d'Ivoire</span>
                    </div>
                    <div class="footer-contact-item" id="footer-phone-info">
                        <i class="fas fa-phone"></i>
                        <span>+225 77 58 59 58</span>
                    </div>
                    <div class="footer-contact-item" id="footer-email-info">
                        <i class="fas fa-envelope"></i>
                        <span>info@becs.com.lb</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom" id="footer-bottom">
                <p>© 2026 <a href="{{ url('/') }}">BECS</a> — Bureau of Engineering & Contracting Services. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT -->
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Mobile nav
        document.getElementById('hamburger').addEventListener('click', () => {
            document.getElementById('mobile-nav').classList.add('open');
            document.body.style.overflow = 'hidden';
        });
        const closeMobileNav = () => {
            document.getElementById('mobile-nav').classList.remove('open');
            document.body.style.overflow = '';
        };
        document.getElementById('mobile-close').addEventListener('click', closeMobileNav);
        document.querySelectorAll('#mobile-nav a').forEach(a => a.addEventListener('click', closeMobileNav));

        // Scroll reveal
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                const target = document.querySelector(href);
                if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
